<?php
	if(isset($_GET['studentID'])){
      	$studentid=$_GET['studentID'];
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      	$result=$db->queryStudentInformation($studentid);
      	$db->close();
      	$data=array();
      	if($result){
        	$data=array(
            	"id"=>$result[0][0],
              	"student_id"=>$result[0][1],
              	"class_id"=>$result[0][2],
              	"student_name"=>$result[0][3],
              	"teacher_id"=>$result[0][4]
            );
      	$opt=array(
        	"code"=>200,
          	"msg"=>"success",
          	"data"=>$data
        );
    }else{
    	$opt=array(
        	"code"=>201,
          	"msg"=>"No Students!",
          	"data"=>$data
        );
    }
    }else{
    	$opt=array(
        	"code"=>400,
          	"msg"=>"Invalid Arguments",
          	"data"=>$data
        );
    }
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
echo json_encode($opt,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>