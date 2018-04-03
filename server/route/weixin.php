<?php
// weixin 
use think\facade\Route;

Route::get('admin/weixin/wx','admin/weixin.WeixinMenu/getAccessToken');
Route::get('admin/weixin/test','admin/weixin.WeixinMenu/createWeixinMenu');
// Route::post('');
// Route::get('');
