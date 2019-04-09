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

class spoof
{
    public function getlist(){
        return Db::table('spoof')->order('create_time','desc')->paginate(10);
    }
    public function add($info){
        return Db::table('spoof')->insertGetId($info);
    }
    public function getinfobyid($id){
        return Db::table('spoof')->where('spoof_id',$id)->find();
    }
    public function del($id){
        return Db::table('spoof')->where('spoof_id',$id)->delete();
    }
    public function edit($info,$id){
        return Db::table('spoof')->where('spoof_id',$id)->update($info);
    }
}