<?php
include_once 'ResultClasses.php';
class HomeController{

    public function __construct(){

        
    }

    public function default(){
        $model = new ModelResult();
        $model['asession_avb'] = isset($_SESSION['asession_id']);
        return $model;
    }

}


?>