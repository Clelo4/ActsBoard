<?php
namespace app\admin\model\statistics;

use app\admin\model\Common;

/**
 * 推送规则的统计类
 */
class PublishRule extends Common{
    protected $name = "user_push_rule";

    public function getPushRuleStatistics(){
        $result = $this->where('subscribe',1)->select();
        $allNums = $this->where('subscribe',1)->count();
        $tagNums= []; // 获取个标签的数量
        $freqNums = ['1'=>0,'3'=>0,'7'=>0]; // 获取个推送频率的数量
        for($i = 0;$i != count($result); $i++){
            $eachPushRule = $result[$i];
            $freq = $eachPushRule['frequency'];
            for($j = 1;$j != 16;$j++){
                if(isset($eachPushRule['interest_tag_'.$j]) && $eachPushRule['interest_tag_'.$j] != NULL){
                    if(isset($tagNums['"'.$eachPushRule['interest_tag_'.$j].'"'])){
                        $tagNums['"'.$eachPushRule['interest_tag_'.$j].'"'] += 1;
                    } else{
                        $tagNums['"'.$eachPushRule['interest_tag_'.$j].'"'] = 1;
                    }
                }
            }
            switch ($freq) {
                case '1':
                    $freqNums['1'] +=1;
                    break;
                case '3':
                    $freqNums['3'] +=1;
                    break;
                case '7':
                    $freqNums['7'] +=1;
                    break;
                default:
                    break;
            }
        }
        return ['tagNums' => $tagNums,'freqNums' => $freqNums,'allNums' => $allNums];
    }


}