<!doctype html>
<html><head>
<meta charset="utf-8">
<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
<meta property="og:type" content="website">
<link rel="canonical" href="http://geukbok.com/skin/demo/index.php">
<meta property="og:title" content="극복" />
<meta name="description" content="뷰티소셜커머스, 수능 이벤트, 화장품, 성형, 쁘띠성형, 시술후기, 성형후기, 수술후기, 피부레이저, 성형쿠폰"/>
<? if($item[it_id]){ ?>
<meta property="og:url" content="<?=$nfor[url]."/item.php?it_id=".$item[it_id]?>" />
<meta property="og:title" content="<?=$item[it_name]?>" />
<meta property="og:description" content="<?=$item[it_description]?>" />
<meta property="og:image" content="<?="$nfor[url]/data/main/$item[it_img_m1]"?>" />
<meta property="og:image:type" content="image/jpeg" />
	<?}else {
		?>
		<meta property="og:description" content="뷰티소셜커머스, 수능 이벤트, 화장품, 성형, 쁘띠성형, 시술후기, 성형후기, 수술후기, 피부레이저, 성형쿠폰" />
		<meta property="og:image" content="<?="$nfor[url]/data/main/$item[it_img_m1]"?>" />
		<meta property="og:url" content="http://geukbok.com" />
		<meta property="og:image:type" content="image/jpeg" />
<?	}?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
<title><?=$config[cf_name]?></title>
<link href="<?=$nfor[skin_path]?>css/style.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="<?=$nfor[path]?>/js/jquery.bxslider.min.js"></script>
<!--<link href="<?=$nfor[path]?>/css/jquery.bxslider.css" rel="stylesheet" />-->
<script src="<?=$nfor[path]?>/js/jquery.countdown.min.js"></script>

<script src="<?=$nfor[path]?>/js/placeholders.jquery.min.js"></script>

<script src="<?=$nfor[path]?>/editor/cheditor.js"></script>



<script src="<?=$nfor[path]?>/js/nfor.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
<!--
var is_member = "<?=$is_member?>";
var nfor_path = "<?=$nfor[path]?>";
var nfor_url = "<?=$nfor[url]?>";
var nfor_name = "<?=$config[cf_name]?>";
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


<style>
/*linear-gradient(-45deg, #f7cac9 0%,#f7cac9 34%,#92a8d1 78%,#92a8d1 100%);*/
#header { position: relative; background:#fff }

#header .top_menu{width:100%; height:33px; z-index:10; }
#header .top_menu .top_menu_wrap{position:relative; margin:0 auto; width:1161px; height:33px; font-size:11px; letter-spacing:-1px;}
#header .top_menu .top_menu_wrap .left { position:absolute; top:0px; left:0px; color:#d7d7d7; font-size:11px; line-height:11px;}
#header .top_menu .top_menu_wrap .left a { display:inline-block; color:#666; padding:9px; }

#header .top_menu .top_menu_wrap .right { position:absolute; top:0px; right:0px; color:#fff; font-size:11px; line-height:11px; letter-spacing:-1px; }
#header .top_menu .top_menu_wrap .right a { display:inline-block; *zoom:1; *display:inline; color:#666; padding:9px; position:relative; }
#header .top_menu .top_menu_wrap .right .star { display:inline-block; *zoom:1; *display:inline;  height:15px;width:15px; background:url("<?=$nfor[skin_path]?>img/picreup_layout.png") -0px -0px no-repeat; vertical-align:-3px;}
#header .top_menu .top_menu_wrap .right .mail { display:inline-block; *zoom:1; *display:inline;  height:15px;width:15px; background:url("<?=$nfor[skin_path]?>img/picreup_layout.png") -30px -0px no-repeat; vertical-align:-3px;}
#header .top_menu .top_menu_wrap .right .cartbg { display:inline-block; *zoom:1; *display:inline;  height:16px;width:16px; background:url("<?=$nfor[skin_path]?>img/picreup_layout.png") -0px -30px no-repeat; vertical-align:-0px; text-align:center; line-height:16px;color:#FFFFFF; }

