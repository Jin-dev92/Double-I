<?php
include_once $nfor[skin_path]."head.php";
include_once $nfor[path]."/lib/div.lib.php";
?>
<style>
.order_cancel_wrap { padding:10px; }
.order_cancel {  }

.item_head { padding:3px 0px; color:#999; font-size:12px; }
.item_body { border:solid 1px #d8d5d5; margin-bottom:10px; background:#fff;  }


.item_title { position:relative; font-size:14px; color:#616161; padding:7px; border:1px solid #ccc; background:#eee; margin-bottom:10px; }



.item_content { display:block; overflow:hidden; }
.item_content li { position:relative;  border-top:solid 1px #eee; }
.item_content li:first-child { position:relative;  border-top:solid 0px #fff; }



.item_img { position:absolute; left:10px; top:10px; width:75px; height:75px; }
.item_info_wrap { padding:10px 10px 10px 95px; }
.item_name1{ height:14px; font-size:14px; line-height:14px; overflow:hidden; color:#000; font-weight:bold; }
.item_name2{ height:36px; font-size:14px; line-height:18px; margin:3px 0px 5px 0px; color:#3a3a3a; overflow:hidden; }
.item_name3{ font-size:14px; line-height:18px; margin:3px 0px 0px 0px; color:#3a3a3a;}


</style>


<div class="order_cancel_wrap">

	<?
	echo item_div_print($order,$it_id);
	?>

	<div class="order_cancel">


		<div style="border-top:solid 1px #000; border-bottom:solid 1px #ccc; background-color:#fff; padding:10px 10px;">
			환불정보
		</div>
		<div style="border-bottom:solid 1px #ccc;">
			
			<div class="table nfornet">

				
				<?
				if($it_id){ // 상품취소

					$dy_price = sql_fetch("select * from nfor_dy_price where cart_id='$order[cart_id]' and it_id='$it_id'");
					if($dy_price[it_price]){	
				?>
					<div class="table-row">
						<div class="table-cell table-left">상품 취소금액</div>
						<div class="table-cell table-right"><?=number_format($dy_price[it_price])?>원</div>
					</div>
				<?
					}

					if($dy_price[dy_price]){	
				?>
					<div class="table-row">
						<div class="table-cell table-left">배송비</div>
						<div class="table-cell table-right"><?=number_format($dy_price[dy_price])?>원</div>
					</div>
				<?
					} 
				?>
					<div class="table-row">
						<div class="table-cell table-left">구매 합산금액</div>
						<div class="table-cell table-right"><?=number_format($dy_price[total_price])?>원</div>
					</div>

					<div class="table-row">
						<div class="table-cell table-left">쿠폰 취소금액</div>
						<div class="table-cell table-right"><?
						$coupon_cancel = sql_fetch("select * from nfor_coupon_use where od_id='$order[od_id]' and cp_it_id='$it_id'");
						echo number_format($coupon_cancel[cp_price]);						
						?>원</div>
					</div>
				<?
					$cancel_price = $dy_price[total_price];
				} else{ // 전체취소
				?>

					<div class="table-row">
						<div class="table-cell table-left">구매 합산금액</div>
						<div class="table-cell table-right"><?=number_format($order[total_price])?>원</div>
					</div>

					<div class="table-row">
						<div class="table-cell table-left">적립금 취소금액</div>
						<div class="table-cell table-right"><?=number_format($order[money_price])?>원</div>
					</div>

					<div class="table-row">
						<div class="table-cell table-left">쿠폰 취소금액</div>
						<div class="table-cell table-right"><?=number_format($order[coupon_price])?>원</div>
					</div>

				<? 
					if($order[payment_type] == "money" and $order[payment_type] == "coupon"){
						$cancel_price = 0;
					} else{
						$cancel_price = $order[$order[payment_type]."_price"];
					}
				} 				
				?>

				<div class="table-row">
					<div class="table-cell table-left">환불수단</div>
					<div class="table-cell table-right"><?=payment_type($order[payment_type])?></div>
				</div>

				<div class="table-row">
					<div class="table-cell table-left">환불 예상금액</div>
					<div class="table-cell table-right"><?=number_format($cancel_price)?>원</div>
				</div>
			</div>


		</div>

		<form name="forder_cancelrequest" id="forder_cancelrequest" method="post">
		<input type="hidden" name="mode" value="order_cancelrequest">
		<input type="hidden" name="od_id" value="<?=$order[od_id]?>">
		<input type="hidden" name="it_id" value="<?=$it_id?>">

		<select name="cancel_why" id="cancel_why">
			<option value="">취소사유를 선택해주세요
			<?
			$array_why = array("구매의사취소","색상 및 사이즈변경","다른 상품 잘못 주문","서비스 및 상품 불만족","상품정보상이","사고/불량");
			for($i=0; $i<count($array_why); $i++){
			?>
			<option value="<?=$array_why[$i]?>"><?=$array_why[$i]?>
			<? } ?>
		</select>

		<textarea name="cancel_why_msg" id="cancel_why_msg" placeholder="상세사유를 입력해주세요"></textarea>

		</form>
		<style>
		.nfornet .table-cell{ background-color:#fff; }
		.nfornet .table-left{ font-size:14px; padding:5px 10px; color:#666; text-align:left; }
		.nfornet .table-right{ font-size:14px; padding:5px 10px; text-align:right; }
		</style>



	</div>







<? if($is_expiry){ ?>
<div style="border:solid 1px #ccc; background-color:#ececec; padding:10px; margin:10px 0px; font-size:13px;">

	<p>구매일로부터 7일이 경과한 쿠폰은 현 공정거래법의거 70% 환불이 가능 합니다.</p>
	<p>70% 환불을 원하실 경우 본 사항에 동의하신 후 진행해주세요</p>

</div>

<div style="margin:10px auto; text-align:center;">
<input type="checkbox" name="agree_chk" id="agree_chk" class="agree_chk" checked="checked"> <label for="agree_chk">동의합니다</label>
</div>
<? } ?>





		<style>
		#cancel_why { width:100%; margin-top:10px; }
		#cancel_why_msg { width:100%; height:60px; margin-top:10px; }

		.son { margin:10px 0px; }  
		.son .table-left{ padding-right:5px; }
		.son .table-right{ padding-left:5px; }
		.son .table-cell a{ background-color:#fff; cursor:pointer; }
		.son .table-cell a.submit-btn { background-color:#ec3940; color:#fff; }
		</style>


		<div class="table son">
		<div class="table-row">
			<div class="table-cell table-left"><a href="javascript:history.back()" class="table-btn">취소</a></div>
			<div class="table-cell table-right"><a id="order_cancel_submit_btn" class="table-btn submit-btn">확인</a></div>
		</div>
		</div>



</div>


<SCRIPT LANGUAGE="JavaScript">
<!--
	
$(document).on("click","#order_cancel_submit_btn",function(){

	<? if($is_expiry){ ?>
	if(!$('.agree_chk').is(":checked")){
		alert("동의하셔야 진행가능합니다");
		$('.agree_chk').focus();
		return false;
    }
	<? } ?>

	if(!$("#cancel_why").val()){
		alert("취소사유를 선택해주세요");
		$("#cancel_why").focus();
		return;
	}

	$.ajax({ 
		type : "post"
		, url : "order_cancel.php"
		, cache : false  
		, data : $("#forder_cancelrequest").serialize() 
		, success : function(response){ 
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){
				alert("주문취소가 완료되었습니다");
				location.href = "order_list.php";
			} else{
				alert(msg);
			}
		}
	}); 

});
//-->
</SCRIPT>

<?
include_once $nfor[skin_path]."tail.php";
?>