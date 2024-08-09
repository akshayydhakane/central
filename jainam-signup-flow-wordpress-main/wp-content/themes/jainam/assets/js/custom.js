/******** header menu ********/
$ = jQuery;

$(document).ready(function(){

  $('#burger').on('click',function () {
      $('.header-menu').toggleClass('active');
    });
    $('#burger').on('click',function () {
      $('#burger').toggleClass('active');
    });
    $('#burger').on('click',function () {
      $('body').toggleClass('no-scroll');
  }); 
  /********** header sticky ********/
//   $(window).scroll(function(){
//     if ($(this).scrollTop() > 50) {
//         $('header').addClass('fixed');
//     } else {
//         $('header').removeClass('fixed');
//     }
//   });

  /********** header overlay ********/

// $('.mega-menu-link').hover(function(){
//      $('.overlay').addClass("active");
//    }, function(){
//      $('.overlay').removeClass("active");
// });

  /********** according  ********/

    $(document).ready(function() {
        $('.footer-according-a').click(function(event) {
            event.preventDefault();

            var target = $(this).parent().data('target');
            var $targetDropdown = $(target);
            var $thisLink = $(this);

        if ($targetDropdown.hasClass('active')) {
            $targetDropdown.slideUp(200).removeClass('active');
            $thisLink.removeClass('active');
        } else {
            $('.footer-according-li-dropdown').slideUp(200).removeClass('active');
            $('.footer-according-a').removeClass('active');
            $targetDropdown.slideToggle(200).toggleClass('active');
            $thisLink.toggleClass('active');
        }
    });
});

$(document).ready(function() {
  /*function updateFooterBottomClass() {
      if ($('.footer-according-li-dropdown.active').length > 0) {
          $('.footer-bottom').removeClass('jainam-active');
      } else {
          $('.footer-bottom').addClass('jainam-active');
      }
  }
  updateFooterBottomClass();*/

  const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
          if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
              updateFooterBottomClass();
          }
      });
  });

  const config = {
      attributes: true,
      subtree: true,
      attributeFilter: ['class']
  };

  $('.footer-according-li-dropdown').each(function() {
      observer.observe(this, config);
  });
});

/********** blog list  ********/

$(document).ready(function(){
  $('.blog-list-top-inner a.btn_tab').click(function(){
      $('.blog-list-top-inner a.btn_tab').removeClass('active'); // Remove active class from all links
      $(this).addClass('active'); // Add active class to the clicked link
  }); 
});

$(document).ready(function() {
  $(".set > a").on("click", function() {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this)
        .siblings(".content")
        .slideUp(200);
      $(".set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
    } else {
      $(".set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
      $(this)
        .find("i")
        .removeClass("fa-plus")
        .addClass("fa-minus");
      $(".set > a").removeClass("active");
      $(this).addClass("active");
      $(".content").slideUp(200);
      $(this)
        .siblings(".content")
        .slideDown(200);
    }
  });
});



  document.querySelectorAll('.toc-list a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                const headerHeight = document.querySelector('header').offsetHeight;
                
                window.scrollTo({
                    top: targetElement.offsetTop - headerHeight,
                    behavior: 'smooth'
                });
            });
        });

        jQuery('.hidden-category').hide();
        $('.see-more-opc').on('click', function() {
                $('.hidden-category').each(function() {
                    if ($(this).css('display') === 'none') {
                        $(this).css('display', 'block');
                    } else {
                        $(this).css('display', 'none');
                    }
                });
                
                if ($('.hidden-category').is(':visible')) {
                    $('.see-more-opc').text('See less');
                } else {
                    $('.see-more-opc').text('See more');
                }
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
        
        let question = document.querySelectorAll(".question"); 

        //if (question.length > 0) {
            //question[0].classList.add("active");
            //question[0].nextElementSibling.style.maxHeight = question[0].nextElementSibling.scrollHeight + "px";
        //}

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
          autoplaySpeed: 4000,
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
          autoplaySpeed: 4000,
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
                slidesToShow: 2,
                slidesToScroll: 1,
              },
            },
            {
            breakpoint: 576,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          ],
        });

        $(".footer_bottom_address").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            speed: 1500,
            autoplaySpeed: 4000,
            autoplay: true,
            adaptiveHeight: true,
            // prevArrow: '<button class="slide-arrow prev-arrow"></button>',
            // nextArrow: '<button class="slide-arrow next-arrow"></button>',
          });

        
//home banner slider 
    $(document).ready(function() {
      // Initialize home banner slider
      $('.home-banner-slider-mobile').slick({
          vertical: true,
          verticalSwiping: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 0,
          speed: 5000,
          cssEase: 'linear',
          infinite: true,
          arrows: false,
          touchMove: false,
          swipeToSlide: false,
          swipe: false,
      }); 

      // Define swiper variables globally
      function keepSwiperPlaying(swiper) {
        setInterval(() => {
          if (document.hidden) {
            swiper.slideNext();
          }
        }, 1000 / 60); // Approximately 60 FPS
      }
      
      var leftIn = new Swiper('.left-slide', {
        direction: 'vertical',
        effect: 'slide',
        spaceBetween: 0,
        centeredSlides: true,
        speed: 5000,
        autoplay: {
          delay: 1,
          disableOnInteraction: false,
        },
        loop: true,
        slidesPerView: 'auto',
        allowTouchMove: false,
      });
      
      var rightIn = new Swiper('.right-slide', {
        direction: 'vertical',
        effect: 'slide',
        spaceBetween: 0,
        centeredSlides: true,
        speed: 5000,
        autoplay: {
          delay: 1,
          reverseDirection: true,
          disableOnInteraction: false,
        },
        loop: true,
        slidesPerView: 'auto',
        allowTouchMove: false,
      });
      
      // Call the function to keep both Swipers playing in the background
      keepSwiperPlaying(leftIn);
      keepSwiperPlaying(rightIn);        
  // home slider end 
});

  $('.toc-list li a').on('click', function() {
      // Remove 'active' class from all items
      $('.toc-list li a').removeClass('active');
      // Add 'active' class to the clicked item
      $(this).addClass('active'); 
  });   
  
    // award slider about us page
    $(".award_card_slider").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      speed: 1000,
      rows:2,
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
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      ],
    });

}); 

//blog detail like
document.addEventListener('DOMContentLoaded', function() {
    var svgElement = document.querySelector('.share-blog-detail-left svg');
    if (svgElement) {
        svgElement.addEventListener('click', function() {
            document.querySelector('.share-blog-detail-left').classList.toggle('active');
        });
    } else {
        //console.error('SVG element not found');
    }
});

