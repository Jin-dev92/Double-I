<?php	// 문자메시지발송
include "path.php";

$qstr .= "&ca_name=$ca_name";

if($wr_id) $write = sql_fetch("select * from nfor_sms where wr_id='$wr_id'");

if($mode=="change"){

	if($ca_name=="연령별회원"){
		for($i=0; $i<count($nfor[age]); $i++){
			$data2[$nfor[age][$i]] = $nfor[age][$i];
		}
	}

	if($ca_name=="성별회원"){
		for($i=0; $i<count($nfor[sex]); $i++){
			$data2[$nfor[sex][$i]] = $nfor[sex][$i];
		}
	}

	if($ca_name=="지역별회원"){
		$que = sql_query("select * from `nfor_zipcode` group by sido order by zipcode");
		while($data = sql_fetch_array($que)){
			$data2[$data[sido]] = $data[sido];
		}
	}


	echo json_encode($data2);	
	exit;
}

if($mode){

	if(!$ca_name) alert("발송대상을 선택하세요");
	if(!$wr_memo) alert("문자내용을 입력하셔야 이용가능합니다");

	if($mode=="insert"){
		sql_query("insert nfor_sms set ca_name='$ca_name', wr_memo='$wr_memo', wr_datetime=NOW(), send_hp='$send_hp', who='$who'");
		alert("정상적으로 등록되었습니다","sms_list.php?$qstr");
	}

	if($mode=="update"){
		sql_query("update nfor_sms set ca_name='$ca_name', wr_memo='$wr_memo', send_hp='$send_hp', who='$who' where wr_id='$wr_id'");
		alert("정상적으로 등록되었습니다","sms_form.php?wr_id=$wr_id&$qstr");
	}
	exit;
}

include "head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function fsubmit(f) {

	if(!$("#ca_name").val()){
		alert("발송대상을 선택해주세요");
		$("#ca_name").focus();
		return false;
	}

	if(!$("#wr_memo").val()){
		alert("문자내용을 입력해주세요");
		$("#wr_memo").focus();
		return false;
	}


	f.action = "sms_form.php";
	return true;
}	
function ca_name_fnc(){

	$.ajax({
	   type: "POST",
	   url: "sms_form.php",
	   data: "mode=change&ca_name="+$('#ca_name').val(),
	   success: function(msg){

			var msg = eval('(' + msg + ')'); 
			var obj = $("#who").get(0); 
			var j = 0;
			obj.options.length = j; 

			if(msg){
				$.each(msg, function(key,val) { 
					obj.options[j] = new Option(val,key); 
					j++; 
				}); 
			}
			if(j>0){
				$('#who').show();	
			} else{
				$('#who').hide();	
			}
			
	   }
	});
	
}
//-->
</SCRIPT>
<form name="fwrite" method="post" onsubmit="return fsubmit(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$write[wr_id]?"update":"insert"?>">
<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table class="tbl_type" border="0" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>발송대상</th>
	<td>

		<select name="ca_name" id="ca_name" onchange="ca_name_fnc()">
		<option value="">발송대상
		<?	
		if($it_id or $write[it_id]){
			if($write[it_id]){
				$write[ca_name] = "앵콜회원";
			}
			array_push($nfor[send],"앵콜회원");
		}
		for($i=0; $i<count($nfor[send]); $i++){
		?>
		<option value="<?=$nfor[send][$i]?>" <?=$nfor[send][$i]==$write[ca_name]?"selected":""?>><?=$nfor[send][$i]?>
		<?}?>
		</select>


		<select name="who" id="who" <?=$write[who]?"":"style='display:none;'"?>>
		<option value="">선택해주세요
		<?
		if($write[who]){

			if($write[ca_name]=="연령별회원"){
				for($i=0; $i<count($nfor[age]); $i++){
					$data2[] = $nfor[age][$i];
				}
			}

			if($write[ca_name]=="성별회원"){
				for($i=0; $i<count($nfor[sex]); $i++){
					$data2[] = $nfor[sex][$i];
				}
			}

			if($write[ca_name]=="지역별회원"){
				$que = sql_query("select * from `nfor_zipcode` group by sido order by zipcode");
				while($data = sql_fetch_array($que)){
					$data2[] = $data[sido];
				}
			}

			for($i=0; $i<count($data2); $i++){
		?>
		<option value="<?=$data2[$i]?>" <?=$data2[$i]==$write[who]?"selected":""?>><?=$data2[$i]?>
		<? 
			}
		}
		?>
		</select>

	</td>
