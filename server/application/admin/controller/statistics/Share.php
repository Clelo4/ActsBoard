<?php
namespace app\admin\controller\statistics;

use app\admin\controller\AdminApiCommon;
use think\Validate;
use think\Exception;
/**
 * 记录每个用户的分享情况
 */
class Share extends AdminApiCommon{

    public function recordinfo()
    {
        // 如果不是post请求就返回空请求
        if(!$this->request->isPost()){
            return ;
        }
        $param = $this->param;
        // 验证器
        $validate = Validate::make(['type' => 'require']);
        if(!$validate->check($param)){
            return resultArray(['error' => $validate->getError()]);
        }
        //
        $type = $param['type'];
        $openid = cookie('openid');
        $shareInfoModel = model('');
        try{
            $result = $shareInfoModel->setUserShareInfo($openid,$type);
        } catch(Exception $e){

        }
        return ;
    }
}