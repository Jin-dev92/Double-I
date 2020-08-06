<html>
<head>
<title>신용카드 - 주문요청 테스트페이지</title>
<script language="javascript">
	var pf;
	 
	function init() {
		pf = document.pay_form
		pf.ORDERNO.value= getTimeStamp();
	}
	function getTimeStamp() {
	var d = new Date();
	var month = d.getMonth() + 1;
	var date = d.getDate();
	var hour = d.getHours();
	var minute = d.getMinutes();
	var second = d.getSeconds();
 
	month = (month < 10 ? "0" : "") + month;
	date = (date < 10 ? "0" : "") + date;
	hour = (hour < 10 ? "0" : "") + hour;
	minute = (minute < 10 ? "0" : "") + minute;
	second = (second < 10 ? "0" : "") + second;
 
	var s = d.getFullYear() + month + date + hour + minute + second;
 
	return s;
	}
	 
	function fnSubmit() {
		var fileName;
		fileName = "http://ssltest.daoupay.com/creditCard/DaouCreditCardMng.jsp";		
		
		pf = document.pay_form
		
		DAOUPAY = window.open("", "DAOUPAY", "width=469,height=507");
		DAOUPAY.focus();
	 
		pf.target = "DAOUPAY";
		pf.action = fileName;
		pf.method = "post";
		pf.submit();
	}
	function fnCheck() {	
 
	var frm = document.pay_form;
	
	//주문번호
	if(trim(frm.p_orderno.value) == "" || getByteLen(frm.p_orderno.value) > 50) {
		alert("주문번호 (p_orderno) 를 입력해주세요. (최대:50byte, 현재:" + getByteLen(frm.p_orderno.value) + ")");
		return;
	}
	//상품구분
	if(trim(frm.p_producttype.value) == "" || getByteLen(frm.p_producttype.value) > 2) {
		alert("상품구분 (p_producttype) 를 입력해주세요. (최대:2byte, 현재:" + getByteLen(frm.p_producttype.value) + ")");
		return;
	}
	//과금유형
	if(trim(frm.p_billtype.value) == "" || getByteLen(frm.p_billtype.value) > 2) {
		alert("과금유형 (p_billtype) 를 입력해주세요. (최대:2byte, 현재:" + getByteLen(frm.p_billtype.value) + ")");
		return;
	}
	//결제금액
	if(trim(frm.p_amount.value) == "" || getByteLen(frm.p_amount.value) > 10) {
		alert("결제금액 (p_amount) 를 입력해주세요. (최대:10byte, 현재:" + getByteLen(frm.p_amount.value) + ")");
		return;
		
	}
	/********************  필수 입력 체크 끝  ***/
	}
	function trim(txt) {
		while (txt.indexOf(' ') >= 0) {
			txt = txt.replace(' ','');
		}
		return txt;
	}

	function fnNumCheck() {
	if(event.keyCode >= 48 && event.keyCode <= 57)
		event.returnValue = true;
	else
		event.returnValue = false;
}
</script>
</head>
 
<BODY onLoad="init();">
	<div>
		<h2>결제입력테스트</h2>
		<form method="POST" name="pay_form" ">
			<input type="text" name="CPID" id="CPID" value="CTS14363"><br> 
			주문번호 : <input type="text" name="ORDERNO" id="ORDERNO" value=""><br>
			상품구문 : <input type="text" name="PRODUCTTYPE" id="PRODUCTTYPE" value="1"><br>
			과금유형 : <input type="text" name="BILLTYPE" id="BILLTYPE" value="1"><br>
			비과세 여부 : <input type="text" name="TAXFREECD"  id="TAXFREECD" value="00"><br>
			결제 금액 : <input type="text" name="AMOUNT" id="AMOUNT" value="1000" onkeypress="fnNumCheck();"><br>
			할부 개월 수 : <input type="text" name="quotaopt" id="quotaopt" value=""><br>
			<input name="btnSubmit" type="button" value="주문하기" onclick="fnSubmit()" width="63" height="30">
		</form>
	</div>

</BODY>
</html>
