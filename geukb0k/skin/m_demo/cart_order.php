<?php
include_once $nfor[skin_path]."head2.php";
require $nfor[skin_path]."lib/NicepayLite2.php";
$step = "1";
?>
<link rel="stylesheet" type="text/css" href="/skin/m_demo/css/import.css"/>
<script src="https://web.nicepay.co.kr/flex/js/nicepay_tr.js" language="javascript"></script>
<style>
.cart_item_wrap { background-color:#fff; border:solid 1px #ccc; margin-bottom:10px; }


.it_name_wrap { position:relative; height:75px; padding:10px; background-color:#f9f9f9; border-bottom:solid 1px #ccc; }
.it_name_wrap a { display:block; position:relative; box-sizing:border-box; -webkit-box-sizing:border-box; }

.cart_item_img { display:block; width:75px; height:75px; }
.it_name { display:block; font-size:15px; position:absolute; left:85px; top:0px; height:75px; display:flex;  }
.it_name span { align-self:center; overflow:hidden; text-overflow:ellipsis; -webkit-line-clamp:4; display:-webkit-box; -webkit-box-orient:vertical; }


.it_option_wrap li { border-bottom:1px solid #e5e5e5; padding:7px 10px; }
.it_option_wrap li:last-child { border-bottom:1px solid #fff; }



.ea_sum_box { border:solid 1px #e5e5e5; margin:0px 10px 10px 10px; }
.ea_sum_box b { display:block; background-color:#f4f4f4; border-bottom:solid 1px #e5e5e5; font-size:13px; padding:5px 10px; text-align:center; }
.ea_sum_box span { font-size:14px; line-height:24px; }
.ea_sum_box1 { float:left; width:50%; text-align:center; }
.ea_sum_box2 { float:left; width:50%; text-align:center; margin-left:-1px; border-left:solid 1px #e5e5e5; }


.opt_name { font-size:14px; color:#666; }
.option_count { font-size:14px; font-weight:bold; position:absolute; left:0px; top:0px; }
.option_total_price { font-size:15px; color:#333;  position:absolute; right:0px; top:0px; }


.option_count_wrap { position:relative; width:100%; height:20px; }

#money_price { padding:2px 3px; width:70px; text-align:right; letter-spacing:0px; }
#coupon_price { padding:2px 3px; width:70px; text-align:right; letter-spacing:0px; }



.dy_box_wrap { margin-bottom:5px;  }
.dy_box { border:solid 1px #ccc; background:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#ecebf0)); box-shadow:none; padding:7px 10px; }
.dy_box_title { color:#111; font-size:14px; font-weight:bold; color:#666; }


.dy_bg { background-color:#fff; border-left:solid 1px #ccc; border-right:solid 1px #ccc; border-bottom:solid 1px #ccc; padding:10px; position:relative; }


#payment_btn { display:block; cursor:pointer; width:100%; height:40px; line-height:40px; text-align:center; padding:0px; margin:10px 0px; font-size:16px; font-weight:bold; background-color:#d32f2f; border:solid 1px #d32f2f; color:#fff; }

#zipcode_btn  { cursor:pointer; position:absolute; right:0px; top:0px; height:38px; display:block; width:110px; text-align:center; line-height:40px; border:solid 1px #ccc; background:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#ecebf0)); box-shadow:none; }

#coupon_use_btn { cursor:pointer; border:solid 1px #cbcbcb; width:70px; font-size:12px; height:25px; line-height:25px; padding:3px 6px; background-color:#f8f8f8; color:#111; letter-spacing:-1px; }



.money_wrap { position:relative; width:100%; height:26px; }
.money_price_wrap { position:absolute; right:0px; top:0px; font-size:14px; color:#666; }

.coupon_wrap { position:relative; width:100%; height:26px; }
.coupon_price_wrap { position:absolute; right:0px; top:0px; font-size:14px; color:#666; }

#coupon_list_wrap { display:none; border:solid 1px #cbcbcb; background-color:#f6f6f6; margin:20px 0px; padding:5px 10px; }


#coupon_btn { text-align:center; }
#coupon_cancel { line-height:36px; color:#777; border:solid 1px #bbb; background-color:#f7f7f7; padding:3px 10px; font-size:14px; cursor:pointer; }
#coupon_apply { line-height:36px; color:#fff; border:solid 1px #ec3940; background-color:#ec3940; padding:3px 10px; font-size:14px; cursor:pointer; }





.payment_type_menu { margin:0px; padding:0px; list-style:none; overflow:hidden; border-bottom:solid 1px #eee; margin-bottom:10px; }
.payment_type_menu li { margin:0px; padding:0px; float:left; width:50%; position:relative;  height:30px; }

#payment_card { width:100%; }
.card_menu { margin:0px; padding:0px; list-style:none; overflow:hidden; border-bottom:solid 1px #eee; margin-bottom:10px; }
.card_menu li { margin:0px; padding:0px 0px 10px 0px; float:left; width:50%; text-align:center;  }


#payment_vbanking { display:none; }
.card_menu select { width:96%; }

#payment_hp { display:none; }
#payment_iche { display:none; }
#payment_banking { display:none; }



#zipcode_wrap { display:none; width:100%; height:300px; position:relative; }



.dl_total_prcie { border-top:solid 1px #eee; overflow:hidden; }
.dl_total_prcie dt { font-size:14px; color:#666; text-align:left; width:50%; float:left; height:30px; line-height:30px; border-bottom:solid 1px #eee; }
.dl_total_prcie dd { font-size:14px; color:#666; text-align:right; width:50%; float:left; height:30px; line-height:30px; border-bottom:solid 1px #eee; }
</style>

<form name="fcart_order" id="fcart_order" method="post" accept-charset="euc-kr">
<input type="hidden" name="ss_cart_id_new" value="<?=$ss_cart_id_new?>">


<div style="padding:10px;" id="member_info">
	<div class="dy_box_wrap">
	<div class="dy_box" style="margin-bottom:7px;">

		<span class="dy_box_title">주문상품</span>

	</div>

	<ul class="cart_item_list">
	<?
	$n = 0;
	$cart_que = sql_query("select * from nfor_cart where cart_id='$ss_cart_id' and option_check='1' group by it_id order by ct_id desc");
	while($cart = sql_fetch_array($cart_que)){
		$item = item($cart[it_id]);
	?>
	<li class="cart_item_wrap">
		<div class="it_name_wrap">

			<a href="item.php?it_id=<?=$item[it_id]?>">
				<img src="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/it_img_l_no.jpg"?>" class="cart_item_img">
				<div class="it_name"><span><?=$item[it_name]?></span></div>
			</a>

		</div>


		<ul class="it_option_wrap">
		<?
		$ct_que = sql_query("select * from nfor_cart where cart_id='$ss_cart_id' and it_id='$cart[it_id]' and option_check='1'");
		while($ct = sql_fetch_array($ct_que)){
			$ct_sum[$cart[it_id]] += $ct[option_price]*$ct[option_cnt];
			$opt_name = $ct[option_select1]." ".$ct[option_select2]." ".$ct[option_select3]." ".$ct[option_select4];
			$opt = sql_fetch("select * from nfor_item_option where option_id='$ct[option_id]'");
			$opt_stock = $opt[stock]-it_sales_volume($ct[it_id],$ct[option_id]);
			$cnt_item=$ct[option_cnt];
		?>
		<li>

		
				<p class="opt_name"><?=$opt_name?></p>
				<?
				$sql3 = sql_query("select * from nfor_member a where a.mb_no='$ct[supply_no]'");
				$brand = sql_fetch_array($sql3);
				$g_code = $ct[it_id];
				?>
				<!-- <span>병원이름 : <?=$brand[mb_no]?></span> -->
				<!-- <span>상품코드 : <?=$ct[it_id]?></span> -->

				<div class="option_count_wrap">
				<span class="option_count">수량 <?=$ct[option_cnt]?>개</span>
				<span class="option_total_price"><?=number_format($ct[option_price]*$ct[option_cnt])?>원</span>
				</div>


		</li>
		<?
			$n++;
		}

		$ct_delivery = ea_delivery_price($ss_cart_id, $cart[it_id],$ct_sum[$cart[it_id]]);
		?>
		</ul>

		<div class="ea_sum_box">

			<div class="ea_sum_box1">
				<b>상품합계</b>
				<span class="it_total_price"><?=number_format($ct_sum[$cart[it_id]])?>원</span>
			</div>
			<div class="ea_sum_box2">
				<b>배송비</b>
				<span class="it_delivery_price"><?=$ct_delivery[price]?number_format($ct_delivery[price])."원":$ct_delivery[state]?></span>
			</div>
			<div style="clear:both;"></div>

		</div>

	</li>
	<?
		$item_total_price += $ct_sum[$cart[it_id]];
	}

	$delivery_total_price = delivery_total_price($ss_cart_id);
	$total_price = $item_total_price + $delivery_total_price;
	?>
	</ul>

</div>

	<? if($member[mb_no]){ ?>
	<div class="dy_box_wrap">
		<div class="dy_box">

			<span class="dy_box_title"><?=$step++?>. 적립금/쿠폰 사용</span>

		</div>
		<div class="dy_bg">

			<div>

				<div class="coupon_wrap">
					<input type="checkbox" name="use_coupon" id="use_coupon"> <label for="use_coupon">할인쿠폰</label>

					<a id="coupon_use_btn">조회 및 사용</a>

					<div class="coupon_price_wrap"><span id="span_coupon_price">0</span> 원</div>
				</div>

				<div id="coupon_list_wrap">

					<ul id="coupon_list">
					<?
					$cart_que = sql_query("select it_id from nfor_cart where cart_id='$ss_cart_id' and option_check='1' group by it_id order by ct_id desc");
					while($cart = sql_fetch_array($cart_que)){
						$item = item($cart[it_id]);
						// 상품금액
						$ea_item_price = sql_fetch("select sum(option_price*option_cnt) as ea_item_price from nfor_cart where cart_id='$ss_cart_id' and it_id='$item[it_id]' and option_check='1'");
					?>
						<li>
						<?=$item[it_name]?>
						<input type="hidden" name="cp_it_id[]" value="<?=$item[it_id]?>">
						<select name="cp_id[]" class="coupon_select">
						<option value="">상품쿠폰선택
						<?
						$que = sql_query("select * from nfor_coupon where cp_type='1' and cp_sdate<='$nfor[ymdhis]' and cp_edate>='$nfor[ymdhis]' and (cp_all='1' or cp_mb_no='$member[mb_no]') and cp_it_id='$item[it_id]'");
						while($cp1 = sql_fetch_array($que)){
							$chk_cp = sql_fetch("select * from nfor_coupon_use where mb_no='$member[mb_no]' and cp_id='$cp1[cp_id]' and cp_state='1'");
							if(!$chk_cp[cp_id]){
								if($cp1[cp_pay_type]=="1"){
									$discount_price = $cp1[cp_coupon_price];
								} else{
									$discount_price = ($ea_item_price[ea_item_price]/100)*$cp1[cp_coupon_per];
								}
						?>
						<option value="<?=$cp1[cp_id]?>" data-discount_price="<?=$discount_price?>"><?=number_format($discount_price)?>원 할인 (<?=date("~m.d",strtotime($cp1[cp_edate]))?>) <?=$cp1[cp_name]?>
						<?
							}
						}
						?>


						<?
						if(trim($item[it_category])){
							$add_sql = "";
							$it_category_exp = explode("_",trim($item[it_category]));
							for($k=0; $k<count($it_category_exp)-1; $k++){
								if($k) $add_sql .= " or ";
								$cp_category_id = $it_category_exp[$k];
								$add_sql .= "cp_category_id='$cp_category_id' ";
							}
							$add_sql = " and ( $add_sql )";
							$sql = "select * from nfor_coupon where cp_type='2' and cp_sdate<='$nfor[ymdhis]' and cp_edate>='$nfor[ymdhis]' and (cp_all='1' or cp_mb_no='$member[mb_no]') $add_sql";
							$que = sql_query($sql);
							while($cp2 = sql_fetch_array($que)){
								$chk_cp = sql_fetch("select * from nfor_coupon_use where mb_no='$member[mb_no]' and cp_id='$cp2[cp_id]' and cp_state='1'");
								if(!$chk_cp[cp_id]){
									if($cp2[cp_pay_type]=="1"){
										$discount_price = $cp2[cp_coupon_price];
									} else{
										$discount_price = ($ea_item_price[ea_item_price]/100)*$cp2[cp_coupon_per];
									}
						?>
						<option value="<?=$cp2[cp_id]?>" data-discount_price="<?=$discount_price?>"><?=number_format($discount_price)?>원 할인 (<?=date("~m.d",strtotime($cp2[cp_edate]))?>) <?=$cp2[cp_name]?>
						<?
								}
							}
						}
						?>
						</select>
						</li>
					<? } ?>
					</ul>


					<div id="coupon_btn">
						<a id="coupon_cancel">취소</a>
						<a id="coupon_apply">쿠폰사용하기</a>
					</div>
				</div>




			</div>
			<div style="border-top:solid 1px #eee; padding-top:5px; margin-top:7px;">

				<div class="money_wrap">
					<input type="checkbox" name="use_money" id="use_money" value="1" <?=$config[cf_money]>mb_money($member[mb_no]) || $config[cf_money_min] > $total_price?"disabled='disabled'":""?>> <label for="use_money">적립금 (<?=number_format(mb_money($member[mb_no]))?>원 보유) </label>
					<div class="money_price_wrap"><input type="number" pattern="[0-9]*" name="money_price" id="money_price" value="0" disabled="disabled"> 원</div>
				</div>

			</div>

		</div>
	</div>
	<? } ?>



	<div class="dy_box_wrap">
		<div class="dy_box">

			<span class="dy_box_title"><?=$step++?>. 주문금액</span>

		</div>
		<div class="dy_bg">

			<dl class="dl_total_prcie">
				<dt>총상품금액</dt>
				<dd><?=number_format($item_total_price)?>원</dd>

				<dt>총배송금액</dt>
				<dd><?=number_format($delivery_total_price)?>원</dd>

				<dt>총할인금액</dt>
				<dd><span id="span_discount_price">0</span>원</dd>

				<dt>총결제금액</dt>
				<dd><span id="span_pay_total_price"><?=number_format($total_price)?></span>원</dd>
			</dl>


		</div>
	</div>


	<div class="dy_box_wrap">
		<div class="dy_box">

			<span class="dy_box_title"><?=$step++?>. 구매자정보</span>

		</div>
		<div class="dy_bg">

			<? if($member[mb_no]){ ?>
				<label>이름</label>
				<p style="color:#555; font-size:15px;"><?=$member[mb_name]?></p>

				<div style="margin:5px 0px; padding:5px 0px; border-top:solid 1px #eee; border-bottom:solid 1px #eee;">
				<label>이메일</label>
				<p style="color:#555; font-size:15px;"><?=$member[mb_email]?></p>
				</div>

				<label>휴대전화</label>
				<p style="color:#555; font-size:15px;"><?=$member[mb_hp]?></p>
			<? } else{ ?>
				<label>이름</label>
				<input type="text" name="od_name" id="od_name" placeholder="이름">

				<label>휴대전화</label>
				<input type="number" pattern="[0-9]*" name="od_hp" id="od_hp" placeholder="휴대전화">

				<label>이메일</label>
				<input type="text" name="od_email" id="od_email" placeholder="이메일">
			<? } ?>

		</div>
	</div>




	<? if($is_delivery){  ?>
	<div class="dy_box_wrap">
		<div class="dy_box">

			<span class="dy_box_title"><?=$step++?>. 배송지 입력</span>

		</div>
		<div class="dy_bg">

			<label>이름</label>
			<input type="text" name="dy_name" id="dy_name" placeholder="받으시는분 이름" value="<?=$member[mb_name]?>">

			<label>휴대전화</label>
			<input type="number" pattern="[0-9]*" name="dy_hp" id="dy_hp" value="<?=str_number($member[mb_hp])?>" placeholder="받으시는분 휴대전화번호">

			<label>주소</label>

			<div style="width:100%; height:40px; position:relative;">
			<input type="number" pattern="[0-9]*" name="dy_zip" id="dy_zip" placeholder="우편번호" value="12345" readonly>
			<a id="zipcode_btn">우편번호찾기</a>
			</div>
			<input type="text" name="dy_addr1" id="dy_addr1" placeholder="주소" value="<?=$member[mb_addr1]?>" style="margin:5px 0px;" readonly>
			<input type="text" name="dy_addr2" id="dy_addr2" placeholder="상세주소" value="<?=$member[mb_addr2]?>">


		</div>
	</div>
	<? } ?>







	<div class="dy_box_wrap">

		<div class="dy_box">

			<span class="dy_box_title"><?=$step++?>. 결제수단 선택</span>

		</div>
		<div class="dy_bg">


			<ul class="payment_type_menu" onchange="changeMethod();">
				<li><input type="radio" name="payment_type" class="payment_type" value="card" id="payment_type_card" checked> <label for="payment_type_card">신용카드</label></li>
				<li><input type="radio" name="payment_type" class="payment_type" value="iche" id="payment_type_iche"> <label for="payment_type_iche">계좌이체</label></li>
				<li><input type="radio" name="payment_type" class="payment_type" value="vbanking" id="payment_type_vbanking"> <label for="payment_type_vbanking">가상계좌</label></li>
				<li><input type="radio" name="payment_type" class="payment_type" value="banking" id="payment_type_banking"> <label for="payment_type_banking">무통장입금</label></li>
			</ul>
			<div style="clear:both;"></div>


			<div id="payment_card" class="payment_wrap">

				<ul class="card_menu" style="display:none;">
					<li>
						<select name="card_code" id="card_code">
						<option value="">카드선택
						<?
						$que = sql_query("select * from nfor_pg_code where pg_type='$nfor[pg_type]' and pg_payment_type='card'");
						while($data = sql_fetch_array($que)){
						?>
						<option value="<?=$data[pg_code]?>"><?=$data[pg_name]?>
						<? } ?>
						</select>
					</li>
					<li>
						<select name="card_quota" id="card_quota">
						<option value="">할부선택
						<option value="00">일시불
						<?
						for($i=2; $i<=12; $i++){
						?>
						<option value="<?=sprintf("%02d",$i)?>"><?=$i?>개월
						<? } ?>
						</select>
					</li>
				</ul>
				<div style="clear:both;"></div>

			</div>



 			<div id="payment_vbanking" class="payment_wrap">


				<p style="color:#999; font-size:12px;"><?=date("Y년 m월 d일",strtotime("+".$config[cf_vbanking_limit]."day"))?>까지 미입금시 주문은 자동 취소됩니다.</p>
				<p style="color:#999; font-size:12px;">결제완료 이후 주문취소가 발생할경우 무통장입금을 통해서 환불이 진행되며 환불계좌설정은 마이페이지 > 무통장 환불계좌 설정 메뉴를 통해서 설정가능합니다.</p>


			</div>



 			<div id="payment_banking" class="payment_wrap">

				<label>입금은행</label>
				<select name="bank_number" id="bank_number">
				<?
				$que = sql_query("select * from nfor_banking where wr_use='1'");
				while($data = sql_fetch_array($que)){
				?>
				<option value="<?=$data[wr_bank]." ".$data[wr_number]." ".$data[wr_name]?>"><?=$data[wr_bank]." ".$data[wr_number]." ".$data[wr_name]?>
				<?}?>
				</select>

				<label>입금자명</label>
				<input type="text" name="bank_name" id="bank_name" placeholder="입금하시는분의 이름">

				<label>입금예정일</label>
				<select name="bank_date" id="bank_date">
				<?
				for($i=0; $i<=$config[cf_banking_limit]; $i++){
				?>
				<option value="<?=date("Y-m-d",strtotime("+$i day"))?>"><?=date("Y년 m월 d일",strtotime("+$i day"))?>(<?=yoil(date("Y-m-d",strtotime("+$i day")))?>)
				<? } ?>
				</select>

				<p style="color:#999; font-size:12px;">고객님께서 선택하신 입금예정일까지 미입금시 주문은 자동 취소됩니다.</p>

				<p style="color:#999; font-size:12px;">결제완료 이후 주문취소가 발생할경우 무통장입금을 통해서 환불이 진행되며 환불계좌설정은 마이페이지 > 무통장 환불계좌 설정 메뉴를 통해서 설정가능합니다.</p>


			</div>


			<div id="payment_hp" class="payment_wrap">
				<p style="color:#999; font-size:12px;">휴대폰결제는 최대 50만원까지 결제 가능하며, 고객님께서 사용하시는 이동통신사 및 결제 등급에 따라 결제한도가 제한될수 있습니다.</p>
				<p style="color:#999; font-size:12px;">휴대폰결제 취소의 경우 당월에만 가능합니다.</p>
			</div>

 			<div id="payment_iche" class="payment_wrap">


			</div>



		</div>
	</div>


	<div id="display_pay_button" style="display:block">
	<a id="payment_btn">결제하기</a>
	</div>

</form>
<?php

/*
*******************************************************
* <결제요청 파라미터>
* 결제시 Form 에 보내는 결제요청 파라미터입니다.
* 샘플페이지에서는 기본(필수) 파라미터만 예시되어 있으며,
* 추가 가능한 옵션 파라미터는 연동메뉴얼을 참고하세요.
*******************************************************
*/

$query1=sql_query("select max(cart_id) as purchase from nfor_cart where mb_no='$member[mb_no]'");
$cart_row=sql_fetch_array($query1);
$query2=sql_query("select * from nfor_order where cart_id='$cart_row[purchase]'");
$order_row=sql_fetch_array($query2);

$nicepay = new NicepayLite;
$nicepay->m_MerchantKey = "vpCvsKjKrK4AfosJcwarR0OcPurLhzW+dWFN2Zcj1WeaVCddj1Gnvi90C0Kwpx5O1ywg7OVldie37XQvvo4EMQ=="; // 상점키
$nicepay->m_MID         = "dublechi1m";                         // 상점아이디
$nicepay->m_Moid        = $order_row[od_id];                    // 상품주문번호
$nicepay->m_Price       = $total_price;                         // 결제상품금액
$nicepay->m_BuyerEmail  = $member[mb_email];                    // 구매자메일주소
$nicepay->m_BuyerName   = $member[mb_id];                       // 구매자명
$nicepay->m_BuyerTel    = $member[mb_hp];                       // 구매자연락처
$nicepay->m_GoodsName   = $item[it_name]."(".$opt_name.")";     // 결제상품명
$nicepay->m_BrandName   = $brand[mb_no];
$nicepay->m_BrandName2  = $brand[mb_no];
$nicepay->m_GoodsCode   = $g_code;								// 결제상품코드
$goodsCnt               = $cnt_item;                            // 결제상품개수
$nicepay->m_EdiDate     = date("YmdHis");                       // 거래 날짜
$nicepay->ReturnURL	= "http://geukbok.com/skin/m_demo/payResult_utf.php";
$nicepay->requestProcess();

/*
*******************************************************
* <해쉬암호화> (수정하지 마세요)
* SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다.
*******************************************************
*/
$ediDate = date("YmdHis");
$hashString = bin2hex(hash('sha256', $nicepay->m_EdiDate.$nicepay->m_MID.$nicepay->m_Price.$nicepay->m_MerchantKey, true));

$od_id = get_od_id();
?>
<script src="https://web.nicepay.co.kr/flex/js/nicepay_tr_utf.js" type="text/javascript"></script>
<form name="payForm" method="post" target="_self" action="http://geukbok.com/skin/m_demo/payResult_utf.php" class="payForm" style="display: none;" accept-charset="euc-kr">
	<input type="hidden" name="WapUrl"  value="geukbok"/> 
		<div class="payfin_area">
			<div class="conwrap">
				<div class="con">
					<div class="tabletypea">
						<table>
							<colgroup><col width="30%" /><col width="*" /></colgroup>
							<tr>
								<th><span>결제 수단</span></th>
								<td>
									<select name="PayMethod" class="PayMethod">
										<option value="CARD">신용카드</option>
										<option value="BANK">계좌이체</option>
										<option value="CELLPHONE">휴대폰결제</option>
										<option value="VBANK">가상계좌</option>
									</select>
								</td>
							</tr>
							<tr>
								<th><span>결제 상품코드</span></th>
								<td><input type="text" name="GoodsCode" value="<?php echo($nicepay->m_GoodsCode);?>"></td>
							</tr>
							<tr>
								<th><span>결제 상품명</span></th>
								<td><input type="text" name="GoodsName" value="<?php echo($nicepay->m_GoodsName);?>"></td>
							</tr>
							<tr>
								<th><span>결제 상품개수</span></th>
								<td><input type="text" name="GoodsCnt" value="<?=$goodsCnt?>" class="GoodsCnt"></td>
							</tr>
							<tr>
								<th><span>결제 상품금액</span></th>
								<td><input type="text" name="Amt" value="<?php echo($nicepay->m_Price);?>"></td>
							</tr>
							<tr>
								<th><span>병원이름</span></th>
								<td>
									<input type="text" name="BrandName" value="<?php echo($nicepay->m_BrandName);?>">
								</td>
							</tr>
							<tr>
								<th><span>구매자명</span></th>
								<td><input type="text" name="BuyerName" value="<?php echo($nicepay->m_BuyerName);?>"></td>
							</tr>
							<tr>
								<th><span>구매자 연락처</span></th>
								<td><input type="text" name="BuyerTel" value="<?php echo($nicepay->m_BuyerTel);?>"></td>
							</tr>
							<tr>
								<th><span>상품 주문번호</span></th>
								<td><input type="text" name="Moid" value="<?php echo($od_id);?>"></td>
							</tr>
							<tr>
								<th><span>상점 아이디</span></th>
								<td><input type="text" name="MID" value="<?php echo($nicepay->m_MID);?>"></td>
							</tr>

							<!-- IP -->
							<input type="hidden" name="UserIP" value="<?php echo($nicepay->m_UserIp);?>"/>                    <!-- 회원사고객IP -->

							<!-- 옵션 -->
							<!-- 카드사선택 -->
							<input type="hidden" name="SelectCardCode" value="01,02,03,04,06,07,08,09,10,11,12,13,14,15,17,18,19,20,21,22,23,24,25,26,27,28,29">

							<input type="hidden" name="BrandName2" value="<?php echo($nicepay->m_BrandName2);?>">
							<input type="hidden" name="ReturnURL" value="<?php echo($nicepay->ReturnURL); ?>"/>
							<input type="hidden" name="VbankExpDate" value="<?php echo($nicepay->m_VBankExpDate); ?>"/>       <!-- 가상계좌입금만료일 -->
							<input type="hidden" name="BuyerEmail" value="<?php echo($nicepay->m_BuyerEmail); ?>"/>           <!-- 구매자 이메일 -->
							<input type="hidden" name="TransType" value="0"/>                                                 <!-- 일반(0)/에스크로(1) 선택 파라미터 -->
							<input type="hidden" name="GoodsCl" value="1"/>                                                   <!--실물(1) 컨텐츠(0) -->

							<!-- 변경 불가능 -->
							<input type="hidden" name="EdiDate" value="<?php echo($nicepay->m_EdiDate); ?>"/>                 <!-- 전문 생성일시 -->
							<input type="hidden" name="EncryptData" value="<?=$hashString?>"/>                               <!-- 해쉬값	-->
							<input type="hidden" name="TrKey" value=""/>                                                      <!-- 필드만 필요 -->

							
							<input type="hidden" name="CharSet" value="utf-8">

						</table>
					</div>
				</div>
				<div class="btngroup">
					<a href="#" class="btn_blue">결제하기</a>
				</div>
			</div>
		</div>
</form>
</div>




<div id="zipcode_wrap"></div>
<script>
//결제창 최초 요청시 실행됩니다.
function changeMethod() {
	var payment_type = $('.payment_type:checked').val();
	if (payment_type=='card') {
		$(".PayMethod").val('CARD');
	}
	if (payment_type=='iche') {
		$(".PayMethod").val('BANK');
	}
	if (payment_type=='vbanking') {
		$(".PayMethod").val('VBANK');
	}
	if (payment_type=='banking') {
		$(".PayMethod").val('CELLPHONE');
	}
}
</script>
<SCRIPT LANGUAGE="JavaScript">
<!--
var cart_total_price = parseInt(<?=(int)$total_price?>);
var mb_money = parseInt(<?=(int)mb_money($member[mb_no])?>);

$(document).on("click","#coupon_use_btn",function(){
	if($("#coupon_use_btn").html()=="닫기"){
		$("#coupon_list_wrap").hide();
		$("#coupon_use_btn").html("조회 및 사용");
	} else{
		$("#coupon_list_wrap").show();
		$("#coupon_use_btn").html("닫기");
	}
});

$(document).on("click","#coupon_cancel",function(){

	$("#coupon_list_wrap").hide();
	$("#coupon_use_btn").html("조회 및 사용");

	if($("#use_coupon").is(":checked")){
		$("#use_coupon").prop("checked", false);
	}

	check_money();
});

$(document).on("click","#use_coupon",function(){
	if($("#use_coupon").is(":checked")) {
		$("#coupon_list_wrap").show();
		$("#coupon_use_btn").html("닫기");
	} else{
		$("#coupon_list_wrap").hide();
		$("#coupon_use_btn").html("조회 및 사용");
		check_money();
	}
});

$(document).on("click","#use_money",function(){
	if($("#use_money").is(":checked")) {
		$("#money_price").removeAttr("disabled");
		$("#money_price").val('');
		$("#money_price").focus();
	} else {
		$("#money_price").attr("disabled", true);
		$("#money_price").val(0);
		check_money();
	}
});

$(document).on("change","#money_price",function(){
	check_money();
});


$(document).on("change",".coupon_select",function(){
	var cp_id = $(this).val();
	var is_cp_id = 0;
	if(cp_id){
		$('.coupon_select').each(function(){
			if(cp_id==$(this).val()){
				is_cp_id++;
			}
		});
		if(is_cp_id>1){
			alert("다른상품에 이미 선택된 쿠폰입니다");
			$(this).val("");
			return;
		}
	}
});

$(document).on("click", "#coupon_apply", function(){

	var use_coupon = 0;
	$(".coupon_select option:selected").each(function(){
		if($(this).val()){
			use_coupon++;
		}
	});


	if(use_coupon){
		$("#use_coupon").prop("checked", true);
	} else{
		$("#use_coupon").prop("checked", false);
	}

	$("#coupon_list_wrap").hide();
	$("#coupon_use_btn").html("조회 및 사용");

	check_money();

});


function check_money(){

	var money_prce = parseInt($("#money_price").val());

	if(!money_prce){
		$("#money_price").val("0");
		money_prce = 0;
	}

	if(isNaN(money_prce) || money_prce<0){
		alert("숫자만 입력하셔야합니다");
		$("#money_price").val("0");
		money_prce = 0;
	}

	if(mb_money < money_prce){
		alert("보유하신 적립금이 입력하신 적립금액보다 적습니다.");
		$("#money_price").val("0");
		money_prce = 0;
	}

	if(cart_total_price < money_prce){
		alert("결제 금액 만큼만 적립금을 입력해주세요.");
		$("#money_price").val("0");
		money_prce = 0;
	}




	if($("#use_coupon").is(":checked")) {

		var total_coupon_price = 0;
		$(".coupon_select option:selected").each(function(){
			if($(this).data("discount_price")){
				total_coupon_price += parseInt($(this).data("discount_price"));
			}
		});

		$("#span_coupon_price").html(number_format(total_coupon_price));

	} else{

		var total_coupon_price = 0;
		$("#span_coupon_price").html("0");

	}




	if(cart_total_price < money_prce + total_coupon_price){
		alert("결제 금액 만큼만 적립금을 입력해주세요.");
		$("#money_price").val("0");
		money_prce = 0;
	}



	var pay_total_price = cart_total_price - money_prce - total_coupon_price;




	var discount_total_price = money_prce+total_coupon_price;

	$("#span_discount_price").html(number_format(discount_total_price));
	$("#span_pay_total_price").html(number_format(pay_total_price));

}




// 결제하기버튼클릭
$(document).on("click","#payment_btn",function(){

	var payment_type = $('.payment_type:checked').val();



	<? if($is_delivery){  ?>
	if(!$("#dy_name").val()){
		alert("배송지 이름을 입력해주세요");
		$("#dy_name").focus();
		return;
	}
	if(!$("#dy_hp").val()){
		alert("배송지 휴대전화를 입력해주세요");
		$("#dy_hp").focus();
		return;
	}
	if(!$("#dy_zip").val()){
		alert("배송지 우편번호를 입력해주세요");
		$("#dy_zip").focus();
		return;
	}
	if(!$("#dy_addr1").val()){
		alert("배송지 주소를 입력해주세요");
		$("#dy_addr1").focus();
		return;
	}
	if(!$("#dy_addr2").val()){
		alert("배송지 상세 주소를 입력해주세요");
		$("#dy_addr2").focus();
		return;
	}
	<? } ?>

	if(payment_type=="card"){
		/*
		if(!$("#card_code").val()){
			alert("카드를 선택해 선택해주세요");
			$("#card_code").focus();
			return;
		}
		if(!$("#card_quota").val()){
			alert("할부를 선택해주세요");
			$("#card_quota").focus();
			return;
		}
		*/
	} else if(payment_type=="banking"){
		if(!$("#bank_number").val()){
			alert("입금계좌를 선택해주세요");
			$("#bank_number").focus();
			return;
		}
		if(!$("#bank_name").val()){
			alert("입금하시는 분의 이름을 입력해주세요");
			$("#bank_name").focus();
			return;
		}
	} else{

	}
	// console.log("ajax위: "?+);
	$.ajax({
		type : "post"
		, url : "cart_order_update.php"
		, cache : false
		, data : $("#fcart_order").serialize()
		, success : function(response){
			var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				// console.log(json["payment_type"]);
				if(json["payment_type"]=="banking" || json["payment_type"]=="money" || json["payment_type"]=="coupon"){
					location.href = "order_list.php";
				} else{
					$(".od_id").val(json["od_id"]);
					$(".pay_price").val(json["pay_price"]);
					// cart_payment();
					//댕댕이
					// document.payForm.submit();
					nicepay();
				}

			} else{
				alert(json["msg"]);
			}
		}
	});

});

$(document).on("click",".payment_type",function(){

	var payment_type = $('.payment_type:checked').val();

	$(".payment_wrap").hide();
	$("#payment_"+payment_type).show();

});




var currentScroll = "";

$(document).on("click","#zipcode_btn, #dy_zip, #dy_addr1",function(){
	currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
	zipcode("dy_zip","dy_addr1","dy_addr2");
	$("#member_info").hide();
	$(".btn_back").attr("href","javascript:zipcode_close()");
});


function zipcode_close(){
	var element_wrap = document.getElementById('zipcode_wrap');
	element_wrap.style.display = 'none';
	$("#member_info").show();
	// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
	document.body.scrollTop = currentScroll;
	$(".btn_back").attr("href","javascript:history.back()");
}

function zipcode(zipcode,addr1,addr2){
	var element_wrap = document.getElementById('zipcode_wrap');

	// 현재 scroll 위치를 저장해놓는다.
	new daum.Postcode({
		oncomplete: function(data) {
			// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = data.address; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 기본 주소가 도로명 타입일때 조합한다.
			if(data.addressType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById(zipcode).value = data.zonecode; //5자리 새우편번호 사용
			document.getElementById(addr1).value = fullAddr;
			$("#member_info").show();

			// iframe을 넣은 element를 안보이게 한다.
			// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
			element_wrap.style.display = 'none';


			// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
			document.body.scrollTop = currentScroll;

			document.getElementById(addr2).focus();



		},
		// 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
		onresize : function(size) {
			element_wrap.style.height = size.height+'px';
		},
		width : '100%',
		height : '100%'
	}).embed(element_wrap);

	// iframe을 넣은 element를 보이게 한다.
	element_wrap.style.display = 'block';
}
//-->
</SCRIPT>
<?$authResultCode = $_REQUEST['AuthResultCode'];?>
<script language="javascript">
// Active-x 초기화 함수
NicePayUpdate();
// function goPay() {
// 	document.payForm.submit();
// } 
function goPay(form) {
	document.charset = 'euc-kr';   
	form.target = "_self";
	form.method = "post";
	form.action = "https://web.nicepay.co.kr/smart/paySmart.jsp";
	form.submit();

} 
//결제 요청 함수
function nicepay(){
var payForm = document.payForm; // 결제 form
	// 필수 사항들을 체크하는 로직을 삽입해 주십시오.
	goPay(payForm);

	// window.opener.open('','_self').close();
	// window.open('','_parent').close();

	// window.open('', '_self', '');
	// window.close();
}



function nicepayClose(){ // 결제 취소시 호출하게 되는 함수
	alert("결제가 취소 되었습니다");
}
// 카드사 인증후 결제 요청시 호출되는 함수
function nicepaySubmit(){


}


</script>

<?
include_once $nfor[skin_path]."tail2.php";
?>
