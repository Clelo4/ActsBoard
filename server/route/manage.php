<?php

use think\facade\Route;

#[POST] 管理员登录： 
Route::post('manage/admin/login','');

#[GET] 获取活动列表： 
Route::get('manage/getacts','');

#[GET] 获取特定类别的活动列表： 
Route::get('manage/getacts','');

#[POST] 用户管理： 
Route::post('manage/admin/user','');

#[POST] 活动管理： 
Route::post('manage/admin/activities','');

#[POST] 推送管理： 
Route::post('manage/admin/recommend','');