
export class Component {
  domId(d) {
    return document.getElementById(d);
  }

  domClass(d) {
    return document.getElementsByClassName(d);
  }

  domTag(d) {
    return document.getElementsByTagName(d);
  }
}

/* const Component = {
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
} */