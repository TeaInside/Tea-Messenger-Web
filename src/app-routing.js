import Navigo from 'navigo';

import LoginComponent from './components/login/login.component';
import RegisterComponent from './components/register/register.component';

var router;

var routing = function(host, useHash, hash) {
  router = new Navigo('http://localhost:8080', useHash, hash);

  router.on({
    '/register': function() {
      new RegisterComponent('app-register').render();
      router.updatePageLinks();
    },
    '/login': function() {
      new LoginComponent('app-login').render();
      router.updatePageLinks();
    }
  });

  router.on(function() {
    new LoginComponent('app-login').render();
    router.updatePageLinks();
  });

  router.resolve();
}

export default routing;