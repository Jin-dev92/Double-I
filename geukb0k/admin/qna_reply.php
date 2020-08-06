<?php
include_once "path.php";
$qna = sql_fetch("select * from nfor_item_qna where wr_id='$wr_id'");
?>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data" class="form_qna_reply">
<input type="hidden" name="mode" value="reply">
<input type="hidden" name="wr_reply" id="wr_reply" value="<?=$qna[wr_id]?>">
<input type="hidden" name="it_id" id="it_id" value="<?=$qna[it_id]?>">

<table class="tbl_type" border="0" cellspacing="0">
<colgroup>
<col width="130" align="center">
<col align="left"style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>아이디</th>
	<td><?=mb_info($qna[mb_no])?></td>
</tr>
<tr>
	<th>작성일자</th>
	<td><?=$qna[wr_datetime]?></td>
</tr>
<tr>
	<th>질문내용</th>
	<td><?=nl2br($qna[wr_memo])?></td>
</tr>
<tr>
	<th>답변내용</th>
	<td><textarea name="wr_memo" id="wr_memo" rows="10" style="width:300px"></textarea></td>
</tr>
</table>
<p align="center"><a href="javascript:qna_reply_submit()"><img src="img/dong_btn.gif" alt="답변하기"></a></p>
</form>