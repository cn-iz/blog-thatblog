<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/6/6
 * Time: 11:36
 */

namespace app\dictionary\controller;


class Index extends Common
{
    public  function index(){
        $this->assign('ctrl','index');
        return $this->fetch();
    }
}