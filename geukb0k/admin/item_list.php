<?php	// 상품리스트
include_once "path.php";

include_once "inc_item_update.php";

include_once "head.php";
?>	

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50">
	<form method="post" action="<?=$PHP_SELF?>" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="update">
	<input type="file" name="delivery_upload" class="input_txt">
	<INPUT TYPE="image" src="img/ex_up.gif" align="absmiddle">
	<a href="<?=$nfor[path]?>/sample/option_sample.xls"><span class="tex01"># 업로드 엑셀양식 다운로드</span></a>
	</form>
	</td>
</tr>
</table>

<?
include_once "inc_item_search.php";
?>

<form name="flist" id="flist" method="post">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="area_id" value="<?=$area_id?>">
<input type="hidden" name="category_id" value="<?=$category_id?>">
<input type="hidden" name="supply_no" value="<?=$supply_no?>">	
<input type="hidden" name="it_view" value="<?=$it_view?>">
<input type="hidden" name="it_state" value="<?=$it_state?>">	
<table class="tbl_typeB">
<tr align="center">
	<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>상품코드</th>
	<th>판매기간</th>
	<th>상품이미지</td>
	<th>상품정보</th>
	<th>판매가격</th>
	<th>할인정보</th>
	<th>재고량</th>
	<th>판매량</th>

	<? if($it_delivery){ ?>
	<th>배송비</th>
	<? } else{ ?>
	<th>사용처관리</th>
	<? } ?>

	<th>기본옵션관리</th>
	<th>추가옵션관리</th>



	<th>상품복사</th>
	<th>수정</th>
	<th>삭제</th>
</tr>
<?
for($i=0; $row=sql_fetch_array($result); $i++){
	$add_option = sql_fetch("select count(*) as cnt from nfor_item_option where it_id='$row[it_id]' and option_type='0' and option_select>'0'");
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#ffffff">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="it_id[<?=$i?>]" value="<?=$row[it_id]?>"></td>
	<td><?=$row[it_id]?></td>
	<td><?=substr($row[it_paydate],0,10)?><br><?=substr($row[it_payenddate],0,10)?></td>
	<td><a href="<?="$nfor[path]/$nfor[load]"?>?it_id=<?=$row[it_id]?>" target="_blank"><img src="<?=thumbnail("$nfor[path]/data/list/$row[it_img_l]","100","","0","1")?>" width="100"></a></td>
	<td style="text-align:left; padding-left:10px;">
	<?=$row[it_name]?><br><br>
	<?
	if(trim($row[it_category])){
	$it_category_exp = explode("_",trim($row[it_category]));
	for($i=0; $i<count($it_category_exp)-1; $i++){
		$cate_id = $it_category_exp[$i];
		$catename = sql_fetch("select * from nfor_item_category where category_id='$cate_id'");
	?>
	<?=category_id_name($cate_id)?><br>
	<?
	}
	}
	?>
	</td>
	<td><s><?=number_format($row[it_price1])?>원</s><br><?=number_format($row[it_price2])?>원</td>
	<td><?=number_format($row[it_discount_want])?>명이상<br><?=$row[it_discount_rate]?>% 할인</td>
	<td><?=number_format($row[it_stock])?>개</td>
	<td><?=number_format($row[it_sales_volume])?>개</td>
	
	<? if($it_delivery){ ?>
	<td>
	<?
		if(!$row[it_delivery_type] || $row[it_delivery_type]=="1"){
			echo "무료배송";
		} elseif($row[it_delivery_type]=="2"){
			echo "착불배송";
		} elseif($row[it_delivery_type]=="3"){
			echo number_format($row[it_delivery_price])."원";
			echo "<br>";
			echo "(".number_format($row[it_delivery_total])."원이상 무료)";
		} elseif($row[it_delivery_type]=="4"){
			echo number_format($row[it_delivery_price])."원";
		} else{
			
		}
		
	?>
	</td>
	<? } else{ ?>
	<td><a href="item_location_list.php?it_id=<?=$row[it_id]?>&<?=$qstr?>" class="btn_sml"><span>사용처관리</span></a></td>
	<? } ?>

	<td><a href="<?=str_replace("item","option",basename($PHP_SELF))?>?it_id=<?=$row[it_id]?>&<?=$qstr?>" style="color:<?=$row[it_opt_depth]?"red":"blue"?>;" class="btn_sml"><span><?=$row[it_opt_depth]?"기본옵션 사용":"기본옵션 미사용"?></span></a></td>

	<td><a href="<?=str_replace("item","add_option",basename($PHP_SELF))?>?it_id=<?=$row[it_id]?>&<?=$qstr?>" style="color:<?=$add_option[cnt]?"red":"blue"?>;" class="btn_sml"><span><?=$add_option[cnt]?"추가옵션 사용":"추가옵션 미사용"?></span></a></td>









	<td><a href="<?=str_replace("list","form",basename($PHP_SELF))?>?mode=copy_form&it_id=<?=$row[it_id]?>&<?=$qstr?>"><img src="img/copybtn.gif"></a></td>
	<td><a href="<?=str_replace("list","form",basename($PHP_SELF))?>?mode=update_form&it_id=<?=$row[it_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('<?=$PHP_SELF?>?mode=delete&it_id=<?=$row[it_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="<?=str_replace("list","form",basename($PHP_SELF))?>"><img src="img/dong_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>