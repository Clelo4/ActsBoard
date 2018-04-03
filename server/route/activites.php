<?php
// activities
use think\facade\Route;

Route::get('activities/getinfo','admin/activities.GetActivity/getActById');
Route::get('activities/getRange','admin/activities.GetActivity/getActivitiesByTimeRange');
// Route::post('');
// Route::get('');
