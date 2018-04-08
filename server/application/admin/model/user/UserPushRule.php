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
    public function getUserPushRule($user_id){
        $data;
        
        return NULL;
    }

    /**
     * 设置用户推送规则
     * @return boolean true 插入成功 false 插入失败
     */
    public function setUserPushRule($user_id,$school,$frequency,$type){
        $data=['user_id'=>$user_id,'school'=>$school,'frequency'=>$frequency,'type'=>$type];
        // 如果不存在user_id则新增一条新的记录
        $result;
        if(count($this->where('user_id',$user_id)->select())==0){
            $result=$this->insert($data);
        } else{
            $result=$this->where('user_id',$user_id)->update($data);
        }

        return true;

    }
}