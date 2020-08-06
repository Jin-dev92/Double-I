<script type="text/javascript">
<!--
var it_id = "<?=$item[it_id]?>"; // 상품코드
var total_opt_depth = "<?=$item[it_opt_depth]?>"; // 옵션마지막단계
var it_buy_qty = parseInt("<?=$item[it_buy_qty]?>");	// 1인 최대 구매 수량


$(function(){

	// 사진변경
	$(".it_img_s").hover(function () {
		$(".it_img_s").removeClass("it_img_s_on");
		$(this).addClass("it_img_s_on");
		$("#it_img_m").attr("src",$(this).attr("src"));
	});

	sales_volume_up("<?=$item[it_sales_volume]?>"); // 구매인원

})

$(document).on('click','.option_del',function(){

	if($(this).parent().find(".opt_basic").val()=="1"){	// 기본옵션을 삭제할경우 체크

		if($(".option_list1 .opt_basic").length=="1"){ // 기본옵션이 1개 밖에 없으면
			$('.option_list li').remove(); // 선택옵션을 모두 삭제
		}
	}

	$(".opt_li_"+$(this).parent().find(".option_id").val()).remove();
	opt_total();
});

$(document).on('click','.option_minus',function(){
	option_cnt = $(this).parent().parent().parent().find(".option_cnt").val();
	option_id = $(this).parent().parent().parent().find(".option_id").val();
	print_value = parseInt(option_cnt)-1;
	if(print_value<1){
		print_value = 1;
	}
	$(".option_cnt_"+option_id).val(print_value);
	opt_total();
});

$(document).on('click','.option_plus',function(){

	option_cnt = $(this).parent().parent().parent().find(".option_cnt").val();
	option_id = $(this).parent().parent().parent().find(".option_id").val();
	opt_stock = $(this).parent().parent().parent().find(".opt_stock").val();

	var option_cnt_total = 0;
	$('.option_list1 .option_cnt').each(function(){
		option_cnt_total = option_cnt_total + parseInt($(this).val());
	});
	option_cnt_total = option_cnt_total+1;
	if(option_cnt_total > it_buy_qty){
		alert('1인 최대 구매 수량은 '+it_buy_qty+'개 입니다.\n구매 수량을 확인해주세요.');
		return;
	}
	if(parseInt(option_cnt) >= parseInt(opt_stock)){
		alert('옵션 별 최대 구매 수량은 '+opt_stock+'개 입니다.\n구매 수량을 다시 확인해주세요.');
		return;
	}

	print_value = parseInt(option_cnt)+1;
	$(".option_cnt_"+option_id).val(print_value);

	opt_total();
});



$(document).on('blur keyup','.option_cnt',function(){

	option_id = $(this).parent().parent().find(".option_id").val();
	option_cnt = $(this).parent().parent().find(".option_cnt").val();
	opt_stock = $(this).parent().parent().find(".opt_stock").val();

	if(isNaN($(this).val()) || parseInt($(this).val())<0){
	  $(".option_cnt_"+option_id).val(1);
	}

	var option_cnt_total = 0;
	$('.option_list1 .option_cnt').each(function(){
		option_cnt_total = option_cnt_total + parseInt($(this).val());
	});
	if(option_cnt_total > it_buy_qty){
		$(".option_cnt_"+option_id).val(1);
		alert('1인당 최대 구매 수량은 '+it_buy_qty+'개 입니다.\n구매 수량을 확인해주세요.');
		return;
	}
	if(parseInt(option_cnt) > parseInt(opt_stock)){
		$(".option_cnt_"+option_id).val(1);
		alert('옵션 별 최대 구매 수량은 '+opt_stock+'개 입니다.\n구매 수량을 다시 확인해주세요.');
		return;
	}

	$(".option_cnt_"+option_id).val($(this).val());

	opt_total();
});

function opt_total(){	// 옵션합산
	var option_price_total = 0;
	$('.option_list1 .opt_price').each(function(){
		option_cnt = $(this).val()*$(this).parent().find(".option_cnt").val();
		option_price_total = option_price_total + option_cnt;
	});
	$('.span_option_price_total').html(number_format(option_price_total+''));
}

