<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/20
 * Time: 1:24
 */

namespace app\model;
use think\Db;

class user
{
    public function login($info){
        return Db::table('user')->where('user_name',$info['name'])->where('password',md5($info['password']))->find();
    }
}