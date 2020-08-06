<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta property="og:type" content="website">
<link rel="canonical" href="http://geukbok.com/skin/demo/index.php">
<meta property="title" content="극복" />
<meta name="description" content="뷰티소셜커머스, 수능 이벤트, 화장품, 성형, 쁘띠성형, 시술후기, 성형후기, 수술후기, 피부레이저, 성형쿠폰"/>
<? if($item[it_id] and basename($PHP_SELF)=="item.php"){ ?>
<meta property="og:url" content="<?=$nfor[url]."/item.php?it_id=".$item[it_id]?>" />
<meta property="og:title" content="<?=$item[it_name]?>" />
<meta property="og:description" content="<?=$item[it_description]?>" />
<meta property="og:image" content="<?="$nfor[url]/data/main/$item[it_img_m1]"?>" />
<meta property="og:image:type" content="image/jpeg" />
	<?}else {
		?>
		<meta property="og:title" content="극복" />
		<meta property="og:image" content="<?="$nfor[url]/data/main/$item[it_img_m1]"?>" />
		<meta property="og:url" content="http://geukbok.com" />
		<meta property="og:image:type" content="image/jpeg" />
<?	}?>
<? if($item[it_id] and basename($PHP_SELF)=="item.php"){ ?>
<meta property="og:url" content="<?=$nfor[url]."/item.php?it_id=".$item[it_id]?>" />
<meta property="og:title" content="<?=$item[it_name]?>" />
<meta property="og:description" content="<?=$item[it_description]?>" />
<meta property="og:image" content="<?="$nfor[url]/data/main/$item[it_img_m1]"?>" />
<meta property="og:image:type" content="image/jpeg" />
<? } ?>
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
<title><?=$config[cf_name]?></title>
<link href="<?=$nfor[skin_path]?>css/style.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link href="<?=$nfor[skin_path]?>css/swiper.css" rel="stylesheet" />
<script src="<?=$nfor[skin_path]?>js/swiper.jquery.min.js"></script>
<script src="<?=$nfor[path]?>/js/jquery.countdown.min.js"></script>
<script src="<?=$nfor[path]?>/js/placeholders.jquery.min.js"></script>
<script src="<?=$nfor[skin_path]?>js/jquery.lazyload.min.js"></script>
<script src="<?=$nfor[skin_path]?>js/jquery.scrollstop.min.js"></script>
<script src="<?=$nfor[skin_path]?>js/jquery.scrollTo.min.js"></script>
<script src="<?=$nfor[path]?>/js/nfor.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
<!--
var is_member = "<?=$is_member?>";
var nfor_path = "<?=$nfor[path]?>";
var nfor_url = "<?=$nfor[url]?>";
var nfor_name = "<?=$config[cf_name]?>";
$(document).ready(function(){
	$('.btn_top').click(function(){
		$('html,body').animate({scrollTop:0}, 1000);
	});
});
$(window).scroll(function(){
	var scrollTop = $(document).scrollTop();
	if(scrollTop > 200){
		$('.btn_top').fadeIn();
	} else{
		$('.btn_top').fadeOut();
	}
});
//-->
</script>
<?
if($config[cf_naverpay_use]){
?>
<script type="text/javascript" src="http://<?=$config[cf_naverpay_test]?"test-":""?>pay.naver.com/customer/js/naverPayButton.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if(!wcs_add) var wcs_add = {};
wcs_add["wa"] = "<?=$config[cf_naverpay_wcs_add]?>";
wcs.inflow("<?=$HTTP_HOST?>");
</script>
<? } ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
</head>
<body>
<?php
include_once $nfor[skin_path]."inc_popup.php";  // 팝업

include_once $nfor[skin_path]."inc_search.php";  // 검색

include_once $nfor[skin_path]."inc_side_left.php";  // 좌측사이드메뉴
?>




<!-- wrap -->
<?
if(basename($PHP_SELF)=="index.php"){
?>
<style>
#wrap { width:100%; padding:103px 0px 56px 0px; margin:0px; }
</style>
<?
} elseif(basename($PHP_SELF)=="item_list.php"){
?>
<style>
#wrap { width:100%; padding:56px 0px 56px 0px; margin:0px; }
</style>
<? } else{ ?>
<style>
#wrap { width:100%; padding:52px 0px 56px 0px; margin:0px; }
</style>
<? } ?>



<?
if(basename($PHP_SELF)=="index.php" or basename($PHP_SELF)=="item_list.php"){
?>
<style>
#header.upmove { top:-54px; transition: all .2s linear; -webkit-transition: all .2s linear; }
</style>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(function(){
	var lastScroll = 0;
	$(window).scroll(function(event){
		var st = $(this).scrollTop();
		if(st<53){
			$("#header").removeClass("upmove");
		} else{
			if(st > lastScroll){
				$("#header").addClass("upmove");
			} else{
				$("#header").removeClass("upmove");
			}
		}
		lastScroll = st;
	});
});
//-->
</SCRIPT>
<? } ?>










