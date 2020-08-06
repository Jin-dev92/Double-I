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
</div>
  
</div>

<!-- <script type="text/javascript">
  $(".coment_submit").click(function(){
    if ($(".wr_name").val()=='' || $(".wr_password").val()=='' ||$(".wr_content").val()=='' ) {
      alert("내용을 체워주세요.");
      return false;
    }
    $(".coment_from_action").submit();
  })
  function coment_del(wr_id){
    $(".bo_target").val(wr_id);
    $(".del_cometn_form").submit();
  }
</script>
 -->