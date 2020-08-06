<?php
include_once $nfor[skin_path]."head.php";
?>
<script type="text/javascript">
<!--


// 전체삭제
$(document).on("click", "#cart_delete_btn", function(){

	if(!$(".it_option_wrap .chk:checked").length){
		alert("삭제할 옵션을 선택해주세요");
	} else{
		if(confirm("선택하신 옵션을 삭제하시겠습니까?")){
			$("#mode").val("check_delete");
			$.ajax({
				type: "post",
				data : $("#fcart").serialize(),
				url: "cart.php",
				success: function(response){
					var json = $.parseJSON(response); 
					if(json["result"]=="ok"){
						document.location.reload();
					}
				}
			});
		}
	}

});



// 전체선택
$(document).on("click", "#select_all", function(){
	$(".chk").prop("checked", this.checked );

	if($("#select_all").is(":checked")){
		$("#cart_delete_btn").html("전체삭제");
	} else{
		$("#cart_delete_btn").html("선택삭제");
	}
});

// 상품선택
$(document).on("click", ".check_item", function(){
	$(".check_item_"+$(this).val()).prop("checked", this.checked );
});

// 옵션삭제
$(document).on("click",".option_delete",function(){
	var option_id = $(this).data("option_id");
	var option_name = $(this).data("option_name");
	if(confirm("선택하신 옵션을 삭제하시겠습니까?\n"+option_name)){
		$.post("cart.php",{ "mode":"option_delete", "option_id":option_id }, function(response){
			var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				document.location.reload();
			} else{
				alert("상품 삭제에 실패하였습니다");
			}
		});
	}
});

// 옵션수량증가
$(document).on('click','.option_plus',function(){
	option_id = $(this).data("option_id");
	option_price = parseInt($("#option_id_"+option_id+" .option_cnt").data("option_price"));
	option_cnt = parseInt($("#option_id_"+option_id+" .option_cnt").val());
	option_cnt = option_cnt + 1;
	$("#option_id_"+option_id+" .option_cnt").val(option_cnt);

	option_total_price = option_price*option_cnt;
	option_price = $("#option_id_"+option_id+" .option_total_price").html(number_format(option_total_price)+"원");

	option_change(option_id, option_cnt);
});

// 옵션수량차감
$(document).on('click','.option_minus',function(){
	option_id = $(this).data("option_id");
	option_price = parseInt($("#option_id_"+option_id+" .option_cnt").data("option_price"));
	option_cnt = parseInt($("#option_id_"+option_id+" .option_cnt").val());
	option_cnt = option_cnt - 1;
	if(option_cnt<1){
		option_cnt = 1;
	}
	$("#option_id_"+option_id+" .option_cnt").val(option_cnt);

	option_total_price = option_price*option_cnt;
	option_price = $("#option_id_"+option_id+" .option_total_price").html(number_format(option_total_price)+"원");

	option_change(option_id, option_cnt);
});

// 옵션수량변경
$(document).on('blur','.option_cnt',function(){
	option_id = $(this).data("option_id");
	option_price = parseInt($(this).data("option_price"));
	option_cnt = parseInt($(this).val());
	$(this).val(option_cnt);

	option_total_price = option_price*option_cnt;
	option_price = $("#option_id_"+option_id+" .option_total_price").html(number_format(option_total_price)+"원");

	option_change(option_id, option_cnt);	
});

$(document).on("click",".chk",function(){

	if(!$(this).is(":checked")){
		$("#cart_delete_btn").html("선택삭제");
	}

	$.ajax({
		type: "post",
		data : $("#fcart").serialize(),
		url: "cart.php",
		success: function(response){
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){				
				cart_info(json);
			}
		}
	});

});

function option_change(option_id, option_cnt){

	$.ajax({
		type: "post",
		url: "cart.php",
		data: {
			"mode":"option_change",
			"option_id": option_id,
			"option_cnt": option_cnt
		},
		cache: false,
		async: false,
		success: function(response){
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){				
				cart_info(json);
			}
		}
	});

}

