$(document).ready(function(){

	var originalMenuHeight = $('.menu_top').outerHeight();

	$('.table_of_contents ul li a').click(function(){
		var href = $(this).attr('href');
		$(href).velocity('scroll', {
			easing: 'ease-in-out'
		});
	});

	$('.event_menu_toggle').on('click', function(e){
		e.preventDefault();
		$('.event_nav_wrap').toggleClass('open');
	})

	// $('.logo_marathon').on('click', function(e){
	// 	e.preventDefault();
	// 	$('.event_nav_wrap').toggleClass('open');
	// })

	$('.js-event-link').on('click', function(e){
		e.preventDefault();
		var href = $(e.currentTarget).attr('href');
		console.log(href);
		console.log(window.location)

		if (href == window.location.href){
			$('html').velocity("scroll", {offset: 0, easing: [300, 30], duration: 1000, mobileHA: false});
		} else {
			window.location = href;
		}
	})

	$('.js-menu-title').on('mouseenter', function(e){
		console.log(e);
		var menu = $('.menu_top');
		var dropDown = $('.drop-down-menu');
		var height = menu.outerHeight() + dropDown.outerHeight();

		menu.velocity('stop');

		menu.velocity({
			height: height
		}, {
			duration: 300
		})
	})

	$('.js-menu-title').on('mouseleave', function(e){
		var menu = $('.menu_top');
		var height = $('.menu_title').outerHeight();

		menu.velocity('stop');
		menu.velocity({
			height: height
		}, {
			duration: 300
		})
	})

	$(window).on('resize', function(){
		$('.menu_top').outerHeight($('.menu_title').outerHeight());
	})

});
