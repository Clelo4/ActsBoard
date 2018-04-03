<?php
/**
 * author: jack
 * email: clelo4@qq.com
 */

namespace app\admin\controller\activities;
use think\facade\Request;
use app\admin\controller\ApiCommon;

class AddActivity extends ApiCommon{

    public function Index(){
        return 'ok';
    }

    public function postActivityInfo(){
        $result;
        $param=Request::post();

        $ActModel = model('activity.ActivityInfo');
        $result['data']=$ActModel->addActInfo($param);
        return resultArray($result);
    }
}