jQuery(document).ready(function($) {
    $('.glossary .blog-list-top-inner .btn_tab').on('click', function(e) {
        //e.preventDefault();

        var category_slug = $(this).data('slug');
         // Check if the clicked button is the "See more" button
        var isSeeMore = $(this).hasClass('more_btn');

        $.ajax({
            url: glossary_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_glossary',
                nonce: glossary_ajax_object.nonce,
                category: isSeeMore ? '' : category_slug
            },
            success: function(response) {
                $('.glossary_container').html(response);
                $('.glossary-page .blog-list-top-inner .btn_tab').removeClass('active');
                $(e.target).addClass('active'); 
            }
        });
    });

    var headerHeight = $('header').outerHeight(); // Adjust selector to your sticky header

    // Smooth scroll for all internal links
    $('a.alphabet_link').on('click', function(e) { 
        e.preventDefault();

        var target = $(this).attr('href');
        var targetOffset = $(target).offset().top - headerHeight;

        $('html, body').animate({
            scrollTop: targetOffset
        }, 800); // Adjust scroll speed as needed

        // Add active class to clicked link and remove from others
        $('a.alphabet_link').removeClass('active');
        $(this).addClass('active');
    });

    /*$('.single-glossary a.alphabet_slink').on('click', function(e) { 
      //alert("fdsgdfgdfg");
        //e.preventDefault();

        var target = $(this).attr('href');
        var targetOffset = $(target).offset().top - headerHeight;

        $('html, body').animate({
            scrollTop: targetOffset
        }, 800); // Adjust scroll speed as needed

        // Add active class to clicked link and remove from others
        $('a.alphabet_link').removeClass('active');
        $(this).addClass('active');
    });*/

   function adjustScrollPosition() {
      const headerHeight = document.querySelector('header').offsetHeight;
      const hash = window.location.hash;
      if (hash) {
          const targetElement = document.querySelector(hash);
          if (targetElement) {
              // Using setTimeout to ensure this runs after the browser's built-in scrolling
              //setTimeout(() => {
                  const offset = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                  window.scrollTo({
                      top: offset,
                      behavior: 'instant' // Use 'instant' to avoid intermediate scrolling
                  });
              //}, 0);
          }
      }
  }

  // Adjust scroll position on page load
  window.addEventListener('load', adjustScrollPosition);

  // Optional: Adjust scroll position on hash change (for in-page navigation)
  window.addEventListener('hashchange', adjustScrollPosition);


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
        //$(this).removeClass("active");
        //$("#content-tab div.active").removeClass("active");
      }
    });
  });

jQuery(document).ready(function ($) {
    // Check if the browser is Safari
    var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

    function handleStateChange() {
        var state = $('#state').val();
        var district = $('#district');
        
        district.find('option').each(function() {
            var optionValue = $(this).val();

            if (state === 'Maharastra') {
                if (optionValue === 'Mumbai') {
                    $(this).show();
                    $(this).prop('selected', true);

                    // Special handling for Safari
                    if (isSafari) {
                        $(this).removeAttr('disabled');
                    }
                } else {
                    $(this).hide();
                    $(this).prop('selected', false);

                    // Special handling for Safari
                    if (isSafari) {
                        $(this).attr('disabled', 'disabled');
                    }
                }
            } else if (state === 'Gujarat') {
                if (optionValue === 'Mumbai') {
                    $(this).hide();
                    $(this).prop('selected', false);

                    // Special handling for Safari
                    if (isSafari) {
                        $(this).attr('disabled', 'disabled');
                    }
                } else {
                    $(this).show();

                    // Special handling for Safari
                    if (isSafari) {
                        $(this).removeAttr('disabled');
                    }
                }
                district.val('Surat'); // Set default city for Gujarat
            } else {
                $(this).show();

                // Special handling for Safari
                if (isSafari) {
                    $(this).removeAttr('disabled');
                }
            }
        });
    }

    $('#state').val('Gujarat');
    handleStateChange();

    $('#state').change(function () {
        handleStateChange();
        triggerAjaxRequest();
    });

    $('#district').change(function () {
        triggerAjaxRequest();
    });

    function triggerAjaxRequest() {
        var state = $('#state').val();
        var district = $('#district').val();

        if (state && district) {
            $.ajax({
                url: glossary_ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'fetch_locations',
                    state: state,
                    district: district,
                },
                success: function (response) {
                    if (response.success) {
                        var locations = response.data;
                        var html = '';

                        locations.forEach(function (location) {
                            html += '<li>';
                            html += '<div class="address_details">';
                            html += '<h2 class="inter_semibold">' + location.title + '</h2>';
                            html += '<div class="add_info">';
                            html += '<a href="' + location.maplink + '" target="_blank"><span><img src="' + location.locationicon + '" alt="location_icon"></span>' + location.shop_address + '</a>';
                            html += '<a href="javascript:void(0)"><span><img src="' + location.callicon + '" alt="call_icon"></span> ' + location.phone + '</a>';
                            html += '<a href="' + location.maplink + '" target="_blank"><span><img src="' + location.locationicon + '" alt="location_icon"></span></a>';
                            html += '</div>';
                            html += '</div>';
                            html += '</li>';
                        });

                        $('.map_all_address ul').html(html);
                    } else {
                        $('.map_all_address ul').html('<li><div class="address-map address_details"><p>' + response.data + '</p></div></li>');
                    }
                }
            });
        }
    }
});

/*document.addEventListener('DOMContentLoaded', function() {
    var viewMoreBtn = document.getElementById('viewMoreBtn');
    var viewLessBtn = document.getElementById('viewLessBtn');

    var allFaqs = document.querySelectorAll('.page-template-Template-contactus .faq_question_answer');
            
    // Hide all but the first 5 FAQs
    allFaqs.forEach(function(faq, index) {
        if (index > 6) {
            faq.style.display = 'none';
            faq.classList.add('hidden');
        }
    });
    
    if (viewMoreBtn && viewLessBtn) {
        viewMoreBtn.addEventListener('click', function() {
            // Select all hidden FAQs
            var hiddenFaqs = document.querySelectorAll('.page-template-Template-contactus .faq_question_answer.hidden');
            
            // Show all hidden FAQs
            hiddenFaqs.forEach(function(faq) {
                faq.style.display = 'block';
                faq.classList.remove('hidden');
            });

            // Hide the "View more" button and show the "View less" button
            viewMoreBtn.style.display = 'none';
            viewLessBtn.style.display = 'inline-block';
        });

        viewLessBtn.addEventListener('click', function() {
            // Select all FAQs
            var allFaqs = document.querySelectorAll('.page-template-Template-contactus .faq_question_answer');
            
            // Hide all but the first 5 FAQs
            allFaqs.forEach(function(faq, index) {
                if (index > 6) {
                    faq.style.display = 'none';
                    faq.classList.add('hidden');
                }
            });

            // Hide the "View less" button and show the "View more" button
            viewLessBtn.style.display = 'none';
            viewMoreBtn.style.display = 'inline-block';
        });
    }
});*/

jQuery(document).ready(function($) {
    function loadCirculars(category_slug, numofposts, paged) {
        $.ajax({
            url: glossary_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_circulars',
                nonce: glossary_ajax_object.nonce,
                category: category_slug,
                numofposts: numofposts,
                paged: paged,
            },
            success: function(response) {
                $('.glossary-left').html(response);
                $('.circulars-page .comm_tabing .btn_tab').removeClass('active');
                if (category_slug) {
                    $('.circulars-page .comm_tabing .btn_tab[data-slug="' + category_slug + '"]').addClass('active');
                }
            }
        });
    }

    // Initial load
    $('.circulars-page .comm_tabing .btn_tab').on('click', function(e) {
        e.preventDefault();
        var category_slug = $(this).data('slug');
        var numofposts = $('#numofposts').data('numofposts');
        //var numofposts = $(this).data('numofposts');
        loadCirculars(category_slug, numofposts, 1);
    });

    // Handle pagination click
    $(document).on('click', '.circulars-page .page-numbers-button', function(e) {
        e.preventDefault();
        var paged = $(this).attr('data-page'); 
        //alert(paged);
        var category_slug = $('.circulars-page .comm_tabing .btn_tab.active').data('slug');
        var numofposts = $('#numofposts').data('numofposts');
        //var numofposts = $('.circulars-page .comm_tabing .btn_tab.active').data('numofposts');
        var isSeeMore = $(this).hasClass('more_btn');
        loadCirculars(category_slug, numofposts, paged);
    });
});

