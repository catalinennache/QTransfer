<?php


 class Kernel {
     private static $uniqInstance = true;
     private static $root;
 
     private function __construct(){
     }
      
    public static function Redirect($location){
      header("Location:http://".Kernel::GetRoot()."index.php/".$location);
    }
    
       //Verifica daca URL-ul contine index.php
    public static function SecurityCheck($req){
       if(strpos($_SERVER['REQUEST_URI'], 'index.php') === false){
           throw new OutOfBoundsException();
       }
     }

     //Declansarea rutei de executie (Instantierea Controllerului vizat si executarea actiunii cerute)
    public static function FireupRoute($controller,$action,$req){
        $view = $controller."View";
        $controller = $controller."Controller";
        //Pe baza design pattern-ului Model View Controller, Controller-ul va returna un model care mai
        //apoi va fi folosit la schitarea paginii
        $model = Kernel::execute($controller,$action,$req);
        if($model){
            Kernel::renderPage($model,$view);
        }
        //-----
     }
     
     //Instantierea si folosirea controllerului
    private static function execute($controller,$action,$req){
        Kernel::importController($controller);
        $ctrl = new $controller();
        if(method_exists($ctrl,$action)){
            $model = $ctrl->$action($req);
            return $model;
        }else{
            throw new Exception("Action not found");
        }
    }


     //Declansarea unei rute de executie interna, in caz ca exista o eroare 5xx sau 4xx
     public static function FireupInternalRoute($action){
        require 'Controllers/System.php';
        $sys = new SystemController();
        $sys->$action();
     }
     
     
    private static function renderPage($model,$view){
         $root = Kernel::GetRoot();
         require './Views/'.$view.'/'.$view.'.html';
     }

    private static function importController($name){
        if (!file_exists('./Controllers/'.$name.'.php'))
            throw new Exception ('Controller does not exist');
            else
            require ('./Controllers/'.$name.'.php'); 
    }
    
    ////Detecteaza Controllerul si actiunea ce trebuie executata, in functie de url   
    public static function DetectEnvironment(){
        //Example URL: localhost/index.php/Dashboard/View
        $temp = explode("QuickTransfer",$_SERVER['REQUEST_URI']); //$temp <- [ "localhost/","/Dashboard/View" ]
        Kernel::SetRoot($_SERVER["HTTP_HOST"].$temp[0]);
        $temp = trim($temp[count($temp)-1],"/"); // $temp <- "Dashboard/View"
        $temp = explode("/",$temp); // $temp <- ["Dashboard", "View"]
        $detected_controller = isset($temp[0])&&strlen($temp[0])>0?$temp[0]:"Home"; // daca nu este prezenta nicio adresa de controller,
                                                                                        // cel default va fi alocat
        $detected_action = count($temp)>1 && isset($temp[1]) && strlen($temp[1]) > 0 ? $temp[1]:'default'; // analog cu linia de atribuire a
                                                                                                           // controllerului
        
        return array("controller"=>$detected_controller,"action"=>$detected_action);
    }

    private static function SetRoot($root){
        if(!isset(Kernel::$root) || strlen(Kernel::$root)<1){
            Kernel::$root = $root;
        }
    }
    public static function GetRoot(){
        return Kernel::$root;
    }
 }
 ?>
