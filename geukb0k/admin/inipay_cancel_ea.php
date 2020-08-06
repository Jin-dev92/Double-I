<?php
include_once "path.php";
ini_set('memory_limit', -1);

$qstr .= "&od_sdate=$od_sdate&od_edate=$od_edate&date_type=$date_type";

$delivery_chk = sql_fetch("select * from nfor_cart where ct_id='$ct_id' and (delivery_step='2' or delivery_step='3')");
if($delivery_chk[cart_id]){
	alert("배송된 상품이 존재하여 취소가 불가능합니다\\n반품 처리후 진행해주세요");
}

$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");

$price = return_price($ct[ct_id])-return_money_coupon($ct[ct_id]); // 취소 요청 금액

$pg_cancel_price_s = sql_fetch("select sum(pg_cancel_price) as pg_cancel_price_s from nfor_cart where cart_id='$order[cart_id]'");
$confirm_price = $order[pg_price] - $pg_cancel_price_s[pg_cancel_price_s];	// 남은 PG 취소금액(취소가능금액)

if(!$price){
	goto_url("order_cart_cancelrequest_list.php?mode=cancel&ct_id=$ct[ct_id]".$qstr);
}

if($order[payment_type]=="vbanking"){

	if($order[mb_no]){ // 회원
		$mb = member("mb_no",$order[mb_no]);		
		$refundbankcode = trim($mb[mb_bank_name]);
		$refundacctnum = str_number(trim($mb[mb_bank_account]));
		$refundacctname = trim($mb[mb_name]);
	}

	if(!$refundbankcode){ // 비회원
		$refundbankcode = trim($order[od_refund_bank]); // 환불계좌은행코드
		$refundacctnum = str_number(trim($order[od_refund_account])); // 환불계좌번호(숫자만입력)
		$refundacctname = trim($order[od_refund_name]); // 환불계좌주명	
	}
	
	if(!$refundbankcode or !$refundacctnum or !$refundacctname){
		alert("환불계좌가 설정되지 않았습니다\n주문 상세페이지이동후 환불계좌를 등록해주세요");
	}

}

$oldtid = $tid;	// 취소할 원거래 아이디
$price = $price;	// 취소금액
$confirm_price = $confirm_price-$price;	// 승인요청금액(최종남게되는결제금액)
$buyeremail = $order[mb_email];

/* INIrepay.php
 *
 * 이미 정상 승인된 거래에서 취소를 원하는 금액을 입력하여 다시 승인을 득하도록 요청한다.
 * 
 * [주의] 부분취소 요청 때마다  새 거래아이디가 반환되나, 부분취소 요청은 반드시 원거래 TID로 가능함에 유의
 * [주의] 원거래가 신용카드 지불인 경우에만 가능
 * (OK 캐쉬백 적립 등이 포함되어 있어도 불가)
 * [주의] 반드시 취소할 금액을 입력하도록 함
 * 
 * Date : 2004/11
 * Author : ts@inicis.com
 * Project : INIpay for Unix
 * 
 * http://www.inicis.com
 * Copyright (C) 2004 Inicis, Co. All rights reserved.
 */

/**************************
 * 1. 라이브러리 인클루드 *
 **************************/
require($nfor[pg_path]."/libs/INILib.php");


/***************************************
 * 2. INIpay41 클래스의 인스턴스 생성 *
 ***************************************/
$inipay = new INIpay50;

	
/***********************
 * 3. 재승인 정보 설정 *
 ***********************/
$inipay->SetField("inipayhome", $nfor[pg_path]);  // 이니페이 홈디렉터리(상점수정 필요)

if($order[payment_type]=="vbanking"){
	$inipay->SetField("type", "vacctrepay");      							// 고정 (절대 수정 불가)
	$inipay->SetField("refundbankcode", $refundbankcode);				// 가상계좌 부분환불 계좌 은행코드
	$inipay->SetField("refundflgremit", $refundflgremit);				// 가상계좌 부분환불 송금 처리 여부 (1: 송금환불사용)
	$inipay->SetField("refundacctnum", $refundacctnum);					// 부분취소 환불계좌번호
	$inipay->SetField("refundacctname", $refundacctname);				// 부분취소 환불계좌주명
} else{
	$inipay->SetField("type", "repay");                             // 고정 (절대 수정 불가)
	$inipay->SetField("no_acct",$no_acct); //국민은행 부분취소 환불계좌번호
	$inipay->SetField("nm_acct",$nm_acct); //국민은행 부분취소 환불계좌주명
}


$inipay->SetField("pgid", "INIphpRPAY");                        // 고정 (절대 수정 불가)
$inipay->SetField("subpgip","203.238.3.10");                    // 고정
$inipay->SetField("debug", "true");                             // 로그모드("true"로 설정하면 상세로그가 생성됨.)
$inipay->SetField("mid", $order[pg_id]);                                 // 상점아이디
$inipay->SetField("admin", "1111");                             //비대칭 사용키 키패스워드
$inipay->SetField("oldtid", $oldtid);                           // 취소할 거래의 거래아이디
$inipay->SetField("currency", $currency);                       // 화폐단위
$inipay->SetField("price", $price);                             //취소금액
$inipay->SetField("confirm_price", $confirm_price);             //승인요청금액
$inipay->SetField("buyeremail",$buyeremail);                    // 구매자 이메일 주소






