<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/18
 * Time: 21:20
 */
namespace app\model;
use think\Db;
use think\Model;

class software
{
    public function getlist(){
        return Db::table('software')->order('create_time','desc')->paginate(10);
    }
    public function add($info){
        return Db::table('software')->insertGetId($info);
    }
    public function getinfobyid($id){
        return Db::table('software')->where('soft_id',$id)->find();
    }
    public function del($id){
        return Db::table('software')->where('soft_id',$id)->delete();
    }
    public function edit($info,$id){
        return Db::table('software')->where('soft_id',$id)->update($info);
    }
}