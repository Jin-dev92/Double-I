<?php
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub04/sub08.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<?php
include_once(G5_THEME_PATH.'/include/sub_main_head4.php');
?>

<style>
/*������̽�*/
.sub_main {position:relative;width:100%;height:1527px;overflow:hidden; padding-top:50px; }
.sub_main .sub_main_img1 {position:relative; width:100%; height:100%; background:url('/theme/basic/sub04/img/sub_main_img8.jpg') no-repeat 50% 0;} 
.sub_main .sub_main_gif1 { position: absolute; width:100%; height: 300px; margin-top:-1700px; text-align: center; }
</style>
<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">SKIN</li>
		</ul>
</div>
<div class="sub_main">
	<div class="sub_main_img1"></div>
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>