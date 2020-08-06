<?php
include_once "path.php";

$nfor[title] = "장바구니";

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache"); 

$ss_cart_id = $_SESSION[cart_id];

if($mode=="option_delete"){
	sql_query("delete from nfor_cart where cart_id='$ss_cart_id' and option_id='$option_id'");
	json_return("","ok");
}

if($mode=="check_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_cart where cart_id='$ss_cart_id' and option_id='{$_POST['option_id'][$k]}'");
	}
	json_return("","ok");
}

if($mode=="checkbox"){
	sql_query("update nfor_cart set option_check='0' where cart_id='$ss_cart_id'");
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("update nfor_cart set option_check='1' where cart_id='$ss_cart_id' and option_id='{$_POST['option_id'][$k]}'");
	}
	cart_info($ss_cart_id);
	exit;
}

if($mode=="option_change"){	// 장바구니 수량변경
	sql_query("update nfor_cart set option_cnt='$option_cnt' where cart_id='$ss_cart_id' and option_id='$option_id'");
	cart_info($ss_cart_id);
	exit;
}

if($mode=="item_delete"){
	sql_query("delete from nfor_cart where it_id='$it_id' and cart_id='$ss_cart_id'");
	json_return("","ok");
}

if($mode=="cart_delete"){
	sql_query("delete from nfor_cart where cart_id='$ss_cart_id'");
	json_return("","ok");
}

if($mode=="insert"){	// 장바구니 상품담기
	$item = sql_fetch("select * from nfor_item where it_id='$it_id'");
	$it_sales_volume = sql_fetch("select sum(it_sales_volume) as change_volume from nfor_false_item where it_id='$item[it_id]' and wr_datetime <= '$nfor[ymdhis]'");
	$item[it_sales_volume] = $it_sales_volume[change_volume]+it_sales_volume($item[it_id]);
	if($item[it_sales_volume] >= $item[it_stock]) json_return("재고가 부족합니다.");
	if($item[it_payenddate] < $nfor[ymdhis]) json_return("판매가 종료되었습니다");
	
	
	
	
	for($i=0; $i<count($option_id); $i++){
		$chk_opt = sql_fetch("select * from nfor_cart where cart_id='$ss_cart_id' and it_id='$item[it_id]' and option_id='$option_id[$i]'");
		if(!$chk_opt[option_id] and is_numeric($option_cnt[$i]) and $option_cnt[$i]>0){
			$opt_data = sql_fetch("select * from nfor_item_option where option_id='$option_id[$i]'");

				$star_id = $_SESSION[st_id][$item[it_id]];

				sql_query("insert nfor_cart set 
												cart_id='$ss_cart_id',
												it_id='$item[it_id]',
												option_id='$option_id[$i]',
												option_cnt='{$option_cnt[$i]}',
												supply_no='$item[supply_no]',
												it_delivery='$item[it_delivery]',
												option_price='$opt_data[price]',
												supply_price='$opt_data[supply_price]',
												org_price='$opt_data[org_price]',
												option_select1='$opt_data[option_name1]',
												option_select2='$opt_data[option_name2]',
												option_select3='$opt_data[option_name3]',
												option_select4='$opt_data[option_name4]',
												star_id='$star_id',
												option_check='1'");


		} else{		
			$chg_option_cnt = $option_cnt[$i];
			sql_query("update nfor_cart set option_check='1', option_cnt='$chg_option_cnt' where cart_id='$ss_cart_id' and it_id='$item[it_id]' and option_id='$option_id[$i]'");
		}
	}

	$return[cart_cnt] = cart_cnt($ss_cart_id);
	json_return("","ok");
}

sql_query("update nfor_cart set option_check='1' where cart_id='$ss_cart_id'");








function cart_info($ss_cart_id){

	$item_total_price = 0;
	$delivery_total_price = 0;
	$i = 0;
	$que = sql_query("select it_id from nfor_cart where cart_id='$ss_cart_id' group by it_id");
	while($data = sql_fetch_array($que)){

		$ea_item_price = sql_fetch("select sum(option_price*option_cnt) as ea_item_price from nfor_cart where cart_id='$ss_cart_id' and it_id='$data[it_id]' and option_check='1'");
		$ea_item_price[ea_item_price] = $ea_item_price[ea_item_price]+0;

		$dyinfo = ea_delivery_price($ss_cart_id, $data[it_id],$ea_item_price[ea_item_price]);

		$item_total_price += $ea_item_price[ea_item_price];
		$delivery_total_price += $dyinfo[price];

		$return[item][$i][item_price] = $ea_item_price[ea_item_price];
		//$return[item][$i][delivery_price] = $dyinfo[price];
		$return[item][$i][delivery_state] = $dyinfo[state];
		$return[item][$i][it_id] = $data[it_id];

		$i++;
	}


	$return[delivery_total_price] = $delivery_total_price;
	$return[item_total_price] = $item_total_price;
	$return[cart_total_price] = $item_total_price + $delivery_total_price;

	$return[result] = "ok";
	die(json_encode($return));
}





include_once $nfor[skin_path]."cart.php";
?>