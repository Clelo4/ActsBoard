<?php
// weixin 
use think\facade\Route;

// 创建微信自定菜单
Route::get('weixin/createMenu','admin/weixin.WeixinMenu/createWeixinMenu');

// 消息接口
Route::post('wx','admin/weixin.ReceiveMsgFromWeixin/wechatCallbackApi');
Route::get('wx','admin/weixin.ReceiveMsgFromWeixin/checkSever');

// 发送群发模板消息接口
Route::any('sendalltemplatemessage','admin/weixin.TemplateMessage/SendAllTemplateMessage');
// Route::post('');
// Route::get('');
