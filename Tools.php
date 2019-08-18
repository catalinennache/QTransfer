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
        array_push($values,'-');
        $success = $dbc->Add('ASessions',$values);
        if($success){
           $result =  $dbc->getEntriesWhere('ASessions',"'Initiator_id' = ".session_id());
           $values = array();
           array_push($values,session_id());
           array_push($values,$result[0]['Id']);
           array_push($values,'-');
           $success = $dbc->Add('ASessions_Users',$values); 
        }
        return array('success'=>$success,'asession_id'=>$result[0]['Id']);
        
    }

    public static function checkAsession($asession_id,$initiator_id){

    }


}


class DBConnector{
    private  $connection;
    private static $host,$user,$pass;

    //Testarea conexiunii la instantiere
    public function __construct($user,$pass,$host){
        $connection = new PDO("mysql:host=".$host.";dbname=QTransfer", $user, $pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this::$host = $host;
        $this::$user = $user;
        $this::$pass = $pass;
        $connection = null;
    }
    //Functia ce returneaza numele tabelelor intr-un array
    //
    public function getTables(){
        try{
        $connection = new PDO("mysql:host=".$this::$host.";dbname=QTransfer", $this::$user, $this::$pass);
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
        $connection = new PDO("mysql:host=".$this::$host.";dbname=QTransfer", $this::$user, $this::$pass);
        $q = $connection->prepare("DESCRIBE $table");
        $q->execute();
        $table_fields = $q->fetchAll(PDO::FETCH_NUM);
        $tbfs = array();
        foreach($table_fields as $table_field){
            array_push($tbfs,$table_field[0]);
        }
        return $tbfs;}
        catch(Exception $e){
            print_r($e);
            return array();
        }
    }
    //Functia ce returneaza toate intrarile din tabel
    public function getEntries($table){
        $connection = new PDO("mysql:host=".$this::$host.";dbname=QTransfer", $this::$user, $this::$pass);
        $stmt = $connection->prepare("SELECT * FROM ".$table); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        $connection = null;
        return $result;
    }
     //Functia ce returneaza toate intrarile din tabel pe baza unei conditii puse la apel
    public function getEntriesWhere($table,$condition){
        $connection = new PDO("mysql:host=".$this::$host.";dbname=QTransfer", $this::$user, $this::$pass);
        $stmt = $connection->prepare("SELECT * FROM `$table` WHERE ".$condition); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $result = $stmt->fetchAll();
        $connection = null;
        return $result;
    }

    public function Add($table,$vals){
        try{
            $connection = new PDO("mysql:host=".$this::$host.";dbname=QTransfer", $this::$user, $this::$pass);
            $sql = "INSERT INTO ".$table." (";
            $columns  = $this->getColumns($table);
            $counter = 1;
            foreach($columns as $column){
                if($counter != 1){
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
            echo "exec ".$sql;
            $connection->prepare($sql);
            $connection->exec($sql);
            $connection = null;
            return true;
        }catch(PDOException $e){
            $connection = null;
            return false;
        }
    }
    //Stergerea unei intrari pe baza de ID
    public function Remove($table,$entry){
        try {
            $connection = new PDO("mysql:host=".$this::$host.";dbname=QTransfer", $this::$user, $this::$pass);
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
            $connection = new PDO("mysql:host=".$this::$host.";dbname=QTransfer", $this::$user, $this::$pass);
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
            $connection = new PDO("mysql:host=".$this::$host.";dbname=QTransfer", $this::$user, $this::$pass);
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
            $sql =$sql." WHERE `$table`.`ID` = "."$id";
            echo $sql;

            $connection->exec($sql);
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount()>0?true:false;
        }catch(Exception $e)
            { print_r($e);
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

?>