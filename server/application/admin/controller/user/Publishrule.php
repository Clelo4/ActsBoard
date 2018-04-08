<?php
/**
 * author: jack
 * email:clelo4@qq.com
 */

 namespace app\admin\controller\user;
 use think\facade\Request;
 use app\admin\controller\ApiCommon;
 use think\Model;
 use app\admin\model\user\UserPushRule;

 class PublishRule extends ApiCommon{
     public function index(){
        return 'admin/user.PublishRule/setPublishRule';
     }

     /**
      * 用户设定推送规则
      */
     public function setPublishRule(){
        // user_id:用户id(必选)
        // school:学校(必选)
        // frequency:频率(必选)
        // type:活动类型(必选)
        $result;
        $result0;
        if(Request::has('user_id')
           && Request::has('school')
           && Request::has('frequency')
           && Request::has('type')
        ) {
            $user_id=Request::post('user_id');
            $school=Request::post('school');
            $frequency=Request::post('frequency');
            $type=Request::post('type');

            $UserModel=model('user.UserPushRule');
            $result0=$UserModel->setUserPushRule($user_id,$school,$frequency,$type);
        }

        if(!$result0){
            $result['error']='插入失败';
            return resultArray($result);
        }
        $result['data']="success";
        return resultArray($result);
     }
 }