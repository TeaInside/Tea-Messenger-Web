
class Component {
  
  constructor() {

  }

  /*create(el) {
    this.el = document.createElement(el);
    return this;
  }

  createTextNode(text) {
    this.el.textNode = document.createTextNode(text);
    return this;
  }

  setAttr(name, value) {
    this.el.setAttribute(name, value);
    return this;
  }*/

  domId(d) {
    return document.getElementById(d);
  }

  domClass(d) {
    return document.getElementsByClassName(d);;
  }

  domTag(d) {
    return document.getElementsByTagName(d);
  }

  appEl() {
    return this.domId('app');
  }

  render(dom, content) {
    dom.innerHTML = content;    
  }

  setTitle(title) {
    document.getElementsByTagName("title")[0].innerHTML = title;
  }

  xhr(d) {
    let ch = new XMLHttpRequest, x;
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
  }
}

export default Component;