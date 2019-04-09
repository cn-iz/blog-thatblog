<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/6/5
 * Time: 1:13
 */

namespace app\dictionary\controller;
use app\bin\bdapi;

class Dictionry extends Common
{
    public  function index(){
        $this->assign('ctrl','index');
        return $this->fetch();
    }
    public function bdapi(){
        return (new bdapi())->aa(input()['q']);
    }
}