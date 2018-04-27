<?php
/**
 * 微信对象存储服务
 */
namespace app\admin\controller\cos;

use app\admin\controller\AdminApiCommon;
use think\Validate;

class Auth extends AdminApiCommon{

    // cos 控制台 云 API 密钥
    private $accessKey;           // string: access key.
    private $secretKey;

    public function getAuthorization()
    {
        if (!$this->request->isPost()){
            return ;
        }
        $param = $this->param;
        $validate = Validate::make([],[]);
        if(!$validate->check($param)){
            return resultArray(['error' => $validate->getError()]);
        }
        $signTime = (string)(time() - 60) . ';' . (string)(time() + 3600);
        $httpString = strtolower($param['method'] . "\n" . urldecode($param['path'])) . "\n\nhost=" . $request['Host'] . "\n";
        $sha1edHttpString = sha1($httpString);
        $stringToSign = "sha1\n$signTime\n$sha1edHttpString\n"; 
        $signKey = hash_hmac('sha1', $signTime, $this->secretKey);
        $signature = hash_hmac('sha1', $stringToSign, $signKey);
        $authorization = 'q-sign-algorithm=sha1&q-ak='. $this->accessKey .
            "&q-sign-time=$signTime&q-key-time=$signTime&q-header-list=host&q-url-param-list=&" .
            "q-signature=$signature";
        return resultArray(['data' => $authorization]);
    }

    
}