function cart_info(json){
	
	if(json["item"]){

		$.each(json["item"], function(key, value){
			it_id = value["it_id"];
			item_price = parseInt(value["item_price"]);
			delivery_state = value["delivery_state"];

			$("#it_id_"+it_id+" .it_total_price").html(number_format(item_price)+"원");
			$("#it_id_"+it_id+" .it_delivery_price").html(delivery_state);

		});

	}


	var item_total_price = parseInt(json["item_total_price"]);
	var delivery_total_price = parseInt(json["delivery_total_price"]);
	var cart_total_price = parseInt(json["cart_total_price"]);

	$("#item_total_price").html(number_format(item_total_price));
	$("#delivery_total_price").html(number_format(delivery_total_price));
	$("#cart_total_price").html(number_format(cart_total_price));
	
}
//-->
</script>

<style>
.cart_wrap { padding:10px; }
.select_all_wrap { width:100%; height:24px; position:relative; margin-bottom:10px; }
.cart_item_wrap { background-color:#fff; border:solid 1px #ccc; padding:10px; margin-bottom:10px; }
.it_name_wrap { position:relative; width:100%; height:75px; padding-bottom:10px; }
.check_item { position:absolute; left:0px; top:25px; }
.it_name_wrap a { display:block; position:relative; margin-left:30px; box-sizing:border-box; -webkit-box-sizing:border-box; }
.cart_item_img { display:block; width:75px; height:75px; }
.it_name { display:block; font-size:15px; position:absolute; left:85px; top:0px; height:75px; display:flex;  }
.it_name span { align-self:center; overflow:hidden; text-overflow:ellipsis; -webkit-line-clamp:4; display:-webkit-box; -webkit-box-orient:vertical; }

.option_name_wrap { padding:10px 0px; } 
.it_option_wrap li { border-top:1px solid #dededb; padding-bottom:10px; }
.opt_name { font-size:14px; }

.option_count_price_wrap { position:relative; height:31px; width:100%; }
.option_count { display:inline-block; position:absolute; top:0px; left:0px; width:117px; } 
.option_total_price { position:absolute; top:0px; right:41px; line-height:31px; }
.option_delete { position:absolute; top:0px; right:0px; cursor:pointer; padding:0px; width:31px; height:31px; background: url("<?=$nfor[skin_path]?>img/layout.png") no-repeat; background-size: 320px auto; background-position: -100px -450px; }

.ea_sum_box { border:solid 1px #e5e5e5; width:100%; }
.ea_sum_box b { display:block; background-color:#f4f4f4; border-bottom:solid 1px #e5e5e5; font-size:13px; padding:5px 10px; text-align:center; } 
.ea_sum_box span { font-size:14px; line-height:24px; }
.ea_sum_box1 { float:left; width:50%; text-align:center; }
.ea_sum_box2 { float:left; width:50%; text-align:center; margin-left:-1px; border-left:solid 1px #e5e5e5; }

#item_total_price { color:#4d5454; font-size:19px; font-family:arial; font-weight:bold; }
#delivery_total_price { color:#4d5454; font-size:19px; font-family:arial; font-weight:bold; }
#cart_total_price { color:#ec3940; font-size:19px; font-family:arial; font-weight:bold; }

.total_price_wrap { border:solid 1px #cbcbcb; background-color:#fff; }
.cart_order_btn { display:block; width:100%; height:40px; line-height:40px; text-align:center; padding:0px; margin:0px; margin:20px 0px; font-size:16px; font-weight:bold; background-color:#d32f2f; border:solid 1px #d32f2f; color:#fff; }


.option_plus { cursor:pointer; display:block; padding:0px; border:solid 1px #c9c9c9; width:33px; height:29px; position:absolute; right:0px; top:0px; background:url(<?=$nfor[skin_path]?>img/layout.png) no-repeat;background-size: 320px auto; background-position: -0px -450px; }
.option_minus {cursor:pointer; display:block; padding:0px; border:solid 1px #c9c9c9; width:33px; height:29px; position:absolute; left:0px; top:0px; background:url(<?=$nfor[skin_path]?>img/layout.png) no-repeat;background-size: 320px auto;background-position: -50px -450px;}


#cart_delete_btn { cursor:pointer; position:absolute; right:0px; top:0px; width:62px; height:20px; border:solid 1px #ccc; background-color:#fff; font-size:14px; color:#888; letter-spacing:-0.5px; text-align:center; display:block; padding:3px 0px 1px 0px; }
</style>

<form method="post" id="fcart">
<input type="hidden" name="mode" id="mode" value="checkbox">


<div class="cart_wrap">

	<div class="select_all_wrap">
		<input type="checkbox" id="select_all" class="chk select_all" checked> <label for="select_all">전체선택</label>
		<a id="cart_delete_btn">전체삭제</a>	
	</div>

	<ul class="cart_item_list">
	<?
	$n = 0;
	$cart_que = sql_query("select * from nfor_cart where cart_id='$ss_cart_id' group by it_id order by ct_id desc");
	while($cart = sql_fetch_array($cart_que)){
		$item = item($cart[it_id]);	
	?>
	<li class="cart_item_wrap" id="it_id_<?=$item[it_id]?>">
		

 
		<div class="it_name_wrap">
			
			<input type="checkbox" class="chk check_item" value="<?=$item[it_id]?>" checked>
			<a href="item.php?it_id=<?=$item[it_id]?>">
				<img src="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/it_img_l_no.jpg"?>" class="cart_item_img">
				<div class="it_name"><span><?=$item[it_name]?></span></div>
			</a>
			
		</div>


		<ul class="it_option_wrap">
		<?
		$ct_que = sql_query("select * from nfor_cart where cart_id='$ss_cart_id' and it_id='$cart[it_id]'");
		while($ct = sql_fetch_array($ct_que)){
			$ct_sum[$cart[it_id]] += $ct[option_price]*$ct[option_cnt];
			$opt_name = $ct[option_select1]." ".$ct[option_select2]." ".$ct[option_select3]." ".$ct[option_select4];
			$opt = sql_fetch("select * from nfor_item_option where option_id='$ct[option_id]'");
			$opt_stock = $opt[stock]-it_sales_volume($ct[it_id],$ct[option_id]);
		?>
		<li id="option_id_<?=$ct[option_id]?>">
			
			<input type="hidden" name="option_id[]" class="option_id" value="<?=$ct[option_id]?>">
			
			<div class="option_name_wrap">
				<input type="checkbox" name="chk[]" value="<?=$n?>" id="chk_<?=$ct[option_id]?>" class="chk check_item_<?=$item[it_id]?>" checked>
				<span class="opt_name"><?=$opt_name?></span>
			</div>


			<div class="option_count_price_wrap">
				<p class="option_count"><input type="number" pattern="[0-9]*" name="option_cnt[]" class="option_cnt" value="<?=$ct[option_cnt]?>" data-option_id="<?=$ct[option_id]?>" data-option_price="<?=$ct[option_price]?>"><a class="option_plus" data-option_id="<?=$ct[option_id]?>"></a><a class="option_minus" data-option_id="<?=$ct[option_id]?>"></a></p>


				<span class="option_total_price"><?=number_format($ct[option_price]*$ct[option_cnt])?>원</span>

				<a class="option_delete" data-option_id="<?=$ct[option_id]?>" data-option_name="<?=$opt_name?>"></a>

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




</form>



























<div class="total_price_wrap">

	<div style="float:left; width:50%; border-right:solid 1px #efefef; text-align:center; padding:10px 0px;">
		<p>총 삼품금액</p>
		<span id="item_total_price"><?=number_format($item_total_price)?></span>원
	</div>
	<div style="float:left; width:50%; margin-left:-1px; text-align:center; padding:10px 0px;">
		<p>총 배송비</p>
		<span id="delivery_total_price"><?=number_format($delivery_total_price)?></span>원
	</div>
	<div style="clear:both;"></div>

	<div style="border-top: solid 1px #efefef; text-align:center; padding:10px;">

	<b>주문금액합계</b> <span id="cart_total_price"><?=number_format($total_price)?></span>원

	</div>

</div>








<a href="cart_order.php" class="cart_order_btn">구매하기</a>








<?php
if($config[cf_naverpay_use]){
	//include_once "inc_naverpay.php";
}
?>






</div>





<?php
include_once $nfor[skin_path]."tail.php";
?>