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
        $act_id=(string)$act_id;
        if(strlen($act_id)==11){
            $data=$this->where('act_id',$act_id)->select();
            return $data;
        }
        return NULL;
    }
}