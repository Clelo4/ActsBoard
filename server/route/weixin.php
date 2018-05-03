<?php
// weixin 
use think\facade\Route;

// 创建微信自定菜单
Route::post('manage/weixin/createMenu','admin/weixin.WeixinMenu/createWeixinMenu');

// 消息接口
Route::post('wx','admin/weixin.ReceiveMsgFromWeixin/wechatCallbackApi');
Route::get('wx','admin/weixin.ReceiveMsgFromWeixin/checkSever');

// 发送群发模板消息接口
Route::any('manage/weixin/sendalltemplatemessage','admin/weixin.TemplateMessage/SendAllTemplateMessage');

// 获取jsapi签名
Route::any('weixin/getjsapi','admin/weixin.GetJsApi/getSignature');

// 刷新jsapi签名
Route::get('weixin/flashjsapi','admin/weixin.GetJsApi/getJsApiFromWeixin');

// Route::post('');
// Route::get('');