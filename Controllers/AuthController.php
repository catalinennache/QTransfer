<?php

class AuthController{
    public function __construct(){

    }

    public function default($req){
        
        if(!isset($_COOKIE['php_authcookie']) && isset($req["user"]) && isset($req["password"]) && strlen($req["user"])>0 && strlen($req["password"])>0){
            setcookie("php_authcookie","asfa",time()+180);
            if(self::test_Connection("ASd","asg")){
                header("Location: http://".Kernel::GetRoot()."index.php/Dashboard");
            }
        }else{
            echo !isset($_COOKIE['php_authcookie']);
            echo  isset($req["user"]);
            echo isset($req["password"]);
        }
        return array("message"=>"YOLO");
    }

    private function test_Connection($user,$password){
        return true;
    }
   
}

?>