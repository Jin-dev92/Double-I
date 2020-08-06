function initMap2(numb){
  $(".modal_in_wrap").append('<div id="map2" style="width:100%;height:300px;"></div>');
    var map_position = new naver.maps.LatLng(37.517407, 127.021299)
    var map = null;
           map = new naver.maps.Map('map2'+numb, {
               center: map_position,
               zoom: 17
     });
     var marker = new naver.maps.Marker({
       position: new naver.maps.LatLng(37.517407, 127.021299),
       map: map
     });
}
function initMap(){
 //  $(".modal_in_wrap").append('<div id="map" style="width:100%;height:300px;"></div>');
    var map_position = new naver.maps.LatLng(37.517407, 127.021299)
    var map = null;
           map = new naver.maps.Map('map', {
               center: map_position,
               zoom: 17
     });
     var marker = new naver.maps.Marker({
       position: new naver.maps.LatLng(37.517407, 127.021299),
       map: map
     });
}

initMap();
var map_idx = 0;
var chat_idx = 0;
$(document).ready(function(){

  $(".dropdown-trigger").dropdown();
 $('.sidenav').sidenav();
 $('.fixed-action-btn').floatingActionButton();
 $(".modal").modal({
 dismissible: true, // Modal can be dismissed by clicking outside of the modal
 opacity: .3, // Opacity of modal background
 inDuration: 300, // Transition in duration
 outDuration: 200, // Transition out duration
 ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
   $("#modal1").css("bottom","10px");
 }
});
});

  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyAXgYONpV1OhVQlHMqUapgAa9f-9HdHQV0",
    authDomain: "biogcm-185509.firebaseapp.com",
    databaseURL: "https://biogcm-185509.firebaseio.com",
    projectId: "biogcm-185509",
    storageBucket: "biogcm-185509.appspot.com",
    messagingSenderId: "671096069432"
  };
   var defaultApp =firebase.initializeApp(config);
  var defaultStorage = defaultApp.storage();
  var database = firebase.database();
  var newPostKey = firebase.database().ref().push().key;

  // 엔터누를 시 서브밋
  function enter_submit(){
    if (event.keyCode=13) {
      writeUserData();
    }
  }


