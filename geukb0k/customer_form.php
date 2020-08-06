<?php
include_once "path.php";

if(!$config[cf_guest_customer] and !$member[mb_no]){
	alert("로그인하셔야 이용가능합니다","login.php?url=customer_form.php");
}


$nfor[title] = "1:1문의";

if($mode=="insert"){

	$wr_tel = $wr_hp1."-".$wr_hp2."-".$wr_hp3;
	sql_query("insert nfor_customer set it_id='$it_id', mb_no='$member[mb_no]', ca_name='$ca_name',wr_subject='$wr_subject',wr_memo='$wr_memo',wr_email='$wr_email',wr_tel='$wr_tel',wr_name='$wr_name',wr_datetime=NOW(),wr_is_reply='1'");
	
	if($member[mb_no]){
		alert("정상적으로 등록되었습니다","customer_list.php");
	} else{
		alert("정상적으로 등록되었습니다","customer_form.php");
	}
	exit;
}

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>