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
      .write_wrap { margin: 0; width: 100%;}
      .write { width: 100%}
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
      .wr_content { width: 100%;}
    </style>
<?}?>
<img class="bg" src="/assets/img/sub/sub_main_head_img.jpg">
<div class="write_wrap container" style="padding: 0;">
  <div class="write">
    <?
    $split_url = explode("/",$_SERVER['REQUEST_URI']);
    $bo_name = $split_url[3];
    ?>
    <?
    echo form_open_multipart('/board/write_process_event/'.$bo_name);
    ?>
    <form class="form form-horizontal" action="/board/write_process/<?=$bo_name?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="mb_id" value="<?=$this->session->userdata('id')?>">
      <div class="control-group row">
        <h4 class="align_center">글쓰기</h4>
      <ul>
        <div class="col m12 s12">

          <li>이름</li>
          <li><input type="text" name="wr_name" class="wr_name" value="" placeholder="이름을 입력해주세요."></li>
        </div>
        <div class="col m12 s12">
          <li>제목</li>
          <li><input type="text" name="wr_subject" class="wr_subject" value="" placeholder="제목을 입력해주세요."></li>
        </div>
        <div class="col m12 s12">
          <li>내용</li>
          <li>
            <textarea name="wr_content" class="wr_content" placeholder="내용을 입력해주세요." style="margin-bottom: 10px;"></textarea>
            <?
            if ($bo_name!="online_kor") {
            ?>
            <input type="hidden" name="MAX_FILE_SIZE" value="9999999">
            <input type="file" name="wr_file" class="wr_file" value="">
            <input type="file" name="wr_file2" class="wr_file" value="">
            <input type="file" name="wr_file3" class="wr_file" value="">
            <?}?>
          </li>
          
        </div>
        
        <div class="col m12 s12">
          <li style="width: 100%; text-align: center;">
            <a><button type="button" name="button" class="waves-effect waves-light comment_btn" value="전송" onclick="hp_check();">전송</button></a>

            <a href="/board/lists/<?=$this->uri->segment(3)?>/1"><button type="button" class="waves-effect waves-light comment_btn" value="목록으로">목록으로</button></a>
          </li>
        </div>
      </ul>
      </div>
    </form>
  </div>
</div>

<script>
function hp_check(){
  if ($(".wr_name").val() == "") {
    alert("이름을 입력해주세요.");
    $(".wr_name").focus();
    return false;
  }
  if ($(".wr_subject").val() == "") {
    alert("제목을 입력해주세요.");
    $(".wr_subject").focus();
    return false;
  }
  if ($(".wr_content").val() == "") {
    alert("내용을 입력해주세요.");
    $(".wr_content").focus();
    return false;
  }

  $("form").submit();
}
</script>