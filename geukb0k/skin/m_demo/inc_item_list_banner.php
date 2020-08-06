<!-- 상품목록배너1 -->
<?
$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='index_banner2' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc limit 1");
while($banner=sql_fetch_array($que)){
?>
<div class="item_list_banner1"><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt=""></a></div>
<? } ?>
<style>
.item_list_banner1 { margin:10px 0px; }
.item_list_banner1 img{ width:100%; }
</style>
<!-- //상품목록배너1 -->
<!-- 상품목록배너2 -->
<?
$que = sql_query("select * from nfor_banner where wr_use='1' and wr_code='m_shoppingbanner1' and wr_sdate<='$nfor[ymdhis]' and wr_edate>='$nfor[ymdhis]' order by wr_rank asc limit 1");
while($banner=sql_fetch_array($que)){
?>
<div class="item_list_banner2"><a href="<?=$banner[wr_banner_link]?>" target="<?=$banner[wr_target]?>"><img src="<?="$nfor[path]/data/banner/$banner[wr_banner_img]"?>" alt=""></a></div>
<? } ?>
<style>
.item_list_banner2 img{ width:100%; }
</style>
<!-- //상품목록배너2 -->