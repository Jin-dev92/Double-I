<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>비오페이스</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- Compiled and minified JavaScript -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
<link rel="stylesheet" href="assets/css/materialize.min.css">
</head>
<style>
img {
	max-width: 100%;
    display: block;
    margin: -1px auto;
    padding: 0;
}

.submitBtn {
	width: 100%;
	height: 100%;
	padding: 10px 0;
	background-color: #8274B1;
	color: #ffffff;
	line-height: 1.7em;
	font-weight: bold;
	margin-top: 25px;

}
.cnosult {
	max-width: 640px;
	margin: 0 auto;
}
.contents_input {
	padding: 0;
}

.movie {
	display: block;
	margin: 0 auto;
	width: 100%;
}
.iframe {
	position: absolute;
    background: lightgray;
    width: 57%;
    height: 100%;
    top: 0;
    left: 21%;
}
.consult_btn {
	position: absolute;
    width: 42%;
    height: 100%;
    top: 0;
    left: 29%;

}
#modal1 {
	z-index: 99999;
}
</style>
<body>
<div class="container" style="width: 100%; max-width: 640px;">
	

		<div class="col-sm-12">
			<img src="assets/img/1.jpg?<?=rand()?>">
			
			<div class="movie" style="position: relative;">
				<img src="assets/img/4.jpg" style="position: relative;">
				<div class="iframe"></div>	
			</div>
			<img src="assets/img/2.jpg?<?=rand()?>">

			<div class="consult_go" style="position: relative;">
				<img src="assets/img/5.jpg" style="position: relative;">
				<a href="#modal2" class="modal-trigger"><div class="consult_btn"></div></a>
			</div>

			<img src="assets/img/3.jpg?<?=rand()?>">
		</div>


</div>

