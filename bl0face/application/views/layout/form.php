<style>
#quick_form{ position:fixed; left:0; bottom:50px; width:100%; z-index:1000000;}
#quick_form *{ line-height:1}
#quick_form .quick_btn{ position:absolute; bottom:0; left:50px; animation:bounce .4s ease infinite alternate;}
#quick_form .quick_btn img{ display:block; width:300px;}
#quick_form .form_popup{ display:none; position:absolute; bottom:0; right:50px; width:390px; border-radius:10px; background-color:#fff; box-shadow:0 0 8px 3px rgba(0,0,0,0.1);}
#quick_form .form_popup .xBtn{ position:absolute; top:15px; right:15px;}
#quick_form .form_popup .xBtn img{}
#quick_form .form_popup .titleBox{ background-color:#43c3c4; border-radius:10px 10px 0 0; padding:30px 0; text-align:center;}
#quick_form .form_popup .titleBox .logo{ display:inline-block; vertical-align:middle; margin-right:30px; width:120px;}
#quick_form .form_popup .titleBox .textBox{ display:inline-block; vertical-align:middle; text-align:left;}
#quick_form .form_popup .titleBox .textBox .text01{ font-size:18px; color:#fff;}
#quick_form .form_popup .titleBox .textBox .text02{ font-size:30px; font-weight:bold; color:#fff; margin-top:10px;}
#quick_form .form_popup .formBox{ width:100%; padding:25px 20px; box-sizing:border-box;}
#quick_form .form_popup .formBox .form_title{ width:100%; border-radius:7px; background-color:#e5e5e5; font-size:17px; color:#333; padding:20px 15px; box-sizing:border-box;}
#quick_form .form_popup .formBox .inputBox{ width:100%; height:45px; border:1px solid #ddd; box-sizing:border-box; border-radius:7px; margin-top:10px;}
#quick_form .form_popup .formBox .inputBox input{ display:block; width:100%; height:100%; font-size:16px; color:#333; border-radius:7px; padding-left:15px; box-sizing:border-box; border:none; background-color:transparent; outline:none; box-shadow:none;}
#quick_form .form_popup .formBox .agreeBox{ text-align:center; margin-top:15px;}
#quick_form .form_popup .formBox .agreeBox input{ display:inline-block; vertical-align:middle; width:20px; height:20px; position:relative; opacity:1; margin:0; pointer-events:auto}
#quick_form .form_popup .formBox .agreeBox label{ display:inline-block; vertical-align:middle; font-size:17px; color:#333; background-image:url(/img/quick/check_off.png); background-position:left center; background-repeat:no-repeat; background-size:16px; margin-bottom:0; margin-left:5px;}
#quick_form .form_popup .formBox .agreeBox .text_view{ display:inline-block; font-size:17px; color:#333; text-decoration:underline; margin-top:10px;}
#quick_form .form_popup .submit{ display:block; width:100%; line-height:85px; font-size:28px; color:#fff; text-align:center; border-radius:0 0 10px 10px; background-color:#989898}
@keyframes bounce{
  100%{
    bottom:10px;
  }
}

#agree_text_popup{ display:none; position:fixed; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.7); z-index:1000000}
#agree_text_popup .center{ position:absolute; left:50%; top:50%; transform:translate(-50%,-50%); width:1200px; }
#agree_text_popup .xBtn{ position:absolute; top:-20px; right:-20px;}
#agree_text_popup .xBtn img{ display:block;}
#agree_text_popup .textBox{ width:100%; padding:30px 20px; box-sizing:border-box; border:3px solid #999; background-color:#eee; text-align:left;}
#agree_text_popup .textBox .title{ font-size:30px; color:#333;}
#agree_text_popup .textBox textarea{ display:block; width:100%; height:70vh; font-size:17px; color:#333; padding:10px; border:1px solid #999; border-radius:5px; box-sizing:border-box; background-color:#fff; outline:none; resize:none; line-height:1.2;}

