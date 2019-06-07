/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */

import { Component } from 'Modules/core';
import { AuthService } from 'Services/auth.service';
import { NotificationService } from 'Services/notification.service';

@Component({
  'selector': 'app-register',
  'template': require('./register.component.html'),
  'styles': [require('./register.component.scss')]
})
export class RegisterComponent {
  constructor() {
    this.authService = new AuthService();
    this.notifService = new NotificationService();
  }

  onInit() {
    this.appendRegisterToken();
  }

  onAfterView() {
    this.submitListener = document.getElementById('register-form');
    this.submitListener.addEventListener('submit', (event) => {
      event.preventDefault();
      this.register();
      this.disableInputs('#register-form');
    });
  }

  onDestroy() {
    this.submitListener.removeEventListener('submit', (event) => {

    });
  }

  /*
  * @return void
  */
  appendRegisterToken() {
    this.authService.getRegisterToken()
    .then(response => {
      if(response.ok === true) {
        let loginTokenElement = document.getElementById('register-token');
        if (loginTokenElement !== null) {
          loginTokenElement.remove();
          loginTokenElement = undefined;
        }

        response.json().then(result => {
          let fregister = document.getElementById('register-form');
          let el = document.createElement('input');

          el.id = 'register-token';
          el.type = 'hidden';
          el.name = 'token';
          el.value = result.data.token;
          fregister.appendChild(el);
          this.appendCaptcha(result.data.token);
          fregister = undefined;
          el = undefined;
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
        let captchaImage = document.getElementById('captcha-img');
        let captchaElement = document.getElementById('captcha');
        if (captchaImage !== null) {
          captchaImage.remove();
          captchaImage = undefined;
          this.toggleSpinner(captchaElement);
        }

        response.blob().then(result => {
          const base64img = URL.createObjectURL(result);
          let captchaElement = document.getElementById('captcha');
          let el = document.createElement('img');

          el.id = 'captcha-img';
          el.src = base64img;
          this.toggleSpinner(captchaElement);
          captchaElement.appendChild(el);
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

  register() {
    let formData = document.getElementById('register-form');
    this.authService.register(formData)
    .then(response => {
      if(response.ok === true) {
        response.json().then(result => {
          this.notifService.showSuccess(result.data.message).show();
          this.enableInputs('#register-form');
          this.appendRegisterToken();
        });
      } else {
        response.json().then(result => {
          this.notifService.showError(result.data.message).show();
          this.enableInputs('#register-form');
          this.appendRegisterToken();
        });
      }
    })
    .catch(error => {
      this.notifService.showError('Could not send data to the server. Please try again.').show();
      this.enableInputs('#register-form');
    });
  }

  toggleSpinner(node) {
    let spinnerElement = node.children[0];
    spinnerElement.classList.toggle('d-none');
  }
}
