/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */

function xhr(d)
{
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
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
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
}