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
      .login { height: 85vh !important;}
    </style>
<?}
?>



<div class="login" style="background-image: url('/assets/img/main01.jpg'); background-position: center; background-size: cover;">
  <div class="m_wrap">
    <h1 class="f_white fs_20">로그인</h1>
    <div class="login_box">
      <?
      echo form_open_multipart('/auth/login_process/');
      ?>
      <form class="row" action="index.html" method="post">
        <div class="col m3 s12" style="margin-bottom: 20px;">
          <label for="mb_id">ID</label>
          <input type="text" name="mb_id" value="" placeholder="아이디" id="mb_id" style="width: 60%;">
        </div>
        <div class="col m9 s12">
          <label for="mb_id">PW</label>
          <input type="password" name="mb_password" value="" placeholder="비밀번호" id="mb_password" style="font-family: 'Dotum'; width: 60%;">
        </div>
        <input type="submit" value="로그인">
      </form>
    </div>

    <div class="join_line">
      <ul>
        <li><a href="/auth/Searchinfo">비밀번호 찾기</a></li>
        <li><a href="/auth/agree">회원가입</a></li>
      </ul>
    </div>
  </div>
</div>