@media (max-width:768px){
#quick_form{ bottom:30px;}
#quick_form .quick_btn{ left:20px;}
#quick_form .quick_btn img{ width:200px;}
#quick_form .form_popup{ right:20px; width:280px;}
#quick_form .form_popup .xBtn{ top:10px; right:10px;}
#quick_form .form_popup .titleBox{ padding:20px 0;}
#quick_form .form_popup .titleBox .logo{ width:100px; margin-right:15px;}
#quick_form .form_popup .titleBox .textBox .text01{ font-size:16px;}
#quick_form .form_popup .titleBox .textBox .text02{ font-size:22px;}
#quick_form .form_popup .formBox{ padding:20px 15px;}
#quick_form .form_popup .formBox .form_title{ font-size:14px; padding:15px 10px;}
#quick_form .form_popup .formBox .inputBox{ height:40px;}
#quick_form .form_popup .formBox .inputBox input{ font-size:14px; padding-left:10px;}
#quick_form .form_popup .formBox .agreeBox input{ width:16px; height:16px;}
#quick_form .form_popup .formBox .agreeBox label{ font-size:14px;}
#quick_form .form_popup .formBox .agreeBox .text_view{ font-size:14px;}
#quick_form .form_popup .submit{ line-height:60px; font-size:20px;}

#agree_text_popup .center{ width:90vw;}
#agree_text_popup .xBtn{ top:-15px; right:-15px;}
#agree_text_popup .xBtn img{ width:30px;}
#agree_text_popup .textBox{ padding:20px 15px;}
#agree_text_popup .textBox .title{ font-size:20px;}
#agree_text_popup .textBox textarea{ font-size:12px;}
}
</style>
<script>
function form_popup_open(){
	$(".form_popup").fadeIn();
}
function form_popup_close(){
	$(".form_popup").fadeOut();
}
function agree_text_open(){
	$("#agree_text_popup").fadeIn();
}
function agree_text_close(){
	$("#agree_text_popup").fadeOut();
}
</script>
<div id="quick_form">
    <form id="form_quick">
    	<a href="javascript:form_popup_open();" class="quick_btn"><img src="/img/quick/quick_btn.png"></a>
        <div class="form_popup">
        	<a href="javascript:form_popup_close();" class="xBtn"><img src="/img/quick/xBtn.png"></a>
        	<div class="titleBox">
            	<img src="/img/quick/logo.png?1" class="logo">
                <div class="textBox">
                	<div class="text01">상담 및 진료예약</div>
                	<div class="text02">1833-8838</div>
                </div>
            </div>
            <div class="formBox">
                <input type="hidden" name="mb_id" value="<?=$this->session->userdata('id')?>">
                <input type="hidden" name="wr_subject" id="wr_subject" value=""/>
                <input type="hidden" name="wr_content" value="　"/>
                <input type="hidden" name="bo_table" value="quick_kor"/>
            	<div class="form_title">어떤 상담을 원하시나요?</div>
                <div class="inputBox"><input type="text" name="wr_name" id="wr_name" placeholder="이름"></div>
                <div class="inputBox"><input type="text" name="wr_1" id="wr_1" placeholder="전화번호"></div>
                <div class="agreeBox">
                	<input type="checkbox" id="agree_text"><label for="agree_text">개인정보 취급방침에 동의합니다.</label>
                    <a href="javascript:agree_text_open();" class="text_view">개인정보 취급방침 자세히 보기</a>
                </div>
            </div>
            <a href="javascript:;" class="submit">상담신청</a>
        </div>
    </form>
</div>

<script>
$(function(){
    $('.submit').click(function(){
        if(!$('#wr_name').val()) {
            alert('이름을 입력하세요.');
            $('#wr_name').focus();
            return false;
        }
        
        if(!$('#wr_1').val()) {
            alert('전화번호를 입력하세요.');
            $('#wr_1').focus();
            return false;
        }
        
        if(!$('#agree_text').is(':checked')) {
            alert('개인정보 취급방침에 동의해 주세요.');
            $('#agree_text').focus();
            return false;
        }
        
        var wr_subject = "빠른상담 : "+$('#wr_name').val() + "님(" + $('#wr_1').val() + ")";
        
        $('#wr_subject').val(wr_subject);
        
        $.ajax({
            type : 'POST',
            url : '/board/write_process/quick_kor',
            data : $('#form_quick').serialize(),
            success : function(data){
                alert('상담신청이 완료되었습니다.');
                window.location.reload();
            }            
        });
    });
});
</script>

