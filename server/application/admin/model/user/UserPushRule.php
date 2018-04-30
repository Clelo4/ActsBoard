<?php
/**
 * author: jack
 */
namespace app\admin\model\user;

use app\admin\model\Common;

class UserPushRule extends Common{
    protected $name = 'user_push_rule';

    protected $number_to_tag = [7=>"比赛",
        8=>"文娱",
        9=>"公益",
        10=>"运动",
        11=>"社团招新",
        12=>"讲座",
        13=>"企业宣讲",
        14=>"其他"];
    protected $tag_to_number = ["比赛"=>7,
        "文娱"=>8,
        "公益"=>9,
        "运动"=>10,
        "社团招新"=>11,
        "讲座"=>12,
        "企业宣讲"=>13,
        "其他"=>14];
    /**
     * 获取用户推送规则
     */
    public function getUserPushRule($openid){
        $number_to_tag = [7=>"比赛",
        8=>"文娱",
        9=>"公益",
        10=>"运动",
        11=>"社团招新",
        12=>"讲座",
        13=>"企业宣讲",
        14=>"其他"];
        $result=$this->where('openid',$openid)->find();
        if($result){ // 存在推送规则
            $tmp = [];
            if (isset($result['interest_tag_1'])){
                $tmp[0] = $number_to_tag[$result['interest_tag_1']];
            }
            if (isset($result['interest_tag_2'])){
                $tmp[1] = $number_to_tag[$result['interest_tag_2']];
            }
            if (isset($result['interest_tag_3'])){
                $tmp[2] = $number_to_tag[$result['interest_tag_3']];
            }
            $result['taglist'] = $tmp;

            // 删除interest_tag_ key
            unset($result['interest_tag_1']);
            unset($result['interest_tag_2']);
            unset($result['interest_tag_3']);
            return $result;
        } else{ // 不存在推送规则
            return ['id'=>null,'openid'=>$openid,'school'=>null,'frequency'=>null,'taglist'=>[],'type'=>null,'last_push_time'=>null];
        }
        return false;
    }

    /**
     * 设置用户推送规则
     * @return boolean true 插入成功 false 插入失败
     */
    public function setUserPushRule($openid,$school,$frequency,$taglist){
        $tag_to_number = ["比赛"=>7,
        "文娱"=>8,
        "公益"=>9,
        "运动"=>10,
        "社团招新"=>11,
        "讲座"=>12,
        "企业宣讲"=>13,
        "其他"=>14];
        $data=['openid'=>$openid,'school'=>$school,'frequency'=>$frequency]; 
        if (isset($taglist[0])){
            $data['interest_tag_1'] = $tag_to_number[$taglist[0]];
        }
        if (isset($taglist[1])){
            $data['interest_tag_2'] =  $tag_to_number[$taglist[1]];
        }
        if (isset($taglist[2])){
            $data['interest_tag_3'] =  $tag_to_number[$taglist[2]];
        }
        // 如果不存在openid则新增一条新的记录，否则只更新记录
        $result;
        if(!$this->where('openid',$openid)->find()){
            $result=$this->insert($data);
        } else{
            $this->where("openid",$openid)->delete();
            $result=$this->where('openid',$openid)->update($data);
        }

        return true;

    }
}