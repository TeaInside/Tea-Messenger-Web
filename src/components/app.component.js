import { Component } from 'Modules/core';

// Component's class decorator
@Component({
  'selector': 'app-root',
  'template': require('./app.component.html'),
  'styles': [require('./app.component.scss')]
})
export class AppComponent {
  constructor() {
    
  }

  title = 'Tea Messenger';

  // This method will be called once after constructing
  // the class component
  onInit() {
    
  }

  // This method will be called once after html has
  // appended to the DOM
  onAfterView() {
    
  }

  // This method will be called once when leaving the route
  onDestroy() {
    
  }
}
