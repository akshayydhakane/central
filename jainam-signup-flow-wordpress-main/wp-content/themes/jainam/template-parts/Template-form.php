<?php

/**
 * Template Name: Form
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css.map" />

<style>
    .question.no_sub:after{
        display:none;
    }
    .question.no_sub.active {
        padding-bottom: 0px !important;
    }
    .question.active {
        color: #2A948F; /* Text color when active */
    }
    
</style>

<?php
global $posy;

// Get the content with the_content filters applied
$content = apply_filters('the_content', get_the_content());

// Remove <p> tags
$content = strip_tags($content, '<a><b><i><strong><em><ul><ol><li>');

$form_page_label = get_field('form_page_label');
?>

    <main class="form-page <?php echo $post->post_name; ?>"> 
    
    <section class="form-banner-section">
        <div class="container">
            <div class="form-banner-inner">
                <?php if($form_page_label){
                ?>
                    <h1><?php echo $form_page_label; ?></h1>
                <?php }else { ?>
                    <h1>Form Download</h1>
                <?php
                }
                ?>
                
                <p><?php echo $content; ?></p>
            </div>
        </div>
    </section>
    
    <section class="form-section">
        <div class="container">
            <div class="form-title">
            
                    <?php

                        $args = array(
                            'taxonomy'   => 'form_download_category',
                            'parent'     => 0,  // Get only top-level (parent) terms
                            'hide_empty' => false,  // Change to true if you want to hide empty terms
                        );

                        $main_categories = get_terms( $args );

                        if ( ! empty( $main_categories ) && ! is_wp_error( $main_categories ) ) {
                            $count = 1;
                            echo '<div class="tab_div"><ul class="comm_tabing">';
                            foreach ( $main_categories as $main_categorie ) {
                                // Add the active class only to the first li element
                                $add_class = ($count == 1) ? "active" : "";
                                echo '<li><a href="javascript:void(0)" data-slug="' . esc_html( $main_categorie->slug ) . '" class="btn_tab ' . esc_attr($add_class) . '">' . esc_html( $main_categorie->name ) . '</a></li>';
                                $count++;
                            }
                            echo '</ul></div>';
                        } else {
                            echo 'No parent categories found.';
                        }

                    ?>
               
                <div class="form-search">
                    <form class="search-form" >
                        <div class="input-group">
                            <input type="search" class="search-field search_forms" id="search_forms" placeholder="Search Forms" required>
                            <button class="btn_serch" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                    <g opacity="0.8">
                                        <path d="M16.6843 16.6844L22 22M19.3756 10.1874C19.3756 15.2616 15.2622 19.3749 10.1881 19.3749C5.11399 19.3749 1.00061 15.2616 1.00061 10.1874C1.00061 5.11332 5.11399 0.999939 10.1881 0.999939C15.2622 0.999939 19.3756 5.11332 19.3756 10.1874Z" stroke="#141414" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div> 
            </div>

            <div class="form-section-inner"> 
            <?php
                $number_of_post_to_display = get_field('number_of_post_to_display');
            ?>
            <input type="hidden" id="numofposts" data-numofposts="<?php echo $number_of_post_to_display; ?>"/>
             <?php
                    //ob_start(); 
                    echo '<div class="form-inner-left">';
                    $parent_term = get_term_by('slug', 'forms', 'form_download_category');
                       $sub_args = array(
                            'taxonomy'   => 'form_download_category',
                            'parent'     => $parent_term->term_id,
                            'hide_empty' => false,
                        );

                        $subcategories = get_terms($sub_args);

                        if (!empty($subcategories) && !is_wp_error($subcategories)) {
                            $count = 1;
                            $active_applied = false;

                            foreach ($subcategories as $subcategory) {
                                // Fetch sub-subcategories
                                $sub_sub_args = array(
                                    'taxonomy'   => 'form_download_category',
                                    'parent'     => $subcategory->term_id,
                                    'hide_empty' => false,
                                );

                                $sub_subcategories = get_terms($sub_sub_args);

                                if (empty($sub_subcategories)) {
                                    $add_fclass = "no_sub";    
                                    $active_class = "";
                                    $max_height_style = "";
                                } else {
                                    $add_fclass = "";
                                    if (!$active_applied) {
                                        $active_class = "active";
                                        $max_height_style = "style='max-height: 104px;'"; // Set your desired max-height value here
                                        $active_applied = true;
                                    } else {
                                        $active_class = "";
                                        $max_height_style = ""; 
                                    }
                                }

                                echo '<div class="faq_question_answer">';
                                echo '<div class="question '.$add_fclass.' '.$add_class.' '.$active_class.'" data-slug="' . esc_attr($subcategory->slug) . '">' . esc_html($subcategory->name) . '</div>';

                                if (!empty($sub_subcategories) && !is_wp_error($sub_subcategories)) {
                                    echo '<div class="answercont '.$add_class.' '.$active_class.'" '.$max_height_style.'>';
                                    echo '<div class="answer">';
                                    echo '<ul>';

                                    foreach ($sub_subcategories as $sub_subcategory) {
                                        echo '<li><a href="javascript:void(0);" data-slug="' . esc_attr($sub_subcategory->slug) . '">' . esc_html($sub_subcategory->name) . '</a></li>';
                                    }

                                    echo '</ul>';
                                    echo '</div>';
                                    echo '</div>';
                                }

                                echo '</div>';
                                $count++;
                            }
                        }

                    echo '</div>';

                ?>

                <div class="form-inner-right custompaginationscroll"> 

                    <?php

                // Fetch posts for the main category or subcategory
                        $query_args = array(
                            'post_type' => 'form_download',
                            'posts_per_page' => $number_of_post_to_display,
                            'paged' => $paged,  // Set the current page 
                            'orderby' => 'title',
                            'order' => 'DESC', 
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'form_download_category',
                                    'field'    => 'slug',
                                    'terms'    => 'account-opening', 
                                ),
                            ),
                        );

                        $query = new WP_Query($query_args);

                        //ob_start();

                        if ($query->have_posts()) {
                            //echo '<div class="form-inner-right">';
                            while ($query->have_posts()) {
                                $query->the_post();
                                $upload_file = get_field('upload_file');
                                $file_url = get_field('file_url');

                                if($upload_file == ""){
                                    $file = get_field('file_url');
                                }else{
                                    $file = get_field('upload_file');
                                }

                                if($upload_file != ""){
                                    $file = get_field('upload_file');
                                }else{
                                    $file = get_field('file_url');
                                }
                                
                                $download = $upload_file ? "download" : "";
                                $target = $file ? "_blank" : "";
                                ?>
                                <div class="form-download-opc">
                                    <p><?php the_title(); ?></p>
                                    <a href="<?php echo $file; ?>" class="download-btn" target="<?php echo $target; ?>" <?php echo $download; ?>>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/download-arrow.svg" alt="download-arrow">
                                    </a>
                                </div>
                                <?php
                            }
                           // echo '</div>';
                            
                            ?>


            <div class="blog-article">
                <div class="pagination">
                    <?php

                    $paged = isset($_POST['paged']) ? absint($_POST['paged']) : 1; // Get current page number

                    //$posts = ob_get_clean();
                    $totalPages = $query->max_num_pages;
                    $paged = max(1, $paged); // Ensure $paged is at least 1

                    //ob_start();
                   if ($totalPages > 1) {
                        $data_page = "";
                        if($paged > 1)
                        {
                            $data_page = "data-page='".($paged-1)."'";
                        }
                        // Previous button
                        echo '<div class="page-numbers">';

                        if($paged != 1){
                            echo '<button '.$data_page.' class="prev-page page-numbers-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="none">
                                    <path d="M1.04175 6.44674L13.5417 6.44674" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6.08325 1.42639L1.04159 6.44639L6.08325 11.4672" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                Previous
                              </button>';
                        }

                        // Page numbers
                        $range = 2; // Number of pages to show around the current page
                        $start = max(1, $paged - $range);
                        $end = min($totalPages, $paged + $range);

                        if ($start > 1) {
                            echo '<button class="page-numbers-button" data-page="1">1</button>';
                            if ($start > 2) {
                                echo '<span class="dots">...</span>';
                            }
                        }

                        for ($i = $start; $i <= $end; $i++) {
                            echo '<button class="page-numbers-button ' . ($paged == $i ? 'active' : '') . '" data-page="' . $i . '">' . $i . '</button>';
                        }

                        if ($end < $totalPages) {
                            if ($end < $totalPages - 1) {
                                echo '<span class="dots">...</span>';
                            }
                            echo '<button class="page-numbers-button" data-page="' . $totalPages . '">' . $totalPages . '</button>';
                        }

                        // Next button
                        if($paged != $totalPages){
                            echo '<button data-page="'.($paged+1).'" class="next-page page-numbers-button">
                                Next
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="none">
                                    <path d="M13.9583 6.44674L1.45825 6.44674" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8.91675 1.42639L13.9584 6.44639L8.91675 11.4672" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                              </button>';
                        }
                        echo '</div>';
                    }

                ?>
                </div>          
            <?php

                        } else {
                            echo '<div class="form-inner-right"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';

                            //echo '<div class="form-inner-right"><p>No Forms found</p></div>';
                        }

                        wp_reset_postdata();

                    ?>

                </div>  

                </div>

            </div>
        </div>
    </section>

   

    <?php 
        include(locate_template('template-parts/parts/faq.php' ));
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?> 
    </main>

    <!-- <script>
        $(document).on('click', '.has-subcategories ul', function(e) {
        
            var $this = $(this);
            var $active = $(' .has-subcategories ul.active');
            if ($active.length && $active[0] !== $this[0]) {
                $active.removeClass('active');
                $active.next('li').css('maxHeight', 0);
            }
            $this.toggleClass('active');
            var $answer = $this.next('li');
            if ($this.hasClass('active')) {
                $answer.css('maxHeight', $answer[0].scrollHeight + 'px');
            } else {
                $answer.css('maxHeight', 0);
            }
        });
    </script> -->
<?php  get_footer(); ?>