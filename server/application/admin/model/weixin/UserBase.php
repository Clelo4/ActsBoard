<?php
/**
 * author: jack
 */
namespace app\admin\model\weixin;

use app\admin\model\Common;

class UserBase extends Common{
    protected $name = 'user';

    // /**
    //  * 查询用户的基本信息，如果不存在就创建一个新的用户user_id
    //  * @return openid 用户的openid
    //  */
    public function userInfo($openid){
        $data=$this->where('openid',$openid)->find();
        if(!$data){
            // 用户不存在，创建微信用户
            // $userdata=$this->getUserInfo($openid);
            $userData=$this->getUserInfo($openid);
            $userData=json_decode($userData, true);
            $insertResult=$this->insert($userData);
            if(!$insertResult){
                return false;
            }
        }
        return $openid;
    }

    /**
     * 从微信服务器获取用户的详细信息
     * @param openid 用户的openid
     */
    public function getUserInfo($openid){
        $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.get_access_token().'&openid='.$openid;
        $data=get_https($url);
        return $data;
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