<?php
include_once "path.php";

$nfor[title] = "로그인";

if($member[mb_no]){
	if($url){
		goto_url($url);
	} else{
        goto_url($nfor[path]."/");
	}
}

if($url){
    $urlencode = urlencode($url);
} else{
    $urlencode = urlencode($_SERVER[REQUEST_URI]);
}

$mb_id = get_cookie("chk_save_id");
if(!$mb_id) $mb_id = "";

if($nfor[test]){
	$mb = sql_fetch("select * from nfor_member where mb_no='1'");
	if($nfor[id_type] == "mb_email"){
		$mb_id = $mb[mb_email];
	} else{
		$mb_id = $mb[mb_id];
	}
	$mb_password = $nfor[test_password];
} else{
	$mb_password = "";
}

include_once $nfor[skin_path]."login.php";
?>