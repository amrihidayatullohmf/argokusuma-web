$(document).ready(function(){
	$("html,body").scroll(function() {
		var $height = $(this).scrollTop();
		if($height > 50) {
			$("header").addClass('on');
			$("header").find('a').removeClass('text-shadow');
		} else {
			$("header").removeClass('on');
			$("header").find('a').addClass('text-shadow');
		}
	});
});