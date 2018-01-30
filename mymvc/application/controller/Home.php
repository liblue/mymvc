<?php


defined('APP_PATH')OR exit('路径错误');//访问本页面与其他页面没有联系

require_once '/application/controller/Base.php';
class Home extends Base 
{

	public function index(){
      $title='我的题目';
   //$id=$_GET; //这个可以接收到多参，并返回数组
  $id=get();
   //$id=get('n');
  dump($id);
      FrameWork::view('index.php',$title);
   


	}
	public function add(){

        FrameWork::view('add.php');

	}
	public function  edit(){

		echo "<div><h1>编辑</h1></div>";
	}
	//测试助手函数
	public function helps()
	{

		$arr=array('id'=>1,'username'=>'admin','password'=>'111111');
		dump($arr);
	}
	public function  db(){
		// $where['id>0']=null;
  //        $res=Db::cates('favorate',$where,'id','');
	 $where['id>0']=null;
        $res=Db::totals('favorate',$where);
		// $res=Db::item('favorate',$where);

		// $res=Db::lists('admin');
		
		dump($res);

	}
} 