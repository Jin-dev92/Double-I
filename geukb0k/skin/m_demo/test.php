<?php
include_once $nfor[skin_path]."head.php";
?>

































<style>
.swiper-pagination01 { position:absolute; top:10px; right:10px; z-index:1; }
.swiper-pagination01 span { margin:0px 2px; }
</style>

<div class="container01" style="overflow:hidden; position:relative;">

    <div class="swiper-container01">
        <div class="swiper-wrapper">
			<?
			$sql = " select * from nfor_item order by rand()";
			$result = sql_query($sql);
			for($i=0; $item=sql_fetch_array($result); $i++){
				$item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);
				$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];
				$item[url] = "item.php?it_id=$item[it_id]&amp;category_id=$item[category_id]&amp;area_id=$item[area_id]";
			?>
            <div class="swiper-slide"><img src="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" style="width:100%;"></div>
            <? } ?>
        </div>
        <div class="swiper-pagination01"></div>
        <div class="swiper-button-next swiper-button-next01"></div> 
		<div class="swiper-button-prev swiper-button-prev01"></div> 
    </div>

</div>

<script>
var swiper = new Swiper('.swiper-container01', {
	pagination: '.swiper-pagination01',
	slidesPerView: 1,
	paginationClickable: true,
	nextButton: '.swiper-button-next01', 
	prevButton: '.swiper-button-prev01', 
	autoplay: 3500,
	autoplayDisableOnInteraction:false,
	loop: true
});
</script>






<style>
.swiper-pagination02 { text-align:center; }
.swiper-pagination02 span { margin:0px 2px; }
</style>


<div class="container02" style="overflow:hidden; padding:10px;">

    <div class="swiper-container02" style="width:100%;">
        <div class="swiper-wrapper">
			<?
			$sql = " select * from nfor_item order by rand()";
			$result = sql_query($sql);
			for($i=0; $item=sql_fetch_array($result); $i++){
				$item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);
				$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];
				$item[url] = "item.php?it_id=$item[it_id]&amp;category_id=$item[category_id]&amp;area_id=$item[area_id]";
			?>
            <div class="swiper-slide"><img src="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" style="width:100%;"></div>
            <? } ?>
        </div>
        <div class="swiper-pagination02"></div>
    </div>

</div>

<script>
var swiper2 = new Swiper('.swiper-container02', {
	pagination: '.swiper-pagination02',
	slidesPerView: 2,
	paginationClickable: true,
	spaceBetween: 10,
	loop: true
});
</script>








<style>
.number_wrap { position:absolute; right:75px; bottom:10px; z-index:1; font-size:14px; font-weight:bold; }
.all_view { position:absolute; right:0px; bottom:4px; color:#fff; background-color:#000; width:65px; height:30px; line-height:30px; font-size:12px; z-index:1; text-align:center; font-weight:bold; }
</style>

<div class="container03" style="overflow:hidden; position:relative;">

    <div class="swiper-container03">
        <div class="swiper-wrapper">
			<?
			$sql = " select * from nfor_item order by rand()";
			$result = sql_query($sql);
			for($i=0; $item=sql_fetch_array($result); $i++){
				$item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);
				$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];
				$item[url] = "item.php?it_id=$item[it_id]&amp;category_id=$item[category_id]&amp;area_id=$item[area_id]";
			?>
            <div class="swiper-slide">
				 <img src="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" style="width:100%;" class="swiper-lazy">
			</div>
            <? } ?>
        </div>

    </div>

	<div class="number_wrap"><span class="start_index">1</span> / 6</div>
	<div class="all_view"> + 전체보기</div>

</div>


<script>
var mySwiper = new Swiper('.swiper-container03', {
	slidesPerView: 1,
	loop: true,
	onTransitionEnd : function (swiper){
		if(swiper.isEnd){
			print = 1;
		} else if(swiper.isBeginning){
			print = swiper.slides.length-2;
		} else{
			print = swiper.activeIndex;
		}
		$(".start_index").text(print);
	}

});
</script>
























<style>
.item_ul { padding:10px 5px; overflow:hidden; width:100%; background-color:#e3e3e8; box-sizing:border-box; }
.item_ul li { float:left; width:50%; height:auto; margin-bottom:11px; padding:0px 5px; box-sizing:border-box; }
.item_ul a { display:block; background-color:#fff; border:solid 1px #ccc; }


.thumb { position:relative; width:100%; height:auto; overflow:hidden; }
.it_two_img { width:100%; height:auto; }



.two_it_name { width:100%; height:40px; padding:2px 8px; box-sizing:border-box; overflow:hidden; font-size:14px; line-height:18px; } 



.two_it_price_info { width:100%; height:30px; margin:2px 0px; padding:0px 8px; box-sizing:border-box; overflow:hidden; position:relative; }

.two_it_price_info .it_discount_rate { color:#ff272f; font-size:27px; line-height:27px; font-weight:bold; float:left; padding-right:7px; margin-top:-1px; }
.two_it_price_info .it_discount_rate b { font-size:15px; }

.two_it_price_info .it_price { float:left; }
.two_it_price_info .it_price .it_price1 { display:block; text-decoration:line-through; color:#b6b6b6; font-size:9px; line-height:9px; margin-top:2px; }
.two_it_price_info .it_price .it_price2 { display:block; color:#333; font-size:16px; line-height:16px; font-weight:bold; margin-top:-2px; }



.it_sales_volume2 { width:100%; height:27px; line-height:27px; text-align:right; font-size:13px; color:#9d9fa5; border-top:solid 1px #eee;  }
.it_sales_volume2 span { margin-right:7px; } 

</style>


<div class="item_wrap">

	<ul class="item_ul">
	<?
	$sql = " select * from nfor_item limit 6";
	$result = sql_query($sql);

	for($i=0; $item=sql_fetch_array($result); $i++){

		// 판매량
		$item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);
		// 남은수량정의
		$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];

		$item[url] = "item.php?it_id=$item[it_id]&amp;category_id=$item[category_id]&amp;area_id=$item[area_id]";
	?>
	<li>
		<a href="<?=$item[url]?>">

		<div class="thumb"><img src="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="it_two_img"></div>
		<div>

		
			<p class="two_it_name">동해물과백두산이 마르고닮도록 하느님이 보우하사 우리나라만세 무궁화 삼천리 화려강산 대한사람 대한으로 <?=$item[it_name]?></p>
		

			<div class="two_it_price_info">
			
				<span class="it_discount_rate"><?=$item[it_discount_rate]?><b>%</b></span>
				<div class="it_price">
					<span class="it_price1"><?=number_format($item[it_price1])?><span>원</span></span>
					<span class="it_price2"><?=number_format($item[it_price2])?><span>원</span></span>
				</div>
				<span class="it_icon"></span>


			</div> 





		</div>
		<div class="it_sales_volume2"><span><b><?=number_format($item[it_sales_volume])?></b>개 구매</span></div>
		
		
		</a>
	</li>
	<? } ?>
	</ul>

</div>




<?
include_once $nfor[skin_path]."tail.php";
?>