<?php
/**
 * author: jack
 */
namespace app\admin\model\activity;

use app\admin\model\Common;


/**
 * 验证数据是否有空格
 * 有返回 true
 * 没有返回 false
 * @return  boolean
 */
function isHasSpace($data){
    if(strpos($data," ")) { return true; }
    else { return false; }
}

/**
 * 验证数据的长度是否是指定长度
 * @param size int              限制长度
 * @param isStrict  boolean     是否要求等于指定长度
 * @return  int  true:成功   false:验证失败    2：参数错误
 */
function isRightSize($data,$size,$isStrict=false){
    if($isStrict){
        return (strlen($data)==$size)?true:false;
    } else {
        return (strlen($data)<=$size)?true:false;
    }
}


/**
 * 校验日期格式是否正确
 * 
 * @param string $date 日期
 * @param string $formats 需要检验的格式数组
 * @return boolean
 */
function checkDateIsValid($date, $formats = array("Y-m-d", "Y/m/d")) {
    $unixTime = strtotime($date);
    if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
        return false;
    }
    //校验日期的有效性，只要满足其中一个格式就OK
    foreach ($formats as $format) {
        if (date($format, $unixTime) == $date) {
            return true;
        }
    }
    return false;
}

/**
 * 过滤字符串
 */
function filter($data){
    htmlspecialchars();
    // stripslashes()      //使用PHP stripslashes()函数去除用户输入数据中的反斜杠 (\)
}



class ActivityInfo extends Common{

	protected $name = "activities";


	/**
	 * 通过活动id获取活动的详细信息
	 * @param int  活动id
	 * 
	 */
	public function getActivitiesById($act_id){
		$data;
		$act_id=(string)$act_id;
		if(strlen($act_id)==11){
			$data=$this->where('act_id',$act_id)->where('status',0)->select();
			return $data;
		}
		return NULL;
	}

	/**
	 * 通过限定活动类型和活动时间范围获取所有活动信息
	 * @param $search_arr array
	 * @return NULL     错误
	 * @return result   mysql 查询结果
	 */
	public function getActivitiesByRule($search_arr,$nums){
		$data;
		// 分页
		$sort='asc';
		$currentTime=date('Y-m-d');
		$endTime;
		$preTime;
		if(isset($search_arr['sort'])){
			// $sort=$search_arr['sort'];  // 默认asc,后期再改
			unset($search_arr['sort']);
		}
		if(isset($search_arr['days'])){
			$endTime=date('Y-m-d',strtotime('+'.$search_arr['days'].' day'));
			$endTime=$endTime.' 23:59:59';
			unset($search_arr['days']);
			$preTime=date('Y-m-d',strtotime('-1 day'));
			$preTime=$preTime.' 23:59:59';
		}
		// 如果分页
		if(isset($search_arr['page'])){
			$page=$search_arr['page'];
			unset($search_arr['page']);
			$array=[];

			for($i = 0;$i != count($search_arr);$i++){
				$tmp=[];
				array_push($tmp,array_keys($search_arr)[$i],'=',$search_arr[array_keys($search_arr)[$i]]);
				array_push($array,$tmp);
			}
			$data=$this->where($array)->where('valid_date','<=',$endTime)->where('valid_date','>',$preTime)->order('valid_date',$sort)->page($page)->limit($nums)->select();
			
		} else {
		// 没有分页
			$array=[];

			for($i = 0;$i != count($search_arr);$i++){
				$tmp=[];
				array_push($tmp,array_keys($search_arr)[$i],'=',$search_arr[array_keys($search_arr)[$i]]);
				array_push($array,$tmp);
			}
			$data=$this->where($array)->where('valid_date','<=',$endTime)->where('valid_date','>',$preTime)->order('valid_date',$sort)->limit($nums)->select();
			
		}

		return $data;
		
	}

	// 获取默认列表
	public function getActivities($nums){
		$data;
		$data=$this->where('status',0)->order('valid_date','asc')->limit($nums)->select();
		return $data;
	}

	/**
	 * 添加活动信息
	 * @param array
	 * @return boolean 返回值
	 */
	public function addActivityInfo($param){

		/**
		 * 
		type:活动类别
		name:活动名称
		valid_date:该信息的有效日期，截止到那天23:59:59
		school:学校
		taglist:活动标签
		litimg_url:活动缩略图
		pic_url:活动图片原图
		location:活动地点
		act_detail:活动内容
		 */
		// 检查必要的key是否存在；
		if(array_key_exists('type',$param)
           &&array_key_exists('name',$param)
           &&array_key_exists('valid_date',$param)
           &&array_key_exists('location',$param)
           &&array_key_exists('school',$param)
        ) {

			// '20181022001' (11位)
            $param['create_time']=date('Y-m-d H:i:s');
            $param['status']=0; // 0为合法

            $dateFormat_Type=array('Y-m-d H:i:s');
            if(!checkDateIsValid($param['valid_date'],$dateFormat_Type)){
                return false;
            }
			$act_id=date('YmdHis').
			$data=[];
			$key=['act_type','name','act_start_time','act_end_time','school','create_user','create_time','status','apply_way','act_location','act_details','taglist','activity_url','act_pic_url'];
			for($i=0;$i!=count($key);$i++){
				if(array_key_exists($key[$i],$param)) { $data[$key[$i]]=$param[$key[$i]]; }
				else { $data[$key[$i]]=NULL; }
			}

            /**
             * code: 验证post传入的参数
             */
			//return $param;
			$result=$this->insert($data);
			if($result==1) {
				return true;
			}


        } 
        else {
            return false;
        }
	}

}