<div id="agree_text_popup">
	<div class="center">
        <a href="javascript:agree_text_close();" class="xBtn"><img src="/img/quick/xBtn2.png"></a>
        <div class="textBox">
        	<div class="title">개인정보 취급방침</div>
            <textarea readonly>비오페이스(이하 '본원')는 귀하의 개인정보보호를 매우 중요시하며, 『개인정보보호법』을 준수하고 있습니다.
본원은 개인정보 취급방침을 통하여 귀하께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며 개인정보 보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다.
개인정보 취급방침의 순서는 다음과 같습니다.

1. 수집하는 개인정보의 항목 및 수집방법
2. 개인정보의 수집 및 이용목적
3. 개인정보의 보유 및 이용기간
4. 개인정보의 파기절차 및 그 방법
5. 개인정보 제공 및 공유
6. 수집한 개인정보의 취급위탁
7. 이용자 및 법정대리인의 권리와 그 행사방법
8. 동의철회 / 회원탈퇴 방법
9. 개인정보 자동 수집 장치의 설치/운영 및 그 거부에 관한 사항
10. 개인정보관리책임자
11. 개인정보의 안전성 확보조치
12. 정책 변경에 따른 공지의무

1. 수집하는 개인정보의 항목 및 수집방법

본원은 회원가입 시 서비스 이용을 위해 필요한 최소한의 개인정보만을 수집합니다.
귀하가 본원의 서비스를 이용하기 위해서는 회원가입 시 필수항목과 선택항목이 있는데, 메일수신여부 등과 같은 선택 항목은 입력하지 않더라도 서비스 이용에는 제한이 없습니다.
ㄱ. [진료정보] - 수집항목 : 성명, 생년월일, 주소, 연락처, 진료기록
※ 의료법에 의해 고유식별 정보 및 진료정보를 의무적으로 보유하여야 하여야 함(별도 동의 불필요)
ㄴ. [홈페이지 회원가입 시 수집항목]
- 필수항목 : 성명, 아이디, 비밀번호, 주소, 연락처(전화번호, 휴대폰번호), 메일주소
- 선택항목 : 생일, 문자 수신 여부, 메일 수신 여부, 관심분야
- 서비스 이용 과정이나 서비스 제공 업무 처리 과정에서 다음과 같은 정보들이 자동으로 생성되어 수집될 수 있습니다. : 서비스 이용기록, 접속 로그, 쿠키, 접속 IP 정보
ㄷ. [개인정보 수집방법] - 다음과 같은 방법으로 개인정보를 수집합니다.
･ 홈페이지, 서면양식, 팩스, 전화, 상담 게시판, 이메일

2. 개인정보의 수집 및 이용목적

본원은 수집한 개인정보를 다음의 목적을 위해 활용합니다.
이용자가 제공한 모든 정보는 하기 목적에 필요한 용도 이외로는 사용되지 않으며 이용 목적이 변경될 시에는 사전 동의를 구할 것입니다.
ㄱ. [진료정보] - 진단 및 치료를 위한 진료서비스와 청구, 수납 및 환급 등의 원무서비스 제공
ㄴ. [홈페이지 회원정보]
- 필수정보 : 홈페이지를 통한 진료 예약, 예약조회 및 회원제 서비스 제공, 온라인 게시판(1:1상담/비공개상담/수술 후 상담/후기 등) 게시물 작성
- 선택정보 : 이메일을 통한 병원소식, 질병정보 등의 안내, 설문조사, 장애처리 및 개별 회원에 대한 개인 맞춤서비스, 서비스 이용에 대한 통계수집, 기타, 새로운 서비스 및 정보 안내 단, 이용자의 기본적 인권침해의 우려가 있는 민감한 개인정보는 수집하지 않습니다.
본원은 상기 범위 내에서 보다 풍부한 서비스를 제공하기 위해 이용자의 자의에 의한 추가정보를 수집합니다.

3. 개인정보의 보유 및 이용기간

