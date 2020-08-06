<?php	// 상품평
include_once "path.php";

if($wr_id){
	$write = sql_fetch("select * from nfor_item_star where wr_id='$wr_id'");
}

if($it_id){
	$item = sql_fetch("select * from nfor_item where it_id='$it_id'");
}


if($mode=="delete"){

	if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=$PHP_SELF?it_id=$it_id");

	if($write[mb_no]==$member[mb_no] or $is_admin){
		sql_query("delete from nfor_item_star where wr_id='$write[wr_id]'");
	}
	if ($wr_reply2==$wr_reply) {
		alert("정상적으로 삭제되었습니다","star.php?it_id=".$it_id."&wr_id=".$wr_reply."");
	}else{
		alert("정상적으로 삭제되었습니다","star.php?it_id=".$it_id."&wr_id=".$wr_reply2."");
	}
	exit;
}

if($mode=="insert"){
	if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=$PHP_SELF?it_id=$it_id");
	$wr_memo = strip_tags($wr_memo);
	sql_query("insert nfor_item_star set supply_no='$item[supply_no]',it_id_gp='$item[it_id_gp]', it_id='$item[it_id]', wr_reply='$wr_reply', mb_no='$member[mb_no]', wr_memo='$wr_memo', wr_tit='$wr_tit', wr_datetime=NOW(), od_id='$chk_buy[od_id]', wr_star='$wr_star' $add_sql");

	if ($wr_reply2==$wr_reply) {
		alert("정상적으로 등록되었습니다","star.php?it_id=".$it_id."&wr_id=".$wr_reply."");
	}else {
		alert("정상적으로 등록되었습니다","star.php?it_id=".$it_id."&wr_id=".$wr_reply2."");
	}

	exit;
}

if($mode=="update"){

	if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=$PHP_SELF?it_id=$it_id");

	$wr_memo = strip_tags($wr_memo);
	if($write[mb_no]==$member[mb_no] or $is_admin){

		// if($wr_img_del){
		// 	sql_query("update nfor_item_star set wr_img='' where wr_id='$write[wr_id]'");
		// 	@unlink($nfor[path]."/data/star/".$write[wr_img]);
		// }
		// if ($wr_before_del) {
		// 	sql_query("update nfor_item_star set wr_before='' where wr_id='$write[wr_id]'");
		// 	@unlink($nfor[path]."/data/star/".$write[wr_before]);
		// }
		// if ($wr_after_del) {
		// 	sql_query("update nfor_item_star set wr_after='' where wr_id='$write[wr_id]'");
		// 	@unlink($nfor[path]."/data/star/".$write[wr_after]);
		// }
		sql_query("update nfor_item_star set wr_memo='$wr_memo', wr_star='$wr_star' $add_sql where wr_id='$write[wr_id]'");
	}
	if ($wr_reply2==$wr_reply) {
		alert("정상적으로 등록되었습니다","star.php?it_id=".$it_id."&wr_id=".$wr_reply."");
	}else {
		alert("정상적으로 등록되었습니다","star.php?it_id=".$it_id."&wr_id=".$wr_reply2."");
	}
	exit;
}

if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=$PHP_SELF?it_id=$it_id");

if($write[wr_id] and !$write[wr_reply]){
	$nfor[title] = "상품평수정";
	$nfor[btn_txt] = "수정하기";
} else{
	$nfor[title] = "상품평작성";
	$nfor[btn_txt] = "등록하기";
}

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>
