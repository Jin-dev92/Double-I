<?php // 패스워드찾기
include "path.php";

$nfor[title] = "패스워드찾기";

if($mode=="hp_check"){
	$mb_name = trim($mb_name);
	$mb_hp = trim($mb_hp);
	if(!$mb_name){
		$return[msg] = "이름을 입력해주세요";
	} elseif(preg_match("/[^0-9]+/i", $mb_hp)){
		$return[msg] = "숫자만입력해주세요";
	} elseif(strlen($mb_hp) < 10){
		$return[msg] = "휴대폰번호를 올바르게 입력해주세요";
	} else{
		$mb_hp = add_hyphen($mb_hp);
		$mb = sql_fetch("select mb_no, mb_hp from nfor_member where mb_name='$mb_name' and mb_hp='$mb_hp'");
		if($mb[mb_no]){
			$nfor[tmp_password] = rand("1111","9999");
			sql_query("update nfor_member set mb_password=password('$nfor[tmp_password]') where mb_no='$mb[mb_no]'");
			nfor_send("find_password","",$mb[mb_hp],$mb[mb_no]);
			$return[msg] = "고객님의 $mb[mb_hp] 휴대폰으로 임시 패스워드를 전송하였습니다";
			$return[result] = "ok";
		} else{
			$return[msg] = "입력하신 정보와 일치하는 아이디가 존재하지 않습니다";
		}
	}
	$json = json_encode($return);
	echo $json;
	exit;
}

if($mode=="email_check"){
	$mb_name = trim($mb_name);
	$mb_email = trim($mb_email);
	if(!$mb_name){
		$return[msg] = "이름을 입력해주세요";
	} elseif(!$mb_email){
		$return[msg] = "이메일 주소를 입력하십시오.";
	} elseif(!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $mb_email)) {
		$return[msg] = "이메일 주소가 형식에 맞지 않습니다.";
	} else{	
		$mb = sql_fetch("select mb_no, mb_email from nfor_member where mb_name='$mb_name' and mb_email='$mb_email'");
		if($mb[mb_no]){
			$nfor[tmp_password] = rand("1111","9999");
			sql_query("update nfor_member set mb_password=password('$nfor[tmp_password]') where mb_no='$mb[mb_no]'");
			nfor_send("find_password",$mb[mb_email],"",$mb[mb_no]);
			$return[msg] = "고객님의 $mb[mb_email] 메일로 임시 패스워드를 전송하였습니다";
			$return[result] = "ok";
		} else{
			$return[msg] = "입력하신 정보와 일치하는 아이디가 존재하지 않습니다";
		}
	}
	$json = json_encode($return);
	echo $json;
	exit;
}

include_once $nfor[skin_path]."find_password.php";
?>