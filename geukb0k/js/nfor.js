
function setCookie( name, value, expiredays ){
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}


function kcb_hp_win(){
	window.open(nfor_path + "/okname/hp1.php", "auth_popup", "width=430,height=590,scrollbar=yes");
}

function kcb_ipin_win(){
	window.open(nfor_path + "/okname/ipin1.php", "kcbPop", "left=200, top=100, status=0, width=450, height=550");
}




/* 메일구독 */

function subscribe_popup(ty){
	if(ty=="open"){
		$("#subscribe_popup").show();
	} else if(ty=="close"){
		$("#subscribe_popup").hide();
	} else{

	}
}

function subscribe_popup_check(){

	var wr_email = $('#subscribe_popup_wr_email').val();
	var email_chk = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;

	if(!wr_email){
		alert("이메일을 입력해주세요");
		return;
	}

	if(!email_chk.test(wr_email)){
		alert("잘못된 이메일입니다");
		return;
	}

	if(!$('#subscribe_popup_agree_chk').is(":checked")){
		alert("개인정보 수집, 이용에 동의하셔야 진행가능합니다");
		$('#subscribe_popup_agree_chk').focus();
		return;
    }

	$.ajax({
		type: "post",
		url: "subscribe.php",
		data: {
			"mode":"insert",
			"wr_email":wr_email
		},
		cache: false,
		async: false,
		success: function(response){
			var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				alert(json["msg"]);
				subscribe_popup('close');
			} else{
				alert(json["msg"]);
			}
		}
	});

}
/* 메일구독 */





function ksnet_cash_win(od_id){
    window.open("pg_ksnet_cash.php?od_id="+od_id, "ksnet_cash", "left=50,top=50,width=340,height=300,scrollbars=1");
}




function ticket_send(od_id, it_id, ct_id){

	$.ajax({
		type: "post",
		url: nfor_path + "/order_list.php",
		data: {
			"mode":"ticket_send",
			"od_id":od_id,
			"it_id":it_id,
			"ct_id":ct_id
		},
		cache: false,
		async: false,
		success: function(response){
			var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				alert(json["msg"]);
			} else{
				alert(json["msg"]);
			}
		}
	});

}







/* 아이디 및 패스워드찾기 */

function find_id(mode){
	var mb_name = "";
	var mb_email = $("#mb_email").val();
	var mb_hp = $("#mb_hp").val();

	if(mode=="hp_check"){
		mb_name = $("#mb_name_1").val();
	} else if(mode=="email_check"){
		mb_name = $("#mb_name_2").val();
	} else{

	}

	$.ajax({
		type: "post",
		url: "find_id.php",
		data: {
			"mode":mode,
			"mb_name":mb_name,
			"mb_hp":mb_hp,
			"mb_email":mb_email
		},
		cache: false,
		async: false,
		success: function(response){
			var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				alert(json["msg"]);
			} else{
				alert(json["msg"]);
			}
		}
	});

}

function find_password(mode){
	var mb_name = "";
	var mb_email = $("#mb_email").val();
	var mb_hp = $("#mb_hp").val();

	if(mode=="hp_check"){
		mb_name = $("#mb_name_1").val();
	} else if(mode=="email_check"){
		mb_name = $("#mb_name_2").val();
	} else{

	}

	$.ajax({
		type: "post",
		url: "find_password.php",
		data: {
			"mode":mode,
			"mb_name":mb_name,
			"mb_hp":mb_hp,
			"mb_email":mb_email
		},
		cache: false,
		async: false,
		success: function(response){
			var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				alert(json["msg"]);
			} else{
				alert(json["msg"]);
			}
		}
	});

}

function find_id_win(){
    window.open("find_id.php", "find_id", "left=50,top=50,width=450,height=600,scrollbars=1");
}

function find_password_win(){
    window.open("find_password.php", "find_password", "left=50,top=50,width=450,height=600,scrollbars=1");
}
/* 아이디 및 패스워드찾기 */







/* 제휴문의 */
function cooperation_check(f){

	if(!$('.ca_name').val()){
		alert(" 분류를 선택해주세요");
		$('.ca_name').focus();
        return false;
	}
	if(!$('.wr_name').val()){
		alert("담당자명을 입력해주세요");
		$('.wr_name').focus();
        return false;
	}

	if(!$('.wr_tel1').val()){
		alert("연락처를 입력해주세요");
		$('.wr_tel1').focus();
        return false;
	}
	if(!$('.wr_tel2').val()){
		alert("연락처를 입력해주세요");
		$('.wr_tel2').focus();
        return false;
	}
	if(!$('.wr_tel3').val()){
		alert("연락처를 입력해주세요");
		$('.wr_tel3').focus();
        return false;
	}

	var hp_chk = /^\d{3,4}-\d{3,4}-\d{4}$/;
	var hp = $('.wr_tel1').val()+'-'+$('.wr_tel2').val()+'-'+$('.wr_tel3').val();
	if(!hp_chk.test(hp)){
		alert("잘못된 연락처입니다");
		return false;
	}

	if(!$('.wr_email').val()){
		alert("이메일을 입력해주세요");
		$('.wr_email').focus();
        return false;
	}

	var email_chk = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
	var email = $('.wr_email').val();
	if(!email_chk.test(email)){
		alert("잘못된 이메일입니다");
		return false;
	}

	if(!$('.wr_subject').val()){
		alert("제목을 입력해주세요");
		$('.wr_subject').focus();
        return false;
	}
	if(!$('.wr_memo').val()){
		alert(" 내용을 입력해주세요");
		$('.wr_memo').focus();
        return false;
	}

	if(!$('.agree_chk').is(":checked")){
		alert("개인정보 수집, 이용에 동의하셔야 진행가능합니다");
		$('.agree_chk').focus();
		return false;
    }

    f.action = 'cooperation_form.php';
    return true;
}

