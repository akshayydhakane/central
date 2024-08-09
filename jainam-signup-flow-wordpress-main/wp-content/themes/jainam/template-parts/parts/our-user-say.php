<?php if (have_rows('page_sections')) : ?>
    <?php while (have_rows('page_sections')) : the_row(); ?>
        <?php if (get_row_layout() == 'what_our_users_have_to_say') : ?>
            <section class="jainam_slider_view user_info_slider">
                <div class="container">
                    <h2 class="title"><?php the_sub_field('what_our_users_have_to_say_heading'); ?></h2>
                    <div class="slider_view">
                        <div class="offer_card_slider slider">
                            <?php if (have_rows('user_info')) : ?>
                                <?php while (have_rows('user_info')) : the_row(); ?>
                                    <div class="slick-slideshow__slide user_cart">
                                        <div class="user_title">
                                            <div class="user_pic">
                                                <?php $image = get_sub_field('user_image'); ?>
                                                <?php if ($image) : ?>
                                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="user_name">
                                                <h5><?php the_sub_field('user_name'); ?></h5>
                                                <h6><?php the_sub_field('user_position'); ?></h6>
                                            </div>
                                        </div>
                                        <p class="user_info add-read-more show-less-content"><?php the_sub_field('user_content'); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
