/**
 * @author TeaInside <admin@teainside.org>
 * @version 0.0.1
 * @license MIT
 */

/**
 * Add Component Decorator
 *
 * @param {Object} Component metadata objects
 * @return {Object} Component metadata
 */
export function Component(componentMetadata) {
  return function(data) {
    data.selector = componentMetadata.selector;
    data.template = componentMetadata.template;
    data.styles = componentMetadata.styles;
    return data;
  }
}