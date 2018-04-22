<?php
/**
 * @category 添加活动，只有后天管理端才能访问
 * @author jack <chengjunjie.jack@outlook.com>
 */

namespace app\admin\controller\activities;
use think\facade\Request;
use app\admin\controller\AdminApiCommon;
use app\admin\validate\AddAct as AddActValidate;

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
        // 如果不为post请求，返回空
        if (!$this->request->isPost()){
            return ;
        }
        $result;
        $param=Request::post();

        $validate = new AddActValidate();
		if (!$validate->check($param)){
			return resultArray(['error' => ($validate->getError())]);
		}

        $ActModel = model('activity.ActivityInfo');

        if($ActModel->addActivityInfo($param)){
            $result['data']='success';
        } else{
            $result['error']=$ActModel->getError();
        }
        return resultArray($result);
    }
}