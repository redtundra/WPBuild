/*

	Adds a placeholder string to any input

	Matt Vickers 2011 - http://envexlabs.com
	
	- -
	
	Usage:
	
	<input type="text" value="" title="This is the placeholder" />
	
	$('input[type=text]').input_text();

*/

$.fn.input_text = function(){
	
	var $this = $(this);
	
	$this.each(function(i,el){

		var $el = $(el);

		var original_text = $el.attr('title');

		if($el.val() == ''){
			
			$el.val($el.attr('title'));
			
		}

		$el.focus(function(){
			
			var $this = $(el);

			if($this.val() == original_text){

				$this.val('');
				$this.addClass('active');

			}

			})
		
		$el.blur(function(){

			if($el.val() == ''){

				$el.val($el.attr('title'));
				$el.removeClass('active');

			}

		});

	});
	
}