<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
  header("Location: /Filler/M_fullface_filler?approach=keyword");
}
$this->load->view('db_top');

?>
<style>
  html, body { min-width: 100px; }
	.header_wrap  { display: block !important; position: fixed; top: 0;}
  .sub_img { margin-top: 140px;}
	.sub_img img{ width: 100%; position: relative; margin-top: 50px; margin-bottom: -10px;}
  @media (max-width: 600px){
    .sub_img {margin-top: 0;}
  }
</style>

<div class="sub_img" style="">
	<img src="../assets/img/sub/filler/fullface_filler01.jpg?<?=rand()?>" style="max-width: 800px; margin: 0 auto; display: block;">
  
  <div style="display: block; max-width: 800px; width: 100%; margin: 0 auto; padding: 50px 0;">
    <video src="../assets/img/sub/filler/fuller_injection.mp4" controls autoplay style="width: 100%;">
     FILLER 
    </video>
  </div>

  <img src="../assets/img/sub/filler/fullface_filler02.jpg?<?=rand()?>" style="max-width: 800px; margin: 0 auto; display: block;">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>

<script>
// Initialize Firebase
// Initialize Firebase
var config = {
apiKey: "AIzaSyBLu9YRqUeo9mtWP5ZYIlDlRhl_UIxYJ3E",
authDomain: "bioface-eventbodydb-page.firebaseapp.com",
databaseURL: "https://bioface-eventbodydb-page.firebaseio.com",
projectId: "bioface-eventbodydb-page",
storageBucket: "",
messagingSenderId: "915886467696"
};
firebase.initializeApp(config);
</script>
<script type="text/javascript">
var trigger_idx=0;

$(".real_trigger").click(function(){
if (trigger_idx ==0) {
  $(".top_form").animate({"bottom":0},300);
  trigger_idx=1;
}else {
  $(".top_form").animate({"bottom":"-250px"},300);
  trigger_idx=0;
}

$('.modal').modal();
$(".submitBtn").click(function(){
var date = '<?=DATE("Y-m-d H:i:s",time())?>';
var name = $(".name").val();
var content = '<?=$_GET['approach']?>';
var phone1 = $(".phone1").val();
var agree = $(".agree").val();
var come = $(".approach").val();
if (come=="") {
  $(".approach").val("불명");
}

if(name==""){
  alert('이름을 입력해주세요.');
  $('.name').focus();
  return false;
}

var kor_check = /([^가-힣ㄱ-ㅎㅏ-ㅣ\x20])/i;
if (kor_check.test(name)) {
  alert("이름은 한글만 입력할 수 있습니다.");
  $(".name").val("");
  $(".name").focus();
  return false;
}

// if (content== false) {
//   alert("관심부위을 선택해주세요");
//   $(".content").focus();
//   return false;
// }

if ($(".phone1").val()=="") {
  alert("전화번호를 다시 한 번 확인해 주세요");
  $(".phone1").focus();
  return false;
}

var num_check=/^[0-9]*$/;
var phone_val1 =$(".phone1").val();

if (num_check.test(phone_val1)) {
  if ($(".phone1").val().length<10||$(".phone1").val().length>11) {
    alert("전화번호를 올바르게 넣어주세요.");
    $(".phone1").focus();
    return false;
  }
}else {
  alert("숫자만 입력할 수 있습니다.");
  $(".phone1").focus();
  return false;
}

if($('.agree').is(":checked") == false) {
  alert('이용약관에 동의해주세요.');
  return false;
}


  var arr_size;

  firebase.database().ref('fullface_filler/users/').once('value').then(function(snapshot){
    
    arr_size  = arrayCounter(snapshotToArray(snapshot));

      
    var userKey = firebase.database().ref().push().key;

    firebase.database().ref('fullface_filler/users/' + userKey).set({
      name : name,
      phone : phone1,
      contents: content,
      can_date : '',
      time: date, 
      origin : come,
      process : "미확인",
      memo : "",
      idx : arr_size + 1,
    });

    alert('신청해주셔서 감사합니다.');
    location.href = 'http://www.bioface.kr';
    

  });

})


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
  else{
    return 0;
  }
} 

});
</script>