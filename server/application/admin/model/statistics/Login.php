<?php
namespace app\admin\model\statistics;

use app\admin\model\Common;

/**
 * 登录统计类
 */
class Login extends Common{

    protected $name = "";

    /**
     * 统计每个用户的登录信息
     * @author jack <chengjunjie.jack@outlook.com>
     * @return void
     */
    public function setUserLoginInfo($openid){
        if($openid){ // 如果有openid
            $result = $this->where('openid',$openid)->find(); // 查找数据库是否存在记录
            if($result){
                if($result['login_nums'] !=NULL){
                    $this->where('openid',$openid)->update(['login_nums' => ($result['login_nums']+1)]);
                }
                $this->where('openid',$openid)->update(['login_nums' => 1]);
            }
            else{
                $this->insert(['openid' => $openid,'login_nums' => 1]);
            }
        }
        return ;
    }

    /**
     * 统计用户的使用时长
     * @author jack <chengjunjie.jack@outlook.com>
     * @return void
     */
    public function userUseTime()
    {
                
    }
}