<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="description" content="BIOFACE">
<title>BIOFACE</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link type="text/css" href="/assets/css/style.css?<?=rand()?>" rel="stylesheet">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<link type="text/css" rel="stylesheet" href="/assets/css/materialize.min.css?<?=rand()?>"  media="screen,projection"/>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="/assets/js/materialize.min.js"></script>

<link type="text/css" rel="stylesheet" href="/assets/css/swiper.min.css"  media="screen,projection"/>
<script src="/assets/js/swiper.min.js"></script>
<style>
	.tool_btn { display: block; margin: 0 auto; display: flex;}
	.tool_btn a { text-decoration: none; color: #fff;}
	.tool_btn div { padding: 10px; background: #3e3025; margin: 5px; border-radius: 10px; width: 80px; text-align: center;}

	.btn, .btn-large, .btn-small { background-color: #3e3e3e;}
	.btn:focus, .btn-large:focus, .btn-small:focus, .btn-floating:focus { background-color: #201193;}
	.btn:hover, .btn-large:hover, .btn-small:hover { background-color: #AA0010;}
	.btn.btn-default.active { background-color: #AA0010;}
	.list_wrap { width: 100%; background-image: url(/assets/img/main01.jpg); display: flex; flex-wrap: wrap; justify-content: center; flex-direction: column; padding: 100px 0; height: 100vh;}
	.list_wrap h3 { text-align: center; color:#fff; font-weight: bold;}
	table { width: 100%; max-width: 800px; margin: 50px auto; background-color: rgba(255, 255, 255, 0.8);}
	table tr, table td, table thead tr th { text-align: center;}
	table thead { background-color: #AA0010; color:#fff;}

	@media ( max-width: 992px){
		table { max-width: 600px;}
		.list_wrap { padding: 50px 0;}
		.pagination { width: auto !important;}
	}
	@media ( max-width: 640px){
		table { width: 90%; margin: 20px auto;}
		/*.list_wrap { padding: 20px 0;}*/
		.list_wrap h3 { margin: 0;}
	}

</style>
<body>


<?
	$pageNum = $_GET[pageNum];
	// 데이터개수
	$pageSize = 5;
	// 페이지네이션 개수
	$pageBlock = 3;

	if($pageNum == ""){
		$pageNum = 1;
	}

	$startRow = ($pageNum - 1) * $pageSize + 1;
	$insertPageNum = $startRow - 1;

	
?>
<?php
// 디비연결
$servername = "localhost";
$username = "bioface1";
$password = "doubleii11!@";
$dbname = "bioface1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');

//Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// 조건문
$where = "1=1"; 
$cate = $_GET['cate'];

if($cate){
	$where = 'wr_4 like"%'.$cate.'%"';
}

// 내용 출력
$sql = "SELECT * FROM g5_write_ch WHERE $where ORDER BY `g5_write_ch`.`wr_datetime` limit $insertPageNum , $pageSize";
$result = $conn->query($sql);
$j = ($pageNum-1)*$pageSize;
?>
<div class="list_wrap">
	<h3>APPLY LIST</h3>

	<div class="tool_btn">
		<a href="apply_list.php?pageNum=1"><div>전체보기</div></a>
		<a href="apply_list.php?pageNum=1&cate=Again"><div>Again</div></a>
		<a href="apply_list.php?pageNum=1&cate=FLX"><div>FLX</div></a>
	</div>

	<table class="table table-striped table-bordered">
		<thead>
		    <tr> 
		      <th class="text-center">번 호</th>
		      <th class="text-center">이름</th>
		      <th class="text-center">전화번호</th>
		      <th class="text-center">성별</th>
		      <th class="text-center">원하는 시간</th>
		      <th class="text-center">항목</th>
		      <th class="text-center">신청날짜</th>
		      <!-- <th class="text-center">카테고리</th>  -->
		    </tr>
	    </thead>
	    <tbody>
<?
			
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
				$j = $j + 1;
?>
			
				<tr>
					<td class="text-center"><?=$j?></td>
					<td class="text-center"><?=$row["wr_name"]?></td>
					<td class="text-center"><?=$row["wr_1"]?></td>
					<td class="text-center"><?=$row["wr_2"]?></td>
					<td class="text-center"><?=$row["wr_3"]?></td>
					<td class="text-center"><?=$row["wr_4"]?></td>
					<td class="text-center"><?=$row["wr_datetime"]?></td>
					<!-- <td class="text-center"><?=$row["memo"]?></td> -->
				</tr>
<?
	
				}
			} else {?>
			    <tr>
					<td class="text-center" colspan="7">데이터가 존재하지 않습니다.</td>
				</tr>
			<?}?>
		</tbody>
	</table>

<?
		$sql = "SELECT count(*) as maxnum FROM g5_write_ch WHERE $where";
		$result = $conn->query($sql);

		// 데이터의 총 개수 구하기
		if ($result->num_rows > 0) {
			// output data of each row
			if($row = $result->fetch_assoc()) {
				$count = $row["maxnum"];
				// echo "총 " .$row["maxnum"] . "개<br><br>";
			}
		} else {
			echo "마지막 데이터입니다.";
		}


		if($count >0 ){
			$pageCount = $count / $pageSize + ($count % $pageSize == 0 ? 0 : 1);
			// echo '총 ' . $pageCount . '페이지';
			$startPage = 1;
			// 소수점 버림
			$currentPage = (int)$pageNum;

			// 딱 나누어 떨어지지 않으면
			if($currentPage % $pageBlock != 0)
	           $startPage = (int)($currentPage/$pageBlock)*$pageBlock + 1;
			else
	           $startPage = ((int)($currentPage/$pageBlock)-1)*$pageBlock + 1;


			$before = $pageNum - $pageBlock;
			$after = $pageNum + $pageBlock;
			$i = $startPage;                                   

			
	        $endPage = $startPage + $pageBlock - 1;
	        if ($endPage > $pageCount) $endPage = $pageCount;
	        if ($before <= 0) { $before = 1;}

	        // echo '현재페이지'.$currentPage;
	        // echo '시작페이지'.$startPage;
	        // echo '마지막 페이지'.$endPage;
	         ?>
			
			<div class="text-center" style="display: flex; justify-content: center;">
				<?if($pageNum > $pageBlock){

					if($currentPage % $pageBlock != 0)
						$beforePage = (int)($currentPage/$pageBlock)*$pageBlock - $pageBlock + 1;
					else
						$beforePage = ((int)($currentPage/$pageBlock)-1)*$pageBlock + 1 - $pageBlock;

					?>
				<button type="button" class="btn btn-default" aria-label="Left Align" onclick="location.href ='apply_list.php?pageNum=1'">처음으로
				</button>

		        <button type="button" class="btn btn-default" aria-label="Left Align" onclick="location.href ='apply_list.php?pageNum=<?=$before?>'">이전
				</button>


	<?      }?>
			
			<?
	        for ($i ; $i <= $endPage ; $i++) {
	        	if($i == $pageNum){

	        		?>
	        		<div class="pagination">
					<a href="apply_list.php?pageNum=<?=$i?>">
		        		<button type="button" class="btn btn-default active" aria-label="Left Align"><?=$i?></button>
					</a>
					</div>

	        	<?} else {
	        	?>
	        		<div class="pagination">
	        		<a href="apply_list.php?pageNum=<?=$i?>">
		        		<button type="button" class="btn btn-default buttons" aria-label="Left Align"><?=$i?></button>
					</a>
					</div>
				
	<?      }}
	        
	          ?>

	        <?

	        if($pageCount % $pageBlock != 0)
				$lastPageStart = (int)($pageCount/$pageBlock)*$pageBlock + 1;
			else
				$lastPageStart = ((int)($pageCount/$pageBlock)-1)*$pageBlock + 1;


	        if($pageNum < $lastPageStart){

		        if($currentPage % $pageBlock != 0)
					$nextPage = (int)($currentPage/$pageBlock)*$pageBlock + $pageBlock + 1;
				else
					$nextPage = $currentPage + 1;

	        ?>

	        <button type="button" class="btn btn-default" aria-label="Left Align" onclick="location.href ='apply_list.php?pageNum=<?=$nextPage?>'">다음
			</button>
		

			<button type="button" class="btn btn-default" aria-label="Left Align" onclick="location.href ='apply_list.php?pageNum=<?=(int)$pageCount?>'">마지막
			</button>

			

		<?}}?>
			
			

		</div>


</div>

<script>

</script>
</body>
</html>