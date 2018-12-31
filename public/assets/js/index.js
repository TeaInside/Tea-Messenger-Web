
var i = crt("input");
	i.type = "hidden";
	i.value = "";
	i.id = "storage";
domId("_pt").appendChild(i.el);

const assets_autoload = function (callback = null) {
	loadCss("/assets/css/bootstrap.min.css", 0, 0, 0);
	loadJs("/assets/js/third_party/jquery.min.js", function () {
		loadJs("/assets/js/third_party/bootstrap.min.js", function () {
			loadJs("/assets/js/third_party/bootbox.min.js", 0, 0, 0);
			if (callback !== null) {
				callback();
			}
		}, 0, 0);
	}, 0, 0);
}

var routes = doc().createElement("script");
	routes.type = "text/javascript";
	routes.src 	= "/assets/js/routes.js";
	routes.id   = "___router";
	routes.onload = function() {
		assets_autoload(function () {
			route_handle();
		});
	};
domId("head").appendChild(routes);
window.addEventListener("hashchange", function() {
	cleanAssets();
	route_handle();
}, false);
