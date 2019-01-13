const devMode = process.env.NODE_ENV !== 'production';
const origin = location.origin;
const path = document.getElementsByTagName('base')[0].getAttribute('href');
const configFile = devMode ? 'config.development.json' : 'config.production.json';

export default class ConfigService {
  list(data) {
    this.d = data;
    return data;
  }

  get() {
    return fetch(origin + path + 'assets/configs/' + configFile)
    .then(response => response.json());
  }
}