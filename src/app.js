/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */
 
import { router } from './app-routing';
import 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  router.load();
});