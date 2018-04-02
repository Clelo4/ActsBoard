<?php
// +----------------------------------------------------------------------
// | Description: 解决跨域问题
// +----------------------------------------------------------------------
// | Author: linchuangbin <linchuangbin@honraytech.com>
// +----------------------------------------------------------------------

namespace app\common\controller;

use think\Controller;
use think\Request;
use think\facade\Log;

class Common extends Controller
{
    public $param;
    public $header;
    public $userId=1;
    public $userName='testhyc';

    public function __construct()
    {
        parent::__construct();

        // 解决跨域问题
        // 指定允许其他域名访问
        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:GET, POST');
        // 响应头设置
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        
        $this->param = $this->request->param();
        $this->header = $this->request->header();
    }

    // 将对象转换为数组
    public function object_array($array) 
    {  
        if (is_object($array)) {  
            $array = (array)$array;  
        } 
        if (is_array($array)) {  
            foreach ($array as $key=>$value) {  
                $array[$key] = $this->object_array($value);  
            }  
        }  
        return $array;  
    }

    // 直接从 param 里获取相关的数据, $defaultVal 是当数据
    public function getDataFromRequestParam($name, $defaultVal = null, $type = 'string')
    {
        if (isset($this->param[$name])){
            $val = $this->param[$name];
            if ($type == 'string'){
                $val = htmlspecialchars($val);
            }else if ($type == 'int') {
                $val = intval($val);
            } else if ($type == 'float') {
                $val = floatval($val);
            }
            
            return $val;
        }else{
            return $defaultVal;
        }
    }

}
 