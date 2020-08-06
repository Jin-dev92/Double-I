
<?php
// nicepayWEB.setParam("CharSet", "utf-8");
header("Content-Type:text/html; charset=utf-8;");

// require("./lib/NicepayLite.php");
require $nfor[skin_path]."lib/NicepayLite2.php";


/*
*******************************************************
* <인증 결과>
*******************************************************
*/
$authResultCode          = $_REQUEST['AuthResultCode'];  // 인증결과 : 0000(성공)
$authResultMsg           = $_REQUEST['AuthResultMsg'];   // 인증결과 메시지

if($authResultCode == '0000'){
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
    $nicepay->m_BrandName2     = $_POST['BrandName2']; 
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
  $payMethod = $nicepay->m_ResultData["PayMethod"];

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
    if($resultCode == "0000") $paySuccess = true; // SSG은행계좌(정상 결과코드:0000)
  }
}else{
    $resultCode = $authResultCode;
    $resultMsg = $authResultMsg;

    ?>
  <script>
    // window.history.go(-10);
  </script>

<?
}
?>
<!-- 문자전송 -->


<!DOCTYPE html>
<html>
<head>
<title>결제완료</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi" />
<link rel="stylesheet" type="text/css" href="./css/import.css"/>
<style>
  #header { position:fixed; left:0px; right:0px; top:0px; width:100%; z-index:100; padding: 0;}
  #gnb { width:100%; height:53px; background:#2b68a7; }
  #gnb .logo { margin:0 auto; display:block; width:92px; height:49px; padding-top:7px; text-indent:-999em; background:url(/skin/m_demo/img/logo.png) no-repeat 0; background-size:92px auto; }
  #gnb a { display:block; text-decoration:none; text-align:center; font-size:12px; color:#fff; cursor:pointer; }
  #gnb i{ display:block; background:url(/skin/m_demo/img/layout.png) no-repeat 0 0; background-size:320px auto; width:25px; height:25px; margin:0 auto; }
  #gnb .btn_menu { position:absolute; left:10px; top:5px; }
  #gnb .btn_menu i { background-position:0px -100px;  }
  #gnb .btn_search { position:absolute; right:10px; top:5px; }
  #gnb .btn_search i { background-position:-50px -100px;  }
  #gnb .btn_cart { position:absolute; right:10px; top:5px; }
  #gnb .btn_cart i { background-position:-100px 0px;  }
  #gnb .btn_cart span { position:absolute; background-color:#ec1b23; right:0px; top:0px; width:17px; height:17px; line-height:17px; color:#fff; text-align:center; border-radius:10px; font-size:13px;  }

  .lnb{ white-space:nowrap; overflow-x:auto; -webkit-overflow-scrolling:touch; background-color:#fff; }
  .lnb ul{ display:table; }
  .lnb li {  display:table-cell; border-bottom:solid 1px #ececec; }
  .lnb li a{ color:#666; font-size:16px; display:block; padding:14px 10px 10px;  }
  .lnb li.active { border-bottom:solid 4px #2b68a7; }
  .lnb li.active a{ color:#000; font-weight:bold;  }
  .lnb::-webkit-scrollbar {display:none;}


  .payment_ok_btn {
    display: block;
    width: 95%;
    height: 40px;
    line-height: 40px;
    text-align: center;
    padding: 0px;
    margin: 0px;
    margin: 20px auto;
    font-size: 16px;
    font-weight: bold;
    background-color: #d32f2f;
    border: solid 1px #d32f2f;
    color: #fff;
}


  /*푸터*/
  #footer { position:fixed; left:0px; bottom:0px; width:100%; height:56px; z-index:9999; background:#fff; border-top:1px solid #ccc; padding: 30px 0px 25px 0px; }
  #footer a { display:block; float:left; width:25%; text-align:center; color:#111; font-size:13px; text-decoration:none; text-align:center; margin-top: -24px; letter-spacing: 0px;}
  #footer i{ display:block; background:url(../../skin/m_demo/img/layout.png) no-repeat 0 0; background-size:320px auto; width:25px; height:25px; margin:0 auto;}

  #footer .btn_home { background-position:0px 0px; }
  #footer .btn_category { background-position:-50px 0px; }
  #footer .btn_cart { background-position:-0px -150px; }
  #footer .btn_mypage { background-position:-150px 0px; }

  #footer .btn_home.on { background-position:0px -50px; }
  #footer .btn_category.on  { background-position:-50px -50px; }
  #footer .btn_cart.on  { background-position:-100px -50px; }
  #footer .btn_mypage.on  { background-position:-150px -50px; }
  </style>
</head>
<body onload="loadJSON()">
  <header id="header">
    <nav id="gnb">
      <a href="../../index.php" class="logo">홈으로</a>
    </nav>
  </header>

  <input type="hidden" id="goodscode" name="goodscode" value="<?=$nicepay->m_GoodsCode?>">
  <input type="hidden" id="m_Moid" name="m_Moid" value="<?=$nicepay->m_Moid?>">
  <div class="payfin_area" style="margin-top: 60px; width: 95%; margin-left: auto; margin-right: auto;">
    <div class="top" style="text-align: center;">결제완료</div>
    <div class="conwrap">
      <div class="con">
        <div class="tabletypea">
          <table>
            <colgroup><col width="30%"/><col width="*"/></colgroup>
              <!-- <tr>
                <th><span>결과 내용</span></th>
                <td>[<?=$nicepay->m_ResultData["ResultCode"]?>] <?=$nicepay->m_ResultData["ResultMsg"]?></td>
              </tr> -->
              <tr>
                <th><span>결제 수단</span></th>
                <td><?=$PayMethod ?></td>
                <input type="hidden" id="payMethod" value="<?=$PayMethod ?>">
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
                <th><span>휴대폰 번호</span></th>
                <td><?=$nicepay->m_BuyerTel?></td>
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
    </div>
  </div>
  <div class="btn_area">
    <a href="../../index.php"><input type="button" class="payment_ok_btn" value="확인"></a>
  </div>
  <footer id="footer">
    <a href="../../index.php"><i class="btn_home on"></i>홈으로</a>
    <a href="../../category.php"><i class="btn_category "></i>카테고리</a>
    <a href="../../cart.php"><i class="btn_cart "></i>장바구니</a>
    <a href="../../mypage.php"><i class="btn_mypage "></i>마이페이지</a>
  </footer>







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
         제목 : <input type="text" name="subject" value="극복 - 결제 확인 및 내원 관련 공지"><br />
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

        <textarea name="msg" cols="30" rows="10" style="width:455px;"><?php echo htmlspecialchars($nicepay->m_ResultData["GoodsName"])?> 주문완료</textarea>


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
  // 판매량, pay_step, 주문시간, 결제시간 업데이트
  var goodscode = $('#goodscode').val();
  var payMethod = $('#payMethod').val();
  var m_Moid = $('#m_Moid').val();

  $.ajax({
    type : "post"
    , url : "../../sales_volume_update.php"
    , cache : false
    , data : {
        goodscode : goodscode,
        payMethod : payMethod,
        m_Moid : m_Moid,
        od_id : '<?=$nicepay->m_Moid?>',
        mb_id : '<?=$nicepay->m_BuyerName?>',
        mb_hp : '<?=$nicepay->m_BuyerTel?>',
        supply_no : '<?=$nicepay->m_BrandName?>'
      }
  });

  if($('#sms_check').val() == 0){
    // alert('구매해주셔서 감사합니다.');

    $.ajax({
      type : "post"
      , url : "./sms_send.php"
      , cache : false
      , data : $("#smsForm").serialize()
      , success : function(response){
        var json = $.parseJSON(response);
        if(json["result"]=="ok"){

        } else{
          alert(json["msg"]);
        }
      }
    });

    document.smsForm2.rphone.value='010-2800-7184';
    $.ajax({
      type : "post"
      , url : "./sms_send.php"
      , cache : false
      , data : $("#smsForm2").serialize()
    });

      document.smsForm2.rphone.value='010-4929-0776';

      $.ajax({
        type : "post"
        , url : "./sms_send.php"
        , cache : false
        , data : $("#smsForm2").serialize()
      });

  }


});

</script>
<br><br><br>


</body>
</html>
