<?php
namespace app\admin\controller\weixin;
use think\facade\Request;
use app\common\controller\Common;
use think\Validate;

define('TOKEN','tokenhera');

class ReceiveMsgFromWeixin extends Common{

    /**
     * 验证参数，确认信息是否是weixin官方服务器发送的
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
        // 如果不为post请求，返回空
        if (!$this->request->isPost()){
            return ;
        }

        $result='';

        //获取用户发送的信息
        // $data = $GLOBALS['HTTP_RAW_POST_DATA'];
        $data = file_get_contents("php://input");
        if (!empty($data)){
            $data = simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA);
            $MsgType = $data->MsgType->__toString(); // SimpleXMLElemet对象转为string字符串
            
            // 消息类型分离
            switch($MsgType)
            {

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
                case 'event': // 事件类型
                    switch($data->Event->__toString()){
                        case 'wxa_widget_data': // 小程序事件
                            $result = $this->receiveWidgetEvent($data);
                            break;
                        case 'subscribe': // 订阅事件
                            $result = $this->subscribe($data);
                            break;
                        case 'unsubscribe': // 取消订阅事件
                            break;
                        default:
                            //$result = $this->receiveEvent($data);
                            break;
                        }
                    break;
                default:
                    break;
            }
        }

        return $result;
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

    /**
     * 向用户返回文本信息
     * @author jack <chengjunjie.jack@outlook.com>
     * @param SimpleXMLElement $data
     * @return void
     */
    protected function receiveText($data){
        // Tag: 目前不对用户发送的信息进行分析处理，只统一返回相同的数据
        $ToUserName = $data->FromUserName->__toString();
        $FromUserName = $data->ToUserName->__tostring();
        $content = "Hello!\nWellcom to ActsBoard.\n查看精彩信息请点击<a href='http://web.iamxuyuan.com'>活动大厅</a>\n";
        $CreateTime = intval(time());
        return "<xml><ToUserName><![CDATA[".$ToUserName."]]></ToUserName><FromUserName><![CDATA[".$FromUserName."]]></FromUserName><CreateTime>".$CreateTime."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$content."]]></Content></xml>";
    }

    /**
     * 用户关注事件，返回信息给用户
     * @author jack <chengjunjie.jack@outlook.com>
     * @param SimpleXMLElement $data
     * @return void
     */
    protected function subscribe($data){
        // Tag: 目前不对用户发送的信息进行分析处理，只统一返回相同的数据
        $ToUserName = $data->FromUserName->__toString();
        $FromUserName = $data->ToUserName->__tostring();
        $content = "你好，欢迎使用 ActsBoard\n本服务号将推送专属于您的校园活动信息\n<a href='http://web.iamxuyuan.com/#/setting'>请先点击此处完成偏好设置</a>\n*该版本为内测试用版本，仅供调试与参评";
        $CreateTime = intval(time());
        return "<xml><ToUserName><![CDATA[".$ToUserName."]]></ToUserName><FromUserName><![CDATA[".$FromUserName."]]></FromUserName><CreateTime>".$CreateTime."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$content."]]></Content></xml>";
    }

    /**
     * 事件
     * @author jack <chengjunjie.jack@outlook.com>
     * @param SimpleXMLElement $data
     * @return void
     */
    protected function receiveEvent($data){
        // Tag: 目前不对用户发送的信息进行分析处理，只统一返回相同的数据
        $ToUserName = $data->FromUserName->__toString();
        $FromUserName = $data->ToUserName->__tostring();
        $content = "Hello! Wellcom to ActsBoard\n<a href='https://www.baidu.com'>请完成设置</a>\n联系：chengjunjie.jack@outlook.com";
        $CreateTime = intval(time());
        return "<xml><ToUserName><![CDATA[".$ToUserName."]]></ToUserName><FromUserName><![CDATA[".$FromUserName."]]></FromUserName><CreateTime>".$CreateTime."</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[".$content."]]></Content></xml>";
    }
    
}