<?php 
include_once "path.php";

$opts = array( 
CURLOPT_URL => "https://kauth.kakao.com/oauth/token", 
CURLOPT_SSL_VERIFYPEER => false, 
CURLOPT_SSLVERSION => 1, // TLS
CURLOPT_POST => true, 
CURLOPT_POSTFIELDS => "grant_type=authorization_code&client_id={$api[kakao_rest]}&redirect_uri={$nfor[http_url]}/kakao_oauth.php&code={$_GET[code]}", 
CURLOPT_RETURNTRANSFER => true, 
CURLOPT_HEADER => false 
); 

$curlSession = curl_init(); 
curl_setopt_array($curlSession, $opts); 
$accessTokenJson = curl_exec($curlSession); 
curl_close($curlSession); 


$json = json_decode($accessTokenJson);

$token =  $json->access_token;

$headers = array(
	'Authorization: Bearer '.$token,
	'Content-type: application/x-www-form-urlencoded;charset=utf-8'
);

$params = array('url'=> 'https://developers.kakao.com');
$linkInfoContent = curl_request("https://kapi.kakao.com/v1/user/me", $params, "", $headers);

$mb = json_decode($linkInfoContent);

$kakao_id = $mb->id;
$kakao_name = $mb->properties->nickname;
//$_SESSION[kakao_mb_image] = $mb->properties->profile_image;

$mb = sql_fetch("select * from nfor_member where mb_kakao_id='$kakao_id'");
if($mb[mb_kakao_id]){
	$_SESSION[ss_mb_no] = $mb[mb_no];
	goto_url("index.php");
}

$_SESSION[sns_login] = "kakao";
$_SESSION[kakao_id] = $kakao_id;
$_SESSION[kakao_name] = $kakao_name;

goto_url("member_join.php");
?>