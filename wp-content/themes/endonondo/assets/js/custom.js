jQuery(function($){

	$('#at-box').click(function() {
		$('.fact-label.at').fadeToggle();
		$('.modalcn-bg').fadeIn();
		return false;
	 });

	 $('#eb-box').click(function() {
		$('.fact-label.eb').fadeToggle();
		$('.modalcn-bg').fadeIn();
		return false;
	 });

	 $(document).on('click', function (e) {
		if ($(e.target).closest(".fact-check").length === 0) {
			$('.fact-label').fadeOut();
			$('.modalcn-bg').fadeOut();
		}
	});
	 
	$('.btn-popup').click(function(){
		var href = $(this).attr('href');
		$(href).fadeIn();
		return false;
	});
	$('.popup .close, .popup .popup-click').click(function(){
		$(this).closest('.popup').fadeOut();
		return false;
	});

	$('.hd-search a').click(function(){
		$('.toogle-menu').toggleClass('exit');
		$('.menu-main').slideToggle();
		return false;
	});

	$('.toogle-menu').click(function(){
		$(this).toggleClass('exit');
		$('.menu-main').slideToggle();
		return false;
	});

	$('.menu-main ul li.menu-item-has-children > a').click(function(){
		return false;
	});
	
	$('.schema-faq-question').click(function(){
		$(this).next().slideToggle();
		return false;
	});

	$('.primary-muscle').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: false,
		arrows: true,
		responsive: [
			{
				breakpoint: 820,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			}, {
				breakpoint: 431,
				settings: {
					slidesToShow: 1
				}
			}, {
				breakpoint: 320,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});

	$('.secondary-muscle').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: false,
		arrows: true,
		responsive: [
			{
				breakpoint: 820,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			}, {
				breakpoint: 431,
				settings: {
					slidesToShow: 1
				}
			}, {
				breakpoint: 320,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});

	$('.equipment-list').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: false,
		arrows: true,
		responsive: [
			{
				breakpoint: 820,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			}, {
				breakpoint: 431,
				settings: {
					slidesToShow: 1
				}
			}, {
				breakpoint: 320,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});

	$('.variations-list').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: false,
		arrows: true,
		responsive: [
			{
				breakpoint: 820,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			}, {
				breakpoint: 431,
				settings: {
					slidesToShow: 1
				}
			}, {
				breakpoint: 320,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});

	$('.alternatives-list').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: false,
		arrows: true,
		responsive: [
			{
				breakpoint: 820,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			}, {
				breakpoint: 431,
				settings: {
					slidesToShow: 1
				}
			}, {
				breakpoint: 320,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});
	$(document).ready(function() {
			var iframe = $('.exc-hero-section iframe');
		
			if (iframe.length > 0) {
				var currentSrc = iframe.attr('src');
		
				var newSrc = currentSrc + '&background=1&title=0&byline=0&portrait=0&dnt=1&controls=0&autoplay=1&muted=1';
		
				iframe.attr('src', newSrc);
			}
		});
})