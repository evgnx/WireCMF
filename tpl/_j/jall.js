

$(function(){
	
  var sampler = $('#sampler');	
	
  $('#off').click(function(){
   if($('#sampler').css('display') != 'none') {
  	 $('#sampler').css('display','none');
   } else {
	   $('#sampler').css('display','block');
   }
  
  });
	
  var slider = $('#slider1').bxSlider({
	   	displaySlideQty: 3,
    	moveSlideQty: 1,
		spped: 250,
    	controls: false
  });



  $('#go-prev').click(function(){
    slider.goToPreviousSlide();
    return false;
  });

  $('#go-next').click(function(){
    slider.goToNextSlide();
    return false;
  });
});	