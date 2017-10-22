/**
 * WindowEvents.js
 *
 * Triggers Created:
 *   - WindowResizeComplete
 *   - CssLoaded
 *   - WindowResize
 *   - WindowScroll
 *   - DisplayChange
 */

import $ from 'jquery';
import td from 'throttle-debounce';

class WindowEvents {

  constructor() {

    this.adminBarLoaded = false;
    this.cssHasLoaded = false;
    this.$body = $('body');
    this.$window = $(window);
    this.$loadIndicator = $('[data-load-indicator]');

    this.$body.attr('data-display-size', 'desktop');

    this.startLoadPolling();

    this.$window.on('resize', td.throttle(20, () => this.onResizeBegin()));

    this.$window.on('scroll', td.throttle(20, () => this.onScrolling()));

    this.$window.on('resize', td.debounce(250, () => {

      this.$window.trigger('WindowResizeComplete');

    }));

    this.$window.on('CssLoaded', () => this.onResizeBegin());

  }

  startLoadPolling() {

    let loadPollingInt = setInterval(() => {

      if (this.$loadIndicator.css('display') === 'block') {

        this.cssHasLoaded = true;

        clearInterval(loadPollingInt);

        this.$window.trigger('CssLoaded');

      }

    }, 50);

  }

  cssLoaded() {

    return this.cssHasLoaded ? true : false;

  }

  getDisplay() {

    let display = null;
    let indicator = {
      'cssDisplay': this.$loadIndicator.css('display'),
      'cssWidth': this.$loadIndicator.width()
    };

    if (indicator.cssDisplay === 'inline') {

      return display;

    } else if (indicator.cssDisplay === 'block') {

      if (indicator.cssWidth < 544) {
        display = 'phone';
      } else if (indicator.cssWidth < 769) {
        display = 'tablet';
      } else if (indicator.cssWidth < 992) {
        display = 'desktop';
      } else {
        display = 'wide-desktop';
      }

    }

    return display;

  }

  onResizeBegin() {

    let display = this.getDisplay();

    if (this.cssLoaded() === false) {
      return;
    }

    this.$window.trigger('WindowResize');

    if (this.$body.attr('data-display-size') !== display) {

      this.$window.trigger('DisplayChange', [display]);

    }

    this.$body.attr('data-display-size', display);

  }

  onScrolling() {

    let scrollTop = this.$window.scrollTop();

    this.$window.trigger('WindowScroll', [scrollTop]);

  }

}
new WindowEvents();
