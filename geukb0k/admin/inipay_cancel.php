<?php
include_once "path.php";
ini_set('memory_limit', -1);

$qstr .= "&od_sdate=$od_sdate&od_edate=$od_edate&date_type=$date_type";

$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
$delivery_chk = sql_fetch("select * from nfor_cart where cart_id='$order[cart_id]' and (delivery_step='2' or delivery_step='3')");
if($delivery_chk[cart_id]){
	alert("배송된 상품이 존재하여 취소가 불가능합니다\\n반품 처리후 진행해주세요");
}

$cancel_chk = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and pay_step='3'");
if($cancel_chk[cnt]){
	alert("이미 부분취소된 상품이 존재하여 취소가 불가능합니다\\n개별주문관리를 통해서 취소를 진행해주세요");
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

/* INIcancel.php
*
* 이미 승인된 지불을 취소한다.
* 은행계좌 이체 , 무통장입금은 이 모듈을 통해 취소 불가능.
*  [은행계좌이체는 상점정산 조회페이지 (https://iniweb.inicis.com)를 통해 취소 환불 가능하며, 무통장입금은 취소 기능이 없습니다.]  
*  
* Project : INIpay V5.0 for PHP
* 
*/

$msg = "관리자임의취소";

/**************************
 * 1. 라이브러리 인클루드 *
 **************************/
require($nfor[pg_path]."/libs/INILib.php");

/***************************************
 * 2. INIpay41 클래스의 인스턴스 생성 *
 ***************************************/
$inipay = new INIpay50;

/*********************
 * 3. 취소 정보 설정 *
 *********************/
	$inipay->SetField("inipayhome", $nfor[pg_path]); // 이니페이 홈디렉터리(상점수정 필요)
	$inipay->SetField("debug", "true");        // 로그모드("true"로 설정하면 상세로그가 생성됨.)
	$inipay->SetField("mid", $order[pg_id]);                                 // 상점아이디
	$inipay->SetField("tid", $tid);                                 // 취소할 거래의 거래아이디
	$inipay->SetField("admin", "1111");                            
	$inipay->SetField("cancelmsg", $msg);                           // 취소사유


if($order[payment_type]=="vbanking"){ // 가상계좌 취소일경우
	$inipay->SetField("type", "refund"); // 고정 (절대 수정 불가)
	$inipay->SetField("pgn", $pgn);
	$inipay->SetField("racctnum", $refundacctnum); // 환불계좌번호(숫자만입력)    
	$inipay->SetField("rbankcode", $refundbankcode); // 환불계좌은행코드
	$inipay->SetField("racctname", $refundacctname); // 환불계좌주명
} else{
	$inipay->SetField("type", "cancel"); // 고정 (절대 수정 불가)
}



if($code != ""){
	$inipay->SetField("cancelcode", $code);			//취소사유코드
}
/****************
 * 4. 취소 요청 *
 ****************/
$inipay->startAction();


if($inipay->getResult('ResultCode')=="00"){
	
	sql_query("update nfor_order set pay_step='3', od_canceldatetime=NOW(), cancel_price=total_price where od_id='$order[od_id]'");
	sql_query("update nfor_cart set pay_step='3', od_canceldatetime=NOW() where cart_id='$order[cart_id]' and pay_step='2'");
	
	coupon_again($order[od_id]);

	if($order[money_price]){
		insert_money($order[mb_no],$order[money_price],"적립금 상품구매 취소","7",$order[od_id]);
	}

	nfor_send("cancel",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
	
	alert("주문취소 처리되었습니다","order_cancelrequest_list.php?$qstr");
} else{
	$msg = iconv("euc-kr","utf-8",$inipay->getResult('ResultMsg'));
	alert("다음사유로실패하였습니다".$msg,"order_cancelrequest_list.php?$qstr");
}
	

	
/****************************************************************
 * 5. 취소 결과                                           	*
 *                                                        	*
 * 결과코드 : $inipay->getResult('ResultCode') ("00"이면 취소 성공)  	*
 * 결과내용 : $inipay->getResult('ResultMsg') (취소결과에 대한 설명) 	*
 * 취소날짜 : $inipay->getResult('CancelDate') (YYYYMMDD)          	*
 * 취소시각 : $inipay->getResult('CancelTime') (HHMMSS)            	*
 * 현금영수증 취소 승인번호 : $inipay->getResult('CSHR_CancelNum')    *
 * (현금영수증 발급 취소시에만 리턴됨)                          * 
 ****************************************************************/
?>
<html>
<head>
<title>INIpayTX50 취소요청 페이지 샘플</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="css/group.css" type="text/css">
<style>
body, tr, td {font-size:9pt; font-family:굴림,verdana; color:#433F37; line-height:19px;}
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
    <td height="83" background="<?php 
    					// 지불수단에 따라 상단 이미지가 변경 된다
    					
    				if($inipay->getResult('ResultCode') == "01"){
					echo "img/spool_top.gif";
				}
				else{
					echo "img/cancle_top.gif";
				}
				
				?>"style="padding:0 0 0 64">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="3%" valign="top"><img src="img/title_01.gif" width="8" height="27" vspace="5"></td>
          <td width="97%" height="40" class="pl_03"><font color="#FFFFFF"><b>취소결과</b></font></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td align="center" bgcolor="6095BC"><table width="620" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#FFFFFF" style="padding:0 0 0 56">
		  <table width="510" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="7"><img src="img/life.gif" width="7" height="30"></td>
                <td background="img/center.gif"><img src="img/icon03.gif" width="12" height="10"> 
                  <b>고객님께서 이니페이를 통해 취소하신 내용입니다. </b></td>
                <td width="8"><img src="img/right.gif" width="8" height="30"></td>
              </tr>
            </table>
            <br>
            <table width="510" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="407"  style="padding:0 0 0 9"><img src="img/icon.gif" width="10" height="11"> 
                  <strong><font color="433F37">취소내역</font></strong></td>
                <td width="103">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="2"  style="padding:0 0 0 23">
		  <table width="470" border="0" cellspacing="0" cellpadding="0">
                    
                    <tr> 
                      <td width="18" align="center"><img src="img/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="26">결 과 코 드</td>
                      <td width="343"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td><?php echo($inipay->getResult('ResultCode')); ?></td>
                            <td width='142' align='right'>&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
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
                    <tr> 
                      <td width="18" align="center"><img src="img/icon02.gif" width="7" height="7"></td>
                      <td width="109" height="25">거 래 번 호</td>
                      <td width="343"><?php echo($tid); ?></td>
                    </tr>
                    <tr> 
                      <td height="1" colspan="3" align="center"  background="img/line.gif"></td>
                    </tr>
                    <tr> 
                      <td width='18' align='center'><img src='img/icon02.gif' width='7' height='7'></td>
                      <td width='109' height='25'>취 소 날 짜</td>
                      <td width='343'><?php echo($inipay->getResult('CancelDate')); ?></td>
                    </tr>                	    
                    <tr> 
                      <td height='1' colspan='3' align='center'  background='img/line.gif'></td>
                    </tr>
                    <tr> 
                      <td width='18' align='center'><img src='img/icon02.gif' width='7' height='7'></td>
                      <td width='109' height='25'>취 소 시 각</td>
                      <td width='343'><?php echo($inipay->getResult('CancelTime')); ?></td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' align='center'  background='img/line.gif'></td>
                    </tr>                    
                    <tr> 
                      <td width='18' align='center'><img src='img/icon02.gif' width='7' height='7'></td>
                      <td width='109' height='25'>현금영수증<br>취소승인번호</td>
                      <td width='343'><?php echo($inipay->getResult('CSHR_CancelNum')); ?></td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' align='center'  background='img/line.gif'></td>
                    </tr>
                    
                    
                  </table></td>
              </tr>
            </table>
            <br>
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
