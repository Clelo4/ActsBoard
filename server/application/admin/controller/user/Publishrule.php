<?php
/**
 * author: jack
 * email:clelo4@qq.com
 */

 namespace app\admin\controller\user;
 use think\facade\Request;
 use app\admin\controller\ApiCommon;

 class PublishRule extends ApiCommon{
     public function index(){
        return 'admin/user.PublishRule/setPublishRule';
     }

     /**
      * 用户设定推送规则
      */
     public function setPublishRule(){

     }
 }