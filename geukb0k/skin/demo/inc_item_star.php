<div class="item_star_wrap">
	<div class="item_star_info">
		* 상품평은 <span class="color">구매 고객님</span>만 작성하실 수 있습니다.<br>
		* <span class="color">상품과 관계없는 글, 양도, 광고성, 욕설, 비방 도배</span> 등의 글은 예고 없이 삭제됩니다.<br>
		* 구매후기 작성은 구매하신 고객님에 한해 후기작성하기를 이용하여 작성이 가능합니다 
	

		<a href="item_star_form.php?it_id=<?=$item[it_id]?>">
		<span style=" cursor:pointer; position:absolute; right:30px; top:25px; width:130px; height:80px; border:solid 1px #d32f2f; background-color:#d32f2f; font-size:14px; color:#fff; letter-spacing:-0.5px; text-align:center; display:block;line-height:80px;">후기작성하기</span>
		</a>
	</div>



<style>


/* 베스트리스트*/
.star_best_list { margin-top:10px; }
.star_best_list li:first-child { border-top:none; }
.star_best_list li { padding:15px 10px; border-top:solid 1px #ededed; background-color:#f4f6ef; }
.star_best_list .star_memo { color:#555; font-size:13px; line-height:21px; overflow:hidden; text-overflow:ellipsis; -webkit-line-clamp:4; display:-webkit-box; -webkit-box-orient:vertical; width:98%; margin:10px;}
.star_best_list li .star_list_name { position:relative; float:left; font-size:13px; color:#000; }

.staricon{ display:inline-block; position:relative; width:80px; height:15px; background:url('<?=$nfor[skin_path]?>img/star.png');background-size:87px auto; vertical-align:middle; }
.staricon em{ position:absolute; left:0px; top:0px; height:15px; background:url('<?=$nfor[skin_path]?>img/star.png');background-size:87px auto; }

.star_best_list .star_list_date { float:right; font-size:11px; color:#999; }  
.star_best_list .star_list_btn { width:100%; text-align:left; margin-top:5px; }
.star_best_list .star_list_btn button { padding:0px; margin:10px 0px ; border:solid 1px #e5e5e5; width:48px; height:25px; line-height:25px; text-align:center; font-size:12px; text-decoration:none; color:#444;background-color:#FFFFFF; border-radius:3px; }

</style>

<ul class="star_best_list">
<?
$result = sql_query("select * from nfor_item_star where it_id='$item[it_id]' and wr_datetime <= '$nfor[ymdhis]' and wr_reply='0' and wr_view='0' and wr_best > 0 order by wr_best desc limit 3");
for($i=0; $data=sql_fetch_array($result); $i++){
?>
<li class="q_li">

	<div style="margin-bottom:10px;">
		<span class="star_list_name"><b class="staricon"><em style="width:<?=$data[wr_star]*20?>%;"></em></b> <?=print_mb_info($data)?></span>
		<span class="star_list_date"><?=substr($data[wr_datetime],0,10)?></span>
		<div style="clear:both;"></div>
	</div>

	<div class="title_content">

		<div class="title">
			<? if($data[wr_img]){ ?>
			<div class="title_wrap">

				<div class="photo_wrap"><img src="<?="$nfor[path]/data/star/$data[wr_img]"?>"></div>
				<div class="star_memo"><?=item_star_memo($data)?></div>
				
			</div>
			<? } else{ ?>
			<div class="star_memo"><?=item_star_memo($data)?></div>
			<? } ?>
		</div>

		<div class="content" style="display:none;">
			
			<div class="star_memo"><?=item_star_memo($data)?></div>
			<? if($data[wr_img]){ ?><img src="<?="$nfor[path]/data/star/$data[wr_img]"?>" style="width:100%;"><? } ?>
		
		</div>

	</div>



	<? if(($member[mb_no] and $data[mb_no]==$member[mb_no]) or $is_admin){ ?>
	<div class="star_list_btn">
		<button class="star_update" data-wr_id="<?=$data[wr_id]?>">수정</button>
		<button class="star_delete" data-wr_id="<?=$data[wr_id]?>">삭제</button>
	</div>
	<? } ?>

</li>
<?
}
?>
</ul>








	<form name="item_star_list" class="form_star_reply form_star_delete" method="post">
	<input type="hidden" name="mode" id="mode_star">
	<input type="hidden" name="it_id" id="it_id" value="<?=$item[it_id]?>">
	<input type="hidden" name="wr_reply" id="wr_reply_star">
	<input type="hidden" name="wr_id" id="wr_id_star">
	<ul class="star_list"><? include_once "item_star_list.php"; ?></ul>
	</form>
</div>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function() {

	$(document).on("click", ".star_update", function (){
		var wr_id = $(this).data('wr_id');
		location.href = "item_star_form.php?it_id="+it_id+"&wr_id="+wr_id;
	});

	$(document).on("click", ".star_delete", function (){
		var wr_id = $(this).data('wr_id');
		var mode = $(this).data('mode');
		$("#mode_star").val(mode);
		$('#wr_id_star').val(wr_id);
		$('#wr_reply_star').val('');
		if(confirm("상품평 삭제시에는 복구 및 재등록은 불가능합니다.\n정말 삭제하시겠습니까?")){
			$.ajax({
				type: "post",
				data : $(".form_star_"+mode).serialize(),
				url: "item_star_form.php",
				success: function(response){
					var json = $.parseJSON(response); 
					if(json["result"]=="ok"){
						item_star_load(it_id,'1');
					} else{
						alert(json["msg"]);
					}
				}
			});
		}
	});

});
//-->
</SCRIPT>