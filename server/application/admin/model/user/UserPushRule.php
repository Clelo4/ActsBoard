<?php
/**
 * author: jack
 */
namespace app\admin\model\user;

use app\admin\model\Common;

class UserPushRule extends Common{
    protected $name = 'user_push_rule';

    /**
     * 获取用户推送规则
     */
    public function getUserPushRule($openid){

        $result=$this->where('openid',$openid)->find()->toArray();
        if($result){
            $tmp = [];
            if (isset($result['interest_tag_1'])){
                $tmp[0] = $result['interest_tag_1'];
            }
            if (isset($result['interest_tag_2'])){
                $tmp[1] = $result['interest_tag_2'];
            }
            if (isset($result['interest_tag_3'])){
                $tmp[2] = $result['interest_tag_3'];
            }
            $result['taglist'] = $tmp;

            // 删除interest_tag_ key
            unset($result['interest_tag_1']);
            unset($result['interest_tag_2']);
            unset($result['interest_tag_3']);
            return $result;
        }
        return false;
    }

    /**
     * 设置用户推送规则
     * @return boolean true 插入成功 false 插入失败
     */
    public function setUserPushRule($openid,$school,$frequency,$taglist){
        $data=['openid'=>$openid,'school'=>$school,'frequency'=>$frequency];
        if (isset($taglist[0])){
            $data['interest_tag_1'] = $taglist[0];
        }
        if (isset($taglist[1])){
            $data['interest_tag_2'] = $taglist[1];
        }
        if (isset($taglist[2])){
            $data['interest_tag_3'] = $taglist[2];
        }
        // 如果不存在openid则新增一条新的记录，否则只更新记录
        $result;
        if(!$this->where('openid',$openid)->find()){
            $result=$this->insert($data);
        } else{
            $result=$this->where('openid',$openid)->update($data);
        }

        return true;

    }
}