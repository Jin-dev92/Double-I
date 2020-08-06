<?php	// 관련상품검색
include "path.php";
include "$nfor[path]/html_head.php";

$qstr .= "&frm=$frm&fid=$fid&it_value=$it_value";

$sql_common = " from nfor_item ";
$sql_search = " where (1) ";

if($it_value){

	$exp = explode("|",$it_value);
	for($i=0; $i<count($exp); $i++){
		$sql_search .= " and it_id <> '".$exp[$i]."'";
	}

}

if($stx) $sql_search .= " and $sfl like '%$stx%' ";

if(!$sst){
    $sst = "it_rank";
    $sod = "asc";
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
if (!$page) $page = 1;
$from_record = ($page - 1) * $rows;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

?>


<table width="100%" cellpadding="0" cellspacing="0" align="center">
<tr>
	<td width="50%" valign="top">
	

		<table width="100%" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td>
			<form name="fsearch" method="post">
			<input type="hidden" name="frm" value="<?=$frm?>">
			<input type="hidden" name="fid" value="<?=$fid?>">
			<input type="hidden" name="page" id="page" value="<?=$page?>">
			<textarea name="it_value" class="it_value_list" id="it_value_list" rows="4" style="display:none;"><?=$it_value?></textarea>
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
			</form>
			</td>
		</TR>
		</table>


		<form name="flist" id="flist" method="post">
		<table class="tbl_typeB">
		<tr align="center">
			<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
			<th>상품코드</th>
			<th>이미지</td>
			<th>상품명</th>
			<th>판매가격</th>
		</tr>
		<?
		for($i=0; $row=sql_fetch_array($result); $i++){
		?>
		<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
			<td><input type="checkbox" name="chk[]" value="<?=$row[it_id]?>"></td>
			<td><?=$row[it_id]?></td>
			<td><img src="<?=thumbnail("$nfor[path]/data/list/$row[it_img_l]","100","","0","1")?>" width="30"></td>
			<td><?=$row[it_name]?></td>
			<td><?=number_format($row[it_price2])?>원</td>
		</tr>
		<?
		}
		$pagelist = get_paging_it_select($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
		?>
		</table>
		<div class="btn_cen"><?=$pagelist?></div>
		<input type="button" value="선택추가" onclick="it_value_list_add()">
		</form>

	
	</td>
	<td width="50%" valign="top">
	

		<table class="tbl_typeB">
		<tr align="center">
			<th>상품코드</th>
			<th>이미지</td>
			<th>상품명</th>
			<th>판매가격</th>
			<th>삭제</th>
		</tr>
		<?
		if($it_value){
			$exp = explode("|",trim($it_value));
			for($i=0; $i<count($exp); $i++){
			$row = sql_fetch("select * from nfor_item where it_id='{$exp[$i]}'");
		?>
		<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
			<td><input type="hidden" name="it_id" class="it_id" value="<?=$row[it_id]?>"><?=$row[it_id]?></td>
			<td><img src="<?=thumbnail("$nfor[path]/data/list/$row[it_img_l]","100","","0","1")?>" width="30"></td>
			<td><?=$row[it_name]?></td>
			<td><?=number_format($row[it_price2])?>원</td>
			<td><a href='javascript:void(0)' onClick='delfld(this)'>삭제</a></td>
		</tr>
		<?
			}
		}
		?>
		</table>
		<div class="btn_cen"><input type="button" value="선택등록" onclick="it_value_list_update()"></div>


	</td>
</tr>
</table>







<SCRIPT LANGUAGE="JavaScript">
<!--
function it_select_page(page){
	$('#page').val(page);
	document.fsearch.submit();
}	

function delfld(obj){
	var tb = obj.parentNode.parentNode.parentNode.parentNode;
	tb.deleteRow(obj.parentNode.parentNode.rowIndex);
	var it_value_list = "";
	var i = 0;
	$(".it_id").each(function(){
		if(it_value_list){
			it_value_list += "|";
		}
		it_value_list = it_value_list+$(this).val();
		i = i + 1;
	});
	$('.it_value_list').val(it_value_list);
}

function it_value_list_add(){
	var it_value_list = $('#it_value_list').val();
	var i = 0;
	$("input[name='chk[]']:checked").each(function(){
		if(it_value_list){
			it_value_list += "|";
		}
		it_value_list = it_value_list+$(this).val();
		i = i + 1;
	});
	$('.it_value_list').val(it_value_list);
	document.fsearch.submit();
}	

function it_value_list_update(){
	opener.document.<?=$frm?>.<?=$fid?>.value = $('#it_value_list').val();
	close();
}	
//-->
</SCRIPT>


<?php
include "$nfor[path]/html_tail.php";
?>