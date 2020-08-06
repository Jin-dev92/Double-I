<?php
include_once "path.php";

$nfor[title] = "회원정보수정";

if(!$member[mb_no]){
	goto_url("login.php?url=member_form.php");
	exit;
} 

if(!$_SESSION[password_expiry_date] or $_SESSION[password_expiry_date] < $nfor[ymdhis]){
	goto_url("member_confirm.php");
	exit;
}

if($mode=="update"){


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
		$hp_check = json_decode(hp_check($mb_hp,$mb_no),true);
		if($hp_check[result] != "ok") alert($hp_check[msg]);
	}
	$mb_hp = add_hyphen($mb_hp);


	$email_check = json_decode(email_check($mb_email,$mb_no),true);
	if($email_check[result] != "ok") alert($email_check[msg]);
	
	if($mb_password_now){

		$password_now_check = json_decode(password_now_check($mb_password_now),true);
		if($password_now_check[result] != "ok") alert($password_now_check[msg]);
		
		$password_check = json_decode(password_check($mb_password),true);
		if($password_check[result] != "ok") alert($password_check[msg]);
		
		$password_confirm_check = json_decode(password_confirm_check($mb_password,$mb_password_confirm),true);
		if($password_confirm_check[result] != "ok") alert($password_confirm_check[msg]);

		sql_query("update nfor_member set mb_password=password('$mb_password') where mb_no='$member[mb_no]'");

	}

	sql_query("update nfor_member set mb_name='$mb_name',
									mb_hp='$mb_hp', 
									mb_email='$mb_email', 
									mb_birth='$mb_birth',
									mb_sex='$mb_sex',
									mb_zipcode='$mb_zipcode',
									mb_addr1='$mb_addr1',
									mb_addr2='$mb_addr2',
									mb_mailling='$mb_mailling', 
									mb_sms='$mb_sms',
									mb_ip = '$_SERVER[REMOTE_ADDR]',
									mb_login_ip = '$_SERVER[REMOTE_ADDR]' where mb_no='$member[mb_no]'");

	alert("회원정보가 수정되었습니다","member_form.php");
	exit;
}



include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>