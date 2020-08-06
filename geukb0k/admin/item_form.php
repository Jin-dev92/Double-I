<?php	// 상품등록
include "path.php";

$category_add_sql = "";
$it_category = "";
for($i=0; $i<count($cate_id); $i++){
	$it_category .= $cate_id[$i];
	$it_category .= "_";
}

for($i=0; $i<10; $i++){
	$k = $i+1;
	$category_add_sql .= ", category_id{$k} = '".$cate_id[$i]."'";
}

$list_php = str_replace("form","list",basename($PHP_SELF));

if(basename($PHP_SELF)=="delivery_item_form.php"){
	$it_delivery = 1;
} elseif(basename($PHP_SELF)=="ticket_item_form.php"){
	$it_delivery = 0;
} else{

}

if($mode=="copy" or $mode=="update"){
	$item = sql_fetch("select * from nfor_item where it_id='$it_id_copy'");
} elseif($mode=="update_form" or $mode=="copy_form"){
	$item = sql_fetch("select * from nfor_item where it_id='$it_id'");
} else{

}

if($item[it_id]){	
	if($member[is_supply]=="1" and $item[supply_no]<>$member[mb_no]) alert("권한이 없습니다");
	if($member[is_supply]=="2" and $item[md_no]<>$member[mb_no]) alert("권한이 없습니다");
}

