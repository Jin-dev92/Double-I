<?php	// 고객문의관리
include "path.php";

$qstr .= "&ca_name=$ca_name&wr_is_reply=$wr_is_reply";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_customer where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","customer_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	sql_query("delete from nfor_customer where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","customer_list.php?$qstr");
	exit;
} 

if($mode=="change"){
	sql_query("update nfor_customer set wr_is_reply='$wr_is_reply' where wr_id='$wr_id'");
	die("change");
	exit;
}

$sql_common = " from nfor_customer ";
$sql_search = " where 1 ";
if($wr_is_reply) $sql_search .= " and wr_is_reply='$wr_is_reply' ";
if($ca_name) $sql_search .= " and ca_name='$ca_name' ";
if($stx){
	if($sfl=="mb_id"){
		$mb = sql_fetch("select mb_no from nfor_member where {$nfor[id_type]}='$stx'");
		if($mb[mb_no]){
			$sql_search .= " and mb_no = '$mb[mb_no]' ";
		} else{
			$sql_search .= " and mb_no = '9999999999' ";
		}
	} else{
		$sql_search .= " and $sfl like '%$stx%' ";
	}
}
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
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function wr_is_reply(wr_id, wr_is_reply){
	if(wr_is_reply=="2"){
		str = "답변함";
	} else{
		str = "답변안함";
	}	
	if(confirm("답변상태를 "+str+"으로 변경하시겠습니까?")){
		$.ajax({
			type: "POST",
			url: "customer_list.php",
			data: "mode=change&wr_id="+wr_id+"&wr_is_reply="+wr_is_reply,
			success: function(response){				
				switch(response){	
					case 'change' : alert('상태가 변경되었습니다'); document.location.reload(); break;
				}
			}
		});
	}
}
//-->
</SCRIPT>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td>
	<form name="search" method="get" action="customer_list.php">
	<select name="ca_name" id="ca_name" onchange="search.submit()">
	<option value="">문의분류
	<?
	for($i=0; $i<count($nfor[faq]); $i++){
	?>	
	<option value="<?=$nfor[faq][$i]?>" <? if($ca_name==$nfor[faq][$i]) echo "selected"; ?>><?=$nfor[faq][$i]?>
	<? } ?>
	</select>
	<select name="wr_is_reply" id="wr_is_reply" onchange="search.submit()">
	<option value="">답변상태
	<? 
	$array_reply = array("","답변대기","답변완료");
	for($i=1; $i<count($array_reply); $i++){
	?>
	<option value="<?=$i?>" <?=$i==$wr_is_reply?"selected":""?>><?=$array_reply[$i]?>
	<? } ?>
	</select>
	</form>
	</td>
	<td height="50" align="right">
	<form name="fsearch" method="get">
	<input type="hidden" name="ca_name" value="<?=$ca_name?>">
	<input type="hidden" name="wr_is_reply" value="<?=$wr_is_reply?>">
	<select name="sfl">
	<?
	$sfl_txt_array = array("이름","연락처","이메일","아이디","제목","내용");
	$sfl_val_array = array("wr_name","wr_tel","wr_email","mb_id","wr_subject","wr_memo");
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

<form name="flist" id="flist" method="post" action="customer_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="ca_name" value="<?=$ca_name?>">
<input type="hidden" name="wr_is_reply" value="<?=$wr_is_reply?>">
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>제목</th>
	<th width="120">이름</th>
	<th width="120">날짜</th>
	<th width="100">답변상태</th>
	<th width="100">수정</th>
	<th width="100">삭제</th>
</tr>
<? for($i=0; $row=sql_fetch_array($result); $i++){ ?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$row[wr_id]?>"></td>
	<td style="text-align:left; padding:10px; word-break:break-all;"><span class="tex02"><?=$row[ca_name]?"[".$row[ca_name]."] ":" "?></span>&nbsp;<a href="customer_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>" class="left_menu"><?=cut_str($row[wr_subject],90)?></a></td>
	<td><a href="javascript:member('<?=$row[mb_no]?>')"><?=$row[wr_name]?></a><br><?=$row[wr_tel]?></td>
	<td><?=$row[wr_datetime]?></td>
	<td><?
	if($row[wr_is_reply]=="2"){	
		if($row[wr_reply_subject]){
			echo "<a href=\"#\" onclick=\"javascript:window.open('formmail.php?wr_type=customer&wr_id=$row[wr_id]','메일보내기','toolbar=no, width=600, height=500, left=0, top=0');\"><img src='img/ju_btn10.jpg' alt='답변보기'></a>";		
		} else{
			echo "<a href='javascript:wr_is_reply($row[wr_id],1)'><img src='img/ju_btn10.jpg' alt='답변완료'></a>";
		}
	} else{
		echo "<a href='javascript:wr_is_reply($row[wr_id],2)'><img src='img/ju_btn11.jpg' alt='답변대기'></a>";
	}
	?></td>
	<td><a href="customer_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="customer_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a></div>
</form>
<?
include "tail.php";
?>