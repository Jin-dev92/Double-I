<?
include_once "path.php";
?>
<script type="text/javascript">
<!--
function mybest_list_fnc(it_type){
    $.ajaxSetup ({
        cache: false
    });
    var url = "best_deal.php?it_type=" + it_type;
    $("#my_best_list").load(url);
}
//-->
</script>





<div id="my_best_list">

<table cellpadding="0" cellspacing="0" border="0" width="983" style="margin-top:30px;margin-bottom:10px;">
<tr>
	<td><a href="javascript:mybest_list_fnc('1')"><img src="img/main_teb_01<?=!$it_type || $it_type=="1"?"_ov":""?>.png"></a></td>
	<td><a href="javascript:mybest_list_fnc('2')"><img src="img/main_teb_02<?=$it_type=="2"?"_ov":""?>.png"></a></td>
	<td><a href="javascript:mybest_list_fnc('3')"><img src="img/main_teb_03<?=$it_type=="3"?"_ov":""?>.png"></a></td>
	<td><a href="javascript:mybest_list_fnc('4')"><img src="img/main_teb_04<?=$it_type=="4"?"_ov":""?>.png"></a></td>
</tr>
</table>


<table width="983" cellpadding="0" cellspacing="0" border="0" >
<tr>
<td valign="top" align="left">




	<table cellpadding="0" cellspacing="0" border="0" align="center" style="margin-top:6px;" width="100%">
	<tr>
		<td><img src="img/gong.gif"></td>
		<td><img src="img/gong.gif"></td>
		<td><img src="img/gong.gif"></td>
	</tr>
	<tr>
	<?
	$sql = "select * from nfor_item where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]'";
		
	if($it_type=="2"){
		$sql .= " order by it_sales_volume desc ";
	} elseif($it_type=="3"){ // 마감임박
		$sql .= " order by it_paydate asc ";
	} elseif($it_type=="4"){ // 오늘오픈
		$sql .= " order by it_paydate desc ";
	} else{ // 추천상품
		$sql .= " and it_hit > 0 order by it_hit desc";
	}

	$sql .= " limit 6";

	$result = sql_query($sql);
	for($i=0; $item=sql_fetch_array($result); $i++){
		if($i and $i%3==0) echo "</tr><tr>";

		// 판매량
		$item[it_sales_volume] = it_change_volume($item[it_id])+it_sales_volume($item[it_id]);
		// 남은수량정의
		$item[it_stock_now] = $item[it_stock]-$item[it_sales_volume];

		$align_number = $i%3;
		if($align_number=="0"){
			$align = "left";
		} elseif($align_number=="1"){
			$align = "center";
		} elseif($align_number=="2"){
			$align = "right";
		} else{

		}
		?>
	<td width="329" align="<?=$align?>">


		<table cellpadding="0" cellspacing="0" class="item_selected" style="margin-bottom:15px;">
		<tr>
			<td  align="left"><a href="<?="$nfor[item_load]?it_id=$item[it_id]&category_id=$item[category_id]&area_id=$item[area_id]"?>"><img src="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/item_list_noimg.jpg"?>" width="320" height="335" ></a>

				<table cellpadding="0" cellspacing="0" style="margin:8px;">
				<tr>
					<td><a href="<?="$nfor[item_load]?it_id=$item[it_id]&category_id=$item[category_id]&area_id=$item[area_id]"?>"><span style="font:11px/11px 'dotum'; color:#a2a2a2; letter-spacing:-1px;"><?=$item[it_description]?></span></a></td>
				</tr> 
				<tr>
					<td   valign="top"><a href="<?="$nfor[item_load]?it_id=$item[it_id]&category_id=$item[category_id]&area_id=$item[area_id]"?>"><span style="font:bold 14px/30px 'dotum'; color:#484242; letter-spacing:-1px;"><?=cut_str($item[it_name],55)?></span></a></td>
				</tr>						
				</table>

				<table width="94%" cellpadding="0" cellspacing="0" style="margin:8px;">
				<tr>
					<td width="60">
					<div style=" background:url('/img/ratebg.png') no-repeat;width:53px; height:42px;text-align:center;">
						<?
					$it_price_type = sql_fetch("select * from nfor_price where wr_id='$item[it_price_type]'");
					if($it_price_type[wr_icon_img]){
						echo "<img src='$nfor[path]/data/price/$it_price_type[wr_icon_img]'>";
					} else{
					?>
					<span style="font-family:Arial; font-size:17px; font-weight:bold; color:#FFFFFF; line-height:38px; letter-spacing:-1px;"><?=$item[it_discount_rate]?></span><span style="font-family:Tahoma; font-size:12px; color:#FFFFFF;font-weight:bold;">%</span>
					<? } ?>
					</div>
				
					</td>
					<td style="line-height:14px;"><? if($item[it_price1]){ ?><s class="s_text"><?=number_format($item[it_price1])?>원</s><br><? } ?><span style="color: #444444;font: bold 18px/18px 'tahoma'"><?=number_format($item[it_price2])?></span><b style="color:#333333">원</b></s></td>
					<td align="right" valign="bottom"><span style="color:#ff5f1e; font-weight:bold;"><?=number_format($item[it_sales_volume])?></span><B>개 구매</B></td>
				</tr>
				</table>

			</td>
		</tr>
		<tr>
			<td style="border-top:solid 1px #f0f0f0;height:29px;">

			<table cellpadding="0" cellspacing="0" width="100%"  style="height:29px;">
			<tr>
				<td style="border-right:solid 1px #f0f0f0;padding-left:8px;" width="50%">

				<table cellpadding="0" cellspacing="0"  border="0"  bgcolor="#4c99f0" >
				<tr>
					<td style="line-height:18px;">&nbsp;<span style="font-size:11px; font-family:돋움; color:#ffffff; text-decoration:none; letter-spacing:-1px;"><?=delivery_type($item) // 무료배송, 착불배송, 조건배송, 유료배송 ?></span>&nbsp;</td>
				</tr>
				</table>								
				
				</td>
				<td style="padding-right:8px" align="right"><?=category_print($item[category_id])?>&nbsp;<img src="img/allow02.png" align="absmiddle"></td>
			</tr>
			</table>
			
			</td>
		</tr>
		</table>



	</td>
	<? 
	}	
	?>
	</tr>
	</table>

</td>
</tr>
</table>
</div>