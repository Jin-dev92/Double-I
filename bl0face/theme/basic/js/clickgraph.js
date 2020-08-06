    var asd=document.getElementsByTagName('html')[0];
      var _url = window.location.href; //URL 전부 리턴
    asd.onmousedown=function(e){
      var _screensize=screen.width+"X"+document.body.scrollHeight;
      var _wsize=window.innerWidth+"X"+window.innerHeight;
      var _xpoint=e.pageX;
      var _ypoint=e.pageY;
      // console.log(document.body.clientWidth+"X"+document.body.clientHeight);
      // console.log(_wsize);
if (window.outerWidth==screen.availWidth && window.outerHeight==screen.availHeight) {
        $.ajax({
          type: "POST", // POST형식으로 폼 전
          url:_url+"theme/basic/click_graph.php", // 목적지
          data: ({xpoint:_xpoint, ypoint:_ypoint,date:getTimeStamp(), screensize:_screensize, urla:_url, wsize:_wsize}),
          cache: false,
          dataType: "text",
          timeout : 10000,
          error: function(xhr, textStatus, errorThrown) {} // 전송 실패
        });
      }
    }


function getTimeStamp() {
  var d = new Date();
  var s =
    leadingZeros(d.getFullYear(), 4) + '-' +
    leadingZeros(d.getMonth() + 1, 2) + '-' +
    leadingZeros(d.getDate(), 2) + ' ' +

    leadingZeros(d.getHours(), 2) + ':' +
    leadingZeros(d.getMinutes(), 2) + ':' +
    leadingZeros(d.getSeconds(), 2) ;

  return s;
}

function leadingZeros(n, digits) {
  var zero = '';
  n = n.toString();

  if (n.length < digits) {
    for (i = 0; i < digits - n.length; i++)
      zero += '0';
  }
  return zero + n;
}
