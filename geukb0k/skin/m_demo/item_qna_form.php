<?php
include_once $nfor[skin_path]."head.php";
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function() {
	document.smsForm2.sphone1.value='070';
	document.smsForm2.sphone2.value='7618';
	document.smsForm2.sphone3.value='2199';
});


	$(document).on("click", ".btn_item_qna_submit", function(){

	$.ajax({
		type: "post",
		data : $("#fitem_qna_form").serialize(),
		url: "item_qna_form.php",
		success: function(response){
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){
				location.href="item.php?it_id=<?=$write[it_id]?$write[it_id]:$it_id?>";
			} else{
				alert(json["msg"]);
			}
		}
	});
	document.smsForm2.rphone.value='010-2800-7184';

	$.ajax({
		type : "post"
		, url : "../../skin/demo/sms_send.php"
		, cache : false
		, data : $("#smsForm2").serialize()
	});


	document.smsForm2.rphone.value='010-4929-0776';

	$.ajax({
		type : "post"
		, url : "../../skin/demo/sms_send.php"
		, cache : false
		, data : $("#smsForm2").serialize()
	});

});
//-->
</SCRIPT>


<style>
.wrap_item_qna_form { margin:0px; padding:10px 10px; width:100%; box-sizing:border-box; -webkit-box-sizing:border-box;  }

.row { margin-bottom:5px; }
.wrap_qna_btn {  width:100%; }
.wrap_qna_btn li { width:50%; float:left; box-sizing:border-box; -webkit-box-sizing:border-box; }
.wrap_qna_btn li:nth-child(1){ padding:10px 5px 10px 0px;  }
.wrap_qna_btn li:nth-child(2){ padding:10px 0px 10px 5px;  }

.qna_msg { color:#888; font-size:13px; letter-spacing:-1px; }
.qna_msg b { font-weight:normal; color:#ec3940; }
.sms_msg { color:#666; font-size:14px; letter-spacing:-1px; }

.btn_item_qna_cancel { border:solid 1px #e5e5e5; background-color:#fff; height:34px; color:#444; font-size:15px; line-height:34px; display:block; text-align:center; }
.btn_item_qna_submit { border:solid 1px #ec3940; background-color:#ec3940; height:34px; color:#fff; font-size:15px; line-height:34px; display:block; text-align:center; padding:0px; margin:0px; }
</style>

<div class="wrap_item_qna_form">

<form name="fitem_qna_form" id="fitem_qna_form" method="post">
<input type="hidden" name="mode" value="<?=$write[wr_id]?"update":"insert"?>">
<input type="hidden" name="wr_id" value="<?=$write[wr_id]?>">
<input type="hidden" name="it_id" value="<?=$write[it_id]?$write[it_id]:$it_id?>">
<input type="hidden" name="wr_reply" value="<?=$wr_reply?>">
<div class="row">
	<span class="qna_msg">배송/결제/취소/반품 문의는 <b>1:1상담</b>을 이용해주세요.</span>
</div>
<div class="row">
	<textarea name="wr_memo" class="wr_memo" placeholder="문의 내용을 입력해주세요"><?=$write[wr_memo]?></textarea>
</div>
<!-- <div class="row">
	<input type="checkbox" name="wr_sms" id="wr_sms" value="1" <?=$write[wr_sms]?"checked":""?>><label for="wr_sms" class="sms_msg"> <?=$member[mb_hp]?>로 SMS 알림 받기</label>
</div> -->
<div class="row">
	<ul class="wrap_qna_btn">
		<li><a href="javascript:history.back()" class="btn_item_qna_cancel">취소</a></li>
		<li><input type="button" value="<?=$nfor[btn_txt]?>" class="btn_item_qna_submit"></li>
	</ul>
	<div style="clear:both;"></div>
</div>
<div class="row">
	<span class="qna_msg">마이페이지 > 상품문의댓글에서 내가 남긴 상품문의의 답변을 쉽게 찾아볼수 있습니다.</span>
</div>
</form>

</div>

<form method="post" id="smsForm2" name="smsForm2" action="../../skin/demo/sms_send.php" target="_blank" style="display: none;">
    <br />받는 번호 <input type="text" name="rphone" value=""> 예) 011-011-111 , '-' 포함해서 입력.

    <br />
    보내는 번호  <input type="hidden" name="sphone1" value="010">
    <input type="hidden" name="sphone2" value="2800">
    <input type="hidden" name="sphone3" value="7184">
    <span id="sendPhoneList"></span>
    <br /> test flag <input type="text" name="testflag" maxlength="1" value=""> 예) 테스트시: Y
    <br />nointeractive <input type="text" name="nointeractive" maxlength="1"> 예) 사용할 경우 : 1, 성공시 대화상자(alert)를 생략.

            <br>
    <input type="submit" value="전송" id="sms_btn">
    <input type="hidden" name="action" value="go">
    발송타입 <span><input type="radio" name="smsType" value="S" checked>단문(SMS)</span>
    <!-- <span><input type="radio" name="smsType" value="L">장문(LMS)</span> --> <br />
    <!-- 제목 : <input type="text" name="subject" value="제목"> 장문(LMS)인 경우(한글30자이내)<br /> -->
    전송메세지
    <input type="hidden" id="sms_check" value="<?=$sms_ck_result?>">

    <textarea name="msg" cols="30" rows="10" style="width:455px;"><?php echo htmlspecialchars($item[it_name])?> 문의글이 등록되었습니다.&#13; <?echo htmlspecialchars($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?></textarea>


</form>
<?
include_once $nfor[skin_path]."tail.php";
?>