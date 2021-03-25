<?php
       	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      	$data=$db->getClassTime();
    	$opt=array();
  if($data){
		$nxt=-1;
		for($i=0;$i<sizeof($data);$i++){
          	$name=$data[$i][1];
          	$begin=explode(":",$data[$i][2]);
          	$beginstamp=intval($begin[0])*60*60+intval($begin[1])*60+intval($begin[2]);
          	$end=explode(":",$data[$i][3]);
          	$endstamp=intval($end[0])*60*60+intval($end[1])*60+intval($end[2]);
        	$day=array(
            	"class"=>$name,
              	"begin"=>$data[$i][2],
              	"beginStamp"=>$beginstamp,
              	"end"=>$data[$i][3],
              	"endStamp"=>$endstamp
            );
          array_push($opt,$day);
        }
  }
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
echo json_encode($opt,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>