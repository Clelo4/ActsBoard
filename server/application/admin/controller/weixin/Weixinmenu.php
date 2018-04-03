<?php

/**
*/

namespace app\admin\controller\weixin;

use app\admin\controller\ApiCommon;

class WeixinMenu extends ApiCommon{

	public function index(){
		return 'ok';
	}
	public function createWeixinMenu(){
		// $ATModel = model('token.AccessToken');
		// $access_token=$ATModel->getAccessToken();
		// 待发送的json格式数据
		$arr=array(
			'button'=>array(
				array(
				'type'=>'view',
				'name'=>'ActsBoard',
				'url'=>'http://music.163.com',
				'sub_button'=>[]
				),
				array(
					'type'=>'view',
					'name'=>'Acts11',
					'url'=>'http://music.163.com',
					'sub_button'=>[]
				),
					
			)
			);
		$param=json_encode($arr);

		// 	)
		// ));
		// 	{
        //     "button":[
        //         {
        //             "type": "view", 
        //             "name": "ActsBoard", 
        //             "url": "http://music.163.com", 
        //             "sub_button": [ ]
        //         }, 
        //         {
        //             "name": "MENU", 
        //             "sub_button": [
        //                 {
        //                     "type": "view", 
        //                     "name": "Bing", 
        //                     "url": "https://www.bing.com", 
        //                     "sub_button": [ ]
        //                 }, 
        //                 {
        //                     "type": "view", 
        //                     "name": "Video", 
        //                     "url": "http://v.qq.com", 
        //                     "sub_button": [ ]
        //                 }, 
        //                 {
        //                     "type": "scancode_push", 
        //                     "name": "scan", 
        //                     "key": "V_NAME_2", 
        //                     "sub_button": [ ]
        //                 }
        //             ]
        //         }
		//     ]
		// };

		$access_token="8_3meA3A8n9LvFGMxjsD-jwUbBxWfaqCwQBxVOSXZ4pCniZTGgDtEvDuJpN7xgEOCEMu-m_gN8bLjhRqvc2RQDPzxaqpDh4-R1jcAtoSdwHEdpgwer8n2ROM_SzzCBe5AwolLLkZEgRVRh1VRcOMTfACAWUB";
		$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token="+$access_token;
		$resultData=$this->postHttps($url,$arr);
		$result;
		$result['data']=$resultData;
		return resultArray($result);
	}

	public function getAccessToken(){
		$result;
		$ATModel = model('token.AccessToken');
		$data=$ATModel->getAccessToken();
		$result['data'] = $data;
		return resultArray($result);
	}

	// PHP 模拟发起post请求
	function postHttps($url, $param){
		// if(!is_array($param)){
		// 	throw new Exception("参数必须为array");
		// }
		$curl =curl_init($url);   // 启动一个CURL会话；
		curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
		// curl_setopt($curl,CURLOPT_HTTPHEADER,array(
		// 	'Content-Type: application/json',
		// 	'Content-Length: '.$param.lengt
		// ));
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);  // 对认证证书来源的检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);  // 从证书中检查SSL加密算法是否存在
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);	// 
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		curl_setopt($curl, CURLOPT_POST, 1);//设置为POST方式 
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($param));
		curl_setopt($curl,CURLOPT_TIMEOUT,30);          //设置超时
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);   // 获取的信息以文件流的形式返回
		curl_setopt($curl, CURLOPT_HEADER,1);
		$rst=curl_exec($curl);  // 执行操作
		if(curl_errno($curl)){
			return $rst;
		}
		curl_close($curl);
		return $rst;
	}

}