<div id="modal2" class="modal modal-fixed-footer">
	<div class="modal-content">
		<div class="cnosult">
			<div class="row">
				<div class="col s12">
					<div class="input-field col m7 s7">
						<input placeholder=" " id="first_name" type="text" class="validate name">
		          		<label for="first_name">이름</label>
					</div>
					<div class="input-field col m5 s5">
						<select class="gender">
							<option value="여자" selected>여자</option>
							<option value="남자">남자</option>
					    </select>
					    <label>성별</label>
					</div>
					<div class="input-field col m12 s12">
						<div class="col s4">
							<select class="phone1">
								<option value="010" selected>010</option>
								<option value="011">011</option>
								<option value="016">016</option>
								<option value="017">017</option>
								<option value="018">018</option>
								<option value="019">019</option>
							</select>
							<label>연락처</label>
						</div>
					    <div class="col s4">
							<input id="first_name" type="text" class="validate phone2" data-length="4">
			          	</div>
			          	<div class="col s4">
			          		<input id="first_name" type="text" class="validate phone3" data-length="4">
			          	</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col s12">
					<div class="input-field col m6 s6">
						<div class="col s12 ">
							<select class="part">
								<option value="" disabled selected>::선택::</option>
								<option value="복부(옆구리)">복부(옆구리)</option>
								<option value="러브핸들(등)">러브핸들(등)</option>
								<option value=" 허벅지(무릎안)"> 허벅지(무릎안)</option>
								<option value="종아리(발목)">종아리(발목)</option>
								<option value="팔(뒷날개)">팔(뒷날개)</option>
						    </select>
						    <label>상담부위</label>
						</div>			    
					</div>
					<div class="input-field col m6 s6">
						<div class="col s12">
							<select class="wishtime">
								<option value="" disabled selected>::선택::</option>
								<option value="11:00 ~ 11:30">11:00 ~ 11:30</option>
								<option value="11:30 ~ 12:00">11:30 ~ 12:00</option>
								<option value="12:00 ~ 12:30">12:00 ~ 12:30</option>
								<option value="12:30 ~ 13:00">12:30 ~ 13:00</option>
								<option value="13:00 ~ 13:30">13:00 ~ 13:30</option>
								<option value="13:30 ~ 14:00">13:30 ~ 14:00</option>
								<option value="14:00 ~ 14:30">14:00 ~ 14:30</option>
								<option value="14:30 ~ 15:00">14:30 ~ 15:00</option>
								<option value="15:00 ~ 15:30">15:00 ~ 15:30</option>
								<option value="15:30 ~ 16:00">15:30 ~ 16:00</option>
								<option value="16:00 ~ 16:30">16:00 ~ 16:30</option>
								<option value="16:30 ~ 17:00">16:30 ~ 17:00</option>
								<option value="17:00 ~ 17:30">17:00 ~ 17:30</option>
								<option value="17:30 ~ 18:00">17:30 ~ 18:00</option>
								<option value="18:00 ~ 18:30">18:00 ~ 18:30</option>	
						    </select>
						    <label>상담희망시간</label>
						</div>			    
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col s12" style="padding: 0">
					<div class="input-field col m9 s9">
						<div class="input-field col s12 contents_input">
							<textarea id="textarea1" class="materialize-textarea contents" data-length="500" placeholder="궁금하셨던 부분을 여기에 남겨주시면 희망하시는 시간대에 연락드리겠습니다."></textarea>
						</div>
					</div>
					<div class="input-field col m3 s3 submit">
						 <button class="waves-effect waves-light btn submitBtn" type="submit" name="action">상담<Br>신청
						</button>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<p>
						<input type="checkbox" class="filled-in check_check" id="filled-in-box"/>
						<label for="filled-in-box">상담 및 예약 목적 외 이용하지 않으며, <a href="#modal1" class="modal-trigger">개인정보취급방침</a>에 동의합니다. 반드시 전화 통화를 통해 예약 절차를 마치셔야 예약이 완료되니 이 점 유의 바랍니다.</label>
					</p>
				</div>		
			</div>
		

		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">취소</a>
	</div>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h5>개인정보취급방침</h5>
				  <p>	- 비오페이스 및 제휴사이트 서비스를 위한 회원 가입 및 이용아이디 발급
	<br><br>
		- 서비스의 이행(경품 등 우편물 배송 및 예약에 관한 사항)
	<br><br>
		- 장애처리 및 개별 회원에 대한 개인 맞춤서비스
	<br><br>
		- 서비스 이용에 대한 통계수집
	<br><br>
		- 기타, 새로운 서비스 및 정보 안내
	<br><br>
	단, 이용자의 기본적 인권침해의 우려가 있는 민감한 개인정보는 수집하지 않습니다.
	<br><br>
	비오페이스는 상기 범위 내에서 보다 풍부한 서비스를 제공하기 위해 이용자의 자의에 의한 추가정보를 수집합니다.
	<br><br>
	수집하는 개인정보 항목
	<br><br>
	비오페이스는 회원가입, 상담, 서비스 신청 등을 위해 아래와 같은 개인정보를 수집하고 있습니다.
	<br><br>
		- 수집항목: 이름, 생년월일, 성별, 로그인 ID, 비밀번호, 자택 전화번호, 자택 주소, 휴대전화번호, 이메일, 주민등록번호, 서비스이용기록, 접속로그, 쿠키, 접속 IP 정보 , 결제기록
	<br><br>
		- 개인정보 수집방법: 홈페이지(회원가입, 게시판, 온라인상담, 온라인예약 등)
	<br><br>
	비오페이스는 귀하의 개인정보보호를 매우 중요시하며, 개인정보보호방침을 통하여 귀하께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다. 개인정보 수집에 대한 동의 비오페이스는 귀하께 회원가입시 개인정보보호방침 또는 이용약관의 내용을 공지하며 회원가입버튼을 클릭하면 개인정보 수집에 대해 동의하신 것으로 봅니다. 개인정보의 수집목적 및 이용목적 비오페이스는 다음과 같은 목적을 위하여 개인정보를 수집하고 있습니다 .
	<br><br>
	쿠키에 의한 개인정보 수집
	<br><br>
	비오페이스는 귀하에 대한 정보를 저장하고 수시로 찾아내는 '쿠키 (cookie)' 를 사용합니다. 쿠키는 웹사이트가 귀하의 컴퓨터 브라우저(넷스케이프, 인터넷 익스플로러 등)로 전송하는 소량의 정보입니다. 귀하가 웹사이트에 접속을 하면 비오페이스 웹서버는 귀하의 브라우저에 있는 쿠키의 내용을 읽고, 귀하의 추가정보를 귀하의 컴퓨터에서 찾아 접속에 따른 아이디 등의 추가 입력없이 서비스를 제공할 수 있습니다. 쿠키는 귀하의 컴퓨터는 식별하지만 귀하를 개인적으로 식별하지는 않습니다.
	<br><br>
	또한 귀하는 쿠키에 대한 선택권이 있습니다. 웹브라우저의 옵션을 조정함으로써 모든 쿠키를 다 받아들이거나, 쿠키가 설치될 때 통지를 보내도록 하거나 아니면 모든 쿠키를 거부할 수 있는 선택권을 가질 수 있습니다.
	<br><br>
	개인정보의 제3자에 대한 제공
	<br><br>
	비오페이스는 귀하의 개인정보를 <개인정보의 수집목적 및 이용목적>에서 고지한 범위 내에서 사용하며, 동 범위를 초과하여 이용하거나 타인 또는 타기업/기관에 제공하지 않습니다. 그러나 보다 나은 서비스 제공을 위하여 귀하의 개인정보를 제휴사에게 제공하거나 또는 제휴사와 공유할 수 있습니다. 단, 개인정보를 제공하거나 공유할 경우에는 사전에 귀하께 고지하여 드립니다.
	<br><br>
	개인정보의 열람/정정
	<br><br>
	귀하는 언제든지 등록되어 있는 귀하의 개인정보를 열람하거나 정정하실 수 있습니다. 개인정보 열람 및 정정을 하고자 할 경우에는 <회원정보수정> 을 클릭하여 직접 열람 또는 정정하거나 개인정보관리책임자에게 E-mail로 연락하시면 조치하여 드립니다.
	<br><br>
	귀하가 개인정보의 오류에 대한 정정을 요청한 경우, 정정을 완료하기 전까지 당해 개인정보를 이용하지 않습니다.
	<br><br>
	개인정보 수집, 이용, 제공에 대한 동의철회
	<br><br>
	회원가입 등을 통해 개인정보의 수집, 이용, 제공에 대해 귀하께서 동의하신 내용을 귀하는 언제든지 철회할 수 있습니다. 동의철회는 웹사이트 및 개인정보관리책임자에게 E-mail 등으로 연락하시면 즉시 개인정보의 삭제 등 필요한 조치를 하겠습니다.
	<br><br>
	개인정보의 보유기간 및 이용기간
	<br><br>
	귀하의 개인정보는 다음과 같이 개인정보의 수집목적 또는 제공받은 목적이 달성되면 파기됩니다.
		- 회원 가입정보의 경우, 회원 가입을 탈퇴하거나 회원에서 제명된 때
	<br><br>
		- 예약의 경우, 예약에 따른 처리 및 진료가 완료된 때
	<br><br>
	위 보유기간에도 불구하고 계속 보유하여야 할 필요가 있을 경우에는 귀하의 동의를 받습니다.
	<br><br>
	개인정보보호를 위한 기술적 대책
	<br><br>
	비오페이스는 귀하의 개인정보를 취급함에 있어 개인정보가 분실, 도난, 누출, 변조 또는 훼손되지 않도록 안전성 확보를 위하여 다음과 같은 기술적 대책을 강구하고 있습니다.
	<br><br>
	귀하의 개인정보는 비밀번호에 의해 보호되며, 파일 및 전송 데이터를 암호화하거나 파일 잠금기능(Lock)을 사용하여 중요한 데이터는 별도의 보안기능을 통해 보호되고 있습니다.
	<br><br>
	비오페이스는 회원인증과 관련 암호알고리즘을 이용하여 네트워크 상의 개인정보를 안전하게 전송할 수 있는 인증 및 보안장치를 채택하고 있으며, 시스템상 사정에 의해 미시행시 도우미에 의한 의사 확인을 시행하고 있습니다.
	<br><br>
	해킹 등에 의해 귀하의 개인정보가 유출되는 것을 방지하기 위해 외부로부터의 침입을 차단하는 장치를 이용하고 있으며, 각 서버마다 침입탐지시스템을 설치하여 24시간 침입을 감시하고 있습니다.
	<br><br>
	의견수렴 및 불만처리
	<br><br>
	비오페이스는 개인정보보호와 관련하여 귀하가 의견과 불만을 제기할 수 있는 창구를 개설하고 있습니다. 개인정보와 관련한 불만이 있으신 분은 비오페이스의 개인정보 관리책임자에게 의견을 주시면 접수 즉시 조치하여 처리결과를 통보해 드립니다.
	<br><br>
	14세 미만 어린이들에 대한 보호정책
	<br><br>
	비오페이스는 14세 미만 어린이들에 대한 회원 미가입 정책과 함께 개인정보를 부모의 동의 없이 제3자와 공유하지 않으며 사용자에 관한 정보를 매매하거나 대여하지 않습니다.
	<br><br>
	개인정보 관리책임자
	<br><br>
	비오페이스는 개인정보에 대한 의견수렴 및 불만처리의 정책을 담당하는 개인정보정책 담당 관리책임자를 지정하고 있습니다. 본 정책에 대한 불만사항이 있으시다면 아래 연락처로 문의 하시면 친절히 처리하여 드리겠습니다.
	<br><br>
	개인정보정책 책임자
	<br><br>
	성 명 :
	<br><br>
	박주영
	<br><br>
	소 속 :
	<br><br>
	비오페이스
	<br><br>
	연락처 :
	<br><br>
	1833 - 8838
	<br><br>
	이메일 :
	<br><br>
	bioface@naver.com
	<br><br>
	시행일
	<br><br>
	본 개인정보보호정책은 2014년 10월 26일부터 시행합니다.</p>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-action modal-close modal-action waves-effect waves-green btn-flat">확인</a>
			</div>
		</div>







