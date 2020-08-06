<?php	// 배송업체설정
include "path.php";

if($wr_id){
	$write = sql_fetch("select * from nfor_delivery where wr_id='$wr_id'");
}

if($mode=="insert"){
	if(!$wr_rank){
		$max_wr_rank = sql_fetch("select * from nfor_delivery order by wr_rank limit 1");
		$wr_rank = $max_wr_rank[wr_rank]-1;
	} else{
		$wr_rank = $wr_rank*-1;
	}
	sql_query("insert nfor_delivery set wr_name='$wr_name', wr_url='$wr_url', wr_tel='$wr_tel', wr_rank='$wr_rank', wr_use='$wr_use'");
	alert("정상적으로 등록되었습니다","delivery_list.php?$qstr");
	exit;
}

if($mode=="update"){
	$wr_rank = $wr_rank*-1;
	sql_query("update nfor_delivery set wr_name='$wr_name',wr_url='$wr_url',wr_tel='$wr_tel', wr_rank='$wr_rank', wr_use='$wr_use' where wr_id='$wr_id'");
	alert("정상적으로 수정되었습니다","delivery_form.php?wr_id=$wr_id&$qstr");
	exit;
}

include "head.php";
?>
<form name="fwrite" method="post" action="delivery_form.php" enctype="multipart/form-data">
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
	<th scope="row">배송업체명</th> 
	<td><input type="text"  class="input_txt" name="wr_name" style="width:200px" value="<?=$write[wr_name]?>" required itemname="배송업체명"></td>
</tr>
<tr>
	<th scope="row">추적경로</th> 
	<td><input type="text"  class="input_txt" name="wr_url" style="width:68%" value="<?=$write[wr_url]?>" required itemname="추적경로"></td>
</tr>
<tr>
	<th scope="row">콜센터</th> 
	<td><input type="text"  class="input_txt" name="wr_tel" style="width:100px" value="<?=$write[wr_tel]?>" required itemname="콜센터"></td>
</tr>
<tr>
	<th scope="row">출력순위</th> 
	<td><input type="text" class="input_txt" name="wr_rank" value="<?=$write[wr_rank]?$write[wr_rank]*-1:""?>" style="width:40px;" required numeric itemname="출력순위">
	<span class="tex01">※숫자가 높을 수록 우선 출력됩니다.(10 또는 20단위로 순위를 정하시면 좋습니다)</span></td>
</tr>
<tr>
	<th scope="row">출력여부</th> 
	<td><INPUT TYPE="checkbox" NAME="wr_use" value="1" <? if($write[wr_use]) echo "checked"; ?>></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="delivery_list.php?<?=$qstr?>"><img src="img/list.gif" alt="목록보기"></a></div>
</form>
<?php
include "tail.php";
?>