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
     * 修改活动信息
     * @author jack <chengjunjie.jack@outlook.com>
     * @return mixed
     */
    public function changeActivityInfo(){
        // 如果不为post请求，返回空
        if (!$this->request->isPost()){
            return ;
        }
        $result;
        $param=Request::post();

        $ActModel = model('activity.ActivityInfo');

        if($ActModel->changeActivityInfo($param)){
            $result['data']='修改成功';
        } else{
            $result['error']=$ActModel->getError();
        }
        return resultArray($result);
    }
}