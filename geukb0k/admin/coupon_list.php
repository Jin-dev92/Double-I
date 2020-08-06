<?
include "path.php";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_coupon where cp_id='{$_POST['cp_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","coupon_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	if(!$cp_id) alert("쿠폰번호가 넘어오지 않았습니다");
	sql_query("delete from nfor_coupon where cp_id='$cp_id'");
	alert("정상적으로 삭제 되었습니다","coupon_list.php?$qstr");
	exit;
} 

$sql_common = " from nfor_coupon ";
$sql_search = " where (1) ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if(!$sst){
	$sst = "cp_id";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
						 $sql_common
						 $sql_search
						 $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
			  $sql_common
			  $sql_search
			  $sql_order
			  limit $from_record, $rows ";
$result = sql_query($sql);

include "head.php";

$array_cp_type = array("","개별상품할인","카테고리할인","주문금액할인","배송비할인");

?>

<form name="fsearch" method="get">
<p align="right">
<select name="sfl">
<?
$sfl_txt_array = array("쿠폰명");
$sfl_val_array = array("cp_name");
for($i=0; $i<count($sfl_txt_array); $i++){
?>
<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
<? } ?>
</select>
<input type="text" name="stx" value="<?=$stx?>">
<input type="image" src="img/gum_btn.gif" align="absmiddle">
</form>

<br>

<form name="flist" id="flist" method="post" action="coupon_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="0" cellspacing="0" class="tbl_typeB">
<tr align="center">
	<th><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>쿠폰종류</th>
	<th>쿠폰명</th>




	<th>적용대상</th>


	<th>발급대상</th>

	<th>할인금액</th>

	<th>사용기간</th>
	<th>사용여부</th>

	<th>수정</th>
	<th>삭제</th>
</tr>
<?	for($i=0; $row=sql_fetch_array($result); $i++){	?>
<tr bgcolor="#ffffff" align="center">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="cp_id[<?=$i?>]" value="<?=$row[cp_id]?>"></td>
	<td><?=$array_cp_type[$row[cp_type]]?></td>
	<td><?=$row[cp_name]?></td>




	<td>
	<?=$row[cp_it_id]?>
	<?=$row[cp_category_id]?>
	</td>


	<td><?=$row[cp_all]=="1"?"전체":mb_id($row[cp_mb_no])?></td>


	<td><?
	if($row[cp_pay_type]=="1"){
		echo number_format($row[cp_coupon_price])."원";
	} else{
		echo number_format($row[cp_coupon_per])."%";
	}
	?></td>

	<td><?=$row[cp_sdate]?>~<?=$row[cp_edate]?></td>
	<td><?
		if($row[cp_use]){
			echo "사용";
			if($row[cp_use]>1){
				echo "(".number_format($row[cp_use]).")";
			}
		} else{
			echo "미사용";
		}
		?></td>
	<td><a href="coupon_form.php?cp_id=<?=$row[cp_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>

	<td><a href="javascript:del('coupon_list.php?mode=delete&cp_id=<?=$row[cp_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<? 									
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");							
?>
</table>
<br><p align="center"><?=$pagelist?>
<br><br><p align="center"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a>&nbsp;&nbsp;<a href="coupon_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a>
</form>

<?
include "tail.php";
?>
