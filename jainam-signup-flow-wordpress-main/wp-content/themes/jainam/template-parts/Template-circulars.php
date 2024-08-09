<?php

/**
 * Template Name: circulars
 */
get_header(); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/circulars-page.css" />
<?php
global $post;

// Get the content with the_content filters applied
$content = apply_filters('the_content', get_the_content());

// Remove <p> tags
$content = strip_tags($content, '<a><b><i><strong><em><ul><ol><li>');

?>

<main class="glossary-page circulars-page">
        <section class="comman_banner-section">
            <div class="container">
                <div class='banner_content'>
                    <h1 class="banner_title"><?php echo get_the_title(); ?></h1>
                    <p class="banner_title_content"><?php echo $content; ?></p>
                </div>
            </div>
        </section>

    <!-- Glossary Information Content-->
    <section class="comman_tabs-sec">
        <div class="container">
            <?php
                // Display custom taxonomy terms
                $terms = get_terms( array(
                    'taxonomy' => 'circular_category',
                    'hide_empty' => false,
                ) );
            ?>
            <?php $number_of_post_to_display = get_field('number_of_post_to_display'); ?>
                <input type="hidden" id="numofposts" data-numofposts="<?php echo $number_of_post_to_display; ?>"/>
            <div class="tab_div">
            <ul class="comm_tabing">
                <li><a href="javascript:void(0)" data-slug="all" class="btn_tab more_btn active">All</a></li>
                 <?php
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
                foreach ( $terms as $term ) : ?>
                <?php

                    $terms = get_the_terms(get_the_ID(), 'glossary_category');
                    $term_name = $terms[0]->name;
                    $active_class = ($term_name == $term->name) ? ' active' : '';
                ?>
                    <li><a href="javascript:void(0)" data-numofposts="<?php echo $number_of_post_to_display; ?>" data-slug="<?php echo esc_attr( $term->slug ); ?>" class="btn_tab <?php echo $active_class; ?>"><?php echo esc_html( $term->name ); ?></a></li>
            
                <?php endforeach; ?>
            
            <?php endif; ?> 
            </ul>
        </div>

            <div class='glossary_info'>
                <div class="glossary-left custompaginationscroll">

                    <?php

                    $search_title = isset($_GET['title']) ? sanitize_text_field($_GET['title']) : '';
                    
                    $number_of_post_to_display = get_field('number_of_post_to_display');

                    //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $paged = isset($_POST['page']) ? $_POST['page'] : 1;


                    if($search_title != ""){
                        $args = array(
                            'post_type'      => 'circular',
                            'posts_per_page' => $number_of_post_to_display, // Number of circulars to display
                            'paged'          => $paged,
                            's'              => $search_title, // Search term
                            'orderby'        => 'date', // Order by date
                            'order'          => 'DESC', // Latest post comes first
                        );
                    }else{
                        // Query to get circular posts
                        $args = array(
                            'post_type'      => 'circular',
                            'posts_per_page' => $number_of_post_to_display, // Number of circulars to display
                            'paged'          => $paged,
                            'orderby'        => 'date', // Order by date
                            'order'          => 'DESC', // Latest post comes first
                        );
                    }

                    $circulars_query = new WP_Query($args);
                    echo '<div class="circulars_main">';
                    if ($circulars_query->have_posts()) : ?>
                            <?php while ($circulars_query->have_posts()) : $circulars_query->the_post(); ?>
                            
                                <div class="circular_cart">
                                    <div class="content_circular">
                                        <h5><?php the_title(); ?></h5>
                                        <ul class='d_flex_center'>
                                            <li><?php echo get_the_date(); ?></li>
                                            <li>
                                            <?php
                                                // Get the terms of the custom taxonomy 'circular_category' for the current post
                                                $terms = get_the_terms(get_the_ID(), 'circular_category');
                                                
                                                if ($terms && !is_wp_error($terms)) {
                                                    foreach ($terms as $term) {
                                                        $category_name = esc_html($term->name);
                                                        echo '<a href="javascript:void(0)" class="btn_tab">' . esc_html($term->name) . '</a> ';
                                                    }
                                                } else {
                                                    echo '<a href="#" class="btn_tab">No Category</a>';
                                                }
                                            ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php 
                                        $file = get_field('upload_file');
                                        $third_party_link = get_field('third_party_link');
                                        if($third_party_link == ""){
                                            $third_party_link = "#";
                                        }
                                    ?>
                                    <div class="download_circular">
                                        <?php if ($category_name === 'MCX' || $category_name === 'NSE') { ?>

                                            <a href="<?php echo $file['url']; ?>" filename="<?php echo $file['name']; ?>" class="download-icon" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/download-icon.svg" alt="download-icon"></a>

                                        <?php } ?>
                                        <?php if ($category_name === 'CDSL') { ?>

                                            <a href="<?php echo $file['url']; ?>" filename="<?php echo $file['name']; ?>" class="download-icon" download><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/download-icon.svg" alt="download-icon"></a>

                                        <?php } ?>
                                        <?php if ($category_name === 'SEBI' || $category_name === 'BSE') { ?>

                                            <a href="<?php echo $third_party_link; ?>" class="download-icon" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/download-icon.svg" alt="download-icon"></a>

                                        <?php } ?>
                                    </div>
                               </div>

                            <?php endwhile; ?>
                        </div>

                            <div class="blog-article">
                                <div class="pagination">
                                    <?php
   
                                    //$posts = ob_get_clean();
                                    $totalPages = $circulars_query->max_num_pages;
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
                        echo '<div class="circular_cart"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';
                    endif; ?>

                </div>
                <div class="glossary-right">
                    <?php 
                    include(locate_template('template-parts/parts/open-free-account-number-glossary.php' )); 
                    ?>
                </div>
            </div>  
        </div>
    </section> 
    <?php
    include(locate_template('template-parts/parts/open-free-account-number-sec-circulars-black.php' ));

    include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?>  
    </main>
<?php  get_footer(); ?>
