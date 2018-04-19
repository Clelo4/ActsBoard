<?php

namespace app\admin\controller\user;

use think\facade\Request;
use think\Db;
use think\Validate;

/**
 * 验证微信用户的基础类
 * @author jack <chengjunjie.jack@outlook.com>
 */
class Base {

    static $appid="wxb569d7a3f448c503";
    static $secret="29938d5779d3dd83b9dab916f6e469d4";

    /** 
     * 服务器接收来自微信用户客户端的code，调用getAccessToken函数获得用户的openid
     * 服务器为微信用户设置永久cookie以保存openid
     * 服务器不保存session缓存，但在数据库中保存openid和authKey(验证用户身份)
     */
    public function getCode(){
        // 如果不为post请求，放回空
        if (!$this->request->isPost()){
            return ;
        }
        // 微信客户端
        $result;
        $param=Request::post();

        // 验证code
        $validate = Validate::make(['code' => 'require'],['code' => 'code错误']);
        if (!$validate->check($param)){
            return resultArray(['error' => $validate->getError()]);
        }

        $openid=$this->getAccessToken($param['code']);
        if($openid){
            // 获取到了用户的openid
            // 在数据库创建创建用户，并返回用户的user_id
            $authKey = user_md5(date('YmdHms').$openid); // 生成新的authKey
            $userModel = model('weixin.UserManage');
            $data=$userModel->userInfo($openid);
            $auth_key=1;
            if(Db::name('access_openid')->where('openid',$openid)->find()){
                Db::name('access_openid')->where('openid',$openid)->update(['auth_key'=>$authKey]);
            } else{
                $auth_key=Db::name('access_openid')->insert(['openid'=>$openid,'auth_key'=>$authKey]);
            }
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
        $result['error']="连接超时";
        cookie('_access',0);
        return resultArray($result);
        
        // 服务器
        
    }

    /**
     * 服务器通过code向微信服务器获取用户的access_token
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
