<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-04-07
 * Time: 오전 9:50
 */

if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
    // PC
} else {
    //MOBILE?>
    <style>
      * {max-width: 640px; margin: 0 auto;}
      .m_header { display: block !important;}
      .m_wrap { position: relative; display: block; width: 100%; max-width: 640px; margin: 0 auto; padding-top: 35%;}
      .login { height: 85vh !important;}
    </style>
<?}
$bo_table = $_GET['bo_name'];
$bo_no = $_GET['bo_no'];
?>


<style>
  footer { display: table; width: 100%;}
  .login { width: 100%; padding-top: 0; height: 90vh;}
  .m_wrap { display: flex; flex-wrap: wrap; justify-content: center; flex-direction: column; height: 70vh;}
</style>


<div class="login" style="background-image: url('/assets/img/main01.jpg'); background-position: center; background-size: cover;">
  <div class="m_wrap">
    <h1 class="f_white fs_20">비밀글</h1>
    <div class="login_box">
      <form class="row" action="/board/secret_check/<?=$bo_table?>/<?=$bo_no?>" method="post">
        <h6 class="fs_10">
          비밀글 기능으로 보호된 글입니다.<br>
          작성자와 관리자만 열람하실 수 있습니다. 본인이라면 비밀번호를 입력하세요.
        </h6>
        
        <br>
        <div class="col m12 s12" style="margin-bottom: 20px;">
          <input type="password" name="mb_password" value="" placeholder="비밀번호" id="mb_password" style="font-family: 'Dotum'; width: 60%;">
        </div>
        <br>

        <input type="submit" class="secret_btn" value="확인">
      </form>
    </div>
    
    <div class="col m12 s12" style="text-align: center; margin: 10px auto">
      <a href="/board/lists/<?=$bo_table?>/1"><input type="button" class="waves-effect waves-light comment_btn" value="목록으로"></a>
    </div>
  </div>
</div>
