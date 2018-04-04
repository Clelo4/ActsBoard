<?php
// weixin 
use think\facade\Route;

Route::get('admin/weixin/wx','admin/weixin.WeixinMenu/getAccessToken');
Route::get('admin/weixin/test','admin/weixin.WeixinMenu/createWeixinMenu');
Route::get('admin/weixin/getfollower','admin/weixin.User/getFollower');
Route::get('admin/weixin/getuserinfo','admin/weixin.User/getUserInfo');
// Route::post('');
// Route::get('');
