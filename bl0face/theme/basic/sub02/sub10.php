<?php
define('_INDEX_', true);
include_once('./_common.php');
if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/sub02/sub10.php');
    return;
}
include_once(G5_THEME_PATH.'/include/sub_head.php');
?>
<?php
include_once(G5_THEME_PATH.'/include/sub_main_head2.php');
?>

<style>
/*�������̽�*/
.sub_main {position:relative;width:100%; height: 3907px; padding-top:50px; }
.sub_main .sub_main_img1 {position:relative; margin: 0 auto;}
.sub1_link{position: absolute;width: 390px;height: 70px; top:1350px; left:206px; background: #eee;}
.sub2_link{position: absolute;width: 390px;height: 70px; top:1350px; left:750px; background: #eee;}
.sub3_link{position: absolute;width: 390px;height: 70px; top:1910px; left:206px; background: #eee;}
.sub4_link{position: absolute;width: 390px;height: 70px; top:1910px; left:750px; background: #eee;}
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
	<img src="/theme/basic/sub02/img/sub_main_img10.jpg" class="sub_main_img1" alt="" usemap="#match">
  <map name="match" >
  <area  alt="" title="" href="/theme/basic/sub02/sub04.php" shape="rect" coords="491,1299,881,1366" style="outline:none;" target="_self"     />
<area  alt="" title="" href="/theme/basic/sub02/sub03.php" shape="rect" coords="1035,1300,1425,1367" style="outline:none;" target="_self"     />
<area  alt="" title="" href="/theme/basic/sub02/sub01.php" shape="rect" coords="491,1862,881,1929" style="outline:none;" target="_self"     />
<area  alt="" title="" href="/theme/basic/sub02/sub02.php" shape="rect" coords="1036,1861,1426,1928" style="outline:none;" target="_self"     />

  </div>

</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
