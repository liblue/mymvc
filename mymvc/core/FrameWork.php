<?php


class FrameWork
{

public static function init(){
$request_uri=$_SERVER['REQUEST_URI'];//    /mymvc/index.php/home/index
$script_name=$_SERVER['SCRIPT_NAME'];//    /mymvc/index.php

$request=str_replace($script_name,'',$request_uri);//  /home/index

//将request前面的斜杠去掉  第二个参数是指定去掉的元素  ，没有就为空格
$request=ltrim($request,'/');//   home/index

$request_array=explode('?', $request); //可能会有参数
$controller_action=$request_array[0];
$controller_action=explode('/', $controller_action);
//当控制器和方法没有指定时 ，访问默认控制器
if(count($controller_action)>=2){
	$controller=$controller_action[0];
	$action=$controller_action[1];


}else{

require_once '/config/config.php';
$controller=$config['default_controller'];
$action=$config['default_action'];


}



	return array('controller'=>$controller,'action'=>$action);
}

//加载视图
public static  function view($viewname,$title=null){
require_once '/application/view/'.$viewname;

}





}

function dump($data)
{
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}
//经过处理后返回
function get($params = false){
if(!$params){

	return $_GET?$_GET:false;
}
return isset($_GET[$params])?$_GET[$params]:false;
}


function post($params = false){
if(!$params){

	return $_POST?$_POST:false;
}
return isset($_POST[$params])?$_POST[$params]:false;
}



