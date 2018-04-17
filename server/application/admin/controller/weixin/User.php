<?php
namespace app\admin\controller\manage;

use app\admin\controller\AdminApiCommon;
use app\admin\model\weixin\UserManage;

class User extends AdminApiCommon{

    /**
     * 从微信服务器获取用户的详细信息
     * @author jack <chengjunjie.jack@outlook.com>
     */
    public function getUserInfo(){
        $result;
        if(!isset($this->param['user_id'])){
            $result['error']='参数错误';
            return resultArray($result);
        }
            
        $openid=$this->param['user_id'];
        $model = Model('weixin.UserManage');
        $userInfo = $model->userInfo($openid);
        if(!$userInfo){
            return resultArray(['error'=>$model->getError()]);
        }
        return resultArray(['data' => $userInfo]);
    }

    /**
     * 获取关注者列表
     * @param $next_opendid  string  获取关注用户列表偏移量，不填默认从头开始拉取 (可选参数)
     */
    public function getFollower($next_opendid=''){
        $result;
        $url='https://api.weixin.qq.com/cgi-bin/user/get?access_token='.get_access_token().'&next_openid='.$next_opendid;
        $data=get_https($url);
        $result['data']=$data;
        return resultArray($result);
    }

}
