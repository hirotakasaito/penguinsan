$(function () {
      $('.drawer').drawer();



      let scroll = false;
      let scrollTop = $('.scroll-top');
      $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
          if (scroll == false) {
            scroll = true;
            scrollTop.fadeIn(300);
          }
        } else {
          if (scroll) {
            scroll = false;
            scrollTop.fadeOut(300);
          }
        }
      });

      let w = $(window).width();

      if (w > 568) {
        $('.menu-item').on('mouseenter', function () {
          if ($(this).hasClass('open') == false) {
            $(this).find('ul').stop(true).slideDown(300);
            $(this).addClass('open');

            $(this).on('mouseleave', function () {
                if ($(this).hasClass('open')) {
                  $(this).find('ul').stop(true).slideUp(300);
                  $(this).removeClass('open');
                }
              });
            }
          });
        }



        scrollTop.click(function () {
          $('body, html').animate({
            scrollTop: 0
          }, 500);
          //多分意味ないけど一応return falseしとく
          return false;
        });
      });
