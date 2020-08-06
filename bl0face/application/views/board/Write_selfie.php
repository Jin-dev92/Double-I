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
  .select-wrapper li { width: 100% !important; text-align: left !important;}
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

    ?>

    <form class="form form-horizontal" action="/board/write_process_selfie/<?=$bo_name?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="mb_id" value="<?=$this->session->userdata('id')?>">
      <div class="control-group row">
        <h4 class="align_center">글쓰기</h4>
      <ul>
        <div class="col m12 s12">

          <li>이름</li>
          <li><input type="text" name="wr_name" class="wr_name" value="" placeholder="이름을 입력해주세요."></li>
        </div>
        <div class="col m12 s12">
          <li>나이</li>
          <li><input type="text" name="wr_age" class="wr_age" value="" placeholder="이름을 입력해주세요."></li>
        </div>
        <div class="col m12 s12">
          <li>수술부위</li>
          <li><input type="text" name="wr_subject" class="wr_subject" value="" placeholder=",로 구분하여 입력해주세요."></li>
        </div>
        <div class="col m12 s12">
          <li>분류</li>
          <li>
            <input type="hidden" name="cate">
            <div class="input-field col s12">
              <select multiple name="category1">
                <option value="" disabled selected>분류를 선택해주세요.</option>
                <option value="fullface">풀페이스필러</option>
                <option value="lifting">리프팅</option>
                <option value="body">바디필러</option>
              </select>
            </div>
          </li>
        </div>
        <div class="col m12 s12">
          <li>내용</li>
          <li>
            <textarea name="" id="editor1"></textarea>
            <input type="hidden" name="wr_content" value="">
          </li>
          
        </div>
        <div class="col m12 s12">
          <li>메인사진</li>
          <input type="hidden" name="MAX_FILE_SIZE" value="9999999">
          <input type="file" name="wr_file" class="wr_file" value="">
          <input type="file" name="wr_file2" class="wr_file" value="">
          <input type="file" name="wr_file3" class="wr_file" value="">
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

<script src="/editor/cheditor.js"></script>
<!-- 에디터를 화면에 출력합니다. -->
<script type="text/javascript">
var myeditor = new cheditor();              // 에디터 개체를 생성합니다.
myeditor.config.editorHeight = '200px';     // 에디터 세로폭입니다.
myeditor.config.editorWidth = '100%';       // 에디터 가로폭입니다.
myeditor.inputForm = 'editor1';             // 위에 있는 textarea의 id입니다. 주의: name 속성 이름이 아닙니다.
myeditor.run();                             // 에디터를 실행합니다.
</script>

<script>
function hp_check(){
  if ($(".wr_name").val() == "") {
    alert("이름을 입력해주세요.");
    $(".wr_name").focus();
    return false;
  }
  if ($(".wr_age").val() == "") {
    alert("나이를 입력해주세요.");
    $(".wr_age").focus();
    return false;
  }
  if ($(".wr_subject").val() == "") {
    alert("수술부위를 입력해주세요.");
    $(".wr_subject").focus();
    return false;
  }

  if($('select[name=category1]').val() == ""){
    alert("분류를 선택해주세요.");
    return false;
  }

  if ($('.cheditor-editarea').contents().find('body').html() == "") {
    alert("내용을 입력해주세요.");
    $(".wr_content").focus();
    return false;
  }

  // 에디터 내용
  var getval = $('.cheditor-editarea').contents().find('body').html();
  $('input[name=wr_content]').attr('value', getval);
  // console.log($('input[name=wr_content]').val());

  // 분류
  var foo = $('select[name=category1]').val();
  var cate = foo.join(',');
  $('input[name=cate]').val(cate);
  // console.log($('input[name=cate]').val());

  $("form").submit();
}
</script>
<script>
$(document).ready(function(){
  $('select').formSelect();

  var fileTarget = $('.filebox .upload-hidden');

  fileTarget.on('change', function(){ // 값이 변경되면
    if(window.FileReader){ // modern browser 
    var filename = $(this)[0].files[0].name; 
    }
    else { // old IE 
    var filename = $(this).val().split('/').pop().split('\\').pop(); //파일명만 추출
  }

    // 추출한 파일명 삽입
    $(this).siblings('.upload-name').val(filename);
  });
}); 

// 업로드한 이미지 정보를 얻는 예제입니다.
function showImageInfo() {
    var data = myeditor.getImages();
    if (data == null) {
        alert('올린 이미지가 없습니다.');
        return;
    }

    for (var i=0; i<data.length; i++) {
        var str = '사진 URL: ' + data[i].fileUrl + "\n";
        str += '저장 경로: ' + data[i].filePath + "\n";
        str += '원본 이름: ' + data[i].origName + "\n";
        str += '저장 이름: ' + data[i].fileName + "\n";
        str += '사진 크기: ' + data[i].width + ' X ' + data[i].height + "\n";
        str += '파일 크기: ' + data[i].fileSize;

        alert(str);
    }
}

function cheditor3($id){
    return "document.getElementById('tx_{$id}').value = ed_{$id}.outputBodyHTML();";
}
</script>



