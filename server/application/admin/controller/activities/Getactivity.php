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
     * @author jack <chengjunjie.jack@outlook.com>
     * @return void
     */
    public function getActs(){

        if (!$this->request->isPost()){
            return ;
        }

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
     * 获取用户推荐列表
     *
     * @return void
     */
    public function getActsByRecommend()
    {
        # code...
        // 获取用户openid
        $openid = cookie('openid');
        $PushRuleModel = model('user.UserPushRule');
        $taglist = $PushRuleModel->getUserPushRule($openid);
        if(!$taglist){
            // 用户没有设定推送规则
        }



    }


}