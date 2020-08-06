<?php	// 경로설정
$path = "..";
include_once("$path/nfor.php");

$qstr = "sfl=$sfl&stx=$stx&page=$page";

$access_file = basename($_SERVER[PHP_SELF]);

$menu_code = sql_fetch("select * from nfor_access a, nfor_access_group b where a.gp_id=b.gp_id and a.access_file='$access_file'");

if(!$menu_code[access_id]){
	$menu_code = sql_fetch("select * from nfor_access where access_file='$access_file'");
}

$access_code = $menu_code[access_code];

if(!$member[is_supply] and $access_file<>"login.php"){
	goto_url("login.php");
} else{
	if($member[is_supply] < $menu_code[access_level]){
		alert("접근권한이 없습니다");
	}
}

//if($nfor[test]) alert("테스트모드에서는 이용하실수 없습니다. 1899-0320");
?>