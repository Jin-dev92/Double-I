<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
  // PC
} else {
  //MOBILE
?>
  <style>
    .coment { width: 100% !important;}
  </style>
<?
}
?>
<div class="coment">
  <ul>
    <li class="coment_head" style="padding: 10px 20px;">답글</li>
    <form class="del_cometn_form" action="/board/delComent/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>" method="post">
      <input type="hidden" name="target" class="bo_target" value="">
      <?
      foreach ($coment as $coments){
        if (count($coment)<1) {
          ?>
          <li class="coment_none">댓글이 없습니다.</li>
          <?
        }
        ?>
        <li class="coment_con">
          <?
          if ($this->session->userdata('id')==$coments['mb_id'] || $this->session->userdata('level')==10) {
            ?>
          <div class="board_btn" onclick="coment_del(<?=$coments['wr_id']?>)">삭제</div>
          <?}?>
          <p style="background-color: #EFEFEF; font-weight:bold; font-size:18px;">
            작성자 : <?=$coments['wr_name']?>

          </p>
          <p>내용 : <?
            $clean_coment = str_replace("\r\n","<br/>",$coments['wr_content']); //줄바꿈 처리
            $clean_coment = str_replace("\u0020","&nbsp;",$clean_coment);
          echo $clean_coment; ?></p>
        </li>
        <?
      }?>
    </form>
  </ul>

  <div class="coment_from" style="padding-top: 20px;">
    <form class="coment_from_action row" action="/board/setComent/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>" method="post">
      <ul>
        <div class="col m12 s12">
          <li>작성자</li>
          <li> <input type="text" name="wr_name" class="wr_name" value="<?=$this->session->userdata('name')?>" placeholder="성함"></li>
        </div>
        <!-- <div class="col m12 s12">
          <li>비밀번호 </li>
          <li><input type="text" name="wr_password" class="wr_password" value="" placeholder="비밀번호"></li>
        </div>
        <div class="col m12 s12">
          <li>전화번호 </li>
          <li><input type="tel" name="wr_1" value=""></li>
        </div> -->
        <div class="col m12 s12">
          <li>내용 </li>
          <li><textarea name="wr_content" class="wr_content" rows="8" cols="80"></textarea></li>
        </div>
        <input type="hidden" name="wr_no" value="<?=$this->uri->segment(4)?>">
      </ul>
      <div class="col m12 s12" style="text-align: center;">
        <a><input type="button" name="button" class="waves-effect waves-light coment_submit comment_btn" value="답글 달기"></a>

        <a href="/board/lists/<?=$this->uri->segment(3)?>/1"><input type="button" class="waves-effect waves-light comment_btn" value="목록으로"></a>
      </div>
    </form>
  </div>
</div>
  
</div>

<form method="post" id="smsForm" name="smsForm" action="../../sms_send" target="_blank" style="display: none;">
  <br />받는 번호 <input type="text" name="rphone" value="<?=substr($views['wr_1'],0,3).'-'.substr($views['wr_1'],3,4).'-'.substr($views['wr_1'],7,4)?>"> 예) 011-011-111 , '-' 포함해서 입력.

  <br />
  보내는 번호  <input type="hidden" name="sphone1" value="070">
  <input type="hidden" name="sphone2" value="7618">
  <input type="hidden" name="sphone3" value="2199">
  <span id="sendPhoneList"></span>
  <br /> test flag <input type="text" name="testflag" maxlength="1" value="Y"> 예) 테스트시: Y
  <br />nointeractive <input type="text" name="nointeractive" maxlength="1"> 예) 사용할 경우 : 1, 성공시 대화상자(alert)를 생략.

          <br>
  <input type="submit" value="전송" id="sms_btn">
  <input type="hidden" name="action" value="go">
  발송타입 <span><input type="radio" name="smsType" value="S" checked>단문(SMS)</span>
  <!-- <span><input type="radio" name="smsType" value="L">장문(LMS)</span> --> <br />
  <!-- 제목 : <input type="text" name="subject" value="제목"> 장문(LMS)인 경우(한글30자이내)<br /> -->
  전송메세지

  <textarea name="msg" cols="30" rows="10" style="width:455px;">문의글에 답변이 등록되었습니다.&#13; <?echo htmlspecialchars($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?></textarea>
</form>


<script type="text/javascript">
  $(".coment_submit").click(function(){
    if ($(".wr_name").val()=='' || $(".wr_password").val()=='' ||$(".wr_content").val()=='' ) {
      alert("내용을 채워주세요.");
      return false;
    }

    var phone = $("input[name=rphone]").attr("value").length;
    if(phone == '13'){
      // console.log(phone);
      $('#sms_btn').trigger('click');
    } else {
      console.log('PHONE_NUM_ERROR');
    }
    
    $(".coment_from_action").submit();
  })
  function coment_del(wr_id){
    $(".bo_target").val(wr_id);
    $(".del_cometn_form").submit();
  }

  $('#sms_btn').on('click', function(){
    $.ajax({
      type : "post"
      , url : "../../sms_send"
      , cache : false
      , data : $("#smsForm").serialize()
    });
  })
        
    



</script>
