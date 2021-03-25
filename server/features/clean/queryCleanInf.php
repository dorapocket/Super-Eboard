<?php
	if(isset($_GET['classID'])&&isset($_GET['appsecret'])){
      	$token=$_GET['appsecret'];
    	$classid=$_GET['classID'];
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
        if($db->validToken($token)){
      	if($result=$db->queryCleanScoreContext($classid)){
	if($result){
      $dataa=array();
      $all=0;
    	for($x=0;$x<count($result);$x++){
        	$temp=array(
            	"ID"=>$result[$x][0],
              	"classID"=>$result[$x][1],
              	"tag"=>$result[$x][2],
              	"reason"=>$result[$x][3],
              	"score"=>$result[$x][4],
              	"weekClassID"=>$result[$x][5],
              	"weekStudentID"=>$result[$x][6],
              	"time"=>$result[$x][7],
              	"studentName"=>$result[$x][8],
              	"className"=>$result[$x][9]
            );
          	array_push($dataa,$temp);
          $all=$all+$result[$x][4];
        } 
      	$data=array(
        	"code"=>200,
          	"msg"=>"success",
          	"cnt"=>count($dataa),
          	"allscore"=>$all,
          	"data"=>$dataa
        );
    }
        }else{
        	$data=array(
        	"code"=>201,
          	"msg"=>"No Clean Score Information",
          	"data"=>array()
        	);
        }

        }else{
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