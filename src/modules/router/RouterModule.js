/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */

import Navigo from 'navigo';
import _ from 'lodash';
import { Render } from '../core';
import { RouterFactory } from './RouterFactory';

const origin = location.origin;
const path = document.querySelector('base').getAttribute('href');
const routerFactory = new RouterFactory();
const Router = new Navigo(origin + path, false, '#!');

class RouterModule {
  constructor(routes) {
    this.routes = routes;
    // this.urlParameter = '';
    // this.urlQuery = '';
  }

  /**
  *   Map the given routes and register
  *
  *   @return Array
  */
  load() {
    return _.map(this.routes, routerFactory.registerRoute);
  }

  // getUrlParameter() {
  //   return this.urlParameter;
  // }

  // getUrlQuery() {
  //   return this.urlQuery;
  // }
}

export { Router, RouterModule };