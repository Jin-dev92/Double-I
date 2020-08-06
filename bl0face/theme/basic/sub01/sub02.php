<?php
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub01/sub02.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<style>
#sub_mainImg {position:relative;width:100%;height:9643px;overflow:hidden;}
#sub_mainImg .sb_img {position:relative;width:100%;height:100%;margin-top: 50px;background:url('/theme/basic/sub01/img/sub02.jpg') no-repeat 50% 0;}
</style>

<?php
include_once(G5_THEME_PATH.'/include/sub_main_head1.php');
?>

<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">BIOFACE STORY</li>
		</ul>
</div>

<div id="sub_mainImg">
	<div class="sb_img"></div>
</div>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
