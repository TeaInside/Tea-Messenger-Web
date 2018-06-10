
var routes = doc().createElement("script");
	routes.type = "text/javascript";
	routes.src 	= "/assets/js/routes.js";
	routes.id   = "___router";
	routes.onload = function() { route_handle(); };
domId("head").appendChild(routes);
window.addEventListener("hashchange", function() { route_handle(); }, false);
