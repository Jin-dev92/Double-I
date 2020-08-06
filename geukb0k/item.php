<?php	// 상품상세
include_once "path.php";

$item = item($it_id);

$nfor[title] = "상품상세";

if($member[mb_no]){
	$zzim = sql_fetch("select wr_id from nfor_zzim where it_id='$item[it_id]' and mb_no='$member[mb_no]'");
	$alarm = sql_fetch("select wr_id from nfor_alarm where it_id='$item[it_id]' and mb_no='$member[mb_no]'");
	if($zzim[wr_id]){
		$item[zzim_is] = "1";
	}
	if($alarm[wr_id]){
		$item[alarm_is] = "1";
	}
}

if($mode=="zzim"){

	if(!$item[it_id]){
		$return[msg] = "존재하지 않는 상품코드입니다";
	} elseif(!$member[mb_no]){
		$return[msg] = "로그인하셔야 이용가능합니다";
		$return[result] = "login";
	} else{
		if($zzim[wr_id]){
			sql_query("delete from nfor_zzim where wr_id='$zzim[wr_id]' and mb_no='$member[mb_no]'");
			$return[msg] = "이미 찜하기로 등록하신 상품입니다";
			$return[result] = "delete";
		} else{
			sql_query("insert nfor_zzim set it_id='$item[it_id]', mb_no='$member[mb_no]', wr_datetime=NOW()");
			$return[result] = "insert";
		}
		$it_zzim = sql_fetch("select count(*) as cnt from nfor_zzim where it_id='$item[it_id]'");
		sql_query("update nfor_item set it_zzim='$it_zzim[cnt]' where it_id='$item[it_id]'");
	}
	$json = json_encode($return);
	echo $json;
	exit;
}

if($mode=="alarm"){

	if(!$item[it_id]){
		$return[msg] = "존재하지 않는 상품코드입니다";
	} elseif(!$member[mb_no]){
		$return[msg] = "로그인하셔야 이용가능합니다";
		$return[result] = "login";
	} else{
		if($alarm[wr_id]){
			sql_query("delete from nfor_alarm where wr_id='$alarm[wr_id]' and mb_no='$member[mb_no]'");
			$return[msg] = "이미 찜하기로 등록하신 상품입니다";
			$return[result] = "delete";
		} else{
			sql_query("insert nfor_alarm set it_id='$item[it_id]', mb_no='$member[mb_no]', wr_datetime=NOW()");
			$return[result] = "insert";
		}
		$it_alarm = sql_fetch("select count(*) as cnt from nfor_alarm where it_id='$item[it_id]'");
		sql_query("update nfor_item set it_alarm='$it_alarm[cnt]' where it_id='$item[it_id]'");
	}
	$json = json_encode($return);
	echo $json;
	exit;
}

if(!$item[it_id]) alert("해당상품이 존재하지 않습니다");

// 성인인증체크
if($item[it_age] and !$member[mb_age]){
	goto_url("it_age.php?it_id=$item[it_id]");
}


// 오늘 본 상품 저장 시작
if(!$_SESSION[recent_view]){
	$_SESSION[recent_view][] = $item[it_id];
} elseif(!in_array($item[it_id],$_SESSION[recent_view])){
	$_SESSION[recent_view][] = $item[it_id];
} else{

}



$supply = sql_fetch("select * from nfor_member where mb_no='$item[supply_no]'");



$qna_cnt = sql_fetch(" select  count(*) as cnt from nfor_item_qna where it_id='$item[it_id]' and wr_reply='0'");
$item[qna_cnt] = $qna_cnt[cnt];

$star_cnt = sql_fetch(" select  count(*) as cnt from nfor_item_star where it_id='$item[it_id]' and wr_reply='0' and wr_view='0'");
$item[star_cnt] = $star_cnt[cnt];

$star_best_cnt = sql_fetch("select count(*) as cnt from nfor_item_star where it_id='$item[it_id]' and wr_datetime <= '$nfor[ymdhis]' and wr_reply='0' and wr_view='0' and wr_best > 0");
$item[star_best_cnt] = $star_best_cnt[cnt];

$star_img_cnt = sql_fetch("select count(*) as cnt from nfor_item_star where it_id='$item[it_id]' and wr_datetime <= '$nfor[ymdhis]' and wr_reply='0' and wr_view='0' and wr_img <> ''");
$item[star_img_cnt] = $star_img_cnt[cnt];

$hide = "1";






// 추천상품평
if($st_id){
	$chk_star = sql_fetch("select * from nfor_item_star where wr_id='$st_id' and it_id='$item[it_id]'");
	if($chk_star[wr_id]){
		$_SESSION[st_id][$item[it_id]] = $chk_star[wr_id];
	}
}
// 추천상품평








include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>
