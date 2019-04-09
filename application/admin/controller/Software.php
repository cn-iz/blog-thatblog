<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/17
 * Time: 16:12
 */

namespace app\admin\controller;
use app\model;

class Software extends Common
{
    public function index(){
        $this->assign('ctrl','software');
        $ro='<a href="'.url('/admin/software/index').'">软件</a>';
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
            $ro='<a href="'.url('/admin/software/index').'">软件</a>'.' > <a href="#">'.$info['soft_name'].'</a>';
            $this->assign('route',$ro);
//            halt($info);
        }else{
            $this->error('参数缺失！');
        }
        return $this->fetch('info');
    }
    public function add(){
        if($this->request->isPost()){
            $in=input();
            $file = request()->file('ico');
            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS . 'uploads');
                if($info){
                    $p='static/uploads/'.$info->getSaveName();
                    $info=['soft_name'=>$in['name'],'soft_info'=>$in['info'],'soft_about'=>$in['about'],'soft_url'=>$in['url'],'soft_img'=>$p,'soft_introduce'=>$in['introduce'],'create_time'=>date('Y-m-d h:i:sa'),'update_time'=>date('Y-m-d h:i:sa')];
                    if((new model\software())->add($info)){
                        $this->success('添加成功');
                    }else{
                        $this->error('数据库操作失败！');
                    }
                }else{
                    // 上传失败获取错误信息
                    $this->error('图标上传失败！');
                }
            }
           // halt($in);
        }
        $this->assign('ctrl','software');
        $ro='<a href="'.url('/admin/software/index').'">软件</a>'.' > <a href="#">添加</a>';
        $this->assign('route',$ro);
        return $this->fetch('add');
    }
    public function del(){
        $in=input();
        if((new model\software())->del($in['id'])){
            $this->redirect('admin/software/index');
        }else{
            $this->error('删除失败');
        }
    }
    public function edit()
    {
        $in = input();
        if(request()->isPost()){
            $file = request()->file('ico');
            // 移动到框架应用根目录/public/uploads/ 目录下
            if ($file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
                if ($info) {
                    $p = 'static/uploads/' . $info->getSaveName();
                    $info = ['soft_name' => $in['name'], 'soft_info' => $in['info'], 'soft_about' => $in['about'], 'soft_url' => $in['url'], 'soft_img' => $p, 'soft_introduce' => $in['introduce'],  'update_time' => date('Y-m-d h:i:sa')];
                    if ((new model\software())->edit($info, $in['id'])) {
                        $this->success('更新成功');
                    } else {
                        $this->error('数据库操作失败！');
                    }
                } else {
                    // 上传失败获取错误信息
                    $this->error('文件保存失败');
                }
            } else {
                // 上传失败获取错误信息
                $info = ['soft_name' => $in['name'], 'soft_info' => $in['info'], 'soft_about' => $in['about'], 'soft_url' => $in['url'], 'soft_introduce' => $in['introduce'], 'create_time' => date('Y-m-d h:i:sa'), 'update_time' => date('Y-m-d h:i:sa')];
                if ((new model\software())->edit($info, $in['id'])) {
                    $this->success('更新成功');
                } else {
                    $this->error('数据库操作失败！');
                }
            }
        }
        $this->assign('ctrl','software');
        $info=(new model\software())->getinfobyid($in['id']);
        $this->assign('info',$info);
        return $this->fetch('edit');
    }
}