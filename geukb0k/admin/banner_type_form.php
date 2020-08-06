<?php	// 배너그룹 추가
include "path.php";
if($is_admin <> "super") alert("최고 관리자만 접근 가능합니다","$nfor[path]/logout.php?url=admin/login.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>

	<input type="hidden" name="wr_id" id="wr_id">
	<table class="tbl_type" border="1" cellspacing="0">
	<colgroup>
		<col width="180" align="center">
		<col align="left" style="padding: 5px 0 0 10px;">
	</colgroup>
	<tr>
		<th scope="row">그룹코드</th>
		<td bgcolor="ffffff">
		<input type="text" name="wr_code" id="wr_code" class="input_txt">
		</td>
	</tr>
	<tr>
		<th scope="row">그룹명</th>
		<td bgcolor="ffffff">
		<input type="text" name="wr_group" id="wr_group" class="input_txt">
		</td>
	</tr>
	</table>
	<div class="btn_cen"><a href="javascript:banner_action('insert')"><img src="img/dong_btn.gif" id="banner_add_btn" alt="등록하기"></a> <a href="javascript:banner_action('update',$('#wr_id').val())"><img src="img/ji_btn02.gif" alt="수정하기" id="banner_edit_btn" style="display:none;"></div>

	<div id="banner_type_list" style="width:100%; height:320px; overflow-x:hidden; overflow-y:scroll;"><? include "banner_type_list.php"; ?></div>

	</td>
</tr>
</table>