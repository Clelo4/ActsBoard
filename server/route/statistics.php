<?php

use think\facade\Route;

// 获取有关推送规则的统计信息
Route::get('manage/statistics/getpushrule','admin/statistics.PublishRule/getPushRule');
// 记录用户点击设定推荐规则的链接的次数
Route::any('user/setting','admin/statistics.PublishRule/setting');
// 记录用户的分享信息
Route::any('manage/statistics/share','admin/statistics.Share/recordinfo');
// 记录用户的登录信息
Route::any('manage/statistics/login','admin/statistics.Login/recordinfo');
// 记录用户的使用时长
Route::any('manage/statistics/usetime','admin/statistics.UseTime/recordinfo');