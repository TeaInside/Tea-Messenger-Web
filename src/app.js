// Dependencies
import $ from 'jquery';
import 'bootstrap';
import '@fortawesome/fontawesome-free/js/all';
import 'animate.css';
import Navigo from 'navigo';

// Main style
import './styles.scss';

// Config and Routing
import config from './config.dev';

// Components
import LoginComponent from './components/login/login.component';
import RegisterComponent from './components/register/register.component';

export const app = {
  "login": new LoginComponent(),
  "register": new RegisterComponent()
}

var router;

var routing = function(host, useHash, hash) {
  router = new Navigo('http://localhost:8080', useHash, hash);

  router.on({
    '/register': function() {
      app.register.view();
      router.updatePageLinks();
    },
    '/login': function() {
      app.login.view();
      router.updatePageLinks();
    }
  });

  router.on(function() {
    app.login.view();
    router.updatePageLinks();
  });

  router.resolve();
}

document.addEventListener('DOMContentLoaded', function() {
  routing(config.root_url, false, '#!');
});