<form name="forder_hide" id="forder_hide" method="post">
<input type="hidden" name="mode" value="order_hide">
<input type="hidden" name="od_id" value="<?=$order[od_id]?>">
</form>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).on("click","#order_hide_btn",function(){

	if(confirm("확인 버튼을 누르시면 구매내역에서 숨김처리되어 복구할 수 없습니다.\n주문내역을 숨기처리 하시겠습니까?")){

		$.ajax({ 
			type : "post"
			, url : "order_view.php"
			, cache : false  
			, data : $("#forder_hide").serialize() 
			, success : function(response){ 
				var json = $.parseJSON(response); 
				if(json["result"]=="ok"){
					location.href="order_list.php";
				} else{
					alert(msg);
				}
			}
		}); 

	}

});
//-->
</SCRIPT>

<style>
#order_hide_btn { cursor:pointer; margin-top:10px; }

#delivery_chage_wrap { padding:15px; background-color:#fff; display:none; }
.dy_bg { background-color:#fff; position:relative; margin-bottom:10px; }
#zipcode_btn  { cursor:pointer; position:absolute; right:0px; top:0px; height:38px; display:block; width:110px; text-align:center; line-height:40px; border:solid 1px #ccc; background:-webkit-gradient(linear,left top,left bottom,from(#fff),to(#ecebf0)); box-shadow:none; }
</style>


<div id="delivery_chage_wrap">

	<form id="fdelivery_chage" method="post">
	<input type="hidden" name="mode" value="delivery_chage">
	<input type="hidden" name="od_id" value="<?=$order[od_id]?>">

	<div class="dy_bg">

		<label>이름</label>
		<input type="text" name="dy_name" value="<?=$order[dy_name]?>" placeholder="받으시는분 이름">

		<label>휴대전화</label>
		<input type="number" pattern="[0-9]*" name="dy_hp" value="<?=str_number($order[dy_hp])?>" placeholder="받으시는분 휴대전화번호">

		<label>추가연락처</label>
		<input type="number" pattern="[0-9]*" name="dy_tel" value="<?=str_number($order[dy_tel])?>" placeholder="받으시는분 추가연락처">

		<label>주소</label>

		<div style="width:100%; height:40px; position:relative;">
		<input type="number" pattern="[0-9]*" name="dy_zip" id="dy_zip" value="<?=$order[dy_zip]?>" placeholder="우편번호" readonly>
		<a id="zipcode_btn">우편번호찾기</a>
		</div>
		<input type="text" name="dy_addr1" id="dy_addr1" value="<?=$order[dy_addr1]?>" placeholder="주소" style="margin:5px 0px;" readonly>
		<input type="text" name="dy_addr2" id="dy_addr2" value="<?=$order[dy_addr2]?>" placeholder="상세주소">

	</div>

	<a id="delivery_chage_submit_btn" class="table-btn">배송지 변경</a>

	</form>

</div>


<div id="zipcode_wrap"></div>

<SCRIPT LANGUAGE="JavaScript">
<!--



var currentScroll = "";

$(document).on("click","#zipcode_btn, #dy_zip, #dy_addr1",function(){
	currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
	zipcode("dy_zip","dy_addr1","dy_addr2");
	$("#delivery_chage_wrap").hide();
	$(".btn_back").attr("href","javascript:zipcode_close()");
});


function zipcode_close(){
	var element_wrap = document.getElementById('zipcode_wrap');
	element_wrap.style.display = 'none';
	$("#delivery_chage_wrap").show();
	// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
	document.body.scrollTop = currentScroll;
	$(".btn_back").attr("href","javascript:close_delivery_chage()");
}

function zipcode(zipcode,addr1,addr2){
	var element_wrap = document.getElementById('zipcode_wrap');

	// 현재 scroll 위치를 저장해놓는다.
	new daum.Postcode({
		oncomplete: function(data) {
			// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = data.address; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 기본 주소가 도로명 타입일때 조합한다.
			if(data.addressType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById(zipcode).value = data.zonecode; //5자리 새우편번호 사용
			document.getElementById(addr1).value = fullAddr;
			$("#delivery_chage_wrap").show();

			$(".btn_back").attr("href","javascript:close_delivery_chage()");


			// iframe을 넣은 element를 안보이게 한다.
			// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
			element_wrap.style.display = 'none';


			// 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
			document.body.scrollTop = currentScroll;

			document.getElementById(addr2).focus();



		},
		// 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
		onresize : function(size) {
			element_wrap.style.height = size.height+'px';
		},
		width : '100%',
		height : '100%'
	}).embed(element_wrap);

	// iframe을 넣은 element를 보이게 한다.
	element_wrap.style.display = 'block';
}





$(document).on("click","#delivery_chage_submit_btn",function(){

	$.ajax({ 
		type : "post"
		, url : "order_view.php"
		, cache : false  
		, data : $("#fdelivery_chage").serialize() 
		, success : function(response){ 
			var json = $.parseJSON(response); 
			if(json["result"]=="ok"){
				$(".btn_back").attr("href","javascript:history.back()");
				alert("배송지 변경이 정상적으로 처리되었습니다.");
				location.reload();
			} else{
				alert(msg);
			}
		}
	}); 

});
//-->
</SCRIPT>