본원은 개인정보의 수집목적 또는 제공받은 목적이 달성된 때에는 귀하의 개인정보를 지체 없이 파기합니다.
ㄱ. [진료정보] - 의료법에 명시된 진료기록 보관 기준에 준하여 보관
ㄴ. [홈페이지 회원정보]
- 회원가입을 탈퇴하거나 회원에서 제명된 때 다만, 수집목적 또는 제공받은 목적이 달성된 경우에도 상법 등 법령의 규정에 의하여 보존할 필요성이 있는 경우에는 귀하의 개인정보를 보유할 수 있습니다.
- 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 (전자상거래 등에서의 소비자보호에 관한 법률)
- 신용정보의 수집/처리 및 이용 등에 관한 기록 : 3년 (신용정보의 이용 및 보호에 관한 법률)
– 본인 확인에 관한 기록 : 6개월 (정보통신망 이용촉진 및 정보보호 등에 관한 법률)
– 방문에 관한 기록 : 3개월 (통신비밀보호법)

4. 개인정보의 파기절차 및 그 방법

본원은 『개인정보의 수집 및 이용목적』이 달성된 후에는 즉시 파기합니다. 파기절차 및 방법은 다음과 같습니다.
ㄱ. [파기절차] 이용자가 회원가입 등을 위해 입력한 정보는 목적이 달성된 후 파기방법에 의하여 즉시 파기합니다.
ㄴ. [파기방법] 전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.
종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각하여 파기합니다.

5. 개인정보 제공 및 공유

본원은 귀하의 동의가 있거나 관련법령의 규정에 의한 경우를 제외하고는 어떠한 경우에도 『개인정보의 수집 및 이용목적』에서 고지한 범위를 넘어 귀하의 개인정보를 이용하거나 타인 또는 타 기업ㆍ기관에 제공하지 않습니다.
- 국민건강보험법에 의해 건강보험심사평가원에 요양급여비용 청구를 위한 진료기록 제출
- 통계작성ㆍ학술연구를 위하여 필요한 경우 특정 개인을 알아볼 수 없는 형태로 가공하여 제공
- 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우 제출 등

6. 수집한 개인정보의 취급위탁

본원은 서비스 이행을 위해 아래와 같이 개인정보를 위탁하고 있으며, 관계 법령에 따라 위탁계약 시 개인정보가 안전하게 관리될 수 있도록 필요한 사항을 규정하고 있습니다.
본원의 개인정보 위탁처리 기관 및 위탁업무 내용은 아래와 같습니다.
수탁업체 : 비오페이스
위탁업무 내용 : 홈페이지 유지 관리, 접속기록, 관리, 회원관리
위탁 개인정보 항목 : 이름, 주소, 전화번호
개인정보 보유 및 이용기간: 위탁계약 종료 시까지

7. 이용자 및 법정대리인의 권리와 그 행사방법

만14세 미만 아동(이하 "아동"이라 함)의 회원가입은 아동이 이해하기 쉬운 평이한 표현으로 작성된 별도의 양식을 통해 이루어지고 있으며 개인정보 수집 시 반드시 법정대리인의 동의를 구하고 있습니다.
본원은 법정대리인의 동의를 받기 위하여 아동으로부터 법정대리인의 성명과 연락처 등 최소한의 정보를 수집하고 있으며, 개인정보취급방침에서 규정하고 있는 방법에 따라 법정대리인의 동의를 받고 있습니다.
아동의 법정대리인은 아동의 개인정보에 대한 열람, 정정 및 삭제를 요청할 수 있습니다. 아동의 개인정보를 열람•정정, 삭제하고자 할 경우에는 회원정보수정을 클릭하여 법정대리인 확인 절차를 거치신 후 아동의 개인정보를 법정대리인이 직접 열람•정정, 삭제하거나, 개인정보보호책임자로 서면, 전화, 또는 Fax등으로 연락하시면 필요한 조치를 취합니다.
본원은 아동에 관한 정보를 제3자에게 제공하거나 공유하지 않으며, 아동으로부터 수집한 개인정보에 대하여 법정대리인이 오류의 정정을 요구하는 경우 그 오류를 정정할 때까지 해당 개인정보의 이용 및 제공을 금지합니다.
※ 법에 의해 보관이 의무화된 개인정보는 요청이 있더라도 보관기간내에 수정•삭제할 수 없습니다.

8. 동의철회 / 회원탈퇴 방법

개인정보관리책임자로 서면, 전화 또는 Fax 등으로 연락하시면 지체 없이 귀하의 개인정보를 파기하는 등 필요한 조치를 하겠습니다.

9. 개인정보 자동 수집 장치의 설치/운영 및 그 거부에 관한 사항

