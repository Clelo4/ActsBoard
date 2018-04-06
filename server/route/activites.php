<?php
// activities
use think\facade\Route;

Route::get('activities/getinfo','admin/activities.GetActivity/getActById');
Route::get('activities/getbyrange','admin/activities.GetActivity/getActivitiesByTimeRange');
Route::post('activities/addact','admin/activities.AddActivity/postActivityInfo');

// Route::post('');
// Route::get('');
