<?php
/**
 * 微信对象存储服务
 */
 namespace app\admin\controller\cos;

 use app\admin\controller\AdminApiCommon;

class Auth extends AdminApiCommon{

    // cos 控制台 云 API 密钥
    static $SecretID;
    static $SecretKey;
    public function getAuthorization()
    {
        $Authorization="q-sign-algorithm=sha1&q-ak="+$SecretID+"&q-sign-time="+$SignTime+"&q-key-time="+$KeyTime+"&q-header-list="+$SignedHeaderList+"&q-url-param-list="+$SignedParameterList+"&q-signature="+$Signature;
        # code...
    }
}