if($mode=="insert"){

	if(!$it_id) alert("상품코드를 반드시 입력해주세요");
	$chk_it_id = sql_fetch("select it_id from nfor_item where it_id='$it_id'");
	if($chk_it_id[it_id]) alert("이미 존재하는 상품코드 입니다");
	$it_icon = "";
	for($i=0; $i<count($icon); $i++){
		if($i) $it_icon .= "|";
		$it_icon .= $icon[$i];
	}

	$add_sql .= it_img_upload("list_m","it_img_l_m");
	$add_sql .= it_img_upload("main","it_img_m1");
	$add_sql .= it_img_upload("main","it_img_m2");
	$add_sql .= it_img_upload("main","it_img_m3");
	$add_sql .= it_img_upload("main","it_img_m4");
	$add_sql .= it_img_upload("main","it_img_m5");
	$add_sql .= it_img_upload("extra","it_img_e1");
	$add_sql .= it_img_upload("extra","it_img_e2");
	$add_sql .= it_img_upload("extra","it_img_e3");
	$add_sql .= it_img_upload("extra","it_img_e4");
	$add_sql .= it_img_upload("extra","it_img_e5");
	$add_sql .= it_img_upload("list","it_img_l");
	$add_sql .= it_img_upload("premium","it_img_p");

	sql_query("insert nfor_item set 
								it_id_gp='$it_id_gp'
								, it_expiry_type='$it_expiry_type'
								, it_expiry_day='$it_expiry_day'
								, it_paydate='$it_paydate' 
								, it_payenddate='$it_payenddate'
								, it_name='$it_name'
								, it_price1='$it_price1'
								, it_price2='$it_price2'
								, it_discount_rate='$it_discount_rate'
								, it_discount_want='$it_discount_want'
								, it_stock='$it_stock'
								, it_buy_qty='$it_buy_qty'
								, it_memo='$it_memo'
								, supply_no='$supply_no'
								, md_no='$md_no'
								, it_icon='$it_icon'							
								, it_delivery='$it_delivery'
								, it_rule='$it_rule'
								, it_premium_use='$it_premium_use'
								, it_rss_use='$it_rss_use'
								, it_payment='$it_payment'
								, it_id='$it_id'
								, it_money_type='$it_money_type'
								, it_money_per='$it_money_per'
								, it_money='$it_money'
								, it_description='$it_description'
								, it_shopping='$it_shopping'
								, it_other='$it_other'
								, it_other_use='$it_other_use'
								, it_datetime=NOW()
								, it_ticket_type='$it_ticket_type'
								, ticket_when='$ticket_when'
								, it_startdate='$it_startdate'
								, it_enddate='$it_enddate'	
								, it_price_type='$it_price_type'
								, it_delivery_type='$it_delivery_type'
								, it_delivery_price='$it_delivery_price'
								, it_delivery_total='$it_delivery_total'
								, supply_price='$supply_price'
								, it_category='$it_category'
								, it_keyword='$it_keyword'
								, it_new_win='$it_new_win'
								, it_qna_secret='$it_qna_secret'
								, it_star_secret='$it_star_secret'
								$add_sql $category_add_sql");

	sql_query("insert nfor_item_option set it_id='$it_id', option_name1='$it_name', price='$it_price2', stock='$it_stock', option_type='1', supply_price='$supply_price'");

	keyword_insert($it_keyword);

	alert("정상적으로 등록되었습니다","$list_php?$qstr");
}


if($mode=="copy"){

	if(!$it_id) alert("상품코드를 반드시 입력해주세요");
	$chk_it_id = sql_fetch("select it_id from nfor_item where it_id='$it_id'");
	if($chk_it_id[it_id]) alert("이미 존재하는 상품코드 입니다");

	$it_icon = "";
	for($i=0; $i<count($icon); $i++){
		if($i) $it_icon .= "|";
		$it_icon .= $icon[$i];
	}

	$add_sql .= it_img_copy("list_m","it_img_l_m");
	$add_sql .= it_img_copy("main","it_img_m1");
	$add_sql .= it_img_copy("main","it_img_m2");
	$add_sql .= it_img_copy("main","it_img_m3");
	$add_sql .= it_img_copy("main","it_img_m4");
	$add_sql .= it_img_copy("main","it_img_m5");
	$add_sql .= it_img_copy("extra","it_img_e1");
	$add_sql .= it_img_copy("extra","it_img_e2");
	$add_sql .= it_img_copy("extra","it_img_e3");
	$add_sql .= it_img_copy("extra","it_img_e4");
	$add_sql .= it_img_copy("extra","it_img_e5");
	$add_sql .= it_img_copy("list","it_img_l");
	$add_sql .= it_img_copy("premium","it_img_p");

	// 옵션설정복사
	$add_sql .= ", it_opt_depth='$item[it_opt_depth]', it_option1='$item[it_option1]', it_option2='$item[it_option2]', it_option3='$item[it_option3]', it_option4='$item[it_option4]'";

	sql_query("insert nfor_item set 
								it_id_gp='$it_id_gp'
								, it_expiry_type='$it_expiry_type'
								, it_expiry_day='$it_expiry_day'
								, it_paydate='$it_paydate' 
								, it_payenddate='$it_payenddate'
								, it_name='$it_name'
								, it_price1='$it_price1'
								, it_price2='$it_price2'
								, it_discount_rate='$it_discount_rate'
								, it_discount_want='$it_discount_want'
								, it_stock='$it_stock'
								, it_buy_qty='$it_buy_qty'
								, it_memo='$it_memo'
								, supply_no='$supply_no'
								, md_no='$md_no'
								, it_icon='$it_icon'							
								, it_delivery='$it_delivery'
								, it_rule='$it_rule'
								, it_premium_use='$it_premium_use'
								, it_rss_use='$it_rss_use'
								, it_payment='$it_payment'
								, it_id='$it_id'
								, it_money_type='$it_money_type'
								, it_money_per='$it_money_per'
								, it_money='$it_money'
								, it_description='$it_description'
								, it_shopping='$it_shopping'
								, it_other='$it_other'
								, it_other_use='$it_other_use'
								, it_datetime=NOW()
								, it_ticket_type='$it_ticket_type'
								, ticket_when='$ticket_when'
								, it_startdate='$it_startdate'
								, it_enddate='$it_enddate'	
								, it_price_type='$it_price_type'
								, it_delivery_type='$it_delivery_type'
								, it_delivery_price='$it_delivery_price'
								, it_delivery_total='$it_delivery_total'
								, supply_price='$supply_price'
								, it_category='$it_category'
								, it_keyword='$it_keyword'
								, it_new_win='$it_new_win'
								, it_qna_secret='$it_qna_secret'
								, it_star_secret='$it_star_secret'
								$add_sql $category_add_sql");

	$que = sql_query("select * from nfor_item_option where it_id='$item[it_id]'");
	while($data = sql_fetch_array($que)){
		sql_query("insert nfor_item_option set it_id='$it_id', option_name1='$data[option_name1]',option_name2='$data[option_name2]',option_name3='$data[option_name3]',option_name4='$data[option_name4]', price='$data[price]', supply_price='$data[supply_price]', stock='$data[stock]', stock_now='$data[stock_now]', option_type='$data[option_type]', org_price='$data[org_price]' ");
	}

	sql_query("update nfor_item_option set option_name1='$it_name', price='$it_price2', stock='$it_stock', supply_price='$supply_price' where option_type='1' and it_id='$it_id'");

	keyword_insert($it_keyword);

	alert("정상적으로 등록되었습니다","$list_php?$qstr");
}


if($mode=="update"){

	if(!$it_id) alert("상품코드를 반드시 입력해주세요");
	if($it_id_copy<>$it_id){
		$chk_it_id = sql_fetch("select it_id from nfor_item where it_id='$it_id'");
		if($chk_it_id[it_id]) alert("이미 존재하는 상품코드 입니다");
	}
	$it_icon = "";
	for($i=0; $i<count($icon); $i++){
		if($i) $it_icon .= "|";
		$it_icon .= $icon[$i];
	}

	$add_sql .= it_img_upload("list_m","it_img_l_m");
	$add_sql .= it_img_upload("main","it_img_m1");
	$add_sql .= it_img_upload("main","it_img_m2");
	$add_sql .= it_img_upload("main","it_img_m3");
	$add_sql .= it_img_upload("main","it_img_m4");
	$add_sql .= it_img_upload("main","it_img_m5");
	$add_sql .= it_img_upload("extra","it_img_e1");
	$add_sql .= it_img_upload("extra","it_img_e2");
	$add_sql .= it_img_upload("extra","it_img_e3");
	$add_sql .= it_img_upload("extra","it_img_e4");
	$add_sql .= it_img_upload("extra","it_img_e5");
	$add_sql .= it_img_upload("list","it_img_l");
	$add_sql .= it_img_upload("premium","it_img_p");

	it_img_delete("list_m","it_img_l_m");
	it_img_delete("main","it_img_m1");
	it_img_delete("main","it_img_m2");
	it_img_delete("main","it_img_m3");
	it_img_delete("main","it_img_m4");
	it_img_delete("main","it_img_m5");
	it_img_delete("extra","it_img_e1");
	it_img_delete("extra","it_img_e2");
	it_img_delete("extra","it_img_e3");
	it_img_delete("extra","it_img_e4");
	it_img_delete("extra","it_img_e5");
	it_img_delete("list","it_img_l");
	it_img_delete("premium","it_img_p");

	sql_query("update nfor_item set 
								  it_id_gp='$it_id_gp'
								, it_expiry_type='$it_expiry_type'
								, it_expiry_day='$it_expiry_day'
								, it_paydate='$it_paydate' 
								, it_payenddate='$it_payenddate'
								, it_name='$it_name'
								, it_price1='$it_price1'
								, it_price2='$it_price2'
								, it_discount_rate='$it_discount_rate'
								, it_discount_want='$it_discount_want'
								, it_stock='$it_stock'
								, it_buy_qty='$it_buy_qty'
								, it_memo='$it_memo'
								, supply_no='$supply_no'
								, md_no='$md_no'
								, it_icon='$it_icon'							
								, it_delivery='$it_delivery'
								, it_rule='$it_rule'
								, it_premium_use='$it_premium_use'
								, it_rss_use='$it_rss_use'
								, it_payment='$it_payment'
								, it_id='$it_id'
								, it_money_type='$it_money_type'
								, it_money_per='$it_money_per'
								, it_money='$it_money'
								, it_description='$it_description'
								, it_shopping='$it_shopping'
								, it_other='$it_other'
								, it_other_use='$it_other_use'
								, it_ticket_type='$it_ticket_type'
								, ticket_when='$ticket_when'
								, it_startdate='$it_startdate'
								, it_enddate='$it_enddate'	
								, it_price_type='$it_price_type'
								, it_delivery_type='$it_delivery_type'
								, it_delivery_price='$it_delivery_price'
								, it_delivery_total='$it_delivery_total'
								, supply_price='$supply_price'
								, it_category='$it_category'
								, it_keyword='$it_keyword'
								, it_new_win='$it_new_win'
								, it_qna_secret='$it_qna_secret'
								, it_star_secret='$it_star_secret'
								$add_sql $category_add_sql
								where it_id='$it_id_copy'");
	

	sql_query("update nfor_item_option set option_name1='$it_name', price='$it_price2', stock='$it_stock', supply_price='$supply_price' where it_id='$it_id' and option_type='1'");

	keyword_insert($it_keyword);

	alert("정상적으로 수정되었습니다","$PHP_SELF?mode=update_form&$qstr&it_id=$it_id");
}

include "head.php";

echo cheditor1('it_payment', '100%', '150px');
echo cheditor1('it_rule', '100%', '150px');
echo cheditor1('it_memo', '100%', '150px');
?>
<SCRIPT LANGUAGE="JavaScript">
<!--

function fsubmit(f) {
	
	if($('#it_id').val()){
		alert('상품코드는 반드시 입력해주세요');
		$('#it_id').focus();
		return false;
	}

	if($('#it_payenddate').val() < $('#it_paydate').val()){
		alert('상품판매 종료일은 시작일과 같거나 이후부터 설정가능합니다');
		$('#it_payenddate').focus();
		return false;
	}

	if(parseInt($('#it_discount_want').val()) > parseInt($('#it_stock').val())){
		alert("할인조건이 재고수량(판매수량)보다 크면 안됩니다.");
		$('#it_stock').focus();
		return false;
	}

	if(parseInt($('#it_buy_qty').val()) > parseInt($('#it_stock').val())){
		alert("구매제한수량이 재고수량(판매수량)보다 크면 안됩니다.");
		$('#it_stock').focus();
		return false;
	}

    <?
    echo cheditor3('it_payment');
	echo cheditor3('it_rule');
	echo cheditor3('it_memo');
    ?>
	
	f.action = "<?=$PHP_SELF?>";
	return true;

}	

jQuery(function($){

	$('#it_startdate, #it_enddate').datetimepicker({

		showOn: 'button',
		buttonImage: 'img/calendar.gif',
		buttonImageOnly: true,
		buttonText: "달력",
		numberOfMonths: 1,
		closeText: '닫기',
		currentText: '오늘',
		changeMonth: true,
		showSecond: true,
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss'

	});

	$('#it_paydate, #it_payenddate').datetimepicker({

		showOn: 'button',
		buttonImage: 'img/calendar.gif',
		buttonImageOnly: true,
		buttonText: "달력",
		numberOfMonths: 1,
		closeText: '닫기',
		currentText: '오늘',
		changeMonth: true,
		showSecond: true,
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss'

	});

});

//-->
</SCRIPT>

<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?str_replace("_form", "", $mode):"insert"?>">
<input type="hidden" name="sfl"   value="<?=$sfl?>">
<input type="hidden" name="stx"   value="<?=$stx?>">
<input type="hidden" name="page"  value="<?=$page?>">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left"style="padding: 5px 0 0 10px;">
</colgroup>
<?
if($mode=="update_form"){
	$it_id_val = $item[it_id];
} else{
	$it_id_val = time();
}
?>
<tr>
	<th>상품코드</th>
	<td><input type="text" name="it_id" value="<?=$it_id_val?>" required itemname="상품코드" maxlength="20"> <input type="hidden" name="it_id_copy" value="<?=$item[it_id]?>"><? if($item[it_id]){ ?><a href="<?=$nfor[load]?>?it_id=<?=$item[it_id]?>" class="btn_sml" target="_blank"><span style="color:#ff0000">상품바로가기</span></a><? } ?></td>
</tr>
<tr>
	<th>상품그룹코드</th>
	<td>	
	<input type="text" name="it_id_gp" value="<?=$item[it_id_gp]?$item[it_id_gp]:$it_id_val?>" required itemname="상품그룹코드" maxlength="20"> 
	<span class="tex01">그룹코드를 함께쓰면 상품문의와 상품평이 공유됩니다.(변경시점이후 작성글부터 공유되며, 미입력시 상품코드와 동일하게 입력됩니다)</span>
	</td>
</tr>
<tr>
	<th>상품분류</th>
	<td>

	<style>
	.multi_select { height:120px; width:180px; }
	</style>
	<select multiple="" id="category_1" class="multi_select">
	<option value="">==== 1차 분류 ====</option>
	<?
	$que = sql_query("select * from nfor_item_category where wr_use='1' and wr_depth='0' order by wr_rank asc");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[category_id]?>"><?=$data[wr_category]?>
	<? } ?>
	</select>	
	<select multiple="" id="category_2" class="multi_select">
	<option value="">==== 2차 분류 ====</option>
	</select>
	<select multiple="" id="category_3" class="multi_select">
	<option value="">==== 3차 분류 ====</option>
	</select>
	<select multiple="" id="category_4" class="multi_select">
	<option value="">==== 4차 분류 ====</option>
	</select>

	<br>
	<div id="span_select_preview" style="display:none;">선택된 상품분류 : <span id="select_preview"></span> <input type="button" value="추가" onclick="category_add()"></div>

	<input type="hidden" name="insert_cate_id" id="insert_cate_id">
	<br>

	<table id="category_add_list" class="tbl_type" border="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" class="category_all"></th>
		<th>선택상품분류</th>
		<th>분류코드</th>
		<th>삭제</th>
	</tr>
	<?
	if(trim($item[it_category])){
	$it_category_exp = explode("_",trim($item[it_category]));
	for($i=0; $i<count($it_category_exp)-1; $i++){
		$cate_id = $it_category_exp[$i];
		$catename = sql_fetch("select * from nfor_item_category where category_id='$cate_id'");
	?>
	<tr>
		<td><input type='hidden' class='cate_id' name='cate_id[]' value='<?=$cate_id?>'><input type='checkbox' class='category_ea'></td>
		<td><?=category_id_name($cate_id)?></td>
		<td><?=$cate_id?></td>
		<td><a href='#self' onclick='category_row_delete(this)' class='btn_sml'><span>삭제</span></a></td>
	</tr>
	<?
	}
	}
	?>
	<tbody>
	</tbody>
	</table>

	<input type="button" value="선택분류삭제" class="category_remove">


	<script type="text/javascript">
	<!--
	$('.multi_select').change(category_change).change(category_preview);

	$(".category_all").click( function() {
		$(".category_ea").prop("checked",this.checked);
	});

	$('.category_remove').click( function() {
		if(!$('input.category_ea:checked').length){
			alert("삭제할 상품분류를 선택해주세요");
			return;
		}
		$('input.category_ea:checked').each(function(){
		   $(this).parent().parent().remove();
		});
	});
	function category_row_delete(obj){
		$(obj).parent().parent().remove();
	} 

	function category_add(){

		if($(".cate_id").length >= 10){
			alert("옵션은 db성능개선을 위해 10개까지만 추가 가능합니다");
			return;
		}

		var cate_id = $("#insert_cate_id").val();

		var is_select = 0;
		$('.cate_id').each(function(){
			if($(this).val()==cate_id){
				is_select = 1;
			}
		});
		if(is_select){
			alert('이미 선택한 항목입니다.');
			return;
		}

		var select_preview = "";
		for(var k = 1; k <= 4; k++){

			if($("#category_"+k+" option:selected").val()){
				if(k>1){
					select_preview = select_preview + " > ";
				}
				select_preview = select_preview + $("#category_"+k+" option:selected").text();
			}

		}

		$("#category_add_list > tbody:last").append("<tr><td><input type='hidden' class='cate_id' name='cate_id[]' value='"+cate_id+"'><input type='checkbox' class='category_ea'></td><td>"+select_preview+"</td><td>"+cate_id+"</td><td><a href='#self' onclick='category_row_delete(this)' class='btn_sml'><span>삭제</span></a></td></tr>");
	}

	function category_preview(){

		var select_preview = "";
		for(var k = 1; k <= 4; k++){

			if($("#category_"+k+" option:selected").val()){
				if(k>1){
					select_preview = select_preview + " > ";
				}
				select_preview = select_preview + $("#category_"+k+" option:selected").text();
			}

		}

		$("#select_preview").html(select_preview);

		if($("#select_preview").html()){
			$("#span_select_preview").show();
		} else{
			$("#span_select_preview").hide();
		}
	}

	//-->
	</script>


	</td>
</tr>
<tr>
	<th>상품명</th>
	<td>		
		<input type="text" class="input_txt" name="it_name" value="<?=$item[it_name]?>" style="width:99%;" required itemname="상품명">	
	</td>
</tr>
<tr>
	<th>상품간단설명</th>
	<td><input type="text" class="input_txt" name="it_description" value="<?=$item[it_description]?>" style="width:99%;" required itemname="상품간단설명"></td>
</tr>
<tr>
	<th>키워드</th>
	<td>
	<input type="text" class="input_txt" name="it_keyword" value="<?=$item[it_keyword]?>" style="width:99%;" required itemname="키워드"> 
		<span class="tex01">콤마(,)로 구분하여 입력하며 본 정보는 검색시 관련 데이터로 활용됩니다.  예) 화장품, 립스틱</span>

	</td>
</tr>
<tr>
	<th>대표가격설정</th>
	<td>
	<select name="it_price_type" itemname="기준가격">
	<option value="">기준가격
	<?
	$que = sql_query("select * from nfor_price");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[wr_id]?>" <? if($item[it_price_type]==$data[wr_id]) echo "selected"; ?>><?=$data[wr_icon]?>
	<?}?>
	</select>

	정상가격 : <input type="text" class="input_txt" name="it_price1" id="it_price1" onkeyup="it_discount_rate_fnc()" value="<?=$item[it_price1]?>" style="width:60px;" required numeric itemname="정상가격">원, 
	판매가격 : <input type="text" class="input_txt" name="it_price2" id="it_price2" onkeyup="it_discount_rate_fnc()" value="<?=$item[it_price2]?>" style="width:60px;" required numeric itemname="판매가격">원, 

	공급가격 : <input type="text" class="input_txt" name="supply_price" id="supply_price" value="<?=$item[supply_price]?>" style="width:60px;" required numeric itemname="공급가격">원, 

	할인조건 : <input type="text" class="input_txt" name="it_discount_want" id="it_discount_want" value="<?=$item[it_discount_want]?>" style="width:30px;" required numeric itemname="할인조건">명 이상이면 할인,
	할인율 : <input type="text" class="input_txt" name="it_discount_rate" id="it_discount_rate" value="<?=$item[it_discount_rate]?>" style="width:30px;" required numeric itemname="할인율">%,
	
	개인구매제한 : <input type="text" class="input_txt" name="it_buy_qty" id="it_buy_qty" value="<?=$item[it_buy_qty]?>" style="width:30px;" required numeric itemname="개인구매제한">개,
	전체판매수량 : <input type="text" class="input_txt" name="it_stock" id="it_stock" value="<?=$item[it_stock]?>" style="width:50px;" required numeric itemname="전체판매수량">개<? if($item[it_id]){ ?>, 판매된수량 : <?=number_format(it_sales_volume($item[it_id]))?>개<? } ?>

	</td>
