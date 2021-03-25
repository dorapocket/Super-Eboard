<?php
if(isset($_GET['classID'])&&isset($_GET['week'])){
  	$classid=$_GET['classID'];
	$week=$_GET['week'];
  
$array = ["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
$time=date("w",time( ));
$weeka=$array[$time];
$year=date("Y");
$month=date("m");
$day=date("d");
  
  
      	require "../db/db.php";
      	$db=new Db;
      	$db->open();
      	$data=$db->getClassTime();
  $class=json_decode($db->getClassTable($classid,$week)[0][0]);
  if($data&&$class){
		$nxt=-1;
		for($i=0;$i<sizeof($data);$i++){
          	$begin=date("H:i:s",strtotime($data[$i][2]));
          	$end=date("H:i:s",strtotime($data[$i][3]));
        	$now=date("H:i:s",time());
          	
          	if($now<=$begin){
            	if($i==0){$nxt=$data[$i][0];break;}
              	else{
                  if($i==sizeof($data)-1){
                  	break;
                  }
                	$nxt=((int)$data[$i][0]);break;
                }
            }
        }
		$num=(int)$nxt;
		if($class){
        	if($num==-1){
        	$result="无";
        }else{
        	$result=$class[$num-1];
        }
        }else{
        	$result="无";
        }
    $opt=array(
    	"code"=>200,
      	"msg"=>"success",
      	"data"=>$result,
      	"time"=>array(
    		"year"=>$year,
      		"month"=>$month,
      		"day"=>$day,
      		"week"=>$weeka
    	),
    );
  }else{
  	$opt=array(
    	"code"=>401,
      	"msg"=>"Wrong ID or No ClassTable is set!",
      	"data"=>"",
      "time"=>array(
    		"year"=>$year,
      		"month"=>$month,
      		"day"=>$day,
      		"week"=>$weeka
    	),
    );
  }
      	$db->close();
}else{
	$opt=array(
    	"code"=>400,
      	"msg"=>"Invalid Arguments",
      	"data"=>"",
      "time"=>array(
    		"year"=>$year,
      		"month"=>$month,
      		"day"=>$day,
      		"week"=>$weeka
    	),
    );
}
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
echo json_encode($opt,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>