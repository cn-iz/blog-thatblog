<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/17
 * Time: 16:15
 */

namespace app\admin\controller;


class About extends Common
{
    public function index(){
        $this->assign('ctrl','about');
        return $this->fetch();
    }
    public function info(){
        $this->assign('ctrl','about');
        return $this->fetch('info');
    }
}