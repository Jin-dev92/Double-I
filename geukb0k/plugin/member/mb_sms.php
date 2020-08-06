<?php	// 문자보내기
include_once "path.php";

if($mode=="insert"){

	$fhp = $sms_send_hp1.$sms_send_hp2.$sms_send_hp3;
	$thp = $sms_send_hp4.$sms_send_hp5.$sms_send_hp6;
  
	if(sms_send($thp, $fhp, $sms_send_msg)){
		alert("문자발송에 성공하였습니다");
	} else{
		alert("문자발송에 실패하였습니다");
	}
	
	exit;
}

include_once "mb_head.php";

$mb_hp = explode("-",$mb[mb_hp]);
$cf_tel = explode("-",$config[cf_tel]);
?>

<form name="fwrite" method="post" action="mb_sms.php" onsubmit="return fsubmit(this)">
<input type="hidden" name="mode" value="insert">
<input type="hidden" name="mb_no" value="<?=$mb[mb_no]?>">
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="order_list_tbl9" align="center">
<tr>
	<th width="100">보내는번호</th>
	<td style="text-align:left;">
	<input type="text" name="sms_send_hp1" id="sms_send_hp1" style="width:40px" maxlength="4" value="<?=$cf_tel[0]?>"> -
	<input type="text" name="sms_send_hp2" id="sms_send_hp2" style="width:40px" maxlength="4" value="<?=$cf_tel[1]?>"> -
	<input type="text" name="sms_send_hp3" id="sms_send_hp3" style="width:40px" maxlength="4" value="<?=$cf_tel[2]?>">
	</td>
</tr>
<tr>
	<th>받는분번호</th>
	<td style="text-align:left;">
	<input type="text" name="sms_send_hp4" id="sms_send_hp4" style="width:40px" maxlength="4" value="<?=$mb_hp[0]?>"> -
	<input type="text" name="sms_send_hp5" id="sms_send_hp5" style="width:40px" maxlength="4" value="<?=$mb_hp[1]?>"> -
	<input type="text" name="sms_send_hp6" id="sms_send_hp6" style="width:40px" maxlength="4" value="<?=$mb_hp[2]?>">
	</td>
</tr>
<tr>
	<th>전송메세지</th>
	<td>
	
	<table class="tbl_typeC" width='130' border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td align="center"><img src='img/sms_bg_01.gif'></td>
	</tr>
	<tr>
		<td background='img/sms_bg_02.gif' height='87' align="center">
		<textarea name="sms_send_msg" id="sms_send_msg" rows='5' cols='16' style='background-color:transparent;overflow:hidden;border:0;font-family:돋움체;font-size:12px;color:#111111;' onkeyup="sms_count(this,'sms_send_msg_num')"></textarea>
		</td>
	</tr>
	<tr>
		<td background='img/sms_bg_03.gif' height='22' align="center" class="tex05">
		<span id="sms_send_msg_num">0</span>byte / Max 80byte</td>
	</tr>
	</table>

	</td>
</tr>
</table>
<br>
<p align="center"><input type="image" src="img/sand_btn.gif"></p>
<br>
</form>



<SCRIPT LANGUAGE="JavaScript">
<!--

function fsubmit(f){

	if(!$('#sms_send_hp4').val()){
		alert("받는분번호를 입력해주세요");
		$('#sms_send_hp4').focus();
		return false;
	}

	if(!$('#sms_send_hp5').val()){
		alert("받는분번호를 입력해주세요");
		$('#sms_send_hp5').focus();
		return false;
	}

	if(!$('#sms_send_hp6').val()){
		alert("받는분번호를 입력해주세요");
		$('#sms_send_hp6').focus();
		return false;
	}

	var hp_chk = /^\d{3}-\d{3,4}-\d{4}$/;
	var hp = $('#sms_send_hp4').val()+'-'+$('#sms_send_hp5').val()+'-'+$('#sms_send_hp6').val();
	if(!hp_chk.test(hp)){
		alert("받는분번호가 올바르지 않습니다");
		return false;
	}
	
	if(!$('#sms_send_msg').val()){
		alert("전송메시지를 입력해주세요");
		$('#sms_send_msg').focus();
		return false;
	}

	f.action = "mb_sms.php";
	return true;

}	

//-->
</SCRIPT>



<?
include "mb_tail.php";
?>