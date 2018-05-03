<?php
/**
 * 用户推送规则基础类
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
            $i = 0;
            $j = 0;
            for ($i = 0;$i!=15;){
                $i++;
                if($result['interest_tag_'.$i]){
                    $tmp[$j] = $number_to_tag[$result[('interest_tag_'.$i)]];
                    unset($result['interest_tag_'.$i]);
                    $j++;
                }
            }
            $result['taglist'] = $tmp;
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
        $data=['openid'=>$openid,'subscribe' => 1,'school'=>$school,'frequency'=>$frequency]; 
        for($i = 0;$i!=count($taglist);$i++){
            if($i==15){
                break;
            }
            $data['interest_tag_'.($i+1)] = $tag_to_number[$taglist[$i]];
        }
        // 如果不存在openid则新增一条新的记录，否则只更新记录
        $result;
        if(!$this->where('openid',$openid)->find()){
            $result=$this->insert($data);
        } else{
            $this->where("openid",$openid)->delete();
            $result=$this->where('openid',$openid)->insert($data);
        }
        return true;

    }
}