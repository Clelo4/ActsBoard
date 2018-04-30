<?php
/**
 * author: jack
 * email: clelo4@qq.com
 * 只有后台可以访问
 */

namespace app\admin\controller\activities;
use think\facade\Request;
use app\admin\controller\AdminApiCommon;

class ChangeActivity extends AdminApiCommon{


    /**
     * 修改活动信息
     * @author jack <chengjunjie.jack@outlook.com>
     * @return mixed
     */
    public function changeActivityInfo(){
        // 如果不为post请求，返回空
        if (!$this->request->isPost()){
            return ;
        }
        $result;
        $param=Request::post();
        if ($param['taglist'] && is_array($param['taglist'])){
            //
            $tag_to_number = ["比赛"=>7,
            "文娱"=>8,
            "公益"=>9,
            "运动"=>10,
            "社团招新"=>11,
            "讲座"=>12,
            "企业宣讲"=>13,
            "其他"=>14];
            for ($i = 0;$i != count($param['taglist']);$i++){
                $param['taglist'][$i] = $tag_to_number[$param['taglist'][$i]];
            }
        }
        $ActModel = model('activity.ActivityInfo');

        if($ActModel->changeActivityInfo($param)){
            $result['data']='修改成功';
        } else{
            $result['error']=$ActModel->getError();
        }
        return resultArray($result);
    }
}