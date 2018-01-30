<?php

require_once '/core/FrameWork.php';
require_once '/core/Db.php';
$result=FrameWork::init();//返回 home 和index
$controller=$result['controller'];
$action=$result['action'];
if(file_exists('./application/controller/Base.php')){

require_once 'application/controller/'.$controller.'.php';

}
//1:实例化控制器
// $class=new $controller;
// $class->$action();

//2使用反射

$class=new ReflectionClass($controller);//建立$controller这个类的反射
$instance=$class->newInstanceArgs();//实例化$controller类
$method=$class->getmethod($action);//获取$controller类中的方法
$method->invoke($instance);


