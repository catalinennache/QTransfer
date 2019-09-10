<?php 

class Procedures{
    public static function createAsession($password){
       $dbc =  new DBConnector('root','');
        $values = array();
        $expiration_date = new DateTime();
        $expiration_date->add(new DateInterval('P1D'));
        $expiration_date = $expiration_date->format('Y-m-d H:i:s');
        
        array_push($values,uniqid());
        array_push($values,session_id());
        array_push($values,$expiration_date);
        array_push($values,$password);
        array_push($values,":NULL");
        $success = $dbc->Add('ASessions',$values,true);
        Logger::WriteLines("add asession success: ",$success);
        if($success){
           $result =  $dbc->getEntriesWhere('ASessions',"`ASessions`.`Initiator_ID` = '".session_id()."'");
           Logger::Write_R($result);
           $values = array();
           array_push($values,session_id());
           array_push($values,$result[0][0]);
           array_push($values,'-');
           $success = $dbc->Add('ASessions_Users',$values); 
        }
        return array('success'=>$success,'asession_id'=>$result[0][0]);
        
    }

    public static function checkAsession($asession_id,$user_id){
        $dbc = new DBConnector();
        $resultset = $dbc->getEntriesWhere('ASessions_Users',"`ASessions_Users`.`ASession_Id` = '".$asession_id."' AND `ASessions_Users`.`User_Id` = '".$user_id."'");
        Logger::WriteLines("checkAsession called with ".$asession_id."and $user_id with result: ",$resultset);
        return count($resultset) === 1;
    }

    public static function JoinAsession($user_id,$access_code,$pass){
        
        $dbc = new DBConnector();
        $res = $dbc->getEntriesWhere('ASessions',"`ASessions`.`Password` = '$pass' AND `ASessions`.`Access_code` = '$access_code'");
        $success = false;
        if(count($res) === 1){
           $values = array();
           array_push($values,$user_id);
           array_push($values,$res[0][0]);
           array_push($values,$access_code);
           $success = $dbc->Add('ASessions_Users',$values); 
           if($success) 
                $success = self::DeleteJoinCode($access_code);
           return array('success'=>$success,'asession_id'=>$res[0][0]);
        
        }

        return array('success'=>false);
        
        
    }

    public static function AddAsessionClip($asession_id,$title, $text, $preview){
        $values = array();
        array_push($values,$asession_id);
        array_push($values,'0');
        array_push($values,$title);
        array_push($values,$text);
        array_push($values,":NULL");
        $dbc =  new DBConnector();
        $scs = $dbc->Add('ASessions_Content',$values);
        $cid = -1;
        if($scs){
           $rs =  $dbc->getEntriesWhere('ASessions_content',"`ASession_Id` = '$asession_id' AND `Title` = '$title' AND `Text_Content` = '$text'");
           if(count($rs)> 0)
            $cid = $rs[0][0];
        }
        return array("success"=>$scs,"cid"=>$cid);

    }

    public static function GetAsessionClipContent($asession_id){
        $dbc = new DBConnector();
        return  $dbc->getEntriesWhere('ASessions_Content',"`ASessions_Content`.`Asession_Id` = '".$asession_id."' AND `ASessions_Content`.`Type` = '0'");
    }

    public static function GetAsessionClipContentByCID($asession_id,$cid){
        $dbc = new DBConnector();
        return  $dbc->getEntriesWhere('ASessions_Content',"`ASessions_Content`.`Asession_Id` = '".$asession_id."' AND `ASessions_Content`.`Type` = '0' AND `ASessions_Content`.`CID` = '$cid'");
    }

    public static function DeleteContent($cid){
        $dbc = new DBConnector();
        return $dbc->RemoveWhere('ASessions_Content',"`CID` = '$cid'");
    }

    public static function GetJoinCode($asession_id){
        $dbc = new DBConnector();
        $current_session = $dbc->getEntriesWhere('ASessions',"`Id` = '$asession_id'")[0];
        Logger::WriteLines("Current Session fetched : ",$current_session);
        if(!$current_session[4]){
            $password = $current_session[3];
            $rs = $dbc->getEntriesWhere('ASessions',"`Password` = '$password'");
            $na_codes = array();
            foreach($rs as $result){
                $na_codes[] = $result[4];
            }
            $rand =strtoupper(substr(uniqid('', true), -4));

            while(in_array($rand,$na_codes))
                $rand = strtoupper(substr(uniqid('', true), -4));
            $edited_entry = array();
            $edited_entry[] = $current_session[0];
            $edited_entry[] = $current_session[1];
            $edited_entry[] = $current_session[2];
            $edited_entry[] = $current_session[3];
            $edited_entry[] = $rand;
            $scs = $dbc->Edit('ASessions',$asession_id,$edited_entry);  
            Logger::WriteLines("Returning scs $scs and joincode ".($scs?$rand:"N/A"));
            return array("success"=>$scs,"joincode"=>($scs?strtoupper($rand):"N/A"));
        }else{
            return array("success"=>true,"joincode"=>$current_session[4]);
        }
    }

