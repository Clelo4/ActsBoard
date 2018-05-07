<?php

/**
 * 获取标签
 */
use think\facade\Route;
// 获取所有标签
Route::get('util/gettaglist','admin/util.GetTagList/getTagList');
// 设定标签
Route::any('util/settaglist','admin/util.SetTagList/setTagList');