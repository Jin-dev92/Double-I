<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
?>
<?php
include_once(G5_THEME_MOBILE_PATH.'/include/sub_main_head1.php');
?>

<div id="sub_title">
		<ul class="sub_ul">
			<li class="sub_li01"><img src="/theme/basic/include/img/sub_home_icon.png">HOME</li>
			<span>-</span>
			<li class="sub_li02">BIOFACE STORY</li>
		</ul>
</div>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" class="fz_wrap">

	<h2 id="container_title">
		<?php 
			if($bo_table == "online_kor") {
		?>
				ONLINE CONSULT
		<?PHP
			} else if($bo_table == "online_eng") {
		?>
				ONLINE CONSULT
		<?PHP
			} else if($bo_table == "online_chn") {
		?>
				ONLINE CONSULT
		<?PHP
			} else if($bo_table == "notice_kor") {
		?>
				NOTICE
		<?php
			} else if($bo_table == "notice_eng") {
		?>
				NOTICE
		<?php
			} else if($bo_table == "notice_chn") {
		?>
				NOTICE
		<?php
			} else if($bo_table == "filler_review_kor") {
		?>
				FILLER REVIEW
		<?php
			} else if($bo_table == "filler_review_eng") {
		?>
				FILLER REVIEW
		<?php
			} else if($bo_table == "filler_review_chn") {
		?>
				FILLER REVIEW
		<?php
			}
		?>
		<span class="sound_only"> List</span></h2>
    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> Category</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 페이지 정보 및 RSS { -->
	<div class="fz_header">
		<div class="fz_total_count"><span> Total <strong><?php echo number_format($total_count) ?></strong>Page</span></div>
		<? if ($rss_href) { ?><div class="fz_rss"><a class="list_btn btn_rss" href="<?=$rss_href?>" title="RSS">RSS</a></div><?php }?>
	</div>
    <!-- } 게시판 페이지 정보 및 RSS 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

	<table class="fz_board">
	<caption><?php echo $board['bo_subject'] ?> List</caption>
	<colgroup>
		<col width='50px' />
		<?php if($is_checkbox){?><col width='20px' /><?php }?>
		<col width='' />
		<col width='90px' />
		<col width='70px' />
		<col width='45px' />
		<?php if($is_good){?><col width='45px' /><?php }?>
		<?php if($is_nogood){?><col width='45px' /><?php }?>
	</colgroup>
	<thead>
	<tr>
		<th scope="col">Num</th>
		<?php if ($is_checkbox) { ?>
		<th scope="col">
			<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
			<input type="checkbox" id="chkall" />
		</th>
		<?php } ?>
		<th scope="col">Subject</th>
		<th scope="col">Writer</th>
		<th scope="col"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>Date</a></th>
		<th scope="col"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>Count</a></th>
		<?php if ($is_good) { ?><th scope="col"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>Good</a></th><?php } ?>
		<?php if ($is_nogood) { ?><th scope="col"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>Bad</a></th><?php } ?>
	</tr>
	</thead>
	<tbody>
	<?php
	for ($i=0; $i<count($list); $i++) {
		if($list[$i]['icon_secret']) $list[$i]['article_type'] = "<span class='icon_pack2 icon_secret2'>Secret</span>";
		else if($list[$i]['icon_file']) $list[$i]['article_type'] = "<span class='icon_pack2 icon_file2'>File</span>";
		else $list[$i]['article_type'] = "<span class='icon_pack2 icon_txt2'>Text</span>";

		if($list[$i]['icon_link']) $list[$i]['icon_pack'] .= "<span class='icon_pack icon_link'>Link</span>";
		if($list[$i]['icon_new']) $list[$i]['icon_pack'] .= "<span class='icon_pack icon_new'>New</span>";
		if($list[$i]['wr_reply']) $list[$i]['icon_reply'] = "<span class='icon_pack2 icon_reply re".strlen($list[$i][wr_reply])."'>Reply</span>";
	 ?>
	<tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
		<td class="td_num">
		<?php

		if ($list[$i]['is_notice']) // 공지사항
			echo '<strong class="icon_notice">Notice</strong>';
		else if ($wr_id == $list[$i]['wr_id'])
			echo "<span class=\"bo_current\">Current</span>";
		else
			echo $list[$i]['num'];
		 ?>
		</td>
		<?php if ($is_checkbox) { ?>
		<td class="td_chk">
			<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
			<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
		</td>
		<?php } ?>
		<td class="fz_subject">
			<?php
			echo $list[$i]['icon_reply'];
			echo $list[$i]['article_type'];
			if ($is_category && $list[$i]['ca_name']) {
			 ?>
			<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link">[<?php echo $list[$i]['ca_name'] ?>]</a>
			<?php } ?>

			<a href="<?php echo $list[$i]['href'] ?>">
				<?php echo $list[$i]['subject'] ?>
				<?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">Comment</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only"></span><?php } ?>
			</a>
			<?=$list[$i]['icon_pack']?>
		</td>
		<td class="sv_use"><?php echo $list[$i]['name'] ?></td>
		<td class="td_num"><?php echo $list[$i]['datetime'] ?></td>
		<td class="td_num"><?php echo $list[$i]['wr_hit'] ?></td>
		<?php if ($is_good) { ?><td class="td_num"><?php echo $list[$i]['wr_good'] ?></td><?php } ?>
		<?php if ($is_nogood) { ?><td class="td_num"><?php echo $list[$i]['wr_nogood'] ?></td><?php } ?>
	</tr>
	<?php } ?>
	<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="fz_empty_list">게시물이 없습니다.</td></tr>'; } ?>
	</tbody>
	</table>
	<div class="fz_footer">
        <?php if ($is_checkbox) { ?>
		<div id="fz_admin_select">
			<select name="btn_submit" id="">
				<option value="">선택명령</option>
				<option value="선택삭제">선택삭제</option>
				<option value="선택복사">선택복사</option>
				<option value="선택이동">선택이동</option>
			</select>
		</div>
        <?php } ?>
		<div class="fr">
            <!--<?php if ($list_href) { ?><a href="<?php echo $list_href ?>" class="list_btn btn_list">목록</a><?php } ?>
            <?php if ($admin_href) { ?><a href="<?php echo $admin_href ?>" class="list_btn btn_adm">관리자</a><?php } ?>
            <?php if ($write_href) { ?><a class="list_btn btn_write" href="<?=$write_href?>" title="글쓰기">글쓰기</a><?php } ?>-->
			  <?php if ($list_href) { ?><input type="button" class="list_btn btn_list" value="List" alt="List" onclick="location.href='<?php echo $list_href ?>'"/><?php } ?>
            <?php if ($admin_href) { ?><input type="button" class="list_btn btn_adm" value="Admin" alt="Admin" onclick="location.href='<?php echo $admin_href ?>' "/><?php } ?>
            <?php if ($write_href) { ?><input type="button" class="list_btn btn_write" value="Write" alt="Write" onclick="location.href='<?=$write_href?>'" /><?php } ?>
		</div>
	</div>

    </form>


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php 
	$write_pages=str_replace("처음", "<i class='fa fa-angle-left'></i><i class='fa fa-angle-left'></i>", $write_pages);
	$write_pages=str_replace("이전", "<i class='fa fa-angle-left'></i>", $write_pages);
	$write_pages=str_replace("다음", "<i class='fa fa-angle-right'></i>", $write_pages);
	$write_pages=str_replace("맨끝", "<i class='fa fa-angle-right'></i><i class='fa fa-angle-right'></i>", $write_pages);
	echo $write_pages; 