/* 제휴문의 */




/* 1:1문의 */

function customer_check(f){

	if(!$('.ca_name').val()){
		alert(" 분류를 입력해주세요");
		$('.ca_name').focus();
        return false;
	}
	if(!$('.wr_name').val()){
		alert("이름을 입력해주세요");
		$('.wr_name').focus();
        return false;
	}


	if(!$('.wr_email').val()){
		alert("이메일을 입력해주세요");
		$('.wr_email').focus();
        return false;
	}

	var email_chk = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
	var email = $('.wr_email').val();
	if(!email_chk.test(email)){
		alert("잘못된 이메일입니다");
		return false;
	}



	if(!$('.wr_hp1').val()){
		alert("연락처를 입력해주세요");
		$('.wr_hp1').focus();
        return false;
	}
	if(!$('.wr_hp2').val()){
		alert("연락처를 입력해주세요");
		$('.wr_hp2').focus();
        return false;
	}
	if(!$('.wr_hp3').val()){
		alert("연락처를 입력해주세요");
		$('.wr_hp3').focus();
        return false;
	}

	var hp_chk = /^\d{3,4}-\d{3,4}-\d{4}$/;
	var hp = $('.wr_hp1').val()+'-'+$('.wr_hp2').val()+'-'+$('.wr_hp3').val();
	if(!hp_chk.test(hp)){
		alert("잘못된 연락처입니다");
		return false;
	}


	if(!$('.wr_subject').val()){
		alert("제목을 입력해주세요");
		$('.wr_subject').focus();
        return false;
	}
	if(!$('.wr_memo').val()){
		alert(" 내용을 입력해주세요");
		$('.wr_memo').focus();
        return false;
	}

    f.action = "customer_form.php";
    return true;
}

function customer_faq(keyword){

	$.ajax({
		type: 'post',
		url: 'faq.php',
		data : 'ajax=1&keyword='+keyword,
		success: function(response){
			if(response){
				$('.wrap_customer_faq').show();
				$('.customer_faq_list').html(response);
			} else{
				$('.wrap_customer_faq').hide();
			}
		},
		error: function(){
			alert('에러발생 잠시후 다시 시도해주세요');
		}
	});

}



/* 1:1문의 */












// 관리자

function order_cancel_btn(url,msg,ty){
	var confirm_msg = "";
	if(ty=="pg"){
		confirm_msg = "주문취소처리대상\n"+msg+"\n\n확인버튼을 누르실경우 전자결제(PG)와 주문서 상태가 함께 취소됩니다 그래도 진행하시겠습니까?\n\nPG 취소의 경우 전자결제(PG)업체와 통신을 진행하기 때문에 반드시 처리 완료 메시지가 나올때까지 기다려주세요";
	} else{
		confirm_msg = "주문취소처리대상\n"+msg+"\n\n확인버튼을 누르실경우 전자결제(PG)는 취소되지 않으며 주문서 상태만 취소됩니다 그래도 진행하시겠습니까?";
	}
	if(confirm(confirm_msg)){
		location.href = url;
	}
}

function order_asign_btn(url,msg){
	var confirm_msg = "주문완료처리대상\n"+msg+"\n\n확인버튼을 누르실경우 주문서 상태가 주문완료로 변경됩니다 그래도 진행하시겠습니까?";
	if(confirm(confirm_msg)){
		location.href = url;
	}
}

function order_cancelrequest_btn(url,msg){
	var confirm_msg = "주문취소신청처리대상\n"+msg+"\n\n확인버튼을 누르실경우 주문서 상태가 주문취소신청으로 변경됩니다 그래도 진행하시겠습니까?";
	if(confirm(confirm_msg)){
		location.href = url;
	}
}

function it_discount_rate_fnc(){
	if(parseInt($('#it_price1').val()) && parseInt($('#it_price2').val())){
		$('#it_discount_rate').val(100-Math.round((parseInt($('#it_price2').val())/parseInt($('#it_price1').val()))*100));
	} else{
		$('#it_discount_rate').val('');
	}
}








// 회원가입 및 정보수정
function name_check(){
	var mb_name = $("#mb_name").val();
	var pattern = /([^가-힣\x20])/i;
	if(!mb_name){
		$("#mb_name_msg").html("이름이 입력되지 않았습니다").css("color","red");
		result = "이름이 입력되지 않았습니다";
	} else if(pattern.test(mb_name)){
		$("#mb_name_msg").html("이름은 한글로 입력하세요").css("color","red");
		result = "이름은 한글로 입력하세요";
	} else{
		$("#mb_name_msg").html("");
		result = "";
	}
	return result;
}

