<?php
if(isset($_GET['classID'])){
  	$classid=$_GET['classID'];
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      	$data=$db->getClassInf($classid);
  if($data){
    $opt=array(
    	"code"=>200,
      	"msg"=>"success",
      	"data"=>array(
        	"classname"=>$data[0][0],
          	"teachername"=>$data[0][1]
        )
    );
  }else{
  	$opt=array(
    	"code"=>401,
      	"msg"=>"Wrong ID or No Such Class!",
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


