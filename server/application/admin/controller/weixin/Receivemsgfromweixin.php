<?php
namespace app\admin\controller\weixin;
use think\facade\Request;
use app\common\controller\Common;
use think\Validate;

define('TOKEN','tokenhera');

class ReceiveMsgFromWeixin extends Common{

    /**
     * 验证参数，已确认信息是否是weixin官方服务器发送的
     * @param array $param
     * @return boolean
     */
    protected function checkSignature($param){
        // 验证参数
        $rule = [
            'signature' => 'require',
            'timestamp' => 'require',
            'nonce' => 'require',
            'echostr' => 'require',
        ];

        $validate = Validate::make($rule);
        if (!$validate->check($param)){
            return false;
        }
        $tmpArr = array($param['timestamp'],$param['nonce'],TOKEN);
        $signature = $param['signature'];
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        
        if($signature == $tmpStr){
            return true;
        }
        return false;
    }

    /**
     * 微信消息统一接收接口
     * @author jack <chengjunjie.jack@outlook.com>
     * @return void
     */
    public function wechatCallbackApi(){
        // 若不为post请求，则返回空数据
        $TT=$this->request;
        if (!$this->request->isPost()){
            return '';
        }

        //获取用户发送的信息
        $data = $GLOBALS['HTTP_RAW_POST_DATA'];
        if (!empty($data)){
            $data = simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA);
            $MsgType = $data->MsgType->__toString(); // SimpleXMLElemet对象转为string字符串
            
            // 消息类型分离
            switch($MsgType)
            {
                case 'event':
                    if ($data->Event->__toString() == 'wxa_widget_data') {
                        $result = $this->receiveWidgetEvent($data);
                    }
                    else {
                        $result = $this->receiveEvent($data);
                    }
                    break;
                case 'text':
                    $result = $this->receiveText($data);
                    break;
                case 'image':
                    $result = $this->receiveImage($data);
                    break;
                case 'location':
                    $result = $this->receiveLocation($data);
                    break;
                case 'voice':
                    $result = $this->receiveVoice($data);
                    break;
                case 'video':
                    $result = $this->receiveVideo($data);
                    break;
                case 'link':
                    $result = $this->receiveLink($data);
                    break;
                default:
                    break;
            }
        }

        return '';
    }

    /**
     * 微信验证本机服务器
     * @author jack <chengjunjie.jack@outlook.com>
     * @return string
     */
    public function checkSever(){
        // 验证参数
        $param = $this->param;
        
        if ($this->checkSignature($param)){
            return $param['echostr'];
        }
        return ;
    }

    protected function receiveText($data){
        
    }
}