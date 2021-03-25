<?php
$deal=false;
if(isset($_GET['stu_id'])&&isset($_GET['type'])&&isset($_GET['reason'])&&isset($_GET['iscontact'])&&isset($_GET['time_begin'])&&isset($_GET['time_end'])&&isset($_GET['teacher_id'])&&is_numeric($_GET['iscontact'])){
	$stu_id=$_GET['stu_id'];
	$type=$_GET['type'];
	$reason=$_GET['reason'];
	$iscontact=$_GET['iscontact'];
	$time_begin=$_GET['time_begin'];
	$time_end=$_GET['time_end'];
	$stat=0;
	$teacher_id=$_GET['teacher_id'];
  	require "../db/db.php";
  	$db=new Db;
  	$db->open();
  	if($db->insertLeave($stu_id,$type,$reason,$iscontact,$time_begin,$time_end,$stat,$teacher_id))
      $deal=true;
  	$db->close();
}
	if(!$deal){
    	$data=array(
        	"code"=>400,
          	"msg"=>"Invalied Arguments!"
        );
    }else{
    	$data=array(
        	"code"=>200,
          	"msg"=>"success"
        );
    }
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	
?>