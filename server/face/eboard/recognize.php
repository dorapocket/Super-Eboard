<?php
require "main.php";
$image=$_POST["image"];
$imageType = "BASE64";
$groupIdList = "student";
// 调用人脸搜索
$options=array();
$options["match_threshold"] = 80;
$result=$client->search($image, $imageType, $groupIdList,$options);
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods:PUT,POST,GET,DELETE,OPTIONS');
echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>