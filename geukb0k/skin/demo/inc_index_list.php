<!-- main_container -->
<div class="main_container">
	<!-- item_wrap -->
	<div class="item_wrap">
		<!-- 추천상품노출-->
		<div class="item_list_wrap" style="display: none;">
			<p class="item_recommend_title" style="#1f1f1f"><b style="color:#2b68a7; font-size:25px;    text-decoration: underline;">NEW</b> Product IteM</p>
			<?
			$result = sql_query(" select * from nfor_item where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' and it_new>0 order by it_new desc");
			include $nfor[skin_path]."inc_index_list_item.php";
			?>
		</div>
		<!-- 추천상품노출-- -->

		<div class="mainbanner" style="display: none;">
			<?
			$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='main_banner' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc");
			while($banner=sql_fetch_array($que)){
			?>
			<img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt=""></li>
			<? } ?>
		</div>

		<!-- 전체상품노출-->
		<div class="item_list_wrap" style="margin-top: 30px;">
			<p class="item_recommend_title" style="color:#1f1f1f"><b style="color:#2b68a7;font-size:25px;    text-decoration: underline;">BEST</b> Weekly IteM</p>
			<?
			$result = sql_query(" select * from nfor_item where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' and it_hit>0 order by it_hit desc");
			include $nfor[skin_path]."inc_index_list_item.php";
			?>
		</div>
		<!-- 전체상품노출-- -->

		<!-- 추천상품노출-->
		<div class="item_list_wrap" style="display: none;">
			<p class="item_recommend_title" style="color:#1f1f1f"><b style="color:#2b68a7;font-size:25px;    text-decoration: underline;">RE</b>commend IteM <b style="color:rgba(105, 103, 103, 0.85)"></b></p>
			<?
			$result = sql_query(" select * from nfor_item where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' and it_good>0 order by it_good desc");
			include $nfor[skin_path]."inc_index_list_item.php";
			?>
		</div>
		<!-- 추천상품노출-- -->

		<!-- //item_wrap -->
	</div>
	<!-- //item_wrap -->
</div>
<!-- //main_container -->
