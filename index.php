<?php
session_start();
require 'Tools.php';
Logger::init(session_id());
require 'kernel.php';
try{
    // Verifica daca request-ul este valid   
    //Kernel::SecurityCheck($_REQUEST);
    //Detecteaza Controllerul si actiunea ce trebuie executata, in functie de url                
    $result = Kernel::DetectEnvironment(); 
    $controller = $result["controller"];
    $action = $result["action"];
    try{
        //Declanseaza ruta detectata, in caz ca este inexistenta declanseaza ruta interna pentru eroarea 404
        Kernel::FireupRoute($controller,$action,$_REQUEST);
    }catch(UnresolvedRouteException $e){
        if(strpos($controller,'Assets')!== false && false){
            $temp = explode("QuickTransfer",$_SERVER['REQUEST_URI']); //$temp <- [ "localhost/","/Dashboard/View" ]
     
           $temp = trim($temp[count($temp)-1],"/");
           require_once $temp;
        }else{
        Logger::WriteLines("****EXCEPTION****",$e);
        Kernel::FireupInternalRoute("HTTP404");}
    }
    
}catch(UnauthorizedException $e){
    Logger::WriteLines("****EXCEPTION****",$e);
    http_response_code(401);
}

Logger::WriteLines("Request finished, shuttting down the logger\n");
Logger::shutdown();
?>