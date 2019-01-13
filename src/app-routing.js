// Config
import Navigo from 'navigo';

// Components
import LoginComponent from './components/login/login.component';
import RegisterComponent from './components/register/register.component';

var router;

const path = document.getElementsByTagName('base')[0].getAttribute('href');

export default function AppRouting(host, useHash, hash) {
  router = new Navigo(host, useHash, hash);

  router.on({
    '/register': () => {
      const app = new RegisterComponent();
      app.render();
      router.updatePageLinks();
    },
    '/login': () => {
      const app = new LoginComponent();
      app.render();
      router.updatePageLinks();
    }
  });

  // Index page
  router.on(() => {
    const app = new LoginComponent();
    app.render();
    router.updatePageLinks();
  });

  router.notFound(() => {
    // Redirect to base path
    router.navigate(path);
  });

  router.resolve();
}