$(document).ready(function($) {

	$('.input_phone').mask('+7 (000) 000-00-00');

	$('.nav-block > ul > li > a').click(function(event) {
		event.preventDefault();
		var li = $(this).parents('li'),
				ul = li.find('ul');

		li.toggleClass('selected');
		ul.slideToggle(300);
	});

	$('.nav-block li').each(function(index, el) {
		if ($(this).hasClass('selected')) {
			$(this).find('ul').show();
		}
	});

	function valueElementForm(nameElement) {
		var newNameElement = '.' + nameElement;
			element = $(newNameElement);
		element.each(function(index, el) {
			var elementInput = $(this).find($('input')),
				elementLabel = $(this).find($('label')),
				elementValue = index + 1;
			elementInput.attr('id', nameElement + '-' + elementValue);
			elementLabel.attr('for', nameElement + '-' + elementValue);
		});
		
	}
	valueElementForm('checkbox');
	
	var mobileBtn = $('.panel__mobile-btn'),
			mobileNav = $('.panel__nav');

	mobileBtn.click(function(event) {
		mobileBtn.toggleClass('panel__mobile-btn_toggle');
		mobileNav.toggleClass('panel__nav_toggle');
	});


});
