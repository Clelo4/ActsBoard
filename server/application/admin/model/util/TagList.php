<?php

/**
 * taglist标签操作
 */
namespace app\admin\model\util;
use app\admin\model\Common;
use think\Exception;

class TagList extends Common{

    protected $name = "taglist";

    public function setTagList($param)
    {
        # code...
        $this->where('status',1)->delete();
        for ($i=0;$i!=count($param);$i++){
            $this->insert(['status' => 1,'tag' => $param[$i]]);
        }
        return true;
    }

    public function getTagList()
    {
        # code...
        $result = $this->where('status',1)->select();
        if($result){
            $tmp = [];
            for($i=0;$i!=count($result);$i++){
                $tmp[$i]=$result[$i]['tag'];
            }
            return $tmp;
        }

        $this->error = '获取失败';
        return false;
    }
}