</tr>



<tr>
	<th>판매기간</th>
	<td>
	<input type="text" class="input_txt" name="it_paydate" id="it_paydate" value="<?=$item[it_paydate]?>" style="width:120px;" required itemname="판매시작일자">
	<input type="text" class="input_txt" name="it_payenddate" id="it_payenddate" value="<?=$item[it_payenddate]?>" style="width:120px;" required itemname="판매종료일자">

	<input type="hidden" name="now_datetime" id="now_datetime" value="<?=date("Y-m-d 00:00:00")?>">
	<input type="hidden" name="end_datetime" id="end_datetime" value="2020-12-31 00:00:00">
	<input type="checkbox" name="it_shopping" id="it_shopping" value="1" <?=$item[it_shopping]?"checked":""?>  onclick="if (this.checked == true){ this.form.it_paydate.value=this.form.now_datetime.value; this.form.it_payenddate.value=this.form.end_datetime.value; } else{ this.form.it_paydate.value = this.form.it_paydate.defaultValue; this.form.it_payenddate.value = this.form.it_payenddate.defaultValue; } "> 판매기간 없이 판매할경우 체크
	</td>
</tr>


<tr>
	<th>상품상세정보</th>
	<td><?=cheditor2('it_memo', $item[it_memo]);?></td>
