<?php
/**
 * author: jack
 * email:clelo4@qq.com
 */

 namespace app\admin\controller\user;
 use think\facade\Request;
 use think\facade\Validate;
 use app\admin\controller\WeixinApiCommon;
 use think\Request;
//  use think\Model;

class PublishRule extends WeixinApiCommon{

     /**
      * 用户设定推送规则
      */
     public function setPublishRule(){
         // 如果不为post请求，返回空
        if (!$this->request->isPost()){
            return ;
        }
        // school:学校(必选)
        // frequency:频率(必选)
        // type:活动类型(必选)
        $result0;
        $param = Request::post();
        $validate = Validate::make(['school'=>'require','frequency'=>'require|number','type'=>'require']);
        if (!$validate->check($param)){
            return resultArray(['error' => "设置出错！"]);
        }
        // 获取用户openid
        $openid = cookie('openid');

        $school=Request::post('school');
        $frequency=Request::post('frequency');
        $type=Request::post('type');

        $UserModel=model('user.UserPushRule');
        $result0=$UserModel->setUserPushRule($openid,$school,$frequency,$type);
        if(!$result0){
            $result['error']='插入失败';
            return resultArray($result);
        }
        return resultArray(['data'=>"success"]);
     }
 }