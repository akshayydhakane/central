<?php if (have_rows('page_sections')) : ?>
    <?php while (have_rows('page_sections')) : the_row(); ?>
        <?php if (get_row_layout() == 'list_blogs_section') : ?>
            <section class="sec_blog">
                <div class="container">
                    <div class="blog_heading">
                        <h2 class="title"><?php the_sub_field('bs_add_blog_headding'); ?></h2>
                        <?php 
                        $view_more_link = get_sub_field('add_blog_page_link');
                        if ($view_more_link): ?>
                            <a class="btn_view_more" href="<?php echo ($view_more_link['url']); ?>"><?php echo ($view_more_link['title']); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="blog-article">
                        <div id="article-grid" class="blog-grid">
                    <?php 
                        $selected_posts = get_sub_field('bp_select_post_blogs');
                        if ($selected_posts): 
                            foreach ($selected_posts as $post): 
                                setup_postdata($post); ?>
                                <?php /** ?>
                                <div class="bog_cart">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="blog_pic"><?php the_post_thumbnail('full'); ?><div class="blog-card-info"><?php the_category( ', ' ); ?></div></div>
                                    <?php endif; ?>
                                    <h4><?php the_title(); ?></h4>
                                    <!-- <p class="blog_content"><?php   // $excerpt = wp_trim_words(get_the_excerpt(), 20, '...'); echo $excerpt; ?></p> -->
                                    <h5>              
                                        <p class="date"><?php echo get_the_date('M d, Y'); ?></p>
                                        <?php
                                        // Calculate reading time
                                        $content = get_post_field( 'post_content', get_the_ID() );
                                        $word_count = str_word_count( strip_tags( $content ) );
                                        $reading_time = ceil( $word_count / 200 ); // Assuming average reading speed is 200 words per minute
                                        echo '<p class="reading_time">' . esc_html( $reading_time ) . ' min read</p>'; ?>
                                    </h5>
                                </div> <?php */ ?>

                                <div class="blog-card" style="">
                                    <div class="blog-card-inner">
                                        <div class="blog-card-img">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <?php the_post_thumbnail(); ?>
                                                <?php else : ?>
                                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/default-thumbnail.jpg'; ?>" alt="blog">
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
                                            </a>
                                        </div>
                                        <div class="blog-card-content">
                                            <a href="<?php the_permalink(); ?>">
                                                <h4><?php the_title(); ?></h4>
                                            </a>
                                            <div class="blog-card-date">
                                                <p><?php echo get_the_date(); ?></p>
                                                <?php
                                                $content = get_post_field( 'post_content', get_the_ID() );
                                                $word_count = str_word_count( strip_tags( $content ) );
                                                $reading_time = ceil( $word_count / 200 );
                                                echo '<p class="reading_time">' . esc_html( $reading_time ) . ' min read</p>'; 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; 
                            wp_reset_postdata();
                        endif; ?>
                    </div>
                </div>
            </div>
        </section> 
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
