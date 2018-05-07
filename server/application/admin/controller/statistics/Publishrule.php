<?php

namespace app\admin\controller\statistics;

use app\admin\controller\AdminApiCommon;

class PublishRule extends AdminApiCommon{

    /**
     * 获取有关推送规则的统计信息
     *
     * @return void
     */
    public function getPushRule()   
    {
       $pushRuleModel = model('statistics.PublishRule');
       $result = $pushRuleModel->getPushRuleStatistics();
       return resultArray(['data' => $result]);
       //$result;
       
    }

    /**
      * 用户点击关注事件消息上的推送规则链接后，重定向了链接。
      *
      * @return void
      */
      public function setting(){
        $statisticModel = model('statistics.StatisticsEachDay');
        $statisticModel->settinPublishRule();
        $this->redirect('http://web.iamxuyuan.com/#/setting');
     }
} 