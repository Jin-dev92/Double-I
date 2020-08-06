<?php
include_once $nfor[skin_path]."head.php";
?>

<style>
.subVisual01 { position: relative; top:10px; width: 1338px; height: 592px;  margin: 0 auto 3px; overflow: hidden; }

</style>

<div class="subVisual01">
<img src="<?="$nfor[path]/data/plan/$plan[wr_img]"?>" alt="">
</div>

<!-- main_container -->
<div class="container">

	<!-- item_wrap -->
	<div class="item_wrap">

		<div class="item_list_wrap">		
			<?
			include $nfor[skin_path]."inc_index_list_item2.php";
			?>
		</div>

	</div>
	<!-- //item_wrap -->

	<!-- rightbanner -->
	<?
	include_once $nfor[skin_path]."inc_right_banner.php";
	?>
	<!-- //rightbanner -->


</div>
<!-- //main_container -->

<?
include_once $nfor[skin_path]."tail.php";
?>