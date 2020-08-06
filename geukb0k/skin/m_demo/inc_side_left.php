<style>

#side_left_close { cursor:pointer; display:block; background:url(/skin/m_demo/img/layout.png) no-repeat;background-position: -300px -200px;  background-size: 640px auto; height:30px; width:30px; position:absolute; top:15px; left:285px; z-index:99999; }



#side_left_wrap { display:none; left:-350px; position:fixed; z-index:99999;  }
#side_left { background-color:#fff; height:100%; width:280px; box-shadow:2px 0px 3px rgba(0,0,0,.7); overflow-y:scroll; -webkit-overflow-scrolling:touch;  }

#side_left_bg { display:none;  cursor:pointer; width:100%; background-color:rgba(0,0,0,0.5); height:100%; position:fixed; top:0; z-index:99990; }
#side_left::-webkit-scrollbar {display:none;}


.side_left_top { background:#2b68a7; height:50px; line-height:50px; position:relative; }
.side_left_top .login_msg { color:#fff; margin-left:10px; }
.side_left_top .login_btn { background-color:#5ea8f4; color:#fff; font-size:14px; position:absolute; right:10px; top:15px; display:block; line-height:14px; padding:4px 10px; }





.quick_nav { overflow:hidden; text-align:center; font-size:12px; padding:10px 0px; }
.quick_nav li{ float:left; width:25%; }
.quick_nav li a{ display:block; }
.quick_nav li:nth-child(2) a{ border-left:1px solid #eee; }
.quick_nav li:nth-child(3) a{ border-right:1px solid #eee; border-left:1px solid #eee; }


.category_mnu a { display:block; cursor:pointer; border-bottom:solid 1px #eee;  height:40px; line-height:40px; padding-left:15px; position:relative; font-size:14px; color:#666; }


.category_mnu a .arrow_off {
    position: absolute;
    right: 10px;
    top: 19px;
    display: inline-block;
    width: 16px;
    height: 9px;
    background-position: -200px -200px;
    background-image: url(/skin/m_demo/img/layout.png);
    background-repeat: no-repeat;
    background-size: 320px auto;
    overflow: hidden;
    text-indent: -1000px;
}

.category_mnu a .arrow_on {
    position: absolute;
    right: 10px;
    top: 19px;
    display: inline-block;
    width: 16px;
    height: 9px;
    background-position: -248px -200px;
    background-image: url(/skin/m_demo/img/layout.png);
    background-repeat: no-repeat;
    background-size: 320px auto;
    overflow: hidden;
    text-indent: -1000px;
}

.quick_nav li a em {
    display: block;
    margin: 0 auto 5px;
	background-size: 320px auto;
    background-image: url(/skin/m_demo/img/layout.png);
    background-repeat: no-repeat;
}
.quick_nav li:nth-child(1) a em {
    width: 25px;
    height: 25px;
    background-position: -0px -150px;
}
.quick_nav li:nth-child(2) a em {
    width: 25px;
    height: 25px;
    background-position: -50px -150px;
}
.quick_nav li:nth-child(3) a em {
    width: 25px;
    height: 25px;
    background-position: -100px -150px;
}
.quick_nav li:nth-child(4) a em {
    width: 25px;
    height: 25px;
    background-position: -150px -150px;
}


.sub_category { display:none; }
.sub_category li { background-color:#f9f9f9; border-bottom:solid 1px #f1f1f1; font-size:14px; color:#999; height:40px; line-height:40px; padding-left:20px; }


</style>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function(){
	resize_slide();
});

$(window).on('resize',function(){ setTimeout(resize_slide(),50); });
$(window).bind('orientationchange', function(e){ setTimeout(resize_slide(),50); });


function resize_slide(){
	$('#side_left, #side_left_bg').height( window.innerHeight );
	if( $('#side_left').is(':visible') ) { $('body, html').css({'height':window.innerHeight,'width':window.innerWidth}); }
}


$(document).on("click", ".depth_1", function(){
	var category_id = $(this).data("category_id");

	if($("#mnu_"+category_id).css("display")=="none"){
		$(".sub_category").hide();
		$("#mnu_"+category_id).show();
		$("#side_left").scrollTo($(this),300);
		$(".arrow").removeClass('arrow_on').addClass('arrow_off');
		$(this).find('.arrow_off').removeClass('arrow_off').addClass('arrow_on');
	} else{
		$("#mnu_"+category_id).hide();
		$("#side_left").scrollTo("body",300);
		$(this).find('.arrow_on').removeClass('arrow_on').addClass('arrow_off');
	}
});

$(document).on("click", ".btn_menu", function(){
	$("#side_left_bg").show();
	$("#side_left_wrap").animate({"left":"0px"}, 500 ).show();
	$("html").css("overflow-y","hidden").css("position","fixed");
	$("body").css("overflow-y","hidden").css("position","fixed");

});
$(document).on("click", "#side_left_bg, #side_left_close", function(){
	$("#side_left_bg").hide();
	$("#side_left_wrap").animate({"left":"-350px"}, 500 ).show();
	$("html").css("overflow-y","").css("position","");
	$("body").css("overflow-y","").css("position","");
});
//-->
</SCRIPT>


<div id="side_left_bg"></div>

<div id="side_left_wrap">

	<a id="side_left_close"></a>

	<div id="side_left">



		<div class="side_left_top">
			<span class="login_msg"><?=$member[mb_name]?$member[mb_name]:"고객"?>님 반갑습니다.</span>

			<? if($member[mb_no]){ ?>
			<a href="logout.php" class="login_btn">로그아웃</a>
			<? } else{ ?>
			<a href="login.php" class="login_btn">로그인</a>
			<? } ?>
		</div>

		<div class="side_left_menu">


			<div style="border-bottom:solid 1px #cdcdcd">
			<ul class="quick_nav">
				<li><a href="cart.php"><em></em>장바구니</a></li>
				<li><a href="zzim_list.php"><em></em>찜한목록</a></li>
				<li><a href="order_list.php"><em></em>주문/배송</a></li>
				<li><a href="mypage.php"><em></em>마이페이지</a></li>
			</ul>
			</div>
			<div style="background-color:#ebebeb; height:10px;"></div>

		</div>


<style>

.category_mnu a   .ico {
	display: inline-block;
    width: 30px;
    height: 30px;
    vertical-align: middle;
    margin-right: 7px;
    background-position: 0 0;
    background-image: url(/skin/m_demo/img/ico_side6.png);
    background-repeat: no-repeat;
    background-size: 150px 250px;
	}

.category_mnu  a:nth-child(1) em {
    width: 30px;
    height: 30px;
    background-position: -100px -0px;
}
.category_mnu  a:nth-child(3) em {
    width: 30px;
    height: 30px;
    background-position: -100px -50px;
}
.category_mnu  a:nth-child(5) em {
    width: 30px;
    height: 30px;
    background-position: -100px -100px;
}
.category_mnu  a:nth-child(7) em {
    width: 30px;
    height: 30px;
    background-position: -100px -150px;
}
.category_mnu  a:nth-child(9) em {
    width: 30px;
    height: 30px;
    background-position: -100px -200px;
}
</style>


		<div class="side_left_category">

			<div class="category_mnu">
				<?
				$que = sql_query("select * from nfor_item_category where wr_depth='0'");
				while($data = sql_fetch_array($que)){
				?>
					<a class="depth_1" data-category_id="<?=$data[category_id]?>"><em class="ico"></em><?=$data[wr_category]?><b class="arrow arrow_off"></b></a>
					<ul class="sub_category" id="mnu_<?=$data[category_id]?>">
					<?
					$que2 = sql_query("select * from nfor_item_category where wr_depth='1' and category_id like '$data[category_id]%'");
					while($data2 = sql_fetch_array($que2)){
					?>
					<li><a href="item_list.php?category_id=<?=$data2[category_id]?>"><?=$data2[wr_category]?></a></li>
					<? } ?>
					</ul>

				<? } ?>
			</div>

		</div>



		<div style="height:300px"></div>


	</div>

</div>
