<?php 
include_once "path.php";

$redirect_uri  = $nfor[http_url]."/kakao_oauth.php"; 

$opts = array( 
CURLOPT_URL => "https://kauth.kakao.com/oauth/authorize?client_id={$api[kakao_rest]}&redirect_uri={$redirect_uri}&response_type=code", 
CURLOPT_SSL_VERIFYPEER => true, 
CURLOPT_SSLVERSION => 1, // TLS
CURLOPT_RETURNTRANSFER => true, 
CURLOPT_HEADER => true 
); 

$curlSession = curl_init(); 
curl_setopt_array($curlSession, $opts); 
$accessTokenJson = curl_exec($curlSession); 
curl_close($curlSession); 

$exp = explode("Location: ", trim($accessTokenJson)); 
$move_url = explode("\n", trim($exp[1])); 

if(trim($move_url[0])){
	goto_url(trim($move_url[0]));
} else{
	goto_url("index.php");
}
?>