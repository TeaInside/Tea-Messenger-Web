import Component from '../component';

import RegisterView from './register.component.html';
import './register.component.scss';

class RegisterComponent extends Component {

	constructor(element) {
		super(element);
	}

	view() {
    let dom = super.appEl();

    super.setTitle('Tea Messenger Register');
    super.render(dom, RegisterView);
  }
}

export default RegisterComponent;