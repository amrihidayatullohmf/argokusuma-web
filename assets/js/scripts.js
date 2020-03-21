$(document).ready(function(){
	var win = window,
    doc = document,
    docElem = doc.documentElement,
    body = doc.getElementsByTagName('body')[0],
    screen_width = win.innerWidth || docElem.clientWidth || body.clientWidth,
    screen_height = win.innerHeight|| docElem.clientHeight|| body.clientHeight;

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

	var mobileslideheight = $('.mobile-main-slider').height();

	$("#homeslider").lightSlider({
		auto: true,
		vertical: true,
		item: 1,
		controls: false,
		verticalHeight: (screen_width > 768) ? 650 : (mobileslideheight - 20),
		speed: 1000,
		loop: true,
		pause: 4000
	});

	$(".show-sidebar").click(function(){
		$("#bgblack").fadeIn(100);
		$(".sidebar-menu").addClass('on');
	});
	$(".hide-sidebar").click(function(){
		$("#bgblack").fadeOut(500);
		$(".sidebar-menu").removeClass('on');
	});
	$("#bgblack").click(function(){
		$("#bgblack").fadeOut(500);
		$(".sidebar-menu").removeClass('on');
	});

	$(".init-slick-slider").each(function(){
		var o = $(this);
		var speed = (typeof o.data('speed') !== 'undefined') ? o.data('speed') : 1000;
		var onlymobile = (typeof o.data('onlymobile') !== 'undefined') ? o.data('onlymobile') : false;
	
		if(onlymobile && screen_width > 768) {
			return false;
		}

		var config = {	
				dots: o.data('dots'),
			  	infinite: o.data('infinite'),
			  	speed: speed,
			  	autoplay: o.data('autoplay'),
			  	arrows: o.data('arrow'),
			  	slidesToShow: o.data('slide'),
			  	slidesToScroll: o.data('toslide')
		    };

		if(typeof o.data('fade') !== 'undefined') {
			config['fade'] = $(o.data('fade'));		    
		} 

		if(typeof o.data('usearrowobj') !== 'undefined') {
			config['prevArrow'] = $(o.data('prev'));
			config['nextArrow'] = $(o.data('next'));		    
		} 
		if(typeof o.data('mobilefirst') !== 'undefined') {
			//config['mobileFirst'] = true;
			var center = (typeof o.data('centermode') !== 'undefined') ? o.data('centermode') : true;
			var arronmobile = (typeof o.data('arrowonmobile') !== 'undefined') ? o.data('arrowonmobile') : true;
			config['responsive'] = [
									   {
									      breakpoint: 768,
									      settings: {
									      	centerMode: center,
									      	slidesToShow: o.data('slideonmobile'),
			  							  	slidesToScroll: o.data('slideonmobile'),
			  							  	arrows:arronmobile

									  	  }
									   }
								    ];
		}

		var secure_to_initialize = true;
		var total_slide = o.children().length;

		if(screen_width > 768) {
			if(total_slide < o.data('slide')) {
				secure_to_initialize = false;
			}
		} else {
			if(total_slide < o.data('slideonmobile')) {
				secure_to_initialize = false;
			}
		}


		if(secure_to_initialize) {
			o.slick(config);
		} else {
			if(typeof o.data('usearrowobj') !== 'undefined') {
				$(o.data('prev')).hide();
				$(o.data('next')).hide();		    
			} 
		}	
	});
});