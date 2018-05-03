var config=require('./config').wechat;  // 配置文件
const mysql=require("mysql");
const https=require("https");
const http = require('http');
var   type=2;
var   update_time=3600*1.5;
// 创建数据池


/**
 * 更新数据库的accessToken
 * @param {*} result 
 */
function saveResult(result){
	let connection=mysql.createConnection({
		host:"123.207.35.163",
		user:"root",
		password:"ehDj7997Dharma79.p69",
		database:"actsboard"
	});
	connection.connect();
	var sql="update access_token set access_token=\""+result+"\",create_time=now() where type="+type+" ;";
	connection.query(sql,function(err,result){
		 // 结束会话
		if(err) throw err;
		connection.end(); 
	});
}

/**
 * 第一次获取accessToken
 * 
 */
function firstGetAccessToken(){
	var url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid="+config["appid"]+"&secret="+config["appsecret"];
	try{
    https.get(url,(res)=>{
		var data="";
		res.on('data',(d)=>{
			data+=d.toString("ascii");}
		);
		res.on("end",()=>{
			var result=JSON.parse(data).access_token;
			saveResult(result);
		});
	});
	http.get("http://web.iamxuyuan.com/weixin/flashjsapi?jackhellofucksfjsgjlrjlfjld=dfjdlfjdljfdl",(res)=>{
    });
	console.log('第一次结束');
    }
    catch (e){ 
    console.log('第一次出现异常');
    }
}

firstGetAccessToken();

setInterval(function(){
	var url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid="+config["appid"]+"&secret="+config["appsecret"];
	try{
    https.get(url,(res)=>{
		var data="";
		res.on('data',(d)=>{
			data+=d.toString("ascii");}
		);
		res.on("end",()=>{
			var result=JSON.parse(data).access_token;
			saveResult(result);
		});
	});
    http.get("http://web.iamxuyuan.com/weixin/flashjsapi?jackhellofucksfjsgjlrjlfjld=dfjdlfjdljfdl",(res)=>{
    });
	console.log("ok");
    }
    catch (e){
    console.log("出现异常");
    }

},1000*update_time);
