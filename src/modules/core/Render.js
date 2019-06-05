/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */

import DOMPurify from 'dompurify';

/**
 * @param {String} HTML template string
 * @return {String} Sanitized HTML template
 */
export const sanitizeHTML = (dirty) => {
  let config = {
    ADD_TAGS: ['router-outlet'],
    ADD_ATTR: ['onclick', 'onload', 'onunload', 'onmouseover']
  };
  return DOMPurify.sanitize(dirty, config);
}

export class Render {
  /**
   * @param {String} Element ID
   * @param {String} HTML template string
   * @return {String} Sanitized HTML template
   */
  appendToDOM(element, template) {
    let rootElement = document.getElementById(element);
    let sanitizedTemplate = sanitizeHTML(template);

    try {
      this.clearElement(element);
      rootElement.innerHTML = sanitizedTemplate;
    } catch(e) { console.error(e)}

    return sanitizedTemplate;
  }

  /**
   * @param {String} Element ID
   * @return {void}
   */
  clearElement(element) {
    let dom = document.getElementById(element);
    try {
      while (dom.hasChildNodes()) {
        dom.removeChild(dom.firstChild);
      }
    } catch(e) {console.error(e)}
    
  }
}