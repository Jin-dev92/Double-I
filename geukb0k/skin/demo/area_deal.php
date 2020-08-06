<?
include_once "path.php";
?>
<script type="text/javascript">
<!--
function myaera_list_fnc(area_id){
    $.ajaxSetup ({
        cache: false
    });
    var url = "area_deal.php?area_id=" + area_id;
    $("#my_area_list").load(url);
}
//-->
</script>
<style>
.tds_ov { background-position:center;padding:10px 0 4px;border:1px solid #e5e5e5;color:#4c4c4c;background-color:#ffffff; font-weight:bold; cursor:pointer; width:20%; }
.tds { padding:10px 0 4px;border:1px solid #e5e5e5;color:#4c4c4c;background-color:#ffffff; cursor:pointer; width:20%; }
</style>



<div id="my_area_list">

<table width="983" cellpadding="0" cellspacing="0" border="0" style="border-bottom:1px solid #dcdcdc;border-top:4px solid #aaadb1;font-family:'Verdana',dotum;font-size:12px;text-align:center;border-collapse:collapse;height:43px;">
<tr>
	<?
	$i = 1;
	$que = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='0' order by wr_rank desc");
	while($data = sql_fetch_array($que)){
		if($i==1 and !$area_id){
			$area_id = $data[area_id];
		}
	?>
	<td onclick="myaera_list_fnc('<?=$data[area_id]?>')" class="tds <?=$area_id==$data[area_id]?"tds_ov":""?>"><?=$data[wr_area]?></td>
	<? } ?>
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
	$sql = "select * from nfor_item where it_paydate <='$nfor[ymdhis]' and it_payenddate >='$nfor[ymdhis]' and area_id like '$area_id%' order by it_hit desc limit 6";	// 현제팔고 있는 상품중 판매시작일자가 가장 최근인것부터 6개 
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