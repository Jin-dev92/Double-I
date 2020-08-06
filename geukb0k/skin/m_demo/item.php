<?php
include_once $nfor[skin_path]."head.php";

$item[it_payment] = str_replace("style","alt",$item[it_payment]);
$item[it_memo] = str_replace("style","alt",$item[it_memo]);
?>







<!-- item_wrap -->
<div class="item_wrap">

	<div class="it_img_wrap">
		<div class="swiper-container-a">
			<div class="swiper-wrapper">
				<?
				for($i=1; $i<=5; $i++){
					if($item["it_img_m".$i]){
				?>
				<div class="swiper-slide"><img src="<?="$nfor[path]/data/main/".$item["it_img_m".$i]?>" alt="" class="it_img"></div>
				<? 
					}
				}
				?>
			</div>
			<div class="swiper-pagination-a"></div>
		</div>
	</div>
	
	<div class="wrap_item_info">
		<p class="it_description"><?=$item[it_description]?></p>
		<p class="it_name"><?=$item[it_name]?></p>
		<div class="it_price_wrap">
			<div class="it_price">
				<span class="it_price2"><?=number_format($item[it_price2])?><b> 원</b></span>
	
			</div>
		</div>
		

		<div class="<?=$item[it_delivery]?"delivery_type":"card_info"?>"><b></b>&nbsp;<?=delivery_type($item)?></div>
		




		<div class="sales_volume"><span><b style="color:#333;"><?=number_format($item[it_sales_volume])?></b>개 구매</span></div>

	</div>

	<div class="wrap_item_ico_table"> 
		<div class="wrap_item_ico">
			<div class="item_ico"><a class="btn_zzim<?=$item[zzim_is]?" on":""?>"><span>찜하기</span></a></div>
			<div class="item_ico"><a class="btn_alarm<?=$item[alarm_is]?" on":""?>"><span>판매알림</span></a></div> 
			<div class="item_ico"><a class="btn_sns"><span>공유하기</span></a></div>
		</div>
	</div>

	<div class="gond_item"></div>

	<nav class="nav_tabmenu">
		<ul class="tabmenu">
			<li class="active"><div><a href="#tab1">상세설명</a></div></li>
			<li><div><a href="#tab2">구매정보</a></div></li>
			<li><div><a href="#tab3">구매후기<em><b><?=$item[star_cnt]?number_format($item[star_cnt]):""?></b></em></a></div></li>
			<li><div><a href="#tab4">상품문의<em><b><?=$item[qna_cnt]?number_format($item[qna_cnt]):""?></b></em></a></div></li>
		</ul>
	</nav>

	<div id="tab1" class="tab-cont"><?=$item[it_memo]?></div>
	<div id="tab2" class="tab-cont"><?=$item[it_rule]?></div>
	<div id="tab3" class="tab-cont"><? include $nfor[skin_path]."inc_item_star.php"; ?></div>
	<div id="tab4" class="tab-cont"><? include $nfor[skin_path]."inc_item_qna.php"; ?></div>

	<div class="gond_item2"></div>

	<div class="other_item_list">
		<p class="other_item_title">같은곳에서 진행중인 행사</p>
		<div class="swiper-container swiper-container-b">
			<div class="swiper-wrapper">
				<?
				$result = sql_query("select * from nfor_item where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' and supply_no='$item[supply_no]' and it_id<>'$item[it_id]' order by rand()");
				for($i=0; $data=sql_fetch_array($result); $i++){
				?>
				<div class="swiper-slide">
					<a href="item.php?it_id=<?=$data[it_id]?>" style="display:block;">
					<div><img src="<?=$data[it_img_m1]?"$nfor[path]/data/main/$data[it_img_m1]":"$nfor[path]/img/item_noimg.jpg"?>" class="other_item_img"></div>
					<div>
					<p class="other_item_name"><?=$data[it_name]?></p>
					<b class="other_item_price2"><?=number_format($data[it_price2])?><span class="other_item_price1">원</span></b>
					</div>
					</a>
				</div>
				<? } ?>
			</div>
		</div>
	</div>


	<div class="gond_item3"></div>



