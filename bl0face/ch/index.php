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
.indicator { display: none;}
.col.s12 { padding: 0;}
.tabs, .tabs .tab { height: 70px;}
.tabs .tab a { color: #bdbdbd; line-height: 20px; font-size: 20px;}
.tabs .tab a:hover, .tabs .tab a.active { color:#fff;}
.tabs li { background: rgb(150, 150, 150); cursor: pointer;}

.tabs li:nth-child(1).active_tab { background: #66cdcc;}
.tabs li:nth-child(2).active_tab { background: #920784;}
.tabs li.active_tab a { color: #fff}

.consult_btn { width: 100%; height: 50px; position: fixed; bottom: 0; background-color: #000;z-index: 99; text-align: center; display: block; line-height: 50px; color: #fff; font-size: 15px; max-width: 640px; margin: 0 auto; left: 50%; transform: translate(-50%);}
.tri { position: fixed; bottom: 15px; left: 50%; transform: translate(-50%); width: 50px; height: 50px; border-top: 50px solid transparent; border-right: 50px solid transparent; border-bottom: 50px solid #000; border-left: 50px solid transparent; max-width: 640px;}
</style>
<body>

<div class="row" style="width: 100%; max-width: 640px; margin-top: 70px;">
	<div class="col s12" style="position: fixed; top: 0; max-width: 640px;">
		<ul class="tabs">
			<li class="tab col s6 active_tab"><a style="padding: 15px 0;" class="active" href="#test1">01<br>Again 20'</a><div></div></li>
			<li class="tab col s6"><a style="padding: 15px 0;" href="#test2">02<br>thermage FLX</a><div></div></li>
		</ul>
	</div>
	
	<div id="test1" class="col s12"><img src="./assets/img/again_20_ch.jpg?4"><br><br><br></div>
	<div id="test2" class="col s12"><img src="./assets/img/thermage_flx_ch.jpg?4"><br><br><br></div>
</div>

<a href="#modal2" class="modal-trigger"><div class="tri"></div><div class="consult_btn">申请面诊</div></a>

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
				<a href="#!" class="modal-action modal-close modal-action waves-effect waves-green btn-flat">确认</a>
			</div>
		</div>
<div id="modal2" class="modal modal-fixed-footer">
	<div class="modal-content">
		<div class="cnosult">
			<div class="row">
				<div class="col s12">
					<div class="input-field col m7 s7">
						<input placeholder=" " id="first_name" type="text" class="validate name">
		          		<label for="first_name">名字</label>
					</div>
					<div class="input-field col m5 s5">
						<select class="gender">
							<option value="여자" selected>女</option>
							<option value="남자">男</option>
					    </select>
					    <label>性别</label>
					</div>
					<div class="input-field col m12 s12">
						<div class="col s12">
							<input placeholder="" id="phone" type="text" class="validate phone">
		          			<label for="phone">联系方式</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col s12">
					<div class="input-field col m6 s6">
						<div class="col s12 ">
							<select class="part">
								<option value="" disabled selected>::未选::</option>
								<option value="Again 20s">Again 20s</option>
								<option value="thermage FLX">thermage FLX</option>
						    </select>
						    <label>项目</label>
						</div>			    
					</div>
					<div class="input-field col m6 s6">
						<div class="col s12">
							<select class="wishtime">
								<option value="" disabled selected>::未选::</option>
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
						    <label>面诊时间</label>
						</div>			    
					</div>
				</div>
			</div>

			<!-- <div class="row">
				<div class="col s12" style="padding: 0">
					<div class="input-field col m12 s12">
						<div class="input-field col s12 contents_input">
							<textarea id="textarea1" class="materialize-textarea contents" data-length="500" placeholder="备注——追问事项"></textarea>
						</div>
					</div>
					
				</div>
			</div> -->

			<div class="row">
				<div class="col s12">
					<p>
						<input type="checkbox" class="filled-in check_check" id="filled-in-box"/>
						<label for="filled-in-box"><a href="#modal1" class="modal-trigger">同意个人信息处理方针</a><br>所收集的个人信息不使用于除面诊及预约以外的目的 。注意:必需通过电话完成预约手续后才能预约成功。</label>
					</p>
				</div>	
				<div class="input-field col m12 s12 submit">
					 <button class="waves-effect waves-light btn submitBtn" type="submit" name="action" style="display: block; width: 100%;">申请面诊
					</button>
				</div>	
			</div>
		

		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">取消</a>
	</div>
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/materialize.min.js"></script>
<script>    
$('.tabs .tab').on('click', function(){
	$('body,html').animate({scrollTop:0},200);

	$('.tabs .tab').removeClass('active_tab');
	$(this).addClass('active_tab');
});

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
	var phone = $('.phone').val();
	var gender = $('.gender option:selected').val();
	var wishtime = $('.wishtime option:selected').val();
	// var contents = $('.contents').val();
	var part = $('.part option:selected').val();

	if(name == ''){
		alert('请输入姓名');
		$('.name').focus();

		return false;
	}


		//전화번호입력해주세요 请输入联系方式

      var num_check=/^[0-9]*$/;
      if (num_check.test(phone)) {
        if ($(".phone").val().length==0) {
          alert("请输入联系方式");
          $(".phone").focus();
          return false;
        }
      }else {
        alert("只能输入数字");
        $(".phone").focus();
        return false;
      }


      // 숫자만只能输入数字

      if($('.part option:selected').val() == ''){
      	alert('请选择项目');
      	$(".part").focus();
      	return false;
      }

      // ㅂ위선택请选择项目

      if($('.wishtime option:selected').val() == ''){
      	alert('请选择面诊时间.');
      	$(".wishtime").focus();
      	return false;
      }
      // 희망시간

	if($('.check_check').is(":checked") == false) {
		alert('请同意个人信息处理方针.');
		return false;
	}


	//action
	$.ajax({
		url: "ajax.php",
		type: "POST",
		data: {
			name :  name,
			phone :  phone,
			gender :  gender,
			wishtime :  wishtime,
			part :  part,
			encoding : "utf-8"
		},
		async: false,
		success: function(data) {
			if(data.isError) {
				alert(data.message);
			} else {
				alert('面诊申请成功');
				window.location.reload(); 
			}
		},
		error : function(html) {
			alert("error:"+html);
		}
    });

});

</script>
</body>
</html>