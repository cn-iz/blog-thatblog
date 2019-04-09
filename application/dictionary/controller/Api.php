<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/6/6
 * Time: 11:37
 */

namespace app\dictionary\controller;

use think\Controller;
use app\bin\bdapi;

class Api extends Controller
{
    public function bdapi(){
        $res=(new bdapi())->aa(input()['q']);
        return json(json_decode($res));
    }
}