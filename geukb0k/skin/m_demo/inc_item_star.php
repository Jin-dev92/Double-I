<style>

/* 더보기버튼 */
.star_list_more { display:block; letter-spacing:-1px; color:#999; height:40px; line-height:40px; font-size:14px; text-align:center; border-top:solid 1px #f4f4f4;  }
.star_list_more b { display:inline-block; width:11px; height:7px; background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat ;  background-position:-200px -250px; background-size:320px auto; } 

/* 상품문의리스트*/
.star_list .q_li { padding:15px 10px; border-top:solid 1px #e5e5e5; }
.star_list .star_memo { color:#444; font-size:13px; letter-spacing:-1px; overflow:hidden; text-overflow:ellipsis; -webkit-line-clamp:4; display:-webkit-box; -webkit-box-orient:vertical;  }
.star_list .q_li .star_list_name { position:relative; float:left; font-size:13px; color:#999; letter-spacing:-1px; }

.staricon{ display:inline-block; position:relative; width:80px; height:15px; background:url('<?=$nfor[skin_path]?>img/star.png')no-repeat 0 -15px; background-size:87px auto; vertical-align:middle; }
.staricon em{ position:absolute; left:0px; top:0px; height:15px; background:url('<?=$nfor[skin_path]?>img/star.png')no-repeat 0 0; background-size:87px auto; }

.star_list .star_list_date { float:right; font-size:11px; color:#999; letter-spacing:-1px; }  
.star_list .star_list_btn { width:100%; text-align:left; margin-top:5px; }
.star_list .star_list_btn button { padding:0px; margin:0px; border:solid 1px #e5e5e5; width:48px; height:25px; line-height:25px; text-align:center; font-size:13px; text-decoration:none; color:#444; }






.star_list_sort { margin:10px; }
.star_list_sort li { float:left; margin:10px 5px 10px 0px; color:#888; font-size:12px; cursor:pointer; }
.star_list_sort li.on { color:#000; font-size:12px; }


.star_list_sort li b{ display:inline-block; width:11px; height:7px;background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat ;  background-position:-250px -300px; background-size:320px auto; }
.star_list_sort li.on b{ display:inline-block; width:11px; height:7px; background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat ;  background-position:-200px -300px; background-size:320px auto; }



.wrap_star_info { width:100%; padding:20px 0px; }





.wrap_bigpoint { width:100%; text-align:center; margin-bottom:10px; }

.bigstaricon{ display:inline-block; position:relative; width:134px; height:24px; background:url('<?=$nfor[skin_path]?>img/star.png')no-repeat 0 -23px; background-size:134px auto; vertical-align:middle; font-weight:normal; }
.bigstaricon em{ position:absolute; left:0px; top:0px; height:24px; background:url('<?=$nfor[skin_path]?>img/star.png')no-repeat 0 0; background-size:134px auto; }

.bigpoint { display:inline-block; font-size:32px; letter-spacing:-1px; color:#222; vertical-align:middle; }
.bigpointmax { display:inline-block; font-size:22px; color:#999; letter-spacing:-0.5px; vertical-align:middle; }



.wrap_star_select { width:100%; padding:10px 10px 0px 10px; box-sizing:border-box; -webkit-box-sizing:border-box; }

.star_select { display:table; width:100%; border-top:solid 1px #ddd; border-bottom:solid 1px #ddd; border-left:solid 1px #ddd; }
.star_select li { display:table-cell; background-color:#f4f4f4; text-align:center; border-right:solid 1px #ddd; position:relative; cursor:pointer; }
.star_select li a { display:block; height:36px; line-height:36px; font-size:14px; letter-spacing:-1px; text-decoration:none; color:#999; z-index:2; max-width:100%; overflow:hidden; }  

.star_select li a b { margin-left:3px; font-weight:normal; font-size:13px; }

.star_select li.on { position:relative; background-color:#fff;  }
.star_select li.on a { color:#555;  }

.star_select li.on a b { color:#86cf00; }





.title_content { cursor:pointer; }


.content { display:none; }

.title_wrap { padding-left:95px; position:relative; min-height:80px; }
.photo_wrap { position:absolute; top:0px; left:0px; }
.photo_wrap img { width:80px; height:80px; }






/* 베스트리스트*/
.star_best_list { margin-top:10px; }
.star_best_list li:first-child { border-top:none; }
.star_best_list li { padding:15px 10px; border-top:solid 1px #ededed; background-color:#f4f6ef; }
.star_best_list .star_memo { color:#444; font-size:13px; letter-spacing:-1px; overflow:hidden; text-overflow:ellipsis; -webkit-line-clamp:4; display:-webkit-box; -webkit-box-orient:vertical;  }
.star_best_list li .star_list_name { position:relative; float:left; font-size:13px; color:#999; letter-spacing:-1px; }

.staricon{ display:inline-block; position:relative; width:80px; height:15px; background:url('<?=$nfor[skin_path]?>img/star.png')no-repeat 0 -15px; background-size:87px auto; vertical-align:middle; }
.staricon em{ position:absolute; left:0px; top:0px; height:15px; background:url('<?=$nfor[skin_path]?>img/star.png')no-repeat 0 0; background-size:87px auto; }

.star_best_list .star_list_date { float:right; font-size:11px; color:#999; letter-spacing:-1px; }  
.star_best_list .star_list_btn { width:100%; text-align:left; margin-top:5px; }
.star_best_list .star_list_btn button { padding:0px; margin:0px; border:solid 1px #e5e5e5; width:48px; height:25px; line-height:25px; text-align:center; font-size:13px; text-decoration:none; color:#444; }

</style>

<div style="width:100%; padding:10px; background:#f4f4f4; box-sizing:border-box; -webkit-box-sizing:border-box;">
<a href="item_star_form.php?it_id=<?=$item[it_id]?>" style="width:100%; display:block; height:33px; line-height:33px; color:#444; border:1px solid #e5e5e5; text-align:center; background:#fff; font-size:15px;">구매후기작성</a>
</div>

<?
$data = sql_fetch("select avg(wr_star) as wr_star_avg from nfor_item_star where it_id='$item[it_id]' and wr_datetime <= '$nfor[ymdhis]' and wr_reply='0' and wr_view='0'");
$avg = sprintf("%d",$data[wr_star_avg]);
?>
	
<div class="wrap_star_info">

	<div class="wrap_bigpoint">
		<b class="bigstaricon"><em style="width:<?=$avg*20?>%;"></em></b>
		<b class="bigpoint"><?=$avg?></b>
		<span class="bigpointmax">/5</span>
	</div>

</div>




<div style="background-color:#ebebeb; border-top:solid 1px #e5e5e5; height:8px;"></div>




<ul class="star_best_list">
<?
$result = sql_query("select * from nfor_item_star where it_id='$item[it_id]' and wr_datetime <= '$nfor[ymdhis]' and wr_reply='0' and wr_view='0' and wr_best > 0 order by wr_best desc limit 3");
for($i=0; $data=sql_fetch_array($result); $i++){
?>
<li class="q_li">

	<div style="margin-bottom:10px;">
		<span class="star_list_name"><b class="staricon"><em style="width:<?=$data[wr_star]*20?>%;"></em></b><?=print_mb_info($data)?></span>
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

		<div class="content">
			
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







<ul class="star_list_sort">
	<li class="on" data-sst="wr_id" data-sod="desc"><b></b> 최신순</li>
	<li data-sst="wr_star" data-sod="desc"><b></b> 높은별점순</li>
	<li data-sst="wr_star" data-sod="asc"><b></b> 낮은별점순</li>
</ul>
<div style="clear:both;"></div>
 
 
<form name="item_star_list" class="form_star_reply form_star_delete" method="post">
<input type="hidden" name="mode" id="mode_star">
<input type="hidden" name="it_id" id="it_id" value="<?=$item[it_id]?>">
<input type="hidden" name="wr_reply" id="wr_reply_star">
<input type="hidden" name="wr_id" id="wr_id_star">
<ul class="star_list"><? include_once "item_star_list.php"; ?></ul>
</form>

<? if($total_page>1){ ?>
<a href="" class="star_list_more">더보기 <b></b></a>
<? } ?>

<script type="text/javascript">
<!--
$(document).ready(function() {

	var it_id = "<?=$item[it_id]?>";
	var page = 2;
	var total_page = <?=$total_page?>;

	

	$(document).on("click", ".title_content", function (){

		if($(this).find(".content").css('display')=="none"){
			$(this).find(".content").show();
			$(this).find(".title").hide();
		} else{
			$(this).find(".content").hide();
			$(this).find(".title").show();
		}

	});

	$(".star_select li").on("click", function (){

		$(".star_select li").removeClass("on");
		$(this).addClass("on");

		$(".star_list_sort li").removeClass("on");
		$(".star_list_sort li:first").addClass("on");

		var wr_type = $(this).data('wr_type');

		if(wr_type=="all"){
			$(".star_best_list").show();
		} else{
			$(".star_best_list").hide();
		}

		$.get("item_star_list.php",{
			it_id : it_id,
			wr_type : wr_type
		}, function(data){
			$(".star_list").html(data);
			page = 2;
		});


	});


	$(".star_list_sort li").on("click", function (){

		$(".star_list_sort li").removeClass("on");
		$(this).addClass("on");

		var sst = $(this).data('sst');
		var sod = $(this).data('sod');
		var wr_type = $(".star_select li.on").data('wr_type');

		$.get("item_star_list.php",{
			it_id : it_id,
			sst : sst,
			sod : sod,
			wr_type : wr_type
		}, function(data){
			$(".star_list").html(data);
			page = 2;
		});
	});


	$(".star_list_more").on("click",function(e){

		var sst = $(".star_list_sort li.on").data('sst');
		var sod = $(".star_list_sort li.on").data('sod');
		var wr_type = $(".star_select li.on").data('wr_type');

		$.get("item_star_list.php",{
			it_id : it_id,
			page : page,
			sst : sst,
			sod : sod,
			wr_type : wr_type
		}, function(data){
			$(".star_list").append(data);
			page += 1;
		});
		e.preventDefault();

		if(total_page <= page){
			$('.star_list_more').hide();
		}

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

	$(document).on("click", ".star_update", function (){
		var wr_id = $(this).data('wr_id');
		location.href = "item_star_form.php?it_id="+it_id+"&wr_id="+wr_id;
	});

	$(document).on("click", ".star_reply", function (){
		var wr_id = $(this).data('wr_id');
		location.href = "item_star_form.php?it_id="+it_id+"&wr_reply="+wr_id;
	});

});
//-->
</script>

