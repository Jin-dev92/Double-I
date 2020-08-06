<?php
include "path.php";

$nfor[title] = "회원가입";

if($mode=="insert"){
	$name_check = json_decode(name_check($mb_name),true);
	if($name_check[result] != "ok") alert($name_check[msg]);

	$mb_birth = $mb_birth_1."-".sprintf("%02d",$mb_birth_2)."-".sprintf("%02d",$mb_birth_3);
	$birth_check = json_decode(birth_check($mb_birth),true);
	if($birth_check[result] != "ok") alert($birth_check[msg]);

	$sex_check = json_decode(sex_check($mb_sex),true);
	if($sex_check[result] != "ok") alert($sex_check[msg]);	

	if($asign_number){
		$asign_confirm = json_decode(asign_confirm($mb_hp,$asign_number),true);
		if($asign_confirm[result] != "ok") alert($asign_confirm[msg]);
	} else{
		$hp_check = json_decode(hp_check($mb_hp),true);
		if($hp_check[result] != "ok") alert($hp_check[msg]);
	}
	$mb_hp = add_hyphen($mb_hp);

	if($nfor[id_type]=="mb_id"){
		$id_check = json_decode(id_check($mb_id),true);
		if($id_check[result] != "ok") alert($id_check[msg]);
	}
	
	$email_check = json_decode(email_check($mb_email),true);
	if($email_check[result] != "ok") alert($email_check[msg]);
	
	$password_check = json_decode(password_check($mb_password),true);
	if($password_check[result] != "ok") alert($password_check[msg]);
	
	$password_confirm_check = json_decode(password_confirm_check($mb_password,$mb_password_confirm),true);
	if($password_confirm_check[result] != "ok") alert($password_confirm_check[msg]);
	
	sql_query("insert nfor_member set mb_id='$mb_id',
									mb_password=password('$mb_password'),
									mb_name='$mb_name',
									mb_hp='$mb_hp', 
									mb_email='$mb_email', 
									mb_birth='$mb_birth',
									mb_sex='$mb_sex',
									mb_mailling='$mb_mailling', 
									mb_sms='$mb_sms',
									mb_datetime = NOW(),
									mb_ip = '$_SERVER[REMOTE_ADDR]',
									mb_level = '2',
									mb_login_ip = '$_SERVER[REMOTE_ADDR]',
									mb_facebook_id = '$mb_facebook_id',
									mb_kakao_id = '$mb_kakao_id'");

	$mb_no = sql_insert_id();

	if($config[cf_join_money]) insert_money($mb_no,$config[cf_join_money],"회원가입","1");
	if($mb_friend){	
		$mb = sql_fetch("select * from nfor_member where {$nfor[id_type]}='$mb_friend'");	// 아이디일경우 mb_id, 이메일일경우 mb_email
		if($mb[mb_no]){
			$mb_friend_no = $mb[mb_no];
			if($config[cf_friend_money1]) insert_money($mb_no,$config[cf_friend_money1],"추천인입력","9");
			if($config[cf_friend_money2]) insert_money($mb[mb_no],$config[cf_friend_money2],"추천받음","10");
			sql_query("update nfor_member set mb_friend_no = '$mb_friend_no' where mb_no='$mb_no'");
		}
	}

    $_SESSION[ss_mb_no] = $mb_no;

	nfor_send("member_join", $mb_email, $mb_hp, $mb_no);
	



	goto_url("index.php");
	exit;
}


if(($config[cf_ipin_use] or $config[cf_hp_use]) and $config[cf_check_code] and !$_SESSION[okname_asign]){ 
	goto_url("member_check.php");
}



if($_SESSION[okname_asign]){ 
	$mb_name = $_SESSION[okname_name];
	$mb_sex = $_SESSION[okname_sex];
	$mb_birth = $_SESSION[okname_birth];
	$mb_birth_1 = substr($mb_birth,0,4);
	$mb_birth_2 = substr($mb_birth,4,2);
	$mb_birth_3 = substr($mb_birth,6,2);
	$mb_hp = $_SESSION[okname_hp];
} else{		

	if($_SESSION[sns_login]=="kakao"){
		$mb_kakao_id = $_SESSION[kakao_id];
		$mb_name = $_SESSION[kakao_name];
	} elseif($_SESSION[sns_login]=="facebook"){
		$mb_facebook_id = $_SESSION[facebook_id];
		$mb_name = $_SESSION[facebook_name];
		$mb_email = $_SESSION[facebook_email];
	} else{
		$mb_name = "";
	}

}






include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);



$_SESSION[okname_asign] = "";
$_SESSION[facebook_id] = "";
$_SESSION[facebook_name] = "";
$_SESSION[facebook_email] = "";
$_SESSION[kakao_id] = "";
$_SESSION[kakao_name] = "";


?>