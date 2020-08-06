<?php
include_once $nfor[skin_path]."head.php";
?>
<style>
.qna_memo { -ms-word-break:break-all; }
.star_memo { -ms-word-break:break-all; }
.sub_item_wrap{ padding:0px; width:100%; overflow:hidden; border:solid 1px #DCDCDC; margin-top:20px; background-color:#fff;  }
.item_thum{ float:left; padding-top:0px; position:relative; width:575px; min-height:554px; text-align:center;  }
.item_info { float:left; position:relative; display:block; border-left:solid 1px #DCDCDC; background-color:#fafafa; width:485px; min-height:535px; padding:20px 50px; }
.item_info_left{ float:left; }

.item_info_gu{ float:left; font-size:18px; line-height:30px; font-weight:800; letter-spacing:-px;}
.color_txt{color:#d32f2f;}
.item_info_time {  font-size:15px; line-height:15px; font-weight:bold; letter-spacing:-px;}

.item_info_right{ float:right; text-align:left; margin-right:156px; overflow:hidden; }

.item_btn{ background: url('<?=$nfor[skin_path]?>img/btn_deal.png'); cursor: pointer;}

.btn_zzim{ display:inline-block; background-position:-0px -0px; width:84px;height:65px;}
.item_btn_cart{  display:inline-block;  background-position:-84px -0px; width:189px;height:65px;}
.item_btn_buy{  display:inline-block; background-position:-273px -0px; width:189px;height:65px;}

.btn_zzim:hover, .btn_zzim.on {  background-position:-0px -65px; width:84px;height:65px;}
.item_btn_cart:hover{ background-position:-84px -65px; width:189px;height:65px;}
.item_btn_buy:hover{  background-position:-273px -65px; width:189px;height:65px;}




.item_detail { display:block; width:1161px; margin-top:35px; margin:0 auto;
}
.item_detail_left { width:100%; }

.relation_tit { margin-left:10px; display:block; width:180px; height:50px; line-height:50px; text-align:center; background-color:#555555; color:#fff; font-family:apple sd gothic neo,malgun gothic,"맑은 고딕",nanumgothic,"나눔고딕",dotum,"돋움",sans-serif; font-size:15px; font-weight:bold; }
.relation_list { margin-left:10px; width:178px; border:solid 1px #ccc; padding-bottom:10px; }
.relation_list a { display:block; width:158px; text-align:left; margin:0 auto; }
.relation_list img { width:156px; border:solid 1px #ccc; margin-top:10px; margin-bottom:5px; }
.relation_list p {  }
.relation_list b { font-size:11px; letter-spacing:-1px; color:#059bff; }
.relation_list span { font-size:11px; letter-spacing:-1px; color:#999; font-family:'돋움',dotum,sans-serif; }



.tabmenu { width:1159px; height:50px; border-bottom:solid 1px #CCC; border-left:solid 1px #ccc;  }
.tabmenu li { float:left; padding:0px 20px; height:50px; line-height:50px; text-align:center; border-top:solid 1px #ccc; border-right:solid 1px #ccc; font-family:apple sd gothic neo,malgun gothic,"맑은 고딕",nanumgothic,"나눔고딕",dotum,"돋움",sans-serif; font-size:15px; font-weight:bold; background-color:#fff; border-bottom:solid 1px #ccc; }

.active a { color:#d32f2f }

.tab-cont { display:none; width:1159px; border-bottom:solid 1px #ccc; border-left:solid 1px #ccc; border-right:solid 1px #ccc; overflow:hidden; background-color:#fff; }

#tab1 { display:block; }



/* 상품대표이미지 */
#it_img_m { display:block; width:575px; height:575px; }

/* 상품기타이미지 */
.it_img_thumb { margin:0px; padding:0px; display:block; margin-top:20px; }
.it_img_thumb li{ margin:0px; padding:0px; display:inline; }
.it_img_s { width:50px; height:50px; cursor:pointer; border:solid 2px #eeeeee; }
.it_img_s_on{ border:solid 2px #d32f2f; }

</style>




<script type="text/javascript">
<!--
$(document).ready(function() {

	$(".tabmenu li").click(function(){
		$(".tabmenu li").removeClass("active");
		$(this).addClass("active");
		$(".tab-cont").hide();
		$($(this).find("a").attr("href")).show();
		return false;
	});

});

	$(function(){

		$(".it_img_s").click(function () {
			$(".it_img_s").removeClass("it_img_s_on");
			$(this).addClass("it_img_s_on");
			$("#it_img_m").attr("src",$(this).attr("src"));
		});

	})

//-->
</script>



<style>
.subpath { width: 1161px;   margin: 20px auto; position:relative; font-size:12px; line-height:18px;}
.subpath .inp { border:solid 1px #e6e6e6; color:#d32f2f; height:34px;}
.subpath img {  vertical-align:-3px;}
</style>

<div class="subpath">
<?
if(!$category_id){
	$category_id = $item[category_id1];
}

$category_id_sql1 = substr($category_id,0,3);
$category_id_sql2 = substr($category_id,0,6);
$category_id_sql3 = substr($category_id,0,9);
?>
<script type="text/javascript">
<!--
function category_change(val){
	location.href="item_list.php?category_id="+val;
}
//-->
</script>

	Home  <img src="<?=$nfor[skin_path]?>img/arrow.png">
	<select name="" class="inp" onchange="category_change(this.value)">
		<?
		$sql = "select * from nfor_item_category where wr_use='1' and wr_depth='0' order by wr_rank desc";
		$que = sql_query($sql);
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[category_id]?>" <?=$category_id_sql1==$data[category_id]?"selected":""?>><?=$data[wr_category]?>
		<? } ?>
	</select>  <img src="<?=$nfor[skin_path]?>img/arrow.png">

	<select name="" class="inp" onchange="category_change(this.value)">
		<?
		$sqlsql = substr($category_id_sql2,0,3);

		$sql = "select * from nfor_item_category where wr_use='1' and wr_depth='1' and category_id like '$sqlsql%' order by wr_rank desc";
		$que = sql_query($sql);
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[category_id]?>" <?=$category_id_sql2==$data[category_id]?"selected":""?>><?=$data[wr_category]?>
		<? } ?>
	</select>  <img src="<?=$nfor[skin_path]?>img/arrow.png">

	<select name="" class="inp" onchange="category_change(this.value)">
		<?
		$sqlsql = substr($category_id_sql3,0,6);

		$sql = "select * from nfor_item_category where wr_use='1' and wr_depth='2' and category_id like '$sqlsql%' order by wr_rank asc";
		$que = sql_query($sql);
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[category_id]?>" <?=$category_id_sql3==$data[category_id]?"selected":""?>><?=$data[wr_category]?>
		<? } ?>
	</select>

</div>



<div class="sub_container">
    <div class="sub_item_wrap">
        <div class="item_thum">



			<img id="it_img_m" src="<?=$item[it_img_m1]?"$nfor[path]/data/main/$item[it_img_m1]":"$nfor[path]/img/item_noimg.jpg"?>" style="margin:0 auto;">

			<!--<ul class="it_img_thumb">
			<?
			for($i=1; $i<=4; $i++){
				if($item["it_img_m".$i]){
			?>
			<li><img src="<?=$item["it_img_m".$i]?"$nfor[path]/data/main/".$item["it_img_m".$i]:"$nfor[path]/img/item_noimg.jpg"?>" class="it_img_s <?=$i==1?"it_img_s_on":""?>"></li>
			<?
				}
			}
			?>
			</ul>-->


        </div>
		<style>
		.item_info .del{ background-color:#ce1710; padding:3px; color:#fff; font-size:12px;}
		.item_info .itname{font-size:27px; line-height:30px; letter-spacing:-1px; color:#333;  display:block; margin-top:15px;}
		.item_info .itdes{font-size:14px; line-height:16px;  color:#999; display:block; margin-top:15px;}
		.item_info .itdisco{position:absolute;top:0px; display:block; font-size:45px; color:#d32f2f; line-height:45px; font-weight:bold;margin-top:0px;}
		.item_info .itdisco span { font-size:25px; color:#d32f2f; line-height:30px; font-weight:bold;margin-top:0px;}
		.item_info .price1{display:block; font-size:14px; color:#000; line-height:20px; font-weight:bold;margin-top:30px;text-decoration: line-through; margin-left:85px;}
		.item_info .price2{display:block; font-size:25px; color:#d32f2f; line-height:30px; font-weight:bold;margin-top:20px; }
		</style>
        <div class="item_info">
            <span class="del"><?=delivery_type($item)?></span>

			<span class="itname"><?=$item[it_name]?></span>
            <span class="itdes"><?=cut_str($item[it_description],100)?></span>

			<div style="position:relative;">
			<!--<span class="itdisco"><?=$item[it_discount_rate]?><span>%</span></span>
			 <span class="price1"><em><?=number_format($item[it_price1])?></em><span style="font-size:14px; color:#000; line-height:16px;">원</span></span>-->
			 <span class="price2"><?=number_format($item[it_price2])?><span style="font-size:14px; color:#000; line-height:16px;">원</span></span>
			</div>

			<b style="height:15px; width:100%; border-bottom:solid 1px #DCDCDC; display:block;"></b>



		<div style="overflow:hidden;">
				<div style="float:left;">

					<span style="margin-top:20px; display:block; margin-bottom:10px;"><b><?=number_format($item[it_sales_volume])?></b>개 구매</span>

				</div>
				<div style="float:right; padding-top:20px; ">




				<?
				$gap = strtotime($item[it_payenddate])-time();
				if($gap>0){
					sscanf(date('His',$gap-32400),'%2d%2d%2d',$h,$i,$s);
					$d = floor($gap/86400);

					?>

					<script type="text/javascript">
					$(function (){
						var austDay = new Date(<?=strtotime($item[it_payenddate])*1000?>);
						$('#countdown').countdown({until: austDay,  layout: "남은시간 :  <b class='color_txt'>{hnn}</b>시간 <b class='color_txt'>{mnn}</b>분 <b class='color_txt'>{snn}</b>초" });
					});
					</script>

					<div class="item_info_time" id='countdown'>남은시간 :  <b class='color_txt'><?=sprintf("%02d",$h)?></b>시간 <b class='color_txt'><?=sprintf("%02d",$i)?></b>분 <b class='color_txt'><?=sprintf("%02d",$s)?></b>초</div>


				<? } else{ ?>
					<div class="item_info_time">판매종료</div>
				<? } ?>




				</div>
		</div>






<!-- 옵션창 -->
<div>


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











</div>
<!-- //옵션창 -->


			<b style="height:15px; width:100%; border-bottom:solid 1px #DCDCDC; display:block;"></b>

			<div class="option_cal_total" style="<? if(!$item[it_opt_depth]) echo "display:block;"; ?>">
			<span style="display:block; font-size:30px; color:#d32f2f; line-height:40px; font-weight:bold;margin-top:30px;margin-bottom:30px;text-align:right;"><span style="font-size:14px; color:#000; line-height:16px;">총구매금액</span> <span class="option_cal_total_span"><?=number_format($item[it_price2])?></span><span style="font-size:14px; color:#000; line-height:16px;">원</span></span>
			</div>


			<div class="option_cart_order_btn <? if(!$item[it_opt_depth]) echo "on"; ?>" style="margin-top:20px;">
			<a class="item_btn btn_zzim" href="javascript:zzim('<?=$item[it_id]?>')"></a>
			<a class="item_btn item_btn_cart option_cart_btn"></a>
			<a class="item_btn item_btn_buy option_order_btn"></a>
			</div>

			<div>
			<?
			if($config[cf_naverpay_use]){
				//include_once "inc_naverpay.php";
			}
			?>
			</div>


        </div>
    </div>
    <div style="clear:both;"></div>
</div>







<!-- item_detail -->

<div class="item_detail">

    <ul class="tabmenu">
        <li class="active"><a href="#tab1">상품정보</a></li>
        <li><a href="#tab3">상품문의<?=$item[qna_cnt]?"(".number_format($item[qna_cnt]).")":""?> </a></li>
        <li><a href="#tab4">구매후기<?=$item[star_cnt]?"(".number_format($item[star_cnt]).")":""?></a></li>
    </ul>

    <div id="tab1" class="tab-cont">
        <?=$item[it_memo]?>
            <?=$item[it_payment]?>

    </div>
    <div id="tab2" class="tab-cont">
        <?=$item[it_rule]?>
    </div>
    <div id="tab3" class="tab-cont">
        <?
			include $nfor[skin_path]."inc_item_qna.php";
			?>
    </div>
    <div id="tab4" class="tab-cont">
        <?
			include $nfor[skin_path]."inc_item_star.php";
			?>
    </div>
	<br><br><br>
</div>
<!-- //item_detail -->








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
			<li><a href="javascript:sns_link('naver')"><i class="btn_cafe"></i>카페</a></li>
			<li><a href="javascript:sns_link('sms')"><i class="btn_sms"></i>SMS</a></li>
			<li><a href="javascript:sns_link('naverblog')"><i class="btn_blog"></i>블로그</a></li>
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
				location.href="cart.php";
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

$(document).on("click", ".item_btn_cart, .item_btn_buy", function(){ // 구매하기버튼클릭
	if(!it_opt_depth){ // 옵션사용을안하면
		$(".option_cal_total").show(); // 합산금액을보이고
		$(".option_cart_order_btn").addClass("on"); // 버튼활성화
	}
});









$(document).on("click", ".option_title", function(){



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
			//$(".wrap_option_box").hide();
			$(".wrap_"+$(this).attr('id')+"_box").show();
			$(".wrap_"+$(this).attr('id')+"_box").addClass("on"); // 현제옵션선택활성화

		}
	} else{ // 옵션목록값닫을때

		$(".option_scroll_all_wrap").addClass("option_scroll"); // 옵션창스크롤바추가

		$(".option_select_box").hide();
		$(".wrap_option_box").show(); // 옵션선택박스출력


		if($(".append_box").length){ // 옵션선택이있다면
			$('.option_cal_total').show(); // 합산금액출력
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
	var option_win = $(this).data('option_win');

	$(".option_scroll_all_wrap").addClass("option_scroll"); // 옵션창스크롤바추가

	if((depth==it_opt_depth || !basic) && !option_stock){ // 재고가 없으면
		return;
	}

	$(".option_select_box").hide();
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


<style>


.option_scroll {  overflow-y:auto; -webkit-overflow-scrolling:touch; }



.wrap_option_box { border:solid 1px #c9c9c9; border-bottom:none; margin-bottom:5px; width:100%; position:relative; box-sizing:border-box; -webkit-box-sizing:border-box; }
.wrap_option_box.on { border:solid 1px #dcd3d3; border-bottom:none; }
.wrap_option_box .option_title { box-sizing:border-box; -webkit-box-sizing:border-box; border-bottom:solid 1px #c9c9c9; width:100%; color:#111; font-size:14px; height:38px; line-height:38px; padding-left:10px; padding-right:20px; position:relative; cursor:pointer; }
.wrap_option_box.on .option_title { border-bottom:solid 1px #dcd3d3; cursor:pointer;  }
.wrap_option_box .option_title:after{ content:""; display:block; background:transparent url("<?=$nfor[skin_path]?>img/layoutm.png") no-repeat;background-position: -100px -400px; width:25px; height:25px; position:absolute; right:4px; top:7px;}
.wrap_option_box.on .option_title:after{ content:""; display:block; background:transparent url("<?=$nfor[skin_path]?>img/layoutm.png") no-repeat;  background-position: -100px -400px; width:25px; height:25px; position:absolute; right:4px; top:7px;}
.option_select_box { height:241px; display:none; overflow-y:scroll; -webkit-overflow-scrolling:touch; position:absolute; left:-1px; top:38px; z-index:88; background-color:#fff; width:100%; border:solid 1px #dcd3d3; }
.option_select_box li { border-bottom:solid 1px #e5e5e5; font-size:14px; padding:12px 10px 10px 10px; font-size:14px; cursor:pointer; }
.option_select_box li div { white-space:nowrap; overflow:hidden; }

.option_select_box li.on { background:url('<?=$nfor[skin_path]?>img/layoutm.png') no-repeat 100% -550px;  padding-right:40px; }


.option_soldout {  color:#888; }



.option_cal_total { display:none; }
.option_cal_total { margin:5px 0px; font-size:14px; }
.option_cal_total_span { color:#000; font-weight:bold; }
.append_count { display:inline-block; position:relative; width:117px; margin-top:7px; }
input.option_cnt { padding:0px; width:115px; height:29px; text-align:center; font-weight:bold; color:#111; border:solid 1px #c9c9c9; }
.count_plus { cursor:pointer; display:block; padding:0px; border:solid 1px #c9c9c9; width:33px; height:29px; position:absolute; right:0px; top:0px; background:url("<?=$nfor[skin_path]?>img/layoutm.png") no-repeat;  background-position: -0px -450px;  }
.count_minus {cursor:pointer; display:block; padding:0px; border:solid 1px #c9c9c9; width:33px; height:29px; position:absolute; left:0px; top:0px; background:url("<?=$nfor[skin_path]?>img/layoutm.png") no-repeat;  background-position: -50px -450px;  }
.append_option_name { color:#111; font-size:13px; }
.append_box { margin-top:-1px; position:relative; padding:10px; box-sizing:border-box; -webkit-box-sizing:border-box; width:100%; border:solid 1px #e5e5e5; background-color:#f4f4f4; }
.append_price { display:inline-block; vertical-align:middle; color:#d32f2f; font-size:16px; font-weight:bold; line-height:31px; height:31px; }
.count_del {  margin-left:7px; display:inline-block; vertical-align:middle; cursor:pointer; padding:0px; width:31px; height:31px; background:url("/skin/demo/img/count_del.png") no-repeat;  }
.append_price_del { display:inline-block; padding:0px; margin:0px; vertical-align:middle; height:31px; position:absolute; right:10px; bottom:10px;  }
.option_cal_list { padding-top:5px; }



.wrap_item_ico_table {  border-top:solid 1px #f4f4f4; border-bottom:solid 1px #d9d9d9; width:100%; height:50px; padding:10px 0px; }
.wrap_item_ico { display:table; margin:0 auto; }
.wrap_item_ico .item_ico { display:table-cell; text-align:center; width:80px; cursor:pointer; }
.gond_item { height:8px; background-color:#ebebeb; }



.btn_alarm { display:block; margin:0 auto; width:50px; height:26px; background:url(/skin/m_demo/img/item.png) no-repeat center -80px; background-size:26px auto; text-align:center; }
.btn_alarm.on { display:block; margin:0 auto; width:50px; height:26px; background:url(/skin/m_demo/img/item.png) no-repeat center -106px; background-size:26px auto; text-align:center; }
.btn_alarm span { display:block; padding-top:31px; font-size:12px; color:#999; }



.btn_sns { display:block; margin:0 auto; width:50px; height:26px; background:url('/skin/mm_demo/img/item.png') no-repeat center  -130px; background-size:26px auto; text-align:center; }
.btn_sns span { display:block; padding-top:31px; font-size:12px; color:#999; }
.btn_cal { display:block; margin:0 auto; width:50px; height:26px; background:url('/skin/mm_demo/img/item.png') no-repeat center -130px; background-size:26px auto; text-align:center; }
.btn_cal span { display:block; padding-top:31px; font-size:12px; color:#999; }
.wrap_item_info { padding:15px 15px;  position:relative;}
.wrap_item_info .it_name { font-size:17px; color:#333; display:block; width:100%; padding-bottom:5px; }
.wrap_item_info .it_description { font-size:12px; color:#999; display:block; width:100%;padding-bottom:5px;  }
.wrap_item_info .card_info { box-sizing:border-box; -webkit-box-sizing:border-box; height:25px; line-height:25px; font-size:12px; color:#ff7f00; letter-spacing:-1px; display:block; width:100%; position:relative; padding-left:20px; }
.wrap_item_info .delivery_type { box-sizing:border-box; -webkit-box-sizing:border-box; height:25px; line-height:25px; font-size:12px; color:#00aad0; letter-spacing:-1px; display:block; width:100%; position:relative; padding-left:20px; }

.it_price_wrap { width:100%; padding:10px 0px 8px 0px; box-sizing:border-box; -webkit-box-sizing:border-box; overflow:hidden; }
.it_price_wrap .it_discount_rate { float:left; display:block; height:24px; font-size:24px; line-height:24px; color:#ec3940; font-weight:normal; letter-spacing:-1px; margin-right:5px; }
.it_price_wrap .it_discount_rate b { font-size:17px; font-weight:normal;}
.it_price_wrap .it_price { float:left;  }
.it_price_wrap .it_price1 { font-size:12px; letter-spacing:-0.5px; color:#999; text-decoration:line-through;margin-right:4px; }
.it_price_wrap .it_price1 b { font-weight:normal; }
.it_price_wrap .it_price2 { font-size:20px; color:#111; font-weight:bold; letter-spacing:-1px;margin-right:4px; }
.it_price_wrap .it_price2 b { font-weight:normal; font-size:14px; vertical-align:middle; }
.it_price_wrap:after { content:""; display:block; clear:both; }
.sales_volume { position:absolute; right:0px; bottom:5px; font-size:12px;float:left; padding:0px 20px 15px;color:#999; }



.gond_item2 { border-top:solid 1px #d9d9d9; background:#f4f4f4; width:100%; height:10px; }
.gond_item3 { background:#ebebeb; height:8px; }



.other_item_list { padding:15px; border-top:solid 1px #f8f8f8; border-bottom:solid 1px #d9d9d9; }
.other_item_title { color:#555; font-size:14px; margin-bottom:10px;letter-spacing:-1px; }
.other_item_name { font-size:13px; line-height:18px;padding-top:5px; padding-bottom:2px; color:#444; letter-spacing:-1px; overflow:hidden; text-overflow:ellipsis; -webkit-line-clamp:1; display:-webkit-box; -webkit-box-orient:vertical; }
.other_item_price2 { font-size:15px; color:#ec1d28;  font-weight:normal;letter-spacing:-0.05em; }
.other_item_price1 { font-size:14px; font-weight:normal; }
.other_item_img { width:100%; border:solid 1px #F8F8F8; }



.item_wrap { width:100%; background-color:#fff; }
.it_img_wrap { width:100%; overflow:hidden; }
.it_img_wrap .it_img { width:100%; }


.card_info b { background:url("/skin/mm_demo/img/layout.png") no-repeat; background-size:320px auto; background-position: -0px -200px;  position:absolute; left:0px; top:-1px; width:25px; height:25px; }
.delivery_type b { background:url("/skin/mm_demo/img/layout.png") no-repeat; background-size:320px auto;  background-position: -50px -200px; position:absolute; left:0px; top:-1px; width:25px; height:25px; }






/* 장바구니담기 팝업 */
#cart_popup { position:fixed; left:0px; top:-280px; width:100%; z-index:99999; display:none; }
#cart_popup div { background-color:rgba(0,0,0,0.8); margin:0 auto; width:300px; text-align:center; padding:30px 0px; }
#cart_popup p { margin-bottom:10px; display:block; font-size:16px; color:#fff; font-weight:bold; }
#cart_popup a { background-color:#ec1d28; height:30px; line-height:30px; display:block; width:150px; color:#fff; margin:0 auto; }


/* 찜하기 팝업 */
#zzim_popup { display:none; z-index:9999; }
#zzim_popup .zzim_msg { position:fixed; left:50%; top:50%; width:150px; height:150px; margin-top:-95px; margin-left:-75px; z-index:9999; }
#zzim_popup .zzim_msg.on p {  background:url('/skin/mm_demo/img/zzim_on.png') no-repeat 50% 50%; background-size:150px auto; width:150px; height:150px; position:relative; overflow:hidden; text-indent:-999px; animation-name:zzim-animate; animation-duration:.5s; animation-fill-mode:both; }
#zzim_popup .zzim_msg.off p {  background:url('/skin/mm_demo/img/zzim_off.png') no-repeat 50% 50%; background-size:150px auto; width:150px; height:150px; position:relative; overflow:hidden; text-indent:-999px; animation-name:zzim-animate; animation-duration:.5s; animation-fill-mode:both; }
@-webkit-keyframes zzim-animate {
	from {-webkit-transform: scale3d(1, 1, 1);transform: scale3d(1, 1, 1);}
	50% {-webkit-transform: scale3d(1.05, 1.05, 1.05);transform: scale3d(1.05, 1.05, 1.05);}
	to {-webkit-transform: scale3d(1, 1, 1);transform: scale3d(1, 1, 1);}
}


/* 판매알림 팝업 */
#alarm_popup { display:none; z-index:9999; }
#alarm_popup .alarm_msg { position:fixed; left:50%; top:50%; width:150px; height:150px; margin-top:-95px; margin-left:-75px; z-index:9999; }
#alarm_popup .alarm_msg.on p {  background:url('/skin/mm_demo/img/alarm_on.png') no-repeat 50% 50%; background-size:150px auto; width:150px; height:150px; position:relative; overflow:hidden; text-indent:-999px; animation-name:alarm-animate; animation-duration:.5s; animation-fill-mode:both; }
#alarm_popup .alarm_msg.off p {  background:url('/skin/mm_demo/img/alarm_off.png') no-repeat 50% 50%; background-size:150px auto; width:150px; height:150px; position:relative; overflow:hidden; text-indent:-999px; animation-name:alarm-animate; animation-duration:.5s; animation-fill-mode:both; }
@-webkit-keyframes alarm-animate {
	from {-webkit-transform: scale3d(1, 1, 1);transform: scale3d(1, 1, 1);}
	50% {-webkit-transform: scale3d(1.05, 1.05, 1.05);transform: scale3d(1.05, 1.05, 1.05);}
	to {-webkit-transform: scale3d(1, 1, 1);transform: scale3d(1, 1, 1);}
}


/* 공유하기 팝업 */
#sns_popup { display:none; position:fixed; left:0px; top:0px; width:100%; height:1000px; background-color:rgba(0,0,0,0.5); z-index:9999; }
#sns_popup .sns_wrap { position:absolute; left:50%; margin-top:150px; width:290px; margin-left:-145px; background-color:#fff; }
#sns_popup .sns_title { position:relative; padding:18px 0 17px 0px; color:#333; font-size:16px; text-align:center; }
#sns_popup .sns_close_btn { cursor:pointer; position:absolute; width:14px; height:14px; right:20px; top:22px; background:url(/skin/mm_demo/img/layout.png) no-repeat; background-position: -100px -700px; background-size:320px auto; }
#sns_popup .sns_list { display:block; overflow:hidden; margin-bottom:20px; }
#sns_popup .sns_list li { float:left; width:25%; margin-bottom:10px; text-align:center; font-size:12px; color:#111; }
#sns_popup i { display:block; background:url(/skin/mm_demo/img/layout.png) no-repeat 0 0; background-size: 320px auto; width:46px; height:50px; margin:0 auto; }
#sns_popup .btn_kakaotalk {  background-position: -0px -650px;}
#sns_popup .btn_kakaostory { background-position: -50px -650px;}
#sns_popup .btn_twitter { background-position: -100px -650px;}
#sns_popup .btn_facebook { background-position: -150px -650px;}
#sns_popup .btn_cafe { background-position: -200px -650px;}
#sns_popup .btn_sms { background-position: -250px -650px;}
#sns_popup .btn_blog { background-position: -0px -700px;}
#sns_popup .btn_line { background-position: -50px -700px;}


</style>


<?php
include_once $nfor[skin_path]."tail.php";
?>
