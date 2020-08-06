<?php
include_once $nfor[skin_path]."head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).on("click", "#money_msg_btn", function(){
	if($("#money_msg_wrap").css('display')=="none"){
		$("#money_msg_wrap").show();
	} else{
		$("#money_msg_wrap").hide();	
	}
});
//-->
</SCRIPT>

<style>
.coupon_list_top_wrap { padding:20px 10px; }
.coupon_list_tab  { border-top:solid 1px #999999; border-left:solid 1px #999999; overflow:hidden; }
.coupon_list_tab li { margin:0px 0px 0px -2px; background-color:#fff; float:left; width:50%; border-bottom:solid 1px #999999; border-right:solid 1px #999999; border-left:solid 1px #999999; }
.coupon_list_tab li a{ display:block; height:36px; line-height:36px; text-align:center; font-size:14px; letter-spacing:-1px; text-decoration:none; color:#999999; }
.coupon_list_tab li.on { background-color:#999999; }
.coupon_list_tab li.on a { color:#fff; font-weight:bold; }

.coupon_list_wrap { padding:0px 10px; }
.coupon_list_wrap .msg_title_wrap { margin-top:10px; background-color:#fff; border:solid 1px #ddd; padding:10px 7px; background-color:#fefefe; position:relative; } 
.coupon_list_wrap .msg_title { font-size:12px; color:#666; letter-spacing:-1px; display:block; height:21px; line-height:21px; }
.coupon_list_wrap #money_msg_btn { cursor:pointer; border:solid 1px #ddd; font-size:11px; color:#555; letter-spacing:-1px; display:block; padding:2px 5px; position:absolute; right:10px; top:10px; }
.coupon_list_wrap #money_msg_wrap { display:none; padding:5px; background-color:#fff; border-bottom:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; }
.coupon_list_wrap #money_msg li { font-size:11px; color:#999; padding:2px 5px; }



.coupon_stat { overflow:hidden; border:solid 2px #ccc; background-color:#fff; }
.coupon_stat li { float:left; width:50%; height:60px; padding:10px; font-size:15px; color:#666; font-weight:bold; position:relative; box-sizing:border-box; -webkit-box-sizing:border-box; }
.coupon_stat li:first-child { border-right:solid 1px #ececec; margin-left:-1px; }
.coupon_stat span { position:absolute; right:10px; bottom:10px; color:#ec3940; font-size:14px; font-weight:normal; }


.coupon_list { background-color:#fff; margin:10px 0px; border-top:solid 1px #ccc; border-left:solid 1px #ccc; border-right:solid 1px #ccc; }
.coupon_list li { border-bottom:solid 1px #ececec; padding:15px 10px; font-size:13px; }
.coupon_list li:last-child { border-bottom:solid 1px #ccc; }

</style>



<div class="coupon_list_top_wrap">

	<ul class="coupon_list_tab">
		<li<?=basename($PHP_SELF)=="money_list.php"?" class='on'":""?>><a href="money_list.php">적립금</a></li>
		<li<?=basename($PHP_SELF)=="coupon_list.php"?" class='on'":""?>><a href="coupon_list.php">할인쿠폰</a></li>
	</ul>

</div>

<div class="coupon_list_wrap">




	<div class="msg_title_wrap">
		<span class="msg_title">할인쿠폰 이용시 주의사항</span>
		<a id="money_msg_btn">자세히 보기</a>
	</div>

	<div id="money_msg_wrap">

		<ul id="money_msg">
			<li>할인쿠폰에 따라 적용대상이 다를수 있으며 쿠폰 1개당 한개의 상품에서만 이용이 가능합니다.</li>
			<li>조건에 따라 유효기간이 다를수 있으며 유효기간이 만료된 쿠폰은 자동 소멸됩니다.</li>
		</ul>

	</div>

<?



?>

	<ul class="coupon_list">
	<?
	$result = sql_query("select * from nfor_coupon where cp_sdate<='$nfor[ymdhis]' and cp_edate>='$nfor[ymdhis]' and (cp_all='1' or cp_mb_no='$member[mb_no]')");
	for ($i=0; $row=sql_fetch_array($result); $i++) {

		if($row[cp_type]=="1"){
			$it_name = sql_fetch("select it_name from nfor_item where it_id='$row[cp_it_id]'");
			$txt = $it_name[it_name];
		} elseif($row[cp_type]=="2"){
			$wr_category = sql_fetch("select wr_category from nfor_item_category where category_id='$row[cp_category_id]'");
			$txt = $wr_category[wr_category];
		} else{
			$txt = "";
		}
	?>
	<li>
		<b><?=$row[cp_name]?></b>

		<p>
		<?=$txt?> 구매시 <?
		if($row[cp_pay_type]=="1"){
			echo number_format($row[cp_coupon_price])."원";	
		} else{
			echo number_format($row[cp_coupon_per])."%";	
		}
		?> 할인</p>
		
	</li>
	<? } ?>
	</ul>







</div>

<?
include_once $nfor[skin_path]."tail.php";
?>