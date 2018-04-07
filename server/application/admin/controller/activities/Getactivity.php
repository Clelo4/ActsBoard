<?php

/**
*/

namespace app\admin\controller\activities;

use app\admin\controller\ApiCommon;

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
        $ActPicModel = model('common.Url');
        if(isset($this->param['id'])){
            $id=$this->param['act_id'];
            $act_data=$ActModel->getActivitiesById($id);
            $act_pic=$ActPicModel->getActPic($id);
            if($act_data && $act_pic){
                $result['id']=$id;
                $result['type']=$act_data['act_type'];
                $result['name']=$act_data['name'];
                $result['valid_date']=$act_data['valid_date'];
                $result['apply_way']=$act_data['apply_way'];
                $result['school']=$act_data['school'];
                $result['taglist']=$act_data['tag_list'];
                $result['url']=$act_data['url'];
                $result['litimg_url']=$act_pic['litimg_url'];
                $result['pic_url']=$act_pic['pic_url'];
                $result['location']=$act_data['location'];
                $result['act_detail']=$act_data['act_detail'];
                $result0['data']=$result;
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
        $ActModel = model('activity.ActivityInfo');
        if(isset($this->param['act_id'])){
            $data=$ActModel->getActivitiesById($this->param['act_id']);
            $result['data']=$data;
            return resultArray($result);
        } else{
            $result['error']='参数错误';
            return resultArray($result);
        }
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