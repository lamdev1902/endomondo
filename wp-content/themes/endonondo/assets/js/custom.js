jQuery(function ($) {

	$('#at-box').click(function () {
		$('.fact-label.at').fadeToggle();
		$('.modalcn-bg').fadeIn();
		return false;
	});

	$('#eb-box').click(function () {
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

	$('.btn-popup').click(function () {
		var href = $(this).attr('href');
		$(href).fadeIn();
		return false;
	});
	$('.popup .close, .popup .popup-click').click(function () {
		$(this).closest('.popup').fadeOut();
		return false;
	});

	$('.hd-search a').click(function () {
		$('.toogle-menu').toggleClass('exit');
		$('.menu-main').slideToggle();
		return false;
	});

	$('.toogle-menu').click(function () {
		$(this).toggleClass('exit');
		$('.menu-main').slideToggle();
		return false;
	});

	$('.menu-main ul li.menu-item-has-children > a').click(function () {
		return false;
	});

	$('.schema-faq-question').click(function () {
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

	$('#rightSlick').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        arrows: false,
        dots: true
    });
	
	$(document).ready(function () {
		var iframe = $('.exc-hero-section iframe');

		if (iframe.length > 0) {
			var currentSrc = iframe.attr('src');

			var newSrc = currentSrc + '&background=1&title=0&byline=0&portrait=0&dnt=1&controls=0&autoplay=1&muted=1';

			iframe.attr('src', newSrc);
		}


		$('figure table').each(function () {
			var $table = $(this);
			var $ths1 = $table.find('th:nth-child(1)');
			var $ths2 = $table.find('th:nth-child(2)');
			var maxHeight = $ths2.innerHeight();
			var currentHeight = $ths1.innerHeight()

			if (maxHeight > currentHeight) {
				$ths1.height(maxHeight - currentHeight);
			}

			if ($(window).width() >= 767) {
				var $headers = $table.find('thead th');
				var $cells = $table.find('tbody td');

				var numberOfColumns = $headers.length;

				if (numberOfColumns <= 3) {
					var tableWidth = $table.width();
					var columnWidth = tableWidth / numberOfColumns;

					$headers.css('width', columnWidth + 'px');
					$cells.css('width', columnWidth + 'px');
				}
			}
		});
	});

	$(window).scroll(function () {
		var halfWay = $('body').height() * 0.25;
		if ($(window).scrollTop() >= halfWay) {
			$('.form-customer-feedback .customer-ftoggle').addClass('ani-left');
		}
	});

	customer_review_leea();
})

function customer_review_leea() {
	$('.customer-ftoggle').click(function () {
		$('html').css('overflow', 'hidden');
		$(this).addClass('ani-right');
		$(this).removeClass('ani-left');
		$('.customer-feedback').addClass('ani-fade');
		$('.form-customer-feedback').addClass('ani-fade');
		return false;
	});
	$('.form-customer-feedback .close-btn').click(function () {
		$('.customer-ftoggle').removeClass('ani-right');
		$('.customer-feedback').removeClass('ani-fade');
		$('.form-customer-feedback').removeClass('ani-fade');
		$('.form-customer-feedback .customer-ftoggle').addClass('ani-left');
		$('html').css('overflow', 'auto');
	});
	$('.rating-feedback').rating({
		maxRating: 5,
		initialRating: 3,
		readonly: false,
		step: 1,
	});
	$('.rating-feedback').change(function () {
		$('.form-feedback').show();
		$('.form-hidden-rating').val($('.rating-feedback').val());
		$('.form-hidden-link').val($('.link-post-feedback').val());
		$('.form-hidden-ip').val($('.ip-address').val());
		var d = new Date();
		var strDate = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear() + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
		$('.form-date-send').val(strDate).attr('value', strDate);
	});
	$('.form-select').parent().addClass('your-option');

	$('.form-select').change(function () {
		if ($('.form-select').val() != "") {
			$('.form-customer-feedback .your-option').addClass('hide-star');
			$('.form-select').css("color", "#000");
		} else {
			$('.form-customer-feedback .your-option').removeClass('hide-star');
		};
		if ($('.form-select').val() == "") {
			$('textarea.form-group').hide();
		} else {
			$('textarea.form-group').slideDown();
		};
		if ($('.form-select').val() == "Questions") {
			$('.form-customer-feedback .form-group-email').slideDown();
			// $(".form-customer-feedback textarea.form-group").attr("placeholder", "New placeholder text");
		} else {
			$('.form-customer-feedback .form-group-email').hide();
		};
		if ($('.form-select').val() == "Report bug") {
			$(".form-customer-feedback textarea.form-group").attr("placeholder", "Where did you have a technical problem?");
		} else {
			$(".form-customer-feedback textarea.form-group").attr("placeholder", "What would you like to share with us?");
		};
	});
	document.addEventListener('wpcf7mailsent', function () {
		$('.form-customer-feedback .mailsent').show();
		$('.form-customer-feedback .form-feedback, .form-customer-feedback .star-rating').hide();
	}, false);
}