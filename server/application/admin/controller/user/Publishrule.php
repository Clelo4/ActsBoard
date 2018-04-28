<?php
/**
 * author: jack
 * email:clelo4@qq.com
 */

 namespace app\admin\controller\user;
 use think\facade\Request;
 use think\facade\Validate;
 use app\admin\controller\WeixinApiCommon;

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
        // tag:兴趣标签(可选) array (默认全部)
        $result0;
        $param = $this->param;
        $validate = Validate::make(['school'=>'require','frequency'=>'require|number','taglist'=>'array']);
        if (!$validate->check($param)){
            return resultArray(['error' => "设置出错！"]);
        }
        // 获取用户openid
        // $openid = cookie('openid');
        $openid = 'oKvv71Ur9gf7ikUZNv0ifRbRrMBQ';
        $school=$param['school'];
        $frequency=$param['frequency'];
        $taglist=$param['taglist'];

        $UserModel=model('user.UserPushRule');
        $result0=$UserModel->setUserPushRule($openid,$school,$frequency,$taglist);
        if(!$result0){
            $result['error']='插入失败';
            return resultArray($result);
        }
        return resultArray(['data'=>"success"]);
     }

     /**
      * 获取用户推送规则
      * @author jack <chengjunjie.jack@outlook.com>
      * @return void
      */
     public function getPublishRule(){
        if(!$this->request->isGet()){
            return ;
        }
        $UserModel=model('user.UserPushRule');
        $openid = cookie('openid'); // 获取openid
        // $openid = 'oKvv71Ur9gf7ikUZNv0ifRbRrMBQ';
        $result=$UserModel->getUserPushRule($openid);
        if(!$result){
            return resultArray(['error'=>'获取失败']);
        }
        return resultArray(['data'=>$result]);
     }
 }