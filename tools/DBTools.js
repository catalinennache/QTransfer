

module.exports = {
	 asyncQuery(sql,err_out){
		 var con = global.sql_connection;
		 if(con){
		  return  new Promise((resolve,reject)=>{
			con.query(sql,function(err,results){ 
				console.log(sql,err,results);
					if(!err){
						resolve(results);
					}else{
						err_out = err;
						resolve(undefined);
					}
			})})
		}	else
			throw new Error("Connection broken");
	}
}