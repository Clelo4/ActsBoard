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
        $actTagModel = model('activity.GetActTags');
        if(isset($this->param['id'])){
            $id=$this->param['id'];
            $act_data=$ActModel->getActivitiesById($id);
            $act_tag = $actTagModel->getTagById($id); // 获取活动的标签
            if($act_data){
                $number_to_tag = [7=>"比赛",
                8=>"文娱",
                9=>"公益",
                10=>"运动",
                11=>"社团招新",
                12=>"讲座",
                13=>"企业宣讲",
                14=>"其他"];
                for($i = 0;$i != count($act_tag);$i++){
                    $act_tag[$i] = $number_to_tag[$act_tag[$i]]; // tag从int转为string
                }
                $act_data['taglist']=$act_tag;
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

        // 如果不为post请求放回
        if (!$this->request->isPost()){
            return ;
        }
        // 查询条件的列表
        $search_arr=[];
        // 每页默认数据条数
        $nums=50;     
        // page字段可选
        if(Request::has('page')){
            $search_arr['page']=$this->param['page'];
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
        // 学校
        if(Request::has('school')){
            $search_arr['school']=$this->param['school'];
        }
        // 排序方式
        if(Request::has('sort')){
            $search_arr['sort']=$this->param['sort'];
        }
        // 活动状态
        if(Request::has('status')){
            $search_arr['status']=$this->param['status'];
        } else{
            // 默认status为1
            $search_arr['status']=1;
        }

        $ActModel = model('activity.ActivityInfo');
        $result=$ActModel->getActivitiesByRule($search_arr,$nums);
        if (!$result){
            return resultArray(['error' => $ActModel->getError()]);
        }
        return resultArray(['data' => $result]);
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
        $pushRuleModel = model('user.UserPushRule');
        $actModel = model('activity.ActivityInfo');
        $taglist = $pushRuleModel->getUserPushRule($openid)['taglist'];
        if (!$taglist){
            // 用户没有设定推送规则
            $search_arr=[];
            $search_arr['status'] = 1;
            $result = $actModel->getActivitiesByRule($search_arr);
            return resultArray(['data' => $result]);
        }
        else { // 获取推荐活动列表
            $tag_to_number = ["比赛"=>7,
            "文娱"=>8,
            "公益"=>9,
            "运动"=>10,
            "社团招新"=>11,
            "讲座"=>12,
            "企业宣讲"=>13,
            "其他"=>14];
            for($i = 0;$i != count($taglist);$i++){
                $taglist[$i] = $tag_to_number[$taglist[$i]];
            }
            $result = $actModel->getRecommendAcitities($taglist);
            $result = array_keys($result);
            $allActsList = [];
            for($i = 0;$i != count($result);$i++){
                $data=Db::name('activities')->where('act_id',$result[$i])->where('status',1)->field('id,act_id,create_time,status,create_user',true)->field(['act_id'=>'id'])->find();
                $allActsList[$i] = $data;
            }
            return resultArray(['data' => $allActsList]);
        }
    }


}