function opt_show(depth, option_id){
	
	if(depth>1){
		/* 옵션아이디저장*/
		option_id = $('.opt_id_'+((depth*1)-1)).val();
	}

	/* 2차분류이상일때이전옵션아이디가있을경우만호출 */
	if(depth>1 && option_id == ''){
		
	} else{


		$.ajax({
			type: "POST",
			url: "opt_list.php",
			data: "it_id="+it_id+"&depth="+depth+"&option_id="+option_id,
			success: function(response){
				$('.opt'+depth+'_list').html(response);
				$('.opt'+depth+'_list').show();
			}
		});

	}

}

function opt_select(opt_depth,opt_id,opt_name,opt_stock,opt_price){

	/* 선택옵션값필드저장 */
	$('.opt_id_'+opt_depth).val(opt_id);

	/*옵션선택값선택표시*/
	$('.opt'+opt_depth+'_tit').html(opt_name);

	/*옵션선택목록가림*/
	$('.opt_list').hide();

	/*하위옵션값비움*/
	for(var i=(opt_depth*1)+1; i<=total_opt_depth; i++){
		$('.opt'+i+'_tit').html($('.opt_tit_'+i).val());
		$('.opt'+i+'_list').html('');
	}

	/* 마지막 선택값이면 */
	if(opt_depth==total_opt_depth){
		option_list_add(opt_id,opt_stock,opt_price);
	} else{
		/* 다음 옵션 목록을 보임 */
		opt_show(((opt_depth*1)+1),opt_id);
	}

}

function option_list_add(option_id,opt_stock,opt_price){

	var is_select = 0;
	
	// 옵션중복체크 
	$('.option_id').each(function(){
		if($(this).val()==option_id){
			is_select = 1;
		}
	});
	if(is_select){
		alert('이미 선택한 항목입니다.');
		return;
	}

	// 수량체크 
	var option_cnt_total = 0;
	$('.option_list1 .option_cnt').each(function(){
		option_cnt_total = option_cnt_total + parseInt($(this).val());
	});
	if(option_cnt_total >= it_buy_qty){
		alert('1인당 최대 구매 수량은 '+it_buy_qty+'개 입니다.\n구매 수량을 확인해주세요.');
		return;
	}

	var opt_print = "";
	opt_print = "<li class='opt_li_"+ option_id +"'>";
	opt_print += "<input type='hidden' name='option_id[]' class='option_id' value='"+option_id+"'>";
	opt_print += "<input type='hidden' name='opt_stock[]' class='opt_stock' value='"+opt_stock+"'>";
	opt_print += "<input type='hidden' name='opt_price[]' class='opt_price' value='"+opt_price+"'>";
	opt_print += "<input type='hidden' name='opt_basic[]' class='opt_basic' value='1'>";

	opt_print += "<span class='opt_name'>";
	for(var i=1; i<=total_opt_depth; i++){
		if(i>1){
			opt_print += " | ";
		}
		opt_print += $('.opt'+i+'_tit').html();
	}
	opt_print += "</span>";
	opt_print += "<span class='opt_updown'><input type='text' name='option_cnt[]' class='option_cnt option_cnt_"+option_id+"' value='1'><span class='updown'><a href='#' class='option_plus'>수량 더하기</a><a href='#' class='option_minus'>수량 빼기</a></span></span>";

	opt_print += "<span class='option_del'>삭제</span>";
	opt_print += "<b>"+number_format(opt_price)+"원</b>";
	opt_print += "</li>";
	$(".option_list").append(opt_print);
	opt_total();
}








/* 추가옵션 */
function opt_add_select(sel,opt_id,opt_name,opt_stock,opt_price){

	/*옵션선택값선택표시*/
	$('.opt_add_tit'+sel).html(opt_name);

	/*옵션선택목록가림*/
	$('.opt_list').hide();

	add_option_list_add(sel,opt_id,opt_stock,opt_price);

}

