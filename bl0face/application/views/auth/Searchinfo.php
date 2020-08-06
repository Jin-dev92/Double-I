<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-04-07
 * Time: 오전 9:50
 */
?>
<style>
  footer { display: table; width: 100%;}
  .login { width: 100%; padding-top: 0; height: 95vh;}
  .m_wrap { display: flex; flex-wrap: wrap; justify-content: center; flex-direction: column; height: 70vh;}
</style>

<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
    // PC
} else {
    //MOBILE?>
    <style>
      * {max-width: 640px; margin: 0 auto;}
      .m_header { display: block !important;}
      .m_wrap { position: relative; display: block !important; width: 100%; max-width: 640px; margin: 0 auto; padding-top: 35%;}
      .login { height: 100vh !important;}
    </style>
<?}
?>



<div class="login" style="background-image: url('/assets/img/main01.jpg'); background-position: center; background-size: cover;">
  <div class="m_wrap">
    <h1 class="f_white fs_20">비밀번호찾기</h1>
      
    <div class="login_box">
      <form class="row" action="/auth/find_pw" method="post">
        <div class="col m12 s12" style="margin-bottom: 20px;">
          <h6>회원가입 시 등록하신 아이디와 이메일 주소를 입력해 주세요.</h6>
        </div>
        <div class="col m12 s12" style="margin-bottom: 20px;">
          <label for="mb_id">ID</label>
          <input type="text" name="mb_id" value="" placeholder="아이디" id="mb_id" style="width: 60%;">
        </div>
        <div class="col m12 s12" style="margin-bottom: 20px;">
          <label for="mb_id">E-MAIL</label>
          <input type="text" name="mb_email" value="" placeholder="메일주소" id="mb_password" style="font-family: 'Dotum'; width: 60%;">
        </div>
        <input type="submit" value="확인">
      </form>
    </div>

    <div class="col m12 s12" style="text-align: center; margin: 10px auto">
      <a href="/auth/login" "><input type="button" class="waves-effect waves-light comment_btn" value="돌아가기"></a>
    </div>
  </div>
</div>
