<?php
/**
 * author: jack
 * email: clelo4@qq.com
 * 只有后台可以访问
 */

namespace app\admin\controller\weixin;
use app\admin\controller\AdminApiCommon;

class WeixinMenu extends AdminApiCommon{

	public function index(){
		return 'ok';
	}

	/**
	 * @category 创建自定义菜单
	 * @author jack <chengjunjie.jack@outlook.com>
	 * @return void
	 */
	public function createWeixinMenu(){
		// $ATModel = model('token.AccessToken');
		// $access_token=$ATModel->getAccessToken();
		$access_token=get_access_token();
		// 待发送的json格式数据---菜单
		$arr=array(
			'button'=>array(
				array(
				'type'=>'view',
				'name'=>'大厅',
				'url'=>'http://web.iamxuyuan.com',
				'sub_button'=>[]
				),
				array(
					'type'=>'view',
					'name'=>'推荐',
					'url'=>'http://web.iamxuyuan.com',
					'sub_button'=>[]
				),
				array(
					'type'=>'view',
					'name'=>'设置',
					'url'=>'http://web.iamxuyuan.com',
					'sub_button'=>[]
				),		
			)
		);

		$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
		$resultData=post_https($url,$arr);
		return $resultData;
	}

	/**
	 * 从数据库中获取公众号的access_token;
	 */
	private function getAccessToken(){
		$result;
		// $ATModel = model('token.AccessToken');
		// $data=$ATModel->getAccessToken();
		$data=get_access_token();
		$result['data'] = $data;
		return resultArray($result);
	}
}
