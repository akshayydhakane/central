<?php

get_header(); ?>  

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/glossaey.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css.map" /> 

<main class="glossary-page">
        <section class="comman_banner-section">
            <div class="container">
                <div class='banner_content'>
                    <h1 class="banner_title"><?php echo get_the_title(); ?></h1>
                </div>
            </div>
        </section>


   <!-- comman Abc tabing -->
   <section class="comman_name_bar">
            <div class="container">
                <div class="path_name">
                    <span><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> <small>/</small></span>
                    <span><a href="<?php echo get_site_url(); ?>/jainam-glossary/">Glossary</a> <small>/</small> </span>
                    <?php
                    // Get the current post's taxonomy terms
                    $terms = get_the_terms(get_the_ID(), 'glossary_category');
                    if ($terms && !is_wp_error($terms)) {
                        $term = array_shift($terms); // Get the first term
                        echo '<span><a class="" href="'.get_site_url().'/jainam-glossary/?category='.esc_attr($term->slug ).'">' . esc_html($term->name) . '</a> <small>/</small> </span>';
                    }
                    ?>
                    <span><?php the_title(); ?></span>
                </div>
                <div class="name_of_title">
                    <ul>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/" class="alphabet_slink">#</a></li>

                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#A" class='alphabet_slink'>a</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#B" class="alphabet_slink">b</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#C" class="alphabet_slink">c</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#D" class="alphabet_slink">d</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#E" class="alphabet_slink">e</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#F" class="alphabet_slink">f</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#G" class="alphabet_slink">g</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#H" class="alphabet_slink">h</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#I" class="alphabet_slink">i</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#J" class="alphabet_slink">j</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#K" class="alphabet_slink">k</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#L" class="alphabet_slink">l</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#M" class="alphabet_slink">m</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#N" class="alphabet_slink">n</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#O" class="alphabet_slink">o</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#P" class="alphabet_slink">p</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#Q" class="alphabet_slink">q</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#R" class="alphabet_slink">r</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#S" class="alphabet_slink">s</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#T" class="alphabet_slink">t</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#U" class="alphabet_slink">u</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#V" class="alphabet_slink">v</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#W" class="alphabet_slink">w</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#X" class="alphabet_slink">x</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#Y" class="alphabet_slink">y</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/jainam-glossary/#Z" class="alphabet_slink">z</a></li>
                    </ul>
                </div>
            </div>
        </section>



    <!-- Glossary Information Content-->
    <section class="comman_tabs-sec">
        <div class="container">
            <?php
                // Display custom taxonomy terms
                $terms = get_terms( array(
                    'taxonomy' => 'glossary_category',
                    'hide_empty' => false,
                ) );

                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                    <div class="blog-list-top">
                        <div class="blog-list-top-inner">
                            <?php 
                                $count = 0;
                                foreach ( $terms as $term ) : ?>
                                <?php
                                    $class = ($count >= 6) ? 'category-filter hidden-category' : 'category-filter';

                                    $terms = get_the_terms(get_the_ID(), 'glossary_category');
                                    $term_name = $terms[0]->name;
                                    $active_class = ($term_name == $term->name) ? ' active' : '';
                                ?>
                                    <a href="<?php echo get_site_url(); ?>/jainam-glossary/?category=<?php echo esc_attr($term->slug ); ?>" data-slug="<?php echo esc_attr( $term->slug ); ?>" class="btn_tab <?php echo $active_class; ?> <?php echo $class; ?>"><?php echo esc_html( $term->name ); ?></a>
                                <?php  $count++; ?>

                                <?php endforeach; ?>
                                <a href="javascript:void(0)" class="more_btn see-more-opc">See more</a>
                            
                            <?php endif; ?>  
                        </div>
                    </div>
                    <?php /** ?>
                    <ul class="comm_tabing">
                        <?php 
                        $count = 0;
                        foreach ( $terms as $term ) : ?>
                        <?php
                            $class = ($count >= 6) ? 'category-filter hidden-category' : 'category-filter';

                            $terms = get_the_terms(get_the_ID(), 'glossary_category');
                            $term_name = $terms[0]->name;
                            $active_class = ($term_name == $term->name) ? ' active' : '';
                        ?>
                            <li><a href="#" data-slug="<?php echo esc_attr( $term->slug ); ?>" class="btn_tab <?php echo $active_class; ?> <?php echo $class; ?>"><?php echo esc_html( $term->name ); ?></a></li>
                        <?php  $count++; ?>

                        <?php endforeach; ?>
                        <li><a href="#" class="btn_tab more_btn see-more-opc">See more</a></li>
                    </ul>
                    <?php endif; */?>  

            <div class='glossary_info'>
                <div class="glossary-left">
                    <div class="glo-content">
                        <?php the_content(); ?>
                        <div class="faq_section"> 
                            <?php
                                include(locate_template('template-parts/parts/faq.php' )); 
                            ?>  
                        </div>
                    </div>
                </div>
                <div class="glossary-right">
                    <?php 
                    include(locate_template('template-parts/parts/open-free-account-number-glossary.php' )); ?>
                    <div class="opne-free_account releted_categoris">
                        <h3>Related Terms</h3>

                        <?php
                            $terms = get_the_terms(get_the_ID(), 'glossary_category');

                                if ($terms && !is_wp_error($terms)) {
                                    $term_ids = array();

                                    foreach ($terms as $term) {
                                        $term_ids[] = $term->term_id;
                                    }

                                    $args = array(
                                        'post_type' => 'glossary', 
                                        'orderby'        => 'title',
                                        'order'          => 'ASC',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'glossary_category',
                                                'field'    => 'term_id',
                                                'terms'    => $term_ids,
                                            ),
                                        ),
                                        'post__not_in' => array(get_the_ID()), // Exclude the current post
                                        'posts_per_page' => -1, // Number of related posts to display
                                    );

                                    $related_posts_query = new WP_Query($args);

                                    if ($related_posts_query->have_posts()) : ?>
                                    
                                            <ul class="comm_tabing">
                                                <?php while ($related_posts_query->have_posts()) : $related_posts_query->the_post(); ?>
                                                    <li><a href="<?php the_permalink(); ?>" class="btn_tab"><?php the_title(); ?></a></li>
                                                <?php endwhile; ?>
                                            </ul>

                                        <?php 
                                    endif;

                                    wp_reset_postdata();
                                }else{ ?>
                                    <ul class="comm_tabing">
                                        Categories are not found
                                    </ul>
                                <?php
                                } 
                            ?>
                    </div>
                </div>
            </div>  
        </div>
    </section>  
    <?php
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?>   
    </main>  

<?php  
get_footer(); ?> 
