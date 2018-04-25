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

        $result=$this->where('openid',$openid)->field("frequency,type,school")->find();
        if($result){
            return $result;
        }
        return false;
    }

    /**
     * 设置用户推送规则
     * @return boolean true 插入成功 false 插入失败
     */
    public function setUserPushRule($openid,$school,$frequency,$type){
        $data=['openid'=>$openid,'school'=>$school,'frequency'=>$frequency,'type'=>$type];
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