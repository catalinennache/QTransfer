var dbtools = require('./DBTools');
var cryptok = require('./CryptoK');



module.exports = {

  
    checkBeforeCreate(req){
        
        return req.body.password !== undefined && req.body.password.length > 0 && req.body.password === req.body.cpassword
                && req.session.asession_id === undefined && req.session.user_id === undefined;
    },
    createAsession(pass){
       return new Promise(function(resolve,reject){ 
       var db =  global.sql_connection;
       var asession_id =  global.cryptok.generateRandomASCII(128);
       console.log(asession_id.length);
       var sql = "INSERT INTO asessions (asession_id, password) VALUES ('"+asession_id+"','"+pass+"')";
       value = [asession_id,pass]; //id, asession_id,pass,joincode
       db.query(sql, function (err, result) {
                if (err){
                    console.log(err);
                     resolve({success:false});
                }
                resolve({
                    asession_id:asession_id,
                    success: result.affectedRows > 0
                });
       }.bind(resolve));
    })

    },

    joinAsession(join_code,pass){
        return new Promise(function(resolve,reject){ 
            var db =  global.sql_connection;
            var sql = "select asession_id from asessions where join_code = '"+join_code+"' and password = '"+pass+"'";
            console.log(sql);
            db.query(sql,function(err,results){
                
                 if(err) resolve({success:false});
              
                 var model  = {success:!!results[0],result:(!!results[0]?results[0].asession_id:-1)}
                 resolve(model);

                 
            });
        });
    },

    useAsessionJoinCode(code){
        var db =  global.sql_connection;
        var sql = "update asessions set join_code = NULL where join_code = '"+code+"'";
        db.query(sql,function(err,results){

        })
    },

    getAsessionPK(aid){
      return  new Promise((resolve,reject)=>{
            var con =  global.sql_connection;
            var sql = "select id from asessions where asession_id = '"+aid+"'";
            con.query(sql,function(err,results){
                    if(!err)
                        resolve(results[0].id);
                        else
                        reject(err);
            })});
    },


    getSessionRawMeta(aid){
        return new Promise((resolve,reject)=>{
        this.getAsessionPK(aid).then(function(pk){
                var con =  global.sql_connection;
                var sql = "select * from asession_contents where asession_pk = '"+pk+"'";
                con.query(sql,function(err,results){
                    console.log(err,results,sql);
                    if(!err)
                        resolve(results);
                    else
                        reject(err);
                })
            })
        });
    },

    vaidateRequest(req){
        return (req.session.asession_id !== undefined && req.session.user_id === undefined)||req.url.endsWith('/Create') || req.url.endsWith('/Join');
    },

  async getJoinCode(aid){
        var sql = "select join_code from asessions where asession_id = '"+aid+"'";
        var err = "";


        try{
            var result = await dbtools.asyncQuery(sql,err);
        }catch(e){
            console.log(e);
            return {success:false,joincode:undefined};
        }

        


        if(result === undefined || result.length == 0 || result[0].join_code == null){
            console.log("Failed to retrieve the joincode",err.length === 0?"Couldn't finde the session":err);
           // return {success:false,joincode:undefined};
        }else{
            return {success:true,joincode:result[0].join_code};
        }



          sql = "select password from asessions where asession_id = '"+aid+"'";
          err = "";
         try{
             var result = await dbtools.asyncQuery(sql,err);
         }catch(e){
             console.log(e);
             return {success:false,joincode:undefined};
         }
         if(result === undefined || result.length == 0){
             console.log("Failed to retrieve the password",err.length === 0?"Couldn't finde the session":err);
             return {success:false,joincode:undefined};
         }

         var pass = result[0]['password'];
         
         sql = "select join_code from asessions where password = '"+pass+"'";
         err = "";
        var existent_joincodes_for_givenpass = await dbtools.asyncQuery(sql,err);
        if(existent_joincodes_for_givenpass === undefined || existent_joincodes_for_givenpass.length===0){
            existent_joincodes_for_givenpass = [];
        }else{
            existent_joincodes_for_givenpass = Array.from(existent_joincodes_for_givenpass).map(element=>{return element.joincode})
        }

        var attempt = global.cryptok.generateRandomASCII(4);
        while(existent_joincodes_for_givenpass.indexOf(attempt)>0){
            attempt = global.cryptok.generateRandomASCII(4);
        }

        console.log("attempt ",attempt);

        sql = "update asessions set join_code = '"+attempt+"' where asession_id = '"+aid+"'";
        err = "";
        try{  await dbtools.asyncQuery(sql,err);  }catch(e){
            console.log(e);
            return {success:false,joincode:undefined};
        }

        return {success:true,joincode:attempt};

    },

    GetClipContent(asession_id,cid){
        return new Promise((resolve,reject)=>{
                this.getAsessionPK(asession_id).then(function(pk){
                    var con =  global.sql_connection;
                    var sql = "select clipcontent from asession_contents where asession_pk = '"+pk+"' and id = '"+cid+"'";
                    con.query(sql,function(err,results){
                            if(!err){
                                var content = results[0]?results[0].clipcontent:undefined;
                                resolve(content);
                            }
                                else{
                                resolve(null);
                                console.log(err);
                            }
                        });
                    });
                })
            
        
    },

   async DeleteContent(cid){
                var err = "";
                var rez = await dbtools.asyncQuery("select * from asession_contents where id = '"+cid+"'");
                console.log(rez);
                if(rez[0].file_path){
                    var fs = require('fs');
                    fs.unlinkSync('./asession_uploads/'+rez[0].file_path);
                }
                await dbtools.asyncQuery("delete from asession_contents where id = '"+cid+"'",err);
                return {success:true};
    },

    AddClip(asession_id,title,content,preview){
        return new Promise(async(resolve,reject)=>{
        this.getAsessionPK(asession_id).then(async pk=>{
            var sql = "insert into asession_contents (asession_pk,title,clipcontent) values ('"+pk+"','"+title+"','"+content+"')";
            var result = await dbtools.asyncQuery(sql);
            if(result && result.insertId)
                resolve(result.insertId);
                else
                resolve(undefined);
            })
        })
    },

    AddFile(asession_id,title,fileName){
        return new Promise(async(resolve,reject)=>{
            this.getAsessionPK(asession_id).then(async pk=>{
                var fileCode = cryptok.generateRandomASCII(32);
                var sql = "insert into asession_contents (asession_pk,title,file_path,file_name) values ('"+pk+"','"+title+"','"+fileCode+"','"+fileName+"')";
                var result = await dbtools.asyncQuery(sql);
                if(result && result.insertId)
                    resolve({id:result.insertId,fileCode:fileCode});
                    else
                    resolve(undefined);
                })
            })
    },
    getFile(id){
        return new Promise(async(resolve,reject)=>{ 
            var sql = "select file_path,file_name from asession_contents where id = '"+id+"'";
            console.log(sql);
            var result = await dbtools.asyncQuery(sql);
            console.log(result);
            if(result && result[0]){
                resolve(result[0]);
            }else
                resolve(undefined);
        
        })
    }


    



}