/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */
class creator {
	constructor(el, type) {
		switch(type) {
			case 0:
				this.el = document.createElement(el);
			break;
			case 1:
				this.el = document.createTextNode(el);
			break;
		}
	}
	ac(...c) {
		var cx, dx;
		for (cx in c) {
			if (typeof c[cx].arr__ !== "undefined") {
				for (dx in c[cx]) {
					if (dx !== "arr__") {
						this.el.appendChild(c[cx][dx].el);
					}
				}
			} else if(typeof c[cx].el !== "undefined") {
				this.el.appendChild(c[cx].el);
			}
		}
	}
	set id(v) {
		this.el.id = v;
	}
	set name(v) {
		this.el.name = v;
	}
	set action(v) {
		this.el.action = v;
	}
	set method(v) {
		this.el.method = v;
	}
	set type(v) {
		this.el.type = v;
	}
	set required(v) {
		this.el.setAttribute("required", v);
	}
	set href(v) {
		this.el.href = v;
	}
	set src(v) {
		this.el.src = "assets/images/" + v;
	}
	set placeholder(v) {
		this.el.placeholder = v;
	}
	set(n,v){
		this.el.setAttribute(n, v);
	}
}