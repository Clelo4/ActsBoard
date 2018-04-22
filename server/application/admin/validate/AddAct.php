<?php

namespace app\admin\validate;
use think\Validate;

/**
 * @category 添加活动信息
 * @author jack <chengjunjie.jack@gmail>
 */
class AddAct extends Validate{
    protected $rule = [
        'name' => 'require',
        'type' => 'require',
        'valid_date' => 'require|date',
        'location' => 'require',
        'school' => 'require',
        'act_detail' => 'require',
        '' => '',
    ];
    protected $message = [
        'name.require' => '请填写活动名称',
        'type.require' => '请填写活动类型',
        'valid_date.require' => '缺少信息有效期截至时间',
        'valid_date.date' => '日期格式错误',
        'school.require' => '请填写学校',
        'location.require' => '请填写地点',
        'act_detail.require' => '请填写内容',
    ];
}