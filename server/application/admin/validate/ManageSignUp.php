<?php

namespace app\admin\validate;
use think\Validate;

/**
 * @author jack <chengjunjie.jack@outlook.com>
 * @category manage管理模块的基础验证类
 */
class ManageSignUp extends Validate
{
    protected $rule = [
        'username' => 'require | max:25',
        'password' => 'require | between:6,32',
        'email' => 'email',
        'nickname' => 'chsDash', // 只能是汉字、字母、数字和下划线_及破折号-
        'realname' => 'chs', // 只能是汉字
        'mobile' => 'mobile',
        'register_code' => 'require', // 注册码
    ];

    protected $message = [
        'username.require' => '请输入用户名',
        'username.max' => '用户名最大长度为25',
        'password.require' => '请输入用户名',
        'password.between' => '密码长度6-32位',
        'email.email' => '邮箱错误',
        'nickname.chsDash' => '只能是汉字、字母、数字和下划线_及破折号-',
        'realname.chs' => '只能是汉字',
        'mobile.mobile' => '手机号码错误',
        'register_code' => '注册码错误',
    ];
}