<?php
include_once $nfor[skin_path]."head.php";
?>
<style>
.login_wrap { padding:10px; }

.login_select { list-style:none; border-top:solid 1px #ddd; border-left:solid 1px #ddd; overflow:hidden; }
.login_select li { margin:0px 0px 0px -2px; padding:0px; background-color:#fff; text-align:center; float:left; width:50%; border-right:solid 1px #ddd; border-left:solid 1px #ddd; position:relative;  }
.login_select li a { cursor:pointer; border-bottom:solid 2px #ddd; display:block; height:36px; line-height:36px; padding:0px 15px; font-size:14px; letter-spacing:-1px; text-decoration:none; color:#333; z-index:2; max-width:100%; overflow:hidden; }  
.login_select li.on { position:relative; background-color:#fff;  }
.login_select li.on a { cursor:pointer; font-weight:bold; color:#e24f6f; border-bottom:solid 2px #e24f6f; }




.login_input { margin:0px 0px 10px 0px; }





.mb_common_btn { list-style:none; overflow:hidden; padding:0px; }
.mb_common_btn li { float:left; width:33.33%; text-align:left; }
.mb_common_btn li:nth-child(2) { text-align:center; }
.mb_common_btn li:last-child { text-align:right; }
.mb_common_btn li a { background-color:#fff; display:block; border:solid 1px #ccc; height:30px; line-height:30px; text-align:center; width:95%; font-size:13px; color:#555; display:inline-block;  } 


.auto_login_wrap { margin:15px 0px; }


.keypad_btn { cursor:pointer; display:block; text-align:right; color:#999; font-size:12px; margin:10px 0px; }
.keypad_btn:after { background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat; background-size:320px auto; background-position: -100px -200px; width:10px; height:5px; margin-left:3px; display:inline-block; overflow:hidden; content:''; }

.keypad_btn.on { color:#ec3940; }
.keypad_btn.on:after { background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat ; background-size:320px auto; background-position: -150px -200px; width:10px; height:5px; margin-left:3px; display:inline-block; overflow:hidden; content:''; }


.keypad { display:none; text-align:center; margin-bottom:10px; }
.keypad img { width:95%; }
.member_confirm_line { border-top:solid 1px #ccc; margin:20px 0px; }

.guest_login { display:none; }
</style>


<script language="javascript">
<!--
function login_submit(f){

	if(!$('#mb_id').val()){
		alert("아이디를 입력해주세요");
		$('#mb_id').focus();
        return false;
	}

	if(!$('#mb_password').val()){
		alert("패스워드를 입력해주세요");
		$('#mb_password').focus();
        return false;
	}
	
    f.action = 'login_check.php';
    return true;
}	

$(document).on("click",".keypad_btn",function(){
	if($(this).hasClass('on')){
		$(this).html("한글자판보기").removeClass('on');
		$(".keypad").hide();
	} else{
		$(this).html("한글자판닫기").addClass('on');
		$(".keypad").show();
		
	}
});


$(document).on("click",".login_select li",function(){
	$(".login_select li").removeClass('on');
	$(this).addClass('on');
	if($(this).index()=="1"){
		$(".login_commnon").hide();
		$(".guest_login").show();
	} else{
		$(".login_commnon").hide();
		$(".member_login").show();
	}
});
//-->
</script>
<style>

.btn_join_facebook{ margin-top:8px;position:relative; display:block;height:50px;color:#FFF;letter-spacing:-0.5px;font-weight:bold;font-size:14px;text-align:center;line-height:51px; background-color:#3b5998; border-radius:3px; -webkit-border-radius: 3px;}
.btn_join_facebook:hover {color:#FFF;}
.btn_join_kakao { margin-top:8px;position:relative; display:block;height:50px;color:#FFF;letter-spacing:-0.5px;font-weight:bold;font-size:14px;text-align:center;line-height:51px; background-color:#ffcd00; border-radius:3px; -webkit-border-radius: 3px;}
.btn_join_kakao:hover {color:#FFF;}

.btn_join_facebook .icon {background-position:-50px -130px;}
.btn_join_kakao .icon {background-position:-100px -130px;}

.icon { display:block;width:50px;height:100%;position:absolute;top:0;left:0;background-image:url('/skin/demo/img/social_login.png');background-repeat:no-repeat; background-position:-50px -130px;}
.division{ display:block;width:1px;height:100%;position:absolute;top:0;left:50px;background:url( '/skin/demo/img/social_login.png' ) no-repeat -180px -130px;}
</style>

</style>
<div class="login_wrap">

<!-- 	<ul class="login_select">
		<li class="on"><a>회원 로그인</a></li>
		<li><a>비회원 주문주회</a></li>
	</ul>
 -->

	<a class="keypad_btn">한글자판보기</a>
	<div class="keypad"><img src="<?=$nfor[skin_path]?>img/keypad.png"></div>



	<div class="login_commnon member_login">
		<form name="login" method="post" onsubmit="return login_submit(this);" autocomplete="off">
		<input type="hidden" name="mode" value="login">
		<input type="hidden" name="url" value="<?=$urlencode?>">
		<input type="text" name="mb_id" id="mb_id" class="login_input" tabindex="1" placeholder="아이디" value="<?=$mb_id?>">
		<input type="password" name="mb_password" id="mb_password" class="login_input" tabindex="2" placeholder="패스워드" value="<?=$mb_password?>">
		<input type="submit" value="로그인" class="btn_submit">

		<?
		include_once "facebook_login.php";
		?>



			<a href="<?=$nfor[facebook_login_href]?>" class="btn_join_facebook"><i class="icon"></i><i class="division"></i>페이스북 계정으로 로그인</a>
			<a href="kakao_login.php" class="btn_join_kakao"><i class="icon"></i><i class="division"></i>카카오톡 계정으로  로그인</a>




		<div class="auto_login_wrap">
		<input type="checkbox" name="auto_login" id="auto_login" value="1"> <label for="auto_login">자동로그인설정</label>
		</div>
		<div class="member_confirm_line"></div>
		<ul class="mb_common_btn">
			<li><a href="find_id.php">아이디찾기</a></li>
			<li><a href="find_password.php">패스워드찾기</a></li>
			<li><a href="member_join.php">회원가입</a></li>
		</ul>
		</form>
	</div>

	<div class="login_commnon guest_login">

		<input type="text" name="od_id" id="od_id" class="login_input" tabindex="3" placeholder="주문번호">
		<input type="password" name="od_password" id="od_password" class="login_input" tabindex="4" placeholder="주문시 설정한 패스워드">
		<input type="submit" value="주문조회" class="btn_submit">
		<div class="member_confirm_line"></div>

	</div>


</div>






<?
include_once $nfor[skin_path]."tail.php";
?>