</div>
<!-- //item_wrap -->

<!-- 창열기(구매하기버튼) -->
<div class="option_open_btn_wrap">
	<div class="option_open_pointer"></div>
	<div class="option_open_btn">구매하기</div>
</div>
<!-- //창열기(구매하기버튼) -->

<!-- 옵션창 -->
<div class="option_close_btn_wrap">
	<div class="option_close_pointer"></div>
	<div class="wrap_optbar">

		<!-- 옵션스크롤영역 -->
		<div class="option_scroll_all_wrap option_scroll">


			<!-- 순차옵션출력 -->
			<?
			if($item[it_opt_depth]){
				for($i=1; $i<=$item[it_opt_depth]; $i++){
			?>
			<div class="wrap_option_box <?=$i==1?"on":""?> wrap_option<?=$i?>_box">
				<div class="option_title basic_option_title option<?=$i?>" id="option<?=$i?>" data-option_name="<?=$item["it_option".$i]?$item["it_option".$i]:"선택"?>"><?=$item["it_option".$i]?$item["it_option".$i]:"선택"?></div>
				<div class="option_select_box option<?=$i?>_box">
					<ul class="<? if($i>1){ ?>basic_ul_option<? } ?> ul_option<?=$i?>">
						<?
						if($i==1){
							$que = sql_query("select * from nfor_item_option where it_id='$item[it_id]' and option_type='0' and option_view='0' and option_select='0' group by option_name1 order by option_rank asc");
							while($data = sql_fetch_array($que)){
						?>
						<li<? if($item[it_opt_depth]=="1"){ ?> id="opt_<?=$data[option_id]?>" <?=option_stock($data[stock],$data[stock_now])?"":"class=\"option_soldout\" "?>data-stock="<?=option_stock($data[stock],$data[stock_now])?>"<? } ?> data-depth="<?=$i?>" data-option_id="<?=$data[option_id]?>" data-option_name="<?=$data[option_name1]?>" data-price="<?=$data[price]?>" data-basic="1">
							<div><? if($item[it_opt_depth]=="1"){ ?><?=option_stock($data[stock],$data[stock_now])?"":"(재고없음) "?><? } ?><?=$data[option_name1]?></div>
							<? if($item[it_opt_depth]=="1"){ ?><b><?=number_format($data[price])?><span>원</span></b><? } ?>
						</li>
						<? 
							}
						}					
						?>
					</ul>
				</div>
			</div>
			<? 
				}
			} 		
			?>
			<!-- //순차옵션출력 -->
			


			<!-- 추가옵션 -->
			<?
			$chk_add_option = sql_fetch("select count(*) as cnt from nfor_item_option where it_id='$item[it_id]' and option_type='0' and option_view='0' and option_select > 0");
			if($chk_add_option[cnt]){

				for($i=1; $i<=4; $i++){
					$que = sql_query("select * from nfor_item_option where it_id='$item[it_id]' and option_type='0' and option_view='0' and option_select='$i' order by option_rank asc");
					if(sql_num_rows($que)){
					?>
					<div class="wrap_option_box wrap_addoption<?=$i?>_box">
						<div class="option_title" id="addoption<?=$i?>" data-option_name="<?=$item["it_add_option".$i]?$item["it_add_option".$i]:"선택"?>"><?=$item["it_add_option".$i]?$item["it_add_option".$i]:"선택"?></div>

						<div class="option_select_box addoption<?=$i?>_box" id="sonwonyoung">
							<ul class="ul_addoption<?=$i?>">
								<?
								while($data = sql_fetch_array($que)){ 
								?>
								<li id="opt_<?=$data[option_id]?>" <?=option_stock($data[stock],$data[stock_now])?"":"class=\"option_soldout\" "?>data-stock="<?=option_stock($data[stock],$data[stock_now])?>" data-depth="<?=$item[it_opt_depth]?>" data-option_id="<?=$data[option_id]?>" data-option_name="<?=$data["option_name1"]?>" data-price="<?=$data[price]?>">
									<div><?=option_stock($data[stock],$data[stock_now])?"":"(재고없음) "?> <?=$data["option_name1"]?></div>
									<b><?=number_format($data[price])?><span>원</span></b>
								</li>
								<? } ?>
							</ul>
						</div>
					</div>
					<?
					}
				}

			}
			?>
			<!-- //추가옵션 -->





			<form name="item_frm" id="item_frm" method="post" action="cart.php">
			<input type="hidden" name="it_id" value="<?=$item[it_id]?>">
			<input type="hidden" name="mode" value="insert">
			<input type="hidden" name="move" id="move">
			<input type="hidden" name="navernpay" id="navernpay">
			<div class="option_cal_list option_cal_list1">
			<?
			if(!$item[it_opt_depth]){
				$option = sql_fetch("select * from nfor_item_option where it_id='$item[it_id]' and option_type='1'");
			?>
			<!-- 옵션없을때 -->
			<div class="append_box append_box<?=$option[option_id]?>">
			<input type="hidden" name="option_id[]" class="option_id" value="<?=$option[option_id]?>">
			<p class="append_option_name"><?=$option[option_name1]?></p>
			<p class="append_count"><input type="number" pattern="[0-9]*" name="option_cnt[]" value="1" class="option_cnt basic" data-price="<?=$option[price]?>" data-basic="1"><a class="count_plus"></a><a class="count_minus"></a></p>
			<p class="append_price_del"><span class="append_price"><?=number_format($option[price])?>원</span></p>
			</div>
			<!-- //옵션없을때 -->
			<? } ?>
			</div>
			</form>

			

		</div>
		<!-- //옵션스크롤영역 -->


		<div class="option_cal_total">합산금액 <span class="option_cal_total_span"><?=number_format($item[it_price2])?></span>원</div>
	
		<!-- 장바구니바로구매버튼 -->
		<ul class="option_cart_order_btn">
			<li><div class="option_cart_btn">장바구니</div></li>
			<li><div class="option_order_btn">바로구매</div></li>
		</ul>
		<?
		if($config[cf_naverpay_use]){
			//include_once "inc_naverpay.php";
		}
		?>
		<!-- //장바구니바로구매버튼 -->

	</div>


