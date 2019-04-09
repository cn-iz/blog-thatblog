<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/19
 * Time: 14:42
 */

namespace app\model;
use think\Db;

class article
{
    public function getprolist(){
        return Db::table('project')->order('create_time','desc')->paginate(10);
    }
    public function getallarticle(){
        return Db::table('article')->order('create_time','desc')->paginate(10);
    }
    public function getarticlebypro($id){
        if($id=="all"){
            return Db::table('article')->order('create_time','desc')->paginate(10);
        }
        return Db::table('article')->where('pro_id',$id)->order('create_time','desc')->paginate(10);
    }
    public function addart($info){
        return Db::table('article')->insertGetId($info);
    }
    public function editart($info,$id){
        return Db::table('article')->where('art_id',$id)->update($info);
    }
    public function getarticinfo($id){
        return Db::table('article')->where('art_id',$id)->find();
    }
    public function addpro($info){
        return Db::table('project')->insertGetId($info);
    }
    public function editpro($info,$id){
        return Db::table('project')->where('pro_id',$id)->update($info);
    }
    public function getproinfo($id){
        return Db::table('project')->where('pro_id',$id)->find();
    }
    public  function delp($id){
        return  Db::table('project')->where('pro_id',$id)->delete();
    }
    public function delart($id){
        return Db::table('article')->where('art_id',$id)->delete();
    }
}
