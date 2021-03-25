<?php
	$teacher_id=$_GET['teacherID'];
	$id=$_GET['id'];
	if(isset($_GET['teacherID'])&&isset($_GET['id'])){
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      	$result=$db->readTeacherCommand($id,$teacher_id);
      	$db->close();
      	if($result){
      	$opt=array(
        	"code"=>200,
          	"msg"=>"操作成功",
        );
    }else{
    	$opt=array(
        	"code"=>201,
          	"msg"=>"没有找到这条消息",
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
echo json_encode($opt,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>