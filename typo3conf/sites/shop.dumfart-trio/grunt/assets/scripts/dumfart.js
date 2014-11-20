$(document).ready(function($) {
	equalHeights('.equal-heights', '.caption', 0);
	$(window).resize(function() {
		equalHeights('.equal-heights', '.caption', 0);
	});
})(jQuery);