<div id="wrap">


	<!-- header -->
	<style>
	#header { position:fixed; left:0px; right:0px; top:0px; width:100%; z-index:100; padding: 0; }
	</style>
	<header id="header">





		<?
		if($nfor[title]){
		?>
		<style>
		#gnb { width:100%; height:53px; border-bottom:solid 1px #ccc; background:#2b68a7; }


		.txt_title { display:block; margin:0 auto; text-align:center; max-width:150px; overflow:hidden; height:53px; line-height:53px; font-weight:bold; font-size:18px; }


		#gnb a { display:block; text-decoration:none; text-align:center; font-size:12px; color:#111; cursor:pointer; }
		#gnb i{ display:block; background:url(<?=$nfor[skin_path]?>img/layout.png) no-repeat 0 0; background-size:320px auto; width:25px; height:25px; margin:0 auto; }

		#gnb .btn_back { position:absolute; left:10px; top:5px; }
		#gnb .btn_back i { background-position:-100px -100px;  }

		#gnb .btn_search { position:absolute; right:10px; top:5px; }
		#gnb .btn_search i { background-position:-200px 0px;  }

		#gnb .btn_cart { position:absolute; right:10px; top:5px; }
		#gnb .btn_cart i { background-position:-100px 0px;  }
		#gnb .btn_cart span { position:absolute; background-color:#ec1b23; right:0px; top:0px; width:17px; height:17px; line-height:17px; color:#fff; text-align:center; border-radius:10px; font-size:13px;  }



		</style>
		<nav id="gnb">
			<a href="javascript:history.back();" class="btn_back" style="color: #fff"><i></i>뒤로</a>
			<span class="txt_title"><?=$nfor[title]?></span>


			<? if(basename($PHP_SELF)=="item.php"){ ?>
			<a href="cart.php" class="btn_cart" style="color: #fff"><i></i>장바구니<span id="cart_cnt"><?=cart_cnt($_SESSION[cart_id])?></span></a>
			<? } else{ ?>
			<a class="btn_search" style="color: #fff"><i></i>검색</a>
			<? } ?>


		</nav>
		<? } else{ ?>
		<style>
		#gnb { width:100%; height:60px; background:#2b68a7; }
		#gnb .logo { margin:0 auto; display:block; width:92px; height:49px; padding-top:10px; text-indent:-999em; background:url(/skin/m_demo/img/logo.png) no-repeat 0; background-size:92px auto; }

		#gnb a { display:block; text-decoration:none; text-align:center; font-size:12px; color:#fff; cursor:pointer; }
		#gnb i{ display:block; background:url(/skin/m_demo/img/layout.png) no-repeat 0 0; background-size:320px auto; width:25px; height:25px; margin:0 auto; }

		#gnb .btn_menu { position:absolute; left:10px; top:5px; }
		#gnb .btn_menu i { background-position:0px -100px;  }

		#gnb .btn_search { position:absolute; right:10px; top:5px; }
		#gnb .btn_search i { background-position:-50px -100px;  }

		</style>
		<nav id="gnb">
			<a class="btn_menu"><i></i>메뉴</a>
			<a href="index.php" class="logo">홈으로</a>
			<a class="btn_search"><i></i>검색</a>
		</nav>
		<? } ?>






		<?
		if(basename($PHP_SELF)=="index.php"){
		?>
		<style>
		.lnb{ white-space:nowrap; overflow-x:auto; -webkit-overflow-scrolling:touch; background-color:#fff; }
		.lnb ul{ display:table; }
		.lnb li {  display:table-cell; border-bottom:solid 1px #ececec; }
		.lnb li a{ color:#666; font-size:16px; display:block; padding:14px 10px 10px;  }
		.lnb li.active { border-bottom:solid 4px #2b68a7; }
		.lnb li.active a{ color:#000; font-weight:bold;  }
		.lnb::-webkit-scrollbar {display:none;}
		</style>


		<nav class="lnb">
		<ul>
			<li><a href="#" data-slide="0">전체상품</a></li>
			<!-- <?
			$k = 1;
			$que = sql_query("select * from nfor_item_category where wr_use='1' and depth_id='0' order by wr_rank asc ");
			while($data = sql_fetch_array($que)){
			?>
			<li><a href="#" data-slide="<?=$k?>"><?=$data[wr_category]?></a></li>
			<?
				$k++;
			}
			?> -->
		</ul>
		</nav>
		<? } elseif(basename($PHP_SELF)=="item_list.php"){ ?>
		<style>
		.lnb{ white-space:nowrap; overflow-x:auto; -webkit-overflow-scrolling:touch; background-color:#fff; display:none; }
		.lnb ul{ display:table; }
		.lnb li {  display:table-cell; border-bottom:solid 1px #ececec; }
		.lnb li a{ color:#666; font-size:16px; display:block; padding:14px 10px 10px;  }
		.lnb li.active { border-bottom:solid 4px #ec3940; }
		.lnb li.active a{ color:#000; font-weight:bold;  }
		.lnb::-webkit-scrollbar {display:none;}
		</style>
		<nav class="lnb">
		<ul>
			<li><a href="#" data-slide="0">전체</a></li>
			<?
			$i = 1;
			$que2 = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='2' and category_id like '".substr($category_id,0,6)."%'");
			while($data2 = sql_fetch_array($que2)){
			?>
			<li><a href="#" data-slide="<?=$i?>"><?=$data2[wr_category]?></a></li>
			<?
				$i++;
			}
			?>
		</ul>
		</nav>
		<? } else{ ?>

		<? } ?>


	</header>
	<!-- //header -->





	<style>
	#container { min-height:500px; }
	</style>



	<!-- container -->
	<div id="container">
