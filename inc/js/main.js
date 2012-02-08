(function($){

	$('input[type=text]').input_text();

	$('.toggle label').click(function(){
		
		var $this = $(this);

		$this.parent().find('input').change();

		console.log($this.parent().find('input').change());

		// $this.parent().find('label').removeClass();
		// $this.prev('input').attr('checked', 'checked');
		// $this.addClass('active');



	});

	$('.toggle input').on('change', function(){
		
		$(this).parent().parent().toggleClass('on');

	});

	$('#download input').click(function(e){
		
		var $this = $(this);

		$this.addClass('building').val('Building');

		setTimeout(function(){
			
			$this.removeClass('building').val('Built & Downloading. Enjoy!');

		}, 1500);

	});

})(this.jQuery);
