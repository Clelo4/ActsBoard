<?php
use think\facade\Route;

// 用户设定推送规则
Route::post('user/setrule','admin/user.PublishRule/setPublishRule');
