<?php
/**
 * @category 添加活动，只有后天管理端才能访问
 * @author jack <chengjunjie.jack@outlook.com>
 */

namespace app\admin\controller\activities;
use think\facade\Request;
use app\admin\controller\AdminApiCommon;

class AddActivity extends AdminApiCommon{

    public function Index(){
        return 'ok';
    }

    /**
     * @category 添加活动
     * @author jack <chengjunjie.jack@outlook.com>
     * @return json
     */
    public function addActivityInfo(){
        $result;
        $param=Request::post();

        $ActModel = model('activity.ActivityInfo');

        if($ActModel->addActivityInfo($param)){
            $result['data']='success';
        } else{
            $result['error']=$ActModel->getError();
        }
        return resultArray($result);
    }
}