<?php
/**
 * author: jack
 */
namespace app\admin\model\activity;

use app\admin\model\Common;

/**
 * 获取活动的总数
 * @author jack <chengjunjie.jack@outlook.com>
 */
class FindAll extends Common{

    protected $name = 'activities';

    /**
     * 查询有效活动的总数
     * @return boolean/int
     */
    public function getAllNum(){
        $data;
        try {
            $data =  $this->where('status',1)->count();
        }
        catch (Exception $e){
            $data = false;
            $this->error = $e->getMessage();
        }
        return $data;
    }
}