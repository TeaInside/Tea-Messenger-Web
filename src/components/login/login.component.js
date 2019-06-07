import { Component } from '../component';
import { AuthService } from '../../services/auth.service';
import { NotificationService } from '../../services/notification.service';

import LoginComponentView from './login.component.html';
import './login.component.scss';

export default class LoginComponent extends Component {
  constructor() {
    super();
    this.authService = new AuthService();
    this.notifService = new NotificationService();
  }

  /*
  * @return void
  */
  render() {
    let appRoot = super.domTag('app-root')[0];

    while (appRoot.hasChildNodes()) {
      appRoot.removeChild(appRoot.firstChild);
    }
    appRoot.innerHTML = LoginComponentView;

    this.appendLoginToken();
    this.appendRegisterToken();

    let btnLogin = super.domId('login-button');
    btnLogin.addEventListener('click', () => {
      this.disableInputs('#login-form');
      this.login();
    });
  }

  /*
  * @return void
  */
  appendLoginToken() {
    this.authService.getLoginToken()
    .then(response => {
      if(response.ok === true) {
        response.json().then(result => {
          let flogin = super.domId('login-form');
          let el = document.createElement('input');
          el.id = 'login-token';
          el.type = 'hidden';
          el.name = 'loginToken';
          el.value = result.data.token;
          flogin.appendChild(el);
        });
      } else {
        this.notifService.showError('Could not request token').show();
      }
    });
  }

  /*
  * @return void
  */
  appendRegisterToken() {
    this.authService.getRegisterToken()
    .then(response => {
      if(response.ok === true) {
        response.json().then(result => {
          let flogin = super.domId('register-form');
          let el = document.createElement('input');

          el.id = 'register-token';
          el.type = 'hidden';
          el.name = 'loginToken';
          el.value = result.data.token;
          flogin.appendChild(el);
          this.appendCaptcha(result.data.token);
        });
      } else {
        this.notifService.showError('Could not request token').show();
      }
    });
  }

  /*
  * @return void
  */
  appendCaptcha(token) {
    this.authService.getCaptcha(token)
    .then(response => {
      if(response.ok === true) {
        response.blob().then(result => {
          const base64img = URL.createObjectURL(result);
          let cel = super.domId('captcha');
          let el = document.createElement('img');

          el.id = 'captcha-img';
          el.src = base64img;
          cel.insertBefore(el, cel.childNodes[0]);
        });
      } else {
        this.notifService.showError('Could not request token').show();
      }
    });
  }

  disableInputs(selector) {
    $(selector).find('input, textarea, button, select').attr('disabled', 'disabled');
  }

  enableInputs(selector) {
    $(selector).find('input, textarea, button, select').removeAttr('disabled');
  }

  /*
  * @return void
  */
  login() {
    let tokenEl = super.domId('login-token');
    let usernameEl = super.domId('login-username');
    let passwordEl = super.domId('login-password');
    let rememberEl = super.domId('login-remember-me');
    let token = tokenEl.value;

    this.authService.login(usernameEl.value, passwordEl.value, rememberEl.checked, token)
    .then(response => {
      if(response.ok === true) {
        response.json().then(result => {
          // Need development server to test the API
          this.notifService.showSuccess(result.data.message.state).show();
          this.enableInputs('#login-form');
        });
      } else {
        response.json().then(result => {
          this.notifService.showError(result.data.message.state).show();
          this.enableInputs('#login-form');
        });
      }
    })
    .catch(error => {
      console.log(error);
      this.notifService.showError('Could not send data to server. Please try again.').show();
      this.enableInputs('#login-form');
    });

    this.appendLoginToken();
  }
}