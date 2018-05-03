<?php
namespace app\admin\controller\weixin;
use app\admin\controller\AdminApiCommon;
use think\facade\Request;
use app\admin\validate\TemplateMsgIndustry as TemplateMsgIndustryValidate;
use app\admin\validate\SendTemplateMsg as SendTemplateMsgValidate;
use think\Template;
use think\Exception;
use think\Db;

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
     * @param string $touser 接收者openid
     * @param string $template_id 模板ID
     * @param array $data 模板数据
     * @param string $url 模板跳转链接
     * @param array $mimiprogram 跳小程序所需数据，不需跳小程序可不用传该数据
     */
    private function SendTemplateMsg($touser,$template_id,$data,$url='',$miniprogram=[]){
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
            return ['errcode'=> '1890','errmsg'=> $validate->getError()];
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
            $posturl = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
            $result = post_https($posturl,$param);
            return $result;
        }
        catch(Exception $e){
            return ['errcode'=> '400','errmsg'=> $e->getMessage()];
        }
        return ['errcode'=> '400','errmsg'=> '服务器出错'];
    }

    /**
     * 向所有已关注的用户发送模板消息
     *
     * @return void
     */
    public function SendAllTemplateMessage(){
        // 不是post请求
        if (!$this->request->isPost()){
            return;
        }
        if (!Request::has('passcode') || Request::post()['passcode']!='djfldj4flgjJVlfglfjjsljf7979jlf'){
            return resultArray( ['error' => '禁止访问']);
        }
        // $intervalTime = 86400; // 间隔时间（默认天)
        $intervalTime = 600; // 间隔时间（默认天)
        $all_user_push_rule=Db::name('user_push_rule')->select();
        $current_time = strtotime(date('Y-m-d'));
        for($i=0;$i!=count($all_user_push_rule);++$i){
            $openid = $all_user_push_rule[$i]['openid'];
            $last_push_time = strtotime(date('Y-m-d',strtotime($all_user_push_rule[$i]['last_push_time'])));
            $type = $all_user_push_rule[$i]['type'];
            $shcool = $all_user_push_rule[$i]['school'];
            $subscribe = $all_user_push_rule[$i]['subscribe'] || 0;
            $frequency = $all_user_push_rule[$i]['frequency'];
            if( ($last_push_time < $current_time) && (($current_time - $last_push_time)/$intervalTime) >= $frequency && $subscribe ){
                try{
                    $result=json_decode($this->SendTemplateMsg($openid,'_50YE4focEvF15sc19UGLztBXvI2OYMDyB6dLLAETOM',[],'http://web.actsboard.com'));
                    if($result->errcode==0){
                        // 发送成功
                        // 更新user_push_rule表的last_push_time
                        $updateTimeResult;
                        $tryTimes=0;
                        do{
                            $updateTimeResult=Db::name('user_push_rule')->where('openid',$openid)->update(['last_push_time'=>date('Y-m-d H:m:s')]);
                            if ($updateTimeResult){
                                break;
                            }
                            $tryTimes++;
                            if ($tryTimes>2){
                                break;
                            }
                        }while($updateTimeResult==0);
                    }
                } catch(Exception $e){
                    // 发送模板消息失败
                }
            }
        }

        return resultArray(['data'=> 'success']);
        
    }


    /**
     * 测试模板消息接口
     */
    public function TeamplateTest(){
        $data = [
            "first"=>[
                "value"=>"恭喜你购买成功！",
                "color"=>"#173177"
                ],
            "keynote1"=>[
                "value"=>"巧克力",
                "color"=>"#173177"
                ],
            "keynote2"=> [
                "value"=>"39.8元",
                "color"=>"#173177"
                ],
            "keynote3"=> [
                "value"=>"2014年9月22日",
                "color"=>"#173177"
                ],
            "remark"=>[
                "value"=>"欢迎再次购买！",
                "color"=>"#173177"
                ]
            ];
        $touser = 'oKvv71Ur9gf7ikUZNv0ifRbRrMBQ';
        $template_id = '_50YE4focEvF15sc19UGLztBXvI2OYMDyB6dLLAETOM';
        $result = $this->SendTemplateMsg($touser,$template_id,$data,'https://weixin.qq.com');
        return json($result);
    }
}