<?
include_once "path.php";
?>

<style>
.itemlist_ul { padding:10px 5px; overflow:hidden; width:100%; background-color:#e3e3e8; box-sizing:border-box; }
.itemlist_ul li { float:left; width:50%; height:auto; margin-bottom:11px; padding:0px 5px; box-sizing:border-box;position: relative; }
.itemlist_ul a { display:block; background-color:#fff; border:solid 1px #ddd; }


.thumb { position:relative; width:100%; height:auto; overflow:hidden; }
.it_two_img { width:100%; height:auto; }


.two_it_description { display:block; padding:10px 8px 0px; font-size:9px; height:10px; line-height:10px; overflow:hidden; color:#898989; }
.two_it_name { width:100%; height:32px; padding:0px 8px ; box-sizing:border-box; overflow:hidden; font-size:12px; line-height:14px; } 



.two_it_price_info { width:100%; height:30px; margin:2px 0px; padding:0px 8px; box-sizing:border-box; overflow:hidden; position:relative; }

.two_it_price_info .it_discount_rate { color:#ff272f; font-size:28px; line-height:30px; font-weight:bold; float:left; padding-right:7px; margin-top:-1px; }
.two_it_price_info .it_discount_rate b { font-size:15px; }

.two_it_price_info .it_price { float:left; }
.two_it_price_info .it_price .it_price1 { display:block; text-decoration:line-through; color:#b6b6b6; font-size:9px; line-height:12px; margin-top:0px; }
.two_it_price_info .it_price .it_price2 { display:block; color:#333; font-size:16px; line-height:16px; font-weight:bold; margin-top:-2px; }



.it_sales_volume2 { width:100%; height:27px; line-height:27px; text-align:right; font-size:11px; border-top:solid 1px #eee;  }
.it_sales_volume2 span { margin-right:7px; } 
.two_etc_ico { position:absolute; right:0px; bottom:0px;}

.m_shoppingbanner { margin:5px 0px 0px 0px; background-color:#e3e3e8;}
.m_shoppingbanner img{ width:100%; }

.sub{ white-space:nowrap; overflow-x:auto; -webkit-overflow-scrolling:touch; background-color:#fff; }
.sub ul{ display:table; }
.sub li {  display:table-cell; border-bottom:solid 1px #ececec; }
.sub li a{ color:#666; font-size:13px; display:block; padding:14px 10px 10px;  }
.sub li.active a{ color:#ec3940; font-weight:bold;  }

.sub::-webkit-scrollbar {display:none;}


</style>

<div class="sub">
	<ul>
		<li class="active"><a href="#">전체보기</a></li>
		<?
		$que2 = sql_query("select * from nfor_item_category where wr_depth='1' and category_id like '$data[category_id]%'");
		while($data2 = sql_fetch_array($que2)){
		?>
			<li><a href="item_list.php?category_id=<?=$data2[category_id]?>"><?=$data2[wr_category]?></a></li>
		<? } ?>
	</ul>
</div>

<?
$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='m_shoppingbanner' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc limit 1");
while($banner=sql_fetch_array($que)){
?>
<div class="m_shoppingbanner"><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt=""></a></div>
<? } ?>


<?
$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='m_shoppingbanner1' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc limit 1");
while($banner=sql_fetch_array($que)){
?>
<div class="m_shoppingbanner"><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt=""></a></div>
<? } ?>


<ul class="itemlist_ul">
<?
$sql = " select * from nfor_item";
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

	<div class="thumb">

	<div class="two_etc_ico">
	<div style="background:#63c6f7; font-size:9px; color:#fff; height:20px; padding:3px 4px 2px 4px;height:11px;letter-spacing: -1px;float:left;"><?=delivery_type($item)?></div>
	<div style="background:#ff7f00; font-size:9px; color:#fff; height:20px; padding:3px 4px 2px 4px;height:11px;letter-spacing: -1px;float:left;">쿠폰할인</div> 
	</div>
	<img src="<?=$item[it_img_l_m]?"$nfor[path]/data/list_m/$item[it_img_l_m]":"$nfor[path]/img/item_list_noimg.jpg"?>" alt="" class="it_two_img">

	</div>


	<div>
		<span class="it_title" style="line-height:10px; color:rgba(212, 147, 89, 0.92); font-size:14px;">[&nbsp;<?=$row2[wr_category]?><?=$row[wr_name]?>&nbsp;]</span>
		<span class="two_it_description"><?=$item[it_description]?></span>
		<p class="two_it_name"><?=$item[it_name]?></p>
	
		<div class="two_it_price_info">
		
			<span class="it_discount_rate"><?=$item[it_discount_rate]?><b>%</b></span>
			<div class="it_price">
				<!--<span class="it_price1"><?=number_format($item[it_price1])?><span>원</span></span>-->
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