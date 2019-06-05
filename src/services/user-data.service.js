/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */

import { Configs } from '../config.js';

export class UserDataService {
  constructor() {
    this.apiUrl = new URL(Configs.apiUrl);
    this.apiEp = Configs.apiEndpoints;
  }

  /**
  * @return {Promise}
  */
  getUserData() {
    let params = new URLSearchParams(this.apiUrl);
    params.append('action', 'get_user_info');

    this.apiUrl.pathname = this.apiEp.profile;
    this.apiUrl.search = params;

    let token = this.getToken();
    let request = new Request(this.apiUrl.href, {
      method: 'GET',
      mode: 'cors',
      credentials: "same-origin",
      headers: {
          "Authorization": `Bearer ${token}`
      }
    });

    return fetch(request);
  }

  /**
  * @return {String};
  */
  getToken() {
    let token = localStorage.getItem('token_session');
    return token;
  }
}