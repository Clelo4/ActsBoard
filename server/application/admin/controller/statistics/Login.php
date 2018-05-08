<?php
namespace app\admin\controller\statistics;

use app\admin\controller\AdminApiCommon;
use think\Exception;

class Login extends AdminApiCommon{

    public function recordinfo()
    {
        // 如果不是post请求就返回空请求
        if(!$this->request->isPost()){
            return ;
        }
        $openid = cookie('openid');
        $loginInfoModel = model('statistics.Login');
        try{
            $result = $loginInfoModel->setUserLoginInfo($openid);
            $loginInfoModel->userLoginTimesEachHour($openid);
        } catch(Exception $e){

        }
        return ;
    }
}