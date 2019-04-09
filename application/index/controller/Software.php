<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/17
 * Time: 16:12
 */

namespace app\index\controller;
use app\model;

class Software extends Common
{
    public function index(){
        $this->assign('ctrl','software');
        $ro='<a href="'.url('/index/software/index').'">软件</a>';
        $info=(new model\software())->getlist();
        $this->assign('info',$info);
        $this->assign('route',$ro);
        return $this->fetch();
    }
    public function info(){
        $this->assign('ctrl','software');
        $in=input();
        if(array_key_exists('id',$in)){
            $info=(new model\software())->getinfobyid($in['id']);
            $this->assign('info',$info);
            $ro='<a href="'.url('/index/software/index').'">软件</a>'.' > <a href="#">'.$info['soft_name'].'</a>';
            $this->assign('route',$ro);
//            halt($info);
        }else{
            $this->error('参数缺失！');
        }
        return $this->fetch('info');
    }
}