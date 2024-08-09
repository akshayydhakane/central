<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Artoon_Solutions
 */

get_header(); ?>
<section class="blog-section blog-detail-section">
        <div class="container">
            <div class="blog-title">
                <div class="blog-title-inner">  
                    <?php echo do_shortcode('[custom_breadcrumb]'); ?>
                </div>
            </div>
            <div class="blog-detail-sec-inner">
               <div class="blog-detail-sec-left">                
                  <?php include_once(get_template_directory()."/sidebar.php");?>
               </div>  
                  <div class="blog-detail-sec-right">
                  <?php
                // Start the Loop.
                  if ( have_posts() ) :
                     while ( have_posts() ) :
                           the_post(); ?>
                        <div class="blog-info blog-detail-sec-info">
                              <div class="blog-info-inner blog-detail-sec-info-inner">
                                 <div class="blog-info-left">
                                 <?php if ( has_post_thumbnail() ) : ?>
                                       <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) ); ?>
                                 <?php endif; ?>
                                 <?php the_content(); ?>  
                                 </div>
                                 <div class="blog-info-right">
                                    <h1><?php the_title(); ?></h1>
                                    <div class="blog-write-info"><?php 
                                        $author_id = get_the_author_meta('ID');
                                        $author_avatar = get_avatar_url($author_id, array('size' => 64)); ?>
                                        <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php the_author(); ?>">
                                        <p>Written by <?php the_author(); ?></p>
                                    </div>
                                    <div class="blog-date-info">
                                          <div><?php
                                                    // Get the categories for the current post
                                                    $categories = get_the_category();

                                                    if ( ! empty( $categories ) ) {
                                                        echo '<div class="post-categories">';

                                                        foreach ( $categories as $category ) {
                                                            $category_link = get_category_link( $category->term_id );

                                                            echo '<div><a href="javascript:void(0)" rel="category tag">' . esc_html( $category->name ) . '</a></div>';
                                                        }

                                                        echo '</div>';
                                                    } 
                                                    ?>
                                                    </div>
                                             <p><?php the_date(); ?></p><?php
                                          // Calculate reading time
                                          $content = get_post_field( 'post_content', get_the_ID() );
                                          $word_count = str_word_count( strip_tags( $content ) );
                                          $reading_time = ceil( $word_count / 200 ); // Assuming average reading speed is 200 words per minute
                                          echo '<p>' . esc_html( $reading_time ) . ' min read</p>'; ?>
                                    </div>
                                    <p> <?php $ip_address = $_SERVER['REMOTE_ADDR'];
                                    $read_count = get_post_meta(get_the_ID(), 'read_count_' . $ip_address, true);
                                    echo $read_count; ?> users read this article</p>
                                 </div>
                              </div>
                        </div>
                        <div class="faq_single">
                            <?php include(locate_template('template-parts/parts/faq.php' )); ?>
                        </div>
                        <?php //the_content(); ?> 
                        <?php $blog_disclaimer = wp_kses_post ( get_field('blog_disclaimer') ); 

                            if($blog_disclaimer){ ?>
                                <div class="blog-detail-sec-right-according">
                                    <div class="set">
                                        <a href="javascript:void(0)" class="active">
                                            Disclaimer
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12" fill="none">
                                                <path d="M19.2361 9.46273L19.2361 9.46273C19.5879 9.81455 19.5878 10.3848 19.2362 10.7364L19.2361 10.7364C18.8846 11.0879 18.3144 11.0881 17.9625 10.7364C17.9625 10.7364 17.9625 10.7364 17.9625 10.7363L10.3536 3.127L10 2.77342L9.64644 3.12699L2.03748 10.7361C2.03745 10.7361 2.03743 10.7361 2.0374 10.7362C1.68555 11.0878 1.11547 11.0876 0.764032 10.7362L0.763861 10.736C0.412064 10.3845 0.411961 9.81435 0.763933 9.46255L0.764023 9.46246L9.36329 0.862968C9.36334 0.862919 9.36339 0.86287 9.36344 0.862821C9.53923 0.687248 9.76876 0.599532 9.99999 0.599532C10.2312 0.599532 10.4607 0.687413 10.6366 0.86309C10.6366 0.863119 10.6366 0.863148 10.6366 0.863177L19.2361 9.46273Z" fill="#8C94A6" stroke="#8C94A6"></path>
                                            </svg> 
                                        </a>
                                        <div class="content" style="display: block;">
                                          <p><?php echo $blog_disclaimer; ?></p>
                                        </div>
                                      </div>
                                </div>

                            <?php } ?>

                    <div class="share-blog-detail">
                        <div class="share-blog-detail-left">
                            <h4>Do you like reading this article?</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                <rect x="0.5" y="0.5" width="43" height="43" rx="7.5" fill="#F1F2F4"></rect>
                                <rect x="0.5" y="0.5" width="43" height="43" rx="7.5" stroke="#C5CAD3"></rect>
                                <path d="M11.4531 33.2969C11.4531 33.6852 11.7679 34 12.1562 34H16.375C17.051 34 17.6534 33.6799 18.0398 33.1837C19.7537 33.7252 21.5327 34 23.3323 34H29.0312C30.1943 34 31.1406 33.0537 31.1406 31.8906C31.1406 31.6161 31.0873 31.3539 30.9916 31.1132C31.8866 30.8693 32.5469 30.0495 32.5469 29.0781C32.5469 28.5383 32.3427 28.0454 32.008 27.6719C32.3429 27.2983 32.5469 26.8054 32.5469 26.2656C32.5469 25.7258 32.3427 25.2329 32.008 24.8594C32.3429 24.4858 32.5469 23.9929 32.5469 23.4531C32.5469 22.29 31.6006 21.3438 30.4375 21.3438H26.5888C26.6434 21.2145 26.6998 21.0834 26.7573 20.9501C27.1839 19.9608 27.625 18.9377 27.625 17.8281C27.625 15.8846 26.053 14.2656 24.1094 14.2656C23.7743 14.2656 23.4857 14.5022 23.42 14.8309L23.0609 16.6262C22.5892 18.9843 22.0683 19.2512 20.1301 20.2444C19.6178 20.5068 19.0159 20.8153 18.3135 21.2158C17.9902 20.4648 17.2431 19.9375 16.375 19.9375H12.1562C11.7679 19.9375 11.4531 20.2523 11.4531 20.6406V33.2969ZM20.7712 21.4959C21.8207 20.9581 22.5788 20.5698 23.1724 19.9122C23.7794 19.2397 24.1467 18.3676 24.4399 16.902L24.6697 15.7524C25.5515 16.0106 26.2188 16.8568 26.2188 17.8281C26.2188 18.6473 25.8361 19.5349 25.4658 20.3932C25.3316 20.7047 25.1946 21.0231 25.0727 21.3438H24.1094C23.721 21.3438 23.4062 21.6585 23.4062 22.0469C23.4062 22.4352 23.721 22.75 24.1094 22.75H30.4375C30.8251 22.75 31.1406 23.0655 31.1406 23.4531C31.1406 23.8408 30.8251 24.1562 30.4375 24.1562H29.0312C28.6429 24.1562 28.3281 24.471 28.3281 24.8594C28.3281 25.2477 28.6429 25.5625 29.0312 25.5625H30.4375C30.8251 25.5625 31.1406 25.878 31.1406 26.2656C31.1406 26.6533 30.8251 26.9688 30.4375 26.9688H29.0312C28.6429 26.9688 28.3281 27.2835 28.3281 27.6719C28.3281 28.0602 28.6429 28.375 29.0312 28.375H30.4375C30.8251 28.375 31.1406 28.6905 31.1406 29.0781C31.1406 29.4658 30.8251 29.7812 30.4375 29.7812H29.0312C28.6429 29.7812 28.3281 30.096 28.3281 30.4844C28.3281 30.8727 28.6429 31.1875 29.0312 31.1875C29.4189 31.1875 29.7344 31.503 29.7344 31.8906C29.7344 32.2783 29.4189 32.5938 29.0312 32.5938H23.3323C21.6841 32.5938 20.0547 32.3433 18.4844 31.8496V22.744C19.3909 22.2034 20.1492 21.8147 20.7712 21.4959ZM12.8594 21.3438H16.375C16.7626 21.3438 17.0781 21.6592 17.0781 22.0469V31.8906C17.0781 32.2783 16.7626 32.5938 16.375 32.5938H12.8594V21.3438Z" fill="black"></path>
                                <path d="M15.6719 30.4844C15.6719 30.8727 15.3571 31.1875 14.9688 31.1875C14.5804 31.1875 14.2656 30.8727 14.2656 30.4844C14.2656 30.096 14.5804 29.7812 14.9688 29.7812C15.3571 29.7812 15.6719 30.096 15.6719 30.4844Z" fill="black"></path>
                                <path d="M24.1094 10.7031V12.1562C24.1094 12.5446 24.4241 12.8594 24.8125 12.8594C25.2009 12.8594 25.5156 12.5446 25.5156 12.1562V10.7031C25.5156 10.3148 25.2009 10 24.8125 10C24.4241 10 24.1094 10.3148 24.1094 10.7031Z" fill="black"></path>
                                <path d="M28.5341 11.8649L27.5397 12.8594C27.265 13.134 27.265 13.5791 27.5397 13.8538C27.8143 14.1283 28.2595 14.1283 28.5341 13.8538L29.5284 12.8594C29.803 12.5847 29.803 12.1396 29.5284 11.8649C29.2537 11.5904 28.8086 11.5904 28.5341 11.8649Z" fill="black"></path>
                                <path d="M20.0966 11.8649C19.822 12.1396 19.822 12.5847 20.0966 12.8594L21.0909 13.8538C21.3655 14.1283 21.8107 14.1283 22.0853 13.8538C22.3598 13.5791 22.3598 13.134 22.0853 12.8594L21.0909 11.8649C20.8164 11.5904 20.3711 11.5904 20.0966 11.8649Z" fill="black"></path>
                            </svg>
                        </div>
                        <div class="share-blog-detail-right">
                            <h4>Share this Blog</h4>
                            <ul>
                            <li class="blog-social-icon">
                              <a href="https://t.me/share/url?url=<?php echo urlencode( get_permalink() ); ?>" target="_blank">
                                 <img src="<?php echo site_url(); ?>/wp-content/themes/jainam/assets/img/tel.svg" alt="telegram">
                              </a></li>
                              <li class="blog-social-icon">
                              <a href="https://www.instagram.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" target="_blank">
                                 <img src="<?php echo site_url(); ?>/wp-content/themes/jainam/assets/img/insta.svg" alt="instagram">
                              </a></li>
                              <li class="blog-social-icon">
                              <a href="https://twitter.com/share?url=<?php echo urlencode( get_permalink() ); ?>" target="_blank">
                                 <img src="<?php echo site_url(); ?>/wp-content/themes/jainam/assets/img/tw.svg" alt="twiter">
                              </a></li> <li class="blog-social-icon">
                              <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" target="_blank">
                                 <img src="<?php echo site_url(); ?>/wp-content/themes/jainam/assets/img/fb.svg" alt="facebook">
                              </a> </li><li class="blog-social-icon">
                              <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode( get_permalink() ); ?>" target="_blank">
                                 <img src="<?php echo site_url(); ?>/wp-content/themes/jainam/assets/img/linkdin.svg" alt="linkedin">
                              </a>
                           </li>
                            </ul>
                        </div>
                    </div>        
                        <?php
                     endwhile;
                  endif;
                ?>
                </div>
            </div>
             
  
   </div>
