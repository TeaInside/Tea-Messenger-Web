/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */
const xhr = function (d) {
		var ch = new XMLHttpRequest, x;
		ch.onreadystatechange = function () {
			if (this.readyState === 4) {
				d["complete"](this);
			}
		};
		ch.withCredentials = true;
		ch.open(d["type"], d["url"]);
		if (typeof d["before_send"] != "undefined") {
			d["before_send"](ch);
		}
		if (typeof d["headers"] != "undefined") {
			for(x in d["headers"]) {
				ch.setRequestHeader(x, d["headers"][x]);
			}
		}
		ch.send(d["data"]);
	}, 
	setCookie = function (cname, cvalue, exdays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	    var expires = "expires="+d.toUTCString();
	    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	},
	getCookie = function (cname) {
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i = 0; i < ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0) == ' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length, c.length);
	        }
	    }
	    return "";
	},
	crt = function (e) {
		return new creator(e, 0);
	},
	crn = function (e) {
		return new creator(e, 1);
	},
	doc = function (){
		return document;
	}, 
	domId =function (id) {
		return doc().getElementById(id);
	},
	domClass = function (cls) {
		return doc().getElementsByClassName(cls);
	},
	view = function (name, callback) {
		var s = doc().createElement("div"),
			b = doc().createElement("script");
			bod = domId("body");
			s.id =  "view";
			var viewCallback = function () {
				s.appendChild(b);
				callback();
			};
			b.type = "text/javascript";
			b.appendChild(doc().createTextNode("props = {}; renderer((new "+name+"(props)).render());"));
			if (eval("typeof "+name+" !== \"function\"")) {
				var a = doc().createElement("script");
				a.src = "assets/js/app/"+name+".js";
				a.type = "text/javascript";
				if(a.readyState) {
					a.onreadystatechange = function() {
						if ( a.readyState === "loaded" || a.readyState === "complete") {
							a.onreadystatechange = null;
							viewCallback();
						}
					};
				} else {
					a.onload = function() {
						viewCallback();
					};
				}
				s.appendChild(a);
				bod.innerHTML = "";
				console.log(s);
				bod.appendChild(s);
			} else {
				bod.innerHTML = "";
				console.log(s);
				bod.appendChild(s);
				viewCallback();
			}
			
	}, 
	renderer = function (view) {
		if (typeof view === "string") {
			domId("view").innerHTML += view;
		} else {
			domId("view").appendChild(view);
		}
	},
	setTitle = function (title) {
		document.getElementsByTagName("title")[0].innerHTML = title;
	},
	loadCss = function (url, callback) {
		var _ = doc().createElement("link");
			_.rel = "stylesheet";
			_.type = "text/css";
			_.href = url;
		if (typeof callback != "undefined") {
			if(_.readyState) {
				_.onreadystatechange = function() {
					if ( _.readyState === "loaded" || _.readyState === "complete") {
						_.onreadystatechange = null;
						callback();
					}
				};
			} else {
				_.onload = function() {
					callback();
				};
			}
		}
		return domId("head").appendChild(_);
	},
	loadJs = function (url, callback) {
		var _ = doc().createElement("script");
			_.type = "text/javascript";
			_.src = url+"?time="+(new Date());
		if (typeof callback != "undefined") {
			if(_.readyState) {
				_.onreadystatechange = function() {
					if ( _.readyState === "loaded" || _.readyState === "complete") {
						_.onreadystatechange = null;
						callback();
					}
				};
			} else {
				_.onload = function() {
					callback();
				};
			}
		}
		return domId("head").appendChild(_);
	},
	br = function (n=1) {
		if (n > 1) {
			var nx = {"arr__":1};
			for(;n--;)
				nx["a"+n] = crt("br");
			return nx;
		}
		return crt("br");
	},
	rerouting = function (to) {
		window.location.hash = "";
		domId("___router").src = "assets/js/routes.js";
	};