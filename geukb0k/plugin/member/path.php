<?php
$path = "../..";	// 상대 경로
include_once "$path/nfor.php";

if(!$is_admin) alert_close("관리자만 확인가능합니다");
$mb = sql_fetch("select * from nfor_member where mb_no='$mb_no'");
if(!$mb[mb_no]) alert_close("존재하지 않는 회원입니다");
$qstr = "mb_no=$mb_no";
?>