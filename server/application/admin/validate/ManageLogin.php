<?php

namespace app\admin\validate;

use think\Validate;

/**
 * @category manage模块的login
 * @author jack <chengjunjie.jack@outlook.com>
 */
class ManageLogin extends Validate{
    protected $rule = [
        'username' => 'require | max:25',
        'password' => 'require | between:6,32',
        'validateCode' => 'require',
    ];
    protected $message = [
        'username' => '用户名或密码错误',
        'password' => '用户名或密码错误',
        'validateCode' => '验证码错误',
    ];
}