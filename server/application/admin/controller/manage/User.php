<?php
namespace app\admin\controller\weixin;

use app\admin\controller\AdminApiCommon;

class User extends AdminApiCommon{

    public function index(){
        return 'index';
    }

    /**
     * 从微信服务器获取用户的详细信息
     * 
     */
    public function getUserInfo(){
        $result;
        if(isset($this->param['user_id'])){
            $user_opendid=$this->param['user_id'];
            $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.get_access_token().'&openid='.$user_opendid;
            $data=get_https($url);
            $result['data']=$data;
            return resultArray($result);
        } else{
            $result['error']='参数错误';
            return resultArray($result);
        }
        
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
