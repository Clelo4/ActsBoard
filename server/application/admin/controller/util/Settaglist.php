<?php

namespace app\admin\controller\util;

use app\admin\controller\AdminApiCommon;

class SetTagList extends AdminApiCommon{

    /**
     * 设置标签
     *
     * @return void
     */
    public function setTagList()
    {

        # code...
        if (!$this->request->isPost()){
            return ;
        }

        $param = $this->param['taglist']; // array
        $tagModel = model('util.TagList');
        $result = $tagModel->setTagList($param);
        if ($result){
            return resultArray(['data' => '修改标签成功']);
        }
        return resultArray(['error' => $tagModel->getError()]);
    }
}