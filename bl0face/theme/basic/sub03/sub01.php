<?php
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub03/sub01.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<?php
include_once(G5_THEME_PATH.'/include/sub_main_head3.php');
?>

<style>
/*�������̽�*/
.sub_main {position:relative;width:100%;height:6748px; padding-top:50px; }
.sub_main .sub_main_img1 {position:relative;}
</style>
<script>
  $(function(){
    var mains = $(".sub_main").css("width");
    var mainw = parseInt(mains);

    if(1920>mainw){
      var vals = 1920-mainw;
      $(".sub_main img").css("margin-left",(vals/2)*-1);
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
<style media="screen">
  .youtube{position: absolute;left: 50%; margin-left: -430px;top: 1180px;}

</style>
<div class="sub_main">
	<img src="/theme/basic/sub03/img/sub_main_img1.jpg" class="sub_main_img1" alt="">

    <iframe width="860" class="youtube" height="500" src="https://www.youtube.com/embed/c88yQyqdfZY" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>


  <img src="/theme/basic/sub03/img/sub_main_img1_2.jpg" class="sub_main_img2" alt="" usemap="#match" style="margin-top:510px;">
  <map name="match" >
    <area  alt="" title="" href="/theme/basic/sub03/sub02.php" shape="rect" coords="864,386,1055,445" style="outline:none;" target="_self"     />
<area  alt="" title="" href="/theme/basic/sub03/sub03.php" shape="rect" coords="866,1013,1055,1072" style="outline:none;" target="_self"     />

  </div>

</div>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