function birth_check(){
	if(!$("#mb_birth_1").val()){
		$("#mb_birth_msg").html("생년월일을 선택하세요").css("color", "red");
		result = "생년월일을 선택하세요";
	} else if(!$("#mb_birth_2").val()){
		$("#mb_birth_msg").html("생년월일을 선택하세요").css("color", "red");
		result = "생년월일을 선택하세요";
	} else if(!$("#mb_birth_3").val()){
		$("#mb_birth_msg").html("생년월일을 선택하세요").css("color", "red");
		result = "생년월일을 선택하세요";
	} else{
		$("#mb_birth_msg").html("");
		result = "";
	}
	return result;
}

function sex_check(){
	if(!$("#mb_sex").val()){
		$("#mb_sex_msg").html("성별을 선택하세요").css("color", "red");
		result = "성별을 선택하세요";
	} else{
		$("#mb_sex_msg").html("");
		result = "";
	}
	return result;
}

function password_check(){
	var password = $("#mb_password").val();
	var num = password.search(/[0-9]/g);
	var eng = password.search(/[a-z]/ig);
	var spe = password.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
	if(password.length < 6 || password.length > 20){
		$("#mb_password_msg").html("영문/숫자 또는 특수문자 조합 6~16자리로 입력해 주세요").css("color", "red");
		result = "영문/숫자 또는 특수문자 조합 6~16자리로 입력해 주세요";
	} else if(password.search(/₩s/) != -1){
		$("#mb_password_msg").html("비밀번호는 공백없이 입력해주세요").css("color", "red");
		result = "비밀번호는 공백없이 입력해주세요";
	} else if((num < 0 && eng < 0) || (eng < 0 && spe < 0) || (spe < 0 && num < 0)){
		$("#mb_password_msg").html("비밀번호는 영문과 숫자의 조합이어야 합니다").css("color", "red");
		result = "비밀번호는 영문과 숫자의 조합이어야 합니다";
	} else if(/(\w)\1\1\1/.test(password)){
        $("#mb_password_msg").html("비밀번호에 같은 문자를 4번 이상 사용하실 수 없습니다");
		result = "비밀번호에 같은 문자를 4번 이상 사용하실 수 없습니다";
	} else{
		$("#mb_password_msg").html("");
		result = "";
	}
	return result;
}

function password_confirm_check(){
	if(!$("#mb_password_confirm").val()){
		$("#mb_password_confirm_msg").html("비밀번호확인을 입력해주세요").css("color", "red");
		result = "비밀번호확인을 입력해주세요";
	} else if($("#mb_password").val() != $("#mb_password_confirm").val()){
		$("#mb_password_confirm_msg").html("먼저 입력하신 패스워드와 일치하지 않습니다").css("color", "red");
		result = "먼저 입력하신 패스워드와 일치하지 않습니다";
	} else{
		$("#mb_password_confirm_msg").html("");
		result = "";
	}
	return result;
}


function asign_send(){
	var mb_hp = $("#mb_hp").val();
	var mb_email = $("#mb_email").val();
	$.ajax({
		type: "post",
		url: nfor_path+"/json.php",
		data: {
			"mode":"asign_send",
			"mb_hp": mb_hp,
			"mb_email": mb_email
		},
		cache: false,
		async: false,
		success: function(response) {
			var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				alert("입력하신 번호로 인증번호가 발송되었습니다.");
				$("#asign_send_btn").html("인증번호 재전송");
				$("#asign_input_div").show();
			}
		}
	});
}

function asign_confirm(){
	var mb_hp = $("#mb_hp").val();
	var asign_number = $("#asign_number").val();
	$.ajax({
		type: "post",
		url: nfor_path+"/json.php",
		data: {
			"mode":"asign_confirm",
			"mb_hp":mb_hp,
			"asign_number":asign_number
		},
		cache: false,
		async: false,
		success: function(response) {
			var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				$("#mb_hp_asign").hide();
				$("#mb_hp_msg").html("");
				result = "";
			} else{
				$("#asign_number").val("");
				$("#asign_number").focus();
				result = "입력하신 번호가 일치하지 않습니다";
			}
		}
	});
	return result;
}



function hp_check(){
	var mb_hp = $("#mb_hp").val();
	var mb_no = $("#mb_no").val();

	if(!mb_hp){
		$("#mb_hp_msg").html("핸드폰번호를 입력해 주세요").css("color", "red");
		result = "핸드폰번호를 입력해 주세요";
	} else{

		if(!$("#asign_number").val()){

				$.ajax({
					type: "POST",
					url: nfor_path+"/json.php",
					data: {
						"mode":"hp_check",
						"mb_hp": mb_hp,
						"mb_no": mb_no
					},
					cache: false,
					async: false,
					success: function(response){
						var json = $.parseJSON(response);
						if(json["result"]=="ok"){
							$("#mb_hp_asign").hide();
							$("#mb_hp_msg").html("");
							result = "";
						} else{
							if(json["result"]=="asign"){
								$("#mb_hp_asign").show(); // 휴대폰번호 인증창 추가
							} else{
								$("#mb_hp_asign").hide();
							}
							$("#mb_hp_msg").html(json["msg"]).css("color", "red");
							result = json["msg"];
						}
					}
				});

		} else{
			result = asign_confirm();
		}
	}

	return result;
}

