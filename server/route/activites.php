<?php
// activities
use think\facade\Route;

// 根据活动id获取活动的详细信息
Route::get('activities/getinfo','admin/activities.GetActivity/getActById');
// 根据条件获取活动的列表
Route::any('activities/getacts','admin/activities.GetActivity/getActs');
// 活动有效活动的总数
Route::get('activities/getallnum','admin/activities.FindAll/getAllNum');

// Route::get('');
