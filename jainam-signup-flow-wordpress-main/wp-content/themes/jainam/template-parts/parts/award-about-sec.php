<?php //if (have_rows('page_sections')) : ?>
    <?php //while (have_rows('page_sections')) : the_row(); ?>
        <?php //if (get_row_layout() == 'jainam_awards_media_representative') :?> 
        <section class="jainam-award">
            <div class="container">
                <h2 class="title"><?php echo get_field('award_heading'); ?></h2> 
                <div class="jainam-award-inner">
                    <div class="jainam-award-slider award_card_slider_2">
                    <?php if( have_rows('award_slider') ): ?>
                            <?php while( have_rows('award_slider') ): the_row(); ?>
                                <div>
                                    <?php if( have_rows('award_row') ): ?>
                                        <?php while( have_rows('award_row') ): the_row(); 
                                            $award_image = get_sub_field('award_image');
                                            $award_title = get_sub_field('award_title');
                                            $award_description = get_sub_field('award_content');
                                        ?>
                                            <div class="jainam-award-slide-inner">
                                                <?php if( $award_image ): ?>
                                                    <img src="<?php echo $award_image; ?>" alt="award image">
                                                <?php else: ?>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/jainam-award.webp" alt="award">
                                                <?php endif; ?>
                                                <?php if( $award_title ): ?>
                                                    <h6><?php echo esc_html($award_title); ?></h6>
                                                <?php endif; ?>
                                                <?php if( $award_description ): ?>
                                                    <span><?php echo esc_html($award_description); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No awards found</p>
                        <?php endif; ?>

                </div>
            </div>
        </section>
        <?php //endif; ?>
    <?php //endwhile; ?>
<?php //endif; ?>


<script>
    $(".award_card_slider_2").slick({
          rows: 2,
          slidesToShow: 4,
          slidesToScroll: 1,
          arrows: true,
          speed: 1000,
          autoplaySpeed: 4000,
          autoplay: true,
          prevArrow: '<button class="slide-arrow prev-arrow"></button>',
          nextArrow: '<button class="slide-arrow next-arrow"></button>',
          responsive: [
            {
              breakpoint: 1240,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
              },
            },
            {
              breakpoint: 1080,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              },
            },
            {
              breakpoint: 769,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              },
            },
            {
            breakpoint: 576,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          ],
        });
</script>