</section>

<?php
$current_post_id = get_the_ID();
// Get the categories or tags of the current post
$categories = get_the_category($current_post_id);
// Array to store category and tag IDs
$related_ids = array();
// If categories are available, add their IDs to $related_ids
if ($categories) {
    foreach ($categories as $category) {
        $related_ids[] = $category->term_id;
    }
} ?>
<section class="blog-article blog-article-detail-page">
    <div class="container">
        <h3>You May Also Like</h3>
        <div class="blog-grid">
            <?php
            // Get the categories of the current post
            $categories = get_the_category($current_post_id);

            // Array to store category IDs
            $related_category_ids = array();

            // If categories are available, add their IDs to $related_category_ids
            if ($categories) {
               foreach ($categories as $category) {
                  $related_category_ids[] = $category->term_id;
               }
            }

            // Query related posts
            $args = array(
               'post_type' => 'post', // Change post_type if needed
               'posts_per_page' => 3, // Number of related posts to display
               'post__not_in' => array($current_post_id), // Exclude current post
               'category__in' => $related_category_ids, // Show posts from related categories
            );

            $related_posts_query = new WP_Query($args);
                        

            // Loop through related posts
            if ($related_posts_query->have_posts()) :
                while ($related_posts_query->have_posts()) :
                    $related_posts_query->the_post(); ?>
                    <div class="blog-card" style="">
                        <div class="blog-card-inner">
                            <div class="blog-card-img">
                                
                                <?php if ( has_post_thumbnail() ) : ?>												<a href="<?php the_permalink(); ?>">			
										<img src="<?php the_post_thumbnail_url(); ?>" alt="blog">
                                    </a>
								<?php endif; ?>
                                <?php
                                    $category = get_the_category();
                                    $terms = get_the_terms(get_the_ID(), 'category');
                                    if ( ! empty( $category ) ) {
                                        $category_name = $category[0]->name;
                                        $category_link = get_category_link($category[0]->term_id);
                                        
                                        echo '<div class="blog-card-info"><a href="javascript:void(0)">' . esc_html( $category_name ) . '</a></div>';
                                    }
                                ?>  
                                
                            </div>
                            <div class="blog-card-content">
                                <a href="<?php the_permalink(); ?>">
                                    <h4><?php the_title(); ?></h4>
                                </a>
                                <div class="blog-card-date">
                                    <p><?php the_time('M d, Y'); ?></p>
                                    <?php
                                          // Calculate reading time
                                          $content = get_post_field( 'post_content', get_the_ID() );
                                          $word_count = str_word_count( strip_tags( $content ) );
                                          $reading_time = ceil( $word_count / 200 ); // Assuming average reading speed is 200 words per minute
                                          echo '<p>' . esc_html( $reading_time ) . ' min read</p>'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // No related posts found
                echo '<p>No related posts found.</p>';
            endif;
            ?>
        </div>
    </div>
</section>
<?php
    include(locate_template('template-parts/parts/open-free-accout-black-sec.php' ));
    include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
?>
<?php get_footer(); ?>
