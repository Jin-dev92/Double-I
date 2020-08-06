<?php	// 회원가입
include "path.php";

$mb_member = member("mb_no",$mb_no);


if($mode=="change"){
	$_SESSION[ss_mb_no] = $mb_member[mb_no];
	alert("관리자 모드를 종료하고 사용자 모드로 접속합니다","$nfor[path]/index.php");
	exit;
}

if($mode=="insert"){

	if($nfor[id_type]=="mb_id"){
		$id_check = json_decode(id_check($mb_id),true);
		if($id_check[result] != "ok") alert($id_check[msg]);
	}
	
	$email_check = json_decode(email_check($mb_email),true);
	if($email_check[result] != "ok") alert($email_check[msg]);
	
	$password_check = json_decode(password_check($mb_password),true);
	if($password_check[result] != "ok") alert($password_check[msg]);

	$name_check = json_decode(name_check($mb_name),true);
	if($name_check[result] != "ok") alert($name_check[msg]);

	$hp_check = json_decode(hp_check($mb_hp),true);
	if($hp_check[result] != "ok") alert($hp_check[msg]);
	$mb_hp = add_hyphen($mb_hp);
/*
	$sex_check = json_decode(sex_check($mb_sex),true);
	if($sex_check[result] != "ok") alert($sex_check[msg]);	
	*/
	$mb_birth = $mb_birth_1."-".sprintf("%02d",$mb_birth_2)."-".sprintf("%02d",$mb_birth_3);
	//$birth_check = json_decode(birth_check($mb_birth),true);
	//if($birth_check[result] != "ok") alert($birth_check[msg]);

	if($supply_photo = file_upload("$nfor[path]/data/member/supply/", $_FILES["supply_photo"])) $add_sql .= " , supply_photo='$supply_photo' ";

	sql_query("insert nfor_member set mb_id='$mb_id',
									mb_password=password('$mb_password'),
									mb_name='$mb_name',
									mb_hp='$mb_hp', 
									mb_email='$mb_email', 
									mb_birth='$mb_birth',
									mb_sex='$mb_sex',
									mb_zipcode='$mb_zipcode', 
									mb_addr1='$mb_addr1',
									mb_addr2='$mb_addr2',
									mb_mailling='$mb_mailling', 
									mb_sms='$mb_sms',
									mb_datetime = NOW(),
									mb_ip = '$_SERVER[REMOTE_ADDR]',
									mb_level = '2',
									mb_login_ip = '$_SERVER[REMOTE_ADDR]',
									is_supply='$is_supply',
									mb_bank_name='$mb_bank_name',
									mb_bank_account='$mb_bank_account',									
									supply_name='$supply_name', 
									mb_tel='$mb_tel', 
									mb_black='$mb_black',
									mb_extra2='$mb_extra2',
									mb_extra3='$mb_extra3',
									mb_extra4='$mb_extra4',
									mb_access='$mb_access',
									mb_memo='$mb_memo',
									supply_bank_name='$supply_bank_name', 
									supply_bank_account='$supply_bank_account', 
									supply_bank_account_holder='$supply_bank_account_holder' $add_sql");

	$mb_no = sql_insert_id();

	if($config[cf_join_money]) insert_money($mb_no,$config[cf_join_money],"회원가입","1");
	if($mb_friend){	
		$mb = sql_fetch("select * from nfor_member where {$nfor[id_type]}='$mb_friend'");	// 아이디일경우 mb_id, 이메일일경우 mb_email
		if($mb[mb_no]){
			$mb_friend_no = $mb[mb_no];
			if($config[cf_friend_money1]) insert_money($mb_no,$config[cf_friend_money1],"추천인입력","9");
			if($config[cf_friend_money2]) insert_money($mb[mb_no],$config[cf_friend_money2],"추천받음","10");
			sql_query("update nfor_member set mb_friend_no = '$mb_friend_no' where mb_no='$mb_no'");
		}
	}

	nfor_send("member_join", $mb_email, $mb_hp, $mb_no);
	
	alert("정상적으로 회원가입되었습니다","$_SERVER[PHP_SELF]?mb_no=$mb_no&$qstr");
	exit;
}


if($mode=="update"){

	$email_check = json_decode(email_check($mb_email,$mb_no),true);
	if($email_check[result] != "ok") alert($email_check[msg]);
	
	if($mb_password){
		$password_check = json_decode(password_check($mb_password),true);
		if($password_check[result] != "ok") alert($password_check[msg]);		
		$add_sql = ", mb_password=password('$mb_password')";
	}

	$name_check = json_decode(name_check($mb_name),true);
	if($name_check[result] != "ok") alert($name_check[msg]);

	//$hp_check = json_decode(hp_check($mb_hp,$mb_no),true);
	//if($hp_check[result] != "ok") alert($hp_check[msg]);
	$mb_hp = add_hyphen($mb_hp);
/*
	$sex_check = json_decode(sex_check($mb_sex),true);
	if($sex_check[result] != "ok") alert($sex_check[msg]);	
*/
	$mb_birth = $mb_birth_1."-".sprintf("%02d",$mb_birth_2)."-".sprintf("%02d",$mb_birth_3);
	//$birth_check = json_decode(birth_check($mb_birth),true);
	//if($birth_check[result] != "ok") alert($birth_check[msg]);

	if($supply_photo = file_upload("$nfor[path]/data/member/supply/", $_FILES["supply_photo"])) $add_sql .= " , supply_photo='$supply_photo' ";
	if($supply_photo_del){
		sql_query("update nfor_member set supply_photo='' where mb_no='$mb_member[mb_no]'");
		@unlink("$nfor[path]/data/member/supply/$mb_member[supply_photo]");
	}

	sql_query("update nfor_member set mb_name='$mb_name',
									mb_hp='$mb_hp', 
									mb_email='$mb_email', 
									mb_birth='$mb_birth',
									mb_sex='$mb_sex',
									mb_zipcode='$mb_zipcode', 
									mb_addr1='$mb_addr1',
									mb_addr2='$mb_addr2',
									mb_mailling='$mb_mailling', 
									mb_sms='$mb_sms',
									is_supply='$is_supply',
									mb_bank_name='$mb_bank_name',
									mb_bank_account='$mb_bank_account',		
									supply_name='$supply_name', 
									mb_tel='$mb_tel', 
									mb_black='$mb_black',
									mb_extra2='$mb_extra2',
									mb_extra3='$mb_extra3',
									mb_extra4='$mb_extra4',
									mb_access='$mb_access',
									mb_memo='$mb_memo',
									supply_bank_name='$supply_bank_name', 
									supply_bank_account='$supply_bank_account', 
									supply_bank_account_holder='$supply_bank_account_holder'
									$add_sql where mb_no='$mb_member[mb_no]'");

	if($is_supply=="1"){
		$move = "supply_form.php";
	} elseif($is_supply=="2"){
		$move = "md_form.php";
	} elseif($is_supply=="7"){
		$move = "admin_form.php";
	} else{
		$move = "member_form.php";
	}

	alert("정상적으로 수정되었습니다","$move?mb_no=$mb_no&$qstr");
	exit;
}

include "head.php";

$list_btn = sql_fetch("select access_file from nfor_access where access_code='$menu_code[access_code]' and access_path='0'");

echo cheditor1('mb_memo', '100%', '100px');

if(basename($_SERVER[PHP_SELF])=="supply_form.php"){
	$mb_member[is_supply] = 1;
} elseif(basename($_SERVER[PHP_SELF])=="md_form.php"){
	$mb_member[is_supply] = 2;
} elseif(basename($_SERVER[PHP_SELF])=="admin_form.php"){
	$mb_member[is_supply] = 7;
} else{
	$mb_member[is_supply] = 0;
}
?>
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



<?
if(!$mb_member[mb_no]){
?>
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
<? } ?>

<? if($nfor[id_type]=="mb_id"){ ?>
$(document).on("blur","#mb_id",function(){
	id_check();
});
<? } ?>
$(document).on("blur","#mb_email",function(){
	email_check();
});

$(document).on("blur","#mb_password",function(){
	if($("#mb_password").val()){
		password_check();
	}
});

function fmember_submit(f){

	var name_chk = name_check();
	if(name_chk){
		alert(name_chk);
		return false;	
	}
/*
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
*/
	<?
	if(!$mb_member[mb_no]){
	?>
	var hp_chk = hp_check();
	if(hp_chk){
		alert(hp_chk);
		return false;	
	}
	<? } ?>

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


if($("#mb_password").val()){
	var password_chk = password_check();
	if(password_chk){
		alert(password_chk);
		return false;	
	}
}

    <?
    echo cheditor3('mb_memo');
    ?>


	f.action = "member_form.php";
	document.getElementById("mb_join_btn").disabled = "disabled";
	return true;
}
//-->
</script>



<form name="fmember" id="fmember" method="post" onsubmit="return fmember_submit(this);" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mb_member[mb_no]?"update":"insert"?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="mb_no" id="mb_no" value="<?=$mb_member[mb_no]?>">
<input type="hidden" name="mb_level" value="2">

<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02"><? if($mb_member[mb_no]){ ?><?=$mb_member[mb_name]?>님의 기본정보 수정<? } else{ ?>회원등록하기<? } ?></span></div>

<table class="tbl_type" cellpadding="0" cellspacing="0">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>사용자모드</th>
	<td>
	<input type="button" value="사용자모드로접속하기" onclick="location.href='member_form.php?mode=change&mb_no=<?=$mb_member[mb_no]?>'">
	</td>
</tr>
<tr>
	<th>회원구분</th>
	<td>
	<select name="is_supply" id="is_supply">
		<option value="0" <? if(!$mb_member[is_supply] or $mb_member[is_supply]=="0") echo "selected";?>>일반회원
		<option value="1" <? if($mb_member[is_supply]=="1") echo "selected";?>>공급업체
		<option value="2" <? if($mb_member[is_supply]=="2") echo "selected";?>>MD
		<option value="7" <? if($mb_member[is_supply]=="7") echo "selected";?>>부관리자
	</select>
	</td>
</tr>
<? if($nfor[id_type]=="mb_id"){ ?>
<tr>
	<th width="130">아이디</th>
	<td align="left">
	<input type="text" name="mb_id" id="mb_id" value="<?=$mb_member[mb_id]?>" <?=$mb_member[mb_id]?"readonly":""?>>
	<span id="mb_id_msg" class="p_msg"></span>
	</td>
</tr>
<? } ?>
<tr>
	<th>이메일</th>
	<td>
	<input type="email" name="mb_email" id="mb_email" value="<?=$mb_member[mb_email]?>">
	<span id="mb_email_msg" class="p_msg"></span>
	</td>
</tr>
<tr>
	<th>비밀번호</th>
	<td>
	<input type="password" name="mb_password" id="mb_password">
	<span id="mb_password_msg" class="mb_row_p">영문/숫자 또는 특수문자 조합 6~16자리로 입력해 주세요.</span>
	</td>
</tr>
</table>

<br>

<table  class="tbl_type" cellpadding="0" cellspacing="0">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>이름</th>
	<td>
	<input type="text" name="mb_name" id="mb_name" value="<?=$mb_member[mb_name]?>">
	<span id="mb_name_msg" class="p_msg"></span>
	</td>
</tr>
<tr>
	<th>휴대폰</th>
	<td>
	<input type="text" name="mb_hp" id="mb_hp" value="<?=str_number($mb_member[mb_hp])?>">
	<span id="mb_hp_msg" class="p_msg"></span>
	</td>
</tr>
<tr>
	<th>주소</th>
	<td>
	<input type="text" name="mb_zipcode" id="mb_zipcode" placeholder="우편번호" size="6" value="<?=$mb_member[mb_zipcode]?>">
	<input type="button" onclick="zipcode('mb_zipcode', 'mb_addr1', 'mb_addr2')" value="우편번호 찾기"><br>
	<input type="text" name="mb_addr1" id="mb_addr1" placeholder="도로명주소" style="width:300px; margin:5px 0px;" value="<?=$mb_member[mb_addr1]?>"><br>
	<input type="text" name="mb_addr2" id="mb_addr2" placeholder="나머지주소" style="width:500px;" value="<?=$mb_member[mb_addr2]?>">
	</td>
</tr>
<tr>
	<th>성별</th>
	<td>
	<select name="mb_sex" id="mb_sex">
	<option value="">성별
	<option value="M" <?=$mb_member[mb_sex]=="M"?"selected":""?>>남자
	<option value="F" <?=$mb_member[mb_sex]=="F"?"selected":""?>>여자
	</select>
	<span id="mb_sex_msg" class="p_msg"></span>
	</td>
</tr>
<tr>
	<th>생년월일</th>
	<td>
	<select name="mb_birth_1" id="mb_birth_1" class="mb_birth">
	<option value="">생년
	<?
	for($i=date("Y")-14; $i>=date("Y")-114; $i--){
	?>
	<option value="<?=$i?>" <?=$mb_member[mb_birth_1]==$i?"selected":""?>><?=$i?>
	<? } ?>
	</select>
	<select name="mb_birth_2" id="mb_birth_2" class="mb_birth">
	<option value="">월
	<?
	for($i=1; $i<=12; $i++){
	?>
	<option value="<?=$i?>" <?=$mb_member[mb_birth_2]==sprintf("%02d",$i)?"selected":""?>><?=$i?>
	<? } ?>
	</select>
	<select name="mb_birth_3" id="mb_birth_3" class="mb_birth">
	<option value="">일
	<?
	for($i=1; $i<=31; $i++){
	?>
	<option value="<?=$i?>" <?=$mb_member[mb_birth_3]==sprintf("%02d",$i)?"selected":""?>><?=$i?>
	<? } ?>
	</select>
	<span id="mb_birth_msg" class="p_msg"></span>
	</td>
</tr>
<tr>
	<th>수신동의</th>
	<td>
	<input type="checkbox" name="mb_mailling" value="1" <?=$mb_member[mb_mailling]?"checked":""?>> 이메일 수신동의
	<input type="checkbox" name="mb_sms" value="1" <?=$mb_member[mb_sms]?"checked":""?>> SMS 수신동의
	</td>
</tr>
<? if($mb_member[mb_no]){ ?>
<tr>
	<th>접근차단</th>
	<td>
	<input type="checkbox" name="mb_access" id="mb_access" value="1" <?=$mb_member[mb_access]?"checked":""?>> <label for="mb_access">체크시 접근차단</label>
	</td>
</tr>
<tr>
	<th>블랙컨슈머</th>
	<td>
	<input type="checkbox" name="mb_black" id="mb_black" value="1" <?=$mb_member[mb_black]?"checked":""?>> <label for="mb_black">체크시 경고출력</label>
	</td>
</tr>
<tr>
	<th>적립금</th>
	<td><a href="money_list.php?mb_no=<?=$mb_member[mb_no]?>"><?=number_format(mb_money($mb_member[mb_no]))?>원</a></td>
</tr>
<tr>
	<th>가입접속</th>
	<td><?=$mb_member[mb_datetime]?> - <?=$mb_member[mb_ip]?></td>
</tr>
<tr>
	<th>최근접속</th>
	<td><?=$mb_member[mb_today_login]?> - <?=$mb_member[mb_login_ip]?></td>
</tr>
<? if($mb_member[mb_leave_date]){ ?>
<tr>
	<th>탈퇴신청일자</th>
	<td><?=substr($mb_member[mb_leave_date],0,4)?>-<?=substr($mb_member[mb_leave_date],4,2)?>-<?=substr($mb_member[mb_leave_date],6,2)?></td>
</tr>
<tr>
	<th>탈퇴사유</th>
	<td><?=nl2br($mb_member[mb_secession])?></td>
</tr>
<? } ?>

<? } ?>


<tr>
	<th>회원메모</th>
	<td><?=cheditor2('mb_memo', $mb_member[mb_memo])?></td>
</tr>
</table>

<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">환불계좌정보</span></div>
<table class="tbl_type" cellpadding="0" cellspacing="0" id="supply_info">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>환불은행</th>
	<td>	
	<select name="mb_bank_name" id="mb_bank_name">
	<option value="">은행선택
	<?
	$que = sql_query("select * from nfor_pg_code where pg_type='$nfor[pg_type]' and pg_payment_type='vbanking'");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[pg_code]?>" <?=$mb_member[mb_bank_name]==$data[pg_code]?"selected":""?>><?=$data[pg_name]?>(<?=$data[pg_code]?>)
	<? } ?>
	</select>	
	</td>
</tr>
<tr>
	<th>환불계좌번호</th>
	<td><input type="text" name="mb_bank_account" id="mb_bank_account" value="<?=$mb_member[mb_bank_account]?>"></td>
</tr>
</table>

<? if(basename($_SERVER[PHP_SELF])=="supply_form.php"){ ?>
<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">공급업체정보</span></div>

<table class="tbl_type" cellpadding="0" cellspacing="0" id="supply_info">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>상호</th>
	<td><input type="text" name="supply_name" id="supply_name" value="<?=$mb_member[supply_name]?>"></td>
</tr>
<tr>
	<th>전화번호</th>
	<td><input type="text" name="mb_tel" id="mb_tel" value="<?=$mb_member[mb_tel]?>"></td>
</tr>
<tr>
	<th>대표자명</th>
	<td><input type="text" name="mb_extra2" id="mb_extra2" value="<?=$mb_member[mb_extra2]?>"></td>
</tr>
<tr>
	<th>사업자등록번호</th>
	<td><input type="text" name="mb_extra3" id="mb_extra3" value="<?=$mb_member[mb_extra3]?>"></td>
</tr>
<tr>
	<th>주소</th>
	<td><input type="text" name="mb_extra4" id="mb_extra4" value="<?=$mb_member[mb_extra4]?>"></td>
</tr>
<tr>
	<th>공급업체로고</th>
	<td>		
	<input type="file" name="supply_photo" class="input_txt">
	<? if($mb_member[supply_photo]){ ?><input type="checkbox" name="supply_photo_del" value="1"><img src="<?="$nfor[path]/data/member/supply/$mb_member[supply_photo]"?>" height="19"><? } ?>
	</td>
</tr>
</table>




<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">공급업체 정산계좌정보</span></div>
<table class="tbl_type" cellpadding="0" cellspacing="0" id="supply_info">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>은행명</th>
	<td><input type="text" name="supply_bank_name" id="supply_bank_name" value="<?=$mb_member[supply_bank_name]?>"></td>
</tr>
<tr>
	<th>계좌번호</th>
	<td><input type="text" name="supply_bank_account" id="supply_bank_account" value="<?=$mb_member[supply_bank_account]?>"></td>
</tr>
<tr>
	<th>예금주</th>
	<td><input type="text" name="supply_bank_account_holder" id="supply_bank_account_holder" value="<?=$mb_member[supply_bank_account_holder]?>"></td>
</tr>
</table>
<? } ?>




<div class="btn_cen"><input type="image" src="img/dong_btn.gif"> <a href="<?=$list_btn[access_file]?>?<?=$qstr?>"><img src="img/list.gif" alt="목록보기"></a></div>
</form>
<?
include "tail.php";
?>