<?php

namespace app\admin\controller\activities;
use app\admin\controller\AdminApiCommon;
use think\Validate;
use think\Model;

/**
 * 删除活动
 */
class DeleteActivity extends AdminApiCommon{
    public function deleteAct(){
        if (!$this->request->isPost()){
            return ;
        }
        $param = $this->param;
        $validate = Validate::make(['act_id' => 'require|length:11|alphaNum' ]);
		if (!$validate->check($param)){
			return resultArray(['error' => '删除失败']);
        }
        
        $model = Model('activities.ActivityInfo');
        $data = $model->deleteActivity($$param['act_id']);
        if($data){
            return resultArray(['data' => '删除成功']);
        }
        return resultArray(['error' => '删除失败']);
    }
}
