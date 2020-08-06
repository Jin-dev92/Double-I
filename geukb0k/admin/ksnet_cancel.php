<?php
include_once "path.php";

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

include_once $nfor[pg_path]."/KSPayApprovalCancel.php"; 

// Default-------------------------------------------------------
	$EncType     = "2";     // 0: 암화안함, 1:openssl, 2: seed
	$Version     = "0210";  // 전문버전
	$VersionType = "00";    // 구분
	$Resend      = "0";     // 전송구분 : 0 : 처음,  2: 재전송

	$RequestDate=           // 요청일자 : yyyymmddhhmmss
		SetZero(strftime("%Y"),4).
		SetZero(strftime("%m"),2).
		SetZero(strftime("%d"),2).
		SetZero(strftime("%H"),2).
		SetZero(strftime("%M"),2).
		SetZero(strftime("%S"),2);
	$KeyInType     = "K";   // KeyInType 여부 : S : Swap, K: KeyInType
	$LineType      = "1";   // lineType 0 : offline, 1:internet, 2:Mobile
	$ApprovalCount = "1";   // 복합승인갯수
	$GoodType      = "0";   // 제품구분 0 : 실물, 1 : 디지털
	$HeadFiller    = "";   // 예비
//-------------------------------------------------------------------------------

// Header (입력값 (*) 필수항목)--------------------------------------------------
	$StoreId		= $nfor[pg_id];    // *상점아이디
	$OrderNumber	=""; 							// *주문번호
	$UserName		="";   							// *주문자명
	$IdNum		    ="";       						// 주민번호 or 사업자번호
	$Email			="";       						// *email
	$GoodName		="";    						// *제품명
	$PhoneNo		="";     						// *휴대폰번호
// Header end -------------------------------------------------------------------
	
// Data Default(수정항목이 아님)-------------------------------------------------
	$ApprovalType   = "1010";	// 승인구분
	$TransactionNo  = $order[pg_tid];		// 거래번호
	$Canc_amt       = $order[pg_price];	//' 취소금액
	$Canc_seq       = "1";	//' 취소일련번호
	$Canc_type      = "0";	//' 취소유형 0 :거래번호취소 1: 주문번호취소 3:부분취소
// Data Default end -------------------------------------------------------------

// Server로 부터 응답이 없을시 자체응답
	$rApprovalType     = "1011";
	$rTransactionNo    = "";              // 거래번호
	$rStatus           = "X";             // 상태 O : 승인, X : 거절
	$rTradeDate        = "";              // 거래일자
	$rTradeTime        = "";              // 거래시간
	$rIssCode          = "00";            // 발급사코드
	$rAquCode          = "00";            // 매입사코드
	$rAuthNo           = "9999";          // 승인번호 or 거절시 오류코드
	$rMessage1         = "취소거절";      // 메시지1
	$rMessage2         = "C잠시후재시도"; // 메시지2
	$rCardNo           = "";              // 카드번호
	$rExpDate          = "";              // 유효기간
	$rInstallment      = "";              // 할부
	$rAmount           = "";              // 금액
	$rMerchantNo       = "";              // 가맹점번호
	$rAuthSendType     = "N";             // 전송구분
	$rApprovalSendType = "N";             // 전송구분(0 : 거절, 1 : 승인, 2: 원카드)
	$rPoint1           = "000000000000";  // Point1
	$rPoint2           = "000000000000";  // Point2
	$rPoint3           = "000000000000";  // Point3
	$rPoint4           = "000000000000";  // Point4
	$rVanTransactionNo = "";              
	$rFiller           = "";              // 예비
	$rAuthType         = "";              // ISP : ISP거래, MP1, MP2 : MPI거래, SPACE : 일반거래
	$rMPIPositionType  = "";              // K : KSNET, R : Remote, C : 제3기관, SPACE : 일반거래
	$rMPIReUseType     = "";              // Y : 재사용, N : 재사용아님
	$rEncData          = "";              // MPI, ISP 데이터
// --------------------------------------------------------------------------------

	KSPayApprovalCancel("localhost", 29991);

	HeadMessage(
		$EncType       ,                  // 0: 암화안함, 1:openssl, 2: seed       
		$Version       ,                  // 전문버전                              
		$VersionType   ,                  // 구분                                  
		$Resend        ,                  // 전송구분 : 0 : 처음,  2: 재전송    
		$RequestDate   ,                  // 재사용구분                                       
		$StoreId       ,                  // 상점아이디                                   
		$OrderNumber   ,                  // 주문번호                                     
		$UserName      ,                  // 주문자명                                     
		$IdNum         ,                  // 주민번호 or 사업자번호                       
		$Email         ,                  // email                                        
		$GoodType      ,                  // 제품구분 0 : 실물, 1 : 디지털                
		$GoodName      ,                  // 제품명                                       
		$KeyInType     ,                  // KeyInType 여부 : S : Swap, K: KeyInType      
		$LineType      ,                  // lineType 0 : offline, 1:internet, 2:Mobile   
		$PhoneNo       ,                  // 휴대폰번호                                   
		$ApprovalCount ,                  // 복합승인갯수                                 
		$HeadFiller    );                 // 예비                                         

