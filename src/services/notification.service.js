import Noty from 'noty';

export class NotificationService {
  constructor() {
    Noty.overrideDefaults({
      layout   : 'bottomRight',
      closeWith: ['click', 'button'],
      theme    : 'mint',
      timeout  : 3000,
      animation: {
        open : 'animated bounceInUp',
        close: 'animated fadeOut'
      }
    });
  }

  create(options) {
    return new Noty(options);
  }

  showSuccess(text) {
    return this.create({
      type  : 'success',
      text  : text
    });
  }

  showWarning(text) {
    return this.create({
      type  : 'warning',
      text  : text
    });
  }

  showError(text) {
    return this.create({
      type  : 'error',
      text  : text
    });
  }

  showInfo(text) {
    return this.create({
      type  : 'info',
      text  : text
    });
  }
}