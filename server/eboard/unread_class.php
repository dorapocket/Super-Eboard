<?php
	$class_id=$_GET['classID'];
	if(isset($_GET['classID'])){
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      	$result=$db->searchCommand($class_id);
      	$db->close();
      	$data=array();
      	if($result){
    	for($x=0;$x<count($result);$x++){
        	$temp=array(
            	"id"=>$result[$x][0],
              	"type"=>$result[$x][1],
              	"typeid"=>$result[$x][2],
              	"receiver"=>$result[$x][3],
            );
          	array_push($data,$temp);
        } 
      	$opt=array(
        	"code"=>200,
          	"msg"=>"操作成功",
          	"cnt"=>count($result),
          	"data"=>$data
        );
    }else{
    	$opt=array(
        	"code"=>201,
          	"msg"=>"没有消息",
          	"cnt"=>0,
          	"data"=>$data
        );
    }
    }else{
    	$opt=array(
        	"code"=>400,
          	"msg"=>"Invalid Arguments",
          	"cnt"=>0,
          	"data"=>$data
        );
    }
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
echo json_encode($opt,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>