<?php	// 상품상세
include_once "path.php";

$star = sql_fetch("select * from nfor_item_star where it_id='$it_id' and wr_id='$wr_id'");
$item = sql_fetch("select * from nfor_item where it_id='$it_id'");
$nfor[title] = "상품상세";

if(!$member[mb_no]) alert("로그인이 필요합니다.");

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
