<?php	// 지역구분설정 리스트
include "path.php";

if($is_admin <> "super") alert("최고 관리자만 접근 가능합니다","$nfor[path]/logout.php?url=admin/login.php");

if($mode=="insert"){
	sql_query("insert nfor_banner_group set wr_group='$wr_group', wr_code='$wr_code'");
} elseif($mode=="delete"){
	sql_query("delete from nfor_banner_group where wr_id='$wr_id'");
} elseif($mode=="update"){
	sql_query("update nfor_banner_group set wr_group='$wr_group', wr_code='$wr_code' where wr_id='$wr_id'");
}
?>
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th scope="col">그룹코드</th>	
	<th scope="col">그룹명</th>	
	<th scope="col">수정</th>
	<th scope="col">삭제</th>
</tr>
<?php
$que = sql_query("select * from nfor_banner_group order by wr_id");
while($data = sql_fetch_array($que)){
?>
<tr bgcolor="ffffff" align="center">	
	<td><?=$data[wr_code]?></td>
	<td><?=$data[wr_group]?></td>
	<td><a href="javascript:banner_update('<?=$data[wr_id]?>','<?=$data[wr_group]?>','<?=$data[wr_code]?>')"><img src='img/su_btn.gif' alt="수정"></a></td>
	<td><a href="javascript:banner_action('delete','<?=$data[wr_id]?>')"><img src='img/del_btn.gif' alt="삭제"></a></td>
</tr>
<?}?>
</table>