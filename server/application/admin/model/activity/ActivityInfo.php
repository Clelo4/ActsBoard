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

	/**
	 * 添加活动信息
	 * @param array
	 * @return boolean 返回值
	 */
	public function addActInfo($param){

		// 检查必要的key是否存在；
		if(array_key_exists('act_type',$param)
           &&array_key_exists('name',$param)
           &&array_key_exists('act_start_time',$param)
           &&array_key_exists('act_end_time',$param)
           &&array_key_exists('apply_location',$param)
           &&array_key_exists('apply_way',$param)
           &&array_key_exists('school',$param)
           &&array_key_exists('create_user',$param)
        ) {

            $param['create_time']=date('Y-m-d H:i:s');
            $param['status']=0;

            $dateFormat_Type=array('Y-m-d H:i:s');
            if(!checkDateIsValid($param['act_start_time'],$dateFormat_Type)
               &&checkDateIsValid($param['act_end_time'],$dateFormat_Type)
            ){
                return '1';
            }

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