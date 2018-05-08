<?php
namespace app\admin\model\statistics;

use app\admin\model\Common;
use think\Db;
/**
 * 登录统计类
 */
class Login extends Common{

    protected $name = "user_statistics";

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
                    $nums = $result['login_nums']+1;
                    $this->where('openid',$openid)->update(['login_nums' => $nums]);
                } else{
                    $this->where('openid',$openid)->update(['login_nums' => 1]);
                }
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

    /**
     * 统计每个小时用户登录人数
     *
     * @return void
     */
    public function userLoginTimesEachHour($openid)
    {
        # code...
        if($openid){
            date_default_timezone_set('PRC'); // 设置时区
            $currentTime = date('Y-m-d H').":00:00"; // 当前时间
            $result = Db::name('user_login_log')->where('time' , $currentTime)->where('openid',$openid)->find();
            if(!$result){
                // 插入新记录
                Db::name('user_login_log')->insert(['time' => $currentTime,'openid' => $openid]);
            }
            else {
            }
        }
        
    }
}