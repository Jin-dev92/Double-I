<?
include_once "path.php";
?>
<div class="sort_wrap">

	<select name="sort" class="sort_select">
		<option value="1" <?=$sort=="1"?"selected":""?>>인기순
		<option value="2" <?=$sort=="2"?"selected":""?>>최신순
		<option value="3" <?=$sort=="3"?"selected":""?>>마감순
		<option value="4" <?=$sort=="4"?"selected":""?>>낮은가격순
		<option value="5" <?=$sort=="5"?"selected":""?>>높은가격순
	</select>
	<img src="<?=$nfor[skin_path]?>img/listico0<?=$view?>.png" class="list_chg_btn">

</div>

<div class="item_list_wrap"><ul class="item_list3"><? include_once "inc_item_list.php"; ?></ul> <div style="margin:0 auto; text-align:center; padding:10px;"><?=$pagelist?></div></div>

<script type="text/javascript">
$(function() {
	$("img.lazy").lazyload({
		skip_invisible : true,
		effect : "fadeIn"
	});
});
</script>