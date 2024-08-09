jQuery(document).ready(function($) {
   var defaultPage = 1; // Default page number for default posts
   var currentCategory = 'all_cat'; // Default category

   // Function to load posts based on page and category
   function loadPosts(page, category) {
       $.ajax({
           type: 'POST',
           url: ajax_params.ajax_url,
           data: {
               action: 'load_circular_posts',
               nonce: ajax_params.nonce,
               page: page,
               category: category
           },
           beforeSend: function() {
            $('#ajax-loader').show();
           },
           success: function(response) {
            //   var data = JSON.parse(response);
            //   $('#article-grid').html(data.posts); // Update posts grid
            //   $('.pagination').html(data.pagination); // Update pagination
            //   $('#ajax-loader').hide();
            var data = JSON.parse(response);

            // Get the height of the content container before updating it
            var $articleGrid = $('#article-grid');
            var initialHeight = $articleGrid.height();

            // Fade out the current content
            $articleGrid.fadeTo(300, 0, function() {
                // Set the height of the container to its initial height to avoid jump
                $articleGrid.height(initialHeight);

                // Update the content and pagination
                $articleGrid.html(data.posts);
                $('.pagination').html(data.pagination);

                // Fade in the new content
                $articleGrid.fadeTo(300, 1, function() {
                    // Reset the height of the container to auto after fade in
                    $articleGrid.height('auto');
                });

                $('#ajax-loader').hide();
            });
           },
           complete: function() {
               // Remove loading indicator
               $('#ajax-loader').hide();
           },
           error: function(xhr, status, error) {
               console.log(xhr.responseText); // Log any AJAX errors to console
               $('#ajax-loader').hide();
           }
       });
   }

   // Event listener for clicking on pagination links
   $(document).on('click', '.page-numbers-button', function(e) {
       e.preventDefault();
       var selectedPage = $(this).attr('data-page');
       console.log(selectedPage);
       defaultPage = parseInt(selectedPage);
       loadPosts(defaultPage, currentCategory);
   });


   // Event listener for clicking on category filter
   $('.circulars-page .comm_tabing .btn_tab').on('click', function(e) {
       e.preventDefault();
       var clickedCategory = $(this).data('category');
       currentCategory = clickedCategory;
       defaultPage = 1; // Reset page number
       loadPosts(defaultPage, currentCategory);
   });

   // Initial load of default posts
   loadPosts(defaultPage, currentCategory); // Load all posts by default
});
