/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */
 
import { Configs } from '../config.js';

export class AuthService {
  constructor() {
    this.apiUrl = new URL(Configs.apiUrl);
    this.apiEp = Configs.apiEndpoints;
  }

  /*
  * @return Promise
  */
  getLoginToken() {
    let params = new URLSearchParams(this.apiUrl);
    params.append('action', 'get_token');

    this.apiUrl.pathname = this.apiEp.login;
    this.apiUrl.search = params;
    let request = new Request(this.apiUrl.href, {
      method: 'GET',
      mode: 'cors'
    });

    return fetch(request);
  }

  /*
  * @return Promise
  */
  getRegisterToken() {
    let params = new URLSearchParams(this.apiUrl);
    params.append('action', 'get_token');

    this.apiUrl.pathname = this.apiEp.register;
    this.apiUrl.search = params;
    let request = new Request(this.apiUrl.href, {
      method: 'GET',
      mode: 'cors'
    });

    return fetch(request);
  }

  /**
   * @param token string
   *
   * @return Promise
   */
  getCaptcha(token) {
    let params = new URLSearchParams(this.apiUrl);
    params.append('token', token);

    this.apiUrl.pathname = this.apiEp.captcha;
    this.apiUrl.search = params;
    let request = new Request(this.apiUrl.href, {
      method: 'GET',
      mode: 'cors'
    });

    return fetch(request);
  }

  /**
   * @param formElement HTMLElement
   *
   * @return Promise
   */
  login(formElement) {
    let params = new URLSearchParams(this.apiUrl);
    params.append('action', 'login');
    this.apiUrl.pathname = this.apiEp.login;
    this.apiUrl.search = params;

    let fd = new FormData(formElement);
    let data = objectFromFormData(fd);
    let request = new Request(this.apiUrl.href, {
      method: 'POST',
      mode: 'cors',
      cache: "no-cache",
      credentials: "same-origin",
      headers: {
          "Content-Type": "application/json",
          "Authorization": `Bearer ${data.token}`
      },
      body: JSON.stringify(data)
    });

    return fetch(request);
  }

  /**
   * @param formElement HTMLElement
   *
   * @return Promise
   */
  register(formElement) {
    let params = new URLSearchParams(this.apiUrl);
    params.append('action', 'submit');
    this.apiUrl.pathname = this.apiEp.register;
    this.apiUrl.search = params;

    let fd = new FormData(formElement);
    let data = objectFromFormData(fd);
    let request = new Request(this.apiUrl.href, {
      method: 'POST',
      mode: 'cors',
      cache: "no-cache",
      credentials: "same-origin",
      headers: {
          "Content-Type": "application/json",
          "Authorization": `Bearer ${data.token}`
      },
      body: JSON.stringify(data)
    });

    return fetch(request);
  }

  /**
   * @return boolean
   */
  isLoggedIn() {
    let token = localStorage.getItem('token_session');
    //eslint-disable-next-line no-unused-expressions
    return (token !== null) ? true : false;
  }

  /**
   * @return void
   */
  logout() {
    localStorage.removeItem('token_session');
  }
}

/**
 * @param formData FormData
 *
 * @return Object
 */
const objectFromFormData = (formData) => {
  let values = {};
  for (let pair of formData.entries()) {
    let key = pair[0];
    let value = pair[1];
    if (values[key]) {
      if ( ! (values[key] instanceof Array) ) {
        values[key] = new Array(values[key]);
      }
      values[key].push(value);
    } else {
      values[key] = value;
    }
  }
  return values;
}