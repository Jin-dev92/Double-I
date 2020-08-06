<style media="screen">
  .full{width: 100%;position: relative;padding-top: 170px;}
  .full img{width: 100%;}
  .top_form{position: fixed; width: 100%; height: 140px; top:0;left:0;background: #1C1C1C;z-index: 999;}
  .top_form2{position: fixed; width: 100%; height: 50px; top:140px;left:0;background: #3D3D3D;z-index: 9;}
  .s12,.validate{color: #fff!important}
  label{color: #fff!important}
  form img{width: 100%;}
  .content{color: #fff!important}
  .can_date{color: #fff!important}
  .phone1{color: #fff!important}
  .submitBtn{ color: #000; background-color: #aa0010 !important; padding: 0px 20px; }
  input, select{height: 32px!important}
  .trigger_wrap{position: absolute;top:-30px;left: 0; height: 30px;width: 100%;background:#383428; }
  .in_trigger{display: block;margin: 0 auto;}
  .real_trigger{width: 100%;position: absolute;top:-15px;}
  .trigger_wrap p{text-align: center;color: #fff;font-weight: bold;margin-top: 3px;font-size: 14px;}
  .tabs { width: 30%; background: none; box-shadow: none;}
  .tabs .tab a { color: #fff;}
  .tabs .tab a:hover, .tabs .tab a:active, .tabs .tab a:focus { font-weight: bold; color: #fff;}
  .tabs .tab a:active {font-weight: bold; color: #fff !important;}
  .tabs .indicator { background-color: #fff;}
  .agree_wrap { padding: 0 !important;}
  .agree_wrap h5 { padding: 25px 0; color:#fff; text-align: right;}
  .agree_ck { color: #000; padding: 5px 10px; background: #fff;}
  .realtime_call { color: #fff; padding: 30px 0 !important;}
  .realtime_call h5 span{ font-size: 1.5em; line-height: 40px;}
  .quick_btn { position: fixed; bottom: 20px; right: 10px; width: 110px; z-index: 9;}
  .quick_btn img { width: 100%; cursor: pointer;}
  .modal { width: 35%;}
  @media (min-width:601px) {
    .hidden-m{display: none;}

  }
  @media (max-width:600px) {
    .agree_ck { padding: 5px 3px;}
    .top_form2 { top: 0}
    .hidden-s{display: none;}
    .full{padding-top: 0;}
    .top_form{height: 250px; top:auto; bottom: -250px;}
    .tabs { width: 80%;}
    .agree_wrap h5 { padding: 0; text-align: left;}
    .agree_wrap h5 a { padding: 5px; margin-left: 10px;}
    .realtime_call h5 {text-align: center;}
    .quick_btn { bottom: 40px; width: 70px;}
    .modal_m { top: 25% !important;}
    .modal { width: 80%;}
    .tabs .indicator { width: 50%; margin: 0;}
    /*.submitBtn{height: 150px; padding: 55px 0;}*/
  }
</style>

<div class="top_form">
  <div class="trigger_wrap">
    <div class="real_trigger">
      <img src="../assets/img/trigger.png" class="in_trigger">
    </div>
    <p>상담신청하기</p>
  </div>
  <div class="container" style="width: 90%;">
    <form class="" method="post">
      <input type="hidden" name="approach" class="approach" value="<?=$_GET['approach']?>">
      <div class="row">
        <div class="col m3 s4 hidden-s realtime_call">
          <h5>실시간 상담전화<br><span><b>02.1833.8838</b></span></h5>
        </div>
        <div class="col m3 s4 hidden-m realtime_call" style="padding: 50px 0;">
         <h5>실시간<br>상담전화<br><span><b>02.<br>1833.<br>8838</b></span></h5>
        </div>
        <div class="col m3 hidden-s">
          <div class="row" style="text-align: right;">
            <img src="../assets/img/db_logo.png" alt="" style="padding-top:50px; width: 60%;">
          </div>
        </div>
        <div class="col m2 s8 agree_wrap">
            <h5>
              <span class="hidden-s">수술비용문의<br></span>
              
            </h5>
        </div>
        <div class="col m4 s8">
          <div class="input-field col m6 s12">
              <input type="text" class="validate name" id="name" name="name" value="">
              <label for="name">이름</label>
          </div>
          <div class="input-field col m6 s12">
              <input type="text" class="validate phone1" id="phone1" name="phone1" value="" data-length="11">
              <label for="phone1">연락처</label>
          </div>

          <div class="input-field col m12 center" style="margin: 0;">
            <div class="col m6">
              <input type="checkbox" name="agree" id="agree" class="agree" style="opacity: 1;">
              <label for="agree">개인정보수집동의<span class="hidden-s"><br></span><a href="#modal1" class="modal-trigger agree_ck">정보보기</a>
              </label>
            </div>
            <div class="col m6">
              <a href="#" class="btn submitBtn" style="color: #fff;">보내기</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

</div>
<!-- Modal Structure -->
    <div id="modal1" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h5>개인정보취급방침</h5>
              <p> - 비오페이스 및 제휴사이트 서비스를 위한 회원 가입 및 이용아이디 발급
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
