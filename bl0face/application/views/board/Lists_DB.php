<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
    // PC
} else {
    // $list['page_scale'] = 5;
    ?>
    <!-- //MOBILE -->
    <style>
      * {max-width: 640px; margin: 0 auto;}
      .m_header { display: block !important;}
      .agree { width: 100%; padding: 20px; }
      .bg { display: none !important;}
      .container { max-width: 640px; min-width: 300px !important; padding: 0; width: 100%;}
      .list { padding-top: 60px; padding: 60px 5px 0 5px;}
    </style>
<?}?>
<style>
.bg { display: block; width: 100%; min-width: 1200px;}
.container { min-width: 1200px;}
.board_title { padding-left: 0}
.list_info { text-align: center;}
</style>

<img class="bg" src="/assets/img/sub/sub_main_head_img.jpg">

<div class="container">
<div class="list">
  <h1 class="board_title align_center"><?=$list['board_title']?></h1>

  <ul>
    <?if($this->uri->segment(3)=='kakao'){?>
      <li class="li_head">
        <div class="list_info" style="width: 5%;">No.</div>
        <div class="list_info" style="width: 10%;">성명</div>
        <div class="list_info" style="width: 15%;">연락처</div>
        <div class="list_info" style="width: 15%;">관심부위</div>
        <div class="list_info" style="width: 35%;">메모</div>
        <div class="list_info" style="width: 20%;">날짜</div>
      </li>
    <?} else {?>
      <li class="li_head">
        <div class="list_info" style="width: 3%;">No.</div>
        <div class="list_info" style="width: 7%;">성명</div>
        <div class="list_info" style="width: 15%;">연락처</div>
        <div class="list_info" style="width: 20%;">관심부위</div>
        <div class="list_info" style="width: 25%;">메모</div>
        <div class="list_info" style="width: 15%;">상담시간</div>
        <div class="list_info" style="width: 15%;">등록날짜</div>

      </li>
    <?}?>
<?
    $list['page_limit'] =8;
    $list['page_scale'] =8;
    
    $x_idx =1;
    $page_max = $list['page'] * $list['page_limit'];
    $page_min = $page_max- $list['page_limit'];
   
    
    
      $no = 1;
      foreach ($list as $entry) {
        if($list['total']=='0'){
          echo '데이터가 존재하지 않습니다.';
        }
        if(!$entry['num']){
          break;
        }

        if ($x_idx > $page_max) {
          break;
        }

        if ($x_idx <= $page_max && $x_idx >= $page_min+1) {

?>
        <?if($this->uri->segment(3)=='kakao'){?>
          <li>
            <div class="list_info" style="width: 5%;"> <?=$entry['num']?></div>
            <div class="list_info" style="width: 10%;"> <?=$entry['name']?></div>
            <div class="list_info" style="width: 15%;"> <?=$entry['tel']?></div>
            <div class="list_info" style="width: 15%;"> <?=$entry['part']?></div>
            <div class="list_info" style="width: 35%; text-align: left;"> <?=$entry['memo']?></div>
            <div class="list_info" style="width: 20%;"> <?=$entry['date']?></div>
          </li>
        <?} else {?>
          <li>
            <div class="list_info" style="width: 3%;"> <?=$entry['num']?></div>
            <div class="list_info" style="width: 7%;"> <?=$entry['name']?></div>
            <div class="list_info" style="width: 15%;"> <?=$entry['tel']?></div>
            <div class="list_info" style="width: 20%;"> <?=$entry['part']?></div>
            <div class="list_info" style="width: 25%; text-align: left;"> <?=$entry['memo']?></div>
            <div class="list_info" style="width: 15%;"> <?=$entry['time']?></div>
            <div class="list_info" style="width: 15%;"> <?=$entry['date']?></div>
          </li>
        <?}?>
<?
        }
        $x_idx++;
        $no++;
      }
?>
  </ul>

  <div class="paging_line">
    <ul>
      <li class="f_e_li"><a href="/board/lists_DB/<?=$this->uri->segment(3)?>/1">처음</a></li>
      <?
      $page = $this->uri->segment(4);
      if ($page<1) {
        $page=1;
      }
        $total_page = ceil($list['total']/$list['page_scale']);
        $start_page = ((ceil($page/$list['page_scale'])-1)*$list['page_scale'])+1;
        $end_page = $start_page + $list['page_scale']-1;

        if ($end_page >=$total_page) {
            $end_page = $total_page;
        }
        if ($start_page>$list['page_scale'])
        {
          echo "<li><a href='/board/lists_DB/".$this->uri->segment(3)."/".($start_page-1)."'>이전</a></li>";
        }
        $paging_str="";
        if ($total_page>=1) {
          for ($i=$start_page; $i <=$end_page ; $i++) {
            if ($page==$i) {
              $paging_str .="<li class='paging_active'>[$i]</li>";
            }else {
              $paging_str .="<li><a href='/board/lists_DB/".$this->uri->segment(3)."/".$i."'>".$i."</a></li>";
            }
          }
        }
        echo $paging_str;
      ?>
      <li class="f_e_li"><a href="/board/lists_DB/<?=$this->uri->segment(3)?>/<?=$start_page+$list['page_scale']?>">다음</a></li>
    </ul>

  </div>
</div>
</div>


<script>
$(document).ready(function(){
  // $('.m_header_info li:eq(5)').trigger('click');
  $('.m_header_tab ul:eq(5) li:eq(4)').addClass('active');
});
</script>