</tr>
<tr>
	<th>주문및배송안내</th>
	<td><?=cheditor2('it_payment', $item[it_payment]);?></td>
</tr>
<tr>
	<th>상품정보제공</th>
	<td><?=cheditor2('it_rule', $item[it_rule]);?></td>
</tr>





<? if(basename($PHP_SELF)=="ticket_item_form.php"){ ?>

<tr>
	<th>티켓발급형태</th>
	<td>
	<input type="radio" name="it_ticket_type" value="0" <? if(!$item[it_ticket_type]) echo "checked"; ?>>자동
	<input type="radio" name="it_ticket_type" value="1" <? if($item[it_ticket_type]) echo "checked"; ?>>수동
	<span class="tex01">&nbsp;※ 자동 : 프로그램상에서 자동으로 발급되는 티켓번호, 수동 : 관리자가 임의로 지정하여 보내는 티켓번호 </span>
	</td>
</tr>
<tr>
	<th>티켓사용기간</th>
	<td>

		<input type="radio" name="it_expiry_type" id="it_expiry_type1" value="1" onclick="$('#it_expiry_day_div').show(); $('#it_expiry_date_div').hide();" <? if($item[it_expiry_type]=="1" or !$item[it_expiry_type]) echo "checked"; ?>> <label for="it_expiry_type1">구매일기준</label>
		<input type="radio" name="it_expiry_type" id="it_expiry_type2" value="2" onclick="$('#it_expiry_day_div').hide(); $('#it_expiry_date_div').show();" <? if($item[it_expiry_type]=="2") echo "checked"; ?>> <label for="it_expiry_type2">지정일기준</label>

		<div id="it_expiry_day_div" <? if($item[it_expiry_type]=="2") echo " style='display:none;'"; ?>>
		결제일로부터 <input type="text" class="input_txt" name="it_expiry_day" id="it_expiry_day" value="<?=$item[it_expiry_day]?>" style="width:30px;" numeric itemname="일">일까지 사용가능
		</div>
		
		<div id="it_expiry_date_div" <? if($item[it_expiry_type]=="1" or !$item[it_expiry_type]) echo " style='display:none;'"; ?>>
		<input type="text" class="input_txt" name="it_startdate" id="it_startdate" value="<?=$item[it_startdate]?>" style="width:120px;" itemname="티켓사용시작일자">
		<input type="text" class="input_txt" name="it_enddate" id="it_enddate" value="<?=$item[it_enddate]?>" style="width:120px;" itemname="티켓사용만료일자">
		</div>

	</td>
</tr>
<tr style="display:none;">
	<th>티켓다운시점</th>
	<td>	
	<input type="radio" name="ticket_when" value="1" <? if(!$item[ticket_when] or $item[ticket_when]=="1") echo "checked"; ?>>상품판매 종료일 이후
	<input type="radio" name="ticket_when" value="2" <? if($item[ticket_when]=="2") echo "checked"; ?>>구매조건 충족시	
	</td>
</tr>
<? } else{ ?>

<tr>
	<th>배송비조건</th>
	<td>

		<input type="radio" name="it_delivery_type" value="1" onclick="it_delivery_type_chg(1)" <?=!$item[it_delivery_type] || $item[it_delivery_type]=="1"?"checked":""?>>무료배송
		<input type="radio" name="it_delivery_type" value="2" onclick="it_delivery_type_chg(2)" <?=$item[it_delivery_type]=="2"?"checked":""?>>착불배송
		<input type="radio" name="it_delivery_type" value="3" onclick="it_delivery_type_chg(3)" <?=$item[it_delivery_type]=="3"?"checked":""?>>조건배송
		<input type="radio" name="it_delivery_type" value="4" onclick="it_delivery_type_chg(4)" <?=$item[it_delivery_type]=="4"?"checked":""?>>유료배송<br>

		<div id="delivery1" class="delivery" style="<?=$item[it_delivery_type]=="3" || $item[it_delivery_type]=="4"?"":"display:none;"?>">
		배송금액 : <input type="text" class="input_txt" name="it_delivery_price" id="it_delivery_price" value="<?=$item[it_delivery_price]?>" style="width:60px;" numeric itemname="배송금액">원<br>
		</div>

		<div id="delivery2" class="delivery" style="<?=$item[it_delivery_type]=="3"?"":"display:none;"?>">
		배송상품일때, 주문금액이 <input type="text" class="input_txt" name="it_delivery_total" id="it_delivery_total" value="<?=$item[it_delivery_total]?>" style="width:60px;" numeric itemname="배송비무료">원 이상이면 배송비 무료
		</div>
	
		<script type="text/javascript">
		<!--
		function it_delivery_type_chg(type){
			if(type=="0" || type=="1" || type=="2"){
				$(".delivery").hide();
			} else if(type=="3"){
				$(".delivery").show();			
			} else if(type=="4"){
				$("#delivery1").show();
				$("#delivery2").hide();
			} else{

			}
			
		}
		//-->
		</script>


	</td>
</tr>

<? } ?>




