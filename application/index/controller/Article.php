<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/17
 * Time: 16:14
 */

namespace app\index\controller;
use app\model;

class Article extends Common
{
    public function index(){
        $ro='<a href="#">笔记</a>';
        $this->assign('route',$ro);
        $this->assign('ctrl','article');
        $mo=new model\article();
        $prolist=$mo->getprolist();
        $this->assign('prolist',$prolist);
        $in=input();
        if(array_key_exists('pro',$in)){
            $info=$mo->getarticlebypro($in['pro']);
            $this->assign('info',$info);
            $this->assign('id',$in['pro']);
        }else{
            $info=$mo->getallarticle();
            $this->assign('id','');
            $this->assign('info',$info);
        }
        return $this->fetch();
    }
    public function info(){
        $info=(new model\article())->getarticinfo(input('id'));
        $this->assign('info',$info);
        $ro='<a href="'.url('/index/article/index').'">笔记</a> > <a href="#">'.$info['art_name'].'</a>';
        $this->assign('route',$ro);
        $this->assign('ctrl','article');
        return $this->fetch('info');
    }
}