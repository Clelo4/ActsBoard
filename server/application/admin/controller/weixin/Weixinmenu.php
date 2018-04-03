<?php

/**
*/

namespace app\admin\controller\weixin;

use app\admin\controller\ApiCommon;

class WeixinMenu extends ApiCommon{

	public function index(){
		return 'ok';
	}


	// PHP 模拟发起post请求
	// @param json格式  发送的数据
	function postHttps($url, $param){
		$curl = curl_init(); // 启动一个CURL会话
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		curl_setopt($curl, CURLOPT_POST, 1);//设置为POST方式 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
		curl_setopt($curl, CURLOPT_TIMEOUT,30);          //设置超时
		$rst=curl_exec($curl);  // 执行操作
		curl_close($curl);
		return $rst;
	}

	public function createWeixinMenu(){
		$ATModel = model('token.AccessToken');
		$access_token=$ATModel->getAccessToken();

		// 待发送的json格式数据---菜单
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
					'name'=>'Acts111',
					'url'=>'http://music.163.com',
					'sub_button'=>[]
				),		
			)
		);
		$param=json_encode($arr);

		$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
		$resultData=$this->postHttps($url,$param);
		return $resultData;
	}

	/**
	 * 从数据库中获取access_token;
	 */
	public function getAccessToken(){
		$result;
		$ATModel = model('token.AccessToken');
		$data=$ATModel->getAccessToken();
		$result['data'] = $data;
		return resultArray($result);
	}
}
