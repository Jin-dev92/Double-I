<?php
	// DB 설정
	$db_host = 'localhost';
	$db_user = 'viewline1';
	$db_password = 'doubleii1!';
	$db_database = 'viewline1';

	$CPID = $_POST['CPID'];
	$ORDERNO = $_POST['ORDERNO'];
	$PRODUCTTYPE = $_POST['PRODUCTTYPE'];
	$BILLTYPE = $_POST['BILLTYPE'];
	$TAXFREECD = $_POST['TAXFREECD'];
	$AMOUNT = $_POST['AMOUNT'];
	$quotaopt = $_POST['quotaopt'];

	// DB 연결
	$connect = mysqli_connect($db_host, $db_user, $db_password, $db_database);
	// DB에 데이터 입력
	$query = "insert into personalpay_table(CPID, ORDERNO, PRODUCTTYPE, BILLTYPE, TAXFREECD, AMOUNT, quotaopt) values('$CPID','$ORDERNO','$PRODUCTTYPE','$BILLTYPE','$TAXFREECD','$AMOUNT','$quotaopt')";
	$result = mysqli_query($connect,$query);

	// DB 입력시 오류가 있다면 오류를 출력하고 없으면 DB 연결 끊기
	if (!$result) die(mysqli_error());
	mysqli_close($connect);

	// 처리가 완료되면 성공 메시지 보여주고 이동할 페이지로 이동
	echo "<script>alert(\"Input SUCCESS!\");</script>";
	
?>

<html>
<body>
<RESULT>SUCCESS</RESULT>
</body>
</html>
