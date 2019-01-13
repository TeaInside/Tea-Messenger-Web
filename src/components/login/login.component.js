import { Component } from '../component';
import ConfigService from '../../config.service';

import LoginComponentView from './login.component.html';
import './login.component.scss';

export default class LoginComponent extends Component {
  constructor() {
    super();

    this.configService = new ConfigService();
  }

  render() {
    let appRoot = super.domTag('app-root')[0];

    while (appRoot.hasChildNodes()) {
      appRoot.removeChild(appRoot.firstChild);
    }
    appRoot.innerHTML = LoginComponentView;
  }
}