<?
if($member[is_supply]>"1"){
?>
<tr>
	<th>공급업체 <? if($is_admin){ ?><a href="supply_list.php" class="btn_sml"><span>+추가</span></a><? } ?></th>
	<td>
	<select name="supply_no" itemname="공급업체">
	<option value="">선택
	<?
	$que = sql_query("select supply_name, mb_name, mb_no from nfor_member where is_supply='1'");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[mb_no]?>" <? if($item[supply_no]==$data[mb_no]) echo "selected"; ?>><?=$data[mb_name]?><?=$data[supply_name]?" - ".$data[supply_name]:""?> 
	<?}?>
	</select>
	</td>
</tr>
<? } else{ ?>
<input type="hidden" name="supply_no" value="<?=$item[supply_no]?$item[supply_no]:$member[mb_no]?>">
<? } ?>


<?
if($member[is_supply]>"2"){
?>
<tr>
	<th>담당MD <a href="md_list.php" class="btn_sml"><span >+추가</span></a></th>
	<td>
	<select name="md_no" itemname="담당MD">
	<option value="">선택
	<?
	$que = sql_query("select mb_name, mb_no from nfor_member where is_supply='2'");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[mb_no]?>" <? if($item[md_no]==$data[mb_no]) echo "selected"; ?>><?=$data[mb_name]?>
	<?}?>
	</select>
	</td>
