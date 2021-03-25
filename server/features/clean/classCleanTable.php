<?php
	if(isset($_GET['classID'])&&isset($_GET['week'])&&isset($_GET['cleantable'])&&isset($_GET['appsecret'])){
      	$token=$_GET['appsecret'];
    	$classid=$_GET['classID'];
      	$week=$_GET['week'];
      	$cleantable=$_GET['cleantable'];
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      if($db->validToken($token)){
      	if($result=$db->insertCleanTable($classid,$week,$cleantable)){
        	$data=array(
        	"code"=>200,
          	"msg"=>"success",
          	"data"=>array()
        );
        }else{
        	$data=array(
        	"code"=>300,
          	"msg"=>"Insert Failure",
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