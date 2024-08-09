<?php
/**
 * jainam Theme Customizer
 *
 * @package jainam
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jainam_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'jainam_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'jainam_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'jainam_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function jainam_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function jainam_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
// function jainam_customize_preview_js() {
// 	wp_enqueue_script( 'custom-ajax-pagination', get_template_directory_uri() . '/assets/js/blog_ajax.js?time='.time(), array( 'custom-ajax-pagination' ), _S_VERSION, true );
// 	wp_localize_script('custom-ajax-pagination', 'ajax_params', array(
// 		'ajax_url' => admin_url('admin-ajax.php'),
// 		'nonce'    => wp_create_nonce('blog_nonce')
//   ));
// }
// add_action( 'customize_preview_init', 'jainam_customize_preview_js' );

/**
 * Enqueue scripts and styles.
 */
function jainam_scripts() {
	wp_enqueue_style( 'jainam-style', get_stylesheet_uri(), array(), _S_VERSION );
	// wp_style_add_data( 'jainam-style', 'rtl', 'replace' );

	wp_enqueue_style( 'slick.css', get_template_directory_uri() . '/assets/css/slick.css?time='.time(), array(), _S_VERSION );

    wp_enqueue_style( 'swiper.css', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css?time='.time(), array(), _S_VERSION );

	wp_enqueue_style( 'Home.css', get_template_directory_uri() . '/assets/css/home.css?time='.time(), array(), _S_VERSION );
	wp_enqueue_style( 'custom_style.css', get_template_directory_uri() . '/assets/css/custom_style.css?time='.time(), array(), _S_VERSION );

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'slick.js', get_template_directory_uri() . '/assets/js/slick.js?time='.time(), array(), _S_VERSION );
	wp_enqueue_script( 'swiper-bundle.min', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js?time='.time(), array(), _S_VERSION );

	wp_enqueue_script( 'jainam-custom', get_template_directory_uri() . '/assets/js/custom.js?time='.time(), array(), _S_VERSION );
	
	wp_localize_script( 'jainam-custom', 'glossary_ajax_object', array( 
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if(is_page('blog')){   
	wp_enqueue_script( 'custom-ajax-pagination', get_template_directory_uri() . '/assets/js/blog_ajax.js?time='.time(), array(), _S_VERSION, true );

// 	wp_enqueue_script( 'custom-ajax-pagination', get_template_directory_uri() . '/assets/js/blog_ajax.js?time='.time(), array( 'custom-ajax-pagination' ), _S_VERSION, true );
	wp_localize_script('custom-ajax-pagination', 'ajax_params', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce'    => wp_create_nonce('blog_nonce')

  ));
}

wp_localize_script('jainam-custom', 'wpData', array(
    'imageUrl' => get_site_url() . '/wp-content/uploads/2024/07/not_found.svg'
));

}
add_action( 'wp_enqueue_scripts', 'jainam_scripts' );

function add_svg_support($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'add_svg_support');

/** SVG Sanitization */
function sanitize_svg_upload($file) {
	if ($file['type'] === 'image/svg+xml') {
		 $file_contents = file_get_contents($file['tmp_name']);
		 // Basic check for <script> tags
		 if (strpos($file_contents, '<script') !== false) {
			  $file['error'] = 'Sorry, SVG files with scripts are not allowed.';
		 } else {
			  // Optional: Add more sanitization logic here
			  // Example: Strip out any <script> tags
			  $file_contents = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $file_contents);
			  file_put_contents($file['tmp_name'], $file_contents);
		 }
	}
	return $file;
}
add_filter('wp_handle_upload_prefilter', 'sanitize_svg_upload');


// Blog post Ajax
function load_blog_posts() {
	check_ajax_referer('blog_nonce', 'nonce');

	$paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all_cat';

	$args = array(
		 'post_type' => 'post',
		 'posts_per_page' => 6,
		 'paged' => $paged,
		 'meta_query' => array(
        'relation' => 'OR',
        array(
            'key'     => 'featured_post',
            'compare' => 'NOT EXISTS', // Include posts where the custom field does not exist
        ),
        array(
            'key'     => 'featured_post',
            'value'   => '1',
            'compare' => '!=', // Exclude posts where the custom field is set to '1'
        ),
    ),
	);

	if ($category !== 'all_cat') {
		 $args['category_name'] = $category;
	}

	$query = new WP_Query($args);

	ob_start();

	if ($query->have_posts()) :
		 while ($query->have_posts()) : $query->the_post(); ?>
			  <div class="blog-card">
					<div class="blog-card-inner">
						 <div class="blog-card-img">
							  
							  <?php if ( has_post_thumbnail() ) : ?>												  <a href="<?php the_permalink(); ?>">				
										<img src="<?php the_post_thumbnail_url(); ?>" alt="blog">
                                    </a>
								<?php endif; 
									$category = get_the_category();
                                    $terms = get_the_terms(get_the_ID(), 'category');
									if ( ! empty( $category ) ) {
										$category_name = $category[0]->name;
                                        //$category_link = get_category_link($category[0]->term_id);
										
                                        echo '<div class="blog-card-info"><a href="javascript:void(0)">' . esc_html( $category_name ) . '</a></div>';  
									} 
									?> 
							  
						 </div>
						 <div class="blog-card-content">
							  <a href="<?php the_permalink(); ?>">
									<h4><?php the_title(); ?></h4>
							  </a>
							  <div class="blog-card-date">
									<p><?php echo get_the_date('M d, Y'); ?></p><?php
									// Calculate reading time
									$content = get_post_field( 'post_content', get_the_ID() );
									$word_count = str_word_count( strip_tags( $content ) );
									$reading_time = ceil( $word_count / 200 ); // Assuming average reading speed is 200 words per minute
									echo '<p>' . esc_html( $reading_time ) . ' min read</p>'; ?>
									
							  </div>
						 </div>
					</div>
			  </div>
		 <?php endwhile;
	else :
		 echo '<p>No blogs found</p>';
	endif;

$posts = ob_get_clean();
$totalPages = $query->max_num_pages;
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
  
$pagination = ob_get_clean();

wp_reset_postdata(); // Reset post data

echo json_encode(array('posts' => $posts, 'pagination' => $pagination));


	wp_die();
}
add_action('wp_ajax_load_blog_posts', 'load_blog_posts');
add_action('wp_ajax_nopriv_load_blog_posts', 'load_blog_posts');

function create_glossary_post_type() {
    $labels = array(
        'name'                  => _x( 'Glossaries', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Glossary', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Glossaries', 'text_domain' ),
        'name_admin_bar'        => __( 'Glossary', 'text_domain' ),
        'archives'              => __( 'Glossary Archives', 'text_domain' ),
        'attributes'            => __( 'Glossary Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Glossary:', 'text_domain' ),
        'all_items'             => __( 'All Glossaries', 'text_domain' ),
        'add_new_item'          => __( 'Add New Glossary', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Glossary', 'text_domain' ),
        'edit_item'             => __( 'Edit Glossary', 'text_domain' ),
        'update_item'           => __( 'Update Glossary', 'text_domain' ),
        'view_item'             => __( 'View Glossary', 'text_domain' ),
        'view_items'            => __( 'View Glossaries', 'text_domain' ),
        'search_items'          => __( 'Search Glossary', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into glossary', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this glossary', 'text_domain' ),
        'items_list'            => __( 'Glossaries list', 'text_domain' ),
        'items_list_navigation' => __( 'Glossaries list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter glossaries list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Glossary', 'text_domain' ),
        'description'           => __( 'A custom post type for glossaries', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
        'taxonomies'            => array( 'glossary_category', 'post_tag' ), // Include post_tag
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'glossary', $args );
}
add_action( 'init', 'create_glossary_post_type', 0 );

function create_glossary_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Glossary Categories', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Glossary Category', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Glossary Categories', 'text_domain' ),
        'all_items'                  => __( 'All Categories', 'text_domain' ),
        'parent_item'                => __( 'Parent Category', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
        'new_item_name'              => __( 'New Category Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Category', 'text_domain' ),
        'edit_item'                  => __( 'Edit Category', 'text_domain' ),
        'update_item'                => __( 'Update Category', 'text_domain' ),
        'view_item'                  => __( 'View Category', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Categories', 'text_domain' ),
        'search_items'               => __( 'Search Categories', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No categories', 'text_domain' ),
        'items_list'                 => __( 'Categories list', 'text_domain' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'glossary_category', array( 'glossary' ), $args );
}
add_action( 'init', 'create_glossary_taxonomy', 0 );

function filter_glossary() {
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    $args = array(
        'post_type'      => 'glossary',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    );

    if ( !empty( $category ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'glossary_category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    $glossary_query = new WP_Query( $args );

    if ( $glossary_query->have_posts() ) :
        $current_letter = '';
        while ( $glossary_query->have_posts() ) : $glossary_query->the_post();
            $first_letter = strtoupper( substr( get_the_title(), 0, 1 ) );
            if ( $first_letter !== $current_letter ) {
                if ( $current_letter !== '' ) {
                    echo '</ul></div>';
                }
                $current_letter = $first_letter;
                echo '<div id="'.esc_attr( $first_letter ).'" class="glossary_list"><ul>';
            }
            ?>
            <li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile;
        echo '</ul></div>';
        wp_reset_postdata();
    else :
        //echo '<div class="glossary_list"><ul><li>' . __( 'No glossary items found.', 'text_domain' ) . '</li></ul></div>';

        echo '<div class="glossary"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';

    endif;

    wp_die();
}
add_action( 'wp_ajax_filter_glossary', 'filter_glossary' );
add_action( 'wp_ajax_nopriv_filter_glossary', 'filter_glossary' );

function filter_circulars() {
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $numofposts = isset($_POST['numofposts']) ? sanitize_text_field($_POST['numofposts']) : '';
    
    $number_of_post_to_display = get_field('number_of_post_to_display');

    //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    $args = array(
        'post_type'      => 'circular',
        'posts_per_page' => $numofposts, // Number of circulars to display
        'paged'          => $paged,
        'orderby'        => 'date', // Order by date
        'order'          => 'DESC', // Latest post comes first
    );

    if ( !empty( $category ) && $category != "all") {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'circular_category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }else{
        $args = array(
            'post_type'      => 'circular',
            'posts_per_page' => $numofposts, // Number of circulars to display
            'paged'          => $paged,
            'orderby'        => 'date', // Order by date
            'order'          => 'DESC', // Latest post comes first
        );
    }

    $glossary_query = new WP_Query( $args );

    if ( $glossary_query->have_posts() ) :
        $current_letter = '';
        while ( $glossary_query->have_posts() ) : $glossary_query->the_post();
            ?>
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

        <div class="blog-article">
            <div class="pagination">
                <?php
                    //$posts = ob_get_clean();
                    $totalPages = $glossary_query->max_num_pages;
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
       
        <?php wp_reset_postdata();
    else :
    echo '<div class="circular_cart"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';
    endif;

    wp_die();
}
add_action( 'wp_ajax_filter_circulars', 'filter_circulars' );
add_action( 'wp_ajax_nopriv_filter_circulars', 'filter_circulars' );

function create_custom_post_type() {
    // Set up the arguments for the custom post type
    $args = array(
        'labels' => array(
            'name' => 'Locations',
            'singular_name' => 'Location',
            'add_new' => 'Add New Location',
            'add_new_item' => 'Add New Location',
            'edit_item' => 'Edit Location',
            'new_item' => 'New Location',
            'all_items' => 'All Locations',
            'view_item' => 'View Location',
            'search_items' => 'Search Locations',
            'not_found' => 'No Locations found',
            'not_found_in_trash' => 'No Locations found in Trash',
            'menu_name' => 'Locations'
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'locations'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        //'taxonomies' => array('post_tag', 'category'), // Default taxonomies
        'show_in_rest' => true,
    );
    register_post_type('location', $args);
}
add_action('init', 'create_custom_post_type');

function create_custom_taxonomies() {
    // Add new "State" taxonomy to Locations
    $args = array(
        'labels' => array(
            'name' => 'States',
            'singular_name' => 'State',
            'search_items' => 'Search States',
            'all_items' => 'All States',
            'parent_item' => 'Parent State',
            'parent_item_colon' => 'Parent State:',
            'edit_item' => 'Edit State',
            'update_item' => 'Update State',
            'add_new_item' => 'Add New State',
            'new_item_name' => 'New State Name',
            'menu_name' => 'State'
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
    );
    register_taxonomy('state', array('location'), $args);

    // Add new "District" taxonomy to Locations
    $args = array(
        'labels' => array(
            'name' => 'Districts',
            'singular_name' => 'District',
            'search_items' => 'Search Districts',
            'all_items' => 'All Districts',
            'parent_item' => 'Parent District',
            'parent_item_colon' => 'Parent District:',
            'edit_item' => 'Edit District',
            'update_item' => 'Update District',
            'add_new_item' => 'Add New District',
            'new_item_name' => 'New District Name',
            'menu_name' => 'District'
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
    );
    register_taxonomy('district', array('location'), $args);
}
add_action('init', 'create_custom_taxonomies', 0);

// AJAX handler to fetch locations
function fetch_locations() {
    // Check the nonce for security
    //check_ajax_referer('fetch_locations_nonce', 'security');

    $state = sanitize_text_field($_POST['state']);
    $district = sanitize_text_field($_POST['district']);

    // Query to fetch locations
    $args = array(
        'post_type' => 'location',
        'order'=>'ASC',
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'state',
                'field' => 'name',
                'terms' => $state,
            ),
            array(
                'taxonomy' => 'district',
                'field' => 'name',
                'terms' => $district,
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $locations = array();
        while ($query->have_posts()) {
            $query->the_post();
            $locations[] = array(
                'title' => get_the_title(),
                'shop_address' => get_field('shop_address'), 
                'phone' => get_field('phone'), 
                'email' => get_field('email'),  
                'maplink' => get_field('map_link'),   
                'locationicon' => get_stylesheet_directory_uri() . '/assets/img/location_icon.svg',
                'callicon' => get_stylesheet_directory_uri() . '/assets/img/call_icon.svg',
                'mailicon' => get_stylesheet_directory_uri() . '/assets/img/mail_icon.svg',
            );
        }
        wp_reset_postdata();
        wp_send_json_success($locations);
    } else {
        wp_send_json_error('No locations found.');
    }
}
add_action('wp_ajax_fetch_locations', 'fetch_locations');
add_action('wp_ajax_nopriv_fetch_locations', 'fetch_locations');

function create_circular_post_type() {
    $labels = array(
        'name'                  => _x('Circulars', 'Post type general name', 'textdomain'),
        'singular_name'         => _x('Circular', 'Post type singular name', 'textdomain'),
        'menu_name'             => _x('Circulars', 'Admin Menu text', 'textdomain'),
        'name_admin_bar'        => _x('Circular', 'Add New on Toolbar', 'textdomain'),
        'add_new'               => __('Add New', 'textdomain'),
        'add_new_item'          => __('Add New Circular', 'textdomain'),
        'new_item'              => __('New Circular', 'textdomain'),
        'edit_item'             => __('Edit Circular', 'textdomain'),
        'view_item'             => __('View Circular', 'textdomain'),
        'all_items'             => __('All Circulars', 'textdomain'),
        'search_items'          => __('Search Circulars', 'textdomain'),
        'parent_item_colon'     => __('Parent Circulars:', 'textdomain'),
        'not_found'             => __('No circulars found.', 'textdomain'),
        'not_found_in_trash'    => __('No circulars found in Trash.', 'textdomain'),
        'featured_image'        => _x('Circular Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
        'set_featured_image'    => _x('Set circular cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'remove_featured_image' => _x('Remove circular cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'use_featured_image'    => _x('Use as circular cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'archives'              => _x('Circular archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
        'insert_into_item'      => _x('Insert into circular', 'Overrides the “Insert into post” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
        'uploaded_to_this_item' => _x('Uploaded to this circular', 'Overrides the “Uploaded to this post” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
        'filter_items_list'     => _x('Filter circulars list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”. Added in 4.4', 'textdomain'),
        'items_list_navigation' => _x('Circulars list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”. Added in 4.4', 'textdomain'),
        'items_list'            => _x('Circulars list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”. Added in 4.4', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'circular'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    );

    register_post_type('circular', $args);
}
add_action('init', 'create_circular_post_type');

function create_circular_taxonomy() {
    $labels = array(
        'name'              => _x('Circular Categories', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Circular Category', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Circular Categories', 'textdomain'),
        'all_items'         => __('All Circular Categories', 'textdomain'),
        'parent_item'       => __('Parent Circular Category', 'textdomain'),
        'parent_item_colon' => __('Parent Circular Category:', 'textdomain'),
        'edit_item'         => __('Edit Circular Category', 'textdomain'),
        'update_item'       => __('Update Circular Category', 'textdomain'),
        'add_new_item'      => __('Add New Circular Category', 'textdomain'),
        'new_item_name'     => __('New Circular Category Name', 'textdomain'),
        'menu_name'         => __('Circular Category', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite' => array('slug' => '', 'with_front' => false),
    );

    register_taxonomy('circular_category', array('circular'), $args);
}
add_action('init', 'create_circular_taxonomy');

function create_general_updates_cpt() {
    $labels = array(
        'name' => _x('General Updates', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('General Update', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => __('General Updates', 'textdomain'),
        'name_admin_bar' => __('General Update', 'textdomain'),
        'archives' => __('Item Archives', 'textdomain'),
        'attributes' => __('Item Attributes', 'textdomain'),
        'parent_item_colon' => __('Parent Item:', 'textdomain'),
        'all_items' => __('All Items', 'textdomain'),
        'add_new_item' => __('Add New Item', 'textdomain'),
        'add_new' => __('Add New', 'textdomain'),
        'new_item' => __('New Item', 'textdomain'),
        'edit_item' => __('Edit Item', 'textdomain'),
        'update_item' => __('Update Item', 'textdomain'),
        'view_item' => __('View Item', 'textdomain'),
        'view_items' => __('View Items', 'textdomain'),
        'search_items' => __('Search Item', 'textdomain'),
        'not_found' => __('Not found', 'textdomain'),
        'not_found_in_trash' => __('Not found in Trash', 'textdomain'),
        'featured_image' => __('Featured Image', 'textdomain'),
        'set_featured_image' => __('Set featured image', 'textdomain'),
        'remove_featured_image' => __('Remove featured image', 'textdomain'),
        'use_featured_image' => __('Use as featured image', 'textdomain'),
        'insert_into_item' => __('Insert into item', 'textdomain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'textdomain'),
        'items_list' => __('Items list', 'textdomain'),
        'items_list_navigation' => __('Items list navigation', 'textdomain'),
        'filter_items_list' => __('Filter items list', 'textdomain'),
    );
    $args = array(
        'label' => __('General Update', 'textdomain'),
        'description' => __('General Updates and news', 'textdomain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        'taxonomies' => array('general_updates_category'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );
    register_post_type('general_updates', $args);
}
add_action('init', 'create_general_updates_cpt', 0);

function create_general_updates_taxonomy() {
    $labels = array(
        'name' => _x('Categories', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Category', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Categories', 'textdomain'),
        'all_items' => __('All Categories', 'textdomain'),
        'parent_item' => __('Parent Category', 'textdomain'),
        'parent_item_colon' => __('Parent Category:', 'textdomain'),
        'edit_item' => __('Edit Category', 'textdomain'),
        'update_item' => __('Update Category', 'textdomain'),
        'add_new_item' => __('Add New Category', 'textdomain'),
        'new_item_name' => __('New Category Name', 'textdomain'),
        'menu_name' => __('Category', 'textdomain'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
    );
    register_taxonomy('general_updates_category', array('general_updates'), $args);
}
add_action('init', 'create_general_updates_taxonomy', 0); 

function filter_generalupdates() {
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $numofposts = isset($_POST['numofposts']) ? sanitize_text_field($_POST['numofposts']) : '';
    
    $number_of_post_to_display = get_field('number_of_post_to_display');

    //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    $args = array(
        'post_type'      => 'general_updates',
        'posts_per_page' => $numofposts, // Number of circulars to display
        'paged'          => $paged,
        'orderby'        => 'date', // Order by date
        'order'          => 'DESC', // Latest post comes first
    );

    if ( !empty( $category ) && $category != "all") {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'general_updates_category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }else{
        $args = array(
            'post_type'      => 'general_updates',
            'posts_per_page' => $numofposts, // Number of circulars to display
            'paged'          => $paged,
            'orderby'        => 'date', // Order by date
            'order'          => 'DESC', // Latest post comes first
        );
    }

    $glossary_query = new WP_Query( $args );
    echo '<div class="general_update_main">';
    if ( $glossary_query->have_posts() ) :
        $current_letter = '';
        while ( $glossary_query->have_posts() ) : $glossary_query->the_post();

            if (has_post_thumbnail()) {
                $post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full'); // You can replace 'thumbnail' with any size like 'medium', 'large', etc.
            }else{
                $post_thumbnail = get_stylesheet_directory_uri().'/assets/img/our-journey-9.webp';
            }

            ?>
             <div class="general_update_cart">
                <div class="img_general">
                    <img src="<?php echo $post_thumbnail; ?>" alt="general_pic">
                </div>
                <div class="content_general">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo get_custom_excerpt(130); ?></p>
                    <div class="date_release">
                        <ul>
                            <li>
                                <?php echo get_the_date(); ?></li>
                                <li>
                                    <?php
                                        // Get the terms of the custom taxonomy 'general_updates_category' for the current post
                                        $terms = get_the_terms(get_the_ID(), 'general_updates_category');
                                        
                                        if ($terms && !is_wp_error($terms)) {
                                            $term_count = count($terms);
                                            $current_term = 0;
                                            foreach ($terms as $term) {
                                                $current_term++;
                                                echo '<a href="javascript:void(0)" class="">'.esc_html($term->name);
                                                if ($current_term < $term_count) {
                                                    echo ',</a>';
                                                } else {
                                                    echo '</a>';
                                                }
                                            }
                                        } else {
                                            echo '<a href="#" class="">No Category</a>';
                                        }
                                    ?>
                                </li>
                        </ul>
                    </div>
                    <div class="read_more">
                        <a href="<?php echo get_permalink(); ?>">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider_arrow.webp" alt="arrow_icon"></a>
                    </div>
                </div>
           </div>
        <?php endwhile; ?>
    </div>
        <div class="blog-article">
            <div class="pagination">
                    <?php
                         //$posts = ob_get_clean();
                        $totalPages = $glossary_query->max_num_pages;
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
       
        <?php wp_reset_postdata();
    else :
   
    echo '<div class="general_update_cart"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';

    endif;

    wp_die();
}
add_action( 'wp_ajax_filter_generalupdates', 'filter_generalupdates' );
add_action( 'wp_ajax_nopriv_filter_generalupdates', 'filter_generalupdates' ); 

// Function to limit excerpt length
function get_custom_excerpt($char_limit) {
    $excerpt = get_the_excerpt();
    if (strlen($excerpt) > $char_limit) {
        $excerpt = substr($excerpt, 0, $char_limit) . '...';
    }
    return $excerpt;
} 

function get_custom_title($word_limit) {
    // Get the title
    $title = get_the_title();
    
    // Remove commas from the title
    $title = str_replace(',', '', $title);

    // Use a regular expression to match words and punctuation, including commas and other marks
    preg_match_all('/[^\s]+(?:\s+|$)/', $title, $matches);

    $words = $matches[0];
    if (count($words) > $word_limit) {
        $words = array_slice($words, 0, $word_limit);
        $title = implode('', $words) . '...';
    } else {
        $title = implode('', $words);
    }

    return $title;
}
function create_reports_post_type() {
    $labels = array(
        'name' => __('Reports'),
        'singular_name' => __('Report'),
        'add_new' => __('Add New Report'),
        'add_new_item' => __('Add New Report'),
        'edit_item' => __('Edit Report'),
        'new_item' => __('New Report'),
        'view_item' => __('View Report'),
        'search_items' => __('Search Reports'),
        'not_found' => __('No reports found'),
        'not_found_in_trash' => __('No reports found in Trash'),
        'all_items' => __('All Reports'),
        'archives' => __('Report Archives'),
        'insert_into_item' => __('Insert into report'),
        'uploaded_to_this_item' => __('Uploaded to this report'),
        'featured_image' => __('Featured Image'),
        'set_featured_image' => __('Set featured image'),
        'remove_featured_image' => __('Remove featured image'),
        'use_featured_image' => __('Use as featured image'),
        'menu_name' => __('Reports'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'reports' ),
        'capability_type'    => 'post',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'show_in_rest' => true, // For Gutenberg editor support
    );

    register_post_type('reports', $args);
}
add_action('init', 'create_reports_post_type');

function create_reports_taxonomy() {
    $labels = array(
        'name' => __('Report Categories'),
        'singular_name' => __('Report Category'),
        'search_items' => __('Search Report Categories'),
        'all_items' => __('All Report Categories'),
        'parent_item' => __('Parent Report Category'),
        'parent_item_colon' => __('Parent Report Category:'),
        'edit_item' => __('Edit Report Category'),
        'update_item' => __('Update Report Category'),
        'add_new_item' => __('Add New Report Category'),
        'new_item_name' => __('New Report Category Name'),
        'menu_name' => __('Report Categories'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'report-category'),
        'show_in_rest' => true, // For Gutenberg editor support
    );

    register_taxonomy('report-category', array('reports'), $args);
}
add_action('init', 'create_reports_taxonomy');

function filter_reports() {
    $categories = isset($_POST['categories']) ? array_map('sanitize_text_field', $_POST['categories']) : [];
    $numofposts = isset($_POST['numofposts']) ? sanitize_text_field($_POST['numofposts']) : '';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $filter_by = isset($_POST['filter_by']) ? sanitize_text_field($_POST['filter_by']) : 'all';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $args = array(
        'post_type'      => 'reports',
        'posts_per_page' => $numofposts,
        'paged'          => $paged,
        'post_status' => array('publish', 'future', 'private', 'inherit'),
        'orderby'        => 'date', // Order by date
        'order'          => 'DESC', // Latest post comes first
    );

    // Taxonomy query for categories
    if (!empty($categories)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'report-category',
                'field'    => 'slug',
                'terms'    => $categories,
            ),
        );
    }

    // Meta query for date filtering
    if ($filter_by == 'today') {
        $args['date_query'] = array(
            array(
                'after'     => 'midnight',
                'before'    => 'tomorrow',
                'inclusive' => true,
            ),
        );
    } elseif ($filter_by == 'this_week') {
        $args['date_query'] = array(
            array(
                'after'     => 'last sunday midnight',
                'before'    => 'next sunday midnight',
                'inclusive' => true,
            ),
        );
    } elseif ($filter_by == 'this_month') {
        $args['date_query'] = array(
            array(
                'year'  => date('Y'),
                'month' => date('m'),
            ),
        );
    }

    // Search query
    if (!empty($search)) {
        $args['s'] = $search;
    }

    $reports_query = new WP_Query($args); ?>
    <div class="report-box-right-main">
    <?php
    if ($reports_query->have_posts()) : 
        while ($reports_query->have_posts()) : $reports_query->the_post();
            $recontent = apply_filters('the_content', get_the_content());
            $reportscontent = strip_tags($recontent, '<a><b><i><strong><em><ul><ol><li>');
            ?>
        
            <div class="report-box-right-inner">
                <h6><?php the_title(); ?></h6>
                <p><?php echo $reportscontent; ?></p>
                <p><?php echo get_the_date(); ?>
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'report-category');
                    if ($terms && !is_wp_error($terms)) {
                        echo '<span>';
                        $total_terms = count($terms);
                        $current_term = 0;

                        foreach ($terms as $term) {
                            $current_term++;
                            echo esc_html($term->name);
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
            <?php
        endwhile; 
        ?>
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

        echo '<div class="reports"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';
    
    endif; 

    die();
}

add_action('wp_ajax_filter_reports', 'filter_reports');
add_action('wp_ajax_nopriv_filter_reports', 'filter_reports');

function create_form_downloads_post_type() {
    $labels = array(
        'name'               => _x( 'Form Downloads', 'post type general name', 'your-textdomain' ),
        'singular_name'      => _x( 'Form Download', 'post type singular name', 'your-textdomain' ),
        'menu_name'          => _x( 'Form Downloads', 'admin menu', 'your-textdomain' ),
        'name_admin_bar'     => _x( 'Form Download', 'add new on admin bar', 'your-textdomain' ),
        'add_new'            => _x( 'Add New', 'form download', 'your-textdomain' ),
        'add_new_item'       => __( 'Add New Form Download', 'your-textdomain' ),
        'new_item'           => __( 'New Form Download', 'your-textdomain' ),
        'edit_item'          => __( 'Edit Form Download', 'your-textdomain' ),
        'view_item'          => __( 'View Form Download', 'your-textdomain' ),
        'all_items'          => __( 'All Form Downloads', 'your-textdomain' ),
        'search_items'       => __( 'Search Form Downloads', 'your-textdomain' ),
        'parent_item_colon'  => __( 'Parent Form Downloads:', 'your-textdomain' ),
        'not_found'          => __( 'No form downloads found.', 'your-textdomain' ),
        'not_found_in_trash' => __( 'No form downloads found in Trash.', 'your-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'form-download' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'form_download', $args );
}
add_action( 'init', 'create_form_downloads_post_type' );

function create_form_downloads_taxonomy() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'your-textdomain' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'your-textdomain' ),
        'search_items'      => __( 'Search Categories', 'your-textdomain' ),
        'all_items'         => __( 'All Categories', 'your-textdomain' ),
        'parent_item'       => __( 'Parent Category', 'your-textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'your-textdomain' ),
        'edit_item'         => __( 'Edit Category', 'your-textdomain' ),
        'update_item'       => __( 'Update Category', 'your-textdomain' ),
        'add_new_item'      => __( 'Add New Category', 'your-textdomain' ),
        'new_item_name'     => __( 'New Category Name', 'your-textdomain' ),
        'menu_name'         => __( 'Category', 'your-textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'form-download-category' ),
    );

    register_taxonomy( 'form_download_category', array( 'form_download' ), $args );
}
add_action( 'init', 'create_form_downloads_taxonomy' );

// Handle AJAX request
/*function load_forms() {
    $parent_slug = sanitize_text_field($_POST['categories']);
    $parent_term = get_term_by('slug', $parent_slug, 'form_download_category');

    if ($parent_term) {
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
                echo '<div class="question '.$add_fclass.' '.$add_class.' '.$active_class.'" data-slug="'.$subcategory->slug.'">' . esc_html($subcategory->name) . '</div>';

                if (!empty($sub_subcategories) && !is_wp_error($sub_subcategories)) {
                    echo '<div class="answercont '.$add_class.' '.$active_class.'" '.$max_height_style.'>';
                    echo '<div class="answer">';
                    echo '<ul>';

                    foreach ($sub_subcategories as $sub_subcategory) {
                        echo '<li><a href="javascript:void(0);" data-slug="'.$sub_subcategory->slug.'">' . esc_html($sub_subcategory->name) . '</a></li>';
                    }

                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>';
                $count++;
            }
        }
    }

    wp_die();
}
add_action('wp_ajax_load_forms', 'load_forms');
add_action('wp_ajax_nopriv_load_forms', 'load_forms');*/

// Handle AJAX request
function load_forms() {
    $parent_slug = sanitize_text_field($_POST['categories']);
    $update_left = filter_var($_POST['updateLeft'], FILTER_VALIDATE_BOOLEAN);
    $parent_term = get_term_by('slug', $parent_slug, 'form_download_category');
    $keyword = sanitize_text_field($_POST['keyword']);
    $number_of_post_to_display = sanitize_text_field($_POST['numofposts']); 
    $paged = isset($_POST['paged']) ? absint($_POST['paged']) : 1;

    $left_content = '';
    $right_content = '';

    if ($parent_term) {
        if ($update_left) {
            ob_start();

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
                    $sub_sub_args = array(
                        'taxonomy'   => 'form_download_category',
                        'parent'     => $subcategory->term_id,
                        'hide_empty' => false,
                    );

                    $sub_subcategories = get_terms($sub_sub_args);

                    if (empty($sub_subcategories)) {
                        $add_fclass = " no_sub";    
                        $active_class = "";
                        $max_height_style = "";
                    } else {
                        $add_fclass = "";
                        if (!$active_applied) {
                            $active_class = " active";
                            $max_height_style = "style='max-height: 350px;'";
                            $active_applied = true;
                        } else {
                            $active_class = "";
                            $max_height_style = ""; 
                        }
                    }

                    echo '<div class="faq_question_answer">';
                    echo '<div class="question'.$add_fclass.''.$active_class.'" data-slug="' . esc_attr($subcategory->slug) . '">' . esc_html($subcategory->name) . '</div>';

                    if (!empty($sub_subcategories) && !is_wp_error($sub_subcategories)) {
                        echo '<div class="answercont'.$active_class.'" '.$max_height_style.'>';
                        echo '<div class="answer">';
                        echo '<ul>';

                        foreach ($sub_subcategories as $sub_subcategory) {

                            // Fetch sub-sub-subcategories
                            $sub_sub_sub_args = array(
                                'taxonomy'   => 'form_download_category',
                                'parent'     => $sub_subcategory->term_id,
                                'hide_empty' => false,
                            );

                            //$sub_sub_subcategories = get_terms($sub_sub_sub_args);

                            //$li_class = !empty($sub_sub_subcategories) && !is_wp_error($sub_sub_subcategories) ? 'has-subcategories' : '';

                            /*if(!empty($sub_sub_subcategories)){
                                echo '<li class="'.$li_class.'"><a href="javascript:void(0);" data-slug="' . esc_attr($sub_subcategory->slug) . '" class="has_dropdown">' . esc_html($sub_subcategory->name) . '</a>';
                            }else{*/
                                echo '<li><a href="javascript:void(0);" data-slug="' . esc_attr($sub_subcategory->slug) . '">' . esc_html($sub_subcategory->name) . '</a>';
                            //}
                            
                            /*if (!empty($sub_sub_subcategories) && !is_wp_error($sub_sub_subcategories)) {
                                echo '<ul style="display:none;">';
                                foreach ($sub_sub_subcategories as $sub_sub_subcategory) {
                                    echo '<li><a href="javascript:void(0);" data-slug="' . esc_attr($sub_sub_subcategory->slug) . '">' . esc_html($sub_sub_subcategory->name) . '</a></li>';
                                }
                                echo '</ul>';
                            }*/

                            /*if(!empty($sub_sub_subcategories)){
                                echo '</li>';
                            }else{*/
                               echo '</li>'; 
                            //}
                        }

                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                    $count++;
                }
            }

            $left_content = ob_get_clean();
        }

        ob_start();

        if ($parent_slug == 'forms') {
            $terms = 'account-opening';
        } elseif ($parent_slug == 'platform-and-utilities') {
            $terms = 'trading-platforms';
        } else {
            $terms = sanitize_text_field($_POST['categories']);
        }

        $query_args = array(
            'post_type' => 'form_download',
            'posts_per_page' => $number_of_post_to_display,
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'form_download_category',
                    'field'    => 'slug',
                    'terms'    => $terms,
                ),
            ),
            's' => $keyword,
            'orderby' => 'title',
            'order' => 'DESC', 
        );

        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
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
            ?>
            <div class="blog-article">
                <div class="pagination">
                    <?php
                    $totalPages = $query->max_num_pages;
                    $paged = max(1, $paged);

                    if ($totalPages > 1) {
                        $data_page = "";
                        if ($paged > 1) {
                            $data_page = "data-page='".($paged-1)."'";
                        }
                        echo '<div class="page-numbers">';
                        if ($paged != 1) {
                            echo '<button '.$data_page.' class="prev-page page-numbers-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="none">
                                    <path d="M1.04175 6.44674L13.5417 6.44674" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6.08325 1.42639L1.04159 6.44639L6.08325 11.4672" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                Previous
                              </button>';
                        }

                        $range = 2;
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

                        if ($paged != $totalPages) {
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
        } else {
            //echo '<div class="form-inner-right"><p>No Forms found</p></div>';
            echo '<div class="form-inner-right"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';
        }

        wp_reset_postdata();

        $right_content = ob_get_clean();

        echo json_encode(array(
            'left' => $left_content,
            'right' => $right_content,
        ));
    }

    wp_die();
}
add_action('wp_ajax_load_forms', 'load_forms'); 
add_action('wp_ajax_nopriv_load_forms', 'load_forms');

/*
// Add this code to your theme's functions.php file or a custom plugin
function fetch_redbox_news() {
    $api_url = 'https://news.redboxglobal.in/api/news/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Im5pcmF2LmthbnNhcml3YWxhQGphaW5hbS5pbiIsImlhdCI6MTYzMTM3NjczNH0.DaiKz8F0wMrXSqB0gDVYhvxslcGToN7w5ostg6-fxiI';

    $response = wp_remote_get( $api_url, array(
        'headers' => array(
            'Authorization' => 'Bearer your_api_token_here'
        )
    ));

    if ( is_wp_error( $response ) ) {
        return 'Error: ' . $response->get_error_message();
    }

    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body, true );

    if ( ! is_array( $data ) || ! isset( $data['items'] ) ) {
        return 'Error decoding JSON';
    }

    return $data['items'];
}

function display_redbox_news() {
    $news_items = fetch_redbox_news();

    if ( is_string( $news_items ) ) {
        // Error message returned
        return $news_items;
    }

    $output = '<div id="news-container">';
    foreach ( $news_items as $news_item ) {
        $title = isset($news_item['title']) ? esc_html($news_item['title']) : 'No Title';
        $description = isset($news_item['description']) ? esc_html($news_item['description']) : 'No Description';
        $categories = isset($news_item['categories']) ? implode(', ', array_map('esc_html', $news_item['categories'])) : 'No Categories';

        $date = isset($news_item['date']) ? strtotime($news_item['date']) : false;
        $formatted_date = $date ? date('F j, Y', $date) : 'No Date';
        $formatted_time = $date ? date('H:i:s', $date) : 'No Time';

        $output .= '<div class="circular_cart" data-categories="' . implode(' ', array_map('strtolower', $news_item['categories'])) . '">
                        <div class="content_circular">
                            <h5>' . $title . '</h5>
                            <ul class="d_flex_center">
                                <li>' . $formatted_date . '</li>
                                <li>' . $formatted_time . '</li>
                                <li><span>' . $categories . '</span></li>
                            </ul>
                        </div>
                        <div class="download_circular">
                            <a href="javascript:void(0)" class="download-icon">
                                <img src="'.get_stylesheet_directory_uri().'/assets/img/share-icon.svg" alt="share-icon">
                            </a>
                        </div>
                    </div>';
    }
    $output .= '</div>';

    return $output;
}
add_shortcode( 'redbox_news', 'display_redbox_news' );*/

function fetch_redbox_news($page = 1, $items_per_page = 10, $category = 'all', $search = '') {
    $api_url = 'https://news.redboxglobal.in/api/news/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Im5pcmF2LmthbnNhcml3YWxhQGphaW5hbS5pbiIsImlhdCI6MTYzMTM3NjczNH0.DaiKz8F0wMrXSqB0gDVYhvxslcGToN7w5ostg6-fxiI';
    $response = wp_remote_get($api_url, array(
        'headers' => array( 
            'Authorization' => 'Bearer your_api_token_here'
        )
    ));

    if (is_wp_error($response)) {
        return array('error' => 'Error: ' . $response->get_error_message());
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    

    if (!is_array($data) || !isset($data['items'])) {
        return array('error' => 'Error decoding JSON');
    }

    $filtered_items = array_filter($data['items'], function($item) use ($category, $search) {
        $in_category = $category === 'all' || in_array($category, array_map('strtolower', $item['categories']));
        $matches_search = empty($search) || stripos($item['title'], $search) !== false || stripos($item['description'], $search) !== false;
        return $in_category && $matches_search;
    });



    $total_items = count($filtered_items);
    $total_pages = ceil($total_items / $items_per_page);

    return array(
        'items' => array_slice($filtered_items, ($page - 1) * $items_per_page, $items_per_page),
        'total_pages' => $total_pages,
        'total_items' => $total_items
    );
}

function fetch_catredbox_news($page = 1, $items_per_page = 1000, $category = 'all', $search = '') {
    $api_url = 'https://news.redboxglobal.in/api/news/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Im5pcmF2LmthbnNhcml3YWxhQGphaW5hbS5pbiIsImlhdCI6MTYzMTM3NjczNH0.DaiKz8F0wMrXSqB0gDVYhvxslcGToN7w5ostg6-fxiI';
    $response = wp_remote_get($api_url, array(
        'headers' => array( 
            'Authorization' => 'Bearer your_api_token_here'
        )
    ));

    if (is_wp_error($response)) {
        return array('error' => 'Error: ' . $response->get_error_message());
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    

    if (!is_array($data) || !isset($data['items'])) {
        return array('error' => 'Error decoding JSON');
    }

    $filtered_items = array_filter($data['items'], function($item) use ($category, $search) {
        $in_category = $category === 'all' || in_array($category, array_map('strtolower', $item['categories']));
        $matches_search = empty($search) || stripos($item['title'], $search) !== false || stripos($item['description'], $search) !== false;
        return $in_category && $matches_search;
    });



    $total_items = count($filtered_items);
    $total_pages = ceil($total_items / $items_per_page);

    return array(
        'items' => array_slice($filtered_items, ($page - 1) * $items_per_page, $items_per_page),
        'total_pages' => $total_pages,
        'total_items' => $total_items
    );
}

/*function get_unique_categories($news_items) {
    $categories = array();
    foreach ($news_items as $news_item) {
        if (isset($news_item['categories']) && is_array($news_item['categories'])) {
            foreach ($news_item['categories'] as $category) {
                $categories[] = esc_html($category);
            }
        }
    }
    return array_unique($categories);
}
*/

function get_unique_categories($news_items) {
    $categories = array();

    if (!is_array($news_items)) {
        error_log('Invalid news_items array: ' . print_r($news_items, true));
        return $categories; // Return empty array if $news_items is not an array
    }
     

    foreach ($news_items as $news_item) {



    //exit;
        if (isset($news_item['categories']) && is_array($news_item['categories'])) {
            foreach ($news_item['categories'] as $category) {
                $categories[] = esc_html($category);
            }
        } else {
            error_log('Categories missing or not array in news item: ' . print_r($news_item, true)); // Log error for debugging
        }
    }
   /* echo("<pre>");
        print_r(array_unique($categories));
        echo("</pre>");*/

    return array_unique($categories);
}

function display_redbox_news_categories() {
    
    $news_items = fetch_catredbox_news()['items'];
    if (isset($news_items['error'])) {
        return 'Error fetching news items: ' . esc_html($news_items['error']);
    }

    error_log('News items: ' . print_r($news_items, true)); // Log the news items for debugging
    $categories = get_unique_categories($news_items);

    error_log('Categories: ' . print_r($categories, true)); // Log the categories for debugging

    $output = '<div class="blog-list-top"><div class="tab_div">
                <div class="comm_tabing blog-list-top-inner">';
    $output .= '<a href="javascript:void(0)" data-slug="all" class="btn_tab more_btn active">All</a>';
    $count = 0;
    foreach ($categories as $category) {
        $class = ($count > 6) ? 'category-filter hidden-category' : 'category-filter';
        $output .= '<a href="javascript:void(0)" data-slug="' . strtolower($category) . '" class="btn_tab '.$class.'">' . $category . '</a>';

        if($count > 6){
            $output .= '<a href="javascript:void(0)" class="see-more-opc">See more</a>';
        }

        $count++; 
    }
    

    $output .= '</div></div></div>';

    return $output; 
}

add_shortcode('redbox_news_categories', 'display_redbox_news_categories');

function display_redbox_news($atts) {

    $search_title = isset($_GET['title']) ? sanitize_text_field($_GET['title']) : '';

    if($search_title != ""){
        $atts = shortcode_atts(array(
            'page' => 1,
            'items_per_page' => 10,
            'category' => 'all',
            'search' => $search_title
        ), $atts);

    }else{
        $atts = shortcode_atts(array(
            'page' => 1,
            'items_per_page' => 10,
            'category' => 'all',
            'search' => ''
        ), $atts);
    }

    $news_data = fetch_redbox_news($atts['page'], $atts['items_per_page'], $atts['category'], $atts['search']);

    if (isset($news_data['error'])) {
        return $news_data['error'];
    }

    $news_items = $news_data['items'];
    $total_pages = $news_data['total_pages'];

    $output = '<div id="loader" style="display: none;"><img src="'.get_stylesheet_directory_uri().'/assets/img/loader.gif" style="width: 35px;margin: 0 auto; display: table; margin-bottom: 20px;" alt="Loading..." /></div><div id="news-container"><div class="newsapi_main">';
    if (empty($news_items)) {
        $output .= '<div class="no-news" id="news-container"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';
        //$output .= '<p>No news found.</p>';
    } else {
            foreach ($news_items as $news_item) {
                $title = isset($news_item['title']) ? esc_html($news_item['title']) : 'No Title';
                $description = isset($news_item['description']) ? esc_html($news_item['description']) : 'No Description';
                $categories = isset($news_item['categories']) ? implode(', ', array_map('esc_html', $news_item['categories'])) : 'No Categories';
                $date = isset($news_item['date']) ? strtotime($news_item['date']) : false;
                $formatted_date = $date ? date('F j, Y', $date) : 'No Date';
                $formatted_time = $date ? date('H:i:s', $date) : 'No Time';

                $output .= '<div class="circular_cart" data-categories="' . implode(' ', array_map('strtolower', $news_item['categories'])) . '" data-id="'.esc_attr($news_item['id']).'" data-title="'.esc_attr($news_item['title']).'" data-url="'.esc_attr($news_item['url']).'" data-description="'.esc_attr($news_item['description']).'">
                                <div class="content_circular">
                                    <h5>' . $title . '</h5>
                                    <ul class="d_flex_center">
                                        <li>' . $formatted_date . '</li>
                                        <li>' . $formatted_time . '</li>
                                    </ul>
                                </div>
                                <div class="download_circular">
                                    <a href="javascript:void(0)" class="download-icon click-social-modal">
                                        <img src="' . get_stylesheet_directory_uri() . '/assets/img/share-icon.svg" alt="share-icon">
                                    </a>
                                </div>
                            </div>';
            }
        }

        $output .= '</div>';

        if($search_title != ""){
            $output .= '</div>';
        }

    // Pagination
    if ($total_pages > 1) {
        $output .= '<div class="blog-article"><div class="pagination"><div class="page-numbers">';
        if ($atts['page'] > 1) {
            $output .= '<button data-page="' . ($atts['page'] - 1) . '" class="prev-page page-numbers-button"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="none">
                                    <path d="M1.04175 6.44674L13.5417 6.44674" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6.08325 1.42639L1.04159 6.44639L6.08325 11.4672" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>Previous</button>';
        }

        $range = 2;
        $start = max(1, $atts['page'] - $range);
        $end = min($total_pages, $atts['page'] + $range);

        if ($start > 1) {
            $output .= '<button class="page-numbers-button" data-page="1">1</button>';
            if ($start > 2) {
                $output .= '<span class="dots">...</span>';
            }
        }

        for ($i = $start; $i <= $end; $i++) {
            $output .= '<button class="page-numbers-button ' . ($atts['page'] == $i ? 'active' : '') . '" data-page="' . $i . '">' . $i . '</button>';
        }

        if ($end < $total_pages) {
            if ($end < $total_pages - 1) {
                $output .= '<span class="dots">...</span>';
            }
            $output .= '<button class="page-numbers-button" data-page="' . $total_pages . '">' . $total_pages . '</button>';
        }

        if ($atts['page'] < $total_pages) {
            $output .= '<button data-page="' . ($atts['page'] + 1) . '" class="next-page page-numbers-button">Next<svg xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="none">
                                    <path d="M13.9583 6.44674L1.45825 6.44674" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8.91675 1.42639L13.9584 6.44639L8.91675 11.4672" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></button>';
        }
        $output .= '</div></div></div></div>';
    }

    return $output;
}
add_shortcode('redbox_news', 'display_redbox_news'); 


#### AJAX Handler

function filter_news_pagination() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    echo do_shortcode('[redbox_news page="' . $page . '" category="' . $category . '" search="' . $search . '"]');
    wp_die();
}
add_action('wp_ajax_filter_news_pagination', 'filter_news_pagination');
add_action('wp_ajax_nopriv_filter_news_pagination', 'filter_news_pagination');


function fetch_articles($page = 1, $items_per_page = 10) {
    $api_url = 'https://apidata.redboxglobal.com/api/india/crawler/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InBpeXVzaC5hZ2Fyd2FsQGphaW5hbS5pbiIsImlhdCI6MTcxODQzNTUwM30.nu0gTU2stluUXX6QzWKD31s0au5uH29G15KfQWe7_qo';
    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        return array('error' => 'Error: ' . $response->get_error_message());
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!is_array($data)) {
        return array('error' => 'Error decoding JSON');
    }

    $total_items = count($data);
    $total_pages = ceil($total_items / $items_per_page);

    return array(
        'items' => array_slice($data, ($page - 1) * $items_per_page, $items_per_page),
        'total_pages' => $total_pages,
        'total_items' => $total_items
    );
}

function fetch_catarticles($page = 1, $items_per_page = 1000) {
    $api_url = 'https://apidata.redboxglobal.com/api/india/crawler/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InBpeXVzaC5hZ2Fyd2FsQGphaW5hbS5pbiIsImlhdCI6MTcxODQzNTUwM30.nu0gTU2stluUXX6QzWKD31s0au5uH29G15KfQWe7_qo';
    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        return array('error' => 'Error: ' . $response->get_error_message());
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!is_array($data)) {
        return array('error' => 'Error decoding JSON');
    }

    $total_items = count($data);
    $total_pages = ceil($total_items / $items_per_page);

    return array(
        'items' => array_slice($data, ($page - 1) * $items_per_page, $items_per_page),
        'total_pages' => $total_pages,
        'total_items' => $total_items
    );
}

function get_symbols_from_excel($file_path) {
    require_once get_stylesheet_directory() . '/vendor/autoload.php';

    if (!file_exists($file_path)) {
        error_log("File not found: " . $file_path);
        return [];
    }

    try {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_path);
    } catch (Exception $e) {
        error_log("Error loading spreadsheet: " . $e->getMessage());
        return [];
    }

    $sheet = $spreadsheet->getActiveSheet();
    $symbols = [];

    foreach ($sheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        foreach ($cellIterator as $cell) {
            $value = $cell->getValue();
            if (!empty($value)) {
                $symbols[] = $value;
            }
        }
    }

    return $symbols;
}

function display_articles($articles_data,$total_filtered_items,$page = 1) {

    if ($articles_data === null) {
        $articles_data = fetch_articles($page, 10);
    }

    if (isset($articles_data['error'])) {
        return $articles_data['error'];
    }

    $articles_items = $articles_data['items'];
    $total_pages = $articles_data['total_pages'];

    $file_path = get_stylesheet_directory() . '/assets/NSE Symbols list.xlsx';
    $symbols_list = get_symbols_from_excel($file_path);
    $symbols_list = array_map('strtoupper', $symbols_list);

    $output = '<div id="loader-articles" style="display: none;"><img src="' . get_stylesheet_directory_uri() . '/assets/img/loader.gif" style="width: 35px;margin: 0 auto; display: table; margin-bottom: 20px;" alt="Loading..." /></div><div id="articles-container"><div class="articlesapi_main">';

    if ($total_filtered_items == 0) {
        echo '<div class="no-articles" id="articles-container"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';
        //echo '<div class="no-articles">No articles found.</div>';
    } else {

        foreach ($articles_items as $article_item) {
            $title = isset($article_item['article']['title']) ? esc_html($article_item['article']['title']) : 'No Title';
            $link = isset($article_item['article']['link']) ? esc_url($article_item['article']['link']) : '#';
            $score = isset($article_item['sentiment']['score']) ? intval($article_item['sentiment']['score']) : 0;

            $random_number = rand(1, 350); // Generate a random number between 1 and 350

            $category = 'neutral';
            $image = '<b><img src="'.get_stylesheet_directory_uri().'/assets/img/grey-star.png" alt="star-icon"> '.$random_number.'</b>';
            if ($score > 0) {
                $category = 'positive';
                $image = '<b><img src="'.get_stylesheet_directory_uri().'/assets/img/star-green.svg" alt="star-icon"> '.$random_number.'</b>';
            } elseif ($score < 0) {
                $category = 'negative';
                $image = '<b><img src="'.get_stylesheet_directory_uri().'/assets/img/yellow-star.png" alt="star-icon"> '.$random_number.'</b>';
            }
            $date = isset($article_item['createdAt']) ? strtotime($article_item['createdAt']) : false;
            $formatted_date = $date ? date('F j, Y', $date) : 'No Date';
            $formatted_time = $date ? date('H:i:s', $date) : 'No Time';

            // Check article's symbols
            $company_symbols = array_map('strtoupper', array_column($article_item['company'], 'symbol'));
            $matched_symbols = array_intersect($company_symbols, $symbols_list);
            if (empty($matched_symbols)) {
                $matched_symbols = ['Others'];
            }

            $output .= '<div class="circular_cart" data-categories="' . strtolower($category) . '" data-id="' . esc_attr($article_item['_id']) . '" data-title="' . esc_attr($title) . '" data-url="' . esc_attr($link) . '" data-description="' . esc_attr($title) . '">
                            <div class="content_circular">
                                <h5>' . $title . '</h5>
                                <ul class="d_flex_center">
                                    <li>' . $formatted_date . '</li>
                                    <li>' . $formatted_time . '</li>
                                    <li>'.implode(', ', $matched_symbols) . '</li>
                                    <li>
                                        <span>'.$image.'</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="download_circular">
                                <a href="javascript:void(0)" class="download-icon click-social-modal">
                                        <img src="' . get_stylesheet_directory_uri() . '/assets/img/share-icon.svg" alt="share-icon">
                                </a>
                                <a href="' . $link . '" class="read_more_btn" target="_blank">Read More
                                    <img src="'.get_stylesheet_directory_uri().'/assets/img/slider_arrow.svg" alt="slider_arrow-icon">
                                </a>
                            </div>
                        </div>';
        }
    }

    $output .= '</div>';

    // Pagination
    if ($total_pages > 1) {
        $output .= '<div class="blog-article"><div class="pagination"><div class="page-numbers">';
        if ($page > 1) {
            $output .= '<button data-page="' . ($page - 1) . '" class="prev-page-articles page-numbers-button"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="none">
                                    <path d="M1.04175 6.44674L13.5417 6.44674" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6.08325 1.42639L1.04159 6.44639L6.08325 11.4672" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>Previous</button>';
        }

        $range = 2;
        $start = max(1, $page - $range);
        $end = min($total_pages, $page + $range);

        if ($start > 1) {
            $output .= '<button class="page-numbers-button" data-page="1">1</button>';
            if ($start > 2) {
                $output .= '<span class="dots">...</span>';
            }
        }

        for ($i = $start; $i <= $end; $i++) {
            $output .= '<button class="page-numbers-button ' . ($page == $i ? 'active' : '') . '" data-page="' . $i . '">' . $i . '</button>';
        }

        if ($end < $total_pages) {
            if ($end < $total_pages - 1) {
                $output .= '<span class="dots">...</span>';
            }
            $output .= '<button class="page-numbers-button" data-page="' . $total_pages . '">' . $total_pages . '</button>';
        }

        if ($page < $total_pages) {
            $output .= '<button data-page="' . ($page + 1) . '" class="next-page-articles page-numbers-button">Next<svg xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="none">
                                    <path d="M13.9583 6.44674L1.45825 6.44674" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8.91675 1.42639L13.9584 6.44639L8.91675 11.4672" stroke="#596173" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></button>';
        }
        $output .= '</div></div></div></div>';
    }

    return $output;
}
add_shortcode('articles', 'display_articles');

function filter_articles_pagination() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $articles_data = fetch_articles(1, 1000); // Fetch a large number of articles to handle filtering

    $filtered_items = array_filter($articles_data['items'], function($item) use ($category, $search) {
        $score = isset($item['sentiment']['score']) ? intval($item['sentiment']['score']) : 0;
        $title = isset($item['article']['title']) ? $item['article']['title'] : '';

        // Log for debugging
        error_log('Title: ' . $title . ' | Score: ' . $score . ' | Category: ' . $category);

        // Filter by category
        if ($category == 'positive' && $score <= 0) {
            return false;
        } elseif ($category == 'negative' && $score >= 0) {
            return false;
        } elseif ($category == 'neutral' && $score != 0) {
            return false;
        } elseif ($category != 'all' && !in_array($category, ['positive', 'negative', 'neutral'])) {
            return false;
        }
    
        if ($search && stripos($title, $search) === false) {
            return false;
        }         

        return true;
    });

    $total_filtered_items = count($filtered_items);
    $items_per_page = 10;
    $total_pages = ceil($total_filtered_items / $items_per_page);

    $start = ($page - 1) * $items_per_page;
    $filtered_items = array_slice($filtered_items, $start, $items_per_page);

    $articles_data['items'] = array_values($filtered_items);
    $articles_data['total_pages'] = $total_pages;

    echo display_articles($articles_data,$total_filtered_items, $page);
    wp_die();
}
add_action('wp_ajax_filter_articles_pagination', 'filter_articles_pagination');
add_action('wp_ajax_nopriv_filter_articles_pagination', 'filter_articles_pagination');


function filter_articles_pagination_search_title() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    //$search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $search = isset($_GET['article_title']) ? sanitize_text_field($_GET['article_title']) : '';

    $articles_data = fetch_articles(1, 1000); // Fetch a large number of articles to handle filtering

    $filtered_items = array_filter($articles_data['items'], function($item) use ($category, $search) {
        $score = isset($item['sentiment']['score']) ? intval($item['sentiment']['score']) : 0;
        $title = isset($item['article']['title']) ? $item['article']['title'] : '';

        // Log for debugging
        error_log('Title: ' . $title . ' | Score: ' . $score . ' | Category: ' . $category);

        // Filter by category
        if ($category == 'positive' && $score <= 0) {
            return false;
        } elseif ($category == 'negative' && $score >= 0) {
            return false;
        } elseif ($category == 'neutral' && $score != 0) {
            return false;
        } elseif ($category != 'all' && !in_array($category, ['positive', 'negative', 'neutral'])) {
            return false;
        }

        if ($search && stripos($title, $search) === false) {
            return false;
        } 

        return true;
    });

    $total_filtered_items = count($filtered_items);
    $items_per_page = 10;
    $total_pages = ceil($total_filtered_items / $items_per_page);

    $start = ($page - 1) * $items_per_page;
    $filtered_items = array_slice($filtered_items, $start, $items_per_page);

    $articles_data['items'] = array_values($filtered_items);
    $articles_data['total_pages'] = $total_pages;

    echo display_articles($articles_data,$total_filtered_items, $page);
    wp_die();
}
add_action('wp_ajax_filter_articles_pagination', 'filter_articles_pagination');
add_action('wp_ajax_nopriv_filter_articles_pagination', 'filter_articles_pagination');


function get_unique_article_categories($articles) {
    $categories = array(
        'Positive' => false,
        'Neutral' => false,
        'Negative' => false
    );

    foreach ($articles as $article) {
        $score = isset($article['sentiment']['score']) ? intval($article['sentiment']['score']) : 0;
        if ($score > 0) {
            $categories['Positive'] = true;
        } elseif ($score < 0) {
            $categories['Negative'] = true;
        } else {
            $categories['Neutral'] = true;
        }
    }

    return array_keys(array_filter($categories));
}

function display_article_categories() {
    
    $articles_data = fetch_catarticles()['items'];
    $categories = get_unique_article_categories($articles_data);

    /*echo("<pre>");
    print_r($categories);
    echo("</pre>");*/

    $output = '<div class="tab_div"><ul class="comm_tabing">';
    $output .= '<li><a href="javascript:void(0)" data-slug="all" class="btn_tab more_btn active">All</a></li>';
    foreach ($categories as $category) {
        $output .= '<li><a href="javascript:void(0)" data-slug="' . strtolower($category) . '" class="btn_tab">' . $category . '</a></li>';
    }
    $output .= '</ul></div>';

    return $output;
}
add_shortcode('article_categories', 'display_article_categories');

// Custom validation for email field
add_filter('wpcf7_validate_email*', 'custom_email_validation_filter', 20, 2);
add_filter('wpcf7_validate_email', 'custom_email_validation_filter', 20, 2);
function custom_email_validation_filter($result, $tag) {
    $tag = new WPCF7_FormTag($tag);

    if ('your-email' == $tag->name) {
        $email = isset($_POST[$tag->name]) ? trim($_POST[$tag->name]) : '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result->invalidate($tag, "Please enter a valid email address."); 
        }
    }

    return $result;
}

// Custom validation for phone field
add_filter('wpcf7_validate_tel*', 'custom_phone_validation_filter', 20, 2);
add_filter('wpcf7_validate_tel', 'custom_phone_validation_filter', 20, 2);
function custom_phone_validation_filter($result, $tag) {
    $tag = new WPCF7_FormTag($tag);

    if ('mobile' == $tag->name) {
        $phone = isset($_POST[$tag->name]) ? trim($_POST[$tag->name]) : '';

        // Update the regex to allow only 10 digits not starting with zero
        if (!preg_match('/^[1-9][0-9]{9}$/', $phone)) {
            $result->invalidate($tag, "Please enter a valid mobile number.");
        }
    }

    return $result;
}

// Custom validation for name field
add_filter('wpcf7_validate_text*', 'custom_name_validation_filter', 20, 2);
add_filter('wpcf7_validate_text', 'custom_name_validation_filter', 20, 2);
function custom_name_validation_filter($result, $tag) {
    $tag = new WPCF7_FormTag($tag);

    if ('your-name' == $tag->name) {
        $name = isset($_POST[$tag->name]) ? trim($_POST[$tag->name]) : '';

        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $result->invalidate($tag, "Please enter a valid name.");
        }
    }

    return $result;
}

function header_custom_search() {
    $search_query = sanitize_text_field($_GET['s']);

    if (empty($search_query)) {
        wp_send_json_error('No search query provided');
    }

    $args = array(
        'post_type' => array('post', 'circular'),
        'posts_per_page' => -1,
        's' => $search_query,
        'exact' => true
    );

    add_filter('posts_search', function($search, $wp_query) use ($search_query) {
        global $wpdb;

        if (empty($search)) {
            return $search;
        }

        $search = $wpdb->prepare(" AND ({$wpdb->posts}.post_title LIKE %s)", '%' . $wpdb->esc_like($search_query) . '%');

        return $search;

    }, 10, 2);

    $search = new WP_Query($args);

    $results = array();
    if ($search->have_posts()) {
        while ($search->have_posts()) {
            $search->the_post();
            $post_type = get_post_type();
            if ($post_type == 'post') {
                $link = get_permalink();
            } else if ($post_type == 'circular') {
                $link = get_site_url() . '/circulars/?title=' . get_the_title();
            } else {
                $link = 'javascript:void(0)';
            }
            $results[] = array(
                'title' => get_the_title(),
                'excerpt' => get_the_excerpt(),
                'permalink' => $link,
                'post_type' => $post_type
            );
        }
        wp_reset_postdata();
    }

    // Make API calls for articles and news
    $news_api_url = 'https://news.redboxglobal.in/api/news/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Im5pcmF2LmthbnNhcml3YWxhQGphaW5hbS5pbiIsImlhdCI6MTYzMTM3NjczNH0.DaiKz8F0wMrXSqB0gDVYhvxslcGToN7w5ostg6-fxiI';

    $articles_api_url = 'https://apidata.redboxglobal.com/api/india/crawler/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InBpeXVzaC5hZ2Fyd2FsQGphaW5hbS5pbiIsImlhdCI6MTcxODQzNTUwM30.nu0gTU2stluUXX6QzWKD31s0au5uH29G15KfQWe7_qo';

    // Fetch and decode JSON responses
    $news_response = wp_remote_get($news_api_url);
    $articles_response = wp_remote_get($articles_api_url);

    $news_results = json_decode(wp_remote_retrieve_body($news_response), true);
    $articles_results = json_decode(wp_remote_retrieve_body($articles_response), true);

    // Process news results
    if (!empty($news_results['items'])) {
        foreach ($news_results['items'] as $news_item) {
            if (stripos($news_item['title'], $search_query) !== false) {
                $results[] = array(
                    'title' => $news_item['title'],
                    'excerpt' => substr($news_item['description'], 0, 100) . '...',
                    'permalink' => get_site_url() . '/news/?title=' . $news_item['title'],  // Assuming 'guid' is the URL here
                    'post_type' => 'news'
                );
            }
        }
    }

    // Process articles results
    if (!empty($articles_results)) {
        foreach ($articles_results as $article_item) {
            if (stripos($article_item['article']['title'], $search_query) !== false) {
                $results[] = array(
                    'title' => $article_item['article']['title'],
                    'excerpt' => '',  // No description field in the provided structure
                    'permalink' => get_site_url() . '/news/?article_title=' . $article_item['article']['title'],
                    'post_type' => 'articles'
                );
            }
        }
    }

    if (!empty($results)) {
        wp_send_json_success($results);
    } else {
        wp_send_json_error('No results found');
    }
}

add_action('wp_ajax_header_custom_search', 'header_custom_search');
add_action('wp_ajax_nopriv_header_custom_search', 'header_custom_search');

function search_empty_header() {
    $output = [
        'blogs' => '',
        'circulars' => '',
        'news' => '',
        'articles' => ''
    ];

    // Fetch posts
    $post_args = array(
        'post_type' => 'post',
        'posts_per_page' => 10
    );

    $post_query = new WP_Query($post_args);
    if ($post_query->have_posts()) {
        while ($post_query->have_posts()) {
            $post_query->the_post();
            $output['blogs'] .= '<div class="serch-bar-tab-content-box">
                <p><a href="' . get_permalink() . '" target="_blank" class="header_search_link">' . get_the_title() . '</a></p>
                <span>post</span>
            </div>';
        }
        wp_reset_postdata(); 
    }

    // Fetch circulars
    $circular_args = array(
        'post_type' => 'circular',
        'posts_per_page' => 10
    );

    $circular_query = new WP_Query($circular_args);
    if ($circular_query->have_posts()) {
        while ($circular_query->have_posts()) {
            $circular_query->the_post();

            $link = get_site_url() . '/circulars/?title=' . get_the_title();

            $output['circulars'] .= '<div class="serch-bar-tab-content-box">
                <p><a href="'.$link.'" target="_blank" class="header_search_link">' . get_the_title() . '</a></p>
                <span>circular</span>
            </div>';
        }
        wp_reset_postdata();
    }

    // Fetch news from API
    $news_api_url = 'https://news.redboxglobal.in/api/news/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Im5pcmF2LmthbnNhcml3YWxhQGphaW5hbS5pbiIsImlhdCI6MTYzMTM3NjczNH0.DaiKz8F0wMrXSqB0gDVYhvxslcGToN7w5ostg6-fxiI';
    $news_response = wp_remote_get($news_api_url);
    $news_results = json_decode(wp_remote_retrieve_body($news_response), true);

    $news_count = 0;
    if (!empty($news_results['items'])) {
        foreach ($news_results['items'] as $news_item) {
            if ($news_count >= 10) break;
            $output['news'] .= '<div class="serch-bar-tab-content-box">
                <p><a href="' . get_site_url() . '/news/?title=' . $news_item['title'] . '" target="_blank" class="header_search_link">' . $news_item['title'] . '</a></p>
                <span>news</span>
            </div>';
            $news_count++;
        }
    }

    // Fetch articles from API
    $articles_api_url = 'https://apidata.redboxglobal.com/api/india/crawler/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InBpeXVzaC5hZ2Fyd2FsQGphaW5hbS5pbiIsImlhdCI6MTcxODQzNTUwM30.nu0gTU2stluUXX6QzWKD31s0au5uH29G15KfQWe7_qo';
    $articles_response = wp_remote_get($articles_api_url);
    $articles_results = json_decode(wp_remote_retrieve_body($articles_response), true);

    $articles_count = 0;

    if (!empty($articles_results)) {
        foreach ($articles_results as $article_item) {
            if ($articles_count >= 10) break;
            $output['articles'] .= '<div class="serch-bar-tab-content-box">
                <p><a href="' . get_site_url() . '/news/?article_title=' . $article_item['article']['title'] . '" target="_blank" class="header_search_link">' . $article_item['article']['title'] . '</a></p>
                <span>articles</span>
            </div>';
            $articles_count++;
        }
    }

    // Return the output as JSON
    wp_send_json_success($output);
    wp_die(); // Terminate immediately and return proper response
}
add_action('wp_ajax_search_empty_header', 'search_empty_header');
add_action('wp_ajax_nopriv_search_empty_header', 'search_empty_header');
