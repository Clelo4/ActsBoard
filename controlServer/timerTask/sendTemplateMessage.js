var config=require('./config').wechat_test;  // 配置文件
const https=require("https");
const http = require('http');
const querystring = require('querystring');
var   type=2;
var   update_time=60*5;
// 创建数据池

const options = {
	method:'POST',
	hostname:"web.iamxuyuan.com",
	path:"/manage/weixin/sendalltemplatemessage",
};
const postData = querystring.stringify(config.wechat);

/**
 * 第一次获取accessToken
 * 
 */
function sendTemplateMessage(){
	try{
		var req = http.request(options,(res)=>{
            var data="";
			res.on('data',(d)=>{
				data+=d.toString("ascii");}
			);
			res.on("end",()=>{
				var result=JSON.parse(data).errcode;
				if(result == 0){
					console.log("success");
				}
			});
		});
		req.write(postData);
		req.end(0);
		console.log('第一次结束');
    }
    catch (e){
    	console.log('第一次出现异常');
    }
}

sendTemplateMessage();

setInterval(function(){
    sendTemplateMessage();
},1000*update_time);