jQuery(document).ready(function($) {
    function loadGeneralUpdates(category_slug, numofposts, paged) { 
        $.ajax({
            url: glossary_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_generalupdates',
                nonce: glossary_ajax_object.nonce,
                category: category_slug,
                numofposts: numofposts,
                paged: paged,
            },
            success: function(response) {
                $('.glossary-left').html(response);
                $('.general-updates .comm_tabing .btn_tab').removeClass('active');
                if (category_slug) {
                    $('.general-updates .comm_tabing .btn_tab[data-slug="' + category_slug + '"]').addClass('active');
                }
            }
        });
    }

    // Initial load
    $('.general-updates .comm_tabing .btn_tab').on('click', function(e) {
        e.preventDefault();
        var category_slug = $(this).data('slug');
        var numofposts = $('#numofposts').data('numofposts');
        //var numofposts = $(this).data('numofposts');
        loadGeneralUpdates(category_slug, numofposts, 1);
    });

    // Handle pagination click
    $(document).on('click', '.general-updates .page-numbers-button', function(e) {
        e.preventDefault();
        var paged = $(this).attr('data-page'); 
        //alert(paged);
        var category_slug = $('.general-updates .comm_tabing .btn_tab.active').data('slug');
        var numofposts = $('#numofposts').data('numofposts');
        //var numofposts = $('.circulars-page .comm_tabing .btn_tab.active').data('numofposts');
        var isSeeMore = $(this).hasClass('more_btn');
        loadGeneralUpdates(category_slug, numofposts, paged);
    });

});

document.addEventListener('DOMContentLoaded', function() {
  const today = new Date();
  let closestDate = null;
  let closestRow = null;

  const rows = document.querySelectorAll('#holiday-table tr');
  
  rows.forEach(row => {
    const dateText = row.cells[2].innerText;
    const dateParts = dateText.split(' ');
    const dateStr = `${dateParts[2]}-${new Date(Date.parse(dateParts[1] +" 1, 2023")).getMonth() + 1}-${dateParts[0].padStart(2, '0')}`;
    const holidayDate = new Date(dateStr);
    
    if (holidayDate >= today && (closestDate === null || holidayDate < closestDate)) {
      closestDate = holidayDate;
      closestRow = row;
    }
  });

  if (closestRow) {
    closestRow.classList.add('highlight');
  }
});

document.addEventListener('DOMContentLoaded', function() {
   // Iterate over each charter_list
   document.querySelectorAll('.charter_list').forEach(function(charterList) {
      const yearFilter = charterList.querySelector('.year_filter');
      const listItems = charterList.querySelectorAll('ul li');
      
      // Function to show or hide list items based on the selected year
      function filterItems() {
         const selectedYear = yearFilter.value;
         listItems.forEach(function(item) {
            if (item.getAttribute('data-year') === selectedYear) {
               item.style.display = '';
            } else {
               item.style.display = 'none';
            }
         });
      }

      // Check the number of options in the select dropdown
      if (yearFilter.options.length > 1) {
         // Apply the filter function on change
         yearFilter.addEventListener('change', filterItems);
         // Trigger change event to filter items on page load
         yearFilter.dispatchEvent(new Event('change'));
      } else {
         // Show all items if only one option is present in the dropdown
         listItems.forEach(function(item) {
            item.style.display = '';
         });
      }
   });
});

