<?php
/**
 * author: jack
 * email: clelo4@qq.com
 * 只有后台可以访问
 */

namespace app\admin\controller\activities;
use think\facade\Request;
use app\admin\controller\AdminApiCommon;

class AddActivity extends AdminApiCommon{

    public function Index(){
        return 'ok';
    }

    /**
     * 发布活动信息
     */
    public function addActivityInfo(){
        $result;
        $param=Request::post();

        $ActModel = model('activity.ActivityInfo');

        if($ActModel->addActivityInfo($param)){
            $result['data']='success';
        } else{
            $result['error']='操作失败';
        }
        return resultArray($result);

    }
}