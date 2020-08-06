<?php	// 인기검색어관리
include "path.php";

if($wr_id) $write = sql_fetch("select * from nfor_item_keyword where wr_id='$wr_id'");

if($mode=="insert"){	
	sql_query("insert nfor_item_keyword set wr_keyword='$wr_keyword'");
	alert("정상적으로 등록 되었습니다","item_keyword_list.php?$qstr");
	exit;
}

if($mode=="update"){
	sql_query("update nfor_item_keyword set wr_keyword='$wr_keyword' where wr_id='$wr_id'");
	alert("정상적으로 수정 되었습니다","item_keyword_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f){
	f.action = "item_keyword_form.php";
	return true;	    
}	
//-->
</SCRIPT>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[wr_id]?"update":"insert"?>">
<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>키워드</th>
	<td><input type="text" class="input_txt" name="wr_keyword" id="wr_keyword" value="<?=$write[wr_keyword]?>" style="width:100%;" required itemname="키워드"></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="item_keyword_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>
<?
include "tail.php";
?>