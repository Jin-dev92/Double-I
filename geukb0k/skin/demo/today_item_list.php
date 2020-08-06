<?php
include_once $nfor[skin_path]."head.php";
?>

<style>
.subVisual01 { position: relative; top:10px; width: 1161px; height: 250px;  margin: 0 auto 3px; overflow: hidden; background:url('<?=$nfor[skin_path]?>img/todayitem.png'); background-repeat:no-repeat; }
.subVisual01 .month {  position: absolute; font-size:35px; color:#ffffff; top:95px; left:52px;}
.subVisual01 .day {  position: absolute; font-size:35px; color:#ffffff; top:95px; left:127px;}
</style>

<!-- 2016.07.05 최원재 Today서브메인롤링 추가 start -->

<section class="spot_visual">
	<div class="main_visual">
		<div class="main_banner">
			<div class="banner_img"  id="">
				<ul class="bxslider">
					<?
					$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='sub_today_main' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc");
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

<!-- 2016.07.05 최원재 Today서브메인롤링 추가 end -->

<!-- 2016.07.12 김동준 위치 수정 start -->
<!--
<div class="subVisual01">
	<span class="month"><?=date("m")?></span>
	<span class="day"><?=date("d")?></span>
</div>
-->
<!-- 2016.07.12 김동준 위치 수 end -->
<!-- main_container -->
<div class="container">

	<!-- item_wrap -->
	<div class="item_wrap">

		<div class="item_list_wrap">		
			<?
			include $nfor[skin_path]."inc_index_list_item.php";
			?>
		</div>

	</div>
	<!-- //item_wrap -->


</div>
<!-- //main_container -->

<?
include_once $nfor[skin_path]."tail.php";
?>