<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/materialize.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-messaging.js"></script>
<script>




  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBA7sHrhxZ4cbS0zgCJ8AiX8oFJ93POLWw",
    authDomain: "bioface-db-page.firebaseapp.com",
    databaseURL: "https://bioface-db-page.firebaseio.com",
    projectId: "bioface-db-page",
    storageBucket: "bioface-db-page.appspot.com",
    messagingSenderId: "418660414626"
  };
  firebase.initializeApp(config);
</script>
<script>     
function close_modal(){
	$('#modal2').hide();
	$('.modal-overlay').eq(1).hide();
}
$(document).ready(function() {
	$('select').material_select();
	$('#modal2').modal();

	  $('#modal1').modal({
	  	dismissible: false, // Modal can be dismissed by clicking outside of the modal
		opacity: 0, // Opacity of modal background
 		
		ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
			
			$('.modal-overlay').eq(1).css('z-index','-1');
      },
    }
  );
});

$('.submit').click(function(){
	var date = '<?=DATE("Y-m-d H:i:s",time())?>';


	var name = $('.name').val();
	var phone1 = $('.phone1 option:selected').val();
	var phone2 = $('.phone2').val();
	var phone3 = $('.phone3').val();
	var phone = phone1 + '-' + phone2 + '-' + phone3;
	var gender = $('.gender option:selected').val();
	var wishtime = $('.wishtime option:selected').val();
	var contents = $('.contents').val();
	var part = $('.part option:selected').val();
	var origin = '<?=$_GET[origin]?>';

	if(name == ''){
		alert('이름을 입력해주세요.');
		$('.name').focus();

		return false;
	}

	var kor_check = /([^가-힣ㄱ-ㅎㅏ-ㅣ\x20])/i;
	if (kor_check.test(name)) {
		alert("한글만 입력할 수 있습니다.");
		$(".name").val("");
		$(".name").focus();
		return false;
	}


	if ($(".phone2").val()=="" || $(".phone3").val()=="") {
        alert("다시 한 번 올바르게 입력해 주세요");
        $(".phone2").focus();
        return false;
      }

      if ($(".phone3").val().length!=4) {
        alert("다시 한 번 올바르게 입력해 주세요");
        $(".phone3").focus();
        return false;
      }

      var num_check=/^[0-9]*$/;
      var phone_val1 =$(".phone2").val();
      var phone_val2 =$(".phone3").val();
      if (num_check.test(phone_val1)) {
        if ($(".phone2").val().length<3||$(".phone2").val().length>4) {
          alert("전화번호를 올바르게 넣어주세요.");
          $(".phone2").focus();
          return false;
        }
      }else {
        alert("숫자만 입력할 수 있습니다.");
        $(".phone2").focus();
        return false;
      }
      if (num_check.test(phone_val2)) {
        if ($(".phone3").val().length!=4) {
          alert("다시 한 번 올바르게 입력해 주세요");
          $(".phone3").focus();
          return false;
        }
      }else {
        alert("숫자만 입력할 수 있습니다.");
        $(".phone3").focus();
        return false;
      }

      if($('.part option:selected').val() == ''){
      	alert('부위를 선택해주세요.');
      	$(".part").focus();
      	return false;
      }

      if($('.wishtime option:selected').val() == ''){
      	alert('상담시간을 선택해주세요.');
      	$(".wishtime").focus();
      	return false;
      }


	if($('.check_check').is(":checked") == false) {
		alert('이용약관에 동의해주세요.');
		return false;
	}

	var arr_size;

	firebase.database().ref('/users/').once('value').then(function(snapshot){
		
		arr_size  = arrayCounter(snapshotToArray(snapshot));

			
		var userKey = firebase.database().ref().push().key;

		firebase.database().ref('users/' + userKey).set({
			name : name,
			phone : phone,
			gender : gender,
			part: part,
			wishtime : wishtime,
			contents: contents,
			time: date, 
			origin : "페북_피스토",
			process : "미확인",
			memo : "",
			idx : arr_size + 1,

		});

		alert('신청해주셔서 감사합니다.');
		location.href = 'http://www.bioface.kr';
		

	});

	


});
// 코드 배열로 받아오기
function snapshotToArray(snapshot) {
	var returnArr = [];

	snapshot.forEach(function(childSnapshot){
		var item = childSnapshot.val();
		item.key = childSnapshot.key;

		returnArr.push(item.key);

	});

	return returnArr;
}

// 배열의 길이 구하기
function arrayCounter(array) {
	if(typeof(array) == "object"){
		return array.length;
	}
	else
		return 0;
} 
</script>
</body>
</html>