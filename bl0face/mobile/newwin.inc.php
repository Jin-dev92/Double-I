<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (!defined('_SHOP_')) {
    $pop_division = 'comm';
} else {
    $pop_division = 'shop';
}

$sql = " select * from {$g5['new_win_table']}
          where '".G5_TIME_YMDHIS."' between nw_begin_time and nw_end_time
            and nw_device IN ( 'both', 'mobile' ) and nw_division IN ( 'both', '".$pop_division."' )
          order by nw_id asc ";
$result = sql_query($sql, false);
?>

<!-- 팝업이동 스크립트 -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script> 
<!--//-->

<!-- 팝업레이어 시작 { -->
<div id="hd_pop">
    <h2>팝업레이어 알림</h2>

<?php
for ($i=0; $nw=sql_fetch_array($result); $i++)
{
    // 이미 체크 되었다면 Continue
    if ($_COOKIE["hd_pops_{$nw['nw_id']}"])
        continue;
?>

    <?php if(G5_IS_MOBILE) { //모바일버전일때 좌측으로 붙임?>
    <div id="hd_pops_<?php echo $nw['nw_id'] ?>" class="hd_pops" style="top:5px;left:5px;">
    <?php } else { //PC버전일때 표시?>
    <div id="hd_pops_<?php echo $nw['nw_id'] ?>" class="hd_pops" style="top:<?php echo $nw['nw_top']?>px;left:<?php echo $nw['nw_left']?>px;">
    <?php } //닫기?>
    
        <div class="hd_pops_con" style="width:<?php echo $nw['nw_width'] ?>px;height:<?php echo $nw['nw_height'] ?>px; padding:<?php echo $nw['nw_padding']; ?>px; -webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;">
            <?php echo conv_content($nw['nw_content'], 1); ?>
        </div>      
        <div class="hd_pops_footer">
            <?php if ($nw['nw_disable_hours'] > '0') { // 0 이상일때만 나타남?>
            <button class="hd_pops_reject hd_pops_<?php echo $nw['nw_id']; ?> <?php echo $nw['nw_disable_hours']; ?>" style="float:left;"><i class="fa fa-pause"></i> <strong><?php echo $nw['nw_disable_hours']; ?></strong>시간 동안 다시 열지않습니다.</button>
            <?php } ?>
            <button class="hd_pops_close hd_pops_<?php echo $nw['nw_id']; ?>" style="font-size:20px; font-weight:lighter; padding:0px 10px">×</button>
        </div>
    </div>
<?php }
if ($i == 0) echo '<span class="sound_only">팝업레이어 알림이 없습니다.</span>';
?>
</div>
<!-- } 팝업레이어 끝 -->

<script>
$(function() {
    $(".hd_pops_reject").click(function() {
        var id = $(this).attr('class').split(' ');
        var ck_name = id[1];
        var exp_time = parseInt(id[2]);
        $("#"+id[1]).css("display", "none");
        set_cookie(ck_name, 1, exp_time, g5_cookie_domain);
    });
    $('.hd_pops_close').click(function() {
        var idb = $(this).attr('class').split(' ');
        $('#'+idb[1]).css('display','none');
    });
});
</script>

<!-- 팝업이동 스크립트 -->
<script type="text/javascript">
	$(document).ready(function(){
		$(".hd_pops").draggable();
	});
</script>
<!--//-->