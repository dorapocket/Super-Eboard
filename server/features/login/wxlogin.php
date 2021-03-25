<?
function geturl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output,true);
        return $output;
}
require "../db/db.php";
  	$db=new Db();
  	$db->open();
if(isset($_GET['code'])){
  	$appid="wx172b55eacdb11b2c";
  	$appsecret="e97474833b2e2312471fe425a406d747";
	$wx=geturl("https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appsecret."&js_code=".$_GET['code']."&grant_type=authorization_code");
  	if(!($db->queryOpenidInAdminList($wx['openid']))){
    	$data=array(
    	"code"=>300,
      	"msg"=>"No Such User! Auth First!",
      	"data"=>array(
        	"openid"=>$wx['openid']
        ),
    );	
    }else{
      	$db->updateAdminLoginStatus($wx['openid'],$wx['session_key'],md5($wx['openid']."SmartXS".$wx['session_key']));
      	$admininfo=$db->getAdminInformation($wx['openid']);
    	$data=array(
        	"code"=>200,
          	"msg"=>"success",
          	"data"=>$admininfo
        );
    }
}else{
	$data=array(
    	"code"=>400,
      	"msg"=>"Invalid Requests",
      	"data"=>array()
    );
}
$db->close();
header('Content-type: application/json');
echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>