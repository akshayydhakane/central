<?php

/**
 * Template Name: Glossary 
 */
get_header(); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/glossaey.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css.map" />

<main class="glossary-page glossary">
        <section class="comman_banner-section">
            <div class="container">
                <div class='banner_content'>
                    <h1 class="banner_title">Glossary</h1>
                </div>
            </div>
        </section>


        <!-- comman Abc tabing -->
        <section class="comman_name_bar">
            <div class="container">
                <div class="path_name">
                    <span><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> /</span>
                    <?php
                    // Get the current post type object
                    $post_type = get_post_type_object('glossary');
                    if ($post_type) {
                        $archive_link = get_post_type_archive_link('glossary');
                        $post_type_name = $post_type->labels->name;
                        ?>
                        <span>Glossary</span>
                    <?php } ?>
                </div>
                <div class="name_of_title">
                    <ul>
                        <li><a href="javascript:void(0)" class="alphabet_link">#</a></li>
                        <li><a href="#A" class='alphabet_link'>a</a></li>
                        <li><a href="#B" class="alphabet_link">b</a></li>
                        <li><a href="#C" class="alphabet_link">c</a></li>
                        <li><a href="#D" class="alphabet_link">d</a></li>
                        <li><a href="#E" class="alphabet_link">e</a></li>
                        <li><a href="#F" class="alphabet_link">f</a></li>
                        <li><a href="#G" class="alphabet_link">g</a></li>
                        <li><a href="#H" class="alphabet_link">h</a></li>
                        <li><a href="#I" class="alphabet_link">i</a></li>
                        <li><a href="#J" class="alphabet_link">j</a></li>
                        <li><a href="#K" class="alphabet_link">k</a></li>
                        <li><a href="#L" class="alphabet_link">l</a></li>
                        <li><a href="#M" class="alphabet_link">m</a></li>
                        <li><a href="#N" class="alphabet_link">n</a></li>
                        <li><a href="#O" class="alphabet_link">o</a></li>
                        <li><a href="#P" class="alphabet_link">p</a></li>
                        <li><a href="#Q" class="alphabet_link">q</a></li>
                        <li><a href="#R" class="alphabet_link">r</a></li>
                        <li><a href="#S" class="alphabet_link">s</a></li>
                        <li><a href="#T" class="alphabet_link">t</a></li>
                        <li><a href="#U" class="alphabet_link">u</a></li>
                        <li><a href="#V" class="alphabet_link">v</a></li>
                        <li><a href="#W" class="alphabet_link">w</a></li>
                        <li><a href="#X" class="alphabet_link">x</a></li>
                        <li><a href="#Y" class="alphabet_link">y</a></li>
                        <li><a href="#Z" class="alphabet_link">z</a></li>
                    </ul>
                </div>
            </div>
        </section>



        <section class="comman_tabs-sec">
            <div class="container">
                <?php
                // Display custom taxonomy terms
                $terms = get_terms( array(
                    'taxonomy' => 'glossary_category',
                    'hide_empty' => false,
                ) );
                ?>
                <div class="blog-list-top">
                    <div class="tab_div">
                        <div class="blog-list-top-inner blog_categories_filterfromurl">
                            <?php
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                                
                                    <?php 
                                    $count = 0;
                                    echo '<a href="javascript:void(0)" class="category-filter btn_tab more_btn active">All</a>';
                                    foreach ( $terms as $term ) : ?>
                                        <?php
                                         $class = ($count >= 6) ? 'category-filter hidden-category' : 'category-filter';
                                        ?>
                                        <a href="javascript:void(0)" data-category="<?php echo esc_attr($term->slug);?>" data-slug="<?php echo esc_attr( $term->slug ); ?>" class="btn_tab <?php echo $class; ?>"><?php echo esc_html( $term->name ); ?></a>
                                        <?php  $count++; ?> 
                                    <?php endforeach; ?>
                                    <a href="javascript:void(0)" id="see-more-opc" class="see-more-opc">See more</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
                    /**
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                    <ul class="comm_tabing">
                        <?php 
                        $count = 0;
                        foreach ( $terms as $term ) : ?>
                            <?php
                             $class = ($count >= 6) ? 'category-filter hidden-category' : 'category-filter';
                            ?>
                            <li><a href="#" data-slug="<?php echo esc_attr( $term->slug ); ?>" class="btn_tab <?php echo $class; ?>"><?php echo esc_html( $term->name ); ?></a></li>
                            <?php  $count++; ?>
                        <?php endforeach; ?>
                        <li><a href="#" class="btn_tab more_btn see-more-opc">See more</a></li>
                    </ul>
                <?php endif; */ ?>
            
                <div class="glossary_container" id="all">

                    <?php
                        $args = array(
                            'post_type'      => 'glossary',
                            'posts_per_page' => -1,
                            'orderby'        => 'title',
                            'order'          => 'ASC'
                        );
                        $glossary_query = new WP_Query( $args );

                        if ( $glossary_query->have_posts() ) :
                            $current_letter = '';
                            while ( $glossary_query->have_posts() ) : $glossary_query->the_post();
                                $first_letter = strtoupper(substr(get_the_title(), 0, 1)); 
                                if ($first_letter !== $current_letter) {
                                    if ($current_letter !== '') {
                                        echo '</ul></div>';
                                    }
                                    $current_letter = $first_letter;
                                    echo '<div id="'.esc_attr($first_letter) . '" class="glossary_list"><ul>';
                                }
                                ?>
                                <li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php endwhile;
                            echo '</ul></div>'; 
                            wp_reset_postdata();
                        else : 
                            echo '<div class="glossary"><div class="no_result_founds"><img src="'.get_site_url().'/wp-content/uploads/2024/07/not_found.svg"/></div></div>';
                            
                        endif; ?>
                </div>
            </div>
        </section>
    <?php
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?>  
    </main>  

<?php  
get_footer(); ?>
