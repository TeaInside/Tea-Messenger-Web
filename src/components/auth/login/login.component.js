/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */
 
import { Component } from 'Modules/core';
import { Router } from 'Modules/router';

import { AuthService } from 'Services/auth.service';
import { NotificationService } from 'Services/notification.service';

@Component({
  'selector': 'app-login',
  'template': require('./login.component.html'),
  'styles': [require('./login.component.scss')]
})
export class LoginComponent {
  constructor() {
    this.authService = new AuthService();
    this.notifService = new NotificationService();
  }

  onInit() {
    
  }

  onAfterView() {
    this.submitListener = document.getElementById('login-form');
    this.submitListener.addEventListener('submit', (event) => {
      event.preventDefault();
      this.login();
      this.disableInputs('#login-form');
    });

    if (this.authService.isLoggedIn() === true) {
      Router.navigate('profile');
    }

    this.appendLoginToken();
  }

  onDestroy() {
    this.submitListener.removeEventListener('submit', (event) => {
      event.preventDefault();
      this.login();
      this.disableInputs('#login-form');
    });
  }

  /*
  * @return void
  */
  appendLoginToken() {
    if (this.authService.isLoggedIn() === true) {
      return;
    }

    this.authService.getLoginToken()
    .then(response => {
      if(response.ok === true) {
        let loginTokenElement = document.getElementById('login-token');
        if (loginTokenElement !== null) {
          loginTokenElement.remove();
          loginTokenElement = undefined;
        }

        response.json().then(result => {
          let flogin = document.getElementById('login-form');
          let el = document.createElement('input');
          el.id = 'login-token';
          el.type = 'hidden';
          el.name = 'token';
          el.value = result.data.token;
          flogin.appendChild(el);
          flogin = undefined;
          el = undefined;
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
    let formData = document.getElementById('login-form');

    this.authService.login(formData)
    .then(response => {
      if(response.ok === true) {
        response.json().then(result => {
          localStorage.setItem('token_session', result.data.message.token_session);

          this.notifService.showSuccess(result.data.message.state).show();
          this.enableInputs('#login-form');
          Router.navigate('profile');
          // this.appendLoginToken();
        });
      } else {
        response.json().then(result => {
          this.notifService.showError(result.data.message.state).show();
          this.enableInputs('#login-form');
          this.appendLoginToken();
        });
      }
    })
    .catch(error => {
      this.notifService.showError('Could not send data to the server. Please try again.').show();
      this.enableInputs('#login-form');
    });
  }
}