</div>
<!-- //옵션창 -->












<!-- 공유하기팝업 -->
<div id="sns_popup">
	<div class="sns_wrap">
		<div class="sns_title">
			공유하기
			<a class="sns_close_btn"></a>
		</div>
		<ul class="sns_list">
			<li><a href="javascript:sns_link('kakaotalk');"><i class="btn_kakaotalk"></i>카카오톡</a></li>
			<li><a href="javascript:sns_link('kakaostory')"><i class="btn_kakaostory"></i>카카오스토리</a></li>
			<li><a href="javascript:sns_link('twitter')"><i class="btn_twitter"></i>트위터</a></li>
			<li><a href="javascript:sns_link('facebook')"><i class="btn_facebook"></i>페이스북</a></li>
			<li><a href="javascript:sns_link('naver')"><i class="btn_cafe"></i>네이버공유</a></li>
			<li><a href="javascript:sns_link('sms')"><i class="btn_sms"></i>SMS</a></li>
			<li><a href="javascript:sns_link('naverblog')"><i class="btn_blog"></i>링크공유</a></li>
			<li><a href="javascript:sns_link('naverline')"><i class="btn_line"></i>라인</a></li>
		</ul>
	</div>
</div>
<!-- //공유하기팝업 -->

<!-- 찜하기팝업 -->
<div id="zzim_popup">
	<div class="zzim_msg off"><p>찜하기팝업</p></div>
</div>
<!-- //찜하기팝업 -->

<!-- 판매알림팝업 -->
<div id="alarm_popup">
	<div class="alarm_msg off"><p>판매알림팝업</p></div>
</div>
<!-- //판매알림팝업 -->

