<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/17
 * Time: 16:15
 */

namespace app\index\controller;


class Mess extends Common
{
    public function index(){
        $this->assign('ctrl','mess');
        return $this->fetch();
    }
    public function info(){
        $this->assign('ctrl','mess');
        return $this->fetch('info');
    }
}