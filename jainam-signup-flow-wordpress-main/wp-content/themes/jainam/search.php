
<?php
/**
 * The Search template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dosth
 */
 get_header(); ?>

<section class="blog-section">
    <div class="container">
            
        <div class="blog-title">
            <div class="blog-title-inner">   
            <?php if ( get_search_query() ) : ?>
                        <?php /** <h3>Search Results for: <?php echo get_search_query(); ?></h3> 
                    <?php else : ?>
                        <h3>All Blog Posts</h3> */ ?>
                    <?php endif; ?>
                    <div class="path_name">
                        <span><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> <small>/</small> </span>
                        <span><a href="<?php echo get_site_url(); ?>/blog/">Back to Jainam Blog</a></span>
                    </div>
                    <div class="blog-search">
                   
                        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="input-group">
                                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search in blog', 'placeholder', 'textdomain' ); ?>" value="<?php echo $_GET['s'];//get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'textdomain' ); ?>" pattern=".*\S.*" oninvalid="this.setCustomValidity('Please enter a valid search query.')" oninput="this.setCustomValidity('')" required> 
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
        </div>
        
        <div class="blog-article">
            <div id="article-grid" class="blog-grid search_blog_result">
                <?php
                // WP_Query arguments
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => -1, // Display all posts
                    's'              => get_search_query(), // Search query
                );

                // The Query
                $query = new WP_Query( $args );

                // The Loop
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) :
                        $query->the_post();
                ?>
                        <div class="blog-card" style="">
                            <div class="blog-card-inner">
                                <div class="blog-card-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail(); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri() . '/assets/img/default-thumbnail.jpg'; ?>" alt="blog">
                                        <?php endif; ?>
                                        <div class="blog-card-info"><?php the_category( ', ' ); ?></div>
                                    </a>
                                </div>
                                <div class="blog-card-content">
                                    <a href="<?php the_permalink(); ?>">
                                        <h4><?php the_title(); ?></h4>
                                    </a>
                                    <div class="blog-card-date">
                                        <p><?php echo get_the_date(); ?></p>
                                        <p>11 min read</p> <!-- You might want to get actual reading time here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                else :
                    //echo '<p>No blogs found</p>';
                    echo '<div class="blogs"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';
                endif;
                // Restore original Post Data
                wp_reset_postdata();
                ?>
                <div class="pagination"> 
            
                </div> 
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
