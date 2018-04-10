<?php
namespace app\index\controller;

use app\admin\controller\ApiCommon;
class Index extends ApiCommon
{
    public function index()
    {
        return 
        'hello';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