jQuery(document).ready(function($) {
    function loadReports(category_slugs, numofposts, paged, filter_by, search) {
        
        $.ajax({
            url: glossary_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_reports',
                nonce: glossary_ajax_object.nonce,
                categories: category_slugs,
                numofposts: numofposts,
                paged: paged,
                filter_by: filter_by,
                search: search,
            },
            success: function(response) {
                $('.reports_rights').html(response); 
                if ($('.report-box-right-inner').length === 0) {
                    paged = 1; // Reset to page 1 if no reports are found
                }
                $('.page-numbers-button').removeClass('active');
                $('.page-numbers-button[data-page="' + paged + '"]').addClass('active');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Handle search form submission
    $('.reports-page .search-form').on('submit', function(e) {
        e.preventDefault();
        var filterBy = $('.comm_tabing .active').attr('id'); // Get active tab (filter)
        var searchQuery = $('#search_reports').val(); // Get search query
        var selectedCategories = [];
        $('.reports_cat.active').each(function() {
            selectedCategories.push($(this).data('slug'));
        });
        var numofposts = $('#numofposts').data('numofposts');
        loadReports(selectedCategories, numofposts, 1, filterBy, searchQuery);
    });

      $('.reports-page #search_reports').on('input', function() {
          var inputValue = $(this).val().trim();
          if (inputValue === '') { 
              //$('.btn_tab#all').addClass('active');
              $('#search_reports').val('');
              //var numofposts = $('#numofposts').data('numofposts');
              //var filterBy = 'all'; // Reset filter to all 
              //var searchQuery = ''; // Reset search query
              $('.reports-page .search-form').submit(); 
              //loadReports([], numofposts, 1, filterBy, searchQuery); 
          } else {
              console.log('Search input has value:', inputValue);
          }
      });

     $('.reports-page .faq_question_answer .reports_cat').on('click', function() {
        var $checkbox = $(this).prev('input[type="checkbox"]').toggleClass('active'); 
        // Toggle checkbox state
        $checkbox.prop('checked', !$checkbox.prop('checked'));
        // Toggle active class on label
        $(this).toggleClass('active');
    });

    // Handle apply button click
    $('.reports-page #apply_reports').on('click', function(e) {
        e.preventDefault();
        var selectedCategories = [];
        
        $('.reports_cat.active').each(function() {
            selectedCategories.push($(this).data('slug'));
        });

        if ($.isEmptyObject(selectedCategories)) {
           alert("Select at least one category");
           return; // Exit function if no categories are selected
        }

        console.log("Selected Categories on Apply:", selectedCategories); // Debugging
        var numofposts = $('#numofposts').data('numofposts');
        var filterBy = $('.comm_tabing a.active').attr('id'); // Get active filter type
        var searchQuery = $('#search_reports').val(); // Get search query
        loadReports(selectedCategories, numofposts, 1, filterBy, searchQuery);
    });

    // Handle pagination click
    $(document).on('click', '.reports-page .page-numbers-button', function(e) {
        e.preventDefault();
        var paged = $(this).attr('data-page'); 
        var selectedCategories = [];
        $('.reports_cat.active').each(function() {
            selectedCategories.push($(this).data('slug'));
        });
        console.log("Selected Categories on Pagination:", selectedCategories); // Debugging
        var numofposts = $('#numofposts').data('numofposts');
        var filterBy = $('.comm_tabing a.active').attr('id'); // Get active filter type
        var searchQuery = $('#search_reports').val(); // Get search query
        loadReports(selectedCategories, numofposts, paged, filterBy, searchQuery);
    });

    // Handle reset button click
    $('.reports-page #reset_reports').on('click', function(e) {
        e.preventDefault();
        $('input[type="checkbox"]').prop('checked', false);
        $('input[type="checkbox"]').removeClass('active');
        $('.reports_cat').removeClass('active'); // Remove active class
        $('.comm_tabing a').removeClass('active');
        $('.btn_tab#all').addClass('active');
        $('#search_reports').val('');
        var numofposts = $('#numofposts').data('numofposts');
        var filterBy = 'all'; // Reset filter to all 
        var searchQuery = ''; // Reset search query
        loadReports([], numofposts, 1, filterBy, searchQuery);
    });

    // Handle tab click (All, Today, This Week, This Month)
    $('.reports-page .comm_tabing a').on('click', function(e) {
        e.preventDefault();
        $('.comm_tabing a').removeClass('active'); // Remove active class from all tabs
        $(this).addClass('active'); // Add active class to clicked tab
        var filterBy = $(this).attr('id'); // Get filter type
        var searchQuery = $('#search_reports').val(); // Get search query
        var selectedCategories = [];
        $('.reports_cat.active').each(function() {
            selectedCategories.push($(this).data('slug'));
        });
        var numofposts = $('#numofposts').data('numofposts');
        loadReports(selectedCategories, numofposts, 1, filterBy, searchQuery);
    });
});

jQuery(document).ready(function($) {

    var numofposts = $('.forms #numofposts').data('numofposts');
    function loadFormsdownload(category_slug, updateLeft = true, keyword = '', page = 1) {
        $.ajax({
            url: glossary_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'load_forms',
                categories: category_slug,
                updateLeft: updateLeft,
                keyword: keyword,
                numofposts: numofposts,
                paged: page
            },
            success: function(response) {
                var data = $.parseJSON(response); // Parse the JSON response
                //alert(data.left);
                //alert(data.right);
                if (updateLeft) {   
                    $('.form-inner-left').html(data.left);
                }
                $('.form-inner-right').html(data.right);
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    }



    // Handle page number clicks 
    $(document).on('click', '.forms .page-numbers-button', function() {
        var page = $(this).data('page');

        var qslug = $('.form-inner-left .question.active').data('slug') || "";
        var activeLink = $('.forms .faq_question_answer .answer ul li a.active');
        var slug = activeLink.data('slug') || "";

        var pslug = "";
        if (qslug && slug) {
            pslug = slug;
        } else if (qslug && !slug) {
            pslug = qslug;
        }

        var keyword = $('.forms #search_forms').val();
        loadFormsdownload(pslug, false, keyword, page);
    });

    // Handle tab click (All, Today, This Week, This Month)
    $('.forms .comm_tabing a').on('click', function(e) {
        e.preventDefault();
        $('.forms .comm_tabing a').removeClass('active'); // Remove active class from all tabs
        $(this).addClass('active'); // Add active class to clicked tab
        var slug = $(this).data('slug');
        var keyword = $('.forms #search_forms').val(); // Get keyword input value
        loadFormsdownload(slug, true, keyword, 1); // Set updateLeft to true
    });

    $(document).on('click', '.forms .faq_question_answer .question', function(e) {
        e.preventDefault();
        var slug = $(this).data('slug');
        var keyword = $('.forms #search_forms').val(); // Get keyword input value

        $('.forms .faq_question_answer .answer ul li a').removeClass('active');
        loadFormsdownload(slug, false, keyword, 1); // Set updateLeft to false to preserve form-inner-left content
    });

    // Handle click on list item
    $(document).on('click', '.forms .faq_question_answer .answer ul li a', function(e) {
        e.preventDefault();
        //$('html, body').animate({ scrollTop: 0 }, 'fast');
        // Toggle the visibility of the subcategories
        //$(this).next('ul').slideToggle();
        //$('.forms .faq_question_answer .answer ul li.has-subcategories a.has_dropdown').toggleClass('open');

        $('.forms .faq_question_answer .answer ul li a').removeClass('active'); // Remove active class from all tabs
        $(this).addClass('active');
        var slug = $(this).data('slug');
        var keyword = $('.forms #search_forms').val(); // Get keyword input value
        loadFormsdownload(slug, false, keyword, 1); // Set updateLeft to false to preserve form-inner-left content
    });

    $(document).on('click', '.forms .faq_question_answer .answer ul li a.has_dropdown', function(e) {
        e.preventDefault();
        $(this).next('ul').slideToggle();
        $(this).toggleClass('open');
    });

    // Handle form submission for keyword search
    $('.forms .search-form').on('submit', function(e) {
        e.preventDefault();
        var slug = $('.faq_question_answer .question.active').data('slug') || $('.forms .comm_tabing a.active').data('slug'); // Get active tab slug
        var keyword = $('.forms #search_forms').val(); // Get keyword input value
        loadFormsdownload(slug, false, keyword, 1); // Load forms with keyword search
    });

    $('.forms #search_forms').on('input', function() {
        var inputValue = $(this).val().trim();
        if (inputValue === '') { 
            $('#search_forms').val('');
            $('.forms .search-form').submit(); 
        }
    });


        // Trigger click on the first tab to load initial content
        if ($('.forms .btn_tab').length > 0) {
            $('.forms .btn_tab').first().trigger('click');
            //$('.forms .forms .faq_question_answer .question').first().trigger('click');
        }

         $(document).on('click', '.forms .faq_question_answer .question', function(e) {
            // Alert to verify click event
            //alert("Question clicked!");

            // Get the current clicked question
            var $this = $(this);
            var $active = $('.forms .faq_question_answer .question.active');
            
            // Remove active class and reset maxHeight for the currently active question
            if ($active.length && $active[0] !== $this[0]) {
                $active.removeClass('active');
                $active.next('.answercont').css('maxHeight', 0);
            }

            // Toggle active class on the clicked question
            $this.toggleClass('active');
            var $answer = $this.next('.answercont');

            // Set maxHeight based on the active state
            if ($this.hasClass('active')) {
                $answer.css('maxHeight', $answer[0].scrollHeight + 'px');
            } else {
                $answer.css('maxHeight', 0);
            }
        });

    });

    $(document).ready(function() {
        if (window.location.hash === "#tab2") {
            $('.contact-us ul#tabs li').removeClass('active');
            $(".contact-us a#tab2").closest('li').addClass('active');
            $(".contact-us #tab1c").removeClass('active');
            $(".contact-us #tab2c").addClass('active');
        }
    }); 

    $(document).ready(function() {

      $('.technology-left-box.active img.active_tech_icon').show();
      $('.technology-left-box.active img.tech_icon').hide();

        $('.technology-left-box').click(function() {
            var tabId = $(this).attr('id');

            // Remove active class from all left boxes and images
            $('.technology-left-box').removeClass('active');
            $('.technology-inner-right img').removeClass('active');

            // Add active class to clicked left box and corresponding image
            $(this).addClass('active');
            $('.technology-inner-right img#' + tabId).addClass('active');

            // Hide all active tech icons and show all tech icons
            $('.active_tech_icon').hide();
            $('.tech_icon').show();

            // Show the active tech icon and hide the normal tech icon for the clicked box
            $(this).find('.active_tech_icon').show();
            $(this).find('.tech_icon').hide();
        });
    });


jQuery(document).ready(function($) {
    function loadNews(page, category, search) {

        if(page > 1){
            $('#news-container').show();
            $('#loader-articles').hide(); 
            $('#loader').hide();
        }else{
            $('#news-container').hide();
            $('#loader-articles').show(); 
            $('#loader').show();
        }
        
        $.ajax({
            type: 'POST',
            url: glossary_ajax_object.ajax_url,
            data: {
                action: 'filter_news_pagination',
                page: page,
                category: category,
                search: search
            },
            success: function(response) {
                $('.glossary-left').html(response);

                // Ensure the active class is added to the correct page number
                $('.page-numbers-button').removeClass('active');
                $('.page-numbers-button[data-page="' + page + '"]').addClass('active');

                // Filter by category if not 'all'
                if (category !== 'all') {
                    $('.circular_cart').hide();
                    $('.circular_cart[data-categories*="' + category + '"]').show();
                } else {
                    $('.circular_cart').show();
                }
                $('#loader-articles').hide();
                $('#loader').hide();
                $('#news-container').show();
            },
            error: function() {
                $('#loader-articles').hide();
                $('#loader').hide();
                $('#news-container').show();
            }
        });
    }

     function loadArticles(page,category,search) {

        //alert("Trigger click");

        if(page > 1){
            $('#articles-container').show();
            $('#loader').hide();
            $('#loader-articles').hide(); 
        }else{
            $('#loader').show();
            $('#loader-articles').show(); 
            $('#articles-container').hide();
        }
       
        

        $.ajax({
            type: 'POST',
            url: glossary_ajax_object.ajax_url,
            data: {
                action: 'filter_articles_pagination',
                page: page,
                category:category,
                search: search
            },
            success: function(response) {
                $('.glossary-left').html(response);

                // Ensure the active class is added to the correct page number
                $('.page-numbers-button').removeClass('active');
                $('.page-numbers-button[data-page="' + page + '"]').addClass('active');

                $('#loader').hide();
                $('#loader-articles').hide(); 
                $('#articles-container').show();
            },
            error: function() {
                $('#loader').hide();
                $('#loader-articles').hide(); 
                $('#articles-container').show();
            }
        });
    }

    // Handle page number clicks
    $(document).on('click', '#news-container .page-numbers-button', function() {

        var page = $(this).data('page');
        var activeCategory = $('.insta_news_api_categories .comm_tabing .btn_tab.active').data('slug');
        var searchQuery = $('#search_instanews').val();
        loadNews(page, activeCategory,searchQuery);
    });

        function removeURLParameter(url, parameter) {
            var urlObj = new URL(url);
            urlObj.searchParams.delete(parameter);
            return urlObj.toString();
        }
    // Handle page number clicks
    $(document).on('click', '#articles-container .page-numbers-button', function() {

        var page = $(this).data('page');
        var activeCategory = $('.articles_api_categories .comm_tabing .btn_tab.active').data('slug');
        var searchQuery = $('#search_articles').val();
        loadArticles(page, activeCategory,searchQuery);
    });

    $('.insta_news_api_categories .comm_tabing .btn_tab').on('click', function() {
        var category = $(this).data('slug');
        
        $('.insta_news_api_categories .comm_tabing .btn_tab').removeClass('active');
        $(this).addClass('active');

        if (category === 'all') {
            $('.circular_cart').show();
        } else {
            $('.circular_cart').hide();
            $('.circular_cart[data-categories*="' + category + '"]').show();
        }

        var searchQuery = $('#search_instanews').val();

        loadNews(1, category,searchQuery);

    });

    $('.articles_api_categories .comm_tabing .btn_tab').on('click', function() {

        var currentUrl = window.location.href;
        
        // Parameter to remove
        var parameterToRemove = 'article_title';

        // Remove the parameter
        var newUrl = removeURLParameter(currentUrl, parameterToRemove);

        // Update the URL without reloading the page
        window.history.replaceState({}, document.title, newUrl);

        var category = $(this).data('slug');
        
        $('.articles_api_categories .comm_tabing .btn_tab').removeClass('active');
        $(this).addClass('active');

        if (category === 'all') {
            $('.circular_cart').show();
        } else {
            $('.circular_cart').hide();
            $('.circular_cart[data-categories*="' + category + '"]').show();
        }

        var searchQuery = $('#search_articles').val();

        loadArticles(1, category,searchQuery);

    });

    $('.search_instaform').on('submit', function(e) {
        e.preventDefault();
        var searchQuery = $('#search_instanews').val();
        var activeCategory = $('.insta_news_api_categories .comm_tabing .btn_tab.active').data('slug');

        loadNews(1, activeCategory, searchQuery);
    });

    $('#search_instanews').on('input', function() {
          var inputValue = $(this).val().trim();
          if (inputValue === '') { 
              
              $('#search_instanews').val('');
              $('.search_instaform').submit(); 
             
          } else {
              console.log('Search input has value:', inputValue);
          }
      });

    $('.search_articlesform').on('submit', function(e) {
        e.preventDefault();
        var searchQuery = $('#search_articles').val();
        var activeCategory = $('.articles_api_categories .comm_tabing .btn_tab.active').data('slug');

        loadArticles(1, activeCategory, searchQuery);
    });

    $('#search_articles').on('input', function() {
          var inputValue = $(this).val().trim();
          if (inputValue === '') { 
              
              $('#search_articles').val('');
              $('.search_articlesform').submit(); 
             
          } else {
              console.log('Search input has value:', inputValue);
          }
      });

    $('.news_categories li a').on('click', function(e) {
      e.preventDefault();
      //alert("fwfswerr");
        $('.news_categories a').removeClass('active');
        $(this).addClass('active');

        var tabId = $(this).attr('id');

        if (tabId === 'insta_news') {
            $('#articles-container').hide();
            $('#news-container').show();
            var activeCategory = $('.insta_news_api_categories .comm_tabing .btn_tab.active').data('slug');
            var searchQuery = $('#search_instanews').val();
            $('.insta_news_api_categories').show();
            $('.articles_api_categories').hide();

            $('form.search_instaform').show();
            $('form.search_articlesform').hide();
            
            loadNews(1, activeCategory, searchQuery);
        } else if (tabId === 'articles') {

          let urlParams = new URLSearchParams(window.location.search);
          let articleTitle = urlParams.get('article_title');

            $('#news-container').hide();
            $('#articles-container').show();
            $('.insta_news_api_categories').hide();
            $('.articles_api_categories').show();

            $('form.search_instaform').hide();
            $('form.search_articlesform').show();

            var activeCategory = $('.articles_api_categories .comm_tabing .btn_tab.active').data('slug');
            var searchQuery = $('#search_articles').val();

            if(articleTitle !== "" && searchQuery === ""){
              loadArticles(1,activeCategory,articleTitle); 
            }else{
              loadArticles(1,activeCategory,searchQuery); 
            }

            
        }
    });

});

$(document).ready(function() {
  //document.addEventListener('DOMContentLoaded', function() {
     
    let urlParams = new URLSearchParams(window.location.search);
    let articleTitle = urlParams.get('article_title');

    if (articleTitle) {
      //alert(articleTitle);       
      $("#articles").trigger('click');
    }

  //});
});

$(document).ready(function() {
    $(document).on('click', '.click-social-modal', function(e) {
      //alert("gsgdgd");
         e.preventDefault();
        $(".custom-model-main").addClass('model-open');
        $("body").addClass('overflow');  // Add 'overflow' class to body

        var newsItem = $(this).closest('.circular_cart');
        var newsTitle = newsItem.data('title');
        var newsUrl = newsItem.data('url');
        var newsDescription = newsItem.data('description');

        //$('#shareModal').show();
        
        // Update share links with news data
        $('#shareTelegram').attr('href', 'https://t.me/share/url?url=' + encodeURIComponent(newsUrl) + '&text=' + encodeURIComponent(newsTitle));
        $('#shareTwitter').attr('href', 'https://twitter.com/share?url=' + encodeURIComponent(newsUrl) + '&text=' + encodeURIComponent(newsTitle));
        $('#shareWhatsapp').attr('href', 'https://api.whatsapp.com/send?text=' + encodeURIComponent(newsTitle + ' ' + newsUrl));
        $('#shareFacebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(newsUrl));
        $('#shareEmail').attr('href', 'mailto:?subject=' + encodeURIComponent(newsTitle) + '&body=' + encodeURIComponent(newsDescription + ' ' + newsUrl));
        $('#shareInstagram').attr('href', 'https://instagram.com');

    });

    $(".close-btn, .bg-overlay").on('click', function() {
        $(".custom-model-main").removeClass('model-open');
        $("body").removeClass('overflow');  // Remove 'overflow' class from body
    });
});

$(document).ready(function () {

  function resetContactForm() {
      $('.wpcf7-form').each(function() {
          this.reset(); // Reset the form
      });
  }
  //Comman-modal
  $(document).on('click', '.click-partner-modal', function(e) {
    resetContactForm();
    e.preventDefault();

    $('.wpcf7-form')[0].reset();
    $('.wpcf7-response-output').text('');
    $(".custom-model-main").addClass("model-open");
    $("body").addClass("overflow"); // Add 'overflow' class to body

     // Set India as default selected option
    var $select = $('.country_auto');
    $select.val('India').change(); // This will select India and trigger the change event
    
    // Remove all other options except India
    $select.find('option').not('[value="India"]').remove();
    
    // Trigger the change event to ensure AJAX request is fired
    $select.trigger('change');
    
  });

  $(".close-btn, .bg-overlay").on("click", function () {

      resetContactForm();
      $('.wpcf7-response-output').text('');
      $('.wpcf7-form')[0].reset();

     $(".custom-model-main").removeClass("model-open");
    $("body").removeClass("overflow"); // Remove 'overflow' class from body
  });

  $(".technology-left-box").click(function () {
    var tabId = $(this).attr("id");

    // Remove active class from all left boxes and images
    $(".technology-left-box").removeClass("active");
    $(".technology-inner-right img").removeClass("active");

    // Add active class to clicked left box and corresponding image
    $(this).addClass("active");
    $(".technology-inner-right img#" + tabId).addClass("active");
  }); 
}); 


$(document).ready(function () {
  function AddReadMore() {
    let carLmt = 100;
    let readMoreTxt = " read more";
    let readLessTxt = " read less";

    //Traverse all selectors with this class and manupulate HTML part to show Read More
    $(".add-read-more").each(function () {
      if ($(this).find(".first-section").length) return;

      let allstr = $(this).text();
      if (allstr.length > carLmt) {
        let firstSet = allstr.substring(0, carLmt);
        let secdHalf = allstr.substring(carLmt, allstr.length);
        let strtoadd =
          firstSet +
          "<span class='second-section'>" +
          secdHalf +
          "</span><span class='read-more'  title='Click to Show More'>" +
          readMoreTxt +
          "</span><span class='read-less' title='Click to Show Less'>" +
          readLessTxt +
          "</span>";
        $(this).html(strtoadd);
      }
    });

    //Read More and Read Less Click Event binding
    $(document).on("click", ".read-more,.read-less", function () {
      $(this)
        .closest(".add-read-more")
        .toggleClass("show-less-content show-more-content");
    });
  }

  AddReadMore();
});

$(document).ready(function() {
    document.addEventListener('wpcf7invalid', function(event) {
        // Remove existing validation messages
        $('.wpcf7-not-valid-tip').remove();
    }, false);
});

jQuery(document).ready(function($) {

    var mobileInput = document.querySelector('.wpcf7-form .jainam_number');
      if (mobileInput) {
          mobileInput.addEventListener('input', function() {
              var thankYouMessage = document.querySelector('.wpcf7-response-output');
              if (thankYouMessage) {
                  thankYouMessage.style.display = '';
                  thankYouMessage.classList.remove('fade-out');
                  thankYouMessage.innerHTML = '';
                  console.log("Removed 'fade-out' class and cleared the thank you message.");
              }
          });
      }

   document.addEventListener('wpcf7mailsent', function(event) {
  // if (event.detail.contactFormId == '2986') { // Replace '3526' with your actual form ID
      console.log("Form ID matched. Waiting to hide the thank you message.");
      setTimeout(function() {
          var thankYouMessage = document.querySelector('.wpcf7-response-output');
          console.log("Thank you message element:", thankYouMessage);
          if (thankYouMessage) {
              thankYouMessage.classList.add('fade-out');
              // Force a reflow
              thankYouMessage.offsetWidth;
              console.log("Class 'fade-out' added.");
              setTimeout(function() {
                  thankYouMessage.style.display = 'none';
                  console.log("Thank you message hidden.");
              }, 500); // Match this with the CSS transition duration
          }
      }, 3000); // 5000 milliseconds = 5 seconds
  //}
      //event.target.reset(); // Reset the form
}, false);

/*
  $('form.wpcf7-form').on('focus', 'input:not([type="submit"])', function() {
      var thankYouMessage = $(this).closest('form').find('.wpcf7-response-output');
      if (thankYouMessage.length) {
          thankYouMessage.hide();
      }
  });
*/
  /*var $countrySelect = $('.wpcf7-form select[name="country"]');
      $countrySelect.find('option:first-child').replaceWith('<option value="" selected disabled>— Please select the country —</option>');


  var $stateSelect = $('.wpcf7-form select[name="state"]');
    $stateSelect.find('option:first-child').replaceWith('<option value="" selected disabled>— Please select the state —</option>');

    // Replace first option with placeholder for City dropdown
    var $citySelect = $('.wpcf7-form select[name="city"]');
    $citySelect.find('option:first-child').replaceWith('<option value="" selected disabled>— Please select the city —</option>');*/
});

jQuery(document).ready(function($) {

    $('#blog_search_field').val('');

    window.addEventListener('beforeunload', function() {
            $('#blog_search_field').val('');
    });

    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            $('#blog_search_field').val('');
        }
    });

    // Select the input with name 'mobile' and set its type to 'number'
    var $mobileInput = $('input[name="mobile"]');
    $mobileInput.attr({
        'type': 'tel',
        'minlength': 10,
        'maxlength': 10
    });

    // Prevent non-numeric input
    $mobileInput.on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $mobileInput.attr('type', 'tel'); // Set type to 'tel' for better mobile support

    // Prevent non-numeric input
    $mobileInput.on('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });

    var $mobileInput = $('.jainam_number');

    // Function to validate mobile number on form submission
    $('form.wpcf7-form').on('submit', function(event) {
        var phoneValue = $mobileInput.val();
        if (phoneValue.length !== 10 || phoneValue.startsWith('0')) {
            event.preventDefault(); // Prevent form submission
            //alert("Please enter a valid mobile number with exactly 10 digits.");
        }
    });
});

jQuery(document).ready(function($) {

    // Debounce function to delay the execution of the function
    /*function debounce(func, delay) {
        let debounceTimer;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        }
    }*/

    const debounce = (func, wait, immediate) => {
    let timeout
  
    return function() {
      const context = this, args = arguments
      const later = function() {
        timeout = null
        if (!immediate) func.apply(context, args)
      }
  
      const callNow = immediate && !timeout
      clearTimeout(timeout)
      timeout = setTimeout(later, wait)
      if (callNow) func.apply(context, args)
    }
  }

    $('body').on('click', function(e) {
        if (!$(e.target).closest('.header_custom_search').length && !$(e.target).closest('.serch-bar-header').length) {
            $('#header_custom_search').val('').blur();
            $('.serch-bar-header').hide();
        }
    });

    $('.headersearch_close_responsive').on('click', function(e) { 

          $('#header_custom_search').val('').blur();
          $('.serch-bar-header').hide();
          $('.no_result_found').hide();
          $('.validation-message').hide();
    });

});

/*    function fetchPosts() {
        $('.serch-bar-tab-content').removeClass('active').empty();
        $('.serch-bar-inner-tab ul li').find('a.tab-link').removeClass('active');
        $('.serch-bar-inner-tab ul li:first-child a.tab-link').addClass('active');
        $('#content-blogs2').addClass('active');

        $.ajax({
            url: glossary_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'search_empty_header'
            },
            success: function(responseresult) {
                if (responseresult.success) {
                    let data = responseresult.data;
                    $('#loader-search').hide();
                    $('#content-blogs2').empty().html(data.blogs);
                    $('#content-circulars2').empty().html(data.circulars);
                    $('#content-news2').empty().html(data.news);
                    $('#content-articles2').empty().html(data.articles);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + status + error);
            }
        });
    } 

    $('#header_custom_search').on('focus', function(){
        $('.serch-bar-header').show();
        let searchValue = $('#header_custom_search').val();
        if(searchValue === "" || searchValue === 0){
            $('#loader-search').show();
            fetchPosts();
            return;
        }
    });

    $('#header_custom_search').on('keypress', function(e) {
        if (e.which == 13) {  // Enter key corresponds to code 13
            e.preventDefault();
        }
    });

document.querySelector('#header_custom_search').addEventListener('keyup', debounce(() => {
    $('#loader-search').show();
    $('.serch-bar-tab-content-box.emtheader').attr('style', 'display:none !important;');

    $("#content-blogs").empty();
    $("#content-circulars2").empty();
    $("#content-news2").empty();
    $("#content-articles2").empty();

    $('.serch-bar-tab-content-box').empty();
    $('.serch-bar-tab-content-box.emtheader').hide();
    $('.serch-bar-tab-content .no_result_founds').hide(); 
    $('.serch-bar-tab-content').empty(); 

    let searchValue = $("#header_custom_search").val().trim();  
    
    $('.serch-bar-header').show();
    $('.tab-link').parent().show(); // Show all tabs initially

    if ($("#header_custom_search").val().length > 0) {
        $('.tab-link').removeClass('active');
        $('.serch-bar-tab-content').removeClass('active');
        $('.serch-bar-tab-content .no_result_founds').hide(); 
        $('.serch-bar-tab-content').empty(); 

        $.ajax({
            url: glossary_ajax_object.ajax_url,
            type: 'GET',
            data: {
                action: 'header_custom_search',
                s: searchValue
            },
            success: function(response) {
                $('.serch-bar-inner').show();
                let results = response.data || [];
                
                if (!Array.isArray(results)) {
                    results = [];
                }

                let postTypesWithResults = {};
                let firstTab = null;

                if (results.length > 0) {
                    $('.serch-bar-tab-content .no_result_founds').hide(); 
                    results.forEach(function(result) {
                        let contentBox = `<div class="serch-bar-tab-content-box">
                            <p><a href="${result.permalink}" target="_blank" class="header_search_link">${result.title}</a></p>
                            <span>${result.post_type}</span>
                        </div>`;

                        switch(result.post_type) {
                            case 'post':
                                $('#content-blogs2').append(contentBox);
                                postTypesWithResults['blogs2'] = true;
                                if (!firstTab) firstTab = 'blogs2';
                                break;
                            case 'circular':
                                $('#content-circulars2').append(contentBox);
                                postTypesWithResults['circulars2'] = true;
                                if (!firstTab) firstTab = 'circulars2';
                                break;
                            case 'news':
                                $('#content-news2').append(contentBox);
                                postTypesWithResults['news2'] = true;
                                if (!firstTab) firstTab = 'news2';
                                break;
                            case 'articles':
                                $('#content-articles2').append(contentBox);
                                postTypesWithResults['articles2'] = true;
                                if (!firstTab) firstTab = 'articles2';
                                break;
                            default:
                                break;
                        }
                    });
                }

                ['blogs2', 'circulars2', 'news2', 'articles2'].forEach(function(tab) {
                    if (!postTypesWithResults[tab]) {
                        $(`#content-${tab}`).html('<div class="no_result_founds serch-bar-tab-content-box"><img src="' + wpData.imageUrl + '"/></div>');
                    }
                });

                if (firstTab) {
                    $('.tab-link').removeClass('active');
                    $('.serch-bar-tab-content').removeClass('active');
                    $('.serch-bar-inner-tab ul li:first-child a.tab-link').addClass('active');
                    $(`#content-${firstTab}`).addClass('active');
                } else if (results.length === 0) {
                    $('.tab-link').removeClass('active');
                    $('.serch-bar-tab-content').removeClass('active');
                    $('.serch-bar-inner-tab ul li:first-child a.tab-link').addClass('active');
                    $('.serch-bar-tab-content:first').addClass('active').html('<div class="no_result_founds serch-bar-tab-content-box"><img src="' + wpData.imageUrl + '"/></div>');
                }

                $('#loader-search').hide();
            }, 
            error: function() {
                $('.serch-bar-header').show();
                $('.serch-bar-inner').show();
                ['blogs2', 'circulars2', 'news2', 'articles2'].forEach(function(tab) {
                    $(`#content-${tab}`).html('<div class="no_result_founds serch-bar-tab-content-box"><img src="' + wpData.imageUrl + '"/></div>');
                });
                $('.tab-link:first').addClass('active');
                $('.serch-bar-tab-content:first').addClass('active');
                $('#loader-search').hide();
            }
        });
    } else {
        fetchPosts();
        return;  
    } 
}, 500));*/ // Adjust the debounce delay as needed (300ms in this example)

let currentAjaxRequest = null;

function fetchPosts() {
    if (currentAjaxRequest) {
        currentAjaxRequest.abort();
    }

    $('.serch-bar-tab-content').removeClass('active').empty();
    $('.serch-bar-inner-tab ul li').find('a.tab-link').removeClass('active');
    $('.serch-bar-inner-tab ul li:first-child a.tab-link').addClass('active');
    $('#content-blogs2').addClass('active');

    currentAjaxRequest = $.ajax({
        url: glossary_ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'search_empty_header'
        },
        success: function(responseresult) {
            currentAjaxRequest = null;
            if (responseresult.success) {
                let data = responseresult.data;
                $('#loader-search').hide();
                $('#content-blogs2').empty().html(data.blogs);
                $('#content-circulars2').empty().html(data.circulars);
                $('#content-news2').empty().html(data.news);
                $('#content-articles2').empty().html(data.articles);
            }
        },
        error: function(xhr, status, error) {
            currentAjaxRequest = null;
            console.log('AJAX Error: ' + status + error);
        }
    });
}

function debounce(func, wait) {
    let timeout;
    return function(...args) {
        const context = this;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
    };
}

$(document).ready(function() {
    $('#header_custom_search').on('focus', function() {
        $('.serch-bar-header').show();
        let searchValue = $('#header_custom_search').val();
        if (searchValue === "" || searchValue === 0) {
            $('#loader-search').show();
            fetchPosts();
            return;
        }
    });

    document.querySelector('#header_custom_search').addEventListener('keyup', debounce(() => {
        $('#loader-search').show();
        $('.serch-bar-tab-content-box.emtheader').attr('style', 'display:none !important;');

        $("#content-blogs").empty();
        $("#content-circulars2").empty();
        $("#content-news2").empty();
        $("#content-articles2").empty();

        $('.serch-bar-tab-content-box').empty();
        $('.serch-bar-tab-content-box.emtheader').hide();
        $('.serch-bar-tab-content .no_result_founds').hide();
        $('.serch-bar-tab-content').empty();

        let searchValue = $("#header_custom_search").val().trim();

        $('.serch-bar-header').show();
        $('.tab-link').parent().show(); // Show all tabs initially

        if ($("#header_custom_search").val().length > 0) {
            $('.tab-link').removeClass('active');
            $('.serch-bar-tab-content').removeClass('active');
            $('.serch-bar-tab-content .no_result_founds').hide();
            $('.serch-bar-tab-content').empty();

            if (currentAjaxRequest) {
                currentAjaxRequest.abort();
            }

            currentAjaxRequest = $.ajax({
                url: glossary_ajax_object.ajax_url,
                type: 'GET',
                data: {
                    action: 'header_custom_search',
                    s: searchValue
                },
                success: function(response) {
                    currentAjaxRequest = null;
                    $('.serch-bar-inner').show();
                    let results = response.data || [];

                    if (!Array.isArray(results)) {
                        results = [];
                    }

                    let postTypesWithResults = {};
                    let firstTab = null;

                    if (results.length > 0) {
                        $('.serch-bar-tab-content .no_result_founds').hide();
                        results.forEach(function(result) {
                            let contentBox = `<div class="serch-bar-tab-content-box">
                                <p><a href="${result.permalink}" target="_blank" class="header_search_link">${result.title}</a></p>
                                <span>${result.post_type}</span>
                            </div>`;

                            switch (result.post_type) {
                                case 'post':
                                    $('#content-blogs2').append(contentBox);
                                    postTypesWithResults['blogs2'] = true;
                                    if (!firstTab) firstTab = 'blogs2';
                                    break;
                                case 'circular':
                                    $('#content-circulars2').append(contentBox);
                                    postTypesWithResults['circulars2'] = true;
                                    if (!firstTab) firstTab = 'circulars2';
                                    break;
                                case 'news':
                                    $('#content-news2').append(contentBox);
                                    postTypesWithResults['news2'] = true;
                                    if (!firstTab) firstTab = 'news2';
                                    break;
                                case 'articles':
                                    $('#content-articles2').append(contentBox);
                                    postTypesWithResults['articles2'] = true;
                                    if (!firstTab) firstTab = 'articles2';
                                    break;
                                default:
                                    break;
                            }
                        });
                    }

                    ['blogs2', 'circulars2', 'news2', 'articles2'].forEach(function(tab) {
                        if (!postTypesWithResults[tab]) {
                            $(`#content-${tab}`).html('<div class="no_result_founds serch-bar-tab-content-box"><img src="' + wpData.imageUrl + '"/></div>');
                        }
                    });

                    if (firstTab) {
                        $('.tab-link').removeClass('active');
                        $('.serch-bar-tab-content').removeClass('active');
                        $('.serch-bar-inner-tab ul li:first-child a.tab-link').addClass('active');
                        $(`#content-${firstTab}`).addClass('active');
                    } else if (results.length === 0) {
                        $('.tab-link').removeClass('active');
                        $('.serch-bar-tab-content').removeClass('active');
                        $('.serch-bar-inner-tab ul li:first-child a.tab-link').addClass('active');
                        $('.serch-bar-tab-content:first').addClass('active').html('<div class="no_result_founds serch-bar-tab-content-box"><img src="' + wpData.imageUrl + '"/></div>');
                    }

                    $('#loader-search').hide();
                },
                error: function() {
                    currentAjaxRequest = null;
                    $('.serch-bar-header').show();
                    $('.serch-bar-inner').show();
                    ['blogs2', 'circulars2', 'news2', 'articles2'].forEach(function(tab) {
                        $(`#content-${tab}`).html('<div class="no_result_founds serch-bar-tab-content-box"><img src="' + wpData.imageUrl + '"/></div>');
                    });
                    $('.tab-link:first').addClass('active');
                    $('.serch-bar-tab-content:first').addClass('active');
                    $('#loader-search').hide();
                }
            });
        } else {
            fetchPosts();
            return;
        }
    }, 500)); // Adjust the debounce delay as needed (500ms in this example)
});


 $(document).ready(function() {

    $('.tab-link').on('click', function() {
        let tabId = $(this).data('tab');
         
        let searchValue = $('#header_custom_search').val();

        /*if(searchValue === ""){

          $('.serch-bar-tab-content .no_result_founds').hide();
          $("#content-blogs").empty();
          $("#content-circulars2").empty();
          $("#content-news2").empty();
          $("#content-articles2").empty();

          if(tabId == 'blogs2'){
               $('#content-blogs2').html('<div class="serch-bar-tab-content-box emtheader">Start searching for blogs</div>');
          }

          if(tabId == 'circulars2'){
                $('#content-circulars2').html('<div class="serch-bar-tab-content-box emtheader">Start searching for circulars</div>');
          }

          if(tabId == 'news2'){
                $('#content-news2').html('<div class="serch-bar-tab-content-box emtheader">Start searching for news</div>');
          }

          if(tabId == 'articles2'){
                $('#content-articles2').html('<div class="serch-bar-tab-content-box emtheader">Start searching for articles</div>');
          }
        }
        */
        $('.tab-link').removeClass('active');
        $(this).addClass('active');
        $('.serch-bar-tab-content').removeClass('active');
        $('#content-' + tabId).addClass('active');
    });
});

 $(document).ready(function() {

  $('.close_old_website span').on('click', function() {
      $('.old_website').hide();
  });
  
  $('li.mega-menu-link').hover(
    function() {
      $('#serch-bar-header-2').hide();
      $('.serch-bar-menu').hide();
      $('#header_custom_search').val('').blur();
    }
  );
  $('.header-menu ul').hover(
    function() {
      $('#serch-bar-header-2').hide();
      $('.serch-bar-menu').hide();
      $('#header_custom_search').val('').blur();
    }
  );
});

function isSafari() {
    return /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
}

$(window).on('load', function() {
    const caturlParams = new URLSearchParams(window.location.search);
    const categoryFromUrl = caturlParams.get('category');

    const categoryLinks = $('.blog_categories_filterfromurl .category-filter');

    let categoryFound = false;
    if (categoryFromUrl) {
        categoryLinks.each(function() {
            const $link = $(this);
            const category = $link.data('category');

            if ($link.hasClass('active')) {
                $link.removeClass('active');
            }

            if (category === categoryFromUrl) {
                $link.addClass('active');
                $link.addClass('catactive'); 
                setTimeout(function() {
                    $link[0].click(); // Native JS click event
                }, 50); // Small delay to ensure full load/rendering

                categoryFound = true;
                if ($link.hasClass('hidden-category')) {
                    setTimeout(function() {
                        document.querySelector('.see-more-opc').click(); // Native JS click event
                    }, 100); // Small delay to ensure full load/rendering
                }
            } else {
                $link.addClass('notcatactive'); 
            }
        });
    }
});

$(document).ready(function() {
    // Use event delegation to handle click events on dynamically added elements
    $(document).on('click', '.blog_categories_filterfromurl .category-filter.notcatactive', function(e) {
        // Prevent the default action of the link
        e.preventDefault();

        // Remove the 'catactive' class from all category links
        $('.blog_categories_filterfromurl .category-filter').removeClass('catactive');

        // Add the 'catactive' class to the clicked link
        //$(this).addClass('catactive');

        let url = new URL(window.location.href);
        url.searchParams.delete('category');
        window.history.pushState({}, '', url);

    }); 
});

$(document).ready(function() {
    $(document).on('click', '.page-numbers .page-numbers-button', function() {
        console.log('Button clicked');
        
        // Get the height of the fixed header
        var headerHeight = $('header').outerHeight(); // Adjust the selector to match your header element
        
        // Calculate the scroll offset, subtracting the header height
        var scrollOffset = $('.custompaginationscroll').offset().top - headerHeight;
        
        // Animate the scroll
        $('html, body').animate({
            scrollTop: scrollOffset
        }, 1000); // Adjust the duration as needed (1000 milliseconds = 1 second)
    });
});

/*$(document).ready(function() {
  document.getElementById('pstate').addEventListener('change', function() {
      var state = this.value;
      var district = document.getElementById('pdistrict');
      
      if (state === 'Gujarat') {
          for (var i = 0; i < district.options.length; i++) {
              if (district.options[i].value === 'Surat') {
                  district.selectedIndex = i;
                  break;
              }
          }
      }

      if (state === 'Maharastra') {
          for (var i = 0; i < district.options.length; i++) {
              if (district.options[i].value === 'Mumbai') {
                  district.selectedIndex = i;
                  break;
              }
          }
      }
  });
});*/ 

$(document).ready(function() {
    $('#pstate').change(function() {
        var selectedState = $(this).val();
        var cityOptions = $('#pdistrict option');
        
        cityOptions.each(function() {
            var city = $(this).val();
            if (selectedState === "Gujarat") {
                if (city === "Mumbai") {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            } else if (selectedState === "Maharastra") {
                if (city === "Mumbai") {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            } else {
                $(this).show();
            }
        });

        // Reset the city dropdown to the default option
        $('#pdistrict').val("");
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.comman_modal .wpcf7-form').addEventListener('submit', function(event) {
        let hasError = false;

        let country = document.getElementsByName('country')[0];
        let state = document.getElementsByName('state')[0];
        let city = document.getElementsByName('city')[0];


        // Clear previous errors
        let errorElements = document.querySelectorAll('.error-message');
        errorElements.forEach(function(el) {
            el.remove();
        });


        if (country && country.value === '0') {
            hasError = true;
            let error = document.createElement('span');
            error.className = 'error-message';
            error.textContent = 'Please select a country';
            country.parentElement.appendChild(error);
        }


        if (state && state.value === '0') {
            hasError = true;
            let error = document.createElement('span');
            error.className = 'error-message';
            error.textContent = 'Please select a state';
            state.parentElement.appendChild(error);
        }


        if (city && city.value === '0') {
            hasError = true;
            let error = document.createElement('span');
            error.className = 'error-message';
            error.textContent = 'Please select a city';
            city.parentElement.appendChild(error);
        }


        if (hasError) {
            event.preventDefault(); // Prevent form submission if there are errors
        }
    });
});