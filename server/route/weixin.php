<?php
// weixin 
use think\facade\Route;

// 创建微信自定菜单
Route::get('weixin/createMenu','admin/weixin.WeixinMenu/createWeixinMenu');
// 消息接口
Route::post('wx','admin/weixin.ReceiveMsgFromWeixin/wechatCallbackApi');
Route::get('wx','admin/weixin.ReceiveMsgFromWeixin/checkSever');
// Route::post('');
// Route::get('');