<!-- 장바구니담기팝업 -->
<div id="cart_popup">
	<div>
		<p>장바구니에 상품이 담겼습니다.</p>
		<a href="cart.php">구매하러가기</a>
	</div>
</div>
<!-- 장바구니담기팝업 -->


<script type="text/javascript">
<!--
var it_buy_qty = parseInt("<?=$item[it_buy_qty]?>");
var it_opt_depth = parseInt("<?=$item[it_opt_depth]?>");
var cf_name = "<?="$config[cf_name]"?>";
var it_url = location.href;	
var it_img = "<?="$nfor[url]/data/main/$item[it_img_m1]"?>";
var it_name = "<?=$item[it_name]?>";
var it_description = "<?=$item[it_description]?>";
var it_id = "<?=$item[it_id]?>";
var app_schema = "net.nfor.demo";
var app_name = "nfor";
var kakao_key = "eb2b85038c91eacb325347827375f553";

$(document).ready(function() {
	$(".tabmenu li").click(function(){
		$(".tabmenu li").removeClass("active");
		$(this).addClass("active");
		$(".tab-cont").hide();
		$($(this).find("a").attr("href")).show();
		return false;
	});
	var swiper = new Swiper('.swiper-container-a', {
		pagination: '.swiper-pagination-a',
		slidesPerView: 1,
		paginationClickable: true,
		loop: true
	});

	var swiperB = new Swiper('.swiper-container-b', {
		freeMode: true,
		spaceBetween: 10,
		slidesPerView: 3
	});
		
	/*
	var swiperC = new Swiper('.swiper-container-c', {
		freeMode: true,
		spaceBetween: 10,
		slidesPerView: 3
	});
	*/
});

$(window).scroll( function(){
	var scrollTop = $(document).scrollTop();
	if(scrollTop >= $('.gond_item').position().top){
		$(".tabmenu").addClass("top_show");
	} else{
		$(".tabmenu").removeClass("top_show");
	}
});

$(".btn_zzim").on("click", function(){	

	$.ajax({
		type: "post",
		data : "mode=zzim&it_id="+it_id,
		url: "item.php",
		success: function(response){
			var json = $.parseJSON(response); 
			
			if(json["result"]=="login"){
				location.replace("login.php?url=item.php?it_id="+it_id);				
			} else if(json["result"]=="delete"){
				$(".btn_zzim").removeClass("on");
				$(".zzim_msg").removeClass("on").addClass('off');	
				$('#zzim_popup').show();
				setTimeout(function(){
					$('#zzim_popup').hide();
				},2000);
			} else if(json["result"]=="insert"){
				$(".btn_zzim").removeClass("off").addClass("on");
				$(".zzim_msg").removeClass("off").addClass('on');
				$('#zzim_popup').show();
				setTimeout(function(){
					$('#zzim_popup').hide();
				},2000);
			} else{
				alert(json["msg"]);
			}
		}
	});

});


$(".btn_alarm").on("click", function(){	
	$.ajax({
		type: "post",
		data : "mode=alarm&it_id="+it_id,
		url: "item.php",
		success: function(response){
			var json = $.parseJSON(response); 
			
			if(json["result"]=="login"){
				location.replace("login.php?url=item.php?it_id="+it_id);				
			} else if(json["result"]=="delete"){
				$(".btn_alarm").removeClass("on");
				$(".alarm_msg").removeClass("on").addClass('off');	
				$('#alarm_popup').show();
				setTimeout(function(){
					$('#alarm_popup').hide();
				},2000);
			} else if(json["result"]=="insert"){
				$(".btn_alarm").removeClass("off").addClass("on");
				$(".alarm_msg").removeClass("off").addClass('on');
				$('#alarm_popup').show();
				setTimeout(function(){
					$('#alarm_popup').hide();
				},2000);
			} else{
				alert(json["msg"]);
			}
		}
	});

});


$(".btn_sns").on("click", function(){
	$("#sns_popup").show();
});

