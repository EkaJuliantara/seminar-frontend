$(document).ready(function() {
  $(window).scroll(function(){
    var shrinkOn=$("#header").height(), paddingAdd=$("#header").height()-3;
    if($(window).scrollTop()>shrinkOn+9)
    {
      $("#menu").css({'position':'fixed'});
      $("#theme").css({'margin-top':paddingAdd+'px'});
      $("#form-header").css({'margin-top':paddingAdd+'px'});
      $("#logo").css({'margin-top':paddingAdd+'px'});
    }
    else
    {
      $("#menu").css({'position':'static'});
      $("#theme").css({'margin-top':'0px'});
      $("#form-header").css({'margin-top':'0px'});
      $("#logo").css({'margin-top':'0px'});
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

  window.sr = ScrollReveal({ reset: true });
  sr.reveal('#theme .container');
  sr.reveal('#information .container');
  sr.reveal('#speaker .columns');
  sr.reveal('#registration .container');
  sr.reveal('#footer .container');
  sr.reveal('#benefit .container');

  $("#dropdown").on('click',function(){
    $("ul.dropdown-list").slideToggle();
  });
  $("ul.dropdown-list").on('click',function(){
    $("ul.dropdown-list").slideToggle();
  });
});
