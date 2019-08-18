<?php
include_once 'ResultClasses.php';
include_once 'Tools.php';

class SessionController{

    public function __construct(){

        
    }

    public function default(){
        $model = new ModelResult();
       
        $exists = Procedures::checkAsession($_SESSION['asession_id'], session_id());
        if($exists){
            
        }
        return $model;
    }


    public function create($req){
        $result = new JsonResult();
        $password = $req['password'];
        $cpassword = $rea['password'];

        if($password == $cpassword){
            
            $result['redirect']='Session';
           $result = Procedures::createAsession($password);
           if($result['success']){
                $_SESSION['asession_id'] =$result['asession_id'];
            }
        }
        return $result;
    }

    public function Join($req){
        $access_code = $req['access_code'];

        
    }

}


?>