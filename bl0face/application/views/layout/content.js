function close_hash(){
$(".hash_con").removeClass("up");
}
$(".hash").click(function(){
  var idx = $(".hash").index(this);
 $(".hash_con").eq(idx).addClass("up");
})
