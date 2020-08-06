<?php

require $nfor[skin_path]."lib/NicepayLite2.php";

/*
*******************************************************
* <결제 결과 설정>
* 사용전 결과 옵션을 사용자 환경에 맞도록 변경하세요.
* 로그 디렉토리는 꼭 변경하세요.
*******************************************************
*/
$nicepay                  = new NicepayLite;
$MerchantKey              = "vpCvsKjKrK4AfosJcwarR0OcPurLhzW+dWFN2Zcj1WeaVCddj1Gnvi90C0Kwpx5O1ywg7OVldie37XQvvo4EMQ=="; // 상점키
$nicepay->m_NicepayHome   = "./log";               // 로그 디렉토리 설정
$nicepay->m_ActionType    = "PYO";                  // ActionType
$nicepay->m_charSet       = "UTF8";                 // 인코딩
$nicepay->m_ssl           = "true";                 // 보안접속 여부
$nicepay->m_Price         = $_POST['Amt'];                   // 금액
$nicepay->m_NetCancelAmt  = $_POST['Amt'];                   // 취소 금액
$nicepay->m_BrandName     = $_POST['BrandName'];                  // 병원이름
$nicepay->m_NetCancelPW   = "123456";               // 결제 취소 패스워드 설정

/*
*******************************************************
* <결제 결과 필드>
*******************************************************
*/

$nicepay->m_BuyerName     = $_POST['BuyerName'];             // 구매자명
$nicepay->m_BuyerEmail    = $_POST['BuyerEmail'];            // 구매자이메일
$nicepay->m_BuyerTel      = $_POST['BuyerTel'];              // 구매자연락처
//$nicepay->m_EncryptedData = $EncryptedData;         // 해쉬값
$nicepay->m_GoodsName     = $_POST['GoodsName'];             // 상품명
$nicepay->m_GoodsCode     = $_POST['GoodsCode'];             // 상품코드
$nicepay->m_GoodsCnt      = $_POST['GoodsCnt'];            // 상품개수
$nicepay->m_GoodsCl       = $_POST['GoodsCl'];               // 실물 or 컨텐츠
$nicepay->m_Moid          = $_POST['Moid'];                  // 주문번호
$nicepay->m_MallUserID    = $_POST['MallUserID'];            // 회원사ID
$nicepay->m_MID           = $_POST['MID'];                   // MID
$nicepay->m_MallIP        = $_POST['MallIP'];                // Mall IP
$nicepay->m_MerchantKey   = 'vpCvsKjKrK4AfosJcwarR0OcPurLhzW+dWFN2Zcj1WeaVCddj1Gnvi90C0Kwpx5O1ywg7OVldie37XQvvo4EMQ==';           // 상점키
$nicepay->m_LicenseKey    = 'vpCvsKjKrK4AfosJcwarR0OcPurLhzW+dWFN2Zcj1WeaVCddj1Gnvi90C0Kwpx5O1ywg7OVldie37XQvvo4EMQ==';           // 상점키
$nicepay->m_TransType     = $_POST['TransType'];             // 일반 or 에스크로
$nicepay->m_TrKey         = $_POST['TrKey'];                 // 거래키
$nicepay->m_PayMethod     = $_POST['PayMethod'];             // 결제수단
$nicepay->startAction();

/*
*******************************************************
* <결제 성공 여부 확인>
*******************************************************
*/
$resultCode = $nicepay->m_ResultData["ResultCode"];

$paySuccess = false;
if($PayMethod == "CARD"){
    if($resultCode == "3001") $paySuccess = true;   // 신용카드(정상 결과코드:3001)
}else if($PayMethod == "BANK"){
    if($resultCode == "4000") $paySuccess = true;   // 계좌이체(정상 결과코드:4000)
}else if($PayMethod == "CELLPHONE"){
    if($resultCode == "A000") $paySuccess = true;   // 휴대폰(정상 결과코드:A000)
}else if($PayMethod == "VBANK"){
    if($resultCode == "4100") $paySuccess = true;   // 가상계좌(정상 결과코드:4100)
}else if($payMethod == "SSG_BANK"){
    if($resultCode == "0000") $paySuccess = true;	// SSG은행계좌(정상 결과코드:0000)
}

