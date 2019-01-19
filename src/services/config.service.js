const devMode = process.env.NODE_ENV !== 'production';
const origin = location.origin;
const path = document.getElementsByTagName('base')[0].getAttribute('href');
const configFile = devMode ? 'config.development.json' : 'config.production.json';

export class ConfigService {
  constructor() {
    this.v = this.f();
  }

  list(data) {
    this.d = data;
    return data;
  }

  f() {
    let value = '';

    fetch(origin + path + 'assets/configs/' + configFile)
    .then(response => response.json())
    .then(data => {
      value = data;
    });

    return value;
  }

  get() {
    return this.v;
  }
}