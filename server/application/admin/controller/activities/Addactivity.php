<?php
/**
 * author: jack
 * email: clelo4@qq.com
 */

namespace app\admin\controller\activities;
use think\facade\Request;
use app\admin\controller\ApiCommon;

class AddActivity extends ApiCommon{

    public function Index(){
        return 'ok';
    }

    public function postActivityInfo(){
        $result;
        
        if(Request::has('act_type')
           &&Request::has('name')
           &&Request::has('act_start_time')
           &&Request::has('act_end_time')
           &&Request::has('apply_location')
           &&Request::has('apply_way')
           &&Request::has('school')
           &&Request::has('act_details')
           &&Request::has('create_user')
           &&Request::has('taglist')
           &&Request::has('activity_url')
        ) {
            $insert_data=[];
            $insert_data['act_type']=$Request::post('act_type');
            $insert_data['name']=$Request::post('name');
            $insert_data['act_start_time']=$Request::post('act_start_time');
            $insert_data['act_end_time']=$Request::post('act_end_time');
            $insert_data['apply_location']=$Request::post('apply_location');
            $insert_data['apply_way']=$Request::post('apply_way');
            $insert_data['school']=$Request::post('school');
            $insert_data['act_details']=$Request::post('act_details');
            $insert_data['create_user']=$Request::post('create_user');
            $insert_data['taglist']=$Request::post('taglist');
            $insert_data['activity_url']=$Request::post('activity_url');
            $insert_data['']=$Request::post('');
            $insert_data['']=$Request::post('');
            $insert_data['']=$Request::post('');
            $insert_data['']=$Request::post('');
            $insert_data['']=$Request::post('');
            $insert_data['']=$Request::post('');

        } 
        else {
            $result['error']='参数错误';
            return resultArray($result);
            
        }

    }
}