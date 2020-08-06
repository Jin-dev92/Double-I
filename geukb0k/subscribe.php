<?php	// 구독하기
include_once "path.php";

if($mode=="insert"){
	if(!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $wr_email)) json_return("이메일 형식이 올바르지 않습니다","email_match");
	$is_email = sql_fetch("select count(*) as cnt from nfor_subscribe where wr_email='$wr_email'");
	if(!$is_email[cnt]){
		sql_query("insert nfor_subscribe set wr_datetime=NOW(), wr_email='$wr_email'");
		json_return("구독신청이 완료되었습니다","ok");
		exit;
	} else{
		json_return("이미 존재하는 이메일입니다","is_email");
	}
	exit;
}

?>