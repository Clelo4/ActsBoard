<?php

namespace app\admin\controller\util;

use app\admin\controller\ApiCommon;

class GetTagList extends ApiCommon{

    public function getTagList()
    {
        # code...
        if (!$this->request->isGet()){
            return ;
        }

        $tagModel = model('util.TagList');
        $result = $tagModel->getTagList();
        if ($result){
            return resultArray(['data' => $result]);
        }
        return resultArray(['error' => $tagModel->getError()]);
    }
}