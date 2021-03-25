<?php
if(isset($_GET['messageID'])){
  	$messageid=$_GET['messageID'];
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      	$data=$db->queryClassMessageByID($messageid);
  if($data){
    	$temp=array(
        	"id"=>$data[0][0],
          	"emergency"=>$data[0][2],
          	"title"=>$data[0][3],
          	"message"=>$data[0][4],
          	"images"=>json_decode($data[0][5])
        );
    $opt=array(
    	"code"=>200,
      	"msg"=>"success",
      	"data"=>$temp
    );
  }else{
  	$opt=array(
    	"code"=>401,
      	"msg"=>"Wrong ID or No Messages!",
      	"data"=>""
    );
  }
      	$db->close();
}else{
	$opt=array(
    	"code"=>400,
      	"msg"=>"Invalid Arguments",
      	"data"=>"",
    );
}
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
echo json_encode($opt,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>