<?php
include_once 'ResultClasses.php';
class HomeController{

    public function __construct(){

        
    }

    public function default(){
        $model = new ModelResult();
     
        return $model;
    }

}


?>