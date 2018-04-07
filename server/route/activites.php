<?php
// activities
use think\facade\Route;

// 根据活动id获取活动的详细信息
Route::get('activities/getinfo','admin/activities.GetActivity/getActById');
// 根据条件获取活动的列表
Route::get('activities/getacts','admin/activities.GetActivity/getActs');
// 添加活动
Route::post('activities/publish','admin/activities.AddActivity/addActivityInfo');
// Route::get('');
