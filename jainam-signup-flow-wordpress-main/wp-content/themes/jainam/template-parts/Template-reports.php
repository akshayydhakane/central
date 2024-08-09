<?php

/**
 * Template Name: Reports
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css.map" />

<style>
    .reports-page .report-section .report-section-inner .report-inner-left .faq_question_answer .answercont .report-chechbox .form-group input.active + label::after {
        content: "";
        display: block;
        position: absolute;
        top: 50%;
        left: 4px;
        width: 12px;
        height: 12px;
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none"><path d="M11 1.25L4.125 8.125L1 5" stroke="%232A948F" stroke-width="1.6666" stroke-linecap="round" stroke-linejoin="round"/></svg>');
        background-repeat: no-repeat;
        background-size: 13px;
        transform:translateY(-50%);
    }
    .reports-page .report-section .report-section-inner .report-inner-left .faq_question_answer .answercont .report-chechbox .form-group input.active + label::before{
        border-color: #2A948F;
    }
</style>

<?php
global $post;

// Get the content with the_content filters applied
$content = apply_filters('the_content', get_the_content());

// Remove <p> tags
$content = strip_tags($content, '<a><b><i><strong><em><ul><ol><li>');

?>

<main class="reports-page <?php echo $post->post_name; ?>"> 
    
    <section class="reports-banner-section">
        <div class="container">
            <div class="reports-banner-inner">
                <h1><?php echo get_the_title(); ?></h1>
                <p><?php echo $content; ?></p>
            </div>
        </div>
    </section>

    <section class="report-section">
        <?php $number_of_post_to_display = get_field('number_of_post_to_display'); ?>
        <input type="hidden" id="numofposts" data-numofposts="<?php echo $number_of_post_to_display; ?>"/>
        <div class="container">
            <div class="report-section-inner">
                <div class="report-inner-left">
                    <h4>Category</h4>
                    <div class="faq_question_answer">
                        <div class="question active">
                            Select
                        </div>
                        <div class="answercont active">
                            <div class="answer">
                                <div class="report-chechbox">

                                    <form>

                                            <?php
                                                // Display custom taxonomy terms
                                                $terms = get_terms( array(
                                                    'taxonomy' => 'report-category',
                                                    'hide_empty' => false,
                                                ) );
                                            ?>
                                            <?php
                                            $count = 1;
                                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
                                            foreach ( $terms as $term ) : ?>
                                            <?php

                                                $terms = get_the_terms(get_the_ID(), 'glossary_category');
                                                $term_name = $terms[0]->name;
                                                $active_class = ($term_name == $term->name) ? ' active' : '';
                                            ?>
                                                
                                                <div class="form-group">
                                                    <input type="checkbox" id="checkbox_<?php echo $count; ?>">
                                                    <label for="checkbox_<?php echo $count; ?>" data-slug="<?php echo esc_attr( $term->slug ); ?>" class="reports_cat" ><?php echo esc_html( $term->name ); ?></label>
                                                </div>
                                        
                                            <?php 
                                        $count++;
                                        endforeach; ?>
                                        
                                        <?php endif; ?> 
                                      
                                    </form>
                                </div>
                                <div class="report-btn">
                                    <a href="javascript:void(0);" id="reset_reports" class="reset_reports btn btn_transparent">Reset</a>
                                    <a href="javascript:void(0);" id="apply_reports" class="apply_reports btn">Apply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="report-inner-right custompaginationscroll">
                    <div class="report-right-title">
                        <div class="tab_div">
                        <ul class="comm_tabing"> 
                            <li><a href="javascript:void(0);" id="all" class="all btn_tab active">All</a></li>
                            <li><a href="javascript:void(0);" id="today" class="today btn_tab">Today</a></li>
                            <li><a href="javascript:void(0);" id="this_week" class="this_week btn_tab">This Week</a></li>
                            <li><a href="javascript:void(0);" id="this_month" class="this_month btn_tab">This Month</a></li>
                        </ul>
                    </div>
                        <div class="report-search">
                            <form class="search-form" >
                                <div class="input-group">
                                    <input type="search" class="search-field search_reports" id="search_reports" placeholder="Search in Reports" required>
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
                    <div class="reports_rights">
                        <div class="report-box-right-main">

                    <?php

                    $number_of_post_to_display = get_field('number_of_post_to_display');

                    //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $paged = isset($_POST['page']) ? $_POST['page'] : 1;

                    // Query to get circular posts
                    $args = array(
                        'post_type'      => 'reports',
                        'posts_per_page' => $number_of_post_to_display, // Number of circulars to display
                        'paged'          => $paged,
                        'post_status' => array('publish', 'future', 'private', 'inherit'),  
                        'orderby'        => 'date', // Order by date
                        'order'          => 'DESC', // Latest post comes first
                    );

                    $reports_query = new WP_Query($args);

                    if ($reports_query->have_posts()) : ?>
                            <?php while ($reports_query->have_posts()) : $reports_query->the_post(); 

                                // Get the content with the_content filters applied
                                $recontent = apply_filters('the_content', get_the_content());

                                // Remove <p> tags
                                $reportscontent = strip_tags($recontent, '<a><b><i><strong><em><ul><ol><li>');
                                ?>

                               <div class="report-box-right-inner">
                                    <h6><?php the_title(); ?></h6>
                                    <p><?php echo $reportscontent; ?></p>
                                    <p><?php echo get_the_date(); ?>
                                        <?php
                                            // Get the terms of the custom taxonomy 'report-category' for the current post
                                            $terms = get_the_terms(get_the_ID(), 'report-category');

                                            if ($terms && !is_wp_error($terms)) {
                                                echo '<span>';
                                                $total_terms = count($terms);
                                                $current_term = 0;

                                                foreach ($terms as $term) {
                                                    $current_term++;
                                                    echo esc_html($term->name);

                                                    // Add a comma after each term except the last one
                                                    if ($current_term < $total_terms) {
                                                        echo ', ';
                                                    }
                                                }

                                                echo '</span>';
                                            } else {
                                                echo '<span>No Category</span>';
                                            }
                                        ?>
                                    </p>
                                    <?php
                                        $file_url = get_field('file_url');
                                        $upload_file = get_field('upload_file');

                                        if ($file_url == "") {
                                            $button_link = get_field('upload_file');
                                            $target = "_blank";
                                        }
                                        if ($file_url != "") {
                                            $button_link = get_field('file_url');
                                            $target = "_blank";
                                        }
                                        if ($file_url == "" && $upload_file == "") {
                                            $button_link = "javascript:void(0)";
                                            $target = "_self";
                                        }   
                                    ?>
                                    <a href="<?php echo $button_link; ?>" class="btn btn_transparent" target="<?php echo $target; ?>">Open Report</a>
                                </div>

                            <?php endwhile; ?>
                        </div>
                            <div class="blog-article">
                                <div class="pagination">
                                    <?php
   
                                    //$posts = ob_get_clean();
                                    $totalPages = $reports_query->max_num_pages;
                                    $paged = max(1, $paged); // Ensure $paged is at least 1

                                    ob_start();
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
                            </div>
                
                        <?php
                        // Reset post data
                        wp_reset_postdata();
                    else : 

                        echo '<div class="report-box-right-inner"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';

                       endif; ?>

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

<?php  get_footer(); ?>

<script>
        // $(document).ready(function() {
        //     $('.faq_question_answer .question').on('click', function() {
        //         var $answer = $(this).siblings('.answercont');
        //         $answer.toggleClass('active');
        //     });
        // });

        $(document).ready(function() {
            $('.faq_question_answer .question').on('click', function() {
                var $answer = $(this).siblings('.answercont');
                if ($answer.hasClass('active')) {
                    $answer.removeClass('active').css('max-height', '0');
                } else {
                    $answer.addClass('active');
                    var scrollHeight = $answer[0].scrollHeight;
                    $answer.css('max-height', scrollHeight + 'px');
                }
            });
        });
</script>