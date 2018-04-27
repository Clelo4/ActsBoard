<?php
namespace app\admin\controller\user;

use app\admin\controller\ApiCommon;
use app\admin\model\weixin\UserManage;
use think\facade\Request;
use think\Validate;

class GetUserInfo extends ApiCommon{

    static $appid="wxb569d7a3f448c503";
    static $secret="29938d5779d3dd83b9dab916f6e469d4";

    /**
     * 从微信服务器获取用户的详细信息
     * @author jack <chengjunjie.jack@outlook.com>
     */
    public function getUserInfo(){
        if (!$this->request->isPost()){
            return ;
        }

        $param = $this->param;
        // 验证参数
        $validate = Validate::make(['code'=>'require'],['code'=>'code缺失']);
        if (!$validate->check($param)){
            return resultArray(['error' => $validate->getError()]);
        }

        // 获取openid
        $openid=$this->getAccessToken($param['code']);
        if(!$openid){
            return resultArray(['error' =>'服务器超时']);
        }

        $model = Model('weixin.UserManage');
        $userInfo = $model->userInfo($openid);
        if(!$userInfo){
            return resultArray(['error'=>$model->getError()]);
        }

        // 返回用户的详细信息
        return resultArray(['data' => $userInfo]);
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
