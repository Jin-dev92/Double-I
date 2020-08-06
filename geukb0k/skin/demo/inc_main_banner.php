
<section class="spot_visual">
	<div class="main_visual">
		<div class="main_banner">
			<div class="banner_img"  id="">
				<ul class="bxslider">
					<?
					$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='pc_main' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc");
					while($banner=sql_fetch_array($que)){	
					?>
					<li><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt=""></a></li>
					<? } ?>
				</ul>
			</div><!--banner_img-->
			<!-- 메인 상단 배너 끝 -->
		</div><!--main_banner-->
	</div><!--main_visul-->
</section> <!-- spot_visual -->

<script type="text/javascript">
<!--
$('.bxslider').bxSlider({
	auto: true,
	mode:'fade',
	pause:4000
});
//-->
</script>


