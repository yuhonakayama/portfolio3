$(function () {
    // h1フェードイン
    setTimeout(function() {
      $('.mv-container h1').addClass('bounce');
    }, 500); // 0.5秒後にアニメーション開始

    // HP-imgフェードイン
    setTimeout(function() {
      $('.HP-img').fadeIn(300);
    }, 1500);

    // code-imgフェードイン
    setTimeout(function() {
      $('.code-img').fadeIn(300);
    }, 2000);

    // .design-imgフェードイン
    setTimeout(function() {
      $('.design-img').fadeIn(300);
    }, 2500);

    $(function () {
      $(window).on('scroll', function() {
        // .title-fade-inの処理
        $('.title-fade-in').each(function() {
          const elementTop = $(this).offset().top;
          const scrollTop = $(window).scrollTop();
          const windowHeight = $(window).height();
    
          if (scrollTop + windowHeight > elementTop + 100) {
            $(this).addClass('visible');
          }        
        });

        // .title-slide-in の処理
        $('.title-slide-in').each(function() {
          const elementTop = $(this).offset().top;
          const scrollTop = $(window).scrollTop();
          const windowHeight = $(window).height();

          if (scrollTop + windowHeight > elementTop + 100) {
            $(this).addClass('visible');
          }
        });

        // .title-slide-in-beside の処理
        $('.title-slide-in-beside').each(function() {
          const elementTop = $(this).offset().top;
          const scrollTop = $(window).scrollTop();
          const windowHeight = $(window).height();

          if (scrollTop + windowHeight > elementTop + 100) {
            $(this).addClass('visible');
          }
        });

        // .title-fade-inの処理
        $('.title-fade-in2').each(function() {
          const elementTop = $(this).offset().top;
          const scrollTop = $(window).scrollTop();
          const windowHeight = $(window).height();
    
          if (scrollTop + windowHeight > elementTop + 100) {
            $(this).addClass('visible');
          }        
        });

      });
    });

    document.addEventListener("scroll", function () {
      const element = document.querySelector(".falling-down");
      const rect = element.getBoundingClientRect();
      const windowHeight = window.innerHeight;
    
      // 要素が画面の下から 50px の範囲に入ったらスライドイン
      if (rect.top < windowHeight - 50) {
        element.classList.add("active");
      }
    });
    

});

      
    