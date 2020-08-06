<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>비오페이스</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- Compiled and minified JavaScript -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
<link rel="stylesheet" href="assets/css/materialize.min.css">
</head>
<style>
img {
	max-width: 100%;
}
nav a{color: #333!important;}

</style>
<body>
	<div class="navbar-fixed">


	<nav class="nav-extended">
		<div class="container">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Logo</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a class="active" href="#test1">페이스 피스토</a></li>
        <li class="tab"><a  href="#test2">바디피스토</a></li>
      </ul>
    </div>
  </nav>
  <div id="test1" class="col s12" style="padding-top:112px;"><img src="assets/img/top.jpg"></div>
  <div id="test2" class="col s12" style="padding-top:112px;">


<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
	 width="600px" height="100px" viewBox="0 0 600 100">
<style type="text/css">
body{
  background: black;
}

.info {
  color: white;
  font:1em/1 sans-serif;
  text-align: center;
}

.info a{
  color: white;
}

svg{
  width: 600px;
  height: 120px;
  display: block;
  position: relative;
  overflow: hidden;
  margin: 0 auto;
  background: black;
}


	text {
		filter: url(#filter);
		fill: white;
    	font-family: 'Share Tech Mono', sans-serif;
    	font-size: 100px;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
     		}


</style>
	<defs>

		<filter id="filter">
		    <feFlood flood-color="black" result="black" />
		    <feFlood flood-color="red" result="flood1" />
		    <feFlood flood-color="limegreen" result="flood2" />
			<feOffset in="SourceGraphic" dx="3" dy="0" result="off1a"/>
			<feOffset in="SourceGraphic" dx="2" dy="0" result="off1b"/>
			<feOffset in="SourceGraphic" dx="-3" dy="0" result="off2a"/>
			<feOffset in="SourceGraphic" dx="-2" dy="0" result="off2b"/>
		    <feComposite in="flood1" in2="off1a" operator="in"  result="comp1" />
		    <feComposite in="flood2" in2="off2a" operator="in" result="comp2" />

 		  	<feMerge x="0" width="100%" result="merge1">
				<feMergeNode in = "black" />
				<feMergeNode in = "comp1" />
				<feMergeNode in = "off1b" />

				<animate
					attributeName="y"
		    		id = "y"
		    		dur ="4s"

		    		values = '104px; 104px; 30px; 105px; 30px; 2px; 2px; 50px; 40px; 105px; 105px; 20px; 6ßpx; 40px; 104px; 40px; 70px; 10px; 30px; 104px; 102px'

		    		keyTimes = '0; 0.362; 0.368; 0.421; 0.440; 0.477; 0.518; 0.564; 0.593; 0.613; 0.644; 0.693; 0.721; 0.736; 0.772; 0.818; 0.844; 0.894; 0.925; 0.939; 1'

		    		repeatCount = "indefinite" />

				<animate attributeName="height"
		    		id = "h"
		    		dur ="4s"

		    		values = '10px; 0px; 10px; 30px; 50px; 0px; 10px; 0px; 0px; 0px; 10px; 50px; 40px; 0px; 0px; 0px; 40px; 30px; 10px; 0px; 50px'

		    		keyTimes = '0; 0.362; 0.368; 0.421; 0.440; 0.477; 0.518; 0.564; 0.593; 0.613; 0.644; 0.693; 0.721; 0.736; 0.772; 0.818; 0.844; 0.894; 0.925; 0.939; 1'

		    		repeatCount = "indefinite" />
		    </feMerge>


 			<feMerge x="0" width="100%" y="60px" height="65px" result="merge2">
				<feMergeNode in = "black" />
				<feMergeNode in = "comp2" />
				<feMergeNode in = "off2b" />

				<animate attributeName="y"
		    		id = "y"
		    		dur ="4s"
		    		values = '103px; 104px; 69px; 53px; 42px; 104px; 78px; 89px; 96px; 100px; 67px; 50px; 96px; 66px; 88px; 42px; 13px; 100px; 100px; 104px;'

		    		keyTimes = '0; 0.055; 0.100; 0.125; 0.159; 0.182; 0.202; 0.236; 0.268; 0.326; 0.357; 0.400; 0.408; 0.461; 0.493; 0.513; 0.548; 0.577; 0.613; 1'

 		    		repeatCount = "indefinite" />

				<animate attributeName="height"
		    		id = "h"
		    		dur = "4s"

					values = '0px; 0px; 0px; 16px; 16px; 12px; 12px; 0px; 0px; 5px; 10px; 22px; 33px; 11px; 0px; 0px; 10px'

		    		keyTimes = '0; 0.055; 0.100; 0.125; 0.159; 0.182; 0.202; 0.236; 0.268; 0.326; 0.357; 0.400; 0.408; 0.461; 0.493; 0.513;  1'

		    		repeatCount = "indefinite" />
		    </feMerge>

		 	<feMerge>
 				<feMergeNode in="SourceGraphic" />

				<feMergeNode in="merge1" />
 			<feMergeNode in="merge2" />

		    </feMerge>
	    </filter>

	</defs>

<g>
	<text x="0" y="100">BIOFACE</text>
</g>
</svg>
	</div>
	</div>
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
$(document).ready(function() {
	$('select').material_select();
	$('.modal').modal();
});

$('.submit').click(function(){
	var date = '<?=DATE("Y-m-d H:i:s",time())?>';


	var name = $('.name').val();
	var phone1 = $('.phone1 option:selected').val();
	var phone2 = $('.phone2').val();
	var phone3 = $('.phone3').val();
	var phone = phone1 + '-' + phone2 + '-' + phone3;
	var gender = $('.gender option:selected').val();
	var wishtime = $('.wishtime option:selected').val();
	var contents = $('.contents').val();
	var part = $('.part option:selected').val();
	var origin = '<?=$_GET[origin]?>';

	if(name == ''){
		alert('이름을 입력해주세요.');
		$('.name').focus();

		return false;
	}

	var kor_check = /([^가-힣ㄱ-ㅎㅏ-ㅣ\x20])/i;
	if (kor_check.test(name)) {
		alert("한글만 입력할 수 있습니다.");
		$(".name").val("");
		$(".name").focus();
		return false;
	}


	if ($(".phone2").val()=="" || $(".phone3").val()=="") {
        alert("다시 한 번 올바르게 입력해 주세요");
        $(".phone2").focus();
        return false;
      }

      if ($(".phone3").val().length!=4) {
        alert("다시 한 번 올바르게 입력해 주세요");
        $(".phone3").focus();
        return false;
      }

      var num_check=/^[0-9]*$/;
      var phone_val1 =$(".phone2").val();
      var phone_val2 =$(".phone3").val();
      if (num_check.test(phone_val1)) {
        if ($(".phone2").val().length<3||$(".phone2").val().length>4) {
          alert("전화번호를 올바르게 넣어주세요.");
          $(".phone2").focus();
          return false;
        }
      }else {
        alert("숫자만 입력할 수 있습니다.");
        $(".phone2").focus();
        return false;
      }
      if (num_check.test(phone_val2)) {
        if ($(".phone3").val().length!=4) {
          alert("다시 한 번 올바르게 입력해 주세요");
          $(".phone3").focus();
          return false;
        }
      }else {
        alert("숫자만 입력할 수 있습니다.");
        $(".phone3").focus();
        return false;
      }

	if($('.check_check').is(":checked") == false) {
		alert('이용약관에 동의해주세요.');
		return false;
	}

	var arr_size;

	firebase.database().ref('/users/').once('value').then(function(snapshot){

		arr_size  = arrayCounter(snapshotToArray(snapshot));


		var userKey = firebase.database().ref().push().key;

		firebase.database().ref('users/' + userKey).set({
			name : name,
			phone : phone,
			gender : gender,
			part: part,
			wishtime : wishtime,
			contents: contents,
			time: date,
			origin : "바로연",
			process : "미확인",
			memo : "",
			idx : arr_size + 1,

		});

		alert('신청해주셔서 감사합니다.');
		location.href = 'http://www.bioface.kr';


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
</script>
</body>
</html>
