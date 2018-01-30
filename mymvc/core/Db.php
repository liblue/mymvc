<?php

class Db
{
   public static function db_connect(){
  require '/config/database.php';
 
   	$conn=mysqli_connect($db['db_host'],$db['db_user'],$db['db_password'],$db['db_name']);

   	if(!$conn){

   		exit('Connection failed'.mysqli_connect_error());
   	}
   	return $conn;
   }


   public  static function item($table,$where=array()){

   	$conn=self::db_connect();
   	$rows=false;
   	$sql="select * from {$table}";
   	if($where){

   		$sql.=' where '.self::getwhere($where);
   	}
 // die($sql);
   	if($result=mysqli_query($conn,$sql)){


   		while($row=mysqli_fetch_assoc($result)){
   		
             $rows[]=$row;

   		}
   		mysqli_free_result($result);
   	}
   	mysqli_close($conn);
   	if(!$rows){

   		return $rows;
   	}

   	return $rows[0];
   }
public static function lists($table,$where,$order=''){

	$conn=self::db_connect();
	$rows=false;
	$sql="select * from {$table}";
    if($where){

    	$sql.=' where '.self::getwhere($where);
    }
    if($order){

    	$sql.=" order by {$order}";
    }
    if($result=mysqli_query($conn,$sql)){
    	while($row=mysqli_fetch_assoc($result)){

    		$rows[]=$row;
    	}
    	mysqli_free_result($result);
    }

    mysqli_close($conn);
    return $rows;


	}
//自定义列表索引
    public static function cates($table,$where,$index,$order=''){
    	$lists=self::lists($table,$where,$order);
    	$results=array();
    	foreach($lists  as $key=>$value){

         $results[$value[$index]]=$value;

    	}
    	return $lists;
     
    }
    //查询记录总数  返回一个count
    public static function totals($table,$where){
      $conn=self::db_connect();

      $sql="select count(*) as count from {$table}";

      if($where){
      $sql.=' where '.self::getwhere($where);
      }
      $count=0;
      //$result返回结果为count
      if($result=mysqli_query($conn,$sql)){

      	$row=mysqli_fetch_assoc($result);
      }

      $count=$row['count'];
      mysqli_close($conn);
return $count;

    }
//分页
 		public static function pagination($table,$where,$page,$num,$order){
 			$conn=self::db_connect();
 			$count=self::totals($table,$where);//记录总页数
 	        $total_page=ceil($count/$num);
 	        $page=max(1,$page);
 	        $offset=($page-1)+$num;
 	        $sql="select *from  {$table}";
 	        if($where){

 	        	$sql.=' where '.self::getwhere($where);

 	        }
 	        if($order){

 	        	$sql.=" order by {$order} ";
 	        }
 	        $sql.=' limit '.$offset.','.$num;
 	        $rows=[];
 	        if($result=myssqli_query($conn,$sql)){

 	        	while($row=mysqli_fetch_assoc($result)){

 	        		$rows[]=$row;
 	        	}
 	        	mysqli_free_result($result);
 	        }
 	        mysqli_close($conn);
 	        return array('total'=>$count,'lists');
 		}


    //处理where条件
    private static function getwhere($params){

    	$_where='';
    	if(!$params){

    		return $_where;
    	}
    	foreach($params as $key=>$value){
    		$value=gettype($value)=='string'?"'".$valuse."'":$value;
    		if($value){

    			$_where.=$key.'='.$value.' AND ';
    		}else{

    			$_where.=$key.' AND ';
    		}
    	}
    	$_where=rtrim($_where,' AND ');
   
    	return $_where;
    }
	
}