#header .gnb_logo_section { width:100%; }
#header .gnb_logo_section .inner{ position:relative; width:1161px; height: 70px; margin:0 auto; overflow:hidden; }
#header .gnb_logo_section .inner .indexlogo{position:absolute; top:15px; text-align:left;  width:186px; height:30px; display:block; background:url("<?=$nfor[skin_path]?>img/logo.png") -0px -0px no-repeat;  text-indent:-9999px; }
#header .gnb_logo_section .inner .search { border:solid 2px #f18484; height:34px; width:400px;position:absolute; top:15px; right:390px; }
#header .gnb_logo_section .inner .search_btn{ display: block;  width:32px; height:32px; background: #ff8590;margin: 0;padding: 0; cursor: pointer; border: 0;}
#header .gnb_logo_section .inner .search_text{ width:351px; height:32px;line-height:33px; border:0px; padding-left:16px;}

#header .top_right_banner_wrap { position:absolute; top:15px; right:0px; }

#gnb { position:relative; width:100%; height:70px;background-color:#2b68a7; z-index:3; -moz-box-shadow: 10px 10px 5px #888888; /* Firefox 3.6 and earlier box-shadow: 0px 2px 2px #999999;*/}
#gnb .gnb_menu {width: 1161px; height: 70px; margin:0 auto; border-left:dashed 1px rgba(255, 255, 255, 0.47); overflow:hidden;}
#gnb .gnb_menu ul { position:relative; margin:0 auto;  width:1161px; }
#gnb .gnb_menu li { float:left; color:#ffffff;  text-align:center; margin:0px; padding:0px;}
#gnb .gnb_menu li a { display:block;color:#FFFFFF; line-height:75px; font-size:14px; width:231px; border-right:dashed 1px rgba(255, 255, 255, 0.47);  }
#gnb .gnb_menu li a img { margin-top:15px; margin-right:10px;   }
#gnb .gnb_menu li a.on { color:#FFFFFF;  background-color:#4090e3 }
#gnb .gnb_menu li a:hover{ text-decoration:none; background-color:#4090e3; }

</style>

</head>
<body>



