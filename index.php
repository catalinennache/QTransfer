<?php
session_start();
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
    }catch(Exception $e){
        if(strpos($controller,'Assets')!== false){
            $temp = explode("QuickTransfer",$_SERVER['REQUEST_URI']); //$temp <- [ "localhost/","/Dashboard/View" ]
     
           $temp = trim($temp[count($temp)-1],"/");
            require_once $temp;
        }else{
        print_r($e);
        Kernel::FireupInternalRoute("HTTP404");}
    }
    
}catch(OutOfBoundsException $e){
    //Afiseaza eroarea cu privire la faptul ca site-ul este proiectat sa ruleze in index.php
    Kernel::FireupInternalRoute("bounds_exceeded");
}

?>