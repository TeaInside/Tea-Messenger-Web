/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */

import { Component } from 'Modules/core';

@Component({
  'selector': 'app-root',
  'template': require('./auth.component.html'),
  'styles': [require('./auth.component.scss')]
})
export class AuthComponent {
  constructor() {
    
  }
}