function id_check(){
	var mb_id = $("#mb_id").val();
	var mb_no = $("#mb_no").val();

    $.ajax({
        type: "POST",
        url: nfor_path+"/json.php",
        data: {
			"mode":"id_check",
            "mb_id": mb_id,
			"mb_no": mb_no
        },
        cache: false,
        async: false,
        success: function(response){
			var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				$("#mb_id_msg").html(json["msg"]).css("color", "blue");
				result = "";
			} else{
				$("#mb_id_msg").html(json["msg"]).css("color", "red");
				result = json["msg"];
			}
        }
    });
	return result;
}

function email_check(){
	var mb_email = $("#mb_email").val();
	var mb_no = $("#mb_no").val();
    $.ajax({
        type: "post",
        url: nfor_path+"/json.php",
        data: {
			"mode":"email_check",
            "mb_email": mb_email,
			"mb_no": mb_no
        },
        cache: false,
        async: false,
        success: function(response) {
            var json = $.parseJSON(response);
			if(json["result"]=="ok"){
				$("#mb_email_msg").html(json["msg"]).css("color", "blue");
				result = "";
			} else{
				$("#mb_email_msg").html(json["msg"]).css("color", "red");
				result = json["msg"];
			}
        }
    });
	return result;
}


// 카테고리분류
function category_change(){

	var id = parseInt($(this).attr("id").substr(9,1));
	var prev_id = id - 1;
	var next_id = id + 1;
	var next_next_id = id + 2;
	var category_id = $(this).find(':selected').val();

	if(category_id != ''){

		$("#insert_cate_id").val(category_id);

		$.ajax({
			type     : "get",
			url      : nfor_path + "/json.php",
			data     : "mode=category&category_id="+category_id+"&depth="+id,
			dataType : 'json',
			cache: false,
			success  : function(data) {
				var output = '<option value="">==== '+next_id+'차 분류 ====</option>';

				for(var i=0; i<data.data.length; i++) {
					output += '<option value="' + data.data[i].category_id + '">' + data.data[i].wr_category + '</option>';
				}

				$('#category_'+next_id).empty().append(output);


				for(var k = next_next_id; k <= 4; k++){

					$('#category_'+k).empty().append('<option value="">==== '+k+'차 분류 ====</option>');
				}


			},
			error: function(){
				console.log("Ajax failed");
			}
		});

	} else{

		var r = 0;
		for(var k = next_id; k <= 4; k++){
			$('#category_'+k).empty().append('<option value="">==== '+k+'차 분류 ====</option>');
			r++;
		}

		if($('#category_'+prev_id).val()){
			$("#insert_cate_id").val($('#category_'+prev_id).val());
		} else{
			$("#insert_cate_id").val("");
		}
	}
}





















function set_cookie(name, value, expirehours, domain){
	var today = new Date();
	today.setTime(today.getTime() + (60*60*1000*expirehours));
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
	if (domain) {
		document.cookie += "domain=" + domain + ";";
	}
}

function get_cookie(name){
	var find_sw = false;
	var start, end;
	var i = 0;

	for (i=0; i<= document.cookie.length; i++)
	{
		start = i;
		end = start + name.length;

		if(document.cookie.substring(start, end) == name)
		{
			find_sw = true
			break
		}
	}

	if (find_sw == true)
	{
		start = end + 1;
		end = document.cookie.indexOf(";", start);

		if(end < start)
			end = document.cookie.length;

		return document.cookie.substring(start, end);
	}
	return "";
}

function del_cookie(name){
	var today = new Date();

	today.setTime(today.getTime() - 1);
	var value = get_cookie(name);
	if(value != "")
		document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
}