function add_option_list_add(sel,option_id,opt_stock,opt_price){

	var is_select = 0;
	
	// 옵션중복체크 
	$('.option_id').each(function(){
		if($(this).val()==option_id){
			is_select = 1;
		}
	});
	if(is_select){
		alert('이미 선택한 항목입니다.');
		return;
	}

	var opt_print = "";
	opt_print = "<li class='add_opt opt_li_"+ option_id +"'>";
	opt_print += "<input type='hidden' name='option_id[]' class='option_id' value='"+option_id+"'>";
	opt_print += "<input type='hidden' name='opt_stock[]' class='opt_stock' value='"+opt_stock+"'>";
	opt_print += "<input type='hidden' name='opt_price[]' class='opt_price' value='"+opt_price+"'>";

	opt_print += "<span class='opt_name'>";

	opt_print += $('.opt_add_tit'+sel).html();

	opt_print += "</span>";
	opt_print += "<span class='opt_updown'><input type='text' name='option_cnt[]' class='option_cnt option_cnt_"+option_id+"' value='1'><span class='updown'><a href='#' class='option_plus'>수량 더하기</a><a href='#' class='option_minus'>수량 빼기</a></span></span>";

	opt_print += "<span class='option_del'>삭제</span>";
	opt_print += "<b>"+number_format(opt_price)+"원</b>";
	opt_print += "</li>";
	$(".option_list").append(opt_print);
	opt_total();
}

function opt_add_chk(sel){
	if($('.opt_basic').length > 0){
		$('.opt'+sel+'_add_list').show();
	} else{
		alert('기본옵션을 먼저 선택하셔야 진행가능합니다');
	}
}
/* 추가옵션 */






function order_fnc(move){

	var option_cnt_total = 0;
	$('.option_list1 .option_cnt').each(function(){
		option_cnt_total = option_cnt_total + parseInt($(this).val());
	});
	if(option_cnt_total > it_buy_qty){
		$(".option_cnt_"+$(this).parent().find(".option_id").val()).val(1);
		alert('1인당 최대 구매 수량은 '+it_buy_qty+'개 입니다.\n구매 수량을 확인해주세요.');
		return;
	}

	if(parseInt(option_cnt_total) <= 0){
		alert("옵션을 선택하셔야 진행가능합니다");
		return;
	}

	$.ajax({ 
		type : "POST"
		, url : "cart.php"
		, cache : false  
		, data : "mode=it_cnt&it_id="+it_id
		, success : function(response){

			option_cnt_total_all = option_cnt_total + parseInt(response);	

			if(option_cnt_total_all > it_buy_qty){
				alert('1인당 최대 구매 수량은 '+it_buy_qty+'개 입니다.\n장바구니에 담긴 상품('+response+')과 추가 구매 수량('+option_cnt_total+')을 확인해주세요.');
				return;
			} else{
				$('#move').val(move);
				document.item_frm.submit();
			}


		} 
	}); 

}

function zzim(it_id){

 	$.ajax({
	   type: "post",
	   url: nfor_path + "/zzim_list.php",
	   data: "mode=insert&it_id=" + it_id,
	   success: function(response){
			var res = $.parseJSON(response);

			if(res["result"]=="mb_no"){
				alert("로그인하셔야 이용가능합니다.");
				location.href = "login.php?url=item.php?it_id="+it_id;
			} else if(res["result"]=="is_zzim") {
				alert("이미 찜하기 하신 상품입니다");
			} else if(res["result"]=="insert_ok") {
				alert("찜하기로 등록하였습니다");
				$(".zzim_"+it_id).html(res["cnt"]);
			} else{
				alert("찜하기에 실패하였습니다");
			}

	   }
	 });
 
}



function sales_volume_up(count_up){
	count_down = parseInt($('#it_sales_volume').text());
	count_ud = count_up-count_down;
	if(count_ud > 0){
		count_add = Math.ceil(count_ud/10);
		count_down = count_down+count_add;
	}
	if(count_down <= count_up){
		$('#it_sales_volume').text(count_down);
		if(count_down < count_up){
			setTimeout('sales_volume_up('+count_up+');', (parseInt(60/count_add)));
		} else {
			$('#it_sales_volume').fadeOut().fadeIn().fadeOut().fadeIn();
		}
	}
}

//-->
</script>