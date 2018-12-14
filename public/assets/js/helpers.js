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
		ch.withCredentials = false;
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
	domId =function (id) {
		return doc().getElementById(id);
	},
	domClass = function (cls) {
		return doc().getElementsByClassName(cls);
	},
	domTag = function (tag)  {
		return doc().getElementsByTagName(tag);
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
	asset = function(e) {
		return config.assets_url+"/"+e;
	},
	view = function (name, callback) {
		var s = doc().createElement("div"),
			b = doc().createElement("script");
			bod = domId("body");
			s.id =  "view";
			var viewCallback = function () {
				s.appendChild(b);
				if (typeof callback == "function") {
					callback();
				}
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
				bod.appendChild(s);
			} else {
				bod.innerHTML = "";
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
	hashGet = function () {
		try {
			return JSON.parse(domId("storage").value);
		} catch(e) {
			return {
				"hash_checker": {},
				"js_delete_queue": {},
				"css_delete_queue": {}
			};
		}
	},
	hashCheck = function (str) {
		var q = hashGet();
		return typeof q[str] != "undefined";
	},
	hashAdd = function (str) {
		var q = hashGet();
		q["hash_checker"][str] = 1;
		domId("storage").value = JSON.stringify(q);
	},
	hashDelete = function (str) {
		var q = hashGet();
		q["hash_checker"][str] = null;
		domId("storage").value = JSON.stringify(q);	
	},
	unloadJs = function (url) {
		var q = domTag("script");
		for(var i = 0; i < q.length; i++) {
			if (q[i].src === url) {
				return q[i].parentNode.removeChild(q[i]);
			}
		}
		return false;
	},
	unloadCss = function (url) {
		var q = domTag("link");
		for(var i = 0; i < q.length; i++) {
			if (q[i].href === url) {
				return q[i].parentNode.removeChild(q[i]);
			}
		}
		return false;
	},
	loadCss = function (url, callback, force = 0, tmp = 1, hard = 0) {
		if (hashCheck(url) && (!force)) {
			return;
		}
		hashAdd(url);
		var _ = doc().createElement("link");
			_.rel = "stylesheet";
			_.type = "text/css";
			_.href = url;
		if (typeof callback == "function") {
			if(_.readyState) {
				_.onreadystatechange = function() {
					if ( _.readyState === "loaded" || _.readyState === "complete") {
						_.onreadystatechange = null;
						hashAdd(url);
						callback();
					}
				};
			} else {
				_.onload = function() {
					hashAdd(url);
					callback();
				};
			}
		} else {
			_.onload = function() {
				hashAdd(url);
			}
		}
		if (tmp) {
			var hs = hashGet();
				hs["css_delete_queue"][_.href] = 1;
				domId("storage").value = JSON.stringify(hs);
		}
		return domId(hard ? "_pt" : "head").appendChild(_);
	},
	loadJs = function (url, callback, force = 0, tmp = 1, hard = 0) {
		if (hashCheck(url) &&  (!force)) {
			return;
		}
		var _ = doc().createElement("script");
			_.type = "text/javascript";
			_.src = url;
		if (typeof callback == "function") {
			if(_.readyState) {
				_.onreadystatechange = function() {
					if ( _.readyState === "loaded" || _.readyState === "complete") {
						_.onreadystatechange = null;
						hashAdd(url);
						callback();
					}
				};
			} else {
				_.onload = function() {
					hashAdd(url);
					callback();
				};
			}
		} else {
			_.onload = function () {
				hashAdd(url);
			}
		}
		if (tmp) {
			var hs = hashGet();
				hs["js_delete_queue"][_.src] = 1;
				domId("storage").value = JSON.stringify(hs);
		}
		return domId(hard ? "_pt" : "head").appendChild(_);
	},
	hl = function (type, url, callback) {
		switch(type) {
			case "css":
				loadCss(url, callback, 1);
			break;
			case "js":
				loadJs(url, callback, 1);
			break;
		}
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
		window.location.hash = "#"+to;
		var hs = hashGet(), x;
		console.log(hs);
		route_handle();
	},
	ed = function (e)
	{
		var d = doc().getElementsByTagName("input");
		for (var i = d.length - 1; i >= 0; i--) {
			d[i].disabled = e;
		}
		d = doc().getElementsByTagName("select");
		for (var i = d.length - 1; i >= 0; i--) {
			d[i].disabled = e;
		}
		d = doc().getElementsByTagName("button");
		for (var i = d.length - 1; i >= 0; i--) {
			d[i].disabled = e;
		}
		d = doc().getElementsByTagName("textarea");
		for (var i = d.length - 1; i >= 0; i--) {
			d[i].disabled = e;
		}
	},
	al = function (msg, rr){
		bootbox.alert({
			message: msg,
			size: 'small',
			callback: function() {
				if (typeof rr == "string") {
					rerouting(rr);
				}
			}
		});
	};