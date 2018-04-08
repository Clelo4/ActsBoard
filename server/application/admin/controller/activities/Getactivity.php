<?php

/**
*/

namespace app\admin\controller\activities;

use app\admin\controller\ApiCommon;
use think\facade\Request;

class GetActivity extends ApiCommon{
    public function index(){
        $result;
        $result['error']="404";
        return resultArray($result);
    }

    public function getActsList(){

    }

    /**
     * 通过id获取活动详细信息
     */
    public function getActById(){
        $result;
        $result0;
        $ActModel = model('activity.ActivityInfo');
        if(isset($this->param['id'])){
            $id=$this->param['id'];
            $act_data=$ActModel->getActivitiesById($id);
            if($act_data){
                if(count($act_data)!=0){
                    $result=$act_data[0];
                    unset($result['id']);
                    $result['id']=$id;
                    unset($result['create_user']);
                    unset($result['status']);
                    unset($result['create_time']);
                    $result0['data']=$result;
                    return resultArray($result0);
                } else{
                    $result0['error']='活动不存在';
                    return resultArray($result0);
                }
                
            }
        }
        $result0['error']='参数错误';
        return resultArray($result0);
    }
    
    /**
     * 获取活动列表
     */
    public function getActs(){
        $result;
        $search_arr=[];
        $nums=10;     // 每页默认数据条数

        // page字段可选
        if(Request::has('page')){
            $search_arr['page']=$this->param['page'];
        }
        
        // 获取默认列表,没有任何参数
        if(count(Request::param())==0 ){
            $ActModel = model('activity.ActivityInfo');
            $data=$ActModel->getActivities($nums);
            $result['data']=$data;
            return resultArray($result);
        }

        // 获取用户推荐列表
        if(Request::has('recommend')){
            // 设定了type参数字段
            if($this->param['recommend']=='yes' && Request::has('user_id')){
                //
                // CODE 
            } else {
                // type字段出错
                $result['error']='参数设置出错或缺失1002';
                return resultArray($result);
            }
        }

        // 根据规则获取列表
        if(Request::has('days')){
            $search_arr['days']=$this->param['days'];
        }
        if(Request::has('type')){
            $search_arr['type']=$this->param['type'];
        }
        if(Request::has('school')){
            $search_arr['school']=$this->param['school'];
        }
        if(Request::has('sort')){
            $search_arr['sort']=$this->param['sort'];
        }
        
        $ActModel = model('activity.ActivityInfo');
        $data=$ActModel->getActivitiesByRule($search_arr,$nums);
        
        $result['data']=$data;
        return resultArray($result);
    }


    /**
	 * 通过限定活动类型和活动时间范围获取所有活动信息
	 * @param $days   int    最近几天，
	 * 时间精确度：日
	 */
    public function getActivitiesByTimeRange(){
        $result;
        $ActModel = model('activity.ActivityInfo');
        if(isset($this->param['days'])){
            $days=$this->param['days'];
            $act_type=$this->param['act_type'];
            //$current_time=date('Y-m-d H:i:s');       // 获取当前时间
            // $change='+'.$days.' day';
            // $end_time=date('Y-m-d',strtotime($change));
            $current_time='2018-04-02 00:0:00';
            $end_time='2018-04-20 00:24:02';
            $data=$ActModel->getActivitiesByTimeRange($act_type,$current_time,$end_time);
            $result['data']=$data;
            return resultArray($result);
        } else{
            $result['error']='参数错误';
            return resultArray($result);
        }
    }


}