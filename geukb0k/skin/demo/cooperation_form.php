<?php
include_once $nfor[skin_path]."cus_head.php";
?>




		<form name="fwrite" method="post" onsubmit="return cooperation_check(this);" enctype="multipart/form-data">
		<input type="hidden" name="mode" value="insert">
		<table cellpadding="0" cellspacing="0" border="0" class="common_form_tbl cooperation_form">
		<tr>
			<th>분류</th>
			<td colspan="3">
			<select name="ca_name" class="sel ca_name">
			<option value="">문의분류
			<?
			for($i=0; $i<count($nfor[cooperation]); $i++){
			?>	
			<option value="<?=$nfor[cooperation][$i]?>"><?=$nfor[cooperation][$i]?>
			<? } ?>
			</select>	
			</td>
		</tr>
		<tr>
			<th>회사명</th>
			<td colspan="3"><input type="text" name="wr_company" class="inp wr_company"></td>
		</tr>
		<tr>
			<th>담당자명</th>
			<td><input type="text" name="wr_name" class="inp wr_name" value="<?=$member[mb_name]?>"></td>
			<th>담당자 연락처</th>
			<td>
			<input type="text" name="wr_tel1" class="inp wr_tel1" size="4" maxlength="4"> - 			
			<input type="text" name="wr_tel2" class="inp wr_tel2" size="4" maxlength="4"> -
			<input type="text" name="wr_tel3" class="inp wr_tel3" size="4" maxlength="4">
			</td>
		</tr>
		<tr>
			<th>담당자 이메일</th>
			<td colspan="3"><input type="text" name="wr_email" class="inp wr_email" value="<?=$member[mb_email]?>"></td>
		</tr>
		<tr>
			<th>홈페이지</th>
			<td colspan="3"><input type="text" name="wr_homepage" class="inp wr_homepage"></td>
		</tr>
		<tr>
			<th>제목</th>
			<td colspan="3"><input type="text" name="wr_subject" class="inp wr_subject"></td>
		</tr>
		<tr>
			<th>내용</th>
			<td colspan="3"><textarea name="wr_memo" class="inp wr_memo"></textarea></td>
		</tr>
		<tr>
			<th>첨부파일</th>
			<td colspan="3"><input type="file" name="wr_upload" class="inp"></td>
		</tr>
		<tr>
			<td colspan="4">
			<input type="checkbox" name="agree_chk" class="agree_chk" checked="checked"> 개인정보 수집, 이용에 동의합니다
			</td>
		</tr>
		</table>

		<div class="bottom_btn">
		<button class="inquiryBtn" type="submit">문의하기</button>
		</div>
		</form>



<?
include_once $nfor[skin_path]."cus_tail.php";
?>