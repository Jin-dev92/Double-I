<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/css/fd_style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 1);
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
<div id="bo_list" >
	<h2 id="container_title">
		<?php 
			if($bo_table == "qna_kor") {
		?>
				 Q&A
		<?PHP
			} else if($bo_table == "qna_eng") {
		?>
				 Q&A
		<?PHP
			} else if($bo_table == "qna_chn") {
		?>
				 Q&A
		<?php
			}
		?><span class="sound_only"> 목록</span></h2>

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> Page
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">Manager</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">Write</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

	<div class="list-title">
		<ul>
			<li class="fd_chk">
			<?php if ($is_checkbox) { ?>
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            <?php } ?>
			</li>
		
		</ul>
	</div>
	<div class="tbl_head01 tbl_wrap">
		<ul id="fd_accordion" class="accordion">
		<?php
		for ($i=0; $i<count($list); $i++) {
		 ?>
			<li>
				<?php if ($is_checkbox) { ?>
				<span class="fd_chk">
					<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
					<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
				</span>
				<?php } ?>
				<span class="fd_num"><?php echo $list[$i]['num']; ?></span>
				<h3>
					<a class="cd-faq-trigger"><?php echo $list[$i]['subject'] ?></a>
				</h3>
				<div class="panel loading">
					<!-- <h4><?php echo $list[$i]['subject'] ?></h4> -->
					<span><?php echo cut_str($list[$i]['wr_content'], 2000); ?></span>
					<?php if ($is_admin == 'super' || $is_auth) {  ?>
					<span>
					<a href="<?php echo $list[$i]['href'] ?>" class="btn_admin">Modified</a>
					</span>
					<?php }  ?>
				</div>
			</li>
		<?php } ?>
			<?php if (count($list) == 0) { echo '<li>게시물이 없습니다.</li>'; } ?>
		</ul>
	</div>


    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="delete" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="copy" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="move" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">LIST</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">WRITE</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<!-- 게시판 검색 시작 { -->
<style>


</style>
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">object</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>Subject</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>Content</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>Subject+Content</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="15">
    <input type="submit" value="Search" class="btn_submit">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->

<script type="text/javascript" src="<?php {echo $board_skin_url;}?>/js/jquery.accordion.2.0.js" charset="utf-8"></script>
<script type="text/javascript">
	$('#fd_accordion').accordion({
		canToggle: true
	});
	$(".loading").removeClass("loading");
</script>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "Select one or more posts to.");
        return false;
    }

    if(document.pressed == "copy") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "move") {
        select_copy("move");
        return;
    }

    if(document.pressed == "delete") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