function sns_link(cp){
	var kakaostory_text = '[' + it_name + ']\n' + it_description;
	var kakaotalk_text = '[' + it_name + ']\n' + it_description;
	var twitter_text = '[' + it_name + ']\n' + it_description;
	var naverline_text = '[' + it_name + '] ' + it_description + ' ' + it_url;
	var naverblog_text = '[' + it_name + ']\n' + it_description;

	var sms_text = it_url;
	var broswerInfo = navigator.userAgent;
	if(broswerInfo.indexOf("NFOR_APP")>-1){
		if(cp=="naverline"){
			location.href="line://msg/text/" + naverline_text;
		} else if(cp=="kakaostory"){
			location.href="storylink://posting?post=" + kakaostory_text + "&appid="+app_schema+"&appver=14.0&apiver=1.0&appname="+app_name;
		} else{

		}
	} else{
		if(cp=="naverline"){
			location.href="http://line.me/R/msg/text/" + naverline_text;
		} else if(cp=="kakaostory"){

			Kakao.init(kakao_key);
				Kakao.Story.open({
				url: it_url,
				text: kakaostory_text,
				urlInfo: {
					title: it_name,
					desc: it_description,
					name: cf_name,
					images: [it_img]
				}
			});
			/* 웹창으로 열기
			Kakao.Story.share({
			  url: it_url,
			  text: '[' + it_name + ']\n' + it_description
			});
			*/
		} else{

		}
	}


	if(cp=="naver"){
		location.href="http://share.naver.com/web/shareView.nhn?url="+it_url+"&title="+naverblog_text;
	} else if(cp=="naverblog"){
		location.href="http://blog.naver.com/openapi/share?url="+it_url+"&title="+naverblog_text;
	} else if(cp=="kakaotalk"){
		Kakao.init(kakao_key);
		Kakao.Link.sendTalkLink({
		  label: kakaotalk_text,
		  image: {
			src: it_img,
			width: '300',
			height: '200'
		  },
		  webButton: {
			text: cf_name,
			url: it_url
		  }
		});
	} else if(cp=="sms"){
		location.href="share_sms.php?it_id="+it_id;
		//location.href="sms://?body="+sms_text;
	} else if(cp=="twitter"){
		window.open('http://twitter.com/share?text=' + encodeURIComponent(twitter_text) + '&url=' + it_url,'twitterpopup', 'toolbar=0, status=0, width=626, height=436');
	} else if(cp=="facebook"){
		newwindow = window.open('http://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(it_url),'facebookpopup', 'toolbar=0, status=0, width=626, height=436');
		if(window.focus){ newwindow.focus(); }
	} else{

	}
}



































function favorite(){

	if(window.chrome){
		alert("키보드의 Ctrl+D 키를 함께 누르시면 즐겨찾기에 추가됩니다.");
	} else if(window.sidebar){
		alert("키보드의 Ctrl+B 키를 함께 누르시면 즐겨찾기에 추가됩니다.");
		window.sidebar.addPanel(nfor_name, nfor_url, "");
	} else{
		window.external.AddFavorite(nfor_url, nfor_name);
	}

}

function show_hide(div){
	if($(div).css('display')=="none"){
		$(div).show();
	} else{
		$(div).hide();
	}
}





















function nfor_list(str,action,frm){

	if(frm){
		$('#mode'+frm).val(action);
	} else{
		$('#mode').val(action);
	}




	var chk = document.getElementsByName("chk[]");
	var bchk = false;

	for (i=0; i<chk.length; i++){
		if (chk[i].checked)
			bchk = true;
	}

	if (!bchk){
		alert(str+"할 자료를 하나 이상 선택하세요");
		return;
	}
	if(frm){
		$('#flist'+frm).submit();
	} else{
		$('#flist').submit();
	}
}



function faq_show(ty,wr_id){

	if($(ty+'_'+wr_id).css('display')=="none"){
		$(ty).hide();
		$(ty+'_'+wr_id).show();
	} else{
		$(ty+'_'+wr_id).hide();
	}

}





























function search_it_id(key){
    window.open("search_it_id.php?key="+key, "search_it_id", "left=50,top=50,width=600,height=600,scrollbars=1");
}

function search_category_id(key){
    window.open("search_category_id.php?key="+key, "search_category_id", "left=50,top=50,width=600,height=600,scrollbars=1");
}

function search_mb_id(key){
    window.open("search_mb_id.php?key="+key, "search_mb_id", "left=50,top=50,width=600,height=600,scrollbars=1");
}


function insert_val(key,val){
	$("#"+key, opener.document).val(val);
    window.close();
}


















function mobileweb_link(){

	var url = nfor_path+"/m/";
    window.open(url, "mobile", "left=50,top=50,width=480,height=600,scrollbars=1");

}





function ticket_print(ct_id){
	var url = nfor_path+"/ticket_print.php?ct_id="+ct_id;
    window.open(url, "ticket_print", "left=50,top=50,width=770,height=600,scrollbars=1");
}



function order_cancel_confirm(ct_id){
	var url = nfor_path+"/order_cancel_confirm.php?ct_id="+ct_id;
    window.open(url, "order_cancle_confirm", "left=50,top=50,width=770,height=600,scrollbars=1");
}
function delivery_change(od_id){
	var url = nfor_path+"/delivery_change.php?od_id="+od_id;
    window.open(url, "delivery_change", "left=50,top=50,width=770,height=400,scrollbars=1");
}


function it_tab_chg(type){

	$(".it_tab").css("display","none");
	$(".it_tab_"+type).css("display","block");

	for(i=1; i<=$('.it_tab_all').length; i++){
		if(i==type){
			$('#it_tab_'+i).attr("src",'img/it_tab_'+i+'_ov.jpg');
		} else{
			$('#it_tab_'+i).attr("src",'img/it_tab_'+i+'.jpg');
		}
	}

}

function sel_address(val){
	if(val=="1"){
		$('#dy_name').val($('#mb_name').val());
		$('#dy_hp1').val($('#mb_hp1').val());
		$('#dy_hp2').val($('#mb_hp2').val());
		$('#dy_hp3').val($('#mb_hp3').val());
		$('#dy_zip1').val($('#mb_zip1').val());
		$('#dy_zip2').val($('#mb_zip2').val());
		$('#dy_addr1').val($('#mb_addr1').val());
		$('#dy_addr2').val($('#mb_addr2').val());
	} else if(val=="2"){
		$('#dy_name').val('');
		$('#dy_hp1').val('');
		$('#dy_hp2').val('');
		$('#dy_hp3').val('');
		$('#dy_zip1').val('');
		$('#dy_zip2').val('');
		$('#dy_addr1').val('');
		$('#dy_addr2').val('');
	} else if(val=="3"){
		$('#dy_name').val($('#last_name').val());
		$('#dy_hp1').val($('#last_hp1').val());
		$('#dy_hp2').val($('#last_hp2').val());
		$('#dy_hp3').val($('#last_hp3').val());
		$('#dy_zip1').val($('#last_zip1').val());
		$('#dy_zip2').val($('#last_zip2').val());
		$('#dy_addr1').val($('#last_addr1').val());
		$('#dy_addr2').val($('#last_addr2').val());
	} else if(val=="4"){
		$('#dy_name').val($('#my_name').val());
		$('#dy_hp1').val($('#my_hp1').val());
		$('#dy_hp2').val($('#my_hp2').val());
		$('#dy_hp3').val($('#my_hp3').val());
		$('#dy_zip1').val($('#my_zip1').val());
		$('#dy_zip2').val($('#my_zip2').val());
		$('#dy_addr1').val($('#my_addr1').val());
		$('#dy_addr2').val($('#my_addr2').val());
	} else{

	}
}

function my_address(){

	var url = "myaddress.php";
    window.open(url, "my_address", "left=50,top=50,width=770,height=600,scrollbars=1");

}


function div_up(){
	$(".baloon").animate({'top':0}, 'slow', null, div_down);
}

function div_down(){
	$(".baloon").animate({'top':20}, 1000, null, div_up);
}


function it_select(frm,fid){
	window.open('it_select.php?frm='+frm+'&fid='+fid+'&it_value='+$('#'+fid).val(),'it_select', 'width=1000, height=900, scrollbars=yes');
}


function company_info(wrkr_no){
	var url = "http://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no="+wrkr_no;
	window.open(url, "company_info", "width=750, height=700;");
}



function admin_memo_update(){

	$.ajax({
		type : "POST"
		, url : "admin_memo_update.php"
		, cache : false
		, data : $("#admin_memo_form").serialize()
		, success : function(response){
			$('#admin_memo_datetime').html(response);
		}
	});

}

function zipcode(mb_zipcode,mb_addr1,mb_addr2){
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
			var extraRoadAddr = ''; // 도로명 조합형 주소 변수

			// 법정동명이 있을 경우 추가한다. (법정리는 제외)
			// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
			if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
				extraRoadAddr += data.bname;
			}
			// 건물명이 있고, 공동주택일 경우 추가한다.
			if(data.buildingName !== '' && data.apartment === 'Y'){
			   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
			}
			// 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
			if(extraRoadAddr !== ''){
				extraRoadAddr = ' (' + extraRoadAddr + ')';
			}
			// 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
			if(fullRoadAddr !== ''){
				fullRoadAddr += extraRoadAddr;
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById(mb_zipcode).value = data.zonecode; //5자리 새우편번호 사용
			document.getElementById(mb_addr1).value = fullRoadAddr;
			document.getElementById(mb_addr2).focus();

		}
	}).open();
}

