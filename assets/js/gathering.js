$(function() {
	$('html').keydown(function(e) {
		var screenWidth = $('.carousel-inner').css('width');
		var fontSize = $('.pGroup').css('font-size');
		var fontSizeWV = (parseFloat(100) / (parseFloat(screenWidth) / parseFloat(fontSize))).toFixed(2);

    if(e.keyCode === 13 || e.keyCode === 39) {
			if($('.popup.help').css('display') === 'none')
      	$('.glyphicon-chevron-right').trigger('click');
			else
				$('.popup.help .btn-close').trigger('click');
    }
    else if(e.keyCode === 37)
      $('.glyphicon-chevron-left').trigger('click');
		else if(e.keyCode === 187)
			$('.pGroup').css('font-size', parseFloat(screenWidth) / (parseFloat(100) / (parseFloat(fontSizeWV) + 0.25)));
		else if(e.keyCode === 189)
			$('.pGroup').css('font-size', parseFloat(screenWidth) / (parseFloat(100) / (parseFloat(fontSizeWV) - 0.25)));
		else if(e.keyCode === 191)
			popup('help');
		else if(e.keyCode === 70)
			$('footer').toggle();
		else if(e.keyCode === 72)
			$('nav').toggle();
	});
	popup('help');
});
