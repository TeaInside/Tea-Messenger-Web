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

  /*
  * @param token string
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

  /*
  * @param username string
  * @param password string
  * @param remember boolean
  * @param token    string
  * @return Promise
  */
  login(username, password, remember = false, token) {
    let params = new URLSearchParams(this.apiUrl);
    params.append('action', 'login');
    this.apiUrl.pathname = this.apiEp.login;
    this.apiUrl.search = params;

    let data = {
      username: username,
      password: password,
      rememberme: remember
    }

    let request = new Request(this.apiUrl.href, {
      method: 'POST',
      mode: 'cors',
      cache: "no-cache",
      credentials: "same-origin",
      headers: {
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
      },
      body: JSON.stringify(data)
    });

    return fetch(request);
  }
}