function star_reply_submit(){

	$.ajax({
	   type: "POST",
	   url: "star_reply.php",
	   data: "&mode=insert&wr_id="+$('#wr_id').val()+"&wr_memo="+$('#wr_memo').val(),
	   success: function(response){
 			switch(response){
				case 'insert' : alert('답변이 등록되었습니다');  document.location.reload(); break;
			}
 	   }
	});

	return;

}

function star_reply(wr_id){

	$.ajax({
		type: 'POST',
		url: 'star_reply.php',
        cache: false,
		data : 'wr_id='+wr_id,
		success: function(data){
			if(data){
				//xdialog_close();
				$("#xdialog2").html(data);
				$('#xdialog2').dialog({ title:"상품문의답변", closeOnEscape:false,width:500, height:500, autoOpen: false,modal: true,resizable: false });	// 회원정보
				$('#xdialog2').dialog('open');
			} else {
				pageGo();
			}
		},
		error: function(){
			alert('에러발생 잠시후 다시 시도해주세요');
		},
		dataType: "html"
	});

}


function qna_reply_submit(){

	if(confirm("입력하신 내용을 등록하시겠습니까?z")){

		$.ajax({
			type: "post",
			data : $(".form_qna_reply").serialize(),
			url: nfor_path + "/item_qna_form.php",
			success: function(response){
				var json = $.parseJSON(response);
				if(json["result"]=="ok"){
					alert('답변이 등록되었습니다');
					document.location.reload();
				} else{
					alert(json["msg"]);
				}
			}
		});

	}

}

function qna_reply(wr_id){

	$.ajax({
		type: 'POST',
		url: 'qna_reply.php',
        cache: false,
		data : 'wr_id='+wr_id,
		success: function(data){
			if(data){
				//xdialog_close();
				$("#xdialog2").html(data);
				$('#xdialog2').dialog({ title:"상품문의답변", closeOnEscape:false,width:500, height:500, autoOpen: false,modal: true,resizable: false });	// 회원정보
				$('#xdialog2').dialog('open');
			} else {
				pageGo();
			}
		},
		error: function(){
			alert('에러발생 잠시후 다시 시도해주세요');
		},
		dataType: "html"
	});

}

function it_id_insert(it_id,it_name){
	$('#it_id').val(it_id);
	$('#it_subject').val(it_name);
	xdialog2_close();
    return;
}