?>

<style media="screen">

  .container{min-height: 800px; max-width: 90%;}
  .result_table{width: 500px; display: block; margin:0 auto; border: 1px solid rgba(0,0,0,0.3); }
  .result_table *{margin: 0 auto; font-weight: bold;}
  .trow{height:100px; width: 100%;}
  .t_top{padding: 15px 0; font-size: 22px; text-align: center; width: 498px;  border-bottom: 1px solid rgba(0,0,0,0.3);   background: linear-gradient(#fafafa, #e8e8ea); color: black;}

  .result_table table tr{text-align: center; border-bottom: 1px solid rgba(0,0,0,0.3);}
  .result_table table tr *{padding:25px 0px;}
  .result_table table{width: 100%;}
  .thead{font-size: 18px;opacity: 0.6; width: 175px}

  .cartimg{width: 100%;    height: 100px;    background-color: #42aeec;    margin-bottom: 20px;}
  .cartimg img{width: 100%; height:100px;}
  .confirm_btn{display: block; background-color: #D32F2E; border: 0; margin:0 auto; color: white; width: 120px; height: 26px; border-radius: 15px;  font-weight: 600; margin-top: 25px; text-align: center; line-height: 26px; text-decoration: none;}
  a:hover{color:white;}

  body {margin:0;} .wrap a {text-decoration: none; letter-spacing: 0px;} .f_tx {font-size: 13px;}


  <?include_once $nfor[skin_path].'css/style.css';?>
</style>
<?
  include_once "../../skin/demo/head2.php";
?>
<form id="infoForm">
<input type="hidden" id="goodscode" name="goodscode" value="<?=$nicepay->m_GoodsCode?>">
<input type="hidden" id="m_Moid" name="m_Moid" value="<?=$nicepay->m_Moid?>">
<div class="container">
  <div class="cartimg"><img src="/skin/demo/img/cartimg2.png"></div>
  <div class="result_table">
    <table>
      <caption class="t_top"><b>결제가 완료 되었습니다.</b></caption>
      <tr>
        <td class="thead">결제 수단</td>
        <td class="tcontent"><?=$PayMethod ?></td>
        <input type="hidden" id="payMethod" value="<?=$PayMethod ?>">
      </tr>
       <!-- <tr>
        <td class="thead">상품코드</td>
        <td class="tcontent"><?=$nicepay->m_GoodsCode?></td>
      </tr> -->
      <tr>
        <td class="thead">결제 상품명</td>
        <td class="tcontent"><?=$nicepay->m_ResultData["GoodsName"]?></td>
      </tr>
      <!-- <tr>
        <td class="thead">결제 상품개수</td>
        <td class="tcontent"><?=$nicepay->m_GoodsCnt ?></td>
      </tr> -->
      <tr>
        <td class="thead">결제 상품금액</td>
        <td class="tcontent"><?=$nicepay->m_ResultData["Amt"]?>원</td>
      </tr>
      <?php if($nicepay->m_PayMethod=="CARD"){?>
      <tr>
        <td class="thead">카드사명</td>
        <td class="thead"><?=$nicepay->m_ResultData["CardName"]?></td>
      </tr>
      <tr>
        <td class="thead">할부개월</td>
        <td class="thead"><?=$nicepay->m_ResultData["CardQuota"]?></td>
      </tr>
    <?php }else if($nicepay->m_PayMethod=="BANK"){?>
      <tr>
        <td class="thead">은행</td>
        <td class="thead"><?=$nicepay->m_ResultData["BankName"]?></td>
      </tr>
      <tr>
        <td class="thead">현금영수증 타입(0:발행안함,1:소득공제,2:지출증빙)</td>
        <td class="thead"><?=$nicepay->m_ResultData["RcptType"]?></td>
      </tr>
    <?php }else if($nicepay->m_PayMethod=="CELLPHONE"){?>
      <tr>
        <td class="thead">이통사 구분</td>
        <td class="thead"><?=$nicepay->m_ResultData["Carrier"]?></td>
      </tr>
      <tr>
        <td class="thead">휴대폰 번호</td>
        <td class="thead"><?=$nicepay->m_ResultData["DstAddr"]?></td>
      </tr>
    <?php }else if($nicepay->m_PayMethod=="VBANK"){?>
      <tr>
        <td class="thead">입금 은행</td>
        <td class="thead"><?=$nicepay->m_ResultData["VbankBankName"]?></td>
      </tr>
      <tr>
        <td class="thead">입금 계좌</td>
        <td class="thead"><?=$nicepay->m_ResultData["VbankNum"]?></td>
      </tr>
      <tr>
        <td class="thead">입금 기한</td>
        <td class="thead"><?=$nicepay->m_ResultData["VbankExpDate"]?></td>
      </tr>
    <?php }else if($nicepay->m_PayMethod=="SSG_BANK"){?>
      <tr>
        <td class="thead">은행</td>
        <td class="thead"><?=$nicepay->m_ResultData["BankName"]?></td>
      </tr>
      <tr>
        <td class="thead">현금영수증 타입 (0:발행안함,1:소득공제,2:지출증빙)</td>
        <td class="thead"><?=$nicepay->m_ResultData["RcptType"]?></td>
      </tr>
    <?php }?>
      <tr>
        <td class="thead">구매자명</td>
        <td class="tcontent"><?=$nicepay->m_BuyerName ?></td>
      </tr>
      <tr style="border-bottom:0;">
        <td class="thead">구매자 연락처</td>
        <td class="tcontent"><?=$nicepay->m_BuyerTel?></td>
      </tr>
    </table>

  </div> <!--result_table -->
  <a href="/" class="confirm_btn">확인</a>
  <!-- <a href="#"></a> -->
</div>
</form>


<!-- 문자 -->
        <script type = "text/javascript">
            function setPhoneNumber(val){
                var numList = val.split("-");
                document.smsForm.sphone1.value=numList[0];
                document.smsForm.sphone2.value=numList[1];
                if(numList[2] != undefined){
                    document.smsForm.sphone3.value=numList[2];
                }
            }
            function loadJSON(){
                var data_file = "./calljson.php";
                var http_request = new XMLHttpRequest();
                try{
                    // Opera 8.0+, Firefox, Chrome, Safari
                    http_request = new XMLHttpRequest();
                }catch (e){
                    // Internet Explorer Browsers
                    try{
                        http_request = new ActiveXObject("Msxml2.XMLHTTP");

                    }catch (e) {

                        try{
                            http_request = new ActiveXObject("Microsoft.XMLHTTP");
                        }catch (e){
                            // Eror
                            alert("지원하지 않는브라우저!");
                            return false;
                        }

                    }
                }
                http_request.onreadystatechange = function(){
                    if (http_request.readyState == 4  ){
                        // Javascript function JSON.parse to parse JSON data
                        var jsonObj = JSON.parse(http_request.responseText);
                        if(jsonObj['result'] == "Success"){
                            var aList = jsonObj['list'];
                            var selectHtml = "<select id='snd_nm' name=\"sendPhone\" onchange=\"setPhoneNumber(this.value)\">";
                            selectHtml += "<option value='' selected>발신번호를 선택해주세요</option>";
                            for(var i=0; i < aList.length; i++){
                                selectHtml += "<option value=\"" + aList[i] + "\">";
                                selectHtml += aList[i];
                                selectHtml += "</option>";
                            }
                            selectHtml += "</select>";
                            document.getElementById("sendPhoneList").innerHTML = selectHtml;
                        }
                    }
                }

                http_request.open("GET", data_file, true);
                http_request.send();
            }

        </script>

    <form method="post" id="smsForm" name="smsForm" action="./sms_send.php" target="_blank" style="display: none;">
         극복 - <input type="text" name="subject" value="극복 - 결제 확인 및 내원 관련 공지"><br />
        <br />받는 번호 <input type="text" name="rphone" value="<?=$nicepay->m_BuyerTel?>"> 예) 011-011-111 , '-' 포함해서 입력.

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
        발송타입 <span><input type="radio" name="smsType" value="L" checked>장문(SMS)</span>
        <!-- <span><input type="radio" name="smsType" value="L">장문(LMS)</span> --> <br />
        <!-- 제목 : <input type="text" name="subject" value="제목"> 장문(LMS)인 경우(한글30자이내)<br /> -->
        전송메세지
      
        <?php

        $servername = "localhost";
        $username = "viewline1";
        $password = "doubleii1!";
        $dbname = "viewline1";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, 'utf8');

        //Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } 

        ?>

        <? 
        $brand_no = $nicepay->m_BrandName;
        $od_id = $nicepay->m_Moid;
        $brand_sql = "select * from nfor_member where mb_no='$brand_no'";
        $brand_result = $conn->query($brand_sql);
        $sms_check = $conn->query("select count(*) as cnt from nfor_sms_ck where od_id = '$od_id'");

        // 공급업체 이름 확인 
        if($row = $brand_result->fetch_assoc()) {
          $brand_name = $row["supply_name"];
          $brand_tel = $row["mb_tel"];
          $brnad_addr = $row["mb_addr1"] . ' ' . $row["mb_addr2"];
        }

        if($row2 = $sms_check->fetch_assoc()) {
          $sms_ck_result = $row2["cnt"];
        }
        

        ?>
        <input type="hidden" id="sms_check" value="<?=$sms_ck_result?>">

         <textarea name="msg" cols="30" rows="10" style="width:455px;">
비용 : <?php echo htmlspecialchars($nicepay->m_ResultData["Amt"].'원')?>&#13;
상품명 : <?php echo htmlspecialchars($nicepay->m_ResultData["GoodsName"])?>&#13;
상품코드 : <?php echo htmlspecialchars($nicepay->m_Moid)?>&#13;
병원이름 : <?php echo htmlspecialchars($brand_name)?>&#13;
주소 : <?php echo htmlspecialchars($brnad_addr)?>&#13;
전화번호 : <?php echo htmlspecialchars($brand_tel)?></textarea>
        <?mysqli_close($conn);?>

    </form>

    <form method="post" id="smsForm2" name="smsForm2" action="./sms_send.php" target="_blank" style="display: none;">
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

        <textarea name="msg" cols="30" rows="10" style="width:455px;"><?php echo htmlspecialchars($nicepay->m_ResultData["GoodsName"])?> 결제확인 메시지</textarea>


    </form>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
$( document ).ready(function() {
  document.smsForm.sphone1.value='070';
  document.smsForm.sphone2.value='7618';
  document.smsForm.sphone3.value='2199';

  document.smsForm2.sphone1.value='070';
  document.smsForm2.sphone2.value='7618';
  document.smsForm2.sphone3.value='2199';

  var goodscode = $('#goodscode').val();
  var payMethod = $('#payMethod').val();
  var m_Moid = $('#m_Moid').val();

  // 주문개수, 주문시간, 결제시간, paystep update
  // nfor_sms_ck 테이블 업데이트
  $.ajax({
    type : "post"
    , url : "../../sales_volume_update.php"
    , cache : false
    , data : {
      goodscode : goodscode,
      payMethod : payMethod,
      m_Moid : m_Moid,
      VbankExpDate : '<?=$nicepay->m_ResultData["VbankExpDate"]?>',
      od_id : '<?=$nicepay->m_Moid?>',
      mb_id : '<?=$nicepay->m_BuyerName?>',
      mb_hp : '<?=$nicepay->m_BuyerTel?>',
      supply_no : '<?=$nicepay->m_BrandName?>'
    }
  });

  
  // if($('#sms_check').val() == 0){
  //     $.ajax({
  //       type : "post"
  //       , url : "./sms_send.php"
  //       , cache : false
  //       , data : $("#smsForm").serialize()
  //     });

  //    document.smsForm2.rphone.value='010-2800-7184';
  //     $.ajax({
  //       type : "post"
  //       , url : "./sms_send.php"
  //       , cache : false
  //       , data : $("#smsForm2").serialize()
  //     });

  //     document.smsForm2.rphone.value='010-4929-0776';

  //     $.ajax({
  //       type : "post"
  //       , url : "./sms_send.php"
  //       , cache : false
  //       , data : $("#smsForm2").serialize()
  //     });
  // }


});



</script>
<br><br><br>
<!-- container -->

  <!-- <div class="payfin_area">
    <div class="conwrap">
      <div class="con">
        <div class="tabletypea">
          <table>
            <colgroup><col width="30%"/><col width="*"/></colgroup>
              <tr>
                <th><span>결과 내용</span></th>
                <td>[<?=$nicepay->m_ResultData["ResultCode"]?>] <?=$nicepay->m_ResultData["ResultMsg"]?></td>
              </tr>
              <tr>
                <th><span>결제 수단</span></th>
                <td><?=$PayMethod ?></td>
              </tr>
              <tr>
                <th><span>상품명</span></th>
                <td><?=$nicepay->m_ResultData["GoodsName"]?></td>
              </tr>
              <tr>
                <th><span>금액</span></th>
                <td><?=$nicepay->m_ResultData["Amt"]?>원</td>
              </tr>
              <tr>
                <th><span>거래아이디</span></th>
                <td><?=$nicepay->m_ResultData["TID"]?></td>
              </tr>
            <?php if($payMethod=="CARD"){?>
              <tr>
                <th><span>카드사명</span></th>
                <td><?=$nicepay->m_ResultData["CardName"]?></td>
              </tr>
              <tr>
                <th><span>할부개월</span></th>
                <td><?=$nicepay->m_ResultData["CardQuota"]?></td>
              </tr>
            <?php }else if($payMethod=="BANK"){?>
              <tr>
                <th><span>은행</span></th>
                <td><?=$nicepay->m_ResultData["BankName"]?></td>
              </tr>
              <tr>
                <th><span>현금영수증 타입(0:발행안함,1:소득공제,2:지출증빙)</span></th>
                <td><?=$nicepay->m_ResultData["RcptType"]?></td>
              </tr>
            <?php }else if($payMethod=="CELLPHONE"){?>
              <tr>
                <th><span>이통사 구분</span></th>
                <td><?=$nicepay->m_ResultData["Carrier"]?></td>
              </tr>
              <tr>
                <th><span>휴대폰 번호</span></th>
                <td><?=$nicepay->m_ResultData["DstAddr"]?></td>
              </tr>
            <?php }else if($payMethod=="VBANK"){?>
              <tr>
                <th><span>입금 은행</span></th>
                <td><?=$nicepay->m_ResultData["VbankBankName"]?></td>
              </tr>
              <tr>
                <th><span>입금 계좌</span></th>
                <td><?=$nicepay->m_ResultData["VbankNum"]?></td>
              </tr>
              <tr>
                <th><span>입금 기한</span></th>
                <td><?=$nicepay->m_ResultData["VbankExpDate"]?></td>
              </tr>
            <?php }else if($payMethod=="SSG_BANK"){?>
              <tr>
                <th><span>은행</span></th>
                <td><?=$nicepay->m_ResultData["BankName"]?></td>
              </tr>
              <tr>
                <th><span>현금영수증 타입 (0:발행안함,1:소득공제,2:지출증빙)</span></th>
                <td><?=$nicepay->m_ResultData["RcptType"]?></td>
              </tr>
            <?php }?>
          </table>
        </div>
      </div>
      <p>*테스트 아이디인경우 당일 오후 11시 30분에 취소됩니다.</p>
    </div>
  </div> -->
<?

include_once $nfor[skin_path]."tail2.php";

?>