var login = (function(){
	// cahe DOM
	var $container = $("body > #container");

	init();

	function init() {
		_setBackground();
	}

	function _setBackground() {
		var image_url = $container.data('background');
		$("html").css('background-image', 'url('+image_url+')');
	}
})();