</tr>
<?
} else{
?>
<input type="hidden" name="md_no" value="<?=$item[md_no]?$item[md_no]:$member[mb_no]?>">
<? } ?>

<tr style="display:none;">
	<th>관련상품임의지정 <INPUT TYPE="checkbox" NAME="it_other_use" value="1" <?=$item[it_other_use]?"checked":""?>></th>
	<td>
	<a href="javascript:it_select('fwrite','it_other');" class="btn_sml"><span>관련상품검색</span></a>
	<span class="tex01">&nbsp;※ 상품코드만 입력하셔야 하며 구분자는 | 입니다</span><br>
	<textarea name="it_other" id="it_other" rows="4" style="width:100%"><?=$item[it_other]?></textarea>
	</td>
</tr>
<!--
<tr>
	<th>옵션설정</th>
	<td>
	<input type="checkbox" name="it_rss_use" value="1" <? if($item[it_rss_use]) echo "checked"; ?>>rss 노출안함, 

	</td>
</tr> -->
<tr>
	<th>적립금</th>
	<td>
	적립금 : 
	<input type="radio" name="it_money_type" value="1" onclick="$('#it_money_per_div').show(); $('#it_money_div').hide();" <? if($item[it_money_type]=="1" or !$item[it_money_type]) echo "checked"; ?>>주문합산 퍼센트 %
	<input type="radio" name="it_money_type" value="2" onclick="$('#it_money_per_div').hide(); $('#it_money_div').show();" <? if($item[it_money_type]=="2") echo "checked"; ?>>임의지정금액

	<span class="tex01">공급업체에서 티켓사용시 또는 상품 배송일괄처리시 적립금이 반영됩니다.</span>

	<div id="it_money_per_div" <? if($item[it_money_type]=="2") echo " style='display:none;'"; ?>>
	<input type="text" class="input_txt" name="it_money_per" id="it_money_per" value="<?=$item[it_money_per]?>" style="width:30px;" numeric itemname="적립금(퍼센트)">%
	</div>
	
	<div id="it_money_div" <? if($item[it_money_type]=="1" or !$item[it_money_type]) echo " style='display:none;'"; ?>>
	<input type="text" class="input_txt" name="it_money" id="it_money" value="<?=$item[it_money]?>" style="width:90px;" numeric itemname="적립금(원)">원
	</div>

	</td>
