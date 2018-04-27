<?php
namespace app\admin\controller\user;

use app\admin\controller\ApiCommon;
use app\admin\model\weixin\UserManage;

class GetUserInfo extends ApiCommon{

    /**
     * 从微信服务器获取用户的详细信息
     * @author jack <chengjunjie.jack@outlook.com>
     */
    public function getUserInfo(){
        return resultArray(['data' => ['subscribe' => false]]);
    }

}
