<?
if(!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1){
	// PC
} else {
	//MOBILE
	header("Location: /Why_bioface/M_Why_bioface");
}
?>
<style>
.sub_img{ position:relative;}
.sub_img img{ display:block; width:100%}
.sub_img .snsBox{ position:absolute; left:0; bottom:2.5%; width:100%; text-align:center; z-index:1}
.sub_img .snsBox a{ display:inline-block; width:6%; margin:0 3.5vw;}

#popup_area{position: absolute; top: 30px; right: 4%; z-index: 999; width: 440px;}
#popup_area .popup_layer{ position:relative}
#popup_area .imgBox img{ display:block}
</style>

<div id="popup_area">
    <script>
    function closeWin02(){
        document.all['popup02'].style.visibility = "hidden";
    }
    function setCookie02( name, value, expiredays ) {
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }
    function closeTodayWin02() {
        if ( document.formPopup02.chkbox ){
            setCookie02( "popup02", "done" , 1 );
        }
        document.all['popup02'].style.visibility = "hidden";
    }
    cookiedata = document.cookie;
    if ( cookiedata.indexOf("popup02=done") < 0 ){
        document.all['popup02'].style.visibility = "visible";
    } else {
        document.all['popup02'].style.visibility = "hidden";
    }
    </script>
    
      <div id="popup02" class="popup_layer" style="margin-top:5px;">
        <div id="eventpop02">
        
          <div id="theLayer02">
            <div>
              <a href="javascript:closeWin02();">
              <div style="position:absolute; right:10px; top:10px; width:35px; height:35px; "><img src="/assets/img/pop/X_w.png" style="width:100%;" alt=""></div></a>
              <a href="/board/lists/event_kor/1" class="imgBox">
                <img src="/assets/img/pop/popup_200731.jpg?<?=rand()?>" border="0" style="width: 100%;">
              </a>
            </div>
            <!--<div style="position:absolute; z-index: 14; float:left; right:4%; bottom:12px;">
              <form name="formPopup02">
                <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin02();" onfocus="this.blur();"><img src="/assets/img/pop/todayend.png" border="0"></a>
              </form>
            </div>-->
          </div>
    
        </div>
      </div>
    
    
    
        <script>
        function closeWin03(){
          document.all['popup03'].style.visibility = "hidden";
        }
        function setCookie03( name, value, expiredays ) {
         var todayDate = new Date();
          todayDate.setDate( todayDate.getDate() + expiredays );
          document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
         }
    
        function closeTodayWin03() {
          if ( document.formPopup03.chkbox ){
           setCookie03( "popup03", "done" , 1 );
          }
        document.all['popup03'].style.visibility = "hidden";
       }
       cookiedata = document.cookie;
        if ( cookiedata.indexOf("popup03=done") < 0 ){
        document.all['popup03'].style.visibility = "visible";
        }
        else {
        document.all['popup03'].style.visibility = "hidden";
        }
      </script>
    
    <div id="popup03" class="popup_layer" style="margin-top:5px;">
        <div id="eventpop03">
            <div id="theLayer03">
            <div>
            	<a href="javascript:closeWin03();">
            		<div style="position:absolute; right:10px; top:10px; width:35px; height:35px; "><img src="/assets/img/pop/X_w.png" style="width:100%;" alt=""></div>
                </a>              
                <a href="/board/lists/promotion/1" class="imgBox">
                    <img src="/assets/img/pop/popup_promotion_200723.jpg?<?=rand()?>" border="0" style="width: 100%;">
                </a>
            	</div>            
            </div>
        </div>
    </div>
    
    <script>
    function closeWin04(){
        document.all['popup04'].style.visibility = "hidden";
    }
    function setCookie04( name, value, expiredays ) {
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }
    function closeTodayWin04() {
        if ( document.formPopup04.chkbox ){
            setCookie04( "popup04", "done" , 1 );
        }
        document.all['popup04'].style.visibility = "hidden";
    }
    cookiedata = document.cookie;
    if ( cookiedata.indexOf("popup04=done") < 0 ){
        document.all['popup04'].style.visibility = "visible";
    } else {
        document.all['popup04'].style.visibility = "hidden";
    }
    </script>
    
    <div id="popup04" class="popup_layer" style="margin-top:5px;">
        <div id="eventpop04">
            <div id="theLayer04">
                <div>
                    <a href="javascript:closeWin04();">
                        <div style="position:absolute; right:10px; top:10px; width:35px; height:35px;"><img src="/assets/img/pop/X.png" style="width:100%;" alt=""></div>
                    </a>
                    <a href="/board/lists/exhibitions/1" class="imgBox">
                      	<img src="/assets/img/pop/popup_men_200723.jpg?<?=rand()?>" border="0" style="width: 100%;">
                    </a>
                </div>
                <!--<div style="position:absolute; z-index: 14; float:left; right:4%; bottom:12px;">
                    <form name="formPopup04">
                        <input type="hidden" name='chkbox' value="checkbox"><a href="javascript:closeTodayWin04();" onfocus="this.blur();"><img src="/assets/img/pop/todayend_w.png" border="0"></a>
                    </form>
                </div>-->
            </div>
        </div>
    </div>
</div>


<div class="sub_img">
	<img src="../assets/img/sub/Why_bioface/whybioface_200508.jpg?<?=rand()?>">
    <div class="snsBox">
    	<a href="https://www.facebook.com/biofacesinsa/" target="_blank"><img src="../assets/img/sub_sns01.png"></a>
        <a href="https://www.youtube.com/channel/UCVutFT6uS2peN2FscXaHSwg/featured?view_as=subscriber" target="_blank"><img src="../assets/img/sub_sns02.png"></a>
        <a href="https://www.instagram.com/bioface_clinic/" target="_blank"><img src="../assets/img/sub_sns03.png"></a>
        <a href="https://blog.naver.com/suwoni" target="_blank"><img src="../assets/img/sub_sns04.png"></a>
        <a href="https://pf.kakao.com/_xaiCuxd/" target="_blank"><img src="../assets/img/sub_sns05.png"></a>
    </div>
</div>