function it_id_search_div(){

	$.ajax({
	   type: "POST",
	   url: "it_id_search.php",
	   data: "&mode=insert&keyword=" + $('#keyword').val(),
	   success: function(response){
 			$('#it_id_div').html(response);
 	   }
	});

	return;

}

function it_id_search(){

	$.ajax({
		type: 'POST',
		url: 'it_id_search.php',
        cache: false,
		success: function(data){
			if(data){
				$("#xdialog2").html(data);
				$('#xdialog2').dialog({ title: '상품선택', closeOnEscape:false,width:500, height:400, autoOpen: false,modal: true,resizable: false });
				$('#xdialog2').dialog('open');
			} else {
				pageGo();
			}
		},
		error: function(){
			alert('에러발생 잠시후 다시 시도해주세요');
		},
		dataType: "html"
	});

}

function member(mb_no) {
	var url = nfor_path+"/plugin/member/mb_order.php?mb_no="+mb_no;
	window.open(url, "member", "left=50,top=50,width=900,height=800,scrollbars=1");

}



function number_format(data){

	data = data+'';

	var tmp = '';
	var number = '';
	var cutlen = 3;
	var comma = ',';
	var i;

	len = data.length;
	mod = (len % cutlen);
	k = cutlen - mod;
	for (i=0; i<data.length; i++)
	{
		number = number + data.charAt(i);

		if (i < data.length - 1)
		{
			k++;
			if ((k % cutlen) == 0)
			{
				number = number + comma;
				k = 0;
			}
		}
	}

	return number;
}


function sms_count(obj,name) {
	var bytesLength = 0;
	var validMsgLength = 0;
	var validBytesLength = 0;
	for ( i = 0; i < obj.value.length; i++ ) {
		var oneChar = obj.value.charAt(i);
		if (escape(oneChar).length > 4) {
			bytesLength += 2;
		} else if (oneChar != '\r') {
			bytesLength++;
		}
		if ( bytesLength <= 80 )	{
			validMsgLength = i + 1;
			validBytesLength = bytesLength;
		}
	}
	if (bytesLength > 80) {
		alert("80바이트 이상의 메세지는 전송하실 수 없습니다");
		realValue = obj.value.substr(0, validMsgLength);
		obj.value = realValue;
		bytesVal = validBytesLength;
	} else {
		bytesVal = bytesLength;
	}
	$('#'+name).html(bytesVal);
	obj.focus();
}















function xdialog2_close(){
	$("#xdialog2").dialog('close');
}

function xdialog_close(){
	$("#xdialog").dialog('close');
}

function login(url,type){

	if(!url) url = "";

	location.href = "login.php?url="+url;
	return false;

}

function nfor_login_confirm(it_id){
	if(confirm("로그인후 이용해주세요")){
		login("item.php?it_id="+it_id,"2");
	}
}

function pageGo(url){
	if(url){
		window.location.href = url;
	} else{
		window.location.reload();
	}
}

function printContent(obj){
	var printHTML = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	printHTML += '<html xmlns="http://www.w3.org/1999/xhtml">';
	printHTML += '<head>';
	printHTML += '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	printHTML += '<title>nfor</title>';
	printHTML += '</head>';
	printHTML += '<body style="background:none;">';
	printHTML += '<div id="wrap">';
	printHTML += '<div id="system">';
	printHTML += $(obj).html();
	printHTML += '</div></div></body></html>';
	var WindowObject = window.open('', "nfor", "width=1,height=1,top=1000,left=1000,toolbars=no,scrollbars=no,status=no,resizable=no");
	WindowObject.document.writeln( printHTML );
	WindowObject.document.close();
	WindowObject.focus();
	WindowObject.print();
	WindowObject.close();
}


function owner_id_search(){

	$.ajax({
		type: 'POST',
		url: 'owner_id_search.php',
        cache: false,
		success: function(data){
			if(data){
				xdialog_close();
				$("#xdialog2").html(data);
				$('#xdialog2').dialog({ title: '공급업체조회', closeOnEscape:false,width:500, height:400, autoOpen: false,modal: true,resizable: false });
				$('#xdialog2').dialog('open');
			} else {
				pageGo();
			}
		},
		error: function(){
			alert('에러발생 잠시후 다시 시도해주세요');
		},
		dataType: "html"
	});
}

function area_type_form(){

	$.ajax({
		type: 'POST',
		url: 'area_type_form.php',
        cache: false,
		success: function(data){
			if(data){
				xdialog_close();
				$("#xdialog2").html(data);
				$('#xdialog2').dialog({ title:'지역구분설정', closeOnEscape:false,width:500, height:540, autoOpen: false,modal: true,resizable: false });
				$('#xdialog2').dialog('open');
			} else {
				pageGo();
			}
		},
		error: function(){
			alert('에러발생 잠시후 다시 시도해주세요');
		},
		dataType: "html"
	});

}

function banner_type_form(){

	$.ajax({
		type: 'POST',
		url: 'banner_type_form.php',
        cache: false,
		success: function(data){
			if(data){
				$("#xdialog2").html(data);
				$('#xdialog2').dialog({ title:'배너그룹설정', closeOnEscape:false,width:500, height:540, autoOpen: false,modal: true,resizable: false });
				$('#xdialog2').dialog('open');
			} else {
				pageGo();
			}
		},
		error: function(){
			alert('에러발생 잠시후 다시 시도해주세요');
		},
		dataType: "html"
	});

}

