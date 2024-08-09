<?php if (have_rows('page_sections')) : ?>
    <section class="jainam_slider_view investment_slider_view">
        <div class="container">
            <?php while (have_rows('page_sections')) : the_row(); ?>
                <?php if (get_row_layout() == 'investments_options_with_jainam') : ?>
                    <h2 class="title"><?php the_sub_field('add_ints_opt_main_head'); ?></h2>
                    <div class="slider_view">
                        <div class="offer_card_slider slider">
                       
                            <?php if (have_rows('repeter_investments_options')) : ?>
                                <?php while (have_rows('repeter_investments_options')) : the_row(); ?>
                                <div class="slick-slideshow__slide user_cart">
                                        <div class="user_title">
                                            <div class="user_pic">
                                                <?php $image = get_sub_field('add_ints_options_image'); ?>
                                                <?php if ($image) : ?>
                                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <h3 class="inter_semibold"><?php the_sub_field('add_ints_heading_for_options'); ?></h3>
                                        <p class="user_info"><?php the_sub_field('add_ints_options_infos'); ?></p>
                                        <?php $link = get_sub_field('add_ints_link'); ?>
                                        <?php if ($link) : ?>
                                            <h5 class="read_more_btn">
                                                <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>">
                                                    <span><?php echo esc_html($link['title']); ?></span>
                                                    <span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/read_more_arrow.webp" alt="read_more_arrow"></span>
                                                </a>
                                            </h5>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                               
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>
