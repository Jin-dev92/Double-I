<?php	// 회원가입
include "path.php";

if(!$member[mb_no]) alert("회원만 접근가능합니다.");

if($mode=="update"){

	if($is_admin) alert("관리자는 이용할수 없습니다.");
	if(!$mb_password) alert("패스워드를 입력해주세요.");
	if(!($mb_password && $member[mb_password] == sql_password($mb_password))) alert("입력하신 패스워드가 일치하지 않습니다.");

	sql_query(" update nfor_member set mb_leavedatetime=NOW(), mb_secession='$mb_secession' where mb_no = '$member[mb_no]' ");


	nfor_send("member_leave",$member[mb_email],$member[mb_hp],$order[mb_no]);


	session_unregister("ss_mb_no");
	session_unset();
	session_destroy();

	alert("정상적으로 탈퇴신청 하셨습니다.", $nfor[url]);
	exit;
}

include_once $nfor[skin_path]."member_leave.php";
?>