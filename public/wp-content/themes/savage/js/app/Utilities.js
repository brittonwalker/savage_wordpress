/**
 * Utilities.js
 */

import $ from 'jquery';

export default class Utilities {

  static getImageHeight(imgSrc) {

    return new Promise((resolve) => {
      let newImage = new Image();
      newImage.onload = () => resolve(newImage.height);
      newImage.src = imgSrc;
    });

  }

}