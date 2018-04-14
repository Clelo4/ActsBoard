<?php
// weixin 
use think\facade\Route;

Route::get('weixin/wx','admin/weixin.WeixinMenu/getAccessToken');
Route::get('weixin/test','admin/weixin.WeixinMenu/createWeixinMenu');

Route::post('weixin/getuserid','admin/weixin.Base/getCode');     // post一个code参数获取用户的user_id
// 用户设定推送规则
Route::post('user/setrule','admin/weixin.PublishRule/setPublishRule');
// Route::post('');
// Route::get('');
