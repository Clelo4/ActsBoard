<?php
/**
 * author: jack
 */
namespace app\admin\model\common;

use app\admin\model\Common;

class Url extends Common{
    protected $name = 'activities_pic';

    public function getActPic($act_id){
        $data;
        if($id.length==11){
            $data=$this->where('act_id',$id)->select();
            return $data;
        }
        return NULL;
    }
}