<?php
include "path.php";

$nfor[title] = "환불계좌 설정";

if($mode=="bank_account"){

	sql_query("update nfor_member set mb_bank_name='$mb_bank_name', mb_bank_account='$mb_bank_account', mb_bank_agree='$mb_bank_agree' where mb_no='$member[mb_no]'");

	$return[msg] = "성공";
	$return[result] = "ok";
	$json = json_encode($return);
	echo $json;
	exit;
}

if(!$member[mb_no]) goto_url("login.php?url=bank_account.php");

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>