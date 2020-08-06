<style media="screen">
  .wrap{background: url("/assets/img/<? if(count($this->uri->segment(1))>0){echo $this->uri->segment(1);}else{echo "main";} ?>_bg.jpg")no-repeat center center fixed; background-size: cover!important;}
</style>
<div class="m_head">
  <img src="/assets/img/<?=$this->uri->segment(1)?>_bg_m.jpg" alt="">
</div>
