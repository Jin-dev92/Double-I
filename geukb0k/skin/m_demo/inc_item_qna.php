<style>
/* 상품문의버튼 */
.wrap_qna_btn {  width:100%; }
.wrap_qna_btn li { width:50%; float:left; box-sizing:border-box; -webkit-box-sizing:border-box; background:#f4f4f4; }
.wrap_qna_btn li:nth-child(1){ padding:10px 5px 10px 10px;  }
.wrap_qna_btn li:nth-child(2){ padding:10px 10px 10px 5px;  }
.wrap_qna_btn li a { width:100%; display:block; height:33px; line-height:33px; color:#444; border:1px solid #e5e5e5; text-align:center; background:#fff; font-size:15px; }
.wrap_qna_btn li a span b{ background:url(<?=$nfor[skin_path]?>img/layout.png) no-repeat; background-position:-200px -350px; background-size:320px auto; position:absolute; left:-20px; top:0px; width:18px; height:18px; }


/* 더보기버튼 */
.qna_list_more { display:block; letter-spacing:-1px; color:#999; height:40px; line-height:40px; font-size:14px; text-align:center; border-top:solid 1px #f4f4f4; }
.qna_list_more b { display:inline-block; width:11px; height:7px; background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat ;  background-position:-200px -250px; background-size:320px auto; } 

/* 상품문의리스트*/
.qna_list .q_li { padding:15px 10px; border-top:solid 1px #e5e5e5; }
.qna_list .a_li { padding:0px 10px 15px 25px; }

.qna_list .qna_memo { color:#444; font-size:14px; letter-spacing:-1px; padding-top:10px; }

.qna_list .q_li .qna_list_name { position:relative; float:left; font-size:13px; color:#444; font-weight:bold; padding-left:25px; letter-spacing:-1px; }
.qna_list .a_li .qna_list_name { position:relative; float:left; font-size:13px; color:#444; font-weight:bold; padding-left:35px; letter-spacing:-1px; }
.qna_list .q_li .qna_list_name b { width:22px; height:22px; top:0px; left:0px; position:absolute; background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat ;  background-position:-0px -350px; background-size:320px auto; }

.qna_list .a_li .qna_list_name i { width:6px; height:6px; top:5px; left:0px; position:absolute;  background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat ;  background-position:-100px -350px; background-size:320px auto; }
.qna_list .a_li .qna_list_name b { width:22px; height:22px; top:0px; left:10px; position:absolute; background:url('<?=$nfor[skin_path]?>img/layout.png') no-repeat ;  background-position:-50px -350px; background-size:320px auto;}

.qna_list .qna_list_date { float:right; font-size:11px; color:#999; letter-spacing:-1px; }  
.qna_list .qna_list_btn { width:100%; text-align:left; margin-top:5px; }
.qna_list .qna_list_btn button { padding:0px; margin:0px; border:solid 1px #e5e5e5; width:48px; height:25px; line-height:25px; text-align:center; font-size:13px; text-decoration:none; color:#444; }
</style>

<ul class="wrap_qna_btn">
	<li><a href="faq.php"><b></b>자주묻는질문</a></li>
	<li><a href="item_qna_form.php?it_id=<?=$item[it_id]?>"><span style="position:relative;"><b></b>상품문의</span></a></li>
</ul>
<div style="clear:both;"></div>

<form name="item_qna_list" class="form_qna_reply form_qna_delete" method="post">
<input type="hidden" name="mode" id="mode_qna">
<input type="hidden" name="it_id" id="it_id" value="<?=$item[it_id]?>">
<input type="hidden" name="wr_reply" id="wr_reply_qna">
<input type="hidden" name="wr_id" id="wr_id_qna">
<ul class="qna_list"><? include_once "item_qna_list.php"; ?></ul>
</form>

<? if($total_page>1){ ?>
<a href="" class="qna_list_more">더보기 <b></b></a>
<? } ?>

<script type="text/javascript">
<!--
$(document).ready(function() {

	var it_id = "<?=$item[it_id]?>";
	var page = 2;
	var total_page = <?=$total_page?>;

	$(".qna_list_more").on("click",function(e){

		$.get("item_qna_list.php",{
			it_id : it_id,
			page : page
		}, function(data){
			$(".qna_list").append(data);
			page += 1;
		});
		e.preventDefault();

		if(total_page <= page){
			$('.qna_list_more').hide();
		}

	});

/*
	$(document).on("click", ".delete", function (){
		var wr_id = $(this).data('wr_id');

		if(confirm("삭제하시겠습니까?")){
			$.get("item_qna_list.php",{
				mode : "delete",
				it_id : it_id,
				wr_id : wr_id
			}, function(data){
				$(".qna_list").html(data);
				page = 2;
			});
		}
	});
*/


	$(document).on("click", ".delete", function (){
		var wr_id = $(this).data('wr_id');
		var mode = $(this).data('mode');
		$("#mode_qna").val(mode);
		$('#wr_id_qna').val(wr_id);
		$('#wr_reply_qna').val('');
		if(confirm("삭제하시겠습니까?")){
			$.ajax({
				type: "post",
				data : $(".form_qna_"+mode).serialize(),
				url: "item_qna_form.php",
				success: function(response){
					var json = $.parseJSON(response); 
					if(json["result"]=="ok"){
						item_qna_load(it_id,'1');
					} else{
						alert(json["msg"]);
					}
				}
			});
		}
	});


	$(document).on("click", ".update", function (){
		var wr_id = $(this).data('wr_id');
		location.href = "item_qna_form.php?it_id="+it_id+"&wr_id="+wr_id;
	});

	$(document).on("click", ".reply", function (){
		var wr_id = $(this).data('wr_id');
		location.href = "item_qna_form.php?it_id="+it_id+"&wr_reply="+wr_id;
	});

});
//-->
</script>

