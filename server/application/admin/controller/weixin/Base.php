<?php

namespace app\admin\controller\weixin;

use app\admin\controller\ApiCommon;
use think\facade\Request;
use think\Db;
class Base extends ApiCommon{

    static $appid="wxb569d7a3f448c503";
    static $secret="29938d5779d3dd83b9dab916f6e469d4";
    public function index(){
        return 'ok';
    }

    /** 
     * 服务器接收来自微信用户客户端的code，调用getAccessToken函数获得用户的openid
     * 服务器为微信用户设置永久cookie以保存openid
     */
    public function getCode(){
        // 微信客户端
        $result;

        $param=Request::post();
        if(isset($param['code'])){
            $code=$param['code'];
            $openid=$this->getAccessToken($code);
            if($openid){
                // 获取到了用户的openid
                // 在数据库创建创建用户，并返回用户的user_id
                $authKey = user_md5(date('Y-m-d').$openid); // 生成新的authKey
                $userModel = model('weixin.UserBase');
                $data=$userModel->userInfo($openid);
                
                $auth_key=Db::name('access_openid')->insert(['openid'=>$openid,'auth_key'=>$authKey]);
                if($auth_key){
                    // 设置cookie
                    cookie('openid',$openid,3600*24*30); // 有效期一个月
                    cookie('authKey',$authKey,3600*24*30); // 有效期一个月
                    cookie("_access",1,3600*24*30);
                    cookie("host","weixin",3600*24*30);
                    $result['data']=$data;
                    return resultArray($result);    
                }
            }
        }
        $result['error']="连接超时";
        cookie('_access',0);
        return resultArray($result);
        
        // 服务器
        
    }

    // 服务器通过code向微信服务器获取用户的access_token
    /**
     * @param $code string 微信客户端传回的code
     */
    private function getAccessToken($code){
        $getAccessToken="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".self::$appid."&secret=".self::$secret."&code=".$code."&grant_type=authorization_code";
        // 发起https的get请求
        $resultData=get_https($getAccessToken);
        $resultData=json_decode($resultData, true);
        if(isset($resultData['openid'])){
            return $resultData['openid'];
        } else{
            return false; 
        }
    }
}
