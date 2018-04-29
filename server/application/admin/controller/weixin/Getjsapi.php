<?php
namespace app\admin\controller\weixin;

use app\admin\controller\AdminApiCommon;
use app\admin\model\weixin\UserManage;
use think\facade\Request;
use think\Db;
use think\Exception;

class Getjsapi extends AdminApiCommon{

    /**
     * 从微信服务器获取jsapi_ticket并存入数据库
     * @return void
     */
    public function getJsApiFromWeixin(){
        if (!$this->request->isGet()){
            return ;
        }
        $param = $this->param;
        if (!isset($param['jackhellofucksfjsgjlrjlfjld']) || $param['jackhellofucksfjsgjlrjlfjld'] != 'dfjdlfjdljfdl'){
            return ;
        }
        try{
            $ACCESS_TOKEN = get_access_token();
            $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$ACCESS_TOKEN.'&type=jsapi';
            $result = json_decode(get_https($url));
            if (isset($result->errcode) && $result->errcode== 0){
                $jsapi_ticket = $result->ticket;
                $data = date('Y-m-d H:m:s');
                $result = Db::name('jsapi_ticket')->where('type',2)->update(['jsapi_ticket' => $jsapi_ticket,'create_time' => $data]);
                return 1;
            }
        } catch(Exception $e){
            return (string)$e->getMessage();
        }
        return 0;
    }

    /**
     * 从数据库获取getjsapi
     * @author jack <chengjunjie.jack@outlook.com>
     * @return void
     */
    private function getJsApi(){
        $result = Db::name('jsapi_ticket')->where('type',2)->find();
        if($result){
            return $result['jsapi_ticket'];
        }
        return false;
    }


    /**
     * 微信客户端获取js-sdk权限验证的签名
     *  @author jack <chengjunjie.jack@outlook.com>
     * @return void
     */
    public function getSignature()
    {
        # code...
        
        // 如果不为get请求
        if (!$this->request->isGet()){
            return ;
        }

        $debug = true;
        $postUrl = $param['url'];
        $postUrl = $postUrl.split('#')[0];
        // 请求方post的url(当前网页的URL，不包含#及其后面部分)，目前写死
        // $postUrl='http://web.iamxuyuan.com/';
        $jsapi_ticket = $this->getJsApi(); // 获取jsapi_ticket

        if (!$jsapi_ticket){
            return resultArray(['error' => '服务器故障']);
        }

        $timestamp = strtotime('now'); // 生成当前时间的时间戳
        $nonceStr = 'ActsBoard'.substr(str_shuffle('QW23456ERTYUtyuiopasdfghjklzxcvIOPASDFGHJKLZXCV'),3,10); // 生成随机字符串
        $string1 = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$nonceStr.'&timestamp='.$timestamp.'&url='.$postUrl;
        $signature = sha1($string1);
        return resultArray(['data' => ['timestamp'=>$timestamp,'nonceStr'=>$nonceStr,'signature'=>$signature]]);
    }

}