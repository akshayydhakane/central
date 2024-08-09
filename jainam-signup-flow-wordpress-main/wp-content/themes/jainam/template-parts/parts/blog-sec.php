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
                    <div class="blog_details">
                    <?php 
                        $selected_posts = get_sub_field('bp_select_post_blogs');
                        if ($selected_posts): 
                            foreach ($selected_posts as $post): 
                                setup_postdata($post); ?>
                                <div class="bog_cart">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="blog_pic"><?php the_post_thumbnail('full'); ?></div>
                                    <?php endif; ?>
                                    <h4><?php the_title(); ?></h4>
                                    <p class="blog_content"><?php   $excerpt = wp_trim_words(get_the_excerpt(), 20, '...'); echo $excerpt; ?></p>
                                    <h5><a href="<?php the_permalink(); ?>" class="read-more">

                                        <span>Read more</span>
                                        <span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/read_more_arrow.webp" alt="read_more_arrow"></span></a>
                                    </h5>
                                </div>
                            <?php endforeach; 
                            wp_reset_postdata();
                        endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