/******************
 * 4. 재승인 요청 *
 ******************/
$inipay->startAction();

/*********************************************************************
 * 5. 재승인 결과                                                    *
 *                                                                   *
 * 신거래번호 : $inipay->getResult('TID')                            *
 * 결과코드 : $inipay->getResult('ResultCode') ("00"이면 재승인 성공)*
 * 결과내용 : $inipay->getResult('ResultMsg') (결과에 대한 설명)     *
 * 원거래 번호 : $inipay->getResult('PRTC_TID')                      *
 * 최종결제 금액 : $inipay->getResult('PRTC_Remains')                *
 * 부분취소 금액 : $inipay->getResult('PRTC_Price')                  *
 * 부분취소,재승인 구분값 : $inipay->getResult('PRTC_Type')          *
 *                          ("0" : 재승인, "1" : 부분취소)           *
 * 부분취소 요청횟수 : $inipay->getResult('PRTC_Cnt')                *
 *********************************************************************/

if($inipay->getResult('ResultCode')=="00"){

	$cancel_price = return_price($ct_id);
	$pg_cancel_price = $inipay->getResult('PRTC_Price');

	sql_query("update nfor_cart set pay_step='3', od_canceldatetime=NOW(), pg_cancel_price='$pg_cancel_price', cancel_price='$cancel_price' where ct_id='$ct_id'");
	$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
	$total_ct1 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]'");
	$total_ct2 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and pay_step='3'");
	if($total_ct1[cnt]==$total_ct2[cnt]){
		sql_query("update nfor_order set pay_step='3', od_canceldatetime=NOW() where cart_id='$ct[cart_id]'");
	}

	$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");

	$total_ct3 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and it_id='$ct[it_id]'");
	$total_ct4 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and it_id='$ct[it_id]' and pay_step='3'");
	if($total_ct3[cnt]==$total_ct4[cnt]){
		coupon_again($order[od_id],$ct[it_id]);
	}

	sql_query("update nfor_cart set my_cancel_price='".return_money_coupon($ct[ct_id])."' where ct_id='$ct[ct_id]'");
	insert_money($order[mb_no],return_money_coupon($ct[ct_id]),"적립금 상품구매 부분취소","8",$order[od_id],$ct[ct_id]);

	$cancel_price = $order[cancel_price]+return_price($ct_id);	// 취소된금액 + 지금취소되는금액
	sql_query("update nfor_order set cancel_price='$cancel_price' where cart_id='$ct[cart_id]'");

	alert("주문취소 처리되었습니다","order_cart_cancelrequest_list.php?$qstr");
	exit;
} else{
	alert("주문취소에 실패하였습니다".$inipay->getResult('ResultCode')."|".iconv("euc-kr","utf-8",$inipay->getResult('ResultMsg')));
	exit;
}