?>

<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
	<span class="select_box">
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>Subject</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>Content</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>Subject+Content</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>ID</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>ID(Coment)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>Writer</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>Writer(Coment)</option>
    </select>
	</span>
	<span class="placeholder">
		<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="i_text w_sbox required" size="15" maxlength="20">
		<label for="stx">Search Word</label>
	</span>
	<input type="submit" class="btn_search_submit" value="Search" alt="search" />

    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->
</div>

<?php if ($is_checkbox) { ?>
<script type="text/javascript">
$(function(){
	$("#chkall").click(function(){
		$(".fz_board tbody input[type='checkbox']").prop("checked", $(this).prop("checked"));
	});
	$("#fz_admin_select").select_box({
		height:24,
		onchange:function(p, $select, ul){
			if(!$select.val()) return false;

			if(!$(".fz_board tbody input[type='checkbox']:checked").length)
			{
				alert($select.val()+" 할 게시물을 하나 이상 선택하세요.");
				$select.find("option").eq(0).prop("selected", true).change();
				return false;
			}

			if($select.val()=="선택복사" || $select.val()=="선택이동")
			{
				var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

				$("#fboardlist input[name='sw']").val($select.val()=="선택복사" ? "copy" : "move");
				$("#fboardlist").attr("target", "move");
				$("#fboardlist").attr("action", "./move.php");
				$("#fboardlist").submit();
			}
			else if($select.val()=="선택삭제")
			{
				if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
					return false;

				$("#fboardlist").attr("target", "");
				$("#fboardlist").attr("action", "./board_list_update.php");
				$("#fboardlist").submit();
			}
		}
	});
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->

<script type="text/javascript">
$(function(){
	$(".fz_board tbody tr").hover(function(){
		$(this).addClass('bg_e');
	}, function(){
		$(this).removeClass('bg_e');
	});
	$(".select_box").select_box();
	set_placeholder($(".placeholder"));
});
</script>
