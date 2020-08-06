	<?php
	$db_host = 'localhost';
	$db_user = 'viewline1';
	$db_password = 'doubleii1!';
	$db_database = 'viewline1';

	echo $_POST['p_orderno'];

	$p_orderno1 =$p_orderno;
	// DB 연결
	$connect = mysqli_connect($db_host, $db_user, $db_password, $db_database);
	// DB에 데이터 입력
	$result = mysqli_query($connect,"select * from personalpay_table where p_orderno = '$p_orderno1'");
	$sp = mysqli_fetch_array($result); //기존명령 사용
	?>

	<div>
	
	<h2>결제입력테스트</h2>
		
			
			주문번호 : <?php echo $sp['p_orderno']; ?><br>
			상품구문 : <?php echo $sp['p_producttype']; ?><br>
			과금유형 : <?php echo $sp['p_billtype']; ?><br>
			비과세 여부 :<?php echo $sp['p_taxfreecd']; ?><br>
			결제 금액 : <?php echo $sp['p_amount']; ?><br>
			할부 개월 수 : <?php echo $sp['p_quotaopt']; ?><br>
			<result>succese</result>
	
	</div>
