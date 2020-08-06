<?php
require("./lib/NicepayLite.php");

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
include_once "./head.php";
?>

<style media="screen">
  .container{min-height: 800px; max-width: 90%;}
  .result_table{width: 500px; display: block; margin:0 auto; border: 1px solid rgba(0,0,0,0.3); }
  .result_table *{margin: 0 auto; font-weight: bold;}
  .trow{height:100px; width: 100%;}
  .t_top{height:60px; font-size: 22px; text-align: center; width: 498px;  border-bottom: 1px solid rgba(0,0,0,0.3);   background: linear-gradient(#fafafa, #e8e8ea); color: black;}

  .result_table table tr{text-align: center; border-bottom: 1px solid rgba(0,0,0,0.3);}
  .result_table table tr *{padding:25px 0px;}
  .result_table table{width: 100%;}
  .thead{font-size: 18px;opacity: 0.6; width: 175px}

  .cartimg{width: 100%;    height: 100px;    background-color: #42aeec;    margin-bottom: 20px;}
  .cartimg img{width: 100%; height:100px;}
  .confirm_btn{display: block; background-color: #D32F2E; border: 0; margin:0 auto; color: white; width: 120px; height: 26px; border-radius: 15px;  font-weight: 600; margin-top: 25px; text-align: center; line-height: 26px;}
  a:hover{color:white;}
</style>

<div class="container">
  <div class="cartimg"><img src="/skin/demo/img/cartimg2.png"></div>
  <div class="result_table">
    <table>
      <caption class="t_top"><b>결제가 완료 되었습니다.</b></caption>
      <tr>
        <td class="thead">결제 수단</td>
        <td class="tcontent"><?=$PayMethod ?></td>
      </tr>
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
      <tr>
        <td class="thead">구매자명</td>
        <td class="tcontent"><?=$nicepay->m_BuyerName ?></td>
      </tr>
      <tr style="border-bottom:0;">
        <td class="thead">구매자 연락처</td>
        <td class="tcontent"><?=$nicepay->m_ResultData["DstAddr"]?></td>
      </tr>
    </table>

  </div> <!--result_table -->
  <a href="/" class="confirm_btn">확인</a>
  <!-- <a href="#"></a> -->
</div>

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
include_once $nfor[skin_path]."tail.php";
?>