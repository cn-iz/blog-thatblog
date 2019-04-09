<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/20
 * Time: 1:25
 */

namespace app\admin\controller;
use think\Controller;
use app\model;
class User extends Controller
{

    public function login(){
        if(request()->isPost()){
            $user=(new model\user())->login(input());
            if($user){
                session('user_name',$user['user_name']);
                $this->redirect('admin/index/index');
            }else{
                $this->error('用户名或密码错误！');
            }
        }
        $this->assign('ctrl',"");
        return $this->fetch('index');
    }
}