// ------------------------------------------------------------------------------
	if($Canc_type == '3'){
		CancelDataMessage($ApprovalType, $Canc_type, $TransactionNo,	"",	"", SetZero($Canc_amt,9).SetZero($Canc_seq,2),	"", "");   		
	}
	else{
		CancelDataMessage($ApprovalType, "0", $TransactionNo,	"",	"", "",	"", "");   	                    
	}

	if (SendSocket("1")) {
		$rApprovalType		= $ApprovalType	    ;
		$rTransactionNo		= $TransactionNo	;  	// 거래번호
		$rStatus			= $Status		  	;	// 상태 O : 승인, X : 거절
		$rTradeDate			= $TradeDate		;  	// 거래일자
		$rTradeTime			= $TradeTime		;  	// 거래시간
		$rIssCode			= $IssCode		  	;	// 발급사코드
		$rAquCode			= $AquCode		  	;	// 매입사코드
		$rAuthNo			= $AuthNo		  	;	// 승인번호 or 거절시 오류코드
		$rMessage1			= $Message1		  	;	// 메시지1
		$rMessage2			= $Message2		  	;	// 메시지2
		$rCardNo			= $CardNo		  	;	// 카드번호
		$rExpDate			= $ExpDate		  	;	// 유효기간
		$rInstallment		= $Installment	  	;	// 할부
		$rAmount			= $Amount		  	;	// 금액
		$rMerchantNo		= $MerchantNo	  	;	// 가맹점번호
		$rAuthSendType		= $AuthSendType	  	;	// 전송구분= new String(this.read(2))
		$rApprovalSendType	= $ApprovalSendType	;	// 전송구분(0 : 거절, 1 : 승인, 2: 원카드)
		$rPoint1			= $Point1		  	;	// Point1
		$rPoint2			= $Point2		  	;	// Point2
		$rPoint3			= $Point3		  	;	// Point3
		$rPoint4			= $Point4		  	;	// Point4
		$rVanTransactionNo  = $VanTransactionNo ;   // Van거래번호
		$rFiller			= $Filler		  	;	// 예비
		$rAuthType			= $AuthType		  	;	// ISP : ISP거래, MP1, MP2 : MPI거래, SPACE : 일반거래
		$rMPIPositionType	= $MPIPositionType 	;	// K : KSNET, R : Remote, C : 제3기관, SPACE : 일반거래
		$rMPIReUseType		= $MPIReUseType		;	// Y : 재사용, N : 재사용아님
		$rEncData			= $EncData		  	;	// MPI, ISP 데이터
	}








if($rStatus=="O"){
	
	sql_query("update nfor_order set pay_step='3', od_canceldatetime=NOW(), cancel_price=total_price where od_id='$order[od_id]'");
	sql_query("update nfor_cart set pay_step='3', od_canceldatetime=NOW() where cart_id='$order[cart_id]' and pay_step='2'");
	
	coupon_again($order[od_id]);

	if($order[money_price]){
		insert_money($order[mb_no],$order[money_price],"적립금 상품구매 취소","7",$order[od_id]);
	}

	nfor_send("cancel",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
	
	alert("주문취소 처리되었습니다","order_cancelrequest_list.php?$qstr");
} else{
	$msg = iconv("euc-kr","utf-8",$rMessage1.$rMessage2);
	alert("다음사유로실패하였습니다".$msg,"order_cancelrequest_list.php?$qstr");
}





?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html charset=utf-8">
<title>KSPay</title>
<style type="text/css">
	TABLE{font-size:9pt; line-height:160%;}
	A {color:blueline-height:160% background-color:#E0EFFE}
	INPUT{font-size:9pt}
	SELECT{font-size:9pt}
	.emp{background-color:#FDEAFE}
	.white{background-color:#FFFFFF color:black border:1x solid white font-size: 9pt}
</style>
</head>

<body>
<table border=0 width=0>
	<tr>
		<td align=center>
			<table width=350 cellspacing=0 cellpadding=0 border=0 bgcolor=#4F9AFF>
				<tr>
					<td width=50%>
						<table width=100% cellspacing=1 cellpadding=2 border=0>
							<tr bgcolor=#4F9AFF height=25>
								<td align=left><font color="#FFFFFF">
								KSPay 신용카드 취소
								</font></td>
							</tr>
							<tr bgcolor=#FFFFFF>
								<td valign=top>
									<table width=100% cellspacing=0 cellpadding=2 border=0>
										<tr>
											<td align=left>
												<table>	
													<tr><td>거래번호				</td><td><?echo($rTransactionNo)?></td></tr>
													<tr><td>오류구분(O/X)			</td><td><?echo($rStatus)?></td></tr>
													<tr><td>거래 일자				</td><td><?echo($rTradeDate)?></td></tr>
													<tr><td>거래 시간				</td><td><?echo($rTradeTime)?></td></tr>
													<tr><td>응답 메세지1            </td><td><?echo($rMessage1)?></td></tr>
													<tr><td>응답 메세지2            </td><td><?echo($rMessage2)?></td></tr>
												</table>
											<td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>