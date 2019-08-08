         $(window).scroll(function() {
          var height = $(window).scrollTop();
            if ($(this).scrollTop() >10){
              $('header').addClass("sticky");
            }
            else {
              $('header').removeClass("sticky"); 
            }
      });