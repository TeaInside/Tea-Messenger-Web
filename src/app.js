import AppRouting from './app-routing';
import 'bootstrap';

const origin = location.origin;
const path = document.getElementsByTagName('base')[0].getAttribute('href');

window.onload = () => {
  AppRouting(origin + path, false, '#!');

  let preloader = document.getElementById('preloader');
  preloader.classList.add('animated', 'fadeOut');
  setTimeout(() => {
    preloader.classList.add('d-none');
  }, 1000);
};