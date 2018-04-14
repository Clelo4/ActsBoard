<?php
/**
 * author: jack
 * email: clelo4@qq.com
 * 只有后台可以访问
 */

namespace app\admin\controller\activities;
use think\facade\Request;
use app\admin\controller\AdminApiCommon;

class ChangeActivity extends AdminApiCommon{


    /**
     * 发布活动信息
     */
    public function changeActivityInfo(){
        $result;
        $param=Request::post();

        $ActModel = model('activity.ActivityInfo');

        if($ActModel->changeActivityInfo($param)){
            $result['data']='修改成功';
        } else{
            $result['error']='操作失败';
        }
        return resultArray($result);

    }
}