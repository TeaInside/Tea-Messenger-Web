/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */
 
import path from 'path';
import lodash from 'lodash';
import { Render } from '../core';
import { Router, RouterModule } from './RouterModule';

const render = new Render();
const devMode = process.env.NODE_ENV !== 'production';

export class RouterFactory {
  constructor() {
    this.routes = {};
  }

  /**
  * Register route path with given routes object
  * and return the resolved route object
  *
  * @param routes Object
  * @return Object
  */
  registerRoute(routes) {
    const router = Router;
    const instance = {};
    const routePath = path.resolve(routes.path);
    const hasParent = (typeof routes.parent !== 'undefined');
    const hasChildren = (typeof routes.children !== 'undefined');

    router.on(
      routePath,
      (params, query) => {
        if (hasParent) {
          loadParent(routes);
        }

        if (typeof routes.redirectTo === 'undefined') {
          callOnInit(instance.routes);
          render.appendToDOM(routes.component.selector, routes.component.template);
        }

        router.updatePageLinks();
      },
      {
        before: (done, params) => {
          if (typeof routes.redirectTo !== 'undefined') {
            Router.navigate(routes.redirectTo);
            done(false);
          }

          if (typeof routes.component !== 'undefined') {
            instance.routes = new routes.component();
          }

          done(true);
        },
        after: (params) => {
          // callOnAfterView(instance.parent);
          callOnAfterView(instance.routes);
        },
        leave: (params) => {
          callOnDestroy(instance.routes);
          render.clearElement(routes.component.selector);

          if (hasParent) {
            unloadParent(routes);
          }
        }
      }
    ).resolve();

    if (hasChildren) {
      registerChildren(routes);
      return router.lastRouteResolved();
    }

    return router.lastRouteResolved();
  }
}

/**
*   Register route path with given routes object
*   if the route has a children routes
*
*   @param routes Object
*   @return Object
*/
function registerChildren(routes) {
  const routerFactory = new RouterFactory();
  let parent = routes;
  parent.children.map(children => {
    let routePath = '';
    if (children.path !== '') {
      routePath = path.join(parent.path, children.path);
      let route = children;
      route.path = routePath;
      route.parent = parent;
      // route.parent.child = children;

      routerFactory.registerRoute(route);
      return route;
    }
    return children;
  });
  parent = undefined;
  return routes;
}

/**
*   Recursively render view and call onInit and onAfterView event
*   if the current route has a parent.
*
*   @param routes Object
*   @return boolean|Object
*/
function loadParent(routes) {
  const hasParent = _.has(routes, 'parent');
  if (hasParent) {
    let grandParent = loadParent(routes.parent);

    if (typeof grandParent !== 'undefined') {
      let parentMeta = routes.parent.component;
      let instance = new routes.parent.component();
      callOnInit(instance);
      render.appendToDOM(parentMeta.selector, parentMeta.template);
      callOnAfterView(instance);

      parentMeta = undefined;
      instance = undefined;
      grandParent = undefined;
      return routes.parent;
    }
    return loadParent(grandParent);
  }
  return hasParent;
}

/**
*   Recursively remove view and call onDestroy event
*   until the current route has no more parent/grand parent/etc
*
*   @param routes Object
*   @return boolean
*/
function unloadParent(routes) {
  const hasParent = _.has(routes, 'parent');
  if (hasParent) {
    let parentMeta = routes.parent.component;
    let instance = routes.parent.component.prototype;
    callOnDestroy(instance);
    render.clearElement(parentMeta.selector);

    parentMeta = undefined;
    instance = undefined;
    return unloadParent(routes.parent);
  }
  return hasParent;
}

/**
*   Call onInit event
*
*   @param component Instance
*   @return void
*/
function callOnInit(component) {
  try {
    if (!_.isUndefined(component.onInit())) {
      component.onInit();
    }
  } catch(e) { 
    if (devMode) {
      console.log(e);
    }
  }
}

/**
*   Call onAfterView event
*
*   @param component Instance
*   @return void
*/
function callOnAfterView(component) {
  try {
    if (!_.isUndefined(component.onAfterView())) {
      component.onAfterView();
    }
  } catch(e) {
    if (devMode) {
      console.log(e);
    }
  }
}

/**
*   Call onDestroy event
*
*   @param component Instance
*   @return void
*/
function callOnDestroy(component) {
  try {
    if (!_.isUndefined(component.onDestroy())) {
      component.onDestroy();
    }
  } catch(e) { 
    if (devMode) {
      console.log(e);
    }
  }
}