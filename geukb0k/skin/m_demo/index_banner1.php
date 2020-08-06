<!-- 인덱스배너1 -->
<div class="swiper-container swiper-container-a">
	<div class="swiper-wrapper">
	<?
	$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='mobile_main' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc");
	while($banner=sql_fetch_array($que)){
	?>
		<div class="swiper-slide"><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt=""></a></div>
	<? } ?>
	</div>
	<div class="swiper-pagination-a"></div>
</div>

<style>
.swiper-container-a { /* margin:10px 10px; */ }
.swiper-container-a .swiper-slide img { width:100%; }
</style>
<!-- //인덱스배너1 -->