<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-04-12
 * Time: 오후 1:50
 */
?>
<style>
  .agree{ width: 40%; max-width: 600px; padding: 50px 0 20px 0;}
  .bg { height: 95vh; background-image: url(/assets/img/intro_content01_on.jpg); background-size: cover; background-position: center;}

</style>
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
      .bg { position: relative; margin-top: 50px; height: auto; background-image: none;}
    </style>

<?}
// print_r($data);

?>

<!-- main content start here -->
<div class="bg" style="width: 100%;">
  <div class="agree" style="">
    <div class="agree_join" style="background-color: rgba(255, 255, 255, 0.9); padding: 20px 40px;">
      <h4 class="align_center">마이페이지</h4>
      <?   echo form_open_multipart('/auth/modify_process');?>
      <form class="join_form"  method="post">
          <p>아이디
            <input type="text" name="mb_id" class="mb_id" value="<?=$data['mb_id']?>" placeholder="아이디" readonly></p>
          <p>비밀번호
           <input type="password" name="mb_password" class="mb_password" value="" placeholder="비밀번호"></p>
          <p>비밀번호 확인
            <input type="password" name="mb_password_re" class="mb_password_re" value="" placeholder="비밀번호 확인"></p>
          <p>이름
            <input type="text" name="mb_name" class="mb_name" value="<?=$data['mb_name']?>" placeholder="이름"></p>
          <p>휴대폰번호
            <input type="tel" name="mb_hp" class="mb_hp" value="<?=$data['mb_hp']?>" placeholder="-를 빼고 입력해주세요.ex)01012341324"></p>
          <p>이메일
            <input type="email" name="mb_email" class="mb_email" value="<?=$data['mb_email']?>" placeholder="이메일"></p>
          
          <p>
            SMS 수신동의
            <label style="margin-left: 10px;">
              <?if($data['mb_sms']==1){?>
                <input type="checkbox" name="mb_sms" class="mb_sms" value="1" checked><span></span>
              <?} else {?>
                <input type="checkbox" name="mb_sms" class="mb_sms" value="0"><span></span>
              <?}?>
            </label>
          </p>
          <p>
            E-Mail 수신동의
            <label style="margin-left: 10px;">
              <?if($data['mb_mailling']==1){?>
              <input type="checkbox" name="mb_mailling" class="mb_mailling" value="1" checked><span></span>
              <?} else {?>
                <input type="checkbox" name="mb_mailling" class="mb_mailling" value="0"><span></span>
              <?}?>
            </label>
          </p>

        <p><input type="submit" name="" class="submit_join" value="수정"></p>
      </form>
    </div>
  </div>

  <div class="col m12 s12" style="text-align: center; margin: 10px auto 30px auto;">
    <a href="/Main"><input type="button" class="waves-effect waves-light comment_btn" value="메인페이지"></a>
    <a href="/auth/logout_process" target="_self"><input type="button" class="waves-effect waves-light comment_btn" value="로그아웃" onclick="confirm_logout()"></a>
  </div>
</div>




<script type="text/javascript">
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

      if ($(".mb_password").val() != $(".mb_password_re").val()) {
        alert("비밀번호가 다릅니다. 확인해주세요.");
        $(".mb_password").focus();
        return false;
      }
      if ($(".mb_password").val().length <7 && $(".mb_password").val() != '') {
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

      // if ($(".mb_sms").is(":checked")) {
      //   $(".mb_sms").val("1");
      // }else {
      //   $(".mb_sms").val("0");
      // }
      // if ($(".mb_mailling").is(":checked")) {
      //   $(".mb_mailling").val("1");
      // }else {
      //   $(".mb_mailling").val("0");
      // }
        $(".join_form").attr("action", "/auth/modify_process");
        $(".join_form").submit();
    });

</script>