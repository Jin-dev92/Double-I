<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
    // PC
} else {?>
    <!-- //MOBILE -->
    <style>
      * {max-width: 640px; margin: 0 auto;}
      .m_header { display: block !important;}
      .agree { width: 100%; padding: 0px; background-color: #fff;}
      .agree .agree_box h4 { font-size: 1.8em; }
      .bg { position: relative; margin-top: 50px;}
    </style>
<?}?>
<div class="bg" style="width: 100%; height: auto; background-image: url(/assets/img/intro_content01_on.jpg); background-size: cover; background-position: center;">
  <div class="agree">
    <div class="agree_join" style="background-color: rgba(255, 255, 255, 0.9); padding: 20px 40px;">
      <h4 class="align_center">회원가입</h4>
      <?   echo form_open_multipart('/auth/signup_process');?>
      <form class="join_form"  method="post">
        <p>아이디
          <input type="text" name="mb_id" class="mb_id" value="" placeholder="아이디"></p>
        <p>비밀번호
         <input type="password" name="mb_password" class="mb_password" value="" placeholder="비밀번호"></p>
        <p>비밀번호 확인
          <input type="password" name="mb_password_re" class="mb_password_re" value="" placeholder="비밀번호 확인"></p>
        <p>이름
          <input type="text" name="mb_name" class="mb_name" value="" placeholder="이름"></p>
        <p>휴대폰번호
          <input type="tel" name="mb_hp" class="mb_hp" value="" placeholder="-를 빼고 입력해주세요.ex)01012341324"></p>
        <p>이메일
          <input type="email" name="mb_email" class="mb_email" value="" placeholder="이메일"></p>

        <p>SMS 수신동의<label style="margin-left: 10px;"><input type="checkbox" name="mb_sms" class="mb_sms" value="0"><span></span></label></p>
        <p>E-Mail 수신동의<label style="margin-left: 10px;"><input type="checkbox" name="mb_mailling" class="mb_mailling" value="0"><span></span></label></p>
        <p><input type="submit" name="" class="submit_join" value="회원가입"></p>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"> </script>
<script type="text/javascript">

	// 네이버 - 프리미엄로그 - 회원가입완료 스크립트 설치
	function sendNaverLog(){
		var _nasa= {};
		_nasa["cnv"] = wcs.cnv("2","1");
		wcs_do(_nasa);
	}

    $(".submit_join").click(function(){
      if ($(".mb_id").val() == "") {
        alert("아이디를 입력해주세요.");
        $(".mb_id").focus();
        return false;
      }
      if ($(".mb_id").val().length <4) {
        alert("4글자 이상 아이디만 가능합니다.");
        $(".mb_id").focus();
        return false;
      }
      if ($(".mb_password").val() == "") {
        alert("비밀번호를 입력해주세요.");
        $(".mb_password").focus();
        return false;
      }
      if ($(".mb_password_re").val() == "") {
        alert("비밀번호 확인을 해주세요.");
        $(".mb_password_re").focus();
        return false;
      }
      if ($(".mb_password").val() != $(".mb_password_re").val()) {
        alert("비밀번호가 다릅니다. 확인해주세요.");
        $(".mb_password").focus();
        return false;
      }
      if ($(".mb_password").val().length <7) {
        alert("6글자 이상 비밀번호만 가능합니다.");
        $(".mb_password").focus();
        return false;
      }
      if ($(".mb_name").val() == "") {
        alert("이름을 입력해주세요.");
        $(".mb_name").focus();
        return false;
      }
      if ($(".mb_hp").val() == "") {
        alert("핸드폰번호를 입력해주세요.");
        $(".mb_hp").focus();
        return false;
      }
      if ($(".mb_hp").val().length <10) {
        alert("핸드폰 번호를 정확히 입력해주세요.");
        $(".mb_hp").focus();
        return false;
      }
      if ($(".mb_email").val() == "") {
        alert("이메일을 입력해주세요.");
        $(".mb_email").focus();
        return false;
      }

      if ($(".mb_sms").is(":checked")) {
        $(".mb_sms").val("1");
      }else {
        $(".mb_sms").val("0");
      }
      if ($(".mb_mailling").is(":checked")) {
        $(".mb_mailling").val("1");
      }else {
        $(".mb_mailling").val("0");
      }

	  sendNaverLog();

      $(".join_form").attr("action", "/auth/signup_process");
      $(".join_form").submit();
    });

</script>
