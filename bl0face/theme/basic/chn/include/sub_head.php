<?
include_once(G5_THEME_PATH.'/chn/head.sub.php');
?>

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
				<li id="first"><a href="/theme/basic/chn/sub01/sub01.php">你曾经做过玻尿酸吗?</a></li>
				<li><a href="/theme/basic/chn/sub01/sub02.php">填充剂的历史</a></li>
				<li><a href="/theme/basic/chn/sub01/sub03.php">BIOFACE 介绍</a></li>
				<li><a href="/bbs/board.php?bo_table=filler_review_chn">院长玻尿酸诊断</a></li>
				<li><a href="/bbs/board.php?bo_table=notice_chn">BIOFACE NOTICE</a></li>
				<li><a href="/bbs/board.php?bo_table=online_chn">BIOFACE ONLINE CONSULT</a></li>
				<li><a href="/bbs/board.php?bo_table=event_chn">BIOFACE EVENT</a></li>
				<li><a href="/bbs/board.php?bo_table=qna_chn">问答</a></li>
				<li><a href="/bbs/board.php?bo_table=star_chn">BIOFACE 明星</a></li>
			</ul>
			<ul id="cate2">
				<li id="title"><b>FILLER</b></li>
				<li id="first"><a href="/theme/basic/chn/sub02/sub01.php">骨盆玻尿酸</a></li>
				<li><a href="/theme/basic/chn/sub02/sub02.php">双腿玻尿酸</a></li>
				<li><a href="/theme/basic/chn/sub02/sub03.php">臀部玻尿酸</a></li>
				<li><a href="/theme/basic/chn/sub02/sub04.php">隆胸玻尿酸</a></li>
				<li><a href="/theme/basic/chn/sub02/sub05.php">纯净QOFILL</a></li>
				<li><a href="/theme/basic/chn/sub02/sub06.php">QOFILL</a></li>
				<li><a href="/theme/basic/chn/sub02/sub07.php">QOGEL</a></li>
				<li><a href="/theme/basic/chn/sub02/sub08.php">GLAMFILL</a></li>
				<li><a href="/theme/basic/chn/sub02/sub09.php">灵通的注射室</a></li>
			</ul>
			<ul id="cate3">
				<li id="title"><b>LIFTING</b></li>
				<li id="first"><a href="/theme/basic/chn/sub03/sub01.php">分部位 提升术</a></li>
				<li><a href="/theme/basic/chn/sub03/sub02.php">NEW-THERA 提升术</a></li>
				<li><a href="/theme/basic/chn/sub03/sub03.php">埋线提升术(可熔丝)</a></li>
				<li><a href="/theme/basic/chn/sub03/sub04.php">蜘蛛网提升术</a></li>
			</ul>
			<ul id="cate4">
				<li id="title"><b>SKIN</b></li>
				<li id="first"><a href="/theme/basic/chn/sub04/sub01.php">精华素注射</a></li>
				<li><a href="/theme/basic/chn/sub04/sub02.php">皮肤疤痕重建</a></li>
				<li><a href="/theme/basic/chn/sub04/sub03.php">淋淋针</a></li>
				<li><a href="/theme/basic/chn/sub04/sub04.php">魔女注射</a></li>
				<li><a href="/theme/basic/chn/sub04/sub05.php">Make-up peel</a></li>
				<li><a href="/theme/basic/chn/sub04/sub06.php">抗老化激光</a></li>
				<li><a href="/theme/basic/chn/sub04/sub07.php">水光调色</a></li>
				<li><a href="/theme/basic/chn/sub04/sub08.php">除去瑕疵</a></li>
				<li><a href="/theme/basic/chn/sub04/sub09.php">痤疮</a></li>
				<li><a href="/theme/basic/chn/sub04/sub10.php">AGAS IO PEEL</a></li>
				<li><a href="/theme/basic/chn/sub04/sub11.php">AQUA PEEL</a></li>
			</ul>
			<ul id="cate5">
				<li id="title"><b>ETC</b></li>
				<li id="first"><a href="/theme/basic/chn/sub05/sub01.php">增强轮廓注射</a></li>
				<li><a href="/theme/basic/chn/sub05/sub02.php">Zero-king diet</a></li>
				<li><a href="/theme/basic/chn/sub05/sub03.php">3-way diet</a></li>
				<li><a href="/theme/basic/chn/sub05/sub04.php">liposonix</a></li>
				<li><a href="/theme/basic/chn/sub05/sub05.php">Double-skinny</a></li>
				<li><a href="/theme/basic/chn/sub05/sub06.php">Relax F Tenor</a></li>
				<li><a href="/theme/basic/chn/sub05/sub07.php">Cool-shaping</a></li>
				<li><a href="/theme/basic/chn/sub05/sub08.php">隆鼻埋线</a></li>
				<li><a href="/theme/basic/chn/sub05/sub09.php">眼部埋线</a></li>
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