</tr>

<tr style="display:none;">
	<th>프리미엄 상품</th>
	<td>


	<input type="radio" name="it_premium_use" value="0" onclick="$('#premium_div').hide()" <? if(!$item[it_premium_use]) echo "checked"; ?>>사용안함 
	<input type="radio" name="it_premium_use" value="1" onclick="$('#premium_div').show()" <? if($item[it_premium_use]) echo "checked"; ?>>사용 
	<div id="premium_div" style="<? if(!$item[it_premium_use]) echo "display:none;"; ?>">
	<input type="file" name="it_img_p"  class="input_txt">
	<? if($item[it_img_p]){ ?><input type="checkbox" name="it_img_p_del" value="1"><img src="<?=$nfor[path]?>/data/premium/<?=$item[it_img_p]?>" height="19"><? } ?>
	<span class="tex01"> 배너형태로 상품을 한번더 노출하기 위한 이미지 업로드 필드입니다 </span>
	</div>


	</td>
</tr>

<tr>
	<th>상품메인 이미지 <?=$nfor[it_img_m1][x] && $nfor[it_img_m1][y]?"(".$nfor[it_img_m1][x]."x".$nfor[it_img_m1][y].")":""?></th>
	<td>

	<table border="0" cellpadding="0" cellspacing="2" class="tbl_typeC">
	<tr>
		<td><input type="file" name="it_img_m1" class="input_txt"><? if($item[it_img_m1]){ ?><input type="checkbox" name="it_img_m1_del" value="1"><img src="<?=$nfor[path]?>/data/main/<?=$item[it_img_m1]?>" height="19"><? } ?></td>
	</tr>
	</table>

	</td>
</tr>


<tr>
	<th>상품메인기타 이미지 <?=$nfor[it_img_m2][x] && $nfor[it_img_m2][y]?"(".$nfor[it_img_m2][x]."x".$nfor[it_img_m2][y].")":""?></th>
	<td>

	<table border="0" cellpadding="0" cellspacing="2" class="tbl_typeC">
	<tr>
		<td><input type="file" name="it_img_m2" class="input_txt"> <? if($item[it_img_m2]){ ?><input type="checkbox" name="it_img_m2_del" value="1"><img src="<?=$nfor[path]?>/data/main/<?=$item[it_img_m2]?>" height="19"><? } ?></td>
		<td><input type="file" name="it_img_m3" class="input_txt"><? if($item[it_img_m3]){ ?><input type="checkbox" name="it_img_m3_del" value="1"><img src="<?=$nfor[path]?>/data/main/<?=$item[it_img_m3]?>" height="19"><? } ?></td>
		<td><input type="file" name="it_img_m4" class="input_txt"><? if($item[it_img_m4]){ ?><input type="checkbox" name="it_img_m4_del" value="1"><img src="<?=$nfor[path]?>/data/main/<?=$item[it_img_m4]?>" height="19"><? } ?></td>
		<td><input type="file" name="it_img_m5" class="input_txt"><? if($item[it_img_m5]){ ?><input type="checkbox" name="it_img_m5_del" value="1"><img src="<?=$nfor[path]?>/data/main/<?=$item[it_img_m5]?>" height="19"><? } ?></td>
	</tr> 
	</table>

	</td>
</tr>

