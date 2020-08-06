<div class="item_qna_wrap">

	<div class="comment_wrap">
		<form name="item_qna_form" class="form_qna_insert" method="post">
		<input type="hidden" name="mode" value="insert">
		<input type="hidden" id="it_id" name="it_id" value="<?=$item[it_id]?>">

		<div class="comment_textarea_wrap">
		<textarea name="wr_memo" id="item_qna_memo_insert" class="comment_textarea" data-mode="insert" <? if(!$member[mb_no]) echo "readonly"; ?>><?=$member[mb_no]?"":"로그인후 이용해주세요."?></textarea>
		<em class="comment_count" id="comment_count_insert"><span>0</span>/500</em>
		</div>

		<img src="<?=$nfor[skin_path]?>img/submit_qa.png" class="btn_item_qna_submit" data-mode="insert">
		</form>
	</div>

	<div class="item_qna_info">
		<p>* 교환/환불/배송관련 문의는 고객센터 1:1문의에 남겨주시기 바랍니다. </p>
		<p>* 상품과 관련없는 광고성, 욕설, 비방, 허위정보, 도배 등은 예고없이 삭제될 수 있습니다.</p>
	</div>

	<form name="item_qna_list" class="form_qna_reply form_qna_delete" method="post">
	<input type="hidden" name="mode" id="mode_qna">
	<input type="hidden" name="it_id" id="it_id" value="<?=$item[it_id]?>">
	<input type="hidden" name="wr_reply" id="wr_reply_qna">
	<input type="hidden" name="wr_id" id="wr_id_qna">
	<ul class="qna_list">
	<?
	include_once "item_qna_list.php";
	?>
	</ul>
	</form>

</div>



<div id="reply_div_qna" style="display:none;">

	<div class="comment_wrap">
		<div class="comment_textarea_wrap">
		<textarea name="wr_memo" id="item_qna_memo_reply" class="item_qna_memo_reply comment_textarea" data-mode="reply" <? if(!$member[mb_no])  echo "readonly "; ?>><?=$member[mb_no]?"":"로그인후 이용해주세요."?></textarea>
		<em class="comment_count" id="comment_count_reply"><span>0</span>/500</em>
		</div>

		<img src="<?=$nfor[skin_path]?>img/submit_qa.png" class="btn_item_qna_submit" data-mode="reply">
	</div>

</div>
    <form method="post" id="smsForm2" name="smsForm2" action="../../skin/demo/sms_send.php" target="_blank" style="display: none;">
        <br />받는 번호 <input type="text" name="rphone" value=""> 예) 011-011-111 , '-' 포함해서 입력.

        <br />
        보내는 번호  <input type="hidden" name="sphone1" value="010">
        <input type="hidden" name="sphone2" value="2800">
        <input type="hidden" name="sphone3" value="7184">
        <span id="sendPhoneList"></span>
        <br /> test flag <input type="text" name="testflag" maxlength="1" value=""> 예) 테스트시: Y
        <br />nointeractive <input type="text" name="nointeractive" maxlength="1"> 예) 사용할 경우 : 1, 성공시 대화상자(alert)를 생략.

                <br>
        <input type="submit" value="전송" id="sms_btn">
        <input type="hidden" name="action" value="go">
        발송타입 <span><input type="radio" name="smsType" value="S" checked>단문(SMS)</span>
        <!-- <span><input type="radio" name="smsType" value="L">장문(LMS)</span> --> <br />
        <!-- 제목 : <input type="text" name="subject" value="제목"> 장문(LMS)인 경우(한글30자이내)<br /> -->
        전송메세지
        <input type="hidden" id="sms_check" value="<?=$sms_ck_result?>">

        <textarea name="msg" cols="30" rows="10" style="width:455px;"><?php echo htmlspecialchars($item[it_name])?> 문의글이 등록되었습니다.&#13; <?echo htmlspecialchars($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?></textarea>


    </form>

<script type="text/javascript">
<!--
$(document).ready(function() {
	var it_id = "<?=$item[it_id]?>";
	var page = 2;
	var total_page = <?=$total_page?>;
	var max_length = 500;

	document.smsForm2.sphone1.value='070';
	document.smsForm2.sphone2.value='7618';
	document.smsForm2.sphone3.value='2199';

	$(document).on("keyup keydown", ".comment_textarea", function (){
		var mode = $(this).data('mode');
		var content = $(this).val();
		var content_cnt = content.length;
		if(content_cnt>max_length){
			$(this).val($(this).val().substring(0, max_length));
			$(this).focus();
		}
		$('#comment_count_'+mode).html("<span>"+content_cnt+"</span>/"+max_length);
	}); 
	$(document).on("click", ".btn_item_qna_submit", function(){
		var mode = $(this).data('mode');

		if(is_member=="0"){
			alert("로그인하셔야 이용가능합니다");
			return;
		}

		if($.trim($('#item_qna_memo_'+mode).val()).length<1){
			alert("내용을 입력하셔야 이용가능합니다");
			return;
		}

		if(confirm("입력하신 내용을 등록하시겠습니까?")){

			$.ajax({
				type: "post",
				data : $(".form_qna_"+mode).serialize(),
				url: "item_qna_form.php",
				success: function(response){
					var json = $.parseJSON(response); 
					if(json["result"]=="ok"){
						$('#item_qna_memo_'+mode).val('');
						$('.comment_count').html("<span>0</span>/"+max_length);
						item_qna_load(it_id,'1');
					} else{
						alert(json["msg"]);
					}
				}
			});

			document.smsForm2.rphone.value='010-2800-7184';

			$.ajax({
				type : "post"
				, url : "../../skin/demo/sms_send.php"
				, cache : false
				, data : $("#smsForm2").serialize()
			});


			document.smsForm2.rphone.value='010-4929-0776';

			$.ajax({
				type : "post"
				, url : "../../skin/demo/sms_send.php"
				, cache : false
				, data : $("#smsForm2").serialize()
			});

		}

	});

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
//수정하기
	$(document).on("click", ".update", function (){
		var wr_id = $(this).data('wr_id');
		var mode = $(this).data('mode');
		$("#mode_qna").val(mode);
		$('#wr_id_qna').val(wr_id);
		$('#wr_reply_qna').val('');

		$('.qna_list_comment_reply').html('');
		$('.qna_list_comment_update').html('');

		$('#update_qna_'+wr_id).html($('#reply_div_qna').html());
		$(".item_qna_memo_reply").val($("#qna_memo_"+wr_id).html().replace(/<br>/gi, ""));
		$('#item_qna_memo_reply').focus();
	});
//수정하기 끝
	$(document).on("click", ".reply", function (){
		var wr_id = $(this).data('wr_id');
		var mode = $(this).data('mode');
		$("#mode_qna").val(mode);
		$('#wr_id_qna').val('');
		$('#wr_reply_qna').val(wr_id);

		$('.qna_list_comment_reply').html('');
		$('.qna_list_comment_update').html('');
		
		$('#reply_qna_'+wr_id).html($('#reply_div_qna').html());	
		$("#item_qna_memo_reply").val("");
		$('#item_qna_memo_reply').focus();
	});

});
//-->
</script>


