<?php
include_once "path.php";

$nfor[title] = "회원정보확인";

if(!$member[mb_no]) goto_url("login.php?url=member_confirm.php");

if($mode=="member_confirm"){
	if(sql_password($mb_password) != $member[mb_password]){
		alert("로그인 패스워드와 입력하신 패스워드가 일치하지 않습니다");
	}
	$_SESSION[password_expiry_date] = date("Y-m-d H:i:s",strtotime("+1 hours"));
	goto_url("member_form.php");
	exit;
}

if($nfor[test]){
	$mb_password = $nfor[test_password];
} else{
	$mb_password = "";
}

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>