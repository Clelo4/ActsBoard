<?php
/**
 * author: jack
 */
namespace app\admin\model\activity;

use app\admin\model\Common;
use think\Validate;
use think\Db;

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
			//
			$data=$this->where('act_id',$act_id)->where('status',1)->field('id,act_id,create_time,status,create_user',true)->field(['act_id'=>'id'])->find();
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
	public function getActivitiesByRule($search_arr,$nums=1000){ // nums最大为1000
		$data;
		// 分页
		$sort='asc';
		// 当前时间
		$currentTime=date('Y-m-d');
		// 开始时间
		$preTime=date('Y-m-d');
		$preTime=$preTime.' 00:00:00';
		// 查询条件
		$array=[];
		// 缓存array
		$tmp=[];
		$allActId = [];
		array_push($tmp,'valid_date','>',$preTime);
		array_push($array,$tmp);
		// 特定类型的活动id
		if(isset($search_arr['sort'])){
			// $sort=$search_arr['sort'];  // 默认asc,后期再改
			unset($search_arr['sort']);
		}
		if(isset($search_arr['status'])){
			$tmp=[];
			array_push($tmp,'status','=',$search_arr['status']);
			array_push($array,$tmp);
			unset($search_arr['status']);
		}
		if(isset($search_arr['days'])){
			$endTime=date('Y-m-d',strtotime('+'.$search_arr['days'].' day'));
			$endTime=$endTime.' 23:59:59';
			unset($search_arr['days']);
			$tmp=[];
			array_push($tmp,'valid_date','<=',$endTime);
			array_push($array,$tmp);
		}
		if(isset($search_arr['type'])){
			// $tmp=[];
			// array_push($tmp,'type','=',$search_arr['type']);
			// array_push($array,$tmp);
			// unset($search_arr['type']);
			// 从act_tag_type中获取活动id
			$tag_to_number = ["比赛"=>7,
            "文娱"=>8,
            "公益"=>9,
            "运动"=>10,
            "社团招新"=>11,
            "讲座"=>12,
            "企业宣讲"=>13,
			"其他"=>14];
			$searchByTag = [];
			array_push($searchByTag,['valid_date','>',$preTime]);
			array_push($searchByTag,['tag','=',$tag_to_number[$search_arr['type']]]);
			$allActList = Db::name('act_tag_type')->where($searchByTag)->field('act_id')->select();
			for($i = 0;$i != count($allActList);$i++){
				$tmp=[];
				array_push($tmp,'act_id','=',$allActList[$i]['act_id']);
				array_push($allActId,$tmp);
			}
			array_push($allActId,['act_id','=',12345678901]); // 当上面的查询结果为零时，会导致下面的查询返回所有数据(实际应该不返回活动数据)，添加一条不存在的act_id可解决这种问题
			unset($search_arr['type']);
		}
		// 如果分页
		if(isset($search_arr['page']) && $search_arr['page']){
			$page=$search_arr['page'];
			unset($search_arr['page']);
			// 添加查询条件
			for($i = 0;$i != count($search_arr);$i++){
				$tmp=[];
				array_push($tmp,array_keys($search_arr)[$i],'=',$search_arr[array_keys($search_arr)[$i]]);
				array_push($array,$tmp);
			}
			$data=$this->whereOr($allActId)->where($array)->order('valid_date',$sort)->page($page)->limit($nums)->field('id,act_id,create_time,status,create_user',true)->field(['act_id'=>'id'])->select();
		} else { // 没有分页
			for($i = 0;$i != count($search_arr);$i++){
				$tmp=[];
				array_push($tmp,array_keys($search_arr)[$i],'=',$search_arr[array_keys($search_arr)[$i]]);
				array_push($array,$tmp);
			}
			$data=$this->whereOr($allActId)->where($array)->order('valid_date',$sort)->field('id,act_id,create_time,status,create_user',true)->field(['act_id'=>'id'])->select();
		}

		return $data;
		
	}

	/**
	 * 获取用户推荐活动
	 * @author jack <chengjunjie.jack@outlook.com>
	 * @param array $taglist
	 * @return void
	 */
	public function getRecommendAcitities($taglist)
	{

		// 排序方式
		$sort='asc';
		// 开始时间
		$preTime=date('Y-m-d');
		$preTime=$preTime.' 00:00:00';
		// 查询条件
		$array=[];
		// 缓存array
		$tmp=[];
		array_push($tmp,'valid_date','>',$preTime);
		array_push($array,$tmp);
		$tmp = [];
		array_push($tmp,'status','=',1);
		array_push($array,$tmp);

		$tagActsList = []; // 活动id列表
		for($i = 0;$i != count($taglist);$i++){
			$tmp = [];
			array_push($tmp,'tag','=',$taglist[$i]);
			// 从act_tag_type中获取符合条件的所有活动
			$tagActs = Db::name('act_tag_type')->where($array)->where('tag',$taglist[$i])->order('valid_date',$sort)->field('act_id')->select();
			if($tagActs){
				for($j = 0;$j != count($tagActs);$j++){
					$tagActsList[$tagActs[$j]['act_id']] = true;
				}
			}
		}

		// 返回活动id列表
		return $tagActsList;
	}


	/**
	 * 添加活动信息
	 * @param array
	 * @return boolean 返回值
	 */
	public function addActivityInfo($param){
		// 检查必要的key是否存在；

		// '20181022001' (11位)
		$create_time = date('Y-m-d H:i:s');
		$param['create_time']=$create_time;
		$param['status']=1; // 1为合法

		// 验证valid_date的合法性
		$valid_date = date('Y-m-d',strtotime($param['valid_date'])).' 23:59:59';
		$param['valid_date']= $valid_date;

		$data=[];
		$taglist=$param['taglist']; // 标签列表
		$key=['name','valid_date','school','create_time','status','apply_way','location','act_detail','pic_url','litimg_url'];
		for($i=0;$i!=count($key);$i++){
			if(array_key_exists($key[$i],$param)) { $data[$key[$i]]=$param[$key[$i]]; }
			else { $data[$key[$i]]=NULL; }
		}

		// 生成活动id
		$act_id = generateId();
		$data['act_id']=$act_id;
		// -------------------------
		$authKey = cookie('authKey'); // 获取cookie中的authKey
		$data['create_user'] = cache('Auth_'.$authKey)['userInfo']['auth_id'];
		// $data['create_user'] = 11;
		// -------------------------
		try{
			$result=$this->insert($data);
		} catch(Exception $e){
			$this->error=$e->getMessage();
		}

		if($result==1) {
			for($i=0;$i!=count($taglist);$i++){
				Db::name('act_tag_type')->insert(['act_id'=>$act_id,'tag' => $taglist[$i], 'valid_date' => $valid_date,'status' => 1 ]);
			}
			return true;
		}
        
	}

	/**
	 * 删除某个活动
	 *n@author jack <chengjunjie.jack@outlook.com>
	 * @param string $act_id
	 * @return boolean
	 */
	public function deleteActivity($act_id){
		try{
			$data = $this->where('act_id',$act_id)->update(['status'=>0]);
			Db::name('activities')->where(['act_id'=>$act_id])->update(['status' => 0]);
			$result = Db::name('act_tag_type')->where('act_id',$act_id)->update(['status' => 0]);
			return true;
		} catch(Exception $e){
			$this->error = $e->getMessage();
			return false;
		}
	}

	/**
	 * 修改活动信息
	 * @param array
	 * @return boolean 返回值
	 */
	public function changeActivityInfo($param){

		$validate = Validate::make(['name'=>'require','valid_date'=>'require|date','school'=>'require','id'=>'require|length:11'],
								   ['name'=>'活动名称没有设置','valid_date'=>'非法日期','school'=>'学校错误','id'=>'id错误']);
		if (!$validate->check($param)){
			$this->error=$validate->getError();
			return false;
		}
		
		$param['valid_date']=date('Y-m-d',strtotime($param['valid_date'])).' 23:59:59';
		$create_time = date('Y-m-d H:i:s');
		$data=["create_time" => $create_time];
		$key=['name','valid_date','school','apply_way','location','act_detail'];
		for($i=0;$i!=count($key);$i++){
			if(array_key_exists($key[$i],$param)) { $data[$key[$i]]=$param[$key[$i]]; }
		}

		// -------------------------
		$act_id = $param['id'];
		$valid_date = $param['valid_date'];
		try{
			$result=$this->where('act_id',$param['id'])->update($data);
			$taglist = $param['taglist']; // 复制taglist数组
			$result = Db::name('act_tag_type')->where('act_id',$act_id)->delete();
			for($i=0;$i!=count($taglist);$i++){
				Db::name('act_tag_type')->insert(['act_id'=>$act_id,'tag' => $taglist[$i], 'valid_date' => $valid_date ,'status' => 1]);	
			}
			return true;
		} catch(Exceptionv $e){
			$this->error='服务器操作数据库失败';
			return false;
		}
	}
}