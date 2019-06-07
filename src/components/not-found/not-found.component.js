/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */

import { Component } from 'Modules/core';

@Component({
  'selector': 'app-root',
  'template': require('./not-found.component.html'),
  'styles': [require('./not-found.component.scss')]
})
export class NotFoundComponent {
  constructor() {
    
  }
}
