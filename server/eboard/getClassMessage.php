<?php
if(isset($_GET['classID'])){
  	$classid=$_GET['classID'];
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      	$data=$db->queryClassMessage($classid,6);
  if($data){
    $fm_data=array();
    for($i=0;$i<count($data);$i++){
    	$temp=array(
        	"id"=>$data[$i][0],
          	"emergency"=>$data[$i][2],
          	"title"=>$data[$i][3],
          	"message"=>$data[$i][4],
          	"images"=>json_decode($data[$i][5])
        );
      	array_push($fm_data,$temp);
    }
    $opt=array(
    	"code"=>200,
      	"msg"=>"success",
      	"data"=>$fm_data
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