<?php
/**
 * author: jack
 */
namespace app\admin\model\activity;

use app\admin\model\Common;

class ActivityInfo extends Common{

	protected $name = "activities";


	/**
	 * 通过活动id获取活动的详细信息
	 * @param int  活动id
	 * 
	 */
	public function getActivitiesById($id){
		$data;
		if(is_numeric($id)){
			$data=$this->where('id',$id)->where('status',1)->select();
			return $data;
		}
	}

	/**
	 * 通过限定活动类型和活动时间范围获取所有活动信息
	 * @param $type        (string)   活动类型
	 * @param $startTime   (string)
	 * @param $endTime     (string)
	 * 时间精确度：日
	 * @return NULL     错误
	 * @return result   mysql 查询结果
	 */
	public function getActivitiesByTimeRange($type,$startTime,$endTime){
		$data;
		// 验证日期是否正确
		if(date('Y-m-d',strtotime($startTime))!='1970-01-01' && date('Y-m-d',strtotime($endTime))!='1970-01-01' )
		{
			$data=$this->where('act_type',$type)->whereTime('act_end_time','between',[$startTime,$endTime])->select();
			//
			return $data;
		} else{
			return NULL;
		}
	}

}