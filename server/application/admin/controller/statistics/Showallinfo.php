<?php
namespace app\admin\controller\statistics;

use app\admin\controller\AdminApiCommon;
use app\admin\model\statistics\StatisticsEachDay;

/**
 * show所有的统计信息
 */
class Showallinfo extends AdminApiCommon{

    public function getAllInfo()
    {
        // 如果不为get请求则返回空
        if(!$this->request->isGet()){
            return ;
        }

        $result;
        $statisticModel = model('statistics.ShowAllInfo');
        $result = $statisticModel->getAllInfo();
        return resultArray(['data' => $result]);
    }
}