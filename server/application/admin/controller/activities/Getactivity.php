<?php

/**
*/

namespace app\admin\controller\activities;

use app\admin\controller\ApiCommon;
use think\facade\Request;
use think\Db;

class GetActivity extends ApiCommon{
    public function index(){
        $result;
        $result['error']="404";
        return resultArray($result);
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
                $result0['data']=$act_data;
                return resultArray($result0);
            } else{
                $result0['error']='活动不存在';
                return resultArray($result0);
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

        /**
         * 获取用户推荐列表
         * 此代码未写完
         * author: jack
         * email: jack0000davis@gmail.com
         */
        if(Request::has('recommend')){
            $openid=Request::cache('openid');  // 微信用户id

            // if($this->param['recommend']=='yes' && Request::has('user_id')){
            //     //
            //     // CODE 
            // } else {
            //     // type字段出错
            //     $result['error']='参数设置出错或缺失1002';
            //     return resultArray($result);
            // }
        }

        // 根据规则获取列表
        if(Request::has('days')){
            if($this->param['days']!=0){  // 如果days=0则默认返回所有时间的
                $search_arr['days']=$this->param['days'];
            }
        }
        if(Request::has('type')){
            if($this->param['type']!='全部类别'){ // 如果type='全部类别'则默认返回所有类别的数据
                $search_arr['type']=$this->param['type'];
            }
        }

        // 如果是host为weixin，则通过cookie的openid获取用户设定的type，覆盖原type字段
        // if (cookie('host')=='weixin') {
        //     $openid = cookie('openid');
        //     $type=Db::name('user_push_rule')->where('openid',$openid)->value('type');
        //     $search_arr['type']=$type;
        // }

        if(Request::has('school')){
            $search_arr['school']=$this->param['school'];
        }
        if(Request::has('sort')){
            $search_arr['sort']=$this->param['sort'];
        }
        if(Request::has('status')){
            $search_arr['status']=$this->param['status'];
        } else{
            // 默认status为1
            $search_arr['status']=1;
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