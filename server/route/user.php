<?php
// user 
use think\facade\Route;

Route::any('user/getuserid','admin/user.Base/getCode');     // post一个code参数获取用户的user_id
// 用户设定推送规则
Route::any('user/setrule','admin/user.PublishRule/setPublishRule');