$(document).on("click", ".option_cart_order_btn.on .option_cart_btn", function(){
	$('#move').val("cart");

	$.ajax({ 
		type : "POST"
		, url : "cart.php"
		, cache : false  
		, data : $("#item_frm").serialize()
		, success : function(response){			
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){
				$("#cart_cnt").html(json["cart_cnt"]);


				$("#cart_popup").animate({"top":"100px"}, 500 ).show();
				setTimeout(function(){
					$('#cart_popup').animate({"top":"-280px"}, 500 );
				},5000);


				$(".option_close_btn_wrap").animate({"bottom":"-280px"}, 500 ).hide();
				$('.option_open_btn_wrap').show();

				$("#cart_cnt").val(json["cart_cnt"]);

			} else{
				alert(json["msg"]);
			}	
		} 
	});

});

$(document).on("click", ".option_cart_order_btn.on .option_order_btn", function(){
	$('#move').val("order");

	$.ajax({ 
		type : "POST"
		, url : "cart.php"
		, cache : false  
		, data : $("#item_frm").serialize()
		, success : function(response){			
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){
				location.href="cart_order.php?it_id="+it_id;
			} else{
				alert(json["msg"]);
			}	
		} 
	});

});

$(document).on("click", ".sns_close_btn", function(){
	$('#sns_popup').hide();
});

$(document).on("click", ".option_open_btn_wrap", function(){ // 구매하기버튼클릭

	$("body").css("overflow-y","hidden");

	if(!it_opt_depth){ // 옵션사용을안하면
		$(".option_cal_total").show(); // 합산금액을보이고
		$(".option_cart_order_btn").addClass("on"); // 버튼활성화
	}
	$(".option_close_btn_wrap").animate({"bottom":"0px"}, 500 ).show();
	$('.option_open_btn_wrap').hide();
});

$(document).on("click", ".option_close_pointer", function(){ // 닫기버튼클릭
	$(".option_close_btn_wrap").animate({"bottom":"-280px"}, 500 ).hide();
	$('.option_open_btn_wrap').show();
});




$(document).on("touchmove", ".item_wrap", function(){
	$("body").css("overflow-y","scroll");
});

$(document).on("click touchmove", ".option_scroll_all_wrap", function(){
	$("body").css("overflow-y","hidden");
});




$(document).on("click", ".option_title", function(){

	$("body").css("overflow-y","hidden");

	$('.option_id').each(function(){
		$("#opt_"+$(this).val()).addClass("on"); // 옵션이선택되었다는체크박스추가
	});

	if($(this).attr('id').substr("0","3")=="add"){ // 클릭한게 추가옵션이면
		if($(".basic").length<1){
			alert("기본옵션을 먼저 선택해주세요");
			return;
		} 
	}

	if($("."+$(this).attr('id')+"_box").css('display')=="none"){ // 옵션목록값열때
		
		if($.trim($(".ul_"+$(this).attr('id')).html())){ // 목록값이있는지체크

			$(".option_scroll_all_wrap").removeClass("option_scroll"); // 옵션창스크롤바제거

			$("."+$(this).attr('id')+"_box").show(); // 해당목록값출력
			$(".wrap_optbar").css("height","280px").css("overflow","hidden");
			$(".wrap_option_box").hide();
			$(".wrap_"+$(this).attr('id')+"_box").show();
			$(".wrap_"+$(this).attr('id')+"_box").addClass("on"); // 현제옵션선택활성화
			$(".option_cart_order_btn").hide(); // 버튼감춤
			$('.option_cal_total').hide(); // 합산금액감춤
			$('.option_cal_list').hide(); // 옵션목록감춤
		}
	} else{ // 옵션목록값닫을때

		$(".option_scroll_all_wrap").addClass("option_scroll"); // 옵션창스크롤바추가

		$(".option_select_box").hide();
		$('.wrap_optbar').css('height','auto');
		$(".wrap_option_box").show(); // 옵션선택박스출력
		$(".option_cart_order_btn").show(); // 버튼출력

		if($(".append_box").length){ // 옵션선택이있다면
			$('.option_cal_total').show(); // 합산금액출력
			$('.option_cal_list').show(); // 옵션목록출력
		}

		// 빨강색 열어진게 있는지 체크해서 있으면 현제꺼 제거
		if($(".wrap_option_box.on").length > 1){ // 선택된값이 1개이상 이라면
			$(".wrap_"+$(this).attr('id')+"_box").removeClass("on"); // 현제옵션선택비활성화
		}

	}
});

