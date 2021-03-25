<?php
	require "../db/db.php";
if(isset($_GET['teacherID'])&&isset($_GET['appsecret'])){
  	$db=new Db;
  	$db->open();
	$teacherid=$_GET['teacherID'];
  	$token=$_GET['appsecret'];
  	if($db->validToken($token)){
	$result=$db->queryUndealLeave($teacherid);
	$db->close();
	$data=array();
	if($result){
    	for($x=0;$x<count($result);$x++){
        	$temp=array(
            	"stu_name"=>$result[$x][6],
              	"tag"=>$result[$x][0],
              	"reason"=>$result[$x][1],
              	"iscontact"=>$result[$x][2]==1?"是":"否",
              	"begin_time"=>$result[$x][3],
              	"end_time"=>$result[$x][4],
              	"stat"=>($result[$x][5]==0)?("待审核"):($result[$x][5]==1?"已同意":"已拒绝"),
              	"id"=>$result[$x][7]
            );
          	array_push($data,$temp);
        } 
      	$opt=array(
        	"code"=>200,
          	"msg"=>"操作成功",
          	"cnt"=>count($result),
          	"data"=>$data
        );
    }else{
    	$opt=array(
        	"code"=>201,
          	"msg"=>"没有未处理的请假事项",
          	"cnt"=>0,
          	"data"=>$data
        );
    }}else{
    	$opt=array(
        	"code"=>300,
          	"msg"=>"Bad Token!",
          	"cnt"=>0,
          	"data"=>array()
        );
    }
}else{
	$opt=array(
        	"code"=>400,
          	"msg"=>"Invalid Arguments",
          	"cnt"=>0,
          	"data"=>array()
        );
}
header('Content-type: application/json');
echo json_encode($opt,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>