<?php
namespace app\admin\model\activity;

use app\admin\model\Common;

class GetActTags extends Common{

    protected $name = 'act_tag_type';

    /**
     * 通过活动id获取活动的标签列表(int型数组)
     *
     * @param string $act_id
     * @return array
     */
    public function getTagById($act_id)
    {
        $result = $this->where('act_id',$act_id)->select();
        $tmp = [];
        if ($result){
            for($i=0;$i!=count($result);$i++){
                $tmp[$i] = $result[$i]['tag'];
            }
        }
        return $tmp;
        # code...
    }
}