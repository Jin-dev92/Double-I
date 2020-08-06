<?php	// 업데이트
include "path.php";

if(!$ss_cart_id_new) json_return("잘못된 접속입니다");
$ss_cart_id = $ss_cart_id_new;

$is_delivery = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ss_cart_id' and it_delivery='1'");
$is_ticket = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ss_cart_id' and it_delivery='0'");






$discount_price = 0;
if($member[mb_no]){
	for($i=0; $i<count($cp_id); $i++){
		if($cp_id[$i]){
			$item = item($cp_it_id[$i]);
			$ea_item_price = sql_fetch("select sum(option_price*option_cnt) as ea_item_price from nfor_cart where cart_id='$ss_cart_id' and it_id='$item[it_id]' and option_check='1'");

			if(trim($item[it_category])){
				$add_sql = "";
				$it_category_exp = explode("_",trim($item[it_category]));
				for($k=0; $k<count($it_category_exp)-1; $k++){
					if($k) $add_sql .= " or ";
					$cp_category_id = $it_category_exp[$k];
					$add_sql .= "cp_category_id='$cp_category_id' ";
				}
				$add_sql_sql = " or (cp_type='2' and ( $add_sql ))";
			} else{
				$add_sql_sql = "";
			}

			$chk_coupon = sql_fetch("select * from nfor_coupon where cp_id='{$cp_id[$i]}' and cp_sdate<='$nfor[ymdhis]' and cp_edate>='$nfor[ymdhis]' and (cp_all='1' or cp_mb_no='$member[mb_no]') and ( (cp_type='1' and cp_it_id='$item[it_id]') $add_sql_sql )");
			if($chk_coupon[cp_id]){
				$chk_cp = sql_fetch("select * from nfor_coupon_use where mb_no='$member[mb_no]' and cp_id='$chk_coupon[cp_id]' and cp_state='1'");
				if(!$chk_cp[cp_id]){

					if($chk_coupon[cp_pay_type]=="1"){
						$cp_price = $chk_coupon[cp_coupon_price];
						$discount_price += $cp_price;
					} else{
						$cp_price = ($ea_item_price[ea_item_price]/100)*$chk_coupon[cp_coupon_per];
						$discount_price += $cp_price;
					}
					$coupon_cp_id[] = $chk_coupon[cp_id];
					$coupon_it_id[] = $item[it_id];
					$coupon_cp_price[] = $cp_price;
					$coupon_it_price[] = $ea_item_price[ea_item_price];
				}
			}
		}
	}
}
$coupon_price = $discount_price;








if($member[mb_no]){
	$od_name = $member[mb_name];
	$od_hp = $member[mb_hp];
	$od_email = $member[mb_email];

	$mb_name = $member[mb_name];
	$mb_hp = $member[mb_hp];
	$mb_email = $member[mb_email];
	$mb_no = $member[mb_no];
} else{
	$od_name = $od_name;
	$od_hp = add_hyphen($od_hp); // 주문자연락처
	$od_email = $od_email;

	$mb_name = $od_name;
	$mb_hp = $od_hp;
	$mb_email = $od_email;
	$mb_no = "";
}

$dy_name = $dy_name; // 배송이름
$dy_hp = add_hyphen($dy_hp); // 배송연락처
$dy_zip = $dy_zip; // 배송우편번호
$dy_addr1 = $dy_addr1; // 주소
$dy_addr2 = $dy_addr2; // 상세주소

$od_ip = $_SERVER[REMOTE_ADDR]; // 아이피



// 적립금사용시
if($use_money){
	if($money_price<0) json_return("적립금은 숫자만 입력하셔야합니다");
	if(mb_money($member[mb_no]) < $money_price) json_return("보유하신 적립금이 입력하신 적립금액보다 적습니다");
}

// 무통장입금주문시
if($payment_type=="banking"){
	if(!$bank_number)  json_return("입금하실 계좌를 선택해주세요");
	if(!$bank_name) json_return("입금자명을 입력해주세요");
}

// 배송합산금액
$delivery_price = delivery_total_price($ss_cart_id,$dy_zip);

// 상품합산금액
$total_item_price = sql_fetch("select sum(option_price*option_cnt) as total_item_price from nfor_cart where cart_id='$ss_cart_id'"); 
$it_price = $total_item_price[total_item_price];

// 주문합산금액
$total_price = $it_price+$delivery_price;



// 적립금이 결제금액과 같으면 결제수단을 적립금으로 변경
if($money_price==$total_price){
	$payment_type = "money";
}

// 쿠폰 결제금액과 같으면 결제수단을 쿠폰으로 변경
if($coupon_price==$total_price){
	$payment_type = "coupon";
}

// 적립금+쿠폰이 결제금액과 같으면 결제수단을 적립금으로 변경
if($money_price+$coupon_price==$total_price){
	$payment_type = "money";
}

// 주문합산금액 보다 입력한 적립금 크면 오류
if($total_price < $money_price) json_return("주문금액보다 입력하신 적립금이 더 큽니다");


// 결제수단별 결제금액설정
$now_price = $total_price-$money_price-$coupon_price;
if($payment_type=="card"){
	$card_price = $now_price;
} elseif($payment_type=="iche"){
	$iche_price = $now_price;
} elseif($payment_type=="hp"){
	$hp_price = $now_price;
} elseif($payment_type=="banking"){
	$banking_price = $now_price;
} elseif($payment_type=="vbanking"){
	$vbanking_price = $now_price;
} elseif($payment_type=="money"){
	$money_price = $now_price+$money_price;
} elseif($payment_type=="coupon"){
	$money_price = $now_price+$coupon_price;
} else{

}