<!-- 구독하기 -->
<style>
.subscribe_popup {position:fixed;_position:absolute;top:0;left:0;width:100%;height:100%; z-index:1000; display:none; }
.subscribe_popup .bg {position:absolute;top:0;left:0;width:100%;height:100%;background:#000;opacity:.5;filter:alpha(opacity=50)}
.subscribe_popup .fg {position:absolute;top:50%;left:50%;width:517px;height:392px;margin:-200px 0 0 -258px;}
</style>
<div id="subscribe_popup" class="subscribe_popup">
	<div class="bg"></div>
	<div class="fg"><? include_once $nfor[skin_path]."subscribe.php"; ?></div>
</div>
<!-- 구독하기 -->




<!-- wrap -->
<div id="wrap">

	<!-- header -->
	<div id="header">

		<!-- top_menu -->
		<div class="top_menu">
			<div class="top_menu_wrap">
				<div class="right">
					<a href="javascript:favorite()"><b class="star"></b> 즐겨찾기</a>
					<span class="menu_bar">|</span>
					<a href="javascript:subscribe_popup('open')" class="lk-1"><b class="mail"></b> 메일구독</a>
					<span class="menu_bar">|</span>
					<? if(!$member[mb_no]){ ?>
					<a href="login.php">로그인</a>
					<span class="menu_bar">|</span>
					<a href="member_join.php">회원가입</a>
					<span class="menu_bar">|</span>
					<? } else{ ?>
					<a href="logout.php">로그아웃</a>
					<span class="menu_bar">|</span>
					<a href="member_form.php">정보수정</a>
					<span class="menu_bar">|</span>
					<? } ?>
					<a href="faq.php" style="color:#666;">고객센터</a>
					<span class="menu_bar">|</span>
					<a href="order_list.php" style="color:#666;">마이페이지</a>
					<span class="menu_bar">|</span>
					<a href="cart.php">장바구니 <b class="cartbg"> <?=cart_cnt($_SESSION[cart_id])?> </b></a>
					<? if($is_admin || $member['is_supply']){ ?>
					<span class="menu_bar">|</span>
					<a href="/admin/" style="color:#666;" target="_blank">관리자모드</a>
					<? } ?>
				</div>
			</div>

		</div>
		<!-- //top_menu -->





		<!-- gnb_logo_section -->


		<div class="gnb_logo_section">
			<div class="inner">

			<?
			$supply = sql_fetch("select * from nfor_member where mb_no='$item[supply_no]'");
			if($supply[supply_photo]){
			?>
			<a href="/"><img src="<?="$nfor[path]/data/member/supply/$supply[supply_photo]"?>" style="width:180px;"></a>
			<? } else{ ?>
			<a href="/"><h1 class="indexlogo"></h1></a>
			<? } ?>

			<div class="search">
				<form method="get" id="fitem_search" action="search.php">
				<input type="text" name="keyword" value="<?=$_GET[it_keyword]?>" class="search_text"><a href="javascript:item_search()"><img src="<?=$nfor[skin_path]?>img/search_btn.png" alt="검색"></a>
				</form>
			</div>
			<?php include_once $nfor[skin_path]."inc_top_right_banner.php"; ?>
			</div>
		</div>


		<!-- //gnb_logo_section -->

		<!-- gnb -->
		<div id="gnb">
			<!-- gnb_menu -->
			<div class="gnb_menu">

					<li><a class="menu01<?=basename($PHP_SELF)=="today_item_list.php"?" on":""?>" href="today_item_list.php"><img src="/skin/demo/img/today.png"/>전체상품</a></li>
					<?
					$que = sql_query("select * from nfor_item_category where wr_use='1' and depth_id='0' order by wr_rank ASC ");
					while($data = sql_fetch_array($que)){
						if($data[category_id] =="004") {
					?>
					<div  id="area_menu"><li><a class="menu02<?=substr($category_id,0,3)==$data[category_id]?" on":""?>" href="item_list.php?category_id=<?=$data[category_id]?>"><img src="/data/category/<?=$data[wr_img_hov]?>"/><?=$data[wr_category]?></a></li>
						<div id="area_menu_list">
							<a href="item_list.php?category_id=004">모든지역 </a>
							<a href="item_list.php?category_id=004465">서울시 </a>
							<a href="item_list.php?category_id=004466">인천&nbsp;|&nbsp;경기 </a>
							<!--<a href="item_list.php?category_id=004467">대전&nbsp;|&nbsp;충청</a>
							<a href="item_list.php?category_id=004468">광주&nbsp;|&nbsp;전라</a>
							<a href="item_list.php?category_id=004469">부산&nbsp;|&nbsp;경상</a>
							<a href="item_list.php?category_id=004470">그외</a>-->
						</div>
					</div>
					<?
							} else {
					?>
					<li><a class="menu02<?=substr($category_id,0,3)==$data[category_id]?" on":""?>" href="item_list.php?category_id=<?=$data[category_id]?>"><img src="/data/category/<?=$data[wr_img_hov]?>"/><?=$data[wr_category]?></a></li>
					<?
							}
						}
						?>


			</div>
			<!-- //gnb_menu -->
		</div>
		<!-- //gnb -->


	</div>
	<!-- //header -->

<style>
#area_menu_list { position:absolute; background-color:#fff; width:231px; height:auto;  z-index:9999; display:none; margin-left: 928px; margin-top: 70px;}
#area_menu_list a { display:block; font-size:12px; color:#555; padding:10px 10px; letter-spacing:-1px;}
#area_menu_list a:hover{  color:#2b68a7;}
</style>

<script type="text/javascript">
<!--
$(document).ready(function(e) {
	$("#area_menu").hover(
		function(){
			$("#area_menu_list").show();
		},

		function(){
			$("#area_menu_list").hide();
		}
	);
});
//-->
</script>
