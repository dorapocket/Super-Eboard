<?php
	if(isset($_GET['classID'])&&isset($_GET['week'])&&isset($_GET['appsecret'])){
    	$classid=$_GET['classID'];
      	$week=$_GET['week'];
      	$token=$_GET['appsecret'];
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      if($db->validToken($token)){
      	if($result=$db->getClassTable($classid,$week)){
        	$data=array(
        	"code"=>200,
          	"msg"=>"success",
          	"data"=>json_decode($result[0][0])
        	);
        }else{
        	$data=array(
        	"code"=>201,
          	"msg"=>"No Class Information!",
          	"data"=>array()
        	);
        }}else{
      	$data=array(
        	"code"=>300,
          	"msg"=>"Bad Token",
          	"data"=>array()
        );
      }
      	$db->close();
    }else{
    	$data=array(
        	"code"=>400,
          	"msg"=>"Invalid Arguments",
          	"data"=>array()
        );
    }
header('Content-type: application/json');
echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>