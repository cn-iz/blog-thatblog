<?php
/**
 * Created by PhpStorm.
 * User: iz
 * Date: 2018/3/17
 * Time: 15:06
 */

namespace app\index\controller;


use think\Controller;
use think\Request;

class Common  extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);

    }
}