<?php
namespace app\admin\controller\weixin;
use think\facade\Request;
use app\common\controller\Common;
use think\Validate;

class ReceiveMsgFromWeixin extends Common{
    public function index(){
        // 若不为post请求，则返回空数据
        if (!$this->request->isPost()){
            return '';
        }
        $param = $this->param;
        return '';
    }

    /**
     * 验证服务器
     * @author jack <chengjunjie.jack@outlook.com>
     * @return string
     */
    public function checkSignature(){
        $token = 'tokenhera';
        // 验证参数
        $rule = [
            'signature' => 'require',
            'timestamp' => 'require',
            'nonce' => 'require',
            'echostr' => 'require',
        ];

        $validate = Validate::make($rule);
        $param = $this->param;
        if (!$validate->check($param)){
            return ;
        }
        $tmpArr = array($param['timestamp'],$param['nonce'],$token);
        $signature = $param['signature'];
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        
        if($signature == $tmpStr){
            return $param['echostr'];
        }
        
        return ;

        


        return 'hell';
    }
}