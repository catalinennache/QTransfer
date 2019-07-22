<?php
require "dbConnector.php";
class DashboardController{

    private static $SQLCon;

    //Instantierea Controllerului vine la pachet cu instantierea unui DataBaseConnector.
    //Acesta este un wrapper pentru clasa standard php PDO, care va implementa functiile de baza necesare
    //comunicarii corecte cu baza de date.
    public function __construct(){
        self::$SQLCon = new DBConnector("root","","localhost");
    }

    //Fiecare Controller are o actiune default ce este executata 
    //in cazul in care nu este specificata nici o alta actiune
    public function default($req){
        $model["tables"] = self::$SQLCon->getTables();
        return $model;
    }

    //Functie ce returneaza un array encodat, ce contine coloanele tabelului dat ca parametru
    public function getCol($req){
        try{
            if(strpos($req["table"],"_") === false){
        $results = self::$SQLCon->getColumns($req["table"]);
        // $results;
        header('Content-type: application/json');
        echo json_encode($results);}else{
            $results = array();
            $tables = explode("_",$req["table"]);
            foreach($tables as $table){
                $partial_result = self::$SQLCon->getColumns($table);
                foreach($partial_result as $res){
                    array_push($results,$res);
                }
            }

            header('Content-type: application/json');
            echo json_encode(($results));
        }
        }
        catch(Exception $e){
            print_r($e);
        }
    }
    
    //Functie ce returneaza intrarile unui tabel
    //Sau daca este o tabela de legatura va returna intrarile tabelelor referite
    public function View($req){
        try{
            if(strpos($req["table"],"_") === false){
                $results = self::$SQLCon->getEntries($req["table"]);
    
                $array["encoded"]= $results;
                header('Content-type: application/json');
                echo json_encode(($results));
        
            }else{
                $raw_results = self::$SQLCon->getEntries($req["table"]);
                $results = array();
                for($i = 0; $i<Count($raw_results);$i++){
                    $first = self::$SQLCon->getEntriesWhere("projects",'`projects`.`ID` = '.$raw_results[$i][1])[0];
                    $second = self::$SQLCon->getEntriesWhere("authors",'`authors`.`ID` = '.$raw_results[$i][2])[0];
                    foreach($second as $res){
                        array_push($first,$res);
                    }
                    array_push($results,$first);
                }
                header('Content-type: application/json');
                echo json_encode($results);
        }
        }catch(Exception $e){
            print_r($e);
        }

    }



    //Functia ce adauga in tabela data ca parametru
    //** Aceasta verifica daca autorul unei carti exista in DB
    // iar daca nu il va crea cu un minim de informatii
    // si va updata tabela relationala
    public function Add($req){
       try{ 
       $result = self::$SQLCon->Add($req["table"],$req["values"]);
       if($req["table"] == "projects" && $result === true){
           //Updating the corelational table
           $raw_authors = explode("&",$req["values"][1]);
           $authors = array();
           foreach($raw_authors as $author){
              foreach(explode(',',trim($author)) as $auth){
                  array_push($authors,$auth);
              };
           }
           foreach($authors as $author){
                $entr = self::$SQLCon->getEntriesWhere("authors","`authors`.`Name` = '".$author."' ");
                try{
                    if(!isset($entr[0][0]))
                      throw new Exception();
                }catch(Exception $e){
                    self::addMissingauthor($author);
                    $entr = self::$SQLCon->getEntriesWhere("authors","`authors`.`Name` = '".$author."' ");
                    print_r($entr);
                }
                $aid = $entr[0][0];
                $bid = self::$SQLCon->getEntriesWhere("projects","`projects`.`Title` = '".$req["values"][0]."'")[0][0];
                $this->Add(array("table"=>"projects_authors","values"=>array("projects_ID"=>$bid,"authors_ID"=>$aid)));
            }
       }
       header('Content-type: application/json');
       echo json_encode(array("success"=>$result));}
       catch(Exception $e){
           print_r($e);
       }
    }
    //Functia care sterge o intrare dintr-o tabela pe baza id-ului, ambele date ca parametru
    //Si care updateaza tabela relationala
    public function Remove($req){
       try{ 
       $result = self::$SQLCon->Remove($req["table"],$req["id"]);
       self::RemoveFromRelTable($req["table"],$req["id"]);
       header('Content-type: application/json');
       echo json_encode(array("success"=>$result));
       }catch(Exception $e){
           print_r($e);
       }
    }
    //Functia care editeaza o intrare dint-un tabel dat, pe baza id-ului
    public function Edit($req){
       $result = self::$SQLCon->Edit($req["table"],$req["id"],$req["values"]);
       header('Content-type: application/json');
       echo json_encode(array("success"=>$result));
    }

    private function RemoveFromRelTable($table,$id){
        self::$SQLCon->RemoveWhere("projects_authors","`$table"."_ID` = $id");
    }

    private function addMissingauthor($name){

        self::$SQLCon->Add("authors",array($name,"","",""));

    }
    
}

?>