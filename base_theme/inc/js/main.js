(function($){

	/*
		
		Slider

	*/

	if($('#slider').length){
		
		$('#slider').nivoSlider({
	        effect: 'random',
	        slices: 15,
	        animSpeed: 500,
	        pauseTime: 3000,
	        directionNav: true,
	        directionNavHide: true,
	        controlNav: true
	    });
		
	}

})(this.jQuery);