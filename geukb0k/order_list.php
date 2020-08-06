<?php
include_once "path.php";

$nfor[title] = "구매목록";

if($mode=="ticket_send"){

	if(!$member[mb_no] and !$nfor[guest]) json_return("로그인하셔야 이용가능합니다");
	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	if(!$order[od_id]) json_return("주문서가 존재하지 않습니다");
	if($order[mb_no] and $order[mb_no]<>$member[mb_no] and !$is_admin and !$nfor[guest]) json_return("회원정보가 일치하지 않습니다");

	if($ct_id){

		$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
		$item = sql_fetch("select * from nfor_item where it_id='$ct[it_id]'");
		if($item[it_delivery]) json_return("티켓상품이 아닙니다");

		if($config[cf_ticket_send_cnt] <= $ct[ticket_send_cnt]) json_return("티켓 전송 횟수를 초과하였습니다");

		if(!expiry_chk($order,$item)) json_return("티켓이 만료되었습니다");

		if($ct[option_cnt] <= $ct[ticket_used]) json_return("이미 사용된 티켓입니다");

		sql_query("update nfor_cart set ticket_send_cnt=ticket_send_cnt+1 where ct_id='$ct[ct_id]'");
		nfor_send("ticket",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id], $ct[ct_id]);

	} elseif($it_id){

		$ct = sql_fetch("select * from nfor_cart where cart_id='$order[cart_id]' and it_id='$it_id'");
		$item = sql_fetch("select * from nfor_item where it_id='$ct[it_id]'");
		if($item[it_delivery]) json_return("티켓상품이 아닙니다");
		
		if($config[cf_ticket_send_cnt] <= $ct[ticket_send_cnt]) json_return("티켓 전송 횟수를 초과하였습니다");

		if(!expiry_chk($order,$item)) json_return("티켓이 만료되었습니다");

		$que = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' and it_id='$item[it_id]'");
		while($ct = sql_fetch_array($que)){
			sql_query("update nfor_cart set ticket_send_cnt=ticket_send_cnt+1 where ct_id='$ct[ct_id]'");
			nfor_send("ticket",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id], $ct[ct_id]);
		}

	} else{
		
		$que = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' and it_delivery='0'");
		while($ct = sql_fetch_array($que)){
			if($config[cf_ticket_send_cnt] > $ct[ticket_send_cnt]){
				sql_query("update nfor_cart set ticket_send_cnt=ticket_send_cnt+1 where ct_id='$ct[ct_id]'");
				nfor_send("ticket",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id], $ct[ct_id]);
			}
		}

	}

	json_return("휴대전화로 티켓이 발송되었습니다","ok");
	exit;
}

if(!$member[mb_no]) goto_url("login.php?url=order_list.php");

$e0 = date("Y-m-d");
$e1 = date("Y-m-d",strtotime("-7 day"));
$e2 = date("Y-m-d",strtotime("-15 day"));
$e3 = date("Y-m-d",strtotime("-1 month"));
$e4 = date("Y-m-d",strtotime("-3 month"));

$ex0 = explode("-",$e0);
$ex1 = explode("-",$e1);
$ex2 = explode("-",$e2);
$ex3 = explode("-",$e3);
$ex4 = explode("-",$e4);


$today = explode("-",date("Y-m-d")); 


if(!$sod_y){
	$sod_y = $ex1[0];
}
if(!$sod_m){
	$sod_m = $ex1[1];
}
if(!$sod_d){
	$sod_d = $ex1[2];
}

if(!$eod_y){
	$eod_y = $ex0[0];
}
if(!$eod_m){
	$eod_m = $ex0[1];
}
if(!$eod_d){
	$eod_d = $ex0[2];
}


$ex1_link = "order_list.php?sod_y=$ex1[0]&sod_m=$ex1[1]&sod_d=$ex1[2]&eod_y=$today[0]&eod_m=$today[1]&eod_d=$today[2]";
$ex2_link = "order_list.php?sod_y=$ex2[0]&sod_m=$ex2[1]&sod_d=$ex2[2]&eod_y=$today[0]&eod_m=$today[1]&eod_d=$today[2]";
$ex3_link = "order_list.php?sod_y=$ex3[0]&sod_m=$ex3[1]&sod_d=$ex3[2]&eod_y=$today[0]&eod_m=$today[1]&eod_d=$today[2]";
$ex4_link = "order_list.php?sod_y=$ex4[0]&sod_m=$ex4[1]&sod_d=$ex4[2]&eod_y=$today[0]&eod_m=$today[1]&eod_d=$today[2]";

$sod_ymd = $sod_y."-".sprintf("%02d",$sod_m)."-".sprintf("%02d",$sod_d);
$eod_ymd = $eod_y."-".sprintf("%02d",$eod_m)."-".sprintf("%02d",$eod_d);











$sql_common = " from nfor_order ";
$sql_search = " where od_view='0' and pay_step>'0' and mb_no='$member[mb_no]' ";


//$sql_search .= " and date_format(od_datetime,'%Y-%m-%d')>='$sod_ymd' and date_format(od_datetime,'%Y-%m-%d')<='$eod_ymd' ";

if($type=="delivery"){
	$sql_search .= " and is_delivery>'0' ";
} elseif($type=="ticket"){
	$sql_search .= " and is_ticket>'0' ";
} else{

}

if(!$sst){
	$sst = "od_datetime";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
						 $sql_common
						 $sql_search
						 $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
				  $sql_common
				  $sql_search
				  $sql_order
				  limit $from_record, $rows ";
$result = sql_query($sql);

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);

?>