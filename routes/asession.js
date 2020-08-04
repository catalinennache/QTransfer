
var express = require('express');
var asession_helper = require('../tools/ASession');
var router = express.Router();


router.get('/', function(req, res, next) {

    res.render('ASession', { title: 'Express', asession_avb:(req.session.asession_id !== undefined)});
});

router.post('/Create',async function(req,res,next){
    var pass = req.body.password;
    console.log(req.body);
    var model = {};
    if(asession_helper.checkBeforeCreate(req)){
      
       var result = await asession_helper.createAsession(pass);
       model.success = result.success;

       if(result.success){
           model.redirect = "/ASession";
           req.session.asession_id = result.asession_id;
           console.log("Asession created!");
           req.session.save();
       }
    }
 
    res.setHeader('Content-Type', 'application/json');
    res.send(JSON.stringify(model));
    res.end();
 })
 
 router.post('/Join',async function(req,res,next){
     
     var code = req.body.code;
     var pass = req.body.password;

    var result = await  asession_helper.joinAsession(code,pass);

    var model = {success:result.success}

    if(result.success){
        req.session.asession_id = result.result;
        console.log(result);
        model.redirect = "/Asession";
        asession_helper.useAsessionJoinCode(code);
        req.session.save();
        console.log(req.session);
    }
    
  
    res.setHeader('Content-Type', 'application/json');
    res.send(JSON.stringify(model));
    res.end();
 });

 router.post('/GetMetadata',async function(req,res,next){
    var asession_id = req.session.asession_id;
    var rawmetadata = await asession_helper.getSessionRawMeta(asession_id);
    var model = {};
    model.cards = rawmetadata.map(function(data,index){

        let card = {};
        card.id = data.id;
        card.type = data.clipcontent?"Clipboard":"File";
        card.title = data.title;
        card.content = data.clipcontent;
        card.file = data.file_path;
        return card;
    });



    res.setHeader('Content-Type', 'application/json');
    res.send(JSON.stringify(model));
    res.end();
 })

 router.post('/GetJoinCode',async function(req,response,next){
    
    if(asession_helper.vaidateRequest(req)){
        var model = {}
        var res = await asession_helper.getJoinCode(req.session.asession_id);
        console.log(res);
        model.success = res.success;
        model.joincode = res.joincode;
        response.setHeader('Content-Type', 'application/json');
        response.send(JSON.stringify(model));
        response.end();
    }
 })

 router.post('/Signout',async function(req,res,next){
        
        var model = await asession_helper.getJoinCode(req.session.asession_id);
        req.session.asession_id = undefined;
        res.setHeader('Content-Type', 'application/json');
        res.send(JSON.stringify({success:model.success,joincode:model.joincode}));
        res.end();

 });

 router.post('/GetClipContent',async function(req,res,next){
    if(req.body.cid){
        var model = {};
        var result = await asession_helper.GetClipContent(req.session.asession_id,req.body.cid);
        model.success = (result !== undefined && result != null)
        model.content = result;
        res.setHeader('Content-Type', 'application/json');
        res.send(JSON.stringify(model));
        res.end();        
    }else{
        res.sendStatus(400);
        res.end();
    }
 });

 router.post('/DeleteContent',function(req,res,next){
        if(req.body.cid){
        try{  asession_helper.DeleteContent(req.body.cid);
            res.setHeader('Content-Type', 'application/json');
            res.send(JSON.stringify({success:true}));
            res.end(); 
        } catch(e){
            res.setHeader('Content-Type', 'application/json');
            res.send(JSON.stringify({success:false}));
            res.end(); 
          }
        }
 });

 router.post('/AddClip',async function(req,res,next){
        var model = {};
        if(req.body.title && req.body.content){
           model.id = await asession_helper.AddClip(req.session.asession_id,req.body.title,req.body.content);
          
           model.type = "Clipboard";
           model.title = req.body.title;
           model.content = req.body.content;
           model.file = undefined;
           
           model.success = true;
        }else{
            model.success = false;
        }
        res.setHeader('Content-Type', 'application/json');
        res.send(JSON.stringify(model));
        res.end(); 


 });

 router.post('/AddFile',async function(req,res,next){
    var model = {success:false};
    if(asession_helper.vaidateRequest(req)){
        console.log(req.files.file.name,req.files.file.size);
      
        rez = await asession_helper.AddFile(req.session.asession_id,req.body.title,req.files.file.name);
        if(rez){
            model = {};
            model.success = (rez!==undefined);
            model.id = rez.id;
           // console.log(model);
            model.type = "File";
            model.title = req.body.title;
            //model.content = req.body.content;
            //model.file = undefined;
            
            req.files.file.mv('./asession_uploads/'+rez.fileCode,function(){
                
            });

        }
    }

    res.setHeader('Content-Type', 'application/json');
    res.send(JSON.stringify(model));
    res.end();
 });
 router.get('/Download',async function(req,res,next){
    if(asession_helper.vaidateRequest(req)){
      var info =  await asession_helper.getFile(req.query.ref);
      console.log(info);
      if(info)
        res.download("./asession_uploads/"+info.file_path,info.file_name);
    }
 })
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
 */


module.exports = router