$(document).on("click", ".option_select_box li", function(){
	var option_id = $(this).data('option_id');
	var option_name = $(this).data('option_name');
	var option_stock = parseInt($(this).data('stock'));
	var depth = parseInt($(this).data('depth'));
	var price = $(this).data('price');
	var basic = $(this).data('basic');
	var next_depth = parseInt($(this).data('depth'))+1;
	
	$(".option_scroll_all_wrap").addClass("option_scroll"); // 옵션창스크롤바추가

	if((depth==it_opt_depth || !basic) && !option_stock){ // 재고가 없으면
		return;
	}

	$(".option_select_box").hide();
	$('.wrap_optbar').css('height','auto');
	$(".wrap_option_box").show();
	$(".option"+depth).html(option_name); // 선택옵션명지정

	$(".wrap_option_box").removeClass("on"); // 선택상태모두제거
	$(".option_cart_order_btn").show(); // 버튼활성화

	if($(".append_box").length){ // 옵션선택이있다면
		$(".option_cal_total").show(); // 합산금액출력
		$('.option_cal_list').show(); // 옵션목록출력
	}
	
	if(depth==it_opt_depth || !basic){ // 마지막옵션선택이면

		// 옵션중복체크
		var is_select = 0;
		$('.option_id').each(function(){
			if($(this).val()==option_id){
				is_select = 1;
			}
		});
		if(is_select){
			alert('이미 선택한 항목입니다.');
				return;
		}

		if(basic=="1"){ // 기본옵션이면

			$(".wrap_option1_box").addClass("on");// 첫번째셀렉트선택

			// 옵션명지정
			var append_option_name = "";
			$('.basic_option_title').each(function(){
				append_option_name += $(this).html()+" ";
			});


			var class_basic = " basic"; // 클래스명추가

		} else{ // 추가옵션이면

			var append_option_name = option_name; // 옵션명지정

			var class_basic = "";

		}

		$('.basic_ul_option').html(""); // 기본옵션의 옵션목록값 삭제(2차분류이상)


		//  옵션명 초기화
		$('.option_title').each(function(){
			$(this).html($(this).data('option_name'));
		});

		 // 가격표추가
		append_option_id = "<input type='hidden' name='option_id[]' class='option_id"+class_basic+"' value='"+option_id+"'>";
		append_option_name = "<p class='append_option_name'>"+append_option_name+"</p>";
		append_count = "<p class='append_count'><input type='number' pattern='[0-9]*' name='option_cnt[]' value='1' class='option_cnt' data-price='"+price+"' data-stock='"+option_stock+"'><a class='count_plus'></a><a class='count_minus'></a></p>";
		append_price = "<span class='append_price'>"+number_format(price)+"원</span>";
		append_del = "<a class='count_del'></a>";
		append_price_del = "<p class='append_price_del'>"+append_price+append_del+"</p>"; 
		$(".option_cal_list").append("<div class='append_box append_box"+option_id+"'>"+append_option_id+append_option_name+append_count+append_price_del+"</div>");

		cal_total(); // 합산금액

	} else{
		$(".wrap_option"+next_depth+"_box").addClass("on"); // 다음셀렉트선택
		// 다음선택옵션 불러옴
		$.get("<?=$nfor[skin_path]?>option.php",{
			it_id : it_id,
			option_id : option_id,
			depth : next_depth
		}, function(data){
			$(".ul_option"+next_depth).html(data);
		});
	}
});

