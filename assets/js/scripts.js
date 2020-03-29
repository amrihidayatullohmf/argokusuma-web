function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

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

	$('#testimony-sliders').on('afterChange', function(event, slick, currentSlide){  
        currentSlide += 1;
        $("#counter").html(currentSlide);
    });

	$('.ajax-form-csrf').submit(function(){
		var sbt = $(this).find('.sbt'),
			ldr = $(this).find('.ldr'),
			self = $(this);

		sbt.hide();
		ldr.show();

		$.ajax({
			type : 'post',
			url : $(this).attr('action'),
			data : $(this).serialize(),
			dataType : 'json',
			success : function(d) {
				console.log(d);
				ldr.hide();
				sbt.show();

				if(d.code == 200) {
					swal('Yeay',d.msg,'success');
					self.attr('action',d.action);

					if(typeof d.directurl !== 'undefined') {
						location.href = d.directurl;
					} else if(typeof d.reload !== 'undefined') {
						location.reload();
					}
				} else {
					swal('Ops',d.msg,'error');
				}
			},
			error : function(e) {
				console.log(e);
				swal('Ops','Unknown error occured','error');
				ldr.hide();
				sbt.show();
			}
		});

		return false;
	});

	$(".load-more-content").click(function(){
		var container = $(this).data('container');
		var template = $(this).data('template');
		var nexturl = $(this).data('nexturl');
		var self = $(this);

		template = $(template).html();

		self.html('<i class="fa fa-spinner fa-spin"><i>');

		$.ajax({
			type : 'post',
			url : nexturl,
			dataType : 'json',
			success : function(d) {
				if(typeof d.rows !== 'undefined' && d.rows.length > 0) {

					Mustache.parse(template);   
					var rendered = Mustache.render(template, d);
					$(container).append(rendered);

					if(d.nexturl != '') {
						self.data('nexturl',d.nexturl);
						self.html('Load More');
					} else {
						self.html('Load More');
						self.hide();
					}
				} else {
					self.html('Load More');
					self.hide();
				}
			}, 
			error : function(e) {
				console.log(e);
				self.html('Load More');
			}
		})
	});

	if($("#blog-comment").length > 0) {
		$("#savename").val(getCookie('commentname'));
		$("#saveemail").val(getCookie('commentemail'));
		$("#savewebsite").val(getCookie('commentweb'));	
		if(getCookie('savecomment') == 1) {
			$("#saveinfocomment").prop('checked',true);
		}
	}

	$("#blog-comment").submit(function(){
		if($("#saveinfocomment").prop('checked') == true) {
			var name = $("#savename").val();
			var email = $("#saveemail").val();
			var web = $("#savewebsite").val();

			setCookie('commentname',name,10);
			setCookie('commentemail',email,10);
			setCookie('commentweb',web,10);
			setCookie('savecomment',1,10);
		} else {
			setCookie('commentname','',10);
			setCookie('commentemail','',10);
			setCookie('commentweb','',10);
			setCookie('savecomment',0,10);
		}
		return false;
	});
});



















