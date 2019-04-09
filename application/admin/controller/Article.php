<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/17
 * Time: 16:14
 */

namespace app\admin\controller;
use app\model;

class Article extends Common
{
    public function index(){
        $ro='<a href="'.url('/admin/article/index').'">笔记</a>';
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
        $ro='<a href="'.url('/admin/article/index').'">笔记</a>';
        $this->assign('route',$ro);
        $this->assign('info',(new model\article())->getarticinfo(input('id')));
        $this->assign('ctrl','article');
        return $this->fetch('info');
    }
    public function add(){
        $in=input();
        $mo=new model\article();
        if(request()->isPost()){
            $info=['art_name'=>$in['name'],'art_info'=>$in['info'],'pro_id'=>$in['pro'],'create_time'=>date('Y-m-d h:i:sa'),'update_time'=>date('Y-m-d h:i:sa')];
            if(!$mo->addart($info)){
                $this->error('添加失败');
            }
        }
        $prolist=$mo->getprolist();
        $this->assign('prolist',$prolist);
        $ro='<a href="'.url('/admin/article/index').'">笔记</a>'.' > <a href="#">添加</a>';
        $this->assign('route',$ro);
        $this->assign('ctrl','article');
        return $this->fetch();
    }
    public function p(){
        $in=input();
        $mo=new model\article();
        if(request()->isPost()){
            $info=['pro_name'=>$in['name'],'pro_introduce'=>$in['introduce'],'create_time'=>date('Y-m-d h:i:sa'),'update_time'=>date('Y-m-d h:i:sa')];
            if(!$mo->addpro($info)){
                $this->error('添加失败');
            }
        }
        $ro='<a href="'.url('/admin/article/index').'">笔记</a>'.' > <a href="#">项目</a>';
        $this->assign('route',$ro);
        $prolist=$mo->getprolist();
        $this->assign('prolist',$prolist);
        $this->assign('ctrl','article');
        return $this->fetch('p');
    }
    public function editart(){
        $in=input();
        $mo=new model\article();
        if(request()->isPost()){
            $info=['art_name'=>$in['name'],'art_info'=>$in['info'],'pro_id'=>$in['pro'],'update_time'=>date('Y-m-d h:i:sa')];
            if(!$mo->editart($info,$in['id'])){
                $this->error('保存失败');
            }
        }
        $this->assign('info',$mo->getarticinfo($in['id']));
        $prolist=$mo->getprolist();
        $this->assign('prolist',$prolist);
        $ro='<a href="'.url('/admin/article/index').'">笔记</a>'.' > <a href="#">添加</a>';
        $this->assign('route',$ro);
        $this->assign('ctrl','article');
        return $this->fetch();
    }
    public function editp(){
        $in=input();
        $mo=new model\article();
        $this->assign('ctrl','article');
        if(request()->isPost()){
            $info=['pro_name'=>$in['name'],'pro_introduce'=>$in['introduce'],'update_time'=>date('Y-m-d h:i:sa')];
            if(!$mo->editpro($info,$in['id'])){
                $this->error('修改失败');
            }
        }
        $proinfo=$mo->getproinfo($in['id']);
        $this->assign('proinfo',$proinfo);
        $ro='<a href="'.url('/admin/article/index').'">笔记</a>'.' > <a href="/admin/article/p">项目</a>'.' > <a href="#">编辑</a>';
        $this->assign('route',$ro);
        return $this->fetch('editp');
    }
    public function delp(){
        $in=input();
        $mo=new model\article();
        if(!$mo->delp($in['id'])){
            $this->error('操作失败');
        }
        $this->redirect('admin/article/p');
    }
    public function delart(){
        $in=input();
        $mo=new model\article();
        if(!$mo->delart($in['id'])){
            $this->error('操作失败');
        }
        $this->redirect('admin/article/index');
    }

}