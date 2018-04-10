<?php
// +----------------------------------------------------------------------
// | Description: Api基础类，验证权限
// +----------------------------------------------------------------------
// | Author: linchuangbin <linchuangbin@honraytech.com>
// +----------------------------------------------------------------------
// 只适用与后台管理
namespace app\admin\controller;

use think\facade\Request;
use think\Db;
use app\common\adapter\AuthAdapter;
use app\common\controller\Common;
use think\facade\Log;

class ApiCommon extends Common
{
    public function __construct()
    {
        parent::__construct();
        /*获取头部信息*/ 
        $header=$this->header;
        // $authKey = $this->header['authkey'];
        // $sessionId = $this->header['sessionid'];
        $authKey = cookie('authKey');
        $sessionId = cookie('PHPSESSID');
        $host = cookie('host');                // 识别host，为了区分是否是weixin客户端还是web端，web端host：we.iamxuyuan.com
        $cache = cache('Auth_'.$authKey);      // 获取缓存，存入$cache

        // 校验sessionid和authKey
        if (empty($sessionId)||empty($authKey) || empty($host) ||empty($cache)) {
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode(['code'=>101, 'error'=>'登录已失效']));
        }

        // 区分账号
        if($host == 'web.iamxuyuan.com') {  // web端
            // 检查账号有效性
            $userInfo = $cache['userInfo'];
            $map['auth_id'] = $userInfo['auth_id'];
            $map['status'] = 1;
            $tt=Db::name('auth_user')->where($map)->value('auth_id');
            if (!Db::name('auth_user')->where($map)->value('auth_id')) {
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode(['code'=>103, 'error'=>'账号已被删除或禁用']));
            }

            // 权限验证通过
            // 更新缓存
            cache('Auth_'.$authKey, $cache, config('LOGIN_SESSION_VALID'));
            // $authAdapter = new AuthAdapter($authKey);
            // // Request = Request::instance();
            // $ruleName = Request::module().'-'.Request::controller() .'-'.Request::action();
            // if (!$authAdapter->checkLogin($ruleName, $cache['userInfo']['auth_id'])) {
            //     header('Content-Type:application/json; charset=utf-8');
            //     exit(json_encode(['code'=>102,'error'=>'没有权限']));
            // }
            // $GLOBALS['userInfo'] = $userInfo;
        } else{
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode(['code'=>103, 'error'=>'禁止登录']));
        }
    }
}
