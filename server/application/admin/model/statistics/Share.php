<?php
namespace app\admin\model\statistics;

use app\admin\model\Common;

/**
 * 分享统计类
 */
class Share extends Common{
    protected $name = "";

    /**
     * 统计每个用户的分享次数
     * @author jack <chengjunjie.jack@outlook.com>
     * @return void
     */
    public function setUserShareInfo($openid,$type){
        if($openid){ // 如果有openid
            $result = $this->where('openid',$openid)->find(); // 查找数据库是否存在记录
            if($result){
                if($result['share_nums'] !=NULL){
                    $this->where('openid',$openid)->update(['share_nums' => ($result['share_nums']+1)]);
                }
                $this->where('openid',$openid)->update(['share_nums' => 1]);
            }
            else{
                $this->insert(['openid' => $openid,'share_nums' => 1]);
            }
        }
        return ;
    }
    
}