    private static function DeleteJoinCode($access_code){
        $dbc = new DBConnector();
        $rs = $dbc->getEntriesWhere('ASessions',"`Access_code` = '$access_code'")[0];
        $updated_entry = array();
        $updated_entry[] = $rs[0];
        $updated_entry[] = $rs[1];
        $updated_entry[] = $rs[2];
        $updated_entry[] = $rs[3];
        $updated_entry[] = ':NULL';
        return $dbc->Edit('ASessions',$rs[0],$updated_entry);
    }

}


class DBConnector{
    private  $connection;
    private static $host = 'www.remotemysql.com:3306';
    private static $user = 'g1kO1UFCRu';
    private static $pass = 'I9R2LtQaHz';

    //Testarea conexiunii la instantiere
    public function __construct(){
        $connection = new PDO("mysql:host=www.remotemysql.com:3306".";dbname=g1kO1UFCRu", 'g1kO1UFCRu', 'I9R2LtQaHz');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection = null;
    }
    //Functia ce returneaza numele tabelelor intr-un array
    //
    public function getTables(){
        try{
            $connection = new PDO("mysql:host=www.remotemysql.com:3306".";dbname=g1kO1UFCRu", 'g1kO1UFCRu', 'I9R2LtQaHz');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $connection->prepare('show tables');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_NUM);
        $arr = array();
        foreach($result as $res){
            array_push($arr,$res[0]);
        }$result = $arr;
        $connection = null;
       
        return $result;}
        catch(Exception $e){
       
            $connection = null;
            return array();
        }
    }


    public function getColumns($table){
        try{
            $connection = new PDO("mysql:host=www.remotemysql.com:3306".";dbname=g1kO1UFCRu", 'g1kO1UFCRu', 'I9R2LtQaHz');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $connection->prepare("DESCRIBE $table");
        $q->execute();
        $table_fields = $q->fetchAll(PDO::FETCH_NUM);
        $tbfs = array();
        foreach($table_fields as $table_field){
            array_push($tbfs,$table_field[0]);
        }
        return $tbfs;}
        catch(Exception $e){
            Logger::WriteLines($e);
            return array();
        }
    }
    //Functia ce returneaza toate intrarile din tabel
    public function getEntries($table){
        $connection = new PDO("mysql:host=www.remotemysql.com:3306".";dbname=g1kO1UFCRu", 'g1kO1UFCRu', 'I9R2LtQaHz');
       
        $stmt = $connection->prepare("SELECT * FROM ".$table); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        $connection = null;
        return $result;
    }
     //Functia ce returneaza toate intrarile din tabel pe baza unei conditii puse la apel
    public function getEntriesWhere($table,$condition){
        $connection = new PDO("mysql:host=www.remotemysql.com:3306".";dbname=g1kO1UFCRu", 'g1kO1UFCRu', 'I9R2LtQaHz');
        //`ASessions` WHERE `ASessions`.`Id` = '5d66b31484da6'
        $stmt = $connection->prepare("SELECT * FROM `$table` WHERE ".$condition); 
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        Logger::WriteLines("getEntriesWhere executed with sql: "."SELECT * FROM `$table` WHERE ".$condition,"Fetche the results ::",$result);
        $connection = null;
        return $result;
    }

    public function Add($table,$vals,$pk_inclusion = false){
        try{
            $connection = new PDO("mysql:host=www.remotemysql.com:3306".";dbname=g1kO1UFCRu", 'g1kO1UFCRu', 'I9R2LtQaHz');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO ".$table." (";
            $columns  = $this->getColumns($table);
            $counter = 1;
            foreach($columns as $column){
                if( $pk_inclusion || $counter != 1){
                $last_column = $counter < Count($columns)?false:true;
                if(!$last_column)
                    $sql = $sql.$column.", ";
                    else
                    $sql = $sql.$column.") ";
                }
                $counter++;    
            }
            $sql =$sql."VALUES (";
            $counter = 1;
            foreach($vals as $value){
                $last_val = $counter < Count($vals)?false:true;
                if(!$last_val)
                    $sql = $sql."'$value'".", ";
                    else
                    $sql = $sql."'$value'".")";
                $counter++;    
            }
            $sql = str_replace("':NULL'","NULL",$sql);
            Logger::WriteLines("sql after replace ",$sql);
            $prp = $connection->prepare($sql);
            //$prp->bindValue(':NULL', null, PDO::PARAM_INT);
           // Logger::WriteLines("sql object ".$sql);
            $prp->execute();
            Logger::WriteLines("DBC->Add executed:","SQL:",$sql,"Connection:",$sql);
            $connection = null;
            return true;
        }catch(PDOException $e){
            Logger::WriteLines($e);
            $connection = null;
            return false;
        }
    }
    //Stergerea unei intrari pe baza de ID
    public function Remove($table,$entry){
        try {
            $connection = new PDO("mysql:host=".$this::$host.";dbname=QTransfer", self::$user, self::$pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM $table WHERE id=$entry";
            $connection->exec($sql);
             return true;
            }
        catch(PDOException $e)
            {   
                return false;
            }
        
            $connection = null;
    }

    //Stergerea unei intrari pe baza de conditie pusa la apel
    public function RemoveWhere($table,$condition){
        try {
            $connection = new PDO("mysql:host=www.remotemysql.com:3306".";dbname=g1kO1UFCRu", 'g1kO1UFCRu', 'I9R2LtQaHz');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM $table WHERE ".$condition;
            $connection->exec($sql);
             return true;
        }
        catch(PDOException $e)
            {   
                return false;
            }
        
            $connection = null;
    }

    //
    public function Edit($table,$id,$updated_entry){
        if(strpos($table,"_") === false){   
        try {
            $connection = new PDO("mysql:host=www.remotemysql.com:3306".";dbname=g1kO1UFCRu", 'g1kO1UFCRu', 'I9R2LtQaHz');
             $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql ="UPDATE `$table` SET ";
            $columns  = $this->getColumns($table);
            $counter = 0;
            foreach($columns as $column){
            
                $last_column = $counter < Count($columns)-1?false:true;
                if(!$last_column)
                    $sql = $sql."`$column`"."= '".$updated_entry["$counter"]."', ";
                    else
                    $sql = $sql."`$column`"."= '".$updated_entry["$counter"]."' ";
                    $counter++;
                
            }
            $sql =$sql." WHERE `$table`.`$columns[0]` = "."'$id'";
            $sql = str_replace("':NULL'","NULL",$sql);
            Logger::WriteLines(" Editing entry with the following sql ",$sql);
            $connection->exec($sql);
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            return true;
        }catch(Exception $e)
            { Logger::WriteLines($e);
               return false;
            }
        }else{
            $tables = explode("_",$table);
            $val_count = 0;
            foreach($tables as $tbl){
                $columns = $this->getColumns($tbl);
                $partial_values = array();
                for($i =0;$i<Count($columns);$i++){
                    array_push($partial_values,$updated_entry[$val_count]);
                    $val_count++;
                }
                $this->Edit($tbl,$partial_values[0],$partial_values);
            }
            
        }
          $connection = null;
    }


}

class Logger{

    private static $MainLogFile = false;

    public function __construct(){

    }

    public static function init($req_id){
        Logger::$MainLogFile = !Logger::$MainLogFile?fopen("./logs/$req_id.txt","a"):Logger::$MainLogFile;
        Logger::WriteLines("Logger started with id $req_id");
    }
    public static function Write(){
        $date = new DateTime();
        $result = $date->format('Y-m-d H:i:s');
       $preline = $result." --> "; 
        while (! flock (Logger::$MainLogFile, LOCK_EX)) {
            usleep(500);
        }
        foreach (func_get_args() as $line) {
            
            fwrite(Logger::$MainLogFile,$preline.$line);
           
        }
        flock(Logger::$MainLogFile,LOCK_UN);
    }

    public static function WriteLines(){
        $date = new DateTime();
        $result = $date->format('Y-m-d H:i:s');
       $preline = $result." --> "; 
        while (! flock (Logger::$MainLogFile, LOCK_EX)) {
            usleep(500);
        }
        foreach (func_get_args() as $line) {
            if(is_iterable($line) && (is_array($line) || is_object($line)))
                $line = Logger::Recursive_ToString($line);
            fwrite(Logger::$MainLogFile,$preline.$line."\n");
           
        }
        flock(Logger::$MainLogFile,LOCK_UN);
    }

    public static function Append(){

        while (! flock (Logger::$MainLogFile, LOCK_EX)) {
            usleep(500);
        }
        foreach (func_get_args() as $line) {
            
            fwrite(Logger::$MainLogFile,$line);
           
        }
        flock(Logger::$MainLogFile,LOCK_UN);
    }

    public static function Write_R($array){
        Logger::WriteLines(Logger::Recursive_ToString($array));
    }

    private static function Recursive_ToString($element){
        $result = "";
        if(is_iterable($element)){
            $result = is_array($element)?"[":"{";
            $count = 0;
            foreach($element as $subelement){
                $result = $result.self::Recursive_ToString($subelement);
                if($count != count($element)-1 )
                    $result = $result.",";
            };
            $result = $result.(is_array($element)?"]":"}");
            return $result;
        }else 
            return $element;
        
    }

    public static function Shutdown(){
        
      if(Logger::$MainLogFile) fclose(Logger::$MainLogFile);
    }
    
}

?>