</tr>
<tr>
	<th>문자내용</th>
	<td>
	<table class="tbl_typeC" border="0" cellspacing="0">
	<tr><td align="center"><img src='./img/sms_bg_01.gif'></td></tr>
	<tr><td background='./img/sms_bg_02.gif' height='87' align="center"><textarea name="wr_memo" id="wr_memo" rows='5' cols='16' style='background-color:transparent;overflow:hidden;border:0;font-family:돋움체;font-size:12px;color:#111111;' onkeyup="sms_count(this,'wr_memo_num')"><?=$write[wr_memo]?></textarea></td></tr>
	<tr><td background='./img/sms_bg_03.gif' height='22' align="center"><span id='wr_memo_num'><?=strlen($write[wr_memo])?></span>Byte / 최대 80Byte</td></tr>
	</table>
	</td>
</tr>
<tr>
	<th>발송번호임의지정</th>
	<td><input type="text" name="send_hp" id="send_hp" value="<?=$write[send_hp]?$write[send_hp]:$config[cf_tel]?>"></td>
</tr>
</table>
<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="sms_list.php?<?=$qstr?>"><img src="img/list.gif"></a></div>
</form>


<pre>
정보통신망법 개정에 따라 광고성 정보 전송에 대한 제한이 더욱 엄격해 졌습니다.
이메일, SMS 등 광고성 정보 전송 시 아래 사항을 유의하시기 바랍니다.


 ◆ 광고성 정보 수신동의 여부에 대한 기한
2014년 11월 29일부터 광고성 정보 전송자의 정기적인 수신동의 여부 확인 의무규정(정보통신망법 제50조 제8항)이 시행됨에 따라 수신동의 후 매 2년마다(법 시행 이전에 광고성 정보 수신동의를 받은 자는 2016년 11월 28일 까지) 수신 동의자에게 수신동의 여부를 확인하셔야 합니다.
(이를 확인하지 않는 경우 3천만원 이하의 과태료가 부과될 수 있습니다.)


 ◆ 수신거부 및 수신동의 철회 
- 광고성 정보 수신자가 수신거부 의사를 표시하거나, 사전 수신 동의를 철회한 경우 광고성 정보의 전송이 금지됩니다.
- 수신의 거부 및 수신동의 철회의 의사표시를 쉽게 할 수 있는 조치 및 방법을 광고본문에 표기하여 구체적으로 밝혀야 합니다.
- 동 조치 및 방법으로 수신의 거부 또는 수신동의 철회가 쉽게 이루어지지 않거나 불가능할 경우에는 이를 표기하지 않은 것으로 간주합니다.

1) 광고메일의 수신거부
수신자가 본문 내에 "[수신거부]" 등을 눌러 곧바로 수신거부 또는 수신동의의 철회를 간단히 할 수 있도록 기술적 조치를 하여야 하며, 로그인을 요구하는 등 다른 정보를 요구하여 절차를 번거롭게 하지 말아야 합니다.
이러한 안내문과 기술적 조치는 한글 및 영문으로 명시하여야 합니다.
※ 카페24 대량메일 서비스의 '수신거부' 기능은 위 법령을 모두 준수하고 있습니다.

2) 광고 sms의 수신거부
수신거부 또는 수신동의의 철회용 전화번호 또는 전화에 갈음하여 쉽게 수신의 거부 또는 수신동의 철회를 할 수 있는 방식을 광고성 정보가 끝나는 부분에 명시하여야 합니다.
수신의 거부 또는 수신동의의 철회를 할 수 있는 방식을 수신자가 비용을 부담하지 아니한다는 것과 함께 안내하여야 합니다.


기타 자세한 내용은 아래를 참고하세요.
http://spam.kisa.or.kr/kor/notice/dataList.jsp
</pre>
<?
include "tail.php";
?>