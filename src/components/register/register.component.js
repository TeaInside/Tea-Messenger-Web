import {Component} from '../component';

import RegisterComponentView from './register.component.html';
import './register.component.scss';

export default class RegisterComponent extends Component {
	constructor() {
		super();
	}

	render() {
    let appRoot = super.domTag('app-root')[0];

    while (appRoot.hasChildNodes()) {
      appRoot.removeChild(appRoot.firstChild);
    }
    appRoot.innerHTML = RegisterComponentView;
  }
}