<?php if (have_rows('page_sections')) : ?>
    <?php while (have_rows('page_sections')) : the_row(); ?>
        <?php if (get_row_layout() == 'jainam_awards_media_representative') :?>
            <section class="jainam_slider_view jainam_awards">
            <div class="container">
                <h2 class="title"><?php the_sub_field('award_section_heading'); ?></h2>
                <div class="slider_view">
                    <div class="award_card_slider slider">

                    <?php if (have_rows('jainams_awards_lists')) : ?>
                        <?php while (have_rows('jainams_awards_lists')) : the_row(); ?>
                            <div class="slick-slideshow__slide award_cart">
                                <div class="award_icon"><?php
                                $award_image = get_sub_field('aw_add_awards_list'); ?>
                                    <?php if ($award_image) : ?>
                                        <img src="<?php echo esc_url($award_image['url']); ?>" alt="<?php echo esc_attr($award_image['alt']); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="award_content">
                                    <h3><?php the_sub_field('nse_market_achivers_heading'); ?></h3>
                                    <h5><?php the_sub_field('pg_jainams_awards_info'); ?></h5>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>