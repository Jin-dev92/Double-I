<?php
include_once $nfor[skin_path]."head.php";
?>
<style> .subpath
.subpath { width: 1161px;   margin: 20px auto; position:relative; font-size:12px; line-height:18px;}
.subpath .inp { border:solid 1px #e6e6e6; color:#2b68a7; height:34px;}
.subpath img {  vertical-align:-3px;}


.sub_category { width: 1161px;  margin: 20px auto; overflow: hidden; }
.sub_category ul { width: 1161px;; text-align:center; }
.sub_category li { float:left;  width:143.714px; padding:0px 10px; background-color:#FFFFFF; border:solid 1px #ECECEC;}
/*12-09추가*/
.main_visual .main_banner .bx-controls-direction > a{display: none;position: absolute;top: 0;bottom: 0;width:60px;height:60px;margin: auto;z-index: 1;text-indent:-9999px;overflow: hidden;}
.bx-pager-item {display:none;}
/*12-09추가*/
.sub_category li.on, .sub_category li:hover{ float:left;  width:143.714px; padding:0px 10px; background-color:#FAFAFA; border:solid 1px #2b68a7; color:#2b68a7;}
.sub_category li a{ width:100%; display:block; line-height:45px;}
.sub_category li.on a,  .sub_category li a:hover{ color:#2b68a7;}



.sub_title {font-size:21px; width: 1161px;  margin: 20px auto; }
.sub_title span{font-size:21px; color:#2b68a7;}

</style>

<script type="text/javascript">
<!--
function category_change(val){
	location.href="item_list.php?category_id="+val;
}
//-->
</script>
<!-- 2016.07.04 최원재 수정  start -->

<!--<?
$category_id_sql = substr($category_id,0,3);
?>
<div class="subpath">
	Home  <img src="<?=$nfor[skin_path]?>img/arrow.png">
	<select name="" class="inp" onchange="category_change(this.value)">
		<?
		$sql = "select * from nfor_item_category where wr_use='1' and wr_depth='0' order by wr_rank desc";
		$que = sql_query($sql);
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[category_id]?>" <?=$category_id_sql==$data[category_id]?"selected":""?>><?=$data[wr_category]?>
		<? } ?>
	</select>
</div>
 -->



<!--<div class="sub_title">
	<span><?=$nfor[title]?></span>상품
</div>-->
<!-- 2016.07.04 최원재 수정  end -->

<!-- 2016.07.05 최원재 slider 추가 start-->
<?php
if($category_id == "001"){
?>
<section class="spot_visual">
	<div class="main_visual">
		<div class="main_banner">
			<div class="banner_img"  id="">
				<ul class="bxslider">
					<?
					$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='sub_main1' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc");
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
<?php
} else if($category_id == "002") {
?>
<section class="spot_visual">
	<div class="main_visual">
		<div class="main_banner">
			<div class="banner_img"  id="">
				<ul class="bxslider">
					<?
					$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='sub_main2' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc");
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
<?php
} else if($category_id == "003") {
?>
<section class="spot_visual">
	<div class="main_visual">
		<div class="main_banner">
			<div class="banner_img"  id="">
				<ul class="bxslider">
					<?
					$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='sub_main3' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc");
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
<?php
} else if($category_id == "004") {
?>
<section class="spot_visual">
	<div class="main_visual">
		<div class="main_banner">
			<div class="banner_img"  id="">
				<ul class="bxslider">
					<?
					$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='sub_main5' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc");
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
<?php
} else if( $category_id == "004465" || $category_id == "004466" || $category_id == "004467" || $category_id == "004468" || $category_id == "004469" || $category_id == "004470" || $category_id == "004471" )  {
?>
<section class="spot_visual">
	<div class="main_visual">
		<div class="main_banner">
			<div class="banner_img"  id="">
				<ul class="bxslider">
					<?
					$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='sub_main6' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc");
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
<?php
}
?>
<script type="text/javascript">
<!--
$('.bxslider').bxSlider({
	auto: false,
	mode:'fade',
	pause:4000
});
//-->
</script>
<!-- 2016.07.05 최원재 slider 추가 end-->
<?
$que = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='1' and category_id like '$category_id_sql%' order by wr_rank desc");
if(sql_num_rows($que)){
?>
<div  class="sub_category">
	<ul>
		<li <? if(strlen($category_id)=="3"){ ?>class="on"<? } ?>><a href="item_list.php?category_id=<?=$category_id_sql?>">전체보기</a></li>
		<?
		while($data = sql_fetch_array($que)){
		?>
		<li <? if($data[category_id]==$category_id){ ?>class="on"<? } ?>><a href="item_list.php?category_id=<?=$data[category_id]?>"><?=$data[wr_category]?></a></li>
		<? } ?>
	</ul>
</div>
<? } ?>

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
