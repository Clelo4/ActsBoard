<?php
// user 
use think\facade\Route;

Route::any('user/getuserid','admin/user.Base/getCode');     // post一个code参数获取用户的user_id
// 用户设定推送规则
Route::any('user/setrule','admin/user.PublishRule/setPublishRule');
// 获取用户的推送规则
Route::get('user/getrule','admin/user.PublishRule/getPublishRule');

// 获取用户的详细信息
Route::any('user/userinfo','admin/user.GetUserInfo/getUserInfo');