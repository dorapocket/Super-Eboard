<?php
	require "../db/db.php";
	$db=new Db;
	$db->open();
	$method=$_GET['method'];
	$normal=false;
	if(isset($_GET['method'])){
    switch($method){
      case "campus":
        $dataa=$db->initChickListCampus();
        $normal=true;
        break;
      case "grade":
        $campusid=$_GET['campusid'];
        if(isset($_GET['campusid'])){
        	$dataa=$db->initChickListGrade($campusid);
          $normal=true;
        }
        break;
      case "class":
        $campusid=$_GET['campusid'];
        $gradeid=$_GET['gradeid'];
        if(isset($_GET['campusid'])&&isset($_GET['gradeid'])){
        	$dataa=$db->initChickListClass($campusid,$gradeid);
          $normal=true;
        }
        break;
      default:
        $dataa=array();
        $normal=false;
        break;
    }
      if($normal){
      	$data=array(
        	"code"=>200,
          	"msg"=>"success",
          	"data"=>$dataa
        );
      }else{
      	$data=array(
        	"code"=>401,
          	"msg"=>"Invalid Arguments!",
          	"data"=>array()
        );
      }
    }else{
    	$data=array(
        	"code"=>400,
          	"msg"=>"Invalid Method!",
          	"data"=>array()
        );
    }
	$db->close();
	header('Content-type: application/json');
	echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>