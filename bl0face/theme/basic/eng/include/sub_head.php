<?
include_once(G5_THEME_PATH.'/eng/head.sub.php');
?>
<script>
$(document).ready(function(){
		$('#main_all').click(function() { 
			$('#main_all').hide(); 
		});
});
</script>
<div class="super_main">
	<div id="main" >
		<div id="main_wrapper">
			<div id="logo">
				<a href="<?php echo G5_URL ?>"><img src="/theme/basic/img/main/header_logo.png" alt="비오페이스"></a>
			</div>
			<div id="nara">
				<img src="/theme/basic/img/main/nara.png" usemap="#nara_go">
				<map name="nara_go">
					<area shape="rect" coords="0,0,28,28" href="<?php echo G5_URL ?>"/>
					<area shape="rect" coords="38,0,66,28" href="<?php echo G5_URL ?>/theme/basic/chn"/>
					<area shape="rect" coords="76,0,104,28" href="<?php echo G5_URL ?>/theme/basic/eng"/>
				</map>
			</div>

			<ul id="tnb">
				<?php if ($is_admin) {  ?>
				<li><a href="<?php echo G5_ADMIN_URL ?>"><b>ADMIN</b></a></li>
				<?php }  ?>
				<li><a href="#" onclick="mainmenu(); return false;"><b>BIOFACE STORY</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>FILLER</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>LIFTING</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>SKIN</b></a></li>
				<li><a href="#" onclick="mainmenu(); return false;"><b>ETC</b></a></li>
			</ul>
		</div>
	</div>
	<div id="main_all">
		<div id="main_allmenu">
			<div id="allmenu">
				<img src="/theme/basic/img/main/allmenu.png" alt="전체메뉴">
			</div>
			<div id="allmenu_cate">
				<ul id="cate1">
					<li id="title"><b>BIOFACE STORY</b></li>
					<li id="first"><a href="/theme/basic/eng/sub01/sub01.php">DID YOU HAVE FILLER?</a></li>
					<li><a href="/theme/basic/eng/sub01/sub02.php">FILLER HISTROY</a></li>
					<li><a href="/theme/basic/eng/sub01/sub03.php">BIOFACE INTRODUCE</a></li>
					<li><a href="/bbs/board.php?bo_table=filler_review_eng">HEAD DOCTOR FILLER REVIEW</a></li>
					<li><a href="/bbs/board.php?bo_table=notice_eng">BIOFACE NOTICE</a></li>
					<li><a href="/bbs/board.php?bo_table=online_eng">BIOFACE ONLINE CONSULT</a></li>
					<li><a href="/bbs/board.php?bo_table=event_eng">BIOFACE EVENT</a></li>
					<li><a href="/bbs/board.php?bo_table=qna_eng">Q & A</a></li>
					<li><a href="/bbs/board.php?bo_table=star_eng">BIOFACE STAR</a></li>
				</ul>
				<ul id="cate2">
					<li id="title"><b>FILLER</b></li>
					<li id="first"><a href="/theme/basic/eng/sub02/sub01.php">PELVIS FILLER</a></li>
					<li><a href="/theme/basic/eng/sub02/sub02.php">LEG FILLER</a></li>
					<li><a href="/theme/basic/eng/sub02/sub03.php">HIP-UP FILLER</a></li>
					<li><a href="/theme/basic/eng/sub02/sub04.php">BREAST FILLER</a></li>
					<li><a href="/theme/basic/eng/sub02/sub05.php">PURE QOFILL</a></li>
					<li><a href="/theme/basic/eng/sub02/sub06.php">QOFILL</a></li>
					<li><a href="/theme/basic/eng/sub02/sub07.php">QOGEL</a></li>
					<li><a href="/theme/basic/eng/sub02/sub08.php">GLAMFILL</a></li>
					<li><a href="/theme/basic/eng/sub02/sub09.php">FASTIDIOUS INJECTION</a></li>
				</ul>
				<ul id="cate3">
					<li id="title"><b>LIFTING</b></li>
					<li id="first"><a href="/theme/basic/eng/sub03/sub01.php">PARTIAL LIFTING</a></li>
					<li><a href="/theme/basic/eng/sub03/sub02.php">NEW-THERA LIFTING</a></li>
					<li><a href="/theme/basic/eng/sub03/sub03.php">THREAD LIFTING(PDO)</a></li>
					<li><a href="/theme/basic/eng/sub03/sub04.php">SPIDER LIFTING</a></li>
				</ul>
				<ul id="cate4">
					<li id="title"><b>SKIN</b></li>
					<li id="first"><a href="/theme/basic/eng/sub04/sub01.php">ESSENCE INJECTION</a></li>
					<li><a href="/theme/basic/eng/sub04/sub02.php">REBUILD SKIN SCAR</a></li>
					<li><a href="/theme/basic/eng/sub04/sub03.php">MISTY FILL</a></li>
					<li><a href="/theme/basic/eng/sub04/sub04.php">WITCH's MAGIC SHOT</a></li>
					<li><a href="/theme/basic/eng/sub04/sub05.php">MAKE-UP PEEL</a></li>
					<li><a href="/theme/basic/eng/sub04/sub06.php">ANTI-AGING LASER</a></li>
					<li><a href="/theme/basic/eng/sub04/sub07.php">HYDRO-TONING</a></li>
					<li><a href="/theme/basic/eng/sub04/sub08.php">REMOVE BLEMISH</a></li>
					<li><a href="/theme/basic/eng/sub04/sub09.php">PIMPLE</a></li>
					<li><a href="/theme/basic/eng/sub04/sub10.php">AGAS IO PEEL</a></li>
					<li><a href="/theme/basic/eng/sub04/sub11.php">AQUA PEEL</a></li>
				</ul>
				<ul id="cate5">
					<li id="title"><b>ETC</b></li>
					<li id="first"><a href="/theme/basic/eng/sub05/sub01.php">POWER-UP OUTLINE INJECTION</a></li>
					<li><a href="/theme/basic/eng/sub05/sub02.php">ZERO-KING DIET</a></li>
					<li><a href="/theme/basic/eng/sub05/sub03.php">3-WAY DIET</a></li>
					<li><a href="/theme/basic/eng/sub05/sub04.php">LIPOSONIX</a></li>
					<li><a href="/theme/basic/eng/sub05/sub05.php">DOUBLE-SKINNY</a></li>
					<li><a href="/theme/basic/eng/sub05/sub06.php">RELAX F TENOR</a></li>
					<li><a href="/theme/basic/eng/sub05/sub07.php">COOL-SHAPING</a></li>
					<li><a href="/theme/basic/eng/sub05/sub08.php">NOSE THREAD LIFTING</a></li>
					<li><a href="/theme/basic/eng/sub05/sub09.php">EYE THREAD LIFTING</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
function mainmenu(){
	if($("#main_all").css("display") == "none"){
		$("#main_all").show();
	} else {
		$("#main_all").hide();
	}
}
$( document ).ready( function() {
	var jbOffset = $( '.super_main' ).offset();
	$( window ).scroll( function() {
		if ( $( document ).scrollTop() > jbOffset.top ) {
			$( '.super_main' ).addClass( 'smFixed' );
		} else {
			$( '.super_main' ).removeClass( 'smFixed' );
		}
	});
} );
</script>