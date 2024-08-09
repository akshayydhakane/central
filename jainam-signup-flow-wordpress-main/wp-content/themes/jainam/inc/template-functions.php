<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package jainam
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jainam_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'jainam_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function jainam_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'jainam_pingback_header' );

// Register the shortcode for breadcrumb
function custom_breadcrumb_shortcode() {
	// Get the current post or page object
	$current_post = get_queried_object();

	// Start building the breadcrumb HTML
	//$breadcrumb = '<div class="blog-title"><div class="blog-title-inner">';

	// Add Home link
	$breadcrumb .= '<a href="' . esc_url(home_url('/')) . '">Home</a>'; 

	// Check if the current post is a single post
	if (is_singular('post')) {
		 // Get the category of the post
		 $categories = get_the_category($current_post->ID);
		 if ($categories) {
			  // Get the first category
			  $category = $categories[0];
			  // Add category link
			  $breadcrumb .= '<span> <small>/</small> <a href="'.get_site_url().'/blog/?category='.$category->slug.'">' . esc_html($category->name) . '</a></span>';
		 }
		 // Add post title
		 $breadcrumb .= '<span> <small>/</small> ' . esc_html(get_the_title($current_post)) . '</span>';
	} elseif (is_category()) {
		 // Get the category object
		 $category = get_queried_object();
		 // Add category name
		 $breadcrumb .= '<span> <small>/</small> ' . esc_html($category->name) . '</span>';
	} elseif (is_page()) {
		 // Add page title
		 $breadcrumb .= '<span> <small>/</small> ' . esc_html($current_post->post_title) . '</span>';
	}

	// Close the breadcrumb HTML
	//$breadcrumb .= '</div></div>';

	// Return the breadcrumb HTML
	return $breadcrumb;
}

add_shortcode('custom_breadcrumb', 'custom_breadcrumb_shortcode');function increment_post_read_count_by_ip() {
	if (is_single() && !is_admin()) {
		 $post_id = get_the_ID();
		 $ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

		 // Debugging - Output IP address to check
		 error_log('IP Address: ' . $ip_address);

		 // Get the read count for this IP address and post ID
		 $read_count = get_post_meta($post_id, 'read_count_' . $ip_address, true);

		 // Debugging - Output read count to check
		 error_log('Read Count: ' . $read_count);

		 // If this IP address hasn't read this post before, increment the count
		 if (!$read_count) {
			  $read_count = 1;
		 } else {
			  $read_count++;
		 }

		 // Update the read count for this IP address and post ID
		 update_post_meta($post_id, 'read_count_' . $ip_address, $read_count);
	}
}
add_action('wp', 'increment_post_read_count_by_ip');

// Register the shortcode
function account_open_blog_shortcode() {
	$cta_heading = get_field('subscriber_heading', 'option');
    $cta_subtext = get_field('subscribe_sub_heading', 'option');
	
	// Start building the HTML
	$html = '<div class="account-open-blog blue_open_cart">';
	$html .= '<div class="account-open-blog-inner">';
	$html .= '<h3>'. esc_html($cta_heading) .'</h3>';
	$html .= $cta_subtext;
	$html .= '<div class="enter-number">';

	/*$html .= '<div class="input-group">';
	$html .= '<input type="number" placeholder="Enter mobile number" maxlength="10">';
	$html .= '<a href="javascript:void(0)"> Proceed </a>';
	$html .= '<div data-lastpass-icon-root="" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div>';
	$html .= '</div>';*/

	$html.= do_shortcode('[contact-form-7 id="77903aa" title="Contact us"]');

	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';

	// Return the HTML
	return $html;
}
add_shortcode('account_open_blog', 'account_open_blog_shortcode');
// Register the shortcode
function custom_toc_shortcode() {
	// Get the post content
	global $post;
	$content = $post->post_content;

	// Check if there are headings available in the content
	if (strpos($content, '<h') !== false) {
		 // Start building the TOC HTML
		 $toc_html = '<div class="toc blog-detail-sec-content-table">';
		 $toc_html .= '<h3>Table of Contents</h3>';
		 $toc_html .= '<ul class="toc-list">'; // Added class "toc-list" to the outer ul element

		 // Get headings from the post content
		 $pattern = '/<h([2-6]).*?>(.*?)<\/h[2-6]>/'; // Regex pattern to match headings from h2 to h6
		 preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

		 // Array to track used heading IDs to prevent duplicates
		 $heading_count = array(); // Array to count occurrences of heading texts

		 // If there are headings, add them to the TOC
		 if (!empty($matches)) {
			  $prev_level = 2; // Set initial previous level
			  foreach ($matches as $match) {
					$heading_level = $match[1]; // Heading level (e.g., h2, h3, etc.)
					$heading_text = strip_tags($match[2]); // Text of the heading
					$base_id = sanitize_title($heading_text); // Sanitize heading text to create a base ID

					// Count occurrences of the same heading text
					if (isset($heading_count[$base_id])) {
						 $heading_count[$base_id]++;
					} else {
						 $heading_count[$base_id] = 1;
					}

					// Generate a unique ID for the heading
					$heading_id = $base_id . '-' . $heading_count[$base_id];

					// Add an ID attribute to the heading
					$heading_with_id = str_replace('<h' . $heading_level, '<h' . $heading_level . ' id="' . $heading_id . '"', $match[0]);

					// Update the post content with the new heading IDs
					$content = str_replace($match[0], $heading_with_id, $content);

					// Check if the current heading level is lower than the previous level
					if ($heading_level < $prev_level) {
						 // Close the previous list item
						 $toc_html .= '</li>';
						 // Close any remaining open ul elements
						 for ($i = $prev_level; $i > $heading_level; $i--) {
							  $toc_html .= '</ul>';
							  $toc_html .= '</li>';
						 }
					} elseif ($heading_level > $prev_level) {
						 // If the current heading level is higher than the previous level, start a new nested list
						 $toc_html .= '<ul>';
					}

					// Build TOC list item
					$toc_html .= '<li class="toc-level-' . $heading_level . '">';
					$toc_html .= '<a href="#' . $heading_id . '">' . $heading_text . '</a>';

					// Update the previous level
					$prev_level = $heading_level;
			  }
			  // Close any remaining open ul elements
			  for ($i = $prev_level; $i > 2; $i--) {
					$toc_html .= '</li>';
					$toc_html .= '</ul>';
			  }
			  $toc_html .= '</ul>';
			  $toc_html .= '</div>';
		 } else {
			  // If there are no headings, return an empty string
			  $toc_html = '';
		 }
	} else {
		 // If there are no headings, return an empty string
		 $toc_html = '';
	}

	// Update the post content with the modified headings
	$post->post_content = $content;

	// Enqueue smooth scroll JavaScript
	wp_enqueue_script('custom-smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array('jquery'), null, true);

	// Return the TOC HTML
	return $toc_html;
}

// Register the shortcode
add_shortcode('toc', 'custom_toc_shortcode');
