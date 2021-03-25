<?php
	require "../db/db.php";
if(isset($_GET['classID'])&&isset($_GET['emergency'])&&isset($_GET['title'])&&isset($_GET['message'])&&isset($_GET['images'])&&isset($_GET['teacherID'])&&isset($_GET['appsecret'])){
  
	$db=new Db;
	$db->open();
    $class=$_GET['classID'];
    $emergency=$_GET['emergency'];
    $title=$_GET['title'];
    $message=$_GET['message'];
	$images=$_GET['images'];
	$teacherid=$_GET['teacherID'];
	$token=$_GET['appsecret'];
    if($db->validToken($token)){
    		//$imagejson=json_decode($images);
	$deal=false;
 	if(!$messageid=$db->sendMessage($class,$emergency,$title,$message,$images,$teacherid)){
    	$msg="Send Error ,try again later";
    }else{
    	$msg="success";
      	$deal=true;
    }
	if($deal){
    	$data=array(
        "code"=>200,
    	"msg"=>$msg,
        "data"=>array(
              	"messageid"=>$messageid
        )
    );
    }else{
    $data=array(
        "code"=>400,
    	"msg"=>$msg,
      	"data"=>array()
    );
    }

    }else{
    $data=array(
        "code"=>300,
    	"msg"=>"Bad Token!",
      	"data"=>array()
    );
    }
  $db->close();
}else{
	$data=array(
        "code"=>402,
    	"msg"=>"Invalid Arguments",
      	"data"=>array()
    );
}
	header('Content-type: application/json');
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>