<tr>
	<th>상품리스트 이미지 <?=$nfor[it_img_l][x] && $nfor[it_img_l][y]?"(".$nfor[it_img_l][x]."x".$nfor[it_img_l][y].")":""?></th>
	<td>

	<input type="file" name="it_img_l"  class="input_txt">
	<? if($item[it_img_l]){ ?><input type="checkbox" name="it_img_l_del" value="1"><img src="<?=$nfor[path]?>/data/list/<?=$item[it_img_l]?>" height="19"><? } ?>

	</td>
</tr>
<tr>
	<th>리스트 이미지(모바일)</th>
	<td>

		<input type="file" name="it_img_l_m" class="input_txt">		
		<? if($item[it_img_l_m]){ ?><input type="checkbox" name="it_img_l_m_del" value="1"><img src="<?=$nfor[path]?>/data/list_m/<?=$item[it_img_l_m]?>"  height="19"><? } ?>

	</td>
</tr>



<!-- 


<tr>
	<th>여분 이미지</th>
	<td>

		<table border="0" cellpadding="0" cellspacing="2" class="tbl_typeC">
		<tr>
		<td><input type="file" name="it_img_e1" class="input_txt"><? if($item[it_img_e1]){ ?><input type="checkbox" name="it_img_e1_del" value="1"><img src="<?=$nfor[path]?>/data/extra/<?=$item[it_img_e1]?>" height="19"><? } ?></td>
		<td><input type="file" name="it_img_e2" class="input_txt"><? if($item[it_img_e2]){ ?><input type="checkbox" name="it_img_e2_del" value="1"><img src="<?=$nfor[path]?>/data/extra/<?=$item[it_img_e2]?>" height="19"><? } ?></td>
		<td><input type="file" name="it_img_e3" class="input_txt"><? if($item[it_img_e3]){ ?><input type="checkbox" name="it_img_e3_del" value="1"><img src="<?=$nfor[path]?>/data/extra/<?=$item[it_img_e3]?>" height="19"><? } ?></td>
		<td><input type="file" name="it_img_e4" class="input_txt"><? if($item[it_img_e4]){ ?><input type="checkbox" name="it_img_e4_del" value="1"><img src="<?=$nfor[path]?>/data/extra/<?=$item[it_img_e4]?>" height="19"><? } ?></td>
		<td><input type="file" name="it_img_e5" class="input_txt"><? if($item[it_img_e5]){ ?><input type="checkbox" name="it_img_e5_del" value="1"><img src="<?=$nfor[path]?>/data/extra/<?=$item[it_img_e5]?>" height="19"><? } ?></td>
		</tr> 
		</table>

	</td>
</tr> -->
<tr style="display:none;">
	<th>여분 필드</th>
	<td>
			<input type="text" class="input_txt" name="it_extra1" value="<?=$item[it_extra1]?>" itemname="여분 필드">	
			<input type="text" class="input_txt" name="it_extra2" value="<?=$item[it_extra2]?>" itemname="여분 필드">	
			<input type="text" class="input_txt" name="it_extra3" value="<?=$item[it_extra3]?>" itemname="여분 필드">	
			<input type="text" class="input_txt" name="it_extra4" value="<?=$item[it_extra4]?>" itemname="여분 필드">	
			<input type="text" class="input_txt" name="it_extra5" value="<?=$item[it_extra5]?>" itemname="여분 필드">	
	</td>
</tr>




<tr>
	<th>새창</th>
	<td>
	<input type="checkbox" name="it_new_win" id="it_new_win" value="1" <?=$item[it_new_win]?"checked":""?>> <label for="it_new_win">체크시 상품목록(PC)에서 새창으로 링크</label>
	</td>
</tr>


<tr>
	<th>상품문의 비공개</th>
	<td>
	<input type="checkbox" name="it_qna_secret" id="it_qna_secret" value="1" <?=$item[it_qna_secret]?"checked":""?>> <label for="it_qna_secret">체크시 상품문의 비공개</label>
	</td>
</tr>


<tr>
	<th>구매후기 비공개</th>
	<td>
	<input type="checkbox" name="it_star_secret" id="it_star_secret" value="1" <?=$item[it_star_secret]?"checked":""?>> <label for="it_star_secret">체크시 구매후기 비공개</label>
	</td>
</tr>



<!-- 
<tr>
	<th>체크포인트 이미지&nbsp;<a href="check_point_list.php"class="btn_sml"><span >+추가</span></a></th>
	<td>

		<?
		$i = 0;
		$explode = explode("|",$item[it_icon]);
		$que = sql_query("select * from nfor_check_point order by wr_id");
		while($data = sql_fetch_array($que)){
			if($i and $i%6==0) echo "<br>";
		?>
		<input type='checkbox' name='icon[]' value='<?=$data[wr_id]?>' <?=strlen(array_search($data[wr_id], $explode))?"checked":""?>> <img src="<?=$nfor[path]?>/data/icon/<?=$data[wr_icon_img]?>">
		<?
			$i++;
		}	
		?>		
	</td>
</tr> -->
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"  value="<?=$item[it_id]?"상품수정":"상품삭제"?>"> <? if($item[it_id]){ ?><a href="<?=$list_php?>?<?=$qstr?>"><img src="img/list.gif"></a><? } ?></div>
</form>




<?
include "tail.php";
?>
