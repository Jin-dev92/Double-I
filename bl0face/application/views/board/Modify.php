<style>
  footer { display: table; width: 100%;}
  .bg { display: block; width: 100%; min-width: 1200px;}
  .control-group .col.m12.s12 {
    margin-bottom: 25px;
  }
  .control-group .col.m12.s12 li { float: left;}
  .control-group .col.m12.s12 li:nth-child(1) {
    width: 15%;
    text-align: right;
    line-height: 55px;
    margin-right: 18px;
  }
   .control-group .col.m12.s12 li:nth-child(2) {
    width: 80%;
  }
  .control-group { width: 60%;}
  button:focus { background-color: #c90000; }
</style>
<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
    // PC
} else {
    $list['page_scale'] = 5;
    ?>
    <!-- //MOBILE -->
    <style>
      * {max-width: 640px; margin: 0 auto;}
      .m_header { display: block !important;}
      .agree { width: 100%; padding: 20px; }
      .bg { display: none !important;}

      .write_wrap { margin: 0; width: 100%; padding: 0; margin: 0; width: 70%;}
      .container { max-width: 640px; min-width: 300px !important; padding: 0; padding-top: 40px; margin: 0 auto;}
      .control-group .col.m12.s12 li:nth-child(1) {
        width: 25%;
        text-align: right;
        line-height: 55px;
        margin-right: 10px;
      }
      .control-group .col.m12.s12 li:nth-child(2) {
        width: 67%;
      }
      .control-group h4 { margin-top: 50px;}
      .control-group { width: 100%;}
      .wr_content { width: 100%;}
    </style>
<?}?>
<img class="bg" src="/assets/img/sub/sub_main_head_img.jpg">
  <div class="write" style="width: 100%;">
    <?
    $bo_name = $this->uri->segment(3);
    $bo_no = $this->uri->segment(4);
    ?>
    <?
    echo form_open_multipart('/board/modify_process/'.$bo_name.'/'.$bo_no);
    ?>
    <form class="form-horizontal" action="/board/modify_process/<?=$bo_name?>/<?=$bo_no?>" method="post" enctype="multipart/form-data">
      <div class="control-group row">
      <h4 class="align_center">글 수정</h4>
      <ul>
        <div class="col m12 s12">
          <li>이름</li>
          <li><input type="text" name="wr_name" class="wr_name" value="<?=$modify['wr_name']?>" placeholder="이름을 입력해주세요."></li>
        </div>
        <div class="col m12 s12">
          <li style="line-height: 25px;">휴대폰번호<br>(비밀번호가 됩니다.)</li>
          <li><input type="text" name="wr_1" class="wr_1" value="<?=$modify['wr_1']?>" placeholder='"-"없이 입력해주세요.'></li>
        </div>
        <div class="col m12 s12">
          <li>제목</li>
          <li><input type="text" name="wr_subject" class="wr_subject" value="<?=$modify['wr_subject']?>" placeholder="제목을 입력해주세요."></li>
        </div>
        <div class="col m12 s12">
          <li>내용</li>
          <li>
            <textarea name="wr_content" class="wr_content" placeholder="내용을 입력해주세요." value="<?=$modify['wr_content']?>"><?=$modify['wr_content']?></textarea>
          </li>

        </li>
          <?
          if ($bo_name!="online_kor") {
          ?>
          <li><input type="file" name="wr_file" class="wr_file"
            value="<?
              if($modify['img'][0]['bf_file']){
                echo $modify['img'][0]['bf_file'];
              }
            ?>">
          </li>
        <?}?>

        <div class="col m12 s12" style="margin: 25px 0;">
          <li style="width: 100%; text-align: center;">
            <a><button type="submit" name="button" class="waves-effect waves-light comment_btn" value="전송">전송</button></a>

            <a href="/board/lists/<?=$this->uri->segment(3)?>/1"><button type="button" class="waves-effect waves-light comment_btn" value="전송">목록으로</button></a>

        </li>
        </div>
      </div>
      </ul>
    </form>

  </div>