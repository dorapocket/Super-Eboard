<?php
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      	if($result=$db->getClassType()){
        	$data=array(
        	"code"=>200,
          	"msg"=>"success",
          	"data"=>$result
        	);
        }else{
        	$data=array(
        	"code"=>201,
          	"msg"=>"No ClassType Information!",
          	"data"=>array()
        	);
        }
      	$db->close();
header('Content-type: application/json');
echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>