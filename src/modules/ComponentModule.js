export class ComponentModule {
  constructor() {
    this.componentRoot = 'app-root';
  }

  clearRootElement(element) {
    let appRoot = document.querySelector(element);

    while (appRoot.hasChildNodes()) {
      appRoot.removeChild(appRoot.firstChild);
    }
  }

  appendComponent(element, component) {
    let appComponent = document.querySelector(element);
    this.clearRootElement(element);
    appComponent.innerHTML = component;

    return component;
  }

  appendToRoot(component) {
    this.appendComponent(this.componentRoot, component);

    return component;
  }
}