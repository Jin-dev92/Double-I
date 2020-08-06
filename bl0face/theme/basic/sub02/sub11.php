<?php
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub02/sub11.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<?php
include_once(G5_THEME_PATH.'/include/sub_main_head2.php');
?>

<style>
/*�������̽�*/
.sub_main {position:relative;width:100%; height: 4225px; padding-top:50px; }
.sub_main .sub_main_img1 {position:relative; margin: 0 auto;}

</style>
<script>
  $(function(){
    var mains = $(".sub_main").css("width");
    var mainw = parseInt(mains);

    if(1920>mainw){
      var vals = 1920-mainw;
      $(".sub_main").css("left",(vals/2)*-1);
    }

  })
</script>
<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><a href="http://www.bioface.kr"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</a></li>
			<span>-</span>
			<li class="sub_li02">FILLER</li>
		</ul>
</div>
<div class="sub_main">
	<img src="/theme/basic/sub02/img/sub_main_img11.jpg" class="sub_main_img1" alt="" usemap="#match">
  <map name="match" >
    <area  alt="" title="" href="/theme/basic/sub02/sub09.php" shape="rect" coords="558,1386,750,1442" style="outline:none;" target="_self"     />
<area  alt="" title="" href="/theme/basic/sub02/sub05.php" shape="rect" coords="1173,1385,1366,1443" style="outline:none;" target="_self"     />
<area  alt="" title="" href="/theme/basic/sub02/sub06.php" shape="rect" coords="859,1903,1052,1961" style="outline:none;" target="_self"     />

  </div>

</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