$(document).on("click", ".count_plus", function(){
	var ea_option_cnt = parseInt($(this).parent().find(".option_cnt").val());
	ea_option_cnt = ea_option_cnt+1;

	// 최대구매수량제한 
	if(option_cnt_total() >= it_buy_qty){
		alert('1인당 최대 구매 수량은 '+it_buy_qty+'개 입니다.\n구매 수량을 확인해주세요.');
		ea_option_cnt = 1;
	}

	// 재고에따른구매수량제한
	var ea_stock = parseInt($(this).parent().find(".option_cnt").data('stock'));
	if(ea_option_cnt > ea_stock){
		alert("최대 "+ea_stock+"개 까지 구매가능합니다");
		ea_option_cnt = ea_stock;
	}

	var option_id = $(this).parent().parent().find(".option_id").val();
	$(".append_box"+option_id+" .option_cnt").val(ea_option_cnt);
	cal_total();
});

$(document).on("click", ".count_minus", function(){
	var ea_option_cnt = parseInt($(this).parent().find(".option_cnt").val());
	ea_option_cnt = ea_option_cnt-1;
	if(ea_option_cnt<1){
		ea_option_cnt = 1;
	}
	var option_id = $(this).parent().parent().find(".option_id").val();
	$(".append_box"+option_id+" .option_cnt").val(ea_option_cnt);
	cal_total();
});

$(document).on('blur change','.option_cnt',function(){

	var option_id = $(this).parent().parent().find(".option_id").val();
	
	if(isNaN($(this).val()) || parseInt($(this).val())<0 || !$(this).val()){
		$(".append_box"+option_id+" .option_cnt").val(1);
	}	

	// 최대구매수량제한 
	if(option_cnt_total() >= it_buy_qty){
		alert('1인당 최대 구매 수량은 '+it_buy_qty+'개 입니다.\n구매 수량을 확인해주세요.');
		$(".append_box"+option_id+" .option_cnt").val(1);
	}

	// 재고에따른구매수량제한
	var ea_stock = parseInt($(this).data('stock'));
	if(parseInt($(this).val()) > ea_stock){
		alert("최대 "+ea_stock+"개 까지 구매가능합니다");
		$(".append_box"+option_id+" .option_cnt").val(ea_stock);
	}

	// 동기화
	$(".append_box"+option_id+" .option_cnt").val($(this).val());

	cal_total();
});

$(document).on("click", ".count_del", function(){
	$(".append_box"+$(this).parent().parent().find(".option_id").val()).remove();

	$("#opt_"+$(this).parent().parent().find(".option_id").val()).removeClass("on"); // 옵션이선택되었다는체크박스삭제

	if(!$(".basic").length){
		$(".option_cal_list").html(""); // 마지막남은 기본옵션이라면 모두삭제
		$(".option_select_box ul li").removeClass("on"); // 모든체크박스삭제
	}
	cal_total();
});

function cal_total(){
	var option_cal_total_span = 0;
	var ea_price = 0;
	$('.option_cal_list1 .option_cnt').each(function(){
		ea_price = parseInt($(this).data('price')) * parseInt($(this).val());
		option_cal_total_span += ea_price;
		var option_id = $(this).parent().parent().find(".option_id").val();
		$(".append_box"+option_id+" .append_price").html(number_format(ea_price)+"원");
	});
	$(".option_cal_total_span").html(number_format(option_cal_total_span));

	if(!$(".append_box").length){ // 옵션선택이없다면
		$('.option_cal_total').hide(); // 합산금액을 감춤
		$(".option_cart_order_btn").removeClass("on"); // 버튼비활성화
	} else{
		$(".option_cal_total").show(); // 합산금액출력
		$('.option_cal_list').show(); // 옵션목록출력
		
		$(".option_cart_order_btn").addClass("on"); // 버튼활성화
	}
}


function option_cnt_total(){
	var option_cnt_total = 0;
	$('.option_cnt').each(function(){
		option_cnt_total = option_cnt_total + parseInt($(this).val());
	});
	return option_cnt_total;
}
//-->
</script>

<?php
include_once $nfor[skin_path]."tail.php";
?>