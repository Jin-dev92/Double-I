<?php
include_once $nfor[skin_path]."mypage_head.php";
?>
<style>

.mb_wrap{ width:100%; height: auto;}
.mb_join_wrap { width:100%; margin:0px auto; }
.mb_join_header{padding-top:12px; width:100%; height:28px; background: #f9f9fa; border-bottom: 1px solid #e7e7e7;}

.mb_join_header .inner{ margin: 0 auto; width: 1100px;}
.mb_join_header .logo { float:left; margin-right:16px; width:350px; height:21px; background: url('<?=$nfor[skin_path]?>img/logo.png') 0 -52px no-repeat; display: block;}
.mb_join_wrap h2 { float:left; width:150px; height:42px; background: url('/skin/mein/img/login_layout.png') -0px -121px;}
.mb_join_wrap em { float:right; margin-top: 29px; width:215px;  height:13px; background: url('<?=$nfor[skin_path]?>img/login_layout.png') -119px -0px;}

.logintitle{ padding-bottom: 14px; border-bottom: 2px solid #ff7c99; overflow: hidden;}
.mb_join_wrap .mb_join_row { margin-top:10px; }
.join_box{ overflow:hidden; margin: 15px auto 0; border-top:solid 2px #666;}



#asign_input_div { display:none; }

.mb_row_p { margin-top:10px; font-size:13px; color:#666; }
.mb_row_p label { font-size:13px; }

select:focus, input[type=text]:focus, input[type=email]:focus, input[type=password]:focus, input[type=number]:focus { border:solid 1px red; }

.p_msg { font-size:13px; color:#de1d5a; }

#mb_hp_msg { margin:5px 0px; }  
#mb_hp_asign { display:none; }
#asign_send_btn { cursor:pointer; display:block; height:40px; line-height:40px; font-size:15px; text-align:center;  color:red; border:solid 2px red; background-color:#fff; }

#asign_input_div { margin:5px 0px; }
#asign_number { float:left; width:70%; height:36px; padding:0px; border:solid 2px #ccc; }

#asign_confirm_wrap { float:right; width:30%; }
#asign_confirm { width:100%; height:40px; line-height:40px; font-size:15px; background-color:#e14e6b; color:#fff; display:block; text-align:center; cursor:pointer; }


#mb_birth_1 { float:left; width:34%; margin-right:1%; }
#mb_birth_2 { float:left; width:32%; margin-right:1%; }
#mb_birth_3 { float:left; width:32%; }

.mb_birth { height:30px; border:solid 1px #DCDCDC; padding-left:5px;}
.inppt { height:30px; border:solid 1px #DCDCDC; padding-left:5px; width:99% }

.mb_join_line { border-top:solid 1px #ccc; margin-top:10px; }
.mb_join_title { margin-top:20px; margin-bottom:6px; font-size:16px; }


#mb_join_btn { display:block; width:45%; height:40px; line-height:40px; text-align:center; padding:0px; margin:0px; margin:20px auto; font-size:16px; font-weight:bold; background-color:#d32f2f; border:solid 1px #d32f2f; color:#fff; }



.mb_agree { overflow-y:scroll; -webkit-overflow-scrolling:touch; height:100px; border:solid 1px #e5e5e5; background-color:#fff; color:#555; padding:10px; font-size:12px; }

.mb_privacy { width:100%; margin:0 0 10px; background:#fff; border-top:solid 1px #e5e5e5; border-left:solid 1px #e5e5e5; }
.mb_privacy th{ padding:7px; text-align:left; color:#666; font-size:12px; border-bottom:solid 1px #e5e5e5; border-right:solid 1px #e5e5e5; background-color:#f4f4f4; }
.mb_privacy td{ padding:7px; text-align:left; color:#222; font-size:12px; border-bottom:solid 1px #e5e5e5; border-right:solid 1px #e5e5e5; }


#zipcode_btn  { cursor:pointer; position:absolute; right:0px; top:0px; height:32px; display:block; width:110px; text-align:center; line-height:32px; border:solid 1px #ccc; background:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#ecebf0)); box-shadow:none; }
</style>









<script type="text/javascript">
<!--
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






			<div class="mb_wrap">
			<? include_once $nfor[skin_path]."inc_my.php"; ?>
			<div class="mb_join_wrap">
				<div class="join_box" >


				<p class="mb_join_title" >기본정보</p>
				<div class="mb_join_row"><input type="text" name="mb_name" id="mb_name" placeholder="이름" value="<?=$member[mb_name]?>" readonly  class="inppt"></div>
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

				<div class="mb_join_row"  class="inppt">
					<select name="mb_sex" id="mb_sex">
					<option value="">성별
					<option value="M" <?=$member[mb_sex]=="M"?"selected":""?>>남자
					<option value="F" <?=$member[mb_sex]=="F"?"selected":""?>>여자
					</select>
				</div>
				<p id="mb_sex_msg" class="p_msg"></p>

				<div class="mb_join_row"><input type="text" name="mb_hp" id="mb_hp" placeholder="휴대폰번호(-없이 입력)" value="<?=str_number($member[mb_hp])?>"  class="inppt" ></div>
				<p id="mb_hp_msg" class="p_msg"></p>
				<div id="mb_hp_asign">
					<a id="asign_send_btn">인증번호전송</a>
					<div id="asign_input_div">
						<input type="text" name="asign_number" id="asign_number" placeholder="인증번호">
						<div class="asign_confirm_wrap"><a id="asign_confirm">인증번호확인</a></div>
					</div>
				</div>
				<p class="mb_row_p">휴대폰번호는 아이디/비밀번호를 찾기 위해 반드시 필요한 정보이므로 정확하게 입력해주세요.</p>

				<div class="mb_join_line"></div>

				<p class="mb_join_title">이메일(아이디) 변경</p>
					
				<? if($nfor[id_type]=="mb_id"){ ?>
				<div class="mb_join_row"><input type="text" name="mb_id" id="mb_id" placeholder="아이디" value="<?=$member[mb_id]?>" readonly  class="inppt"></div>
				<p id="mb_id_msg" class="p_msg"></p>
				<? } ?>

				<div class="mb_join_row"><input type="email" name="mb_email" id="mb_email" placeholder="이메일" value="<?=$member[mb_email]?>"  class="inppt"></div>
				<p id="mb_email_msg" class="p_msg"></p>




				<div class="mb_join_line"></div>

				<p class="mb_join_title">주소 변경</p>


				<div class="mb_join_row">

						<div style="width:100%; height:40px; position:relative;">
						<input type="text" name="mb_zipcode" id="mb_zipcode" class="inppt" placeholder="우편번호" value="<?=$member[mb_zipcode]?>" readonly>
						<a id="zipcode_btn" href="javascript:zipcode('mb_zipcode', 'mb_addr1', 'mb_addr2')">우편번호찾기</a>
						</div>
						<input type="text" name="mb_addr1" id="mb_addr1" class="inppt" placeholder="주소" value="<?=$member[mb_addr1]?>" style="margin:5px 0px;" readonly>
						<input type="text" name="mb_addr2" id="mb_addr2" class="inppt" placeholder="상세주소" value="<?=$member[mb_addr2]?>">


				</div>





				<div class="mb_join_line"></div>

				<p class="mb_join_title">비밀번호 변경</p>





				<div class="mb_join_row"><input type="password" name="mb_password_now" id="mb_password_now" placeholder="현제 비밀번호를 입력해 주세요"  class="inppt"></div>


				<div class="mb_join_row"><input type="password" name="mb_password" id="mb_password" placeholder="새 비밀번호를 입력해주세요"  class="inppt"></div>
				<p id="mb_password_msg" class="mb_row_p">영문/숫자 또는 특수문자 조합 6~16자리로 입력해 주세요.</p>

				<div class="mb_join_row"><input type="password" name="mb_password_confirm" id="mb_password_confirm" placeholder="새 비밀번호를 한번더 입력해주세요"  class="inppt"></div>
				<p id="mb_password_confirm_msg" class="p_msg"></p>

				<div class="mb_join_line"></div>

				<p class="mb_join_title">수신동의</p>
				<div class="mb_join_row">

					<div><input type="checkbox" name="mb_mailling" value="1" id="mb_mailling" <?=$member[mb_mailling]=="1"?"checked":""?>> <label for="mb_mailling">이메일을 통한 정보수신에 동의합니다.</label></div>
					<div style="margin-top:5px;"><input type="checkbox" name="mb_sms" value="1" id="mb_sms" <?=$member[mb_sms]=="1"?"checked":""?>> <label for="mb_sms">SMS/전화를 통한 정보수신에 동의합니다</label></div>
					
				</div>


				<input type="submit" value="회원정보수정" id="mb_join_btn">



			</div>

			</div>
			</form>
			</div>

<?
include_once $nfor[skin_path]."mypage_tail.php";
?>