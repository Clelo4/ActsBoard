<?php
/**
 * author: jack
 * email: clelo4@qq.com
 * 只有后台可以访问
 */

namespace app\admin\controller\weixin;
use app\admin\controller\AdminApiCommon;
use think\facade\Request;

class WeixinMenu extends AdminApiCommon{

	/**
	 * @category 创建自定义菜单
	 * @author jack <chengjunjie.jack@outlook.com>
	 * @return void
	 */
	public function createWeixinMenu(){
		$access_token=get_access_token();

		if (!$this->request->isPost()){
			return resultArray(['error' => '非法请求']);
		}

		$param = Request::post();
		// 替换param的数据，目前不接受来自请求的数据
		// 待发送的json格式数据---菜单
		$param=array(
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
		try{
			$resultData=post_https($url,$param);
			return $resultData;
		} catch(Exception $e){
			return resultArray(['error' => $e->getMessage()]);
		}
	}
}
