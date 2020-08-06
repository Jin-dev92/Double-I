<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	header( "Content-type: application/vnd.ms-excel" );
	header( "Content-type: application/vnd.ms-excel; charset=utf-8");
	header( "Content-Disposition: attachment; filename = biofacedb.xls" );
	header( "Content-Description: PHP4 Generated Data" );
	  echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
	?>
<meta charset="UTF-8">
<title>Document</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<?php
	$dataObject = $_POST['excel'];
	// print_r( $dataObject );
?>


	<div class="row">
		<div class="col s12">
			<table class="bordered highlight centered" id="myTable">
				<thead>
					<tr>
						<th style="width:3%">no.</th>
						<th style="width:10%">이름</th>
						<th style="width:10%">등록시간</th>
						<th style="width:15%">원하는시간</th>
						<th style="width:10%">핸드폰</th>
						<th style="width:5%">성별</th>
						<th style="width:7%">부위</th>
						<th style="width:15%">내용</th>
						<th style="width:5%">경로</th>
						<th style="width:10%">진행상황</th>
						<th style="width:10%">메모</th>
					</tr>
				</thead>

				<tbody class="contents">
<?
					$ex1 = explode("[",$dataObject);
					$ex2 = explode("]",$ex1[1]);
					$dataObject = $ex2[0];

					$response=str_replace("{","[{",$dataObject);
					$response=str_replace("}","}]",$response);
					$response=str_replace(",[","arrchangess[",$response);
					$data = explode("arrchangess",$response);

					for($i=0; $i < count($data); $i++) {
						$tables = json_decode($data[$i]);
?>
						<tr>
							<td><?=$i+1?></td>
							<td><?=$tables[0]->name?></td>
							<td><?=$tables[0]->reg_time?></td>
							<td><?=$tables[0]->wishtime?></td>
							<td><?=$tables[0]->phone?></td>
							<td><?=$tables[0]->gender?></td>
							<td><?=$tables[0]->part?></td>
							<td><?=$tables[0]->contents?></td>
							<td><?=$tables[0]->origin?></td>
							<td><?=$tables[0]->process_state?></td>
							<td><?=$tables[0]->memo?></td>
						</tr>
<?
					}
?>


				</tbody>
			</table>
		</div>
	</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</body>
</html>
