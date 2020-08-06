<?php
include_once $nfor[skin_path]."head.php";
?>

<?
include_once $nfor[skin_path]."index_banner1.php";
?>

<?
// include_once $nfor[skin_path]."index_banner2.php";
?>

<!-- 전체롤링 -->
<div class="swiper-container swiper-container-common" style="padding-top: 60px;">
	<div class="swiper-wrapper">
		<div class="swiper-slide swiper-list-0">




		<ul class="item_list3">
		<?
		$sql = "select * from nfor_item where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and it_view='0' and it_hot>0";
		$sql .= " order by it_hot desc";
		$result = sql_query($sql);
		for($i=0; $item=sql_fetch_array($result); $i++){

			// 판매량
			// $item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);
			// 남은수량정의
			$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];

			$item[url] = "item.php?it_id=$item[it_id]&amp;category_id=$item[category_id]&amp;area_id=$item[area_id]";
		?>

		<?
		$sql2 = "select * from  (select * from nfor_item) a , nfor_item_category where wr_depth='2' and a.category_id1 = category_id and  a.it_id='$item[it_id]' ";
		$row2 = sql_fetch($sql2);
		?>
		<li>

			<a href="<?=$item[url]?>">

				<div class="img_wrap">
					<img src="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="img1 lazy">

					<ul class="icon_wrap">
						<li class="ico1"><?=delivery_type($item)?></li>
					</ul>
				</div>
				<span class="it_title" style="line-height:10px; color:#70a7e0; font-size:14px;">[&nbsp;<?=$row2[wr_category]?><?=$row[wr_name]?>&nbsp;]</span>
				<div class="it_description"><?=$item[it_description]?></div>
				<div class="it_name"><?=$item[it_name]?></div>
				<? if(number_format($item[it_price2]) != 0){?>
				<div class="price_wrap">
					<div class="it_price">
						<div class="it_price2"><?=number_format($item[it_price2])?><span>원</span></div>
					</div>
					<div class="it_sales_volume"><b><?=number_format($item[it_sales_volume])?></b>개 구매</div>
				</div>
				<?}?>
			</a>

		</li>
		<? } ?>
		</ul>





		</div>
		<?
		$k = 1;
		$que = sql_query("select * from nfor_item_category where wr_use='1' and depth_id='0' order by wr_rank asc");
		while($data = sql_fetch_array($que)){
		?>
		<div class="swiper-slide swiper-list-<?=$k?>"></div>
		<?
			$k++;
		}
		?>
	</div>
</div>
<!-- //전체롤링 -->


<SCRIPT LANGUAGE="JavaScript">
<!--
$(function(){

	$(window).scroll(function(){

		var target = $('.lnb ul > li.active');
		var z = target.index();
		var k = $('.swiper-list-'+z).height();

		if($(window).scrollTop() == $(document).height() - $(window).height()){
			swiperCommon.onResize();
		}
	});

	$('.lnb ul > li > a').on('click', function () {
		$('.lnb ul > li').removeClass('active');
		$(this).parent().addClass('active');
		swiperCommon.slideTo($(this).data('slide')+1);
		return false;
	});


	var swiperCommon = new Swiper('.swiper-container-common', {
		loop: true,
		autoHeight: true,
		onSlideChangeStart : function (swiper){
			if(swiper.isEnd){
				print = 1;
			} else if(swiper.isBeginning){
				print = swiper.slides.length-2;
			} else{
				print = swiper.activeIndex;
			}
			print = print - 1;

			$('.lnb ul > li').removeClass("active");
			$('.lnb ul > li').eq(print).addClass('active');

			moveMenu();
			 $(window).scrollTop(0);

			var pagename = [""<?
				$que = sql_query("select * from nfor_item_category where wr_use='1' and depth_id='0' order by wr_rank asc");
				while($data = sql_fetch_array($que)){
				?>,"index_list.php?category_id=<?=$data[category_id]?>"<? } ?>];

			if(!$('.swiper-list-'+print).html() || pagename[print]){
			  $.get('<?=$nfor[skin_path]?>'+pagename[print], function(data){
				 swiper.slides.eq(swiper.activeIndex).html(data);
			  });
			}

		}
	});

	var swiperA = new Swiper('.swiper-container-a', {
		loop: true,
		paginationClickable: true,
		pagination: '.swiper-pagination-a'
	});

});

function moveMenu(){
	var outer = $('.lnb');
	var inner = $('.lnb ul > li');
	var target = $('.lnb ul > li.active');
	var x = outer.width();
	var y = target.outerWidth(true);
	var z = target.index();
	var r = (x - y) / 1.9;
	var s = y * z;
	var t = s - r;
	outer.animate({ scrollLeft: Math.max(0, t)  }, 'fast');
};


// 베스트 순위
$(document).on("click", ".best_category a", function(){
	$.get('<?=$nfor[skin_path]?>'+'best_list.php?category_id='+$(this).data('category_id'), function(data){
		$(".swiper-list-1").html(data);
	});
});
//-->
</SCRIPT>






<?
include_once $nfor[skin_path]."tail.php";
?>
