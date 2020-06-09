
    var asd=document.getElementsByTagName('html')[0];
    asd.onclick=function(e){
      var _xpoint=e.pageX;
      var _ypoint=e.pageY;
        console.log("X:"+xpoint+" Y:"+ypoint+" 시간:"+getTimeStamp());
        console.log(screen.width+"X"+screen.height);
    //     $.ajax({
    //       type: "POST", // POST형식으로 폼 전송
    //       url: "commentajax.php", // 목적지
    //       timeout: 10000,
    //       data: ({xpoint: _xpoint, ypoint:_ypoint,time:getTimeStamp()}),
    //       cache: false,
    //       dataType: "text",
    //       error: function(xhr, textStatus, errorThrown) { // 전송 실패
    //       alert("전송에 실패했습니다.");
    // }
    //     });
    }



function getTimeStamp() {
  var d = new Date();
  var s =
    leadingZeros(d.getFullYear(), 4) + '-' +
    leadingZeros(d.getMonth() + 1, 2) + '-' +
    leadingZeros(d.getDate(), 2) + ' ' +

    leadingZeros(d.getHours(), 2) + ':' +
    leadingZeros(d.getMinutes(), 2) + ':' +
    leadingZeros(d.getSeconds(), 2);

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
