<?php
/**
 * author:jack
 * email:clelo4@qq.com
 */

 namespace app\admin\controller\manage;

 use app\admin\controller\ApiCommon;

 class Admin extends ApiCommon{

    public function index(){
        $result;
        $result['error']="404";
        return resultArray($result);
    }

    /**
     * 登录功能
     */
    public function login(){
        $result;
        return resultArray($result);
    }

    /**
     * 获取活动列表
     */
    public function getActs(){
        $result;
        return resultArray($result);
    }

    /**
     * 用户管理
     */
    public function mangeUser(){
        $result;
        return resultArray($result);
    }

    /**
     * 活动管理
     */
    public function mangeActs(){
        $result;
        return resultArray($result);
    }

    /**
     * 
     */
    public function manageRecommend(){
        $result;
        return resultArray($result);
    }

 }