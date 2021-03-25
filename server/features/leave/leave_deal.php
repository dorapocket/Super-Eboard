<?php
	require "../db/db.php";
	$db=new Db;
	$db->open();
	$deal=false;
	if(isset($_GET['id'])&&isset($_GET['result'])&&isset($_GET['teacherID'])&&isset($_GET['appsecret'])){
      	$id=$_GET['id'];
		$result=$_GET['result'];
		$teacher_id=$_GET['teacherID'];
		$token=$_GET['appsecret'];
      	if($db->validToken($token)){
      	if($result=="agree"){
        	if($db->dealLeaveRequest($id,1)){
            	 $db->modifyTeacherCommandByType("leave",$id,$teacher_id,1);
                 $deal=true;
            }
        }
		if($result=="disagree"){
        	if($db->dealLeaveRequest($id,2)){
            	 $db->modifyTeacherCommandByType("leave",$id,$teacher_id,1);
                 $deal=true;
            }
        }
      	if($result=="pending"){
        	if($db->dealLeaveRequest($id,0)){
            	 $db->modifyTeacherCommandByType("leave",$id,$teacher_id,0);
                 $deal=true;
            }
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
    }else{
      $data=array(
        	"code"=>300,
          	"msg"=>"Bad Token!"
        );
    }
    }
$db->close();
header('Content-type: application/json');
echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>