//글 입력시 DB전송
function writeUserData() {
 chat_idx++;
 var chat_random_idx= firebase.database().ref().push().key;
 name = newPostKey;
 timestamp = + new Date();
 title = $("#chat_message").val();
 if (title=="") {
   $('#modal2').modal('open');
   return false;
 }
 firebase.database().ref('users/gest/'+newPostKey+"/"+chat_random_idx).set({
   title:title,
   time:timestamp,
   ip:ip()
 });

 var mychat = "";
 mychat +='<div class="my_chat chat_'+chat_idx+'"><div class="row"><div class="col s9"><p class="my_bak z-depth-1">'+title+'</p></div> <div class="col s3"><div class="circle bol center valign-wrapper z-depth-1">';
 mychat +='<span style="width:100%; text-align:center">나</span></div></div></div></div>';
 $(".modal_in_wrap").append(mychat);
 $("#chat_message").val("");
 if (title.indexOf("안녕") != '-1' ||title.indexOf("ㅎㅇ") != '-1'||title.indexOf("하이") != '-1'||title.indexOf("반가") != '-1') {
   chat_idx++;
   var botchat = "";
   botchat +='<div class="bio_chat chat_'+chat_idx+'"><div class="row"><div class="col s3"><div class="circle bol center valign-wrapper z-depth-1"><span style="width:100%; text-align:center">비오봇</span></div></div><div class="col s9"><p class="bio_bak z-depth-1">반갑습니다 : ) 비오봇이라고 불러주세요!<br>무엇을 도와 드릴까요?</p></div> ';
   botchat +='</div></div>';
   $(".modal_in_wrap").append(botchat);

 }
 if (title.indexOf("비용") != '-1' ||title.indexOf("가격") != '-1'||title.indexOf("얼마") != '-1'||title.indexOf("반가") != '-1') {
   chat_idx++;
   var botchat = "";
   botchat +='<div class="bio_chat"><div class="row"><div class="col s3"><div class="circle bol center valign-wrapper z-depth-1"><span style="width:100%; text-align:center">버오봇</span></div></div><div class="col s9"><p class="bio_bak z-depth-1">비용 같은 경우는 성함과 전화번호 남겨주시면,<br> 담당자에게 연락할 수 있도록 조치해두겠습니다.</p></div> ';
   botchat +='</div></div>';
   var botchat2="";
   botchat2 +='<div class="bio_chat chat_'+chat_idx+'"><div class="row"><div class="input-field col s12"><input id="input_text" type="text" class="form_name" data-length="10"><label for="input_text">성함</label></div>';
   botchat2 +='<div class="input-field col s12"><input id="input_text" class="form_phone" type="text" data-length="10"><label for="input_text">전화번호</label></div><div class="col s12"><a class="btn" onclick="consult_submit()">전송</a></div></div></div>';
   $(".modal_in_wrap").append(botchat);
   $(".modal_in_wrap").append(botchat2);
 }
 if (title.indexOf("비오봇") != '-1' ||title.indexOf("야") != '-1'||title.indexOf("비오야") != '-1') {
   chat_idx++;
   var botchat = "";
   botchat +='<div class="bio_chat"><div class="row"><div class="col s3"><div class="circle bol center valign-wrapper z-depth-1"><span style="width:100%; text-align:center">버오봇</span></div></div><div class="col s9"><p class="bio_bak z-depth-1">네! 무엇을 도와드릴까요?</p></div> ';
   botchat +='</div></div>';
   $(".modal_in_wrap").append(botchat);
 }
 if (title.indexOf("가는 길") != '-1' ||title.indexOf("위치") != '-1'||title.indexOf("지도") != '-1') {
   chat_idx++;
   map_idx++;
   var map_chat = '<div class="bio_chat"><div class="row"><div class="col s12"><div id="map'+map_idx+'" style="width:1000px;height:400px; max-width:100%;"></div></div></div></div>';
   var botchat = "";
   botchat +='<div class="bio_chat"><div class="row"><div class="col s3"><div class="circle bol center valign-wrapper z-depth-1"><span style="width:100%; text-align:center">버오봇</span></div></div><div class="col s9"><p class="bio_bak z-depth-1">이쪽 길로 오시면 됩니다!</p></div> ';
   botchat +='</div></div>';
   $(".modal_in_wrap").append(botchat);
   $(".modal_in_wrap").append(map_chat);
   initMap2(map_idx);
 }
   var posi = $(".modal_in_wrap").height();
   $(".modal-content").animate({"scrollTop":posi},1000);

 }


 function consult_submit(){
   chat_idx++;
   timestamp = + new Date();
   firebase.database().ref('consult/'+newPostKey+"/").set({
     name:$(".form_name").val(),
     phone:$(".form_phone").val(),
     time:timestamp,
     ip:ip()
   });
   var botchat = "";
   botchat +='<div class="bio_chat"><div class="row"><div class="col s3"><div class="circle bol center valign-wrapper z-depth-1"><span style="width:100%; text-align:center">비오봇</span></div></div><div class="col s9"><p class="bio_bak z-depth-1">금방 답변드리겠습니다. 조금 더 홈페이지를 구경해주세요.</p></div> ';
   botchat +='</div></div>';
   $(".odal_in_wrap").append(botchat);
   $(".modal_in_wrap").scrollTop($("chat_"+chat_idx).height());

 }
 function usersUpdate(){
   firebase.database().ref('users/gest/'+newPostKey+"/"+chat_random_idx).set({
     username:name,
     time:title,
     ip:ip()
   });
 }





var userRef = this.database.ref('users/gest/');
 userRef.off();
userRef.orderByChild("username").once('value',  function(snapshot) {

});
