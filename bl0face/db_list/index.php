<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>비오페이스</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- Compiled and minified JavaScript -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="assets/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<style>
.modal_ul li {
	font-size: 18px
	color: #333;
	padding: 20px 0;
	border-bottom: 1px solid #ccc;
	text-align: center;
}
.modal_ul li a {
	color: #333;
}
.modal {
	width: 300px;
}
</style>
<body>
<?
	$pageNum = $_GET[pageNum];
	$pageSize = 15;
	$pageBlock = 5;

	if($pageNum == ""){
		$pageNum = 1;
	}

	$startRow = ($pageNum - 1) * $pageSize + 1;
	$insertPageNum = $startRow - 1;

	// echo $pageNum;

?>

<div class="row">
	<h1>DB 페이지</h1>
	<input type="text" class="datepicker" placeholder="날짜선택" id="datepicker">
	<a id="export" class="btn">엑셀다운</a>
	<form class="excelform" action="Export_excel.php" method="post"><input type="hidden" id="excel" name="excel"></form>

</div>
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

				<tbody class="contents"></tbody>
			</table>
		</div>
	</div>

	<!-- Modal Structure -->
	<div id="modal1" class="modal">
    	<div class="modal-content">
			<h4 style="text-align: center;">진행상황</h4>
			<input type="hidden" value="" id="index">
			<ul class="modal_ul">
				<li><a href="javascript:changeprocess('미확인')">미확인</a></li>
				<li><a href="javascript:changeprocess('부재1')">부재1</a></li>
				<li><a href="javascript:changeprocess('부재2')">부재2</a></li>
				<li><a href="javascript:changeprocess('부재3')">부재3</a></li>
				<li><a href="javascript:changeprocess('상담완료')">상담완료</a></li>
				<li><a href="javascript:changeprocess('예약완료')">예약완료</a></li>
				<li><a href="javascript:changeprocess('잘못된번호')">잘못된번호</a></li>
				<li><a href="javascript:changeprocess('기타')">기타</a></li>
			</ul>
		</div>
	</div>



	<ul class="pagination" style="text-align: center;"></ul>

	<div class="excel2">

	</div>



<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/materialize.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase-messaging.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBA7sHrhxZ4cbS0zgCJ8AiX8oFJ93POLWw",
    authDomain: "bioface-db-page.firebaseapp.com",
    databaseURL: "https://bioface-db-page.firebaseio.com",
    projectId: "bioface-db-page",
    storageBucket: "bioface-db-page.appspot.com",
    messagingSenderId: "418660414626"
  };
  firebase.initializeApp(config);
