<?php

/**
 * Template Name: Career
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css.map" /> 

<?php
    $banner_image = get_field('banner_image');
    $banner_heading = get_field('banner_heading');
    $banner_button = get_field('banner_button');    
?>

<main class="career-page <?php echo $post->post_name; ?>">  
    <section class="career-banner-section">
        <div class="container">
            <div class="career-banner-inner">
                <div class="career-banner-left">
                    <?php if($banner_heading){ ?>
                        <h1><?php echo $banner_heading; ?></h1>
                    <?php }else{ ?>
                        <h1>We are fun people to be with
                        We are fun place to be at
                        </h1>
                    <?php }
                    ?>
                    <a href="<?php echo $banner_button['url']; ?>" target="<?php echo $banner_button['target']; ?>" class="btn"><?php echo $banner_button['title']; ?></a>
                </div>
                <div class="career-banner-right">
                    <?php if($banner_image){ ?>
                        <img src="<?php echo $banner_image; ?>" alt="career-banner">
                    <?php }else{ ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/career-banner.webp" alt="career-banner">
                    <?php }
                    ?>
                    
                </div>
            </div>
        </div>
    </section>

    <?php
        $main_title = get_field('main_title');
        $description = get_field('description');
    ?>

    <section class="career-info-section">
        <div class="container">
            <?php if($main_title){ ?>
                <h2><?php echo $main_title; ?></h2>
            <?php }else{ ?>
                <h2>Life at Jainam is fun</h2>
            <?php }
            ?>
            <?php if($description){ ?>
                <p><?php echo $description; ?></p>
            <?php }else{ ?>
                <p>We have created a culture where people can thrive individually and in teams, and have fun while at it.</p>
            <?php }
            ?>
            
            <div class="career-info-inner">
                <?php

                    // Check rows exists.
                    if( have_rows('upload_images') ):
                        $count = 1;
                        // Loop through rows.
                        while( have_rows('upload_images') ) : the_row();

                            // Load sub field value.
                            $image = get_sub_field('image');
                            ?>
                            <img src="<?php echo $image; ?>" alt="career" class="grid_item_<?php echo $count; ?>">
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
        </div>
    </section>

    <?php
        $culture_title = get_field('culture_title');
        $culture_description = get_field('culture_description');
    ?>

    <section class="culture-section">
        <div class="container">
            <?php if($culture_title){ ?>
                <h2><?php echo $culture_title; ?></h2>
            <?php }else{ ?>
                <h2>Culture</h2>
            <?php }
            ?>
            <?php if($culture_description){ ?>
                <p><?php echo $culture_description; ?></p>
            <?php }else{ ?>
                <p>Quasi natus quia illum omnis est ut fugiat. Est occaecati qui quod aut. Voluptates laboriosam nihil. Voluptatem magni quis voluptate dolor at.</p>
            <?php }
            ?>   
            <div class="culture-inner">

                <?php

                    // Check rows exists.
                    if( have_rows('types_of_culture') ):
                        
                        // Loop through rows.
                        while( have_rows('types_of_culture') ) : the_row();

                            // Load sub field value.
                            $icon = get_sub_field('icon');
                            $name = get_sub_field('name');
                            $below_description = get_sub_field('below_description');
                            ?>
                            <div class="culture-box">
                                <img src="<?php echo $icon; ?>" alt="culture">
                                <h3 class="inter_semibold"><?php echo $name; ?></h3>
                                <p><?php echo $below_description; ?></p>
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
        $join_us_heading = get_field('join_us_heading');
        $join_us_description = get_field('join_us_description');
        $view_job_opening_button = get_field('view_job_opening_button');
        $drop_resume = get_field('drop_resume');
        $mail_icon = get_field('mail_icon');
        $email = get_field('email');
    ?>
    
    <section class="join-us-section">
        <div class="container">
            <div class="join-us-inner">
                <div class="join-us-inner-left">
                    <?php if($join_us_heading){ ?>
                        <h2><?php echo $join_us_heading; ?></h2>
                    <?php }else{ ?>
                        <h2>Join us</h2>
                    <?php } 
                    ?>
                    <?php if($join_us_description){ ?>
                        <p><?php echo $join_us_description; ?></p>
                    <?php }else{ ?>
                        <p>Looking for a change? or want to be the change? you’re at the right place.</p>
                    <?php }
                    ?>     
                    <a href="<?php echo $view_job_opening_button['url']; ?>" target="<?php echo $view_job_opening_button['target']; ?>" class="btn"><?php echo $view_job_opening_button['title']; ?></a>
                </div>
                <div class="join-us-inner-right">
                    <a href="mailto:<?php echo $email; ?>" class="send-resume">
                        <div class="drop-resume">
                            <div class="drop-resume-icon">
                                <img src="<?php echo $mail_icon; ?>" alt="mail">
                            </div>
                            <p><?php echo $drop_resume; ?><span><?php echo $email; ?></span></p>
                        </div>
                    </a> 
                </div>
            </div>
        </div>
    </section>

    <?php
        $jainam_logo = get_field('jainam_logo');
        $page_name = get_field('page_name');
    ?>

    <footer class="career-footer">
        <div class="container">
            <div class="career-footer-inner">
                <div class="career-footer-left">
                    <div class="logo footer-logo">
                        <a href="<?php echo get_site_url(); ?>">
                            <img src="<?php echo $jainam_logo; ?>" alt="jainam-logo">
                        </a>
                    </div>
                    <h2><?php echo $page_name; ?></h2>
                </div>
                <div class="career-footer-right">
                    <ul>
                        <?php
                            // Check rows exists.
                            if( have_rows('useful_links') ):

                                // Loop through rows.
                                while( have_rows('useful_links') ) : the_row();

                                    // Load sub field value.
                                    $page_name = get_sub_field('page_name');
                                    ?>
                                    <li>
                                        <a href="<?php echo $page_name['url']; ?>"><?php echo $page_name['title']; ?></a>
                                    </li>
                                    <?php
                                    

                                // End loop.
                                endwhile;

                            // No value.
                            else :
                                // Do something...
                            endif;
                        ?>
                    </ul>
                    <ul class="career-footer-social">
                        <?php
                            // Check rows exists.
                            if( have_rows('social_media_links') ):

                                // Loop through rows.
                                while( have_rows('social_media_links') ) : the_row();

                                    // Load sub field value.
                                    $social_icon = get_sub_field('social_icon');
                                    $link = get_sub_field('link');
                                    ?>
                                    <li>
                                        <a href="<?php echo $link; ?>" target="_blank">
                                            <img src="<?php echo esc_url($social_icon['url']); ?>" alt="<?php echo esc_url($social_icon['alt']); ?>">
                                        </a>
                                    </li>
                                    <?php
                                    

                                // End loop.
                                endwhile;

                            // No value.
                            else :
                                // Do something...
                            endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</main> 

    



