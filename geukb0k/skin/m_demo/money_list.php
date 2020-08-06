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
</style>



<div class="coupon_list_top_wrap">

	<ul class="coupon_list_tab">
		<li<?=basename($PHP_SELF)=="money_list.php"?" class='on'":""?>><a href="money_list.php">적립금</a></li>
		<li<?=basename($PHP_SELF)=="coupon_list.php"?" class='on'":""?>><a href="coupon_list.php">할인쿠폰</a></li>
	</ul>

</div>

<div class="money_list_wrap">

	<dl class="money_top_wrap">
		<dt>사용가능 적립금</dt>
		<dd><?=number_format(mb_money($member[mb_no]))?>원</dd>
		<dt>소멸예정 적립금 <span class="expire_msg">1개월내</span></dt>
		<dd><?=number_format(expire_mb_money($member[mb_no]))?>원</dd>
	</dl>

	<div class="msg_title_wrap">
		<span class="msg_title">적립금 이용시 주의사항</span>
		<a id="money_msg_btn">자세히 보기</a>
	</div>

	<div id="money_msg_wrap">

		<ul id="money_msg">
			<li>적립금은 모든 상품 구매 시 현금처럼 사용할 수 있습니다.</li>
			<li>적립금은 조건에 따라 유효기간이 다를수 있으며 유효기간이 만료된 적립금은 자동 소멸됩니다.</li>
			<li>적립금 사용시 유효기간이 만료일에 가까운 적립금부터 우선 차감 됩니다.</li>
		</ul>

	</div>
	
	<ul class="money_list">
		<?
		for ($i=0; $row=sql_fetch_array($result); $i++) {
		?>
		<li>
			
			<div class="money_li_title">
				<p class="wr_date"><?=date("Y.m.d",strtotime($row[wr_datetime]))?></p>
				<p class="end_datetime"><? if($row[money]>0){ ?>유효기간 : <?=date("Y.m.d",strtotime($row[end_datetime]))?><? } else{ ?> <?=money_type($row[money_type])?> <? } ?></p>
			</div>
			<div class="money_li_memo">
				<p class="subject"><?=$row[od_id]?it_name($row[od_id],$row[ct_id]):""?></p>
				<p class="memo"><?=$row[memo]?></p>				
				<span class="money <?=$row[money]<0?"minus":"plus"?>"><?=number_format($row[money])?>원</span>
			</div>
				
		</li>
		<?
		}
		$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?page=");
		?>
	</ul>
	<div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div>

</div>

<style>
.money_list_wrap { padding:0px 10px; }

.money_top_wrap {  border-top:solid 2px #ddd; border-bottom:solid 1px #ddd;  border-left:solid 2px #ddd;  border-right:solid 2px #ddd; overflow:hidden; background-color:#fff; }


.money_top_wrap .expire_msg { color:#999; font-size:10px; line-height:15px; font-weight:normal; }

.money_top_wrap dt { font-weight:bold; font-size:15px; color:#666; text-align:left; width:50%; float:left; height:40px; line-height:40px; padding-left:10px; border-bottom:solid 1px #ddd; box-sizing:border-box; }
.money_top_wrap dd { font-size:15px; color:#ec3940; text-align:right; width:50%; float:left; height:40px; line-height:40px; padding-right:10px; border-bottom:solid 1px #ddd; box-sizing:border-box;  }
.money_list_wrap .msg_title_wrap { margin-top:10px; background-color:#fff; border:solid 1px #ddd; padding:10px 7px; background-color:#fefefe; position:relative; } 
.money_list_wrap .msg_title { font-size:12px; color:#666; letter-spacing:-1px; display:block; height:21px; line-height:21px; }
.money_list_wrap #money_msg_btn { cursor:pointer; border:solid 1px #ddd; font-size:11px; color:#555; letter-spacing:-1px; display:block; padding:2px 5px; position:absolute; right:10px; top:10px; }
.money_list_wrap #money_msg_wrap { display:none; padding:5px; background-color:#fff; border-bottom:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; }
.money_list_wrap #money_msg li { font-size:11px; color:#999; padding:2px 5px; }

.money_list { margin-top:10px; background-color:#fff; border-top:solid 1px #ddd; border-left:solid 1px #ddd; border-right:solid 1px #ddd; }

.money_list .money_li_title { position:relative; background-color:#eee; padding:5px 10px; } 
.money_list .money_li_memo { padding:15px 10px; } 



.money_list li{ position:relative; background-color:#fff; border-bottom:solid 1px #ddd;  }
.money_list .wr_date { font-size:11px; color:#888; line-height:15px; }
.money_list .subject { color:#333; font-size:14px; }
.money_list .memo { color:#999; max-width:90%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; letter-spacing:-1px;  font-size:14px;line-height:18px; }
.money_list .money { font-size:14px; position:absolute; right:10px; bottom:10px; }
.money_list .money.plus { color:#333; }
.money_list .money.minus { color:#ec3940; }
.money_list .end_datetime {  position:absolute; right:10px; top:5px; font-size:11px; color:#888; }
</style>


<?
include_once $nfor[skin_path]."tail.php";
?>