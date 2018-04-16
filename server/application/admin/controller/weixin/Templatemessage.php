<?php
namespace app\admin\controller\weixin;
use app\admin\controller\AdminApiCommon;
use think\facade\Request;
use app\admin\validate\TemplateMsgIndustry as TemplateMsgIndustryValidate;
use app\admin\validate\SendTemplateMsg as SendTemplateMsgValidate;
use think\Template;
use think\Exception;

/**
 * 微信模板消息接口
 * @author jack <chengjunjie.jack@outlook.com>
 */
class TemplateMessage extends AdminApiCommon
{
    /**
     * 设置所属的行业
     * @author jack <chengjunjie.jack@outlook.com>
     * @return json
     */
    public function setIndustry(){
        // 若不为post请求，直接返回，防止OPTION的空数据请求
        if ($this->request->isPost()){
            return ;
        }

        $access_token='';
        $param = $this->param;

        // 验证参数
        $validate = new TemplateMsgIndustryValidate;
        if (!$validate->check($param)) {
            // 若验证不通过
            return resultArray(['error'=>$validate->getError()]);
        }

        // 获取access_token
        try{
            $access_token = get_access_token();
        }
        catch(Exception $e){
            return resultArray(['error'=>$e->getMessage()]);
        }
        // 发起post请求
        try{
            $url = "https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=".$access_token;
            $param_0 = [];
            $param_0['industry_id1'] = $param['industry_id1'];
            $param_0['industry_id2'] = $param['industry_id2'];
            $result_0 = post_https($url,$param);
            if (isset($result_0['errcode'])){
                return resultArray(['error' => '未知错误']);
            }
            if($result_0){
                return resultArray(['data'=>'success']);
            }
        }
        catch(Exception $e){
            return resultArray(['error'=>$e->getMessage()]);
        }

        return resultArray(['error' => '服务器出错']);
    }

    /**
     * 获取设置的行业信息
     * @author jack <chengjunjie.jack@outlook.com>
     * @return json
     */
    public function getIndustry(){
        // 若不为get请求，直接返回      
        if (!$this->request->isGet()){
            return ;
        }

        // 微信统一调用接口凭证
        $access_token='';
        $result;
        try{
            $access_token = get_access_token();
        }
        catch(Exception $e){
            return resultArray(['error'=>$e->getMessage()]);
        }

        // 发起get请求
        try{
            $url = "https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=".$access_token;
            $result = get_https($url);
            if (isset($result['errcode'])){
                return resultArray(['error' => '位置错误']);
            }
            if ($result){
                return resultArray(['data' => $result]);
            }
        }
        catch(Exception $e){
            return resultArray(['error' => $e->getMessage()]);
        }
        return resultArray(['error' => '服务器出错']);
    }
    
    /**
     * 发送模板消息
     * @author jack <chengjunjie.jack@outlook.com>
     * @param string $touser
     * @param string $template_id
     * @param string $url
     * @param array $data
     * @param array $mimiprogram
     * @return void
     */
    protected function SendTemplateMsg($touser,$template_id,$url,$data,$miniprogram=[]){
        $param = [];
        $param['touser'] = $touser;
        $param['template_id'] = $template_id;
        $param['url'] = $url;
        $param['miniprogram'] = $miniprogram;
        $param['data'] = $data;
        
        // 验证参数
        $validate = new SendTemplateMsgValidate;
        if (!$validate->check($param)){
            // 返回错误信息
            return ['errcode'=> '1','errmsg'=> $validate->getError()];
        }

        // 微信统一调用接口凭证
        $access_token='';
        $result;
        try{
            $access_token = get_access_token();
        }
        catch(Exception $e){
            return ['errcode'=> '1','errmsg'=> $e->getMessage()];
        }

        // 发起post请求
        try{
            $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
            $result = post_https($url);
            return $result;
        }
        catch(Exception $e){
            return ['errcode'=> '400','errmsg'=> $e->getMessage()];
        }
        return ['errcode'=> '400','errmsg'=> '服务器出错'];
    }

}