<?php
namespace app\index\controller;

class Index extends  Common
{
    public function index()
    {
        $this->assign('ctrl','index');
        return $this->fetch();
    }
}
