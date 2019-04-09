<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/17
 * Time: 16:14
 */

namespace app\index\controller;
use app\model;

class Spoof extends Common
{
    public function index(){
        $this->assign('ctrl','spoof');
        $ro='<a href="#">趣味代码</a>';
        $info=(new model\spoof())->getlist();
        $this->assign('info',$info);
        $this->assign('route',$ro);
        return $this->fetch();
    }
    public function info(){
        $this->assign('ctrl','spoof');
        $in=input();
        if(array_key_exists('id',$in)){
            $info=(new model\spoof())->getinfobyid($in['id']);
            $this->assign('info',$info);
            $ro='<a href="'.url('/index/spoof/index').'">趣味代码</a>'.' > <a href="#">'.$info['spoof_name'].'</a>';
            $this->assign('route',$ro);
//            halt($info);
        }else{
            $this->error('参数缺失！');
        }
        return $this->fetch('info');
    }
}