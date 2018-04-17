<?php
/**
 * author: jack
 * email:clelo4@qq.com
 */

 namespace app\admin\controller\user;
 use think\facade\Request;
 use app\admin\controller\WeixinApiCommon;
//  use think\Model;

class PublishRule extends WeixinApiCommon{

     /**
      * 用户设定推送规则
      */
     public function setPublishRule(){
        // school:学校(必选)
        // frequency:频率(必选)
        // type:活动类型(必选)
        $result;
        $result0;
        // 获取用户openid
        $openid = cookie('openid');
        if(Request::has('school')
           && Request::has('frequency')
           && Request::has('type')
        ) {
            $school=Request::post('school');
            $frequency=Request::post('frequency');
            $type=Request::post('type');

            $UserModel=model('user.UserPushRule');
            $result0=$UserModel->setUserPushRule($openid,$school,$frequency,$type);
        }

        if(!$result0){
            $result['error']='插入失败';
            return resultArray($result);
        }
        $result['data']="success";
        return resultArray($result);
     }
 }