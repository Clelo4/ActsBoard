<?php

namespace app\admin\model\weixin;

use app\admin\model\Common;
use think\Exception;

define('dbName','user');

/**
 * 微信用户管理类
 * @author jack <chengjunjie.jack@outlook.com>
 */
class UserManage extends Common {

    protected $name = dbName;

    /**
     * 查询用户信息，如果不存在就创建一个新的用户user_id
     * @return mixed 成功用户的true，失败返回false
     */
    public function userInfo($openid){
        $data=$this->where('openid',$openid)->find();
        if(!$data){
            // 用户不存在，在数据库创建微信用户
            // $userdata=$this->getUserInfo($openid);
            $data=$this->getUserInfo($openid);
            $data=json_decode($data, true);
            $insertResult=$this->insert($data);
            if(!$insertResult){
                $this->error = '服务器错误';
                return false;
            }
        }
        if(!$data){
            $this->error = '服务器错误';
        }
        return $data;
    }

    /**
     * 查询分组接口
     * @return void
     */
    public function getGroup(){
        $url = 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.get_access_token();
        try{
            $data=get_https($url);
            return $data;
        } catch(Exception $e){
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * 从微信服务器获取用户基本信息
     * @param openid 用户的openid
     * @return mixed 操作失败返回false，成功返回data(json);
     */
    public function getUserInfo($openid){
        $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.get_access_token().'&openid='.$openid;
        try{
            $data=get_https($url);
            return $data;
        } catch(Exception $e){
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * 存储或更新用户的微信基本信息
     *
     * @param array $param
     * @return boolean
     */
    public function saveUserInfo($param)
    {
        try{    
            $result=$this->where('openid',$param['openid'])->find();
            if(!$result){
                // 用户不存在，在数据库创建微信用户
                // $userdata=$this->getUserInfo($openid);
                try{
                    $insertResult=$this->insert($param);
                    if(!$insertResult){
                        $this->error = '数据库错误';
                        return false;
                    }
                } catch(Exception $e){
                    $this->error = $e->getMessage();
                    return false;
                } 
            }
            else{
                try{
                    $updateResult = $this->where('openid',$param['openid'])->update($param);
                    return true;
                } catch(Exception $e){
                    $this->error = $e->getMessage();
                    return false;
                }
            }
        } catch(Exception $e){
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * 获取关注者列表
     * @param $next_opendid  string  获取关注用户列表偏移量，不填默认从头开始拉取 (可选参数)
     * @return mixed 操作失败返回false，成功返回data(json);
     */
    public function getFollower($next_opendid=''){
        $result;
        $url='https://api.weixin.qq.com/cgi-bin/user/get?access_token='.get_access_token().'&next_openid='.$next_opendid;
        try{    
            $data=get_https($url);
            return$data;
        }
        catch(Exception $e){
            $this->error =  $e->getMessage();
            return false;
        }
    }

}