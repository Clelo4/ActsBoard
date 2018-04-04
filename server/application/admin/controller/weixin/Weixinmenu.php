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
		$access_token=get_access_token();
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
		$resultData=post_https($url,$param);
		return $resultData;
	}

	/**
	 * 从数据库中获取access_token;
	 */
	public function getAccessToken(){
		$result;
		// $ATModel = model('token.AccessToken');
		// $data=$ATModel->getAccessToken();
		$data=get_access_token();
		$result['data'] = $data;
		return resultArray($result);
	}
}
