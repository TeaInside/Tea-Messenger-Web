
var routes = doc().createElement("script");
	routes.type = "text/javascript";
	routes.src 	= "/assets/js/routes.js";
	routes.id   = "___router";
	routes.onload = function() {
		route_handle(); 
	};
domId("head").appendChild(routes);
hl("js", "/assets/js/config.js", function () {
	// hl("css", "/assets/css/bootstrap.min.css");
	hl("js", "/assets/js/third_party/jquery.min.js", function () {
		hl("js", "/assets/js/third_party/bootstrap.min.js");
	});	
});
window.addEventListener("hashchange", function() {
	domId("head").innerHTML = " <meta charset=\"UTF-8\"><title></title>";
	route_handle(); 
}, false);
