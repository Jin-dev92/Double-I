<?php
include_once "path.php";

$nfor[title] = "주문상세";

$order = sql_fetch("select * from nfor_order where od_id='$od_id' and mb_no='$member[mb_no]'");


if($mode=="order_hide"){

	sql_query("update nfor_order set od_view='1' where od_id='$od_id' and mb_no='$member[mb_no]'");

	$return[msg] = "성공";
	$return[result] = "ok";
	$json = json_encode($return);
	echo $json;
	exit;
}

if($mode=="delivery_chage"){

	$dy_hp = add_hyphen($dy_hp);
	$dy_tel = add_hyphen($dy_tel);

	sql_query("update nfor_order set dy_name='$dy_name', dy_hp='$dy_hp', dy_tel='$dy_tel', dy_zip='$dy_zip', dy_addr1='$dy_addr1', dy_addr2='$dy_addr2', dy_msg='$dy_msg' where od_id='$od_id'");


	$return[msg] = "성공";
	$return[result] = "ok";
	$return[od_id] = $od_id;

	$json = json_encode($return);
	echo $json;
	exit;
}



include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>