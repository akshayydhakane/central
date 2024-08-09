<?php

/**
 * Template Name: Jainam Lite
 */
get_header(); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/jainam-lite.css" />
<?php
global $post;

// Get the content with the_content filters applied
$content = apply_filters('the_content', get_the_content());

// Remove <p> tags
$content = strip_tags($content, '<a><b><i><strong><em><ul><ol><li>');

$get_started = get_field('get_started');

?>

    <main class="jainam-lite-page">
        <section class="jainam-lite-banner-sec">
            <div class="container">
                <div class="jainam-lite-banner-inner">
                    <h1><?php echo get_the_title(); ?></h1>
                    <p><?php echo $content; ?></p>
                    <a href="<?php echo $get_started['url']; ?>" target="<?php echo $get_started['target']; ?>" class="btn"><?php echo $get_started['title']; ?></a>
                </div>
            </div>
        </section>

        <section class="commitment-sec">
            <div class="container">
                <div class="commitment-inner">
                    <div class="commitment-inner-left">
                        <?php
                            $our_commitment_label = get_field('our_commitment_label');
                            $our_commitment_description = get_field('our_commitment_description');
                            $first_image = get_field('first_image');
                            $second_image = get_field('second_image');
                            $third_image = get_field('third_image');
                        ?>
                        <?php if($our_commitment_label){
                            echo '<h2>'.$our_commitment_label.'</h2>';
                        }else{
                            echo '<h2>Our commitment to trust, innovation and Services</h2>';
                        }
                        ?>

                        <?php if($our_commitment_description){
                            echo '<p>'.$our_commitment_description.'</p>';
                        }else{
                            echo '<p>We aim to set new benchmarks in service excellence, innovation, and ethical practices to establish ourselves as the most trusted and preferred financial partner for our clients and stakeholders. Our focus is on building long-term relationships founded on trust and transparency, empowering our clients with cutting-edge solutions and exceptional services.</p>';
                        }
                        ?>
                    </div>
                    <div class="commitment-inner-right">
                        <div class="commitment-right-img">
                            <img src="<?php echo $first_image['url']; ?>" alt="<?php echo $first_image['alt']; ?>" />
                            <div>
                                <img src="<?php echo $second_image['url']; ?>" alt="<?php echo $second_image['alt']; ?>">
                                <img src="<?php echo $third_image['url']; ?>" alt="<?php echo $third_image['alt']; ?>">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <?php
            $features_of_jainam_lite_label = get_field('features_of_jainam_lite_label');
        ?>

        <section class="features-sec">
            <div class="container">
                <?php if($features_of_jainam_lite_label){
                    echo '<h2>'.$features_of_jainam_lite_label.'</h2>';
                }else{
                    echo '<h2>Features of Jainam Lite</h2>';
                }
                ?>
                
                <div class="features-inner">
                    <?php

                        // Check rows exists.
                        if( have_rows('features_of_jainam') ):

                            // Loop through rows.
                            while( have_rows('features_of_jainam') ) : the_row();

                                // Load sub field value.
                                $icon = get_sub_field('icon');
                                $features_name = get_sub_field('features_name');
                                $features_description = get_sub_field('features_description');

                               ?>
                               <div class="features-inner-box">
                                    <img src="<?php echo $icon; ?>" alt="commitment">
                                    <h3><?php echo $features_name; ?></h3>
                                    <p><?php echo $features_description; ?></p>
                                </div>
                               <?php

                            // End loop.
                            endwhile;

                        // No value.
                        else :
                            // Do something...
                        endif;

                    ?>
                </div>
            </div>
        </section>

        <?php
            $download_jainam_title = get_field('download_jainam_title');
            $download_button = get_field('download_button');
        ?>

        <section class="download-section">
            <div class="container">
                <div class="download-inner">
                    <?php if($download_jainam_title){
                        echo '<h2>'.$download_jainam_title.'</h2>';
                    }else{
                        echo '<h2>Want to Download Jainam Lite?</h2>';
                    }
                    ?>
                    <a href="<?php echo $download_button['url']; ?>" target="<?php echo $download_button['target']; ?>" class="btn"><?php echo $download_button['title']; ?></a>
                </div>
            </div>
        </section> 

        <section class="trader-feature-sec">
            <div class="container">
                <?php

                    // Check rows exists.
                    if( have_rows('features_of_traders') ):
                        $count = 1;
                        // Loop through rows.
                        while( have_rows('features_of_traders') ) : the_row();

                            // Load sub field value.
                            $trader_image = get_sub_field('trader_image');
                            $trader_title = get_sub_field('trader_title');
                            $traders_description = get_sub_field('traders_description');

                            if($count == 2) {
                                $add_class = "row-reverse";
                            }else{
                                $add_class = "";
                            }
                            ?>
                            <div class="trader-feature-inner <?php echo $add_class; ?>">
                                <div class="trader-feature-left">
                                    <h2><?php echo $trader_title; ?></h2>
                                    <?php echo $traders_description; ?>
                                </div>
                                <div class="trader-feature-right">
                                    <img src="<?php echo $trader_image['url']; ?>" alt="<?php echo $trader_image['alt']; ?>">
                                </div>
                            </div>
                            <?php
                            $count++;
                        // End loop.
                        endwhile;

                    // No value.
                    else :
                        // Do something...
                    endif;

                ?>
            </div>
        </section>

        <?php
            $jainam_main_video = get_field('jainam_main_video');
        ?>

        <section class="yt-video-sec">
            <div class="container">
                <div class="yt-video-inner">
                    <div id="youtube-iframe" class="yt-video-embed">
                        <iframe width="100%" height="671" src="<?php echo $jainam_main_video; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>
        <?php
            $jainam_short_video_title = get_field('jainam_short_video_title');
        ?>
        <section class="video-slider-section">
            <div class="container">
                <?php if($jainam_short_video_title){
                    echo '<h2>'.$jainam_short_video_title.'</h2>';
                }else{
                    echo '<h2>Jainam Lite short video</h2>';
                }
                ?>
                <div class="video-slider-inner">
                    <div class="award_card_slider_lite jainam-award-slider">
                        <?php

                            // Check rows exists.
                            if( have_rows('jainam_short_videos') ):

                                // Loop through rows.
                                while( have_rows('jainam_short_videos') ) : the_row();

                                    // Load sub field value.
                                    $video = get_sub_field('video');
                                    $video_title = get_sub_field('video_title');
                                    $video_views = get_sub_field('video_views');
                                    ?>
                                    <div class="jainam-award-slide-inner">
                                        <iframe width="100%" height="350" src="<?php echo $video; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        <h6><?php echo $video_title; ?></h6>
                                        <span><?php echo $video_views; ?> Views</span>
                                    </div>
                                    <?php

                                // End loop.
                                endwhile;

                            // No value.
                            else :
                                // Do something...
                            endif;

                        ?>
                    </div>
                </div>
            </div>
        </section>

    <?php 
        include(locate_template('template-parts/parts/faq.php' ));
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?> 

    </main>
   
<?php  get_footer(); ?>

<script>
    $(".award_card_slider_lite").slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: true,
          speed: 1000,
          autoplaySpeed: 1000,
          autoplay: false,
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
