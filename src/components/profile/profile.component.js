/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */
 
import { Component } from 'Modules/core';
import { Router } from 'Modules/router';

import { AuthService } from 'Services/auth.service';
import { NotificationService } from 'Services/notification.service';
import { UserDataService } from 'Services/user-data.service';

@Component({
  'selector': 'app-root',
  'template': require('./profile.component.html'),
  'styles': [require('./profile.component.scss')]
})
export class ProfileComponent {
  constructor() {
    this.authService = new AuthService();
    this.notifService = new NotificationService();
    this.userDataService = new UserDataService();
    this.userData = {};
  }

  onInit() {

  }

  onAfterView() {
    this.fetchUserData();

    this.signOut = document.getElementById('sign-out');
    this.signOut.addEventListener('click', () => {
      this.authService.logout();
      Router.navigate('/auth/login');
    });

    if (this.authService.isLoggedIn() === false) {
      Router.navigate('/auth/login');
    }
  }

  onDestroy() {
    this.signOut.removeEventListener('click', () => {
      this.authService.logout();
    });
  }

  fetchUserData() {
    this.userDataService.getUserData()
    .then(response => {
      if(response.ok === true) {
        response.json().then(result => {
          this.appendData(result.data);
        });
      } else {
        response.json().then(result => {
          this.authService.logout();
          Router.navigate('/auth/login');
        })
      }
    })
    .catch(error => {
      this.notifService.showError('Could not retrieve data from the server. Please try again.').show();
    });
  }

  appendData(data) {
    let firstName = document.getElementById('first-name');
    let lastName = document.getElementById('last-name');
    let email = document.getElementById('email');
    let phone = document.getElementById('phone-number');
    let gender = document.getElementById('gender');

    firstName.innerHTML = data.first_name;
    lastName.innerHTML = data.last_name;
    email.innerHTML = data.email;
    phone.innerHTML = data.phone;

    if (data.gender === 'm') {
      gender.innerHTML = 'Male';
    } else {
      gender.innerHTML = 'Female';
    }

    let spinner = document.getElementsByClassName('spinner-border');
    for (let i = 0; i < spinner.length; i++) {
      spinner[i].classList.add('d-none');
    }
  }
}
