import Component from '../component';

import LoginView from './login.component.html';
import './login.component.scss';

class LoginComponent extends Component {

	constructor(element) {
		super(element);
    super.setTitle(element);
	}

	view() {
    let dom = super.appEl();

    super.setTitle('Tea Messenger Login');
    super.render(dom, LoginView);
    this.submitLogin();
	}

  submitLogin() {
    let btn = super.domId('loginButton');

    btn.addEventListener('mouseup', function() {
      console.log('click');
    });
  }
}

export default LoginComponent;