$(document).ready(function() {
  $(window).scroll(function(){
    var shrinkOn=$("#header").height(), paddingAdd=$("#header").height()-2;
    if($(window).scrollTop()>shrinkOn+11)
    {
      $("#menu").css({'position':'fixed'});
      $("#theme").css({'margin-top':paddingAdd+'px'});
      $("#form-header").css({'margin-top':paddingAdd+'px'});
    }
    else
    {
      $("#menu").css({'position':'static'});
      $("#theme").css({'margin-top':'0px'});
      $("#form-header").css({'margin-top':'0px'});
    }
  });

  $('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();
	    var target = this.hash,
	    $target = $(target);
      var scrollAmount = $target.offset().top - $("#header").height() + 16;
	    $('html, body').stop().animate({
	        scrollTop: scrollAmount
	    }, 900);
	});
});
