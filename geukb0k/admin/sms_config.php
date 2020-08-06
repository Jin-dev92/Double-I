<?php	// 문자메시지설정
include "path.php";

if($mode=="update"){
	sql_query("update nfor_config set cf_sms_id='$cf_sms_id',cf_sms_pass='$cf_sms_pass',cf_ticket_send_cnt='$cf_ticket_send_cnt'");

	for($i=0; $i<count($wr_id); $i++){
		sql_query("update nfor_send set wr_msg='{$wr_msg[$i]}',wr_sms_use='{$wr_sms_use[$i]}' where wr_id='{$wr_id[$i]}'");
	}

	alert("정상적으로 수정되었습니다","sms_config.php");
	exit;
}

include "head.php";
?>
<form method="post" action="sms_config.php">
<input type="hidden" name="mode" value="update">

<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">문자메시지 환경설정</span></div>

<table class="tbl_type" border="1" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left"style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th scope="row">서비스신청</th>
	<td><a href="http://www.cafe24.com/?controller=product_page&type=special&page=sms" target="_blank">http://www.cafe24.com/?controller=product_page&type=special&page=sms</a></td>
</tr>
<tr>
	<th scope="row">잔여건수</th>
	<td><?=sms_count()?>건</td>
</tr>
<tr>
	<th scope="row">등록된발송번호</th>
	<td><?=sms_number()?>
	
	<span class="tex01">&nbsp;반드시 발송번호를 등록하셔야 발송이 가능합니다.</span>
	<a href="https://www.cafe24.com/?controller=myservice_hosting_sms_manage_caller" target="_blank" class="btn_sml"><span>발송번호등록</span></a>

	</td>
</tr>
<tr>
	<th scope="row">아이디</th>
	<td><input type="text" class="input_txt" name="cf_sms_id" value="<?=$config[cf_sms_id]?>" size="20" required itemname="SMS호스팅 아이디"><span class="tex01">&nbsp;SMS호스팅에서 발급된 아이디를 입력합니다.</span></td>
</tr>
<tr>
	<th scope="row">인증키</th>
	<td><input type="text" class="input_txt" name="cf_sms_pass" value="<?=$config[cf_sms_pass]?>" size="50" required itemname="SMS호스팅 패스워드"><span class="tex01">&nbsp;SMS호스팅에서 발급된 인증키를 입력합니다.</span></td>
</tr>
<tr>
	<th scope="row">티켓발송횟수 제한</th>
	<td><input type="text" class="input_txt" name="cf_ticket_send_cnt" value="<?=$config[cf_ticket_send_cnt]?>" style="width:30px" required numeric itemname="티켓발송횟수 제한">회
	<span class="tex01">&nbsp;사용자가 주문목록 관리에서 티켓발송할수 있는 횟수를 제한합니다.</span>
	</td>
</tr>
</table>

<br>

<table border="0" width="100%">
<tr>
	<td>

	<table border="0" width="100%">
	<tr>
		<?
		$i = 0;
		$que = sql_query("select * from nfor_send");
		while($data = sql_fetch_array($que)){
			if($i and $i%5==0) echo "</tr><tr>";
		?>
		<td>

			<table border="0">
			<tr>
				<td class="tex02"><img src="img/dot.gif" align="absmiddle"><?=$data[ca_name]?></td>
			</tr>
			<tr>
				<td>
				
				<input type="hidden" name="wr_id[<?=$i?>]" value="<?=$data[wr_id]?>">
				<table width='130' border='0' cellpadding='0' cellspacing='0'>
				<tr>
					<td align="center"><img src='./img/sms_bg_01.gif'></td>
				</tr>
				<tr>
					<td background='./img/sms_bg_02.gif' height='87' align="center">
					<textarea name="wr_msg[<?=$i?>]" rows='5' cols='16' style='background-color:transparent;overflow:hidden;border:0;font-family:돋움체;font-size:12px;color:#111111;' onkeyup="sms_count(this,'<?=$data[wr_code]?>')"><?=$data[wr_msg]?></textarea>
					</td>
				</tr>
				<tr>
					<td background='./img/sms_bg_03.gif' height='22' align="center" class="tex05">
					<span id="<?=$data[wr_code]?>"><?=strlen($data[wr_msg])?></span>byte / 최대 80byte</td>
				</tr>
				</table>
				
				</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="wr_sms_use[<?=$i?>]" value="1" <?=$data[wr_sms_use]?"checked":""?>>사용</td>
			</tr>
			</table>

		</td>
		<? 
			$i++;
		}		
		?>
	</tr>
	</table>

	<div class="btn_cen"><input type="image" src="img/con_btn.gif"></div>

	</td>
</tr>
</table>

</form>
<?php
include "tail.php";
?>