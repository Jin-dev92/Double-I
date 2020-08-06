
var jumboHeight = $('.jumbotron').outerHeight();
function parallax(){
    var scrolled = $(window).scrollTop();
    $('.jumbotron').css('background-position', 'center ' + -(scrolled * 0.2) + 'px');
}

$(window).scroll(function(e){

    parallax();

});
