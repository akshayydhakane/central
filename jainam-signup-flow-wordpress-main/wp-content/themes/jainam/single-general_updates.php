<?php

get_header(); ?> 
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/glossaey.css" />
<main class="glossary-page  general-updates-details"> 
    <!-- Glossary Information Content-->
    <section class="comman_tabs-sec">
        <div class="container">
            <div class="path_name">
                <span><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> <small>/</small> </span>
                <span><a href="<?php echo get_site_url(); ?>/general-updates/">General updates</a> <small>/</small> </span>
                <?php
                    // Get the current post's taxonomy terms
                    $terms = get_the_terms(get_the_ID(), 'general_updates_category');
                    if ($terms && !is_wp_error($terms)) {
                        $term = array_shift($terms); // Get the first term
                        echo '<span><a class="" href="'.get_site_url().'/general-updates/?category='.esc_attr($term->slug ).'">' . esc_html($term->name) . '</a></span>';
                    }
                ?>
                <?php //echo get_custom_title(5); ?>
            </div>

            <div class='glossary_info'>
                <div class="glossary-left">
                    <div class="general_update-details-cart">
                        <h1><?php echo get_the_title(); ?></h1>
                        <div class="comman-details_date-social">
                            <ul class="comm_tabing">
                                <?php
                                    $content = get_post_field( 'post_content', get_the_ID() );
                                    $word_count = str_word_count( strip_tags( $content ) );
                                    $reading_time = ceil( $word_count / 200 );
                                ?>
                                <?php
                                    // Get the current post's taxonomy terms
                                    $terms = get_the_terms(get_the_ID(), 'general_updates_category');
                                    if ($terms && !is_wp_error($terms)) {
                                        $term = array_shift($terms); // Get the first term
                                        echo '<li><a href="'.get_site_url().'/general-updates/?category='.$term->slug.'" class="btn_tab ">' . esc_html($term->name) . '</a></li>';
                                    }
                                ?>
                                <li><a href="#" class="btn_tab "><?php echo get_the_date(); ?></a></li>
                                <li><a href="" class="btn_tab "><?php echo esc_html( $reading_time ); ?> min read</a></li>
                                
                            </ul>
                            <?php
                                $twiiter_link = get_field('twiiter_link');
                                $facebook_link = get_field('facebook_link');
                                $linkedin_link = get_field('linkedin_link'); 
                            ?>
                            <ul class="social_icon"> 
                                <li><a href="https://x.com/JAINAM_BROKING" target="_blank" class="btn_tab "><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/tw.svg" alt="twitter"></a></li>
                                <li><a href="https://www.facebook.com/jainambroking/" target="_blank" class="btn_tab "><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fb.svg" alt="facebook"></a></li>
                                <li><a href="https://in.linkedin.com/" target="_blank" class="btn_tab "><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/linkdin.svg" alt="linkedin"></a></li>
                            </ul>
                        </div>
                        <div class ="content_of_details-cart">
                            <div class="pic_of_blog"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="blog_of_pic"></div>
                            <div class="content_details">
                                <?php echo apply_filters('the_content', get_the_content()); ?>
                            </div>
                        </div>
                        <div class="faq_section">
                            <?php
                                include(locate_template('template-parts/parts/faq.php' )); 
                                include(locate_template('template-parts/parts/faq-desclaimer-ques.php' )); 
                            ?>  
                        </div>
                    </div>
                </div>
                <div class="glossary-right">
                    <?php 
                        include(locate_template('template-parts/parts/open-free-account-number-glossary.php' )); 
                    ?>
                    <div class="opne-free_account releted_categoris">
                        <h3>Related Categories Terms</h3>
                        <ul class="comm_tabing">
                        <?php
                            $terms = get_terms( array(
                                'taxonomy' => 'general_updates_category',
                                'hide_empty' => false,
                            ) );

                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :

                            foreach ( $terms as $term ) : ?>
                            <?php

                                $terms = get_the_terms(get_the_ID(), 'general_updates_category');
                                $term_name = $terms[0]->name;
                    
                            ?>
                                <li><a href="<?php echo get_site_url(); ?>/general-updates/?category=<?php echo esc_attr( $term->slug ); ?>" data-slug="<?php echo esc_attr( $term->slug ); ?>" class="btn_tab"><?php echo esc_html( $term->name ); ?></a></li>
                        
                            <?php endforeach; ?>
                        <?php endif; ?> 
                       </ul>
                    </div>
                   
                </div>
            </div>  
        </div>
    </section>
    <?php
        include(locate_template('template-parts/parts/blog-sec-general-updates.php' )); 
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?> 
    
</main>

<?php  
get_footer(); ?> 
