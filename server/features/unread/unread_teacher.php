<?php
	if(isset($_GET['teacherID'])&&isset($_GET['appsecret'])){
      	$teacher_id=$_GET['teacherID'];
	$token=$_GET['appsecret'];
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      if($db->validToken($token)){
      	$result=$db->searchTeacherCommand($teacher_id);
      	$db->close();
      	$data=array();
      	if($result){
    	for($x=0;$x<count($result);$x++){
          switch($result[$x][1]){
            case "message":
              $hz="消息";
              $icon="mark";
              break;
            case "leave":
              $hz="请假";
              $icon="friendfill";
              break;
            default:
              $hz="";
              $icon="";
          }
        	$temp=array(
            	"id"=>$result[$x][0],
              	"type"=>$result[$x][1],
              	"typeid"=>$result[$x][2],
              	"teacher_id"=>$result[$x][3],
              	"information"=>$result[$x][5],
              	"typezw"=>$hz,
              	"icon"=>$icon
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
          	"msg"=>"没有消息",
          	"cnt"=>0,
          	"data"=>$data
        );
    }}else{
      $opt=array(
        	"code"=>300,
          	"msg"=>"Bad Token",
          	"cnt"=>0,
          	"data"=>array()
        );
      
      }
    }else{
    	$opt=array(
        	"code"=>400,
          	"msg"=>"Invalid Arguments",
          	"cnt"=>0,
          	"data"=>$data
        );
    }
header('Content-type: application/json');
echo json_encode($opt,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>