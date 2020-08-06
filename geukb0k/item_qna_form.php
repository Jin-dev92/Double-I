<?php	// 상품문의
include_once "path.php";

if($wr_id){
	$write = sql_fetch("select * from nfor_item_qna where wr_id='$wr_id'");
}

if($it_id){
	$item = sql_fetch("select * from nfor_item where it_id='$it_id'");
}

if($mode=="delete"){

	if(!$member[mb_no]) json_return("로그인하셔야 이용가능합니다");

	if($write[mb_no]==$member[mb_no] or $is_admin){
		sql_query("delete from nfor_item_qna where wr_id='$wr_id'");
		if ($wr_reply==0) {
			sql_query("delete from nfor_item_qna where wr_reply='$wr_id'");
		}

	}

	json_return("","ok");
	exit;
}

if($mode=="insert"){

	if(!$member[mb_no]) json_return("로그인하셔야 이용가능합니다");

	$wr_memo = strip_tags($wr_memo);
	sql_query("insert nfor_item_qna set it_id_gp='$item[it_id_gp]', it_id='$item[it_id]', supply_no='$item[supply_no]', wr_reply='$wr_reply', mb_no='$member[mb_no]', wr_memo='$wr_memo', wr_sms='$wr_sms', wr_datetime=NOW()");

	json_return("","ok");
	exit;
}

if($mode=="reply"){

	if(!$member[mb_no]) json_return("로그인하셔야 이용가능합니다");

	$wr_memo = strip_tags($wr_memo);
	sql_query("insert nfor_item_qna set it_id_gp='$item[it_id_gp]', it_id='$item[it_id]', supply_no='$item[supply_no]', wr_reply='$wr_reply', mb_no='$member[mb_no]', wr_memo='$wr_memo', wr_sms='$wr_sms', wr_datetime=NOW()");

	if($member[is_supply]){
		$write = sql_fetch("select * from nfor_item_qna where wr_reply='$wr_reply'");
		$mb = sql_fetch("select mb_email, mb_hp  from nfor_member where mb_no='$write[mb_no]'");
		nfor_send("item_qna", $mb[mb_email], $mb[mb_hp], $mb[mb_no]);
	}

	json_return("","ok");
	exit;
}

if($mode=="update"){

	if(!$member[mb_no]) json_return("로그인하셔야 이용가능합니다");

	$wr_memo = strip_tags($wr_memo);
	if($write[mb_no]==$member[mb_no] or $is_admin){
		sql_query("update nfor_item_qna set wr_memo='$wr_memo' where wr_id='$wr_id'");
	}

	json_return("","ok");
	exit;
}

if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=$PHP_SELF?it_id=$it_id");

if($write[wr_id] and !$write[wr_reply]){
	$nfor[title] = "상품문의수정";
	$nfor[btn_txt] = "수정하기";
} elseif(!$write[wr_id] and $wr_reply){
	$nfor[title] = "상품문의답변";
	$nfor[btn_txt] = "답변하기";
} elseif($write[wr_id] and $write[wr_reply]){
	$nfor[title] = "상품문의답변수정";
	$nfor[btn_txt] = "수정하기";
} else{
	$nfor[title] = "상품문의";
	$nfor[btn_txt] = "문의하기";
}

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>
