<?php
/**
 * Template Name: Blog
 */
get_header(); ?>

<section class="blog-section">
    <div class="container">
        <div class="blog-title">
            <div class="blog-title-inner"><?php
                echo '<h1>' . get_the_title() . '</h1>';
                ?>
               <!-- Place this HTML code wherever you want the search box to appear on your blog pages -->

                <div class="blog-search">
                   
                    <form role="search" method="get" class="search-form blog_search_form" action="<?php echo get_site_url(); ?>">
                        <div class="input-group">
                            <input type="search" class="search-field blog_search_field" id="blog_search_field" placeholder="<?php echo esc_attr_x( 'Search in blog', 'placeholder', 'textdomain' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'textdomain' ); ?>" pattern=".*\S.*" oninvalid="this.setCustomValidity('Please enter a valid search query.')" oninput="this.setCustomValidity('')" required>
                            <button class="btn_serch btn_blog_search" type="submit">
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
    </div>
    <div class="blog-list-top"> 
        <div class="tab_div">
        <div class="comm_tabing blog-list-top-inner blog_categories_filterfromurl">
            <!-- <a href="<?php //echo esc_url(get_permalink()); ?>" class="category-filter" data-category="all_cat">All</a> -->
            <?php
            // Retrieve all categories
            $categories = get_terms(array(
                'taxonomy' => 'category',
                'hide_empty' => true, // Show even empty categories
            ));
            
            $count = 0;

            $current_category = isset($_GET['category']) ? $_GET['category'] : '';
            $total_categories = count($categories); // Get the total number of categories

            // Output category links
            foreach ($categories as $category) {

                $class = ($count >= 8) ? 'category-filter hidden-category' : 'category-filter';
                // Add 'active' class if this category matches the current category

                if ($category->slug == $current_category) {
                    $class .= ' active';
                }
                
                echo '<a href="' . esc_url(add_query_arg('category', $category->slug, get_permalink())) . '" class="' . $class . ' btn_tab" data-category="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</a>';
                $count++;
            }
             
            // Show "See more" button only if there are more than 8 categories
            if ($total_categories > 8) {
                echo '<a href="javascript:void(0)" class="see-more-opc">See more</a>';
            }
            ?>
        </div>
    </div>
    </div>

        <?php
// Query to fetch the latest post with the featured_post field checked
$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1, // Retrieve all posts
    'meta_query' => array(
        array(
            'key' => 'featured_post', // Replace 'featured_post' with your ACF field key
            'value' => '1', // The value '1' represents true/checked
            'compare' => '=', // Compare for equality
        
        ),
    ),
);
$featured_query = new WP_Query($args);

    if ($featured_query->have_posts()) :
        while ($featured_query->have_posts()) : $featured_query->the_post();
            ?>
            <div class="blog-info">
                <div class="blog-info-inner">
                    <a href="<?php the_permalink(); ?>">
                        <div class="blog-info-left">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog-info.webp" alt="blog">
                            <?php endif; ?>
                        </div>
                        </a>
                    <div class="blog-info-right">
                        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                        <div class="blog-write-info">
                            <?php
                            // Fetch author image if available, otherwise use a placeholder
                            $author_id = get_the_author_meta('ID');
                            $author_avatar = get_avatar_url($author_id, array('size' => 64));
                            ?>
                            <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php the_author(); ?>">
                            <p>Written by <?php the_author(); ?></p>
                        </div>
                        <div class="blog-date-info"><?php
                            $category = get_the_category();
                            if ( ! empty( $category ) ) { 
                                $category_name = $category[0]->name;
                                $category_link = get_category_link( $category[0]->term_id ); // ' . esc_url( $category_link ) . '
                                echo '<a href="javascript:void(0)">' . esc_html( $category_name ) . '</a>';
                            }?>
                            <p><?php echo get_the_date('M d, Y'); ?></p>
                            <?php
                            // Calculate reading time
                            $content = get_post_field( 'post_content', get_the_ID() );
                            $word_count = str_word_count( strip_tags( $content ) );
                            $reading_time = ceil( $word_count / 200 ); // Assuming average reading speed is 200 words per minute
                            echo '<p>' . esc_html( $reading_time ) . ' min read</p>'; ?>
                        </div>
                        <p class="blog_content_readmore"><?php echo wp_trim_words(get_the_content(), 40, '...'); ?><a class="read-more" href="<?php echo get_the_permalink(); ?>">Read More</a></p>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        ?>
        <div class="blog-info">
            <p>No featured post found.</p>
        </div>
        <?php
    endif;
    ?>

    <?php
    // Function to estimate reading time
    function reading_time() {
        $content = get_post_field('post_content', get_the_ID());
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // assuming 200 words per minute reading speed

        return $reading_time;
    }
    ?>


    <div class="blog-article">  
        <!-- <div id="ajax-loader" style="display: none;">
            <div class="overlay"></div>
            <div class="loader"></div>
        </div> -->
        <div class="blog-grid_main custompaginationscroll" id="article_grid_main">
            <div class="blog-grid" id="article-grid">
            </div>
            <!-- Posts will be loaded here -->
        </div>
    </div>
    <div class="blog-article">
        <div class="pagination">
            
        </div>
    </div>
</div>
</section>

<?php 
include(locate_template('template-parts/parts/open-free-account-number-sec-black.php' ));
include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
get_footer(); ?>
