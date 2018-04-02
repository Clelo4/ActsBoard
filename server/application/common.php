<?php

/**
 * 行为绑定
 */
//\think\Hook::add('app_init','app\\common\\behavior\\InitConfigBehavior');

if (!function_exists('resultArray')) {
    /**
     * 返回对象
     * @param $array 响应数据
     */
    function resultArray($array)
    {
        if(isset($array['data'])) {
            $array['error'] = '';
            $code = 0;
        } elseif (isset($array['error'])) {
            $code = 400;
            $array['data'] = '';
        } elseif (is_array($array)){
            $array['data'] = $array;
            $array['error'] = '';
            $code = 0;
        } else{
            $code = 500;
            $array['data'] = '';
            $array['error'] = '服务器错误';
        }
        return json([
            'errcode'  => $code,
            'data'  => $array['data'],
            'errmsg' => $array['error']
        ]);
    }
}

if (!function_exists('p')) {
    /**
     * 调试方法
     * @param  array $data [description]
     */
    function p($data, $die = 1)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if ($die) die;
    }
}

if (!function_exists('user_md5')) {
    /**
     * 用户密码加密方法
     * @param  string $str 加密的字符串
     * @param  [type] $auth_key 加密符
     * @return string           加密后长度为32的字符串
     */
    function user_md5($str, $auth_key = '')
    {
        return '' === $str ? '' : md5(sha1($str) . $auth_key);
    }
}

/**
     * ============================
     * @Description: 返回合并两个对象后得到的新对象
     * @Author:   zym
     * @DateTime: 2018-03-31 10:14:06
     * ============================
     *
     * @param object $object1 对象1
     * @param object $object2 对象2
     *
     * @return [object]
     */
if (!function_exists('object_merge')) {
    function object_merge($object1, $object2)
    {
        $result_object = $object1;
        foreach($object2 as $i) {
            $result_object[] = $i;
        }
        return $result_object;
    }
}
