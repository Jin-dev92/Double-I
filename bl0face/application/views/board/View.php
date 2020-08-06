<style>
  footer { display: table; width: 100%;}
  .bg { display: block; width: 100%; min-width: 1200px;}
  .coment_from .col.m12.s12 { text-align: left; margin-bottom: 20px;}
  .coment_from .col.m12.s12 li { float: left;}
  .coment_from .col.m12.s12 li:nth-child(1) {
    width: 10%;
    text-align: right;
    line-height: 55px;
    margin-right: 10px;
  }
  .coment_from .col.m12.s12 li:nth-child(2) {
    width: 85%;
  }
</style>
<?
// 조회수
$table = 'g5_write_'.$this->uri->segment(3);
$num = $this->uri->segment(4);
$this->db->query('update '. $table.' set wr_hit=wr_hit+1 where wr_id='.$num);

if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
    // PC
} else {
    $list['page_scale'] = 5;
    ?>
    <!-- //MOBILE -->
    <style>
      * {max-width: 640px; margin: 0 auto;}
      .m_header { display: block !important;}
      .bg { display: none !important;}
      .con_wrap { width: 100%;}
      .view { padding-top: 50px;}
      .coment_from .col.m12.s12 li:nth-child(1) {
        width: 25%;
        text-align: right;
        line-height: 55px;
        margin-right: 10px;
      }
      .coment_from .col.m12.s12 li:nth-child(2) {
        width: 67%;
      }
      .wr_content { width: 100%;}
    </style>
<?}?>

<img class="bg" src="/assets/img/sub/sub_main_head_img.jpg">
<div class="">
<div class="view con_wrap">
  <?if ($this->session->userdata('id')==$views['mb_id'] || $this->session->userdata('level')==10) {
    ?>
    <a href="/board/delContent/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>"><div class="view_btn">삭제</div></a>
    <a href="/board/modify/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>"><div class="view_btn">수정</div></a>
  <?}

  ?>


  <ul>
    <li class="view_h"><?=$views['wr_subject']?> </li>
    <li class="view_info" style="background-color: #efefef !important;">
      <i class="fa fa-user"></i> <?if($views['mb_id'] == '' || !$views['mb_id']) { echo $views['wr_name']; }else{ echo $views['mb_id']; }?> <span class="view_date"> <?=$views['wr_datetime']?></span>
    </li>
    <? if($this->uri->segment(3) != 'after' || strlen($views['wr_content']) < 5){?>

      <li class="view_content">
      <p><?$clean_content = str_replace("\r\n","<br/>",$views['wr_content']); //줄바꿈 처리
        $content = str_replace("\u0020","&nbsp;",$clean_content); // 스페이스바 처리
        echo $content;?></p>
      </li>
    <?}?>

    <li class="view_img"><?
    $cnt_img = count($views['img']);
    if ($this->uri->segment(3)!="filler_review_kor") {
      for ($i=0; $i < $cnt_img; $i++) {?>
          <img src="/data/file/<?=$views['img'][$i]['bo_table']?>/<?=$views['img'][$i]['bf_file']?>" alt="" style="max-width: 100%;">
      <?}
    } else {
      for ($i=1; $i < $cnt_img; $i++) {?>
          <img src="/data/file/<?=$views['img'][$i]['bo_table']?>/<?=$views['img'][$i]['bf_file']?>" alt="" style="max-width: 100%;">
      <?}
    }?>
   </li>

  </ul>
</div>