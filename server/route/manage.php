<?php

use think\facade\Route;

#[POST] 管理员登录： 
Route::any('manage/admin/login','admin/base/login');

#[POST] 管理员注册： 
Route::any('manage/admin/signup','admin/base/signup');

#[POST] 退出登录： 
Route::any('manage/admin/logout','admin/base/logout');

#[POST] 添加活动：
Route::any('manage/activities/publish','admin/activities.AddActivity/addActivityInfo');

#[GET] 获取活动列表： 
Route::get('manage/activities/getacts','admin/activities.GetActivity/getActs');

#[GET] 获取活动的详细信息
Route::get('manage/activities/getinfo','admin/activities.GetActivity/getActById');

#[GET] 修改活动信息
Route::any('manage/activities/change','admin/activities.ChangeActivity/changeActivityInfo');

// 删除某个活动
Route::any('manage/activities/deleteact','admin/activities.DeleteActivity/deleteAct');

// #[GET] 获取用户列表
// Route::get('manage/weixin/getfollower','admin/manage.User/getFollower');

// #[GET] 获取用户信息
// Route::get('manage/weixin/getuserinfo','admin/manage.User/getUserInfo');