?>
<html>
<head>
<title>INIpay50 부분취소 데모</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="css/group.css" type="text/css">
<style>
body, tr, td {font-size:10pt; font-family:굴림,verdana; color:#433F37; line-height:19px;}
table, img {border:none}

/* Padding ******/ 
.pl_01 {padding:1 10 0 10; line-height:19px;}
.pl_03 {font-size:20pt; font-family:굴림,verdana; color:#FFFFFF; line-height:29px;}

/* Link ******/ 
.a:link  {font-size:9pt; color:#333333; text-decoration:none}
.a:visited { font-size:9pt; color:#333333; text-decoration:none}
.a:hover  {font-size:9pt; color:#0174CD; text-decoration:underline}

.txt_03a:link  {font-size: 8pt;line-height:18px;color:#333333; text-decoration:none}
.txt_03a:visited {font-size: 8pt;line-height:18px;color:#333333; text-decoration:none}
.txt_03a:hover  {font-size: 8pt;line-height:18px;color:#EC5900; text-decoration:underline}
</style>

<script>
	var openwin=window.open("childwin.html","childwin","width=299,height=149");
	openwin.close();
	
</script>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>
<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=15 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0><center> 
<table width="632" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="85" background=<?php if($inipay->GetResult('ResultCode') == "01"){
					echo "img/spool_top.gif";
				  }
				  else{
				        echo "img/card.gif";
				 }

					
    				?> style="padding:0 0 0 64">
    				
 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="3%" valign="top"><img src="img/title_01.gif" width="8" height="27" vspace="5"></td>
          <td width="97%" height="40" class="pl_03"><font color="#FFFFFF"><b>부분취소 결과</b></font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td align="center" bgcolor="6095BC">
      <table width="620" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#FFFFFF" style="padding:0 0 0 56">
		  <table width="510" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="7"><img src="img/life.gif" width="7" height="30"></td>
                <td background="img/center.gif"><img src="img/icon03.gif" width="12" height="10">
                 <b><?php if($inipay->GetResult('ResultCode') == "00"){ echo "고객님의 부분취소 요청이 성공되었습니다."; }
                           else{ echo "고객님의 부분취소 요청이 실패되었습니다."; } ?> </b></td>
                <td width="8"><img src="img/right.gif" width="8" height="30"></td>
              </tr>
            </table>
            <br>
            <table width="510" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="407"  style="padding:0 0 0 9"><img src="img/icon.gif" width="10" height="11"> 
                  <strong><font color="433F37">결 제 내 역</font></strong></td>
                <td width="103">&nbsp;</td>                
              </tr>
              <tr> 
                <td colspan="2"  style="padding:0 0 0 23">
		  <table width="470" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="18" align="center"><img src="img/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="26">결 과 코 드</td>
                      <td width="343"><?php echo($inipay->getResult('ResultCode')); ?></td>
                    </tr>
                
                <!-------------------------------------------------------------------------------------------------------
                 * 1. $inipay->getResult('ResultMsg') 										*
                 *    - 결과 내용을 보여 준다 실패시에는 "[에러코드] 실패 메세지" 형태로 보여 준다.                     *
                 *		예> [9121]서명확인오류									*
                 -------------------------------------------------------------------------------------------------------->
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="25">결 과 내 용</td>
                      <td width="343"><?php echo($inipay->getResult('ResultMsg')); ?></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/line.gif"></td>
                    </tr>
                    
                <!-------------------------------------------------------------------------------------------------------
                 * 1. $inipay->getResult('TID')											*
                 *    - 이니시스가 부여한 거래 번호 -모든 거래를 구분할 수 있는 키가 되는 값			        *
                 -------------------------------------------------------------------------------------------------------->
                    <tr> 
                      <td width="18" align="center"><img src="img/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="25">원거래 번호</td>
                      <td width="343"><?php echo($inipay->getResult('PRTC_TID')); ?></td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' align='center'  background='img/line.gif'></td>
                    </tr>
                    <tr> 
                      <td width="18" align="center"><img src="img/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="25">거 래 번 호</td>
                      <td width="343"><?php echo($inipay->getResult('TID')); ?></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width='18' align='center'><img src='img/icon02.gif' width='7' height='7'></td>
                      <td width='109' height='25'>최종결제금액 </td>
                      <td width='343'><?php echo($inipay->getResult('PRTC_Remains')); ?></td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' align='center'  background='img/line.gif'></td>
                    </tr>
                    <tr> 
                      <td width='18' align='center'><img src='img/icon02.gif' width='7' height='7'></td>
                      <td width='109' height='25'>취 소 금 액</td>
                      <td width='343'><?php echo($inipay->getResult('PRTC_Price')); ?></td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' align='center'  background='img/line.gif'></td>
                    </tr>
                    <tr> 
                      <td width='18' align='center'><img src='img/icon02.gif' width='7' height='7'></td>
                      <td width='109' height='25'>부분취소(재승인) 구분 </td>
                      <td width='343'><b><font color=blue>(<?php
                      					if($inipay->getResult('PRTC_Type') == "0"){
                      						echo "재승인";
                      					}
                      					else{
                      						echo "부분취소";
                      					} 
                      					?>)</font></b></td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' align='center'  background='img/line.gif'></td>
                    </tr>
                    <tr> 
                      <td width='18' align='center'><img src='img/icon02.gif' width='7' height='7'></td>
                      <td width='109' height='25'>부분취소 요청 횟수 </td>
                      <td width='343'><?php echo($inipay->getResult('PRTC_Cnt')); ?></td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' align='center'  background='img/line.gif'></td>
                    </tr>
                   </table></td>
              </tr>
            </table>
            <br>
	    <table width='510' border='0' cellspacing='0' cellpadding='0'>
               <tr> 
                   <td height='25'  style='padding:0 0 0 9'><img src='img/icon.gif' width='10' height='11'> 
                     <strong><font color='433F37'>이용안내</font></strong></td>
                 </tr>
                 <tr> 
                   <td  style='padding:0 0 0 23'> 
                     <table width='470' border='0' cellspacing='0' cellpadding='0'>
                       <tr>          					          
                         <td height='25'>(1)카드 세이브 결제건 외에는 부분취소가 가능합니다. <br>
                         (2)국민, BC, 신한, 외환, 삼성, 현대, 롯데 카드사 부분취소 가능합니다. <br>
                         (3)부분취소 최대금액과 가능횟수은 각 카드사마다 다를수 있습니다. </td>
                       </tr>
                       <tr> 
                         <td height='1' colspan='2' align='center'  background='img/line.gif'></td>
                       </tr>
                       
                     </table></td>
                 </tr>
            </table>
            
          </td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td><img src="img/bottom01.gif" width="632" height="13"></td>
  </tr>
</table>
</center></body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
