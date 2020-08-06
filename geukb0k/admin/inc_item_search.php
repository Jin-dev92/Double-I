
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50">

		전체 : <?=number_format($total_count)?>건, 
		판매중 : <?=number_format($sale_count)?>건

	</td>
	<td align="right">
	<form name="fsearch" method="get">



		<input type="hidden" name="category_id" id="insert_cate_id" value="<?=$category_id?>">


		<? if($member[is_supply]=="10"){ ?>
		<select name="supply_no" onchange="search.submit()">
			<option value=''>공급업체
			<?
			$que = sql_query("select * from nfor_member where is_supply='1'");
			while($data = sql_fetch_array($que)){
			?>
			<option value='<?=$data[mb_no]?>' <?=$data[mb_no]==$supply_no?"selected":""?>><?=$data[supply_name]?>
			<?}?>
		</select>
		<? } ?>


	<select name="it_view">
		<option value="">노출상태
		<option value="1" <?=$it_view=="1"?"selected":""?>>노출
		<option value="2" <?=$it_view=="2"?"selected":""?>>미노출
	</select>

	<select name="it_state">
		<option value="">노출상태
		<option value="1" <?=$it_state=="1"?"selected":""?>>판매중
		<option value="2" <?=$it_state=="2"?"selected":""?>>판매예정
		<option value="3" <?=$it_state=="3"?"selected":""?>>판매종료
	</select>


	<select id="category_1" class="multi_select">
	<option value="">==== 1차 분류 ====</option>
	<?
	$que = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='0' order by wr_rank asc");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[category_id]?>" <?=substr($category_id,0,3)==$data[category_id]?"selected":""?>><?=$data[wr_category]?>
	<? } ?>
	</select>	
	<select id="category_2" class="multi_select">
	<option value="">==== 2차 분류 ====</option>
	<?
	if(strlen($category_id)>=3){
		$que = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='1' and category_id like '".substr($category_id,0,3)."%' order by wr_rank asc");
		while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[category_id]?>" <?=substr($category_id,0,6)==$data[category_id]?"selected":""?>><?=$data[wr_category]?>
	<?
		} 
	}
	
	?>
	</select>
	<select id="category_3" class="multi_select">
	<option value="">==== 3차 분류 ====</option>
	<?
	if(strlen($category_id)>=6){
		$que = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='2' and category_id like '".substr($category_id,0,6)."%' order by wr_rank asc");
		while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[category_id]?>" <?=substr($category_id,0,9)==$data[category_id]?"selected":""?>><?=$data[wr_category]?>
	<?
		} 
	}	
	?>
	</select>
	<select id="category_4" class="multi_select" style="display:none;">
	<option value="">==== 4차 분류 ====</option>
	<?
	if(strlen($category_id)>=9){
		$que = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='3' and category_id like '".substr($category_id,0,9)."%' order by wr_rank asc");
		while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[category_id]?>" <?=substr($category_id,0,12)==$data[category_id]?"selected":""?>><?=$data[wr_category]?>
	<? 
		}
	}
	?>
	</select>




	<SCRIPT LANGUAGE="JavaScript">
	<!--
	$('.multi_select').change(category_change);
	//-->
	</SCRIPT>



	<select name="sfl">
	<?
	$sfl_txt_array = array("상품명","상품코드");
	$sfl_val_array = array("it_name","it_id");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">
	<a href="<?=$PHP_SELF?>?mode=excel&<?=$qstr?>"><img src="img/ex_down.gif" alt="엑셀다운" align="absmiddle"></a>
	</form>
	</td>
</TR>
</table>