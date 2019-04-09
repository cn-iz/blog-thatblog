<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/17
 * Time: 16:14
 */

namespace app\admin\controller;
use app\model;

class Spoof extends Common
{
    public function index(){
        $this->assign('ctrl','spoof');
        $ro='<a href="'.url('/admin/spoof/index').'">趣味代码</a>';
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
            $ro='<a href="'.url('/admin/spoof/index').'">趣味代码</a>'.' > <a href="#">'.$info['spoof_name'].'</a>';
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
                    $info=['spoof_name'=>$in['name'],'spoof_info'=>$in['info'],'spoof_about'=>$in['about'],'spoof_url'=>$in['url'],'spoof_img'=>$p,'spoof_introduce'=>$in['introduce'],'create_time'=>date('Y-m-d h:i:sa'),'update_time'=>date('Y-m-d h:i:sa')];
                    if((new model\spoof())->add($info)){
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
        $this->assign('ctrl','spoof');
        $ro='<a href="'.url('/index/spoof/index').'">趣味代码</a>'.' > <a href="#">添加</a>';
        $this->assign('route',$ro);
        return $this->fetch('add');
    }
    public function del(){
        $in=input();
        if((new model\spoof())->del($in['id'])){
            $this->redirect('admin/spoof/index');
        }
        else{
            $this->error('删除失败');
        }
    }

    public function edit(){
        $in=input();
        $this->assign('ctrl','spoof');
        $ro='<a href="'.url('/index/spoof/index').'">趣味代码</a>'.' > <a href="#">修改</a>';
        if(request()->isPost()){
            $file = request()->file('ico');
            // 移动到框架应用根目录/public/uploads/ 目录下
            if ($file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
                if ($info) {
                    $p = 'static/uploads/' . $info->getSaveName();
                    $info=['spoof_name'=>$in['name'],'spoof_info'=>$in['info'],'spoof_about'=>$in['about'],'spoof_url'=>$in['url'],'spoof_img'=>$p,'spoof_introduce'=>$in['introduce'],'update_time'=>date('Y-m-d h:i:sa')];
                    if ((new model\spoof())->edit($info, $in['id'])) {
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
                $info=['spoof_name'=>$in['name'],'spoof_info'=>$in['info'],'spoof_about'=>$in['about'],'spoof_url'=>$in['url'],'spoof_introduce'=>$in['introduce'],'create_time'=>date('Y-m-d h:i:sa'),'update_time'=>date('Y-m-d h:i:sa')];
                if ((new model\spoof())->edit($info, $in['id'])) {
                    $this->success('更新成功');
                } else {
                    $this->error('数据库操作失败！');
                }
            }
        }
        $this->assign('route',$ro);
        $info=(new model\spoof())->getinfobyid($in['id']);
        $this->assign('info',$info);
        return $this->fetch('edit');
    }
}