<?php
include_once $nfor[skin_path]."head.php";
?>
<style>
.subpath { width: 100%;   margin: 20px auto; position:relative; font-size:18px; line-height:18px;}
.subpath .inp { border:solid 1px #e6e6e6; color:#d32f2f; height:34px;}
.subpath img {  vertical-align:-3px;}


.sub_category { width: 100%;  margin: 20px auto; overflow: hidden; }
.sub_category ul { width: 100%;  }
.sub_category li { float:left;  width:171px; padding:0px 10px; background-color:#FFFFFF; border:solid 1px #ECECEC;}
.sub_category li.on, .sub_category li:hover{ float:left;  width:171px; padding:0px 10px; background-color:#d32f2f; border:solid 1px #d32f2f; color:#FFFFFF;}
.sub_category li a{ width:100%; display:block; line-height:45px;}
.sub_category li.on a,  .sub_category li a:hover{ color:#FFFFFF;}


 
.sub_title {font-size:21px; width: 1161px;  margin: 20px auto; }
.sub_title span{font-size:21px; color:#d32f2f;}
 
</style>

<script type="text/javascript">
<!--
function category_change(val){
	location.href="item_list.php?category_id="+val;
}
//-->
</script>

<div class="sub_title">
	<span><?=$nfor[title]?></span>상품
</div>

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