sql_query("delete from nfor_order where cart_id='$ss_cart_id'");

$od_id = get_od_id();

sql_query("insert nfor_order set od_id='$od_id',
								 payment_type='$payment_type',
								 pay_step='0',
								 cart_id='$ss_cart_id',
								 mb_no='$mb_no', 
								 mb_name='$mb_name',
								 mb_hp='$mb_hp',
								 mb_email='$mb_email',
								 od_name='$od_name',
								 od_hp='$od_hp',
								 od_email='$od_email',
								 dy_name='$dy_name',
								 dy_hp='$dy_hp',
								 dy_zip='$dy_zip',
								 dy_addr1='$dy_addr1',
								 dy_addr2='$dy_addr2',
								 dy_msg='$dy_msg',
								 bank_number='$bank_number',
								 bank_name='$bank_name',
								 bank_date='$bank_date',
								 od_ip='$od_ip',
								 is_mobile='$is_mobile',
								 is_delivery='$is_delivery[cnt]',
								 is_ticket='$is_ticket[cnt]',
								 card_price='$card_price',
								 iche_price='$iche_price',
								 hp_price='$hp_price',
								 banking_price='$banking_price',
								 vbanking_price='$vbanking_price',
								 money_price='$money_price',
								 coupon_price='$coupon_price',
								 delivery_price='$delivery_price',
								 it_price='$it_price',
								 total_price='$total_price'");



// 상품별 배송비저장
delivery_price_insert($ss_cart_id,$dy_zip);



sql_query("delete from nfor_coupon_use where od_id='$od_id'");
for($i=0; $i<count($coupon_cp_id); $i++){
	sql_query("insert nfor_coupon_use set od_id='$od_id', mb_no='$member[mb_no]', cp_id='{$coupon_cp_id[$i]}', cp_it_id='{$coupon_it_id[$i]}', cp_price='{$coupon_cp_price[$i]}', cp_it_price='{$coupon_it_price[$i]}', cp_datetime=NOW()");
}




/*
payment_type 결제수단
pay_step 결제단계
cart_id 카트아이디
mb_no 회원번호
mb_name 회원이름
mb_hp 회원연락처
mb_email 회원이메일
od_name 주문자이름
od_hp 주문자연락처
od_email 주문자이메일
dy_name 배송자이름
dy_hp 배송자연락처
dy_zip 배송자우편번호
dy_addr1 배송자주소1
dy_addr2 배송자주소2
dy_msg 배송메모
bank_number 무통장 입금계좌
bank_name 무통장 입금자명
bank_date 무통장 입금예정일자
od_ip 아이피
card_price 카드금액
iche_price 실시간계좌이체금액
hp_price 휴대폰금액
banking_price 무통장금액
money_price 적립금금액
delivery_price 배송합산금액
it_price 상품합산금액
total_price 주문합산금액
*/

$order = sql_fetch("select * from nfor_order where od_id='$od_id'");

if($payment_type=="banking"){
		
	sql_query("update nfor_order set pay_step='4', od_datetime=NOW() where od_id='$order[od_id]'");
	sql_query("update nfor_cart set ct_od_date=NOW(), pay_step='4' where cart_id='$order[cart_id]'");
	
	coupon_use($order[od_id]);
	
	if($order[money_price]) insert_money($order[mb_no],$order[money_price]*-1,"상품구매","2",$order[od_id]);
	
	nfor_send("order",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
	nfor_send("banking_request",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
	
	$_SESSION[cart_id] = "";

} elseif($payment_type=="money" or $payment_type=="coupon"){
	
	sql_query("update nfor_order set pay_step='1', od_datetime=NOW(), od_paydatetime=NOW() where od_id='$order[od_id]'");
	sql_query("update nfor_cart set ct_od_date=NOW(), ct_od_paydate=NOW(), pay_step='1' where cart_id='$order[cart_id]'");
	
	coupon_use($order[od_id]);
	
	if($order[money_price]) insert_money($order[mb_no],$order[money_price]*-1,"상품구매","2",$order[od_id]);
	
	nfor_send("order",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
	$que = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' and it_delivery='0'");
	while($ct = sql_fetch_array($que)){
		nfor_send("ticket",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id], $ct[ct_id]);
	}

	$_SESSION[cart_id] = "";

} else{


}

sql_query("update nfor_cart set ct_is_mobile='$order[is_mobile]', ct_payment_type='$order[payment_type]', ct_mb_name='$order[mb_name]', ct_od_name='$order[od_name]', ct_dy_name='$order[dy_name]', ct_mb_hp='$order[mb_hp]', ct_od_hp='$order[od_hp]', ct_dy_hp='$order[dy_hp]', ct_mb_email='$order[mb_email]', ct_od_email='$order[od_email]', mb_no='$order[mb_no]' where cart_id='$order[cart_id]'");

$return[msg] = "성공";
$return[result] = "ok";
$return[od_id] = $od_id;
$return[pay_price] = $now_price;


$return[payment_type] = $payment_type;

$json = json_encode($return);
echo $json;
?>