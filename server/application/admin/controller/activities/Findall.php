<?php
namespace app\admin\controller\activities;
use app\admin\controller\ApiCommon;
use think\facade\Request;
use think\Model;

/**
 * 获取活动的总数目
 * @author jack <chengjunjie.jack@outlook.com>
 */
class FindAll extends ApiCommon{

    public function getAllNum(){
        if (!$this->request->isGet()){
            return ;
        }

        $model = Model('activity.FindAll');
        $data = $model->getAllNum();
        if ($data){
            return resultArray(['data' => $data]); 
        }
        else {
            return resultArray(['error' => $model->getError()]);
        }
    }
}