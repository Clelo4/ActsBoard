<?php
namespace app\admin\controller\user;
use app\admin\controller\ApiCommon;
use app\admin\model\weixin\UserManage;
use think\facade\Request;
use think\Validate;
use think\facade\Config;

class GetUserInfo extends ApiCommon{
    /**
     * 从微信服务器获取用户的详细信息
     * @author jack <chengjunjie.jack@outlook.com>
     */
    public function getUserInfo(){
        // if (!$this->request->isPost()){
        //     return ;
        // }

        $param = $this->param;
        // 验证参数
        $validate = Validate::make(['code'=>'require'],['code'=>'code缺失']);
        if (!$validate->check($param)){
            return resultArray(['error' => $validate->getError()]);
        }

        // 获取openid
        $openid=$this->getAccessToken($param['code']);
        if(!$openid){
            return resultArray(['error' =>'获取openid超时']);
        }

        $model = Model('weixin.UserManage');
        $userInfo = json_decode($model->getUserInfo($openid),true); // 从微信服务器获取用户信息 string to json
        if(!$userInfo){
            return resultArray(['error'=>$model->getError()]);
        }

        if (!isset($userInfo['subscribe'])){
            return resultArray(['error' => '非法openid']);
        }
        if ($userInfo['subscribe'] != 1){
            cookie('subscribe',0); // 关注字段
            cookie('openid',$openid);
            return resultArray(['data' => $userInfo]);
        }
        cookie('subscribe',1); // 关注字段
        cookie('openid',$openid);
        // 返回用户的详细信息
        return resultArray(['data' => $userInfo]);
    }

    /**
     * 服务器通过code向微信服务器获取用户的access_token
     * @param $code string 微信客户端传回的code
     */
    private function getAccessToken($code){
        $appid = Config::get('appid');
        $tt = config::get('app_debug');
        $secret = config::get('secret');
        $getAccessToken="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code";
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
