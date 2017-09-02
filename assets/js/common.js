jQuery.fn.center = function () {
    this.css("position", "absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
};

function popup(page) {
  $('.popup .glyphicon-remove-circle, .popup button.btn-close').bind('click', function() {
    $('.wrapper').fadeOut('fast');
    $('.popup').fadeOut('fast');
  });
  
  $('.wrapper').fadeIn('fast');
  $('.popup.' + page).fadeIn('fast');
  $('.popup.' + page).center();
  return false;
};

$(document).click(function (event) {
  var clickover = $(event.target);
  var $navbar = $(".navbar-collapse");
  var _opened = $navbar.hasClass("in");
  if (_opened === true && !clickover.hasClass("navbar-toggle")) {
    $("button.navbar-toggle").trigger("click");
  }
});

function getDayOfTheWeek(date) {
	var week = new Array('일', '월', '화', '수', '목', '금', '토');
	var today = new Date(date).getDay();
	return week[today];
}
