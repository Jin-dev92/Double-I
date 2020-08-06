<?php
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub02/sub05.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<?php
include_once(G5_THEME_PATH.'/include/sub_main_head2.php');
?>

<style>
/*비오페이스*/
.sub_main {position:relative;width:100%;height:4893px;overflow:hidden; padding-top:50px; }
.sub_main .sub_main_img1 {position:relative; width:100%; height:100%; background:url('/theme/basic/sub02/img/sub_main_img5.jpg') no-repeat 50% 0;} 
.sub_main .sub_main_gif1 { position: absolute; width:100%; height: 300px; margin-top:-1830px; margin-left:-12px; text-align: center; }
</style>
<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">FILLER</li>
		</ul>
</div>
<div class="sub_main">
	<div class="sub_main_img1"></div>
	<!-- 주사기 gif{ -->
	<div class="sub_main_gif1">
		<img src="/theme/basic/sub02/img/sub_ssussu.gif" >
	</div>
	<!-- //주사기 gif{ -->
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>