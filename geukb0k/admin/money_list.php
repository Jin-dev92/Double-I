<?php	// 적립금관리
include "path.php";

if($mode=="delete"){
	$data = sql_fetch("select * from nfor_money where wr_id='$wr_id'");
	sql_query("delete from nfor_money where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","money_list.php?$qstr");
	exit;
}

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		$data = sql_fetch("select * from nfor_money where wr_id='{$_POST['wr_id'][$k]}'");
		sql_query("delete from nfor_money where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","money_list.php?$qstr");
	exit;
}

if($mode=="insert"){

	if(!$mb_id) alert("아이디가 입력되지 않았습니다.");
	$mb = sql_fetch("select * from nfor_member where mb_id='$mb_id' or mb_email='$mb_id'");
	if(!$mb[mb_no]) alert("존재하지 않는 아이디입니다.");

	if(!$money) alert("부여적립금이 입력되지 않았습니다.");
	if(!$memo) alert("적립내용이 입력되지 않았습니다.");

	if($money < 0 and mb_money($mb[mb_no]) < $money*-1){ 
		alert("보유하신 적립금보다 입력하신 차감 적립금이 더 큽니다");		
	}

	insert_money($mb[mb_no], $money, $memo,'0','','',$end_datetime);	// end_datetime
	alert("입력하신 적립내용이 정상적으로 처리되었습니다","money_list.php?$qstr");
	exit;
}

$sql_common = " from nfor_money a, nfor_member b ";
$sql_search = " where a.mb_no=b.mb_no ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if($mb_no) $sql_search .= " and a.mb_no='$mb_no' ";
if(!$sst){
	$sst = "wr_id";
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

if($mb_no){
	$mb = sql_fetch("select * from nfor_member where mb_no='$mb_no'");
}
?>
<script type="text/javascript">
<!--
$(function(){
    $('#end_datetime').datetimepicker({
        showOn: 'button',
		buttonImage: 'img/calendar.gif',
		buttonImageOnly: true,
        buttonText: "달력",
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss'
    }); 

});	
//-->
</script>

<form name="fwrite" method="post" action="money_list.php">
<input type="hidden" name="mode" value="insert">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" cellpadding="0" cellspacing="0">
<tr>
	<th width="180">아이디</th> 
	<td><input type="text" class="input_txt" name="mb_id" value="<?=$mb[mb_id]?>" required itemname="아이디"></td>
</tr>
<tr>
	<th>부여적립금</th> 
	<td><input type="text" class="input_txt" name="money" style="width:80px;" required itemname="부여적립금">&nbsp;원</td>
</tr>
<tr>
	<th>적립내용</th> 
	<td><input type="text" class="input_txt" name="memo" style="width:350px;" required itemname="적립내용"></td>
</tr>
<tr>
	<th>만료일시</th> 
	<td><input type="text" class="input_txt" name="end_datetime" id="end_datetime"  itemname="만료일시"></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"></div>
</form>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50">
	<img src="img/dot.gif" align="absmiddle"><?
	if($stx){
		$s_money = sql_fetch("select sum(use_money) as s_money from nfor_money a, nfor_member b where a.mb_no=b.mb_no and $sfl like '%$stx%' and end_datetime >= '$nfor[ymdhis]'");
		echo "검색결과 유효 적립금 합계 : ".number_format($s_money[s_money])."원";
	} elseif($mb[mb_no]){ 
		echo $mb[mb_id]."(".($mb[mb_name]?$mb[mb_name]:"탈퇴회원").") 님 적립금 합계 : ".number_format(mb_money($mb[mb_no]))."원";
	} else{
		$row2 = sql_fetch(" select sum(use_money) as s_money from nfor_money where end_datetime >= '$nfor[ymdhis]' ");
		echo "전체 유효 적립금 합계 : " . number_format($row2[s_money])."원";
	}
	?>
	</td>
	<td align="right">
	<form name="fsearch" method="get" action="money_list.php">	
	<select name="sfl">
	<?
	$sfl_txt_array = array("아이디","적립내용","적립금액");
	$sfl_val_array = array("mb_id","memo","money");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">	
	</form>
	</td>
</tr>
</table>	

<form name="flist" id="flist" method="post" action="money_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>아이디</th>
	<th>이름</th>
	<th>적립내용</th>
	<th>부여적립금</th>
	<th>사용적립금</th>
	<th>남은적립금</th>
	<th>적립/사용일시</th>
	<th>만료일시</th>
	<th>삭제</th>
</tr>
<? 
for($i=0; $row=sql_fetch_array($result); $i++){
?>
<tr>
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$row[wr_id]?>"></td>
	<td><a href="money_list.php?mb_no=<?=$row[mb_no]?>&<?=$qstr?>"><?=$row[mb_id]?></a></td>
	<td><a href="javascript:member('<?=$row[mb_no]?>')"><?=$row[mb_name]?$row[mb_name]:"탈퇴회원"?></a></td>
	<td style="text-align:left; padding-left:10px;"><span class="tex02"><?=$row[memo]?></td>
	<td><? if($row[money]>0){ ?><?=number_format($row[money])?>원<? } ?></td>
	<td><? if($row[money]<0){ ?><?=number_format($row[money])?>원<? } ?></td>
	<td><? if($row[money]>0){ ?><?=number_format($row[use_money])?>원<? } ?></td>
	<td><?=$row[wr_datetime]?></td>
	<td><?=$row[end_datetime]?></td>
	<td><a href="javascript:del('money_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<? 
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<br><span class="tex01">사용적립금이 있는 적립이력을 삭제하면 유효적립금은 변경되지 않으며, 남은적립금이 이력이 있는 적립이력을 삭제시 유효적립금 또한 함께 삭제 되오니 주의해주시기 바랍니다</span>



<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a></div>
</form>


<?
include "tail.php";
?>