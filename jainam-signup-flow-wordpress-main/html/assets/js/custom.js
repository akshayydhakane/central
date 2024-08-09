/******** header menu ********/
$(document).ready(function () {
  $("#burger").on("click", function () {
    $(".header-menu").toggleClass("active");
  });
  $("#burger").on("click", function () {
    $("#burger").toggleClass("active");
  });
  $("#burger").on("click", function () {
    $("body").toggleClass("no-scroll");
  });
  /********** header sticky ********/
  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $("header").addClass("fixed");
    } else {
      $("header").removeClass("fixed");
    }
  });

  /********** header overlay ********/

  $(".mega-menu-link").hover(
    function () {
      $(".overlay").addClass("active");
    },
    function () {
      $(".overlay").removeClass("active");
    }
  );

  /********** according  ********/

  $(document).ready(function () {
    $(".footer-according-a").click(function (event) {
      event.preventDefault();

      var target = $(this).parent().data("target");
      var $targetDropdown = $(target);
      var $thisLink = $(this);

      $(".footer-according-li-dropdown")
        .not($targetDropdown)
        .slideUp(200)
        .removeClass("active");
      $(".footer-according-a").not($thisLink).removeClass("active");
      $targetDropdown.slideToggle(200).toggleClass("active");
      $thisLink.toggleClass("active");
    });

    $(document).click(function (event) {
      if (!$(event.target).closest(".footer-according-li").length) {
        $(".footer-according-li-dropdown").slideUp(200).removeClass("active");
        $(".footer-according-a").removeClass("active");
      }
    });
  });

  $(document).ready(function () {
    function updateFooterBottomClass() {
      if ($(".footer-according-li-dropdown.active").length > 0) {
        $(".footer-bottom").removeClass("jainam-active");
      } else {
        $(".footer-bottom").addClass("jainam-active");
      }
    }
    updateFooterBottomClass();

    const observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (
          mutation.type === "attributes" &&
          mutation.attributeName === "class"
        ) {
          updateFooterBottomClass();
        }
      });
    });

    const config = {
      attributes: true,
      subtree: true,
      attributeFilter: ["class"],
    };

    $(".footer-according-li-dropdown").each(function () {
      observer.observe(this, config);
    });
  });

  /********** blog list  ********/

  $(document).ready(function () {
    $(".blog-list-top-inner a").click(function () {
      $(".blog-list-top-inner a").removeClass("active"); // Remove active class from all links
      $(this).addClass("active"); // Add active class to the clicked link
    });
  });

  $(document).ready(function () {
    const articlesPerPage = 9;
    let currentPage = 1;
    const articles = $(".blog-card");

    function renderArticles() {
      articles.hide();
      const start = (currentPage - 1) * articlesPerPage;
      const end = start + articlesPerPage;
      articles.slice(start, end).show();
      renderPagination();
    }

    function renderPagination() {
      const totalPages = Math.ceil(articles.length / articlesPerPage);
      $(".page-numbers").empty();

      if (totalPages <= 1) return;

      const createPageButton = (page) => `
          <button class="${
            page === currentPage ? "active" : ""
          }" data-page="${page}">${page}</button>
      `;

      $(".prev-page").prop("disabled", currentPage === 1);

      // Always show the first three pages
      for (let i = 1; i <= 3 && i <= totalPages; i++) {
        $(".page-numbers").append(createPageButton(i));
      }

      // Ellipsis and pages around current page if necessary
      if (currentPage > 4) {
        $(".page-numbers").append("<span>...</span>");
      }

      if (currentPage > 3 && currentPage < totalPages - 2) {
        $(".page-numbers").append(createPageButton(currentPage - 1));
        $(".page-numbers").append(createPageButton(currentPage));
        $(".page-numbers").append(createPageButton(currentPage + 1));
      } else if (currentPage === 3) {
        $(".page-numbers").append(createPageButton(4));
      }

      // Ellipsis and last three pages if necessary
      if (currentPage < totalPages - 3) {
        $(".page-numbers").append("<span>...</span>");
      }

      for (let i = totalPages - 2; i <= totalPages; i++) {
        if (i > 3) {
          $(".page-numbers").append(createPageButton(i));
        }
      }

      $(".next-page").prop("disabled", currentPage === totalPages);
    }

    $(".pagination").on("click", ".page-numbers button", function () {
      const newPage = $(this).data("page");
      if (newPage) {
        currentPage = newPage;
        renderArticles();
      }
    });

    $(".pagination").on("click", ".prev-page", function () {
      if (currentPage > 1) {
        currentPage--;
        renderArticles();
      }
    });

    $(".pagination").on("click", ".next-page", function () {
      const totalPages = Math.ceil(articles.length / articlesPerPage);
      if (currentPage < totalPages) {
        currentPage++;
        renderArticles();
      }
    });

    renderArticles();
  });

  $(document).ready(function () {
    $(".set > a").on("click", function () {
      if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(this).siblings(".content").slideUp(200);
        $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
      } else {
        $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
        $(this).find("i").removeClass("fa-plus").addClass("fa-minus");
        $(".set > a").removeClass("active");
        $(this).addClass("active");
        $(".content").slideUp(200);
        $(this).siblings(".content").slideDown(200);
      }
    });
  });

  let question = document.querySelectorAll(".question");

  question.forEach((question) => {
    question.addEventListener("click", (event) => {
      const active = document.querySelector(".question.active");
      if (active && active !== question) {
        active.classList.toggle("active");
        active.nextElementSibling.style.maxHeight = 0;
      }
      question.classList.toggle("active");
      const answer = question.nextElementSibling;
      if (question.classList.contains("active")) {
        answer.style.maxHeight = answer.scrollHeight + "px";
      } else {
        answer.style.maxHeight = 0;
      }
    });
  });

  $(".offer_card_slider").slick({
    slidesToShow: 3.1,
    slidesToScroll: 1,
    arrows: true,
    speed: 1000,
    autoplaySpeed: 1000,
    autoplay: true,
    prevArrow: '<button class="slide-arrow prev-arrow"></button>',
    nextArrow: '<button class="slide-arrow next-arrow"></button>',
    responsive: [
      {
        breakpoint: 1240,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1080,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
  $(".award_card_slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    speed: 1000,
    autoplaySpeed: 1000,
    autoplay: false,
    prevArrow: '<button class="slide-arrow prev-arrow"></button>',
    nextArrow: '<button class="slide-arrow next-arrow"></button>',
    responsive: [
      {
        breakpoint: 1240,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1080,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });



    //home banner slider 
    $(document).ready(function() {
      // Initialize home banner slider
      $('.home-banner-slider-mobile').slick({
          vertical: true,
          verticalSwiping: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 0,
          speed: 15000,
          cssEase: 'linear',
          infinite: true,
          arrows: false,
          touchMove: true,
          swipeToSlide: true,
          swipe: true
      });
  
      // Function to initialize or update left swiper
      function initLeftSwiper() {
          let slideCount = document.querySelectorAll('.left-slide .swiper-slide');
          var leftSwiper = new Swiper('.left-slide', {
              slidesPerView: 2.5,
              loop: true,
              direction: "vertical",
              initialSlide: slideCount.length,
              speed: 15000,
              autoplay: {
                  delay: 0,
                  reverseDirection: true,
                  disableOnInteraction: false // Ensure autoplay continues after interaction
              },
              navigation: {
                  nextEl: '.prev',
                  prevEl: '.next'
              },
              on: {
                  // Resume autoplay on navigation click
                  slideChangeTransitionEnd: function () {
                      this.autoplay.start();
                  }
              }
          });
      }
  
      // Function to initialize or update right swiper
      function initRightSwiper() {
          var rightSwiper = new Swiper('.right-slide', {
              slidesPerView: 2.5,
              loop: true,
              direction: "vertical",
              speed: 15000,
              autoplay: {
                  delay: 0,
                  disableOnInteraction: false // Ensure autoplay continues after interaction
              },
              navigation: {
                  nextEl: '.next',
                  prevEl: '.prev'
              },
              on: {
                  // Resume autoplay on navigation click
                  slideChangeTransitionEnd: function () {
                      this.autoplay.start();
                  }
              }
          });
      }
  
      // Initialize sliders
      initLeftSwiper();
      initRightSwiper();
  
      // Handle window resize event to reinitialize sliders
      $(window).resize(function() {
          // Reinitialize left swiper
          if (typeof leftSwiper !== 'undefined' && leftSwiper !== null) {
              leftSwiper.destroy(true, true);
          }
          initLeftSwiper();
  
          // Reinitialize right swiper
          if (typeof rightSwiper !== 'undefined' && rightSwiper !== null) {
              rightSwiper.destroy(true, true);
          }
          initRightSwiper();
      });
  });
  

  $(".jainam-award-slider, .jainam-news-slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    speed: 1000,
    autoplaySpeed: 1000,
    autoplay: true,
    prevArrow: '<button class="slide-arrow prev-arrow"></button>',
    nextArrow: '<button class="slide-arrow next-arrow"></button>',
    responsive: [
      {
        breakpoint: 1240,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1080,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  document.querySelectorAll('input[type="number"]').forEach(function(input) {
    input.addEventListener('keypress', function(evt) {
        if (evt.which != 8 && evt.which != 0 && (evt.which < 48 || evt.which > 57)) {
            evt.preventDefault();
        }
    });
     input.addEventListener('input', function(evt) {
        if (input.value.length > 10) {
            input.value = input.value.slice(0, 10);
        }
    });
});      

  // contact us tab
  $(document).ready(function() {

    $("ul#tabs li").click(function(e) {
      var tabIndex = $(this).index();
      if (!$(this).hasClass("active")) {
        var nthChild = tabIndex + 1;
        $("ul#tabs li.active").removeClass("active");
        $(this).addClass("active");
        $("#content-tab div.active").removeClass("active");
        $("#content-tab div:nth-child(" + nthChild + ")").addClass("active");
      } else {
        $(this).removeClass("active");
        $("#content-tab div.active").removeClass("active");
      }
    });
  });
  











});


