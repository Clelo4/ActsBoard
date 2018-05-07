<?php

namespace app\admin\model\statistics;

use app\admin\model\Common;
use think\Exception;

class StatisticsEachDay extends Common{
    
    protected $name = "statistics_each_day";
    /**
     * 记录点击“关注事件发送的设置推送规则”
     *
     * @return void
     */
    public function settinPublishRule()
    {
        try{
            $taday = date('Y-m-d'); // 当前日期
            $result = $this->where('date',$taday)->find();
            $setpublishrule_nums = $result['setpublishrule_nums'];
            if($result){
                $setpublishrule_nums += 1;
                
                $this->where('date',$taday)->update(['setpublishrule_nums' => $setpublishrule_nums]);
            }
            else{
                $this->insert(['date' => $taday,'setpublishrule_nums' => 1]);
            }
        } catch(Exception $e){

        }
        return ;
        
    }
}