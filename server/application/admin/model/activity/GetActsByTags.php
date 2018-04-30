<?php

namespace app\admin\model\activity;

use app\admin\model\Common;
use think\Validate;
use think\Db;

class GetActsByTags extends Common{

    protected $name = 'act_tag_type';

    /**
     * 通过tags列表获取活动列表
     *
     * @param array $tags
     * @param int $page
     * @return array
     */
    public function getActsByTags($tags,$page)
    {
        # code...
        $result = [];
        
		$sort='asc'; // 排序方法
		$currentTime=date('Y-m-d'); // 当前时间
		$preTime=date('Y-m-d');
		$preTime=$preTime.' 00:00:00';
		$array=[]; // 查询条件
		$tmp=[];
		array_push($tmp,'valid_date','>',$preTime);
		array_push($array,$tmp);

		// 如果分页
		if(isset($search_arr['page'])){
			$page=$search_arr['page'];
			unset($search_arr['page']);

			for($i = 0;$i != count($search_arr);$i++){
				$tmp=[];
				array_push($tmp,array_keys($search_arr)[$i],'=',$search_arr[array_keys($search_arr)[$i]]);
				array_push($array,$tmp);
			}
			$data=$this->where($array)->where('status',1)->order('valid_date',$sort)->page($page)->field(['act_id'=>'id'])->select();
			
		} else {
		// 没有分页

			for($i = 0;$i != count($search_arr);$i++){
				$tmp=[];
				array_push($tmp,array_keys($search_arr)[$i],'=',$search_arr[array_keys($search_arr)[$i]]);
				array_push($array,$tmp);
			}
			$data=$this->where($array)->order('valid_date',$sort)->select();
		}

		return $data;
    }
}