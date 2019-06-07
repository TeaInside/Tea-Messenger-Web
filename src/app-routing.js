// Router library
import Navigo from 'navigo';

var router;

const path = document.getElementsByTagName('base')[0].getAttribute('href');

export default function AppRouting(host, useHash, hash) {
  router = new Navigo(host, useHash, hash);

  router.on({
    '/login': () => {
      import(/* webpackChunkName: 'login.component' */ './components/login/login.component')
      .then(LoginComponent => {
        const app = new LoginComponent.default();

        app.render();
        router.updatePageLinks();
      });
    }
  });

  // Index page
  router.on(() => {
    router.navigate('/login');
  });

  router.notFound(() => {
    // Redirect to base path
    router.navigate(path);
  });

  router.resolve();
}