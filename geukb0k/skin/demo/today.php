<?
if(!(basename($_SERVER['PHP_SELF'])=="login.php" || basename($_SERVER['PHP_SELF'])=="faq.php" || basename($_SERVER['PHP_SELF'])=="customer_form.php" || basename($_SERVER['PHP_SELF'])=="agreement.php" || basename($_SERVER['PHP_SELF'])=="privacy.php" || basename($_SERVER['PHP_SELF'])=="notice_list.php" || basename($_SERVER['PHP_SELF'])=="cooperation_form.php" || basename($_SERVER['PHP_SELF'])=="cart.php" || basename($_SERVER['PHP_SELF'])=="order_list.php" || basename($_SERVER['PHP_SELF'])=="order_list.php" || basename($_SERVER['PHP_SELF'])=="order_list.php" || basename($_SERVER['PHP_SELF'])=="money_list.php" || basename($_SERVER['PHP_SELF'])=="member_confirm.php" || basename($_SERVER['PHP_SELF'])=="member_form.php" || basename($_SERVER['PHP_SELF'])=="zzim_list.php" || basename($_SERVER['PHP_SELF'])=="customer_list.php" || basename($_SERVER['PHP_SELF'])=="bank_account.php" || basename($_SERVER['PHP_SELF'])=="customer_view.php" || basename($_SERVER['PHP_SELF'])=="item.php")) {
?>

<style>
.today_view {
	width: 100px; letter-spacing: -1px; font-size: 11px; position: relative; z-index: 1000;
}
.flow.today_view {
	left: 50%; top: 20px; margin-left: 595px; position: fixed;
}
</style>
<script type="text/javascript">
<!--

function scrollDown(){
	if( $('div.dealInfo').length > 0 ) {
		var positionObj = $("#scrolldownPosition");
		var offset = positionObj.offset()
		var top = offset.top - document.documentElement.clientHeight + positionObj.height();
		window.scrollTo(0,top);
	}else{
		window.scrollTo(0,document.body.scrollHeight);
	}
}

$(window).scroll( function(){
	var scrollTop = $(document).scrollTop();
	var topprefix = 710;
	topprefix = 710;
	var rightbannerBottom = $('#tb2').position().top + topprefix + $('#tb2').height();

	if (scrollTop >= rightbannerBottom)
	{
		$('.today_view').attr('class','today_view flow');
	}
	else if (scrollTop < rightbannerBottom)
	{
		$('.today_view').attr('class','today_view');
	}
});
	
//-->
</script>

<input type="hidden" id="move_state">

<table cellpadding="0" cellspacing="0" border="0" align="center" style="border:solid 1px #c6cad1; font-family:돋움; width:105px; font-size:11px;" class="today_view">
<tr>
	<td>
	<?
	$zzim = sql_fetch("select count(*) as cnt from nfor_zzim where mb_no='$member[mb_no]'");
	?>

		<table cellpadding="0" cellspacing="0" border="0"  >
		<tr>
			<td style="font-size:11px; font-family:돋움; font-weight:bold;  border:solid 1px #242731;background-color:#2f3340;  text-align:left; height:30px; padding-left:10px;"><a href="zzim_list.php" style="color:#ffffff;">찜한상품 </a>
			<span style="color:#ff4700; font-weight:bold;"><?=$zzim[cnt]?></span></a></td>
		</tr>
		<tr>
			<td style="font-size:11px; font-family:돋움; font-weight:bold;  border:solid 1px #242731;background-color:#2f3340;  text-align:left; height:30px; padding-left:10px;"><a href="cart.php" style="color:#ffffff;">장바구니</a>
			<span style="color:#ff4700; font-weight:bold;"><?=cart_cnt($_SESSION[cart_id])?></span></a></td>
		</tr>
		<tr>
			<td width="105" height="31" style="font-family:돋움; font-size:11px; text-align:left; font-weight:bold;border:solid 1px #242731;background-color:#2f3340;padding-left:10px;">
			<a style="color:#ffffff;">최근본상품 <span style="color:#ff4700; font-weight:bold;"><?=count($_SESSION[recent_view])?></span></a>
			</td>
		</tr>
		<tr>
			<td style="text-align:center; padding:10px 0px;">	
			<?
			if(count($_SESSION[recent_view])){
			?>

			<ul>
			<?
			$k = 1;
			for($i=0; $i<count($_SESSION[recent_view]); $i++){
				$nforitem = sql_fetch("select * from nfor_item where it_id='{$_SESSION[recent_view][$i]}'");

					if($nforitem[it_new_win]){
						$nforitem[url] = "move.php?it_id=$item[it_id]";
					} else{
						$nforitem[url] = "item.php?it_id=$item[it_id]&category_id=$category_id";
					}
					
					if($i and $i%3==0) $k++;
					

			?>
			<li class="li_cl li_cl_<?=$k?>" style="<?=$k>1?"display:none;":""?>"><a href="<?=$nforitem[url]?>" target="<?=$nforitem[it_new_win]?"_blank":"_self"?>"><img src="<?=$nforitem[it_img_l]?"$nfor[path]/data/list/$nforitem[it_img_l]":"$nfor[path]/img/item_list_noimg.jpg"?>" style="width:80px; height:80px; margin-bottom:8px;"></a></li>
			<? } ?>
			</ul>


			<?
			$max_pg = ceil(count($_SESSION[recent_view])/3);

			?>

			
				<a href="javascript:today_pn('p')"><img src="<?=$nfor[skin_path]?>img/btn_0101.jpg"></a>

				<span id="nowviewid">1</span> / <?=$max_pg?>


				<a href="javascript:today_pn('n')"><img src="<?=$nfor[skin_path]?>img/btn_0202.jpg"></a>


				<input type="hidden" name="nownum" id="nownum" value="1">
				<script type="text/javascript">
				<!--
				function today_pn(ty){
					var nownum = Number($("#nownum").val());
					var max_pg = Number("<?=$max_pg?>");

					if(ty=="p"){
						nownum = nownum - 1;
					} else{
						nownum = nownum + 1;
					}
					
					if(nownum > max_pg){
						nownum = 1;
					}

					if(nownum < 1){
						nownum = max_pg;
					}

					$("#nowviewid").html(nownum);
					$("#nownum").val(nownum)

					$(".li_cl").hide();
					$(".li_cl_"+nownum).show();
				}
				//-->
				</script>
			
			<? } else{ ?>
			최근 본 상품이<br>
			없습니다.
			<? } ?>
			</td>
		</tr>
		<tr>
			<td style="border-top:solid 1px #c6cad1;" align="center" bgcolor="#e9eaee"><a href="javascript:self.scrollTo(0,0)"><img src="<?=$nfor[skin_path]?>img/toptoptop.jpg"></a></td>
		</tr>
		<tr>
			<td style="border-top:solid 1px #c6cad1;" align="center" bgcolor="#e9eaee"><a href="javascript:scrollDown()"><img src="<?=$nfor[skin_path]?>img/dndndnd.jpg"></a></td>
		</tr>
		</table>


	
	</td>
</tr>
</table>

<?
} else {
?>

<style>
.today_view {
	width: 100px; letter-spacing: -1px; font-size: 11px; position: relative; z-index: 1000;
}
.flow.today_view {
	left: 50%; top: 20px; margin-left: 595px; position: fixed;
}
</style>
<script type="text/javascript">
<!--

function scrollDown(){
	if( $('div.dealInfo').length > 0 ) {
		var positionObj = $("#scrolldownPosition");
		var offset = positionObj.offset()
		var top = offset.top - document.documentElement.clientHeight + positionObj.height();
		window.scrollTo(0,top);
	}else{
		window.scrollTo(0,document.body.scrollHeight);
	}
}

$(window).scroll( function(){
	var scrollTop = $(document).scrollTop();
	var topprefix = 220;
	topprefix = 220;
	var rightbannerBottom = $('#tb2').position().top + topprefix + $('#tb2').height();

	if (scrollTop >= rightbannerBottom)
	{
		$('.today_view').attr('class','today_view flow');
	}
	else if (scrollTop < rightbannerBottom)
	{
		$('.today_view').attr('class','today_view');
	}
});
	
//-->
</script>

<input type="hidden" id="move_state">

<table cellpadding="0" cellspacing="0" border="0" align="center" style="border:solid 1px #c6cad1; font-family:돋움; width:105px; font-size:11px;" class="today_view">
<tr>
	<td>
	<?
	$zzim = sql_fetch("select count(*) as cnt from nfor_zzim where mb_no='$member[mb_no]'");
	?>

		<table cellpadding="0" cellspacing="0" border="0"  >
		<tr>
			<td style="font-size:11px; font-family:돋움; font-weight:bold;  border:solid 1px #242731;background-color:#2f3340;  text-align:left; height:30px; padding-left:10px;"><a href="zzim_list.php" style="color:#ffffff;">찜한상품 </a>
			<span style="color:#ff4700; font-weight:bold;"><?=$zzim[cnt]?></span></a></td>
		</tr>
		<tr>
			<td style="font-size:11px; font-family:돋움; font-weight:bold;  border:solid 1px #242731;background-color:#2f3340;  text-align:left; height:30px; padding-left:10px;"><a href="cart.php" style="color:#ffffff;">장바구니</a>
			<span style="color:#ff4700; font-weight:bold;"><?=cart_cnt($_SESSION[cart_id])?></span></a></td>
		</tr>
		<tr>
			<td width="105" height="31" style="font-family:돋움; font-size:11px; text-align:left; font-weight:bold;border:solid 1px #242731;background-color:#2f3340;padding-left:10px;">
			<a style="color:#ffffff;">최근본상품 <span style="color:#ff4700; font-weight:bold;"><?=count($_SESSION[recent_view])?></span></a>
			</td>
		</tr>
		<tr>
			<td style="text-align:center; padding:10px 0px;">	
			<?
			if(count($_SESSION[recent_view])){
			?>

			<ul>
			<?
			$k = 1;
			for($i=0; $i<count($_SESSION[recent_view]); $i++){
				$nforitem = sql_fetch("select * from nfor_item where it_id='{$_SESSION[recent_view][$i]}'");

					if($nforitem[it_new_win]){
						$nforitem[url] = "move.php?it_id=$item[it_id]";
					} else{
						$nforitem[url] = "item.php?it_id=$item[it_id]&category_id=$category_id";
					}
					
					if($i and $i%3==0) $k++;
					

			?>
			<li class="li_cl li_cl_<?=$k?>" style="<?=$k>1?"display:none;":""?>"><a href="<?=$nforitem[url]?>" target="<?=$nforitem[it_new_win]?"_blank":"_self"?>"><img src="<?=$nforitem[it_img_l]?"$nfor[path]/data/list/$nforitem[it_img_l]":"$nfor[path]/img/item_list_noimg.jpg"?>" style="width:80px; height:80px; margin-bottom:8px;"></a></li>
			<? } ?>
			</ul>


			<?
			$max_pg = ceil(count($_SESSION[recent_view])/3);

			?>

			
				<a href="javascript:today_pn('p')"><img src="<?=$nfor[skin_path]?>img/btn_0101.jpg"></a>

				<span id="nowviewid">1</span> / <?=$max_pg?>


				<a href="javascript:today_pn('n')"><img src="<?=$nfor[skin_path]?>img/btn_0202.jpg"></a>


				<input type="hidden" name="nownum" id="nownum" value="1">
				<script type="text/javascript">
				<!--
				function today_pn(ty){
					var nownum = Number($("#nownum").val());
					var max_pg = Number("<?=$max_pg?>");

					if(ty=="p"){
						nownum = nownum - 1;
					} else{
						nownum = nownum + 1;
					}
					
					if(nownum > max_pg){
						nownum = 1;
					}

					if(nownum < 1){
						nownum = max_pg;
					}

					$("#nowviewid").html(nownum);
					$("#nownum").val(nownum)

					$(".li_cl").hide();
					$(".li_cl_"+nownum).show();
				}
				//-->
				</script>
			
			<? } else{ ?>
			최근 본 상품이<br>
			없습니다.
			<? } ?>
			</td>
		</tr>
		<tr>
			<td style="border-top:solid 1px #c6cad1;" align="center" bgcolor="#e9eaee"><a href="javascript:self.scrollTo(0,0)"><img src="<?=$nfor[skin_path]?>img/toptoptop.jpg"></a></td>
		</tr>
		<tr>
			<td style="border-top:solid 1px #c6cad1;" align="center" bgcolor="#e9eaee"><a href="javascript:scrollDown()"><img src="<?=$nfor[skin_path]?>img/dndndnd.jpg"></a></td>
		</tr>
		</table>


	
	</td>
</tr>
</table>


<?
}
?>