본원은 귀하의 정보를 수시로 저장하고 찾아내는 '쿠키(cookie)'를 운용합니다. 쿠키란 본원의 웹사이트를 운영하는데 이용되는 서버가 귀하의 브라우저에 보내는 아주 작은 텍스트 파일로서 귀하의 컴퓨터 하드디스크에 저장됩니다. 본원은 다음과 같은 목적을 위해 쿠키를 사용합니다.
귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 귀하는 웹 브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.
회원님께서 쿠키 설치를 거부하셨을 경우 일부 서비스 제공에 어려움이 있습니다.

10. 개인정보관리책임자

귀하의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 본원은 아래와 같이 개인정보관리책임자를 두고 있습니다.
성 명 : 박주영
직위 : 대표원장
소 속 : 비오페이스
연락처 : 1833-8838
귀하께서는 본원의 서비스를 이용하시며 발생하는 모든 개인정보보호 관련 민원을 개인정보관리책임자로 신고하실 수 있습니다.
본원은 이용자들의 신고사항에 대해 신속하게 충분한 답변을 드릴 것입니다.
기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.
･ 개인분쟁조정위원회 (http://www.1336.or.kr / 1336)
･ 정보보호마크인증위원회 (http://www.eprivacy.or.kr / (02) 580-0533~4)
･ 대검찰청 사이버범죄수사단 (http://www.spo.go.kr / (02) 3480-3573)
･ 경찰청 사이버테러대응센터( http://www.ctrc.go.kr / (02) 392-0330)

11. 개인정보의 안전성 확보조치

본원은 이용자들의 개인정보를 취급함에 있어 개인정보가 분실, 도난, 누출, 변조 또는 훼손되지 않도록 안전성 확보를 위하여 다음과 같은 기술적/관리적 대책을 강구하고 있습니다.
ㄱ. [비밀번호 암호화] 사이트 가입 시 설정한 비밀번호는 암호화되어 저장 및 관리되고 있어 본인만이 알고 있으며, 개인정보의 확인 및 변경도 비밀번호를 알고 있는 본인에 의해서만 가능합니다. 다만 회원 본인이 이용상의 어려움 등으로 개인정보보호책임자에게 직접 변경을 요청하는 경우 서면, 전화, 팩스, 이메일 등을 통해 본인 확인 후 정보 변경이 가능합니다.
ㄴ. [해킹 등에 대비한 대책] 본원은 해킹이나 컴퓨터 바이러스 등에 의해 회원의 개인정보가 유출되거나 훼손되는 것을 막기 위해 최선을 다하고 있습니다.
개인정보의 훼손에 대비해서 자료를 수시로 백업하고 있고, 최신 백신프로그램을 이용하여 이용자들의 개인정보나 자료가 누출되거나 손상되지 않도록 방지하고 있으며, 이용자의 중요 개인정보(주민등록번호 등)를 암호화 저장하고, 암호화 통신을 통하여 네트워크상에서 개인정보를 안전하게 전송할 수 있도록 하고 있습니다. 그리고 침입차단시스템을 이용하여 외부로부터의 무단접근을 통제하고 있으며, 기타 시스템적으로 보안성을 확보하기 위해 가능한 모든 기술적 장치를 갖추려 노력하고 있습니다.
ㄷ. [개인정보 취급 직원의 최소화 및 교육] 본원의 개인정보관련 취급 직원은 담당자에 한정시키고 있으며, 이를 위한 별도의 비밀번호를 부여하여 정기적으로 갱신하고 있으며, 담당자에 대한 정기/수시 교육을 수행하고 있습니다.
단, 이용자 본인의 부주의나 인터넷상의 문제로 전화번호, 비밀번호, 주민등록번호 등 개인정보가 유출되어 발생한 문제에 대해서는 본원은 일체의 책임을 지지 않습니다.

12. 정책 변경에 따른 공지의무

이 개인정보취급방침은 아래에 명시된 날짜에 수정되었으며 법령ㆍ정책 또는 보안기술의 변경에 따라 내용의 추가ㆍ삭제 및 수정이 있을 시에는 변경되는 개인정보취급방침을 시행하기 최소 7일전에 본원 홈페이지를 통해 변경이유 및 내용 등을 공지하도록 하겠습니다.

･ 시행일자 : 2020년 07월 09일</textarea>
        </div>
    </div>
</div>