function area_update(wr_id, wr_type, wr_rank, wr_use){

	$('#wr_id').val(wr_id);
	$('#wr_type').val(wr_type);
	$('#wr_rank').val(wr_rank);
	$('#wr_use').val(wr_use);
	$('#area_add_btn').hide();
	$('#area_edit_btn').show();

}

function banner_update(wr_id, wr_group, wr_code){

	$('#wr_id').val(wr_id);
	$('#wr_code').val(wr_code);
	$('#wr_group').val(wr_group);
	$('#banner_add_btn').hide();
	$('#banner_edit_btn').show();

}

function area_action(mode, wr_id){

	if(mode=="insert" || mode=="update"){

		if(!$("#wr_type").val()){
			alert("지역구분을 입력해주세요");
			$("#wr_type").focus();
			return;
		}
		if(!$("#wr_rank").val()){
			alert("정렬을 입력해주세요");
			$("#wr_rank").focus();
			return;
		}

		var number_chk = /^[0-9]+$/;
		if(!number_chk.test($("#wr_rank").val())){
			alert("숫자만 입력해주세요");
			$("#wr_rank").focus();
			return;
		}



	}

	if(mode=="delete"){
		if(!confirm("삭제하시면 복구가 불가능합니다\n정말 삭제하시겠습니까?")){
			return;
		}
	}

	$.ajax({
	   type: "POST",
	   url: "area_type_list.php",
	   data: "mode="+mode+"&wr_type=" + $('#wr_type').val() + "&wr_rank=" + $('#wr_rank').val() + "&wr_use=" + $('#wr_use').val() + "&wr_id=" + wr_id,
	   success: function(response){
			$('#area_type_list').html(response);

		$('#wr_id').val('');
		$('#wr_type').val('');
		$('#wr_rank').val('');
		$('#wr_use').val(1);
		$('#area_add_btn').show();
		$('#area_edit_btn').hide();
	   }

	});

}

function banner_action(mode, wr_id){

	if(mode=="insert" || mode=="update"){

		if(!$("#wr_group").val()){
			alert("그룹명을 입력해주세요");
			$("#wr_group").focus();
			return;
		}
		if(!$("#wr_code").val()){
			alert("그룹코드를 입력해주세요");
			$("#wr_code").focus();
			return;
		}

	}

	if(mode=="delete"){
		if(!confirm("삭제하시면 복구가 불가능합니다\n정말 삭제하시겠습니까?")){
			return;
		}
	}

	$.ajax({
	   type: "POST",
	   url: "banner_type_list.php",
	   data: "mode="+mode+"&wr_group=" + $('#wr_group').val() + "&wr_code=" + $('#wr_code').val() + "&wr_id=" + wr_id,
	   success: function(response){
		$('#banner_type_list').html(response);

		$('#wr_id').val('');
		$('#wr_group').val('');
		$('#wr_code').val('');
		$('#banner_add_btn').show();
		$('#banner_edit_btn').hide();
	   }

	});

}

function owner_id_insert(mb_id,it_address){
	$('#owner_id').val(mb_id);

	$('#it_address').val(it_address);

	$('#owner_id').focus();
    xdialog2_close();
	$('#cp_info').show();
	nfor_map_search();
    return;
}

function owner_id_search_div(){

	$.ajax({
	   type: "POST",
	   url: "owner_id_search.php",
	   data: "&mode=insert&keyword=" + $('#keyword').val(),
	   success: function(response){
 			$('#owner_id_div').html(response);
 	   }
	});

	return;

}

function nfor_item_faq_load(page){

	$('#item_faq_page').val(page);
	$.ajax({
	   type: "POST",
	   url: nfor_path + "/nfor_item_faq.php",
	   data: "it_id=" + $('#it_id').val()+"&page=" + page,
	   success: function(response){
			$('#faq').html(response);
	   }
	});
}



function item_qna_load(it_id,page){
	$.ajax({
	   type: "POST",
	   url: "item_qna_list.php",
	   data: "it_id=" + it_id + "&page=" + page,
	   success: function(response){
			$('.qna_list').html(response);
	   }
	});
}



function item_star_load(it_id,page){
	$.ajax({
	   type: "POST",
	   url: "item_star_list.php",
	   data: "it_id=" + it_id + "&page=" + page,
	   success: function(response){
			$('.star_list').html(response);
	   }
	});
}





function nfor_copy_url(type){
	var doc = $('#'+type).get(0).createTextRange();
	$('#'+type).get(0).select();
    doc.execCommand('copy');
    alert('주소가 복사 되었습니다');
	return;
}

function del(href){
	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")){
		document.location.href = href;
    }
}

function check_all(f){
	var chk = document.getElementsByName("chk[]");
	for (i=0; i<chk.length; i++)
		chk[i].checked = f.chkall.checked;
}

function nfor_load(tbl_id, load_page, page){

	$.ajax({
	   type: "POST",
	   url: nfor_path+"/"+load_page,
	   data: "page=" + page,
	   success: function(response){
			$('#'+tbl_id).html(response);
	   }
	});

}