</script>
<script>
$(document).ready(function(){
	$('.modal').modal();
	var all_arr = [];
	var excel;
	var xx=0;
	var reverse = [];
	var re_reverse = [];
	var paging = 0;

	firebase.database().ref('/users/').on('value', function(snapshot){
		$('.contents').empty();

		var arr_size = 0;
		arr_size  = arrayCounter(snapshotToArray(snapshot));

		var pick = '<?=$_GET[date]?>';
		var num = 1;
		var idx_arr = [];
		// alert(pick);
		if(pick == ''){


			for(var i = 0; i < arr_size ; i++){
				// alert(snapshotToArray(snapshot)[i]);
				firebase.database().ref("users/").on("value", function(snapshot2) {
					var new_arr = snapshot2.val();

					var idx = new_arr[snapshotToArray(snapshot)[i]].idx;
					var contents = new_arr[snapshotToArray(snapshot)[i]].contents;
					var name = new_arr[snapshotToArray(snapshot)[i]].name;
				    var wishtime = new_arr[snapshotToArray(snapshot)[i]].wishtime;
				    var phone = new_arr[snapshotToArray(snapshot)[i]].phone;
				    var gender = new_arr[snapshotToArray(snapshot)[i]].gender;
				    var part =new_arr[snapshotToArray(snapshot)[i]].part;
				    var process_state = new_arr[snapshotToArray(snapshot)[i]].process;
				    var memo = new_arr[snapshotToArray(snapshot)[i]].memo;
				    var origin = new_arr[snapshotToArray(snapshot)[i]].origin;
				    var reg_time = new_arr[snapshotToArray(snapshot)[i]].time;


					idx_arr[i] = {idx:idx, contents:contents, name:name, wishtime:wishtime , phone:phone , gender:gender , part:part , process_state:process_state , memo:memo , origin:origin , reg_time:reg_time};


					excel = JSON.stringify(idx_arr);
					$('#excel').val(excel);


				});

				// DESC
				re_reverse.push(snapshotToArray(snapshot)[i]);
				

			}


			re_reverse.reverse();
			paging = arr_size + 1;

			for(var i = 0; i < arr_size ; i++){
				firebase.database().ref("users/" + re_reverse[i]).on("value", function(snapshot2) {
					


				    var name = snapshot2.child("name").val();
				    var wishtime = snapshot2.child("wishtime").val();
				    var phone = snapshot2.child("phone").val();
				    var gender = snapshot2.child("gender").val();
				    var part = snapshot2.child("part").val();
				    var contents = snapshot2.child("contents").val();
				    var process_state = snapshot2.child("process").val();
				    var memo = snapshot2.child("memo").val();
				    var origin = snapshot2.child("origin").val();
				    var reg_time = snapshot2.child("time").val();
				    var idx = snapshot2.child("idx").val();
				    var ddd = re_reverse[i];

				    all_arr += [name, wishtime, phone, gender, part, contents, process_state, memo, origin, reg_time, idx];



				    if(paging-idx >= <?=$startRow?> && paging-idx < <?=$startRow+$pageSize?>){

					    var push = '<tr><td>' + idx + '</td><td>' + name + '</td><td>' + reg_time + '</td><td>' + wishtime + '</td><td>' + phone + '</td><td>' + gender + '</td><td>' + part + '</td><td>' + contents + '</td><td>' + origin + '</td><td><input type="hidden" value="' + ddd + '"><a href="#modal1" class="modal-trigger" onclick="addindex(this)">' + process_state + '</a></td><td><input type="hidden" value="' + ddd + '"><input type="text" value="' + memo + '" onkeydown="changeMemo(this)"></td></tr>';
					}


				    $('.contents').append(push);
				    // num++;

				});


			}



			// 페이지네이션
			$('.pagination').empty();
			if(arr_size > 0){

				var count = arr_size;

				var pageCount = count / <?=$pageSize?> + (count % <?=$pageSize?> == 0 ? 0 : 1);
				var startPage = 1;
				var currentPage = '<?=(int)$pageNum?>';
				<?$currentPage = (int)$pageNum?>;

				// alert(currentPage);

				if(currentPage % <?=$pageBlock?> != 0)
		           var startPage = parseInt(currentPage/<?=$pageBlock?>)*<?=$pageBlock?> + 1;
				else
		           var startPage = currentPage;


				// echo "페이지카운트 : " . (int)$pageCount;
				// echo $currentPage;
				// echo $startPage;

				var before = <?=$pageNum?> - <?=$pageBlock?>;

				var after = <?=$pageNum?> + <?=$pageBlock?>;

		        var endPage = startPage + <?=$pageBlock?> - 1;

		        if (endPage > pageCount) {endPage = pageCount};
		        if (before <= 0) { before = 1;}


		        if(<?=$pageNum?> > <?=$pageBlock?>){
		        	if(currentPage % <?=$pageBlock?> != 0) {
						var beforePage = <?=(int)($currentPage/$pageBlock)*$pageBlock - $pageBlock + 1?>;
		        	}
					else {
						var beforePage = <?=((int)($currentPage/$pageBlock)-1)*$pageBlock + 1 - $pageBlock?>;
					}

					// 첫 페이지
					$('.pagination').append('<li class="waves-effect"><a href="index.php?pageNum=1"><i class="material-icons">fast_rewind</i></a></li>');
					// 이전 페이지
					$('.pagination').append('<li class="waves-effect"><a href="index.php?pageNum="' + before + '><i class="material-icons">chevron_left</i></a></li>');

		        }

		        for (var i = startPage ; i <= endPage ; i++) {
		        	if(i == <?=$pageNum?>){
		        		$('.pagination').append('<li class="active"><a href="index.php?pageNum=' + i + '">' + i + '</a></li>');
		        	} else {
		        		$('.pagination').append('<li class="waves-effect"><a href="index.php?pageNum=' + i + '">' + i + '</a></li>');

		        	}
				}


				if(pageCount % <?=$pageBlock?> != 0){
					var lastPageStart = parseInt(pageCount/<?=$pageBlock?>)*<?=$pageBlock?> + 1;
				}
				else{
					var lastPageStart = (parseInt(pageCount/<?=$pageBlock?>)-1)*<?=$pageBlock?> + 1;
				}

				if(<?=$pageNum?> < lastPageStart){

					if(currentPage % <?=$pageBlock?> != 0){
						var nextPage = parseInt(currentPage/<?=$pageBlock?>)*<?=$pageBlock?> + <?=$pageBlock?> + 1;
					}
					else{
						var nextPage = currentPage + 1;
					}

					// 다음페이지
					$('.pagination').append('<li class="waves-effect"><a href="index.php?pageNum=' + nextPage + '"><i class="material-icons">chevron_right</i></a></li>');

					// 마지막 페이지
					$('.pagination').append('<li class="waves-effect"><a href="index.php?pageNum=' + parseInt(pageCount) + ' "><i class="material-icons">fast_forward</i></a></li>');

				}
			} else {alert('데이터가 없습니다');}

		} else {
			for(var i = 0; i < arr_size ; i++){
				// DESC
				re_reverse.push(snapshotToArray(snapshot)[i]);
				
			}
			re_reverse.reverse();
			for(var i = 0; i < arr_size ; i++){
				firebase.database().ref("users/" + re_reverse[i]).on("value", function(snapshot2) {

				    var name = snapshot2.child("name").val();
				    var wishtime = snapshot2.child("wishtime").val();
				    var phone = snapshot2.child("phone").val();
				    var gender = snapshot2.child("gender").val();
				    var part = snapshot2.child("part").val();
				    var contents = snapshot2.child("contents").val();
				    var process_state = snapshot2.child("process").val();
				    var memo = snapshot2.child("memo").val();
				    var origin = snapshot2.child("origin").val();
				    var reg_time = snapshot2.child("time").val();
				    var idx = snapshot2.child("idx").val();

				    var rt = reg_time.split(' ');
				    var cprt = rt[0];
				    var ddd = re_reverse[i];


				    if(cprt == pick){

						    var push = '<tr><td>' + idx + '</td><td>' + name + '</td><td>' + reg_time + '</td><td>' + wishtime + '</td><td>' + phone + '</td><td>' + gender + '</td><td>' + part + '</td><td>' + contents + '</td><td>' + origin + '</td><td><input type="hidden" value="' + ddd + '"><a href="#modal1" class="modal-trigger" onclick="addindex(this)">' + process_state + '</a></td><td><input type="hidden" value="' + ddd + '"><input type="text" value="' + memo + '" onkeydown="changeMemo(this)"></td></tr>';

						    $('.contents').append(push);



						    num++;


						    firebase.database().ref("users/").on("value", function(snapshot2) {
								var new_arr = snapshot2.val();

								var idx = new_arr[snapshotToArray(snapshot)[i]].idx;
								var contents = new_arr[snapshotToArray(snapshot)[i]].contents;
								var name = new_arr[snapshotToArray(snapshot)[i]].name;
							    var wishtime = new_arr[snapshotToArray(snapshot)[i]].wishtime;
							    var phone = new_arr[snapshotToArray(snapshot)[i]].phone;
							    var gender = new_arr[snapshotToArray(snapshot)[i]].gender;
							    var part =new_arr[snapshotToArray(snapshot)[i]].part;
							    var process_state = new_arr[snapshotToArray(snapshot)[i]].process;
							    var memo = new_arr[snapshotToArray(snapshot)[i]].memo;
							    var origin = new_arr[snapshotToArray(snapshot)[i]].origin;
							    var reg_time = new_arr[snapshotToArray(snapshot)[i]].time;


								idx_arr[xx] = {idx:idx, contents:contents, name:name, wishtime:wishtime , phone:phone , gender:gender , part:part , process_state:process_state , memo:memo , origin:origin , reg_time:reg_time};

								xx++;

								excel = JSON.stringify(idx_arr);
								$('#excel').val(excel);


							});

				    }


				});



				var pick_count = num - 1;

			}

		}
	});
});
// 코드 배열로 받아오기
function snapshotToArray(snapshot) {
	var returnArr = [];

	snapshot.forEach(function(childSnapshot){
		var item = childSnapshot.val();
		item.key = childSnapshot.key;

		returnArr.push(item.key);

	});

	return returnArr;
}

// 배열의 길이 구하기
function arrayCounter(array) {
	if(typeof(array) == "object"){
		return array.length;
	}
	else
		return 0;
}

// 모달창에 index값 넣어주기
function addindex(obj){

	var index_val = $(obj).siblings('input').val();
	$('#index').val(index_val);
}

//update_process
function changeprocess(value){
	var index = $('#index').val();
	// alert(value);

	firebase.database().ref('users/' + index).update({
		process : value,
	});

	$('#modal1').modal('close');


}

function changeMemo(obj){
	var new_memo = $(obj).val();
	var index = $(obj).siblings().val();

	if(event.keyCode == 13){
		firebase.database().ref('users/' + index).update({
			memo : new_memo,
		});

	}


}

</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
	$( "#datepicker" ).datepicker();
});

$('#datepicker').on('change', function(){
	var a = $(this).val();

	var datePic = a.split('/');
	var align_datePic = datePic[2] + '-' + datePic[0] + '-' + datePic[1];
	// alert(align_datePic);

	$(this).val(align_datePic);

	location.href='index.php?date=' + align_datePic;
});

$('#export').click(function(){
	$('.excelform').submit();
});

</script>
</body>
</html>
