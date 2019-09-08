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

           $model['content'] =  Procedures::GetAsessionClipContent($_SESSION['asession_id']);
            return $model;

        }else Kernel::Redirect("QuickTransfer/");
    

    }


    public function create($req){
        $model = new JsonResult();
        $password = $req['password'];
        $cpassword = $req['cpassword'];

        if($password == $cpassword && !isset($_SESSION['asession_id'])){
            
           $model['redirect']='Session';
           $result = Procedures::createAsession($password);
           if($result['success']){
                $_SESSION['asession_id'] =$result['asession_id'];
                Logger::WriteLines("Session created with pass $password and id ".$result['asession_id'],"over");
            }
        }else if(isset($_SESSION['asession_id'])) Kernel::throwException('Unauthorized');
        return $model;
    }

    public function AddClip($req){
        $model = new JsonResult();
        if(isset($_SESSION['asession_id'])){
            $result = Procedures::checkAsession($_SESSION['asession_id'],session_id());
            if(!$result) Kernel::throwException('Unauthorized');

            $title= $req['title'];
            $text=$req['content'];
            $preview=$req['content'];
            $model['success'] = Procedures::AddAsessionClip($_SESSION['asession_id'],$title,$text,$preview);

        }else{
            Kernel::throwException('Unauthorized');
        }

        return $model;
    }

    public function Join($req){
        $model = new JsonResult();
        $model->Clean();
        $access_code = $req['code'];
        $pass = $req['password'];
        $model['success'] = false;
        if(isset($access_code,$pass)){
            $result = Procedures::JoinAsession(session_id(),$access_code,$pass);
            Logger::WriteLines(" received from Procedures-> JoinAsession the following result : ",$result);
            if(isset($result['success']) && $result['success'] == true){
                Logger::WriteLines("Entered the scs branch");
                $model['success'] = true;
                $_SESSION['asession_id'] = $result['asession_id'];
                $model['redirect'] = "Session";
            }
        }
        
        return $model;
        
    }

    public function GetClipContent($req){
        $model = new JsonResult(true);
        $model->Clean();
        if(isset($_SESSION['asession_id']) && isset($req['cid'])){
            $result = Procedures::checkAsession($_SESSION['asession_id'],session_id());
            if(!$result) Kernel::throwException('Unauthorized');

           $results = Procedures::GetAsessionClipContentByCID($_SESSION['asession_id'],$req['cid']);
           if(count($results) > 0)
                $model['content']=$results[0][4];
            
            $model['success'] = (count($results) > 0);
        }else
            Kernel::throwException('Unauthorized');
            
        return $model;    
    }

}


?>