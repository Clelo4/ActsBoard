<?php
// weixin 
use think\facade\Route;

Route::get('weixin/wx','admin/weixin.WeixinMenu/getAccessToken');
Route::get('weixin/test','admin/weixin.WeixinMenu/createWeixinMenu');
// 消息接口
Route::post('wx','admin/weixin.ReceiveMsgFromWeixin/index');
Route::get('wx','admin/weixin.ReceiveMsgFromWeixin/checkSignature');
// Route::post('');
// Route::get('');
