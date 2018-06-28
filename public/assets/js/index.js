
const assets_autoload = function () {
	loadCss("/assets/css/bootstrap.min.css");
	loadJs("/assets/js/third_party/jquery.min.js", function () {
		loadJs("/assets/js/third_party/bootstrap.min.js", function () {
			loadJs("/assets/js/third_party/bootbox.min.js");
		});
	});
}

var routes = doc().createElement("script");
	routes.type = "text/javascript";
	routes.src 	= "/assets/js/routes.js";
	routes.id   = "___router";
	routes.onload = function() {
		assets_autoload();
		route_handle();
	};
domId("head").appendChild(routes);
window.addEventListener("hashchange", function() {
	domId("head").innerHTML = " <meta charset=\"UTF-8\"><title></title>";
	route_handle(); 
}, false);
