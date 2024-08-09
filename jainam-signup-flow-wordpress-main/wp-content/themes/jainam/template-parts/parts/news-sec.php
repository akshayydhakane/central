<?php if (have_rows('page_sections')) : ?>
    <?php while (have_rows('page_sections')) : the_row(); ?>
        <?php if (get_row_layout() == 'the_news_sec') :?>
            <section class="jainam_slider_view jainam_awards we_are_news">
               <div class="container">
                  <h2 class="title"><?php the_sub_field('add_the_news_heading'); ?></h2>
                  <div class="slider_view">
                        <div class="award_card_slider slider">
                        <?php if (have_rows('add_media_and_news')) : ?>
                           <?php while (have_rows('add_media_and_news')) : the_row(); ?>
                              <div class="slick-slideshow__slide award_cart">
                                    <div class="news_icon"><?php
                                       $add_media_ns_sec = get_sub_field('add_media_ns_sec'); ?>
                                    <?php if ($add_media_ns_sec) : ?>
                                        <img src="<?php echo esc_url($add_media_ns_sec['url']); ?>" alt="<?php echo esc_attr($add_media_ns_sec['alt']); ?>" style="width: auto; height: auto;">
                                    <?php endif; ?></div>
                                    <div class="award_content news_content">
                                    <h4><?php the_sub_field('add_media_title_ns'); ?></h4>
                                    </div>
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