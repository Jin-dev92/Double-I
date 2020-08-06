<?php
include_once $nfor[skin_path]."head.php";
?>
<style>
.mb_join_wrap { width:100%; padding:10px; box-sizing:border-box; -webkit-box-sizing:border-box; }
.mb_join_wrap .mb_join_row { margin-top:5px; }

#asign_input_div { display:none; }

.mb_row_p { margin-top:5px; font-size:13px; color:#666; }
.mb_row_p label { font-size:13px; }

select:focus, input[type=text]:focus, input[type=email]:focus, input[type=password]:focus, input[type=number]:focus { border:solid 1px red; }

.p_msg { font-size:13px; color:#de1d5a; }

#mb_hp_msg { margin:5px 0px; }  
#mb_hp_asign { display:none; }
#asign_send_btn { cursor:pointer; display:block; height:40px; line-height:40px; font-size:15px; text-align:center;  color:red; border:solid 2px red; background-color:#fff; }

#asign_input_div { margin:5px 0px; }
#asign_number { float:left; width:70%; }

#asign_confirm_wrap { float:right; width:30%; }
#asign_confirm { width:100%; height:40px; line-height:40px; font-size:15px; background-color:#ec3940; color:#fff; display:block; text-align:center; cursor:pointer; }


#mb_birth_1 { float:left; width:34%; margin-right:1%; }
#mb_birth_2 { float:left; width:32%; margin-right:1%; }
#mb_birth_3 { float:left; width:32%; }

.mb_join_line { border-top:solid 1px #ccc; margin-top:10px; }
.mb_join_title { margin-top:20px; margin-bottom:6px; font-size:16px; }


#mb_join_btn { display:block; width:100%; height:40px; line-height:40px; text-align:center; padding:0px; margin:0px; margin:20px 0px; font-size:16px; font-weight:bold; background-color:#ec3940; border:solid 1px #ec3940; color:#fff; }



.mb_agree { overflow-y:scroll; -webkit-overflow-scrolling:touch; height:100px; border:solid 1px #e5e5e5; background-color:#fff; color:#555; padding:10px; font-size:12px; }

.mb_privacy { width:100%; margin:0 0 10px; background:#fff; border-top:solid 1px #e5e5e5; border-left:solid 1px #e5e5e5; }
.mb_privacy th{ padding:7px; text-align:left; color:#666; font-size:12px; border-bottom:solid 1px #e5e5e5; border-right:solid 1px #e5e5e5; background-color:#f4f4f4; }
.mb_privacy td{ padding:7px; text-align:left; color:#222; font-size:12px; border-bottom:solid 1px #e5e5e5; border-right:solid 1px #e5e5e5; }





#zipcode_wrap { display:none; width:100%; height:300px; position:relative; }

#zipcode_btn  { cursor:pointer; position:absolute; right:0px; top:0px; height:38px; display:block; width:110px; text-align:center; line-height:40px; border:solid 1px #ccc; background:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#ecebf0)); box-shadow:none; }
</style>

<script type="text/javascript">
<!--

var currentScroll = "";

$(document).on("click","#zipcode_btn, #mb_zipcode, #mb_addr1",function(){
	currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
	zipcode("mb_zipcode","mb_addr1","mb_addr2");
	$("#member_info").hide();
	$(".btn_back").attr("href","javascript:zipcode_close()");
});


function zipcode_close(){
	var element_wrap = document.getElementById('zipcode_wrap');
	element_wrap.style.display = 'none';
	$("#member_info").show();
	// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
	document.body.scrollTop = currentScroll;
	$(".btn_back").attr("href","javascript:history.back()");
}

function zipcode(zipcode,addr1,addr2){
	var element_wrap = document.getElementById('zipcode_wrap');

	// 현재 scroll 위치를 저장해놓는다.
	new daum.Postcode({
		oncomplete: function(data) {
			// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = data.address; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 기본 주소가 도로명 타입일때 조합한다.
			if(data.addressType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById(zipcode).value = data.zonecode; //5자리 새우편번호 사용
			document.getElementById(addr1).value = fullAddr;
			$("#member_info").show();

			// iframe을 넣은 element를 안보이게 한다.
			// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
			element_wrap.style.display = 'none';


			// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
			document.body.scrollTop = currentScroll;

			document.getElementById(addr2).focus();



		},
		// 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
		onresize : function(size) {
			element_wrap.style.height = size.height+'px';
		},
		width : '100%',
		height : '100%'
	}).embed(element_wrap);

	// iframe을 넣은 element를 보이게 한다.
	element_wrap.style.display = 'block';
}



$(document).on("blur","#mb_name",function(){
	name_check();
});

$(document).on("blur",".mb_birth",function(){
	birth_check();
});

$(document).on("blur","#mb_sex",function(){
	sex_check();
});

$(document).on("blur","#mb_hp",function(){
	hp_check();
});

$(document).on("change","#mb_hp",function(){
	$("#asign_number").val("");
	$("#asign_send_btn").html("인증번호 전송");
	$("#asign_input_div").hide();
	hp_check();
});

$(document).on("click","#asign_send_btn",function(){
	asign_send();
});

$(document).on("click","#asign_confirm",function(){
	var asign_chk = asign_confirm();
	if(asign_chk){
		alert(asign_chk);
		return false;	
	}
});

<? if($nfor[id_type]=="mb_id"){ ?>
$(document).on("blur","#mb_id",function(){
	id_check();
});
<? } ?>
$(document).on("blur","#mb_email",function(){
	email_check();
});

$(document).on("blur","#mb_password",function(){
	password_check();
	
	if($("#mb_password_confirm").val()){
		password_confirm_check();
	}

});

$(document).on("blur","#mb_password_confirm",function(){
	password_confirm_check();
});

function fmember_submit(f){

	var name_chk = name_check();
	if(name_chk){
		alert(name_chk);
		return false;	
	}

	var birth_chk = birth_check();
	if(birth_chk){
		alert(birth_chk);
		return false;	
	}

	var sex_chk = sex_check();
	if(sex_chk){
		alert(sex_chk);
		return false;	
	}

	var hp_chk = hp_check();
	if(hp_chk){
		alert(hp_chk);
		return false;	
	}

	<? if($nfor[id_type]=="mb_id"){ ?>
	var id_chk = id_check();
	if(id_chk){
		alert(id_chk);
		return false;	
	}
	<? } ?>

	var email_chk = email_check();
	if(email_chk){
		alert(email_chk);
		return false;	
	}

	if($("#mb_password_now").val()){

		var password_chk = password_check();
		if(password_chk){
			alert(password_chk);
			return false;	
		}

		var password_confirm_chk = password_confirm_check();
		if(password_confirm_chk){
			alert(password_confirm_chk);
			return false;	
		}

	}

	f.action = "member_form.php";
	document.getElementById("mb_join_btn").disabled = "disabled";
	return true;
}
//-->
</script>

<form name="fmember" id="fmember" method="post" onsubmit="return fmember_submit(this);" autocomplete="off">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="mb_no" id="mb_no" value="<?=$member[mb_no]?>">



<div class="mb_join_wrap" id="member_info">

	<p>기본정보</p>
	<div class="mb_join_row"><input type="text" name="mb_name" id="mb_name" placeholder="이름" value="<?=$member[mb_name]?>" readonly></div>
	<p id="mb_name_msg" class="p_msg"></p>
	<!-- <p class="mb_row_p"><input type="checkbox" name="mb_age" value="1" id="mb_age"> <label for="mb_age">14세 이상입니다</label></p> -->
	<div class="mb_join_row">
		<select name="mb_birth_1" id="mb_birth_1" class="mb_birth">
		<option value="">생년
		<?
		for($i=date("Y")-14; $i>=date("Y")-114; $i--){
		?>
		<option value="<?=$i?>" <?=$member[mb_birth_1]==$i?"selected":""?>><?=$i?>
		<? } ?>
		</select>
		<select name="mb_birth_2" id="mb_birth_2" class="mb_birth">
		<option value="">월
		<?
		for($i=1; $i<=12; $i++){
		?>
		<option value="<?=$i?>" <?=$member[mb_birth_2]==sprintf("%02d",$i)?"selected":""?>><?=$i?>
		<? } ?>
		</select>
		<select name="mb_birth_3" id="mb_birth_3" class="mb_birth">
		<option value="">일
		<?
		for($i=1; $i<=31; $i++){
		?>
		<option value="<?=$i?>" <?=$member[mb_birth_3]==sprintf("%02d",$i)?"selected":""?>><?=$i?>
		<? } ?>
		</select>
		<div style="clear:both;"></div>

	</div>
	<p id="mb_birth_msg" class="p_msg"></p>

	<div class="mb_join_row">
		<select name="mb_sex" id="mb_sex">
		<option value="">성별
		<option value="M" <?=$member[mb_sex]=="M"?"selected":""?>>남자
		<option value="F" <?=$member[mb_sex]=="F"?"selected":""?>>여자
		</select>
	</div>
	<p id="mb_sex_msg" class="p_msg"></p>

	<div class="mb_join_row"><input type="number" pattern="[0-9]*" name="mb_hp" id="mb_hp" placeholder="휴대폰번호(-없이 입력)" value="<?=str_number($member[mb_hp])?>"></div>
	<p id="mb_hp_msg" class="p_msg"></p>
	<div id="mb_hp_asign">
		<a id="asign_send_btn">인증번호전송</a>
		<div id="asign_input_div">
			<input type="number" pattern="[0-9]*" name="asign_number" id="asign_number" placeholder="인증번호">
			<div class="asign_confirm_wrap"><a id="asign_confirm">인증번호확인</a></div>
		</div>
	</div>
	<p class="mb_row_p">휴대폰번호는 아이디/비밀번호를 찾기 위해 반드시 필요한 정보이므로 정확하게 입력해주세요.</p>

	<div class="mb_join_line"></div>

	<p class="mb_join_title">이메일(아이디) 변경</p>
		
	<? if($nfor[id_type]=="mb_id"){ ?>
	<div class="mb_join_row"><input type="text" name="mb_id" id="mb_id" placeholder="아이디" value="<?=$member[mb_id]?>" readonly></div>
	<p id="mb_id_msg" class="p_msg"></p>
	<? } ?>

	<div class="mb_join_row"><input type="email" name="mb_email" id="mb_email" placeholder="이메일" value="<?=$member[mb_email]?>"></div>
	<p id="mb_email_msg" class="p_msg"></p>


	<div class="mb_join_line"></div>

	<p class="mb_join_title">주소 변경</p>

	<div class="mb_join_row">

			<div style="width:100%; height:40px; position:relative;">
			<input type="number" pattern="[0-9]*" name="mb_zipcode" id="mb_zipcode" placeholder="우편번호" value="<?=$member[mb_zipcode]?>" readonly>
			<a id="zipcode_btn">우편번호찾기</a>
			</div>
			<input type="text" name="mb_addr1" id="mb_addr1" placeholder="주소" value="<?=$member[mb_addr1]?>" style="margin:5px 0px;" readonly>
			<input type="text" name="mb_addr2" id="mb_addr2" placeholder="상세주소" value="<?=$member[mb_addr2]?>">


	</div>





	<div class="mb_join_line"></div>

	<p class="mb_join_title">비밀번호 변경</p>





	<div class="mb_join_row"><input type="password" name="mb_password_now" id="mb_password_now" placeholder="현제 비밀번호를 입력해 주세요"></div>


	<div class="mb_join_row"><input type="password" name="mb_password" id="mb_password" placeholder="새 비밀번호를 입력해주세요"></div>
	<p id="mb_password_msg" class="mb_row_p">영문/숫자 또는 특수문자 조합 6~16자리로 입력해 주세요.</p>

	<div class="mb_join_row"><input type="password" name="mb_password_confirm" id="mb_password_confirm" placeholder="새 비밀번호를 한번더 입력해주세요"></div>
	<p id="mb_password_confirm_msg" class="p_msg"></p>

	<div class="mb_join_line"></div>

	<p class="mb_join_title">수신동의</p>
	<div class="mb_join_row">

		<div><input type="checkbox" name="mb_mailling" value="1" id="mb_mailling" <?=$member[mb_mailling]=="1"?"checked":""?>> <label for="mb_mailling">이메일을 통한 정보수신에 동의합니다.</label></div>
		<div style="margin-top:5px;"><input type="checkbox" name="mb_sms" value="1" id="mb_sms" <?=$member[mb_sms]=="1"?"checked":""?>> <label for="mb_sms">SMS/전화를 통한 정보수신에 동의합니다</label></div>
		
	</div>


	<input type="submit" value="회원정보수정" id="mb_join_btn">





</div>
</form>


<div id="zipcode_wrap"></div>

<?
include_once $nfor[skin_path]."tail.php";
?>