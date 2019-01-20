
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