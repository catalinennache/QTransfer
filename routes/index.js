var express = require('express');
var asession_helper = require('../tools/ASession');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
    console.log(req.session);
    console.log(req.session.test);
    req.session.test = "merge";
  res.render('Home', { title: 'Express', asession_avb:(req.session.asession_id !== undefined)});
});





module.exports = router;

/*
        res.setHeader('Content-Type', 'application/json');
        res.send(JSON.stringify({ available: e.ok , message: dict['sucode']['1'] }));
        res.end();

*/

/*

 public function AddClip($req){
        $model = new JsonResult();
        if(isset($_SESSION['asession_id'])){
            $result = Procedures::checkAsession($_SESSION['asession_id'],session_id());
            if(!$result) Kernel::throwException('Unauthorized');

            $title= $req['title'];
            $text=$req['content'];
            $preview=$req['content'];
            $result = Procedures::AddAsessionClip($_SESSION['asession_id'],$title,$text,$preview);
            $model['success'] = $result['success'];
            $model['cid'] = $result['cid'];

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
            $result = Procedures::AddAsessionClip($_SESSION['asession_id'],$title,$text,$preview);
            $model['success'] = $result['success'];
            $model['cid'] = $result['cid'];

        }else{
            Kernel::throwException('Unauthorized');
        }

        return $model;
    }

    public function RequestDownload($req){

    }

    public function AddFile($req){
        $model = new JsonResult();
        $model->Clean();
        if(!isset($_SESSION['asession']) || !Procedures::checkAsession($_SESSION['asession_id'],session_id()))
            Kernel::throwException('Unauthorized');
        

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

    public function DeleteContent($req){
        $model = new JsonResult();
        $model->Clean();
        if(isset($_SESSION['asession_id']) && isset($req['cid'])){
            $result = Procedures::checkAsession($_SESSION['asession_id'],session_id());
            if(!$result) Kernel::throwException('Unauthorized');

           $scs = Procedures::DeleteContent($req['cid']);
            
            $model['success'] = $scs;
        }else
            Kernel::throwException('Unauthorized');
            
        return $model;    
    }


    public function GetJoinCode($req){
        $model = new JsonResult();
        $model->Clean();
        if(!isset($_SESSION['asession_id']) || !Procedures::checkAsession($_SESSION['asession_id'],session_id()))
            Kernel::throwException('Unauthorized');
        $result = Procedures::GetJoinCode($_SESSION['asession_id']);  
        $model['success'] = $result['success'];
        $model['joincode'] = $result['joincode'];
        
        return $model;
    }

    public function Signout($req){
        $model = new JsonResult();
        $model->Clean();
        if(!isset($_SESSION['asession_id']) || !Procedures::checkAsession($_SESSION['asession_id'],session_id()))
            Kernel::throwException('Unauthorized');
        $virtual_model = $this->GetJoinCode($req);    
        $result = Procedures::SignoutAsession($_SESSION['asession_id'],session_id());
        if($result)
            unset($_SESSION['asession_id']);
        $model['success'] = $result && $virtual_model['success'];
        $model['joincode'] = $virtual_model['joincode'];
        return $model;    
    }

}



*/
