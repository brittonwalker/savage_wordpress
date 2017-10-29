/**
 * _Boilerplate.js
 */

import $ from 'jquery';
import Utilities from './Utilities';
import slick from '../vendor/slick.min.js';
import slickLightbox from '../vendor/slick-lightbox.js';

class Boilerplate {

    constructor() {

        var colors = [
            'yellow',
            'purple',
            'green',
            'peach'
        ]

        var color = colors[Math.floor(Math.random() * colors.length)];
        
        var changeColor = function(color) {
            $('body').addClass(color);
        }

        changeColor(color);

        var lightboxOpen = false;

        $('li').on('mouseenter', function(event) {
            
            if ( $(window).width() <= 991 ) {
                return;
            }

            $('.insert').attr("src", '');

            var url = $(this).attr("data-test");

            if (url != undefined) {
                $('.scrim').addClass('show');
                $('.insert').attr("src", url);
            }

        })

        $('.art-titles').on('mouseleave', function() {

            $('.scrim').removeClass('show');

        });

        $('li').on('mousemove', function(event) {

            $('.img-container').offset({
                left: event.clientX + 20,
                top: event.clientY + 20
            });

        });
        
        var leftArrow = '<div class="slick-prev"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve"><g><polygon points="13.354,18 4.354,9 13.354,0 14.061,0.707 5.768,9 14.061,17.293"/></g></svg></div>';
        
        var rightArrow = '<div class="slick-next"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve"><g><polygon points="5.061,18 14.061,9 5.061,0 4.354,0.707 12.646,9 4.354,17.293"/></g></svg></div>'

        var $slideshow = $('.painting-slideshow');
        $slideshow.each(function() {
            $(this).slick({
                infinite: true,
                // slidesToShow: 3,
                fade: true,
                slidesToScroll: 1,
                mobileFirst: true
            })
            .slickLightbox({
                navigateByKeyboard: true,
                slick: {
                    infinite: true,
                    // slidesToShow: 3,
                    fade: true,
                    slidesToScroll: 1,
                    mobileFirst: true,
                    prevArrow: leftArrow,
                    nextArrow: rightArrow
                },
                caption: 'caption',
                captionPosition: 'top',
                useHistoryApi: 'true',
                background: 'rgba(255, 255, 255, 1)',
                imageMaxHeight: .9
            })
            .on({
              'hide.slickLightbox': function(){ 
                  $('body').removeClass('peach green yellow purple');
                  var color = colors[Math.floor(Math.random() * colors.length)];
                  changeColor(color); 
              }
            });
        });

        $('li').on('click', function() {

            $('.scrim').removeClass('show');

            $(this).parent().find('.painting-slideshow img').eq($(this).data('index')).trigger('click');

        });
        


        $('.circle').on('click', function() {
            if (!$(this).hasClass('clicked')) {
                $(this).addClass('clicked');
                var circleWidth = $('.name-and-circle').outerWidth() - $('.circle-wrapper').outerWidth() - 15;
                $(".mobile-footer").animate({
                    left: circleWidth * -1,
                }, 300);
            } else {
                $(this).removeClass('clicked');
                $(".mobile-footer").animate({
                    left: 0,
                }, 300);
            }
        });


        var footerHeight = $('footer').height() + 40;
        $('.page-wrapper').css('margin-bottom', footerHeight);
        

          


    }

}
new Boilerplate();