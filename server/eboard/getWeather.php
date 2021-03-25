<?php
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
$quality=geturl("https://free-api.heweather.net/s6/air/now?location=ningbo&key=b7c05c7350fe427eb856c1d1442dd51f");
$aqi=$quality["HeWeather6"][0];
$nowweather=geturl("https://free-api.heweather.net/s6/weather/now?location=ningbo&key=b7c05c7350fe427eb856c1d1442dd51f");
$nowtemp=$nowweather['HeWeather6'][0];
$forecast=geturl("https://free-api.heweather.net/s6/weather/forecast?location=ningbo&key=b7c05c7350fe427eb856c1d1442dd51f");
$text=$forecast['HeWeather6'][0];

$json=array(
    	"now"=>$nowtemp,
      	"quality"=>$aqi,
      	"forecast"=>$text
);
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
echo json_encode($json,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>