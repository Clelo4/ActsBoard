<?php

use think\facade\Route;

Route::get('util/gettaglist','admin/util.GetTagList/getTagList');

Route::any('util/settaglist','admin/util.SetTagList/setTagList');