<?php
// weixin 
use think\facade\Route;

Route::get('weixin/wx','admin/weixin.WeixinMenu/getAccessToken');
Route::get('weixin/test','admin/weixin.WeixinMenu/createWeixinMenu');
// 消息接口
Route::post('wx','admin/weixin.ReceiveMsgFromWeixin/wechatCallbackApi');
Route::get('wx','admin/weixin.ReceiveMsgFromWeixin/checkSever');
// Route::post('');
// Route::get('');
