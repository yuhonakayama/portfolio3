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
    
          if (scrollTop + windowHeight > elementTop + 300) {
            $(this).addClass('visible');
          }        
        });

        // .title-slide-in の処理
        $('.title-slide-in').each(function() {
          const elementTop = $(this).offset().top;
          const scrollTop = $(window).scrollTop();
          const windowHeight = $(window).height();

          if (scrollTop + windowHeight > elementTop + 300) {
            $(this).addClass('visible');
          }
        });

        // .title-slide-in-beside の処理
        $('.title-slide-in-beside').each(function() {
          const elementTop = $(this).offset().top;
          const scrollTop = $(window).scrollTop();
          const windowHeight = $(window).height();

          if (scrollTop + windowHeight > elementTop + 300) {
            $(this).addClass('visible');
          }
        });

        // .title-fade-inの処理
        $('.title-fade-in2').each(function() {
          const elementTop = $(this).offset().top;
          const scrollTop = $(window).scrollTop();
          const windowHeight = $(window).height();
    
          if (scrollTop + windowHeight > elementTop + 200) {
            $(this).addClass('visible');
          }        
        });

      });
    });

    document.addEventListener("scroll", function () {
      const element = document.querySelector(".falling-down");
      const rect = element.getBoundingClientRect();
      const windowHeight = window.innerHeight;
    
      // 要素が画面の下から 500px の範囲に入ったらスライドイン
      if (rect.top < windowHeight - 500) {
        element.classList.add("active");
      }
    });

    document.addEventListener("scroll", function () {
      const elements = document.querySelectorAll(".falling");
      const windowHeight = window.innerHeight;
      
      elements.forEach((element) => {
        const rect = element.getBoundingClientRect();

      // 要素が画面の下から 500px の範囲に入ったらスライドイン
      if (rect.top < windowHeight - 500) {
        element.classList.add("active");
        }
      });
    });


    // 登頂者をクリックで旗を表示
    document.querySelector(".climber-img").addEventListener("click", function () {
      const element = document.querySelector(".flag-img");
      element.style.display = "block"; // または "flex", "inline" など必要な値に変更
    });
    

    // 登山者のアニメーション
    document.querySelector(".mountaineers-img").addEventListener("click", function () {
      const box = document.querySelector(".mountaineers-img");
    
      // 一度アニメーションを適用
      box.style.animation = "drop-and-rise 1.5s ease-in-out";
    
      // アニメーションが終わったらリセットする（再利用のため）
      box.addEventListener("animationend", () => {
        box.style.animation = ""; // アニメーションプロパティをリセット
      });
    });
    
      // 指さす人をクリックでセリフを表示
      document.querySelector(".pointing-img").addEventListener("click", function () {
        const element = document.querySelector(".serif-img");

        // 現在の表示状態をチェックしてトグル
        if (element.style.display === "block") {
          element.style.display = "none"; // 非表示にする
        } else {
          element.style.display = "block"; // 表示する
        }
      });

});


