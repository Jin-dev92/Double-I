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
		sql_query("update nfor_cart set is_star='0' where it_id='$it_id' and mb_no='$member[mb_no]' ");
		@unlink($nfor[path]."/data/star/".$write[wr_img]);
		@unlink($nfor[path]."/data/star/".$write[wr_before]);
		@unlink($nfor[path]."/data/star/".$write[wr_after]);
	}
	alert("정상적으로 삭제되었습니다","item.php?it_id=".$it_id."&tab=4");
	exit;
}

if($wr_before= file_upload($nfor[path]."/data/star/", $_FILES["wr_before"])){
	$add_sql .= " , wr_before='$wr_before'";
}
if($wr_after= file_upload($nfor[path]."/data/star/", $_FILES["wr_after"])){
	$add_sql .= " , wr_after='$wr_after'";
}

if($mode=="insert"){
	$last_star = sql_fetch("select * from nfor_item_star where it_id='$it_id' order by wr_id desc limit 1");
	if($last_star[mb_no]==$member[mb_no]) alert("같은상품에 대해 연속적인 후기작성은 불가합니다","item.php?it_id=".$it_id);

	if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=$PHP_SELF?it_id=$it_id");

	$chk_buy = sql_fetch("select * from nfor_cart a, nfor_order b where a.cart_id=b.cart_id and a.pay_step='1' and b.mb_no='$member[mb_no]' and a.it_id='$it_id' and a.is_star='0' order by b.od_id desc");
	if(!$chk_buy[it_id]) alert("구매내역이 있는분만 후기 작성이 가능합니다","item.php?it_id=".$it_id);

	$chk_star = sql_fetch("select * from nfor_item_star where od_id='$chk_buy[od_id]' and mb_no='$member[mb_no]' and it_id='$it_id'");
	if($chk_star[od_id]) alert("이미 후기를 작성하신 상품입니다","item.php?it_id=".$it_id);
	// $wr_memo = strip_tags($wr_memo);
	$add_sql .= it_img_upload("star","wr_img");

	sql_query("insert nfor_item_star set supply_no='$item[supply_no]',it_id_gp='$item[it_id_gp]', it_id='$item[it_id]', wr_reply='$wr_reply', mb_no='$member[mb_no]', wr_memo='$wr_memo', wr_tit='$wr_tit', wr_datetime=NOW(), od_id='$chk_buy[od_id]', wr_star='$wr_star' $add_sql");

	$is_star = sql_insert_id();

	sql_query("update nfor_cart set is_star='$is_star' where cart_id='$chk_buy[cart_id]' and it_id='$chk_buy[it_id]'");

	$option_sum = sql_fetch("select sum(option_price*option_cnt) as option_sum from nfor_cart where cart_id='$chk_buy[cart_id]' and it_id='$chk_buy[it_id]' and pay_step='1'");
	if($add_sql){
		if($config[cf_pstar_type]=="1"){
			$p_pstar_money = ($option_sum[option_sum]/100)*$config[cf_pstar_per];
		} else{
			$p_pstar_money = $config[cf_pstar_won];
		}
		insert_money($member[mb_no],$p_pstar_money,"포토 구매후기작성","6",$chk_buy[od_id]);
	} else{
		if($config[cf_star_type]=="1"){
			$p_star_money = ($option_sum[option_sum]/100)* $config[cf_star_per];
		} else{
			$p_star_money = $config[cf_star_won];
		}
		insert_money($member[mb_no],$p_star_money,"구매후기작성","5",$chk_buy[od_id]);
	}
	alert("정상적으로 등록되었습니다","star.php?it_id=".$it_id."&wr_id=".$is_star."");
	exit;
}

if($mode=="update"){

	if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=$PHP_SELF?it_id=$it_id");

	// $wr_memo = strip_tags($wr_memo);
	if($write[mb_no]==$member[mb_no] or $is_admin){

		if($wr_img_del){
			sql_query("update nfor_item_star set wr_img='' where wr_id='$write[wr_id]'");
			@unlink($nfor[path]."/data/star/".$write[wr_img]);
		}
		if ($wr_before_del) {
			sql_query("update nfor_item_star set wr_before='' where wr_id='$write[wr_id]'");
			@unlink($nfor[path]."/data/star/".$write[wr_before]);
		}
		if ($wr_after_del) {
			sql_query("update nfor_item_star set wr_after='' where wr_id='$write[wr_id]'");
			@unlink($nfor[path]."/data/star/".$write[wr_after]);
		}
		sql_query("update nfor_item_star set wr_memo='$wr_memo', wr_tit='$wr_tit', wr_star='$wr_star' $add_sql where wr_id='$write[wr_id]'");
	}
	alert("정상적으로 등록되었습니다","star.php?it_id=".$it_id."&wr_id=".$wr_id."");
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
