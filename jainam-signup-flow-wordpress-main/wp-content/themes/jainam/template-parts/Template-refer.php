<?php

/**
 * Template Name: Refer & Earn
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css.map" />
<?php
    global $post;
    $banner_image = get_field('banner_image');
    $banner_heading = get_field('banner_heading');
    $banner_description = get_field('banner_description'); 
    $banner_button = get_field('banner_button');
    $button_link = get_field('button_link');
    $banner_bottom_line = get_field('banner_bottom_line');
    $bottom_line_link = get_field('bottom_line_link');
?>

    <main class="refer-earn <?php echo $post->post_name; ?>">

    <section class="refer-banner-section">
        <div class="container">
            <div class="refer-banner-inner">
                <div class="refer-banner-content">
                    <?php if($banner_heading){ ?>
                        <h1><?php echo $banner_heading; ?></h1>
                    <?php } else{?>
                        <h1>Refer & Earn on Jainam</h1>
                    <?php } ?>
                    
                    <?php if($banner_description){ ?>
                        <?php echo $banner_description; ?>
                    <?php } else{ ?>
                        <p>You Get 20% of Brokerage when friends trade. For a lifetime!</p>
                        <p>Generate Personalized referral link & share with your friends</p>
                    <?php } ?>

                    <?php if($banner_button){ ?>
                        <a href="<?php echo $button_link; ?>" target="_blank" class="btn"><?php echo $banner_button; ?></a>
                    <?php } ?>

                    <?php if($banner_bottom_line){ ?>
                        <a href="<?php echo $bottom_line_link; ?>" class="parter-btn"><?php echo $banner_bottom_line; ?></a>
                    <?php } ?>
                   
                </div>
                <div class="refer-banner-img">
                    <?php if($banner_image){ ?>
                        <img src="<?php echo $banner_image; ?>" alt="refer-banner">
                    <?php } else{?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/refer-banner.webp" alt="refer-banner">
                    <?php } ?>

                    
                </div>
            </div>
        </div>
    </section>

<?php
    $program_heading = get_field('program_heading');
?>
    <section class="how-refer-section">
        <div class="container">
            <?php if($program_heading){ ?>
                <h2><?php echo $program_heading; ?></h2>
            <?php } else{?>
                <h2>How does Jainam Referral Program Work?</h2>
            <?php } ?>
            
            <div class="how-refer-inner">
                <?php
                    // Check rows exists.
                    if( have_rows('work_details') ):

                        // Loop through rows.
                        while( have_rows('work_details') ) : the_row();

                            // Load sub field value.
                            $work_image = get_sub_field('work_image');
                            $work_title = get_sub_field('work_title');
                            ?>
                            <div class="how-refer-info">
                                <img src="<?php echo $work_image; ?>" alt="work-image"/>
                                <h3 class="inter_semibold"><?php echo $work_title; ?></h3>
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
    $referral_heading = get_field('referral_heading');
    $referral_credit_title = get_field('referral_credit_title');
    $t_and_c_apply = get_field('t_and_c_apply');
?>

    <section class="refer-credit-section">
         <div class="container">
            <div class="refer-credit-inner">
                <div class="refer-credit-left">
                    
                    <?php if($referral_heading){ ?>
                        <h2><?php echo $referral_heading; ?></h2>
                    <?php } else{?>
                        <h2>What you get when your friend
                        opens Jainam account?
                        </h2>
                    <?php } ?>

                </div>
                <div class="refer-credit-right">
                    
                    <?php if($referral_credit_title){ ?>
                        <h3><?php echo $referral_credit_title; ?></h3>
                    <?php } else{?>
                        <h3>Get <span>₹250</span>* Referral Credit</h3>
                    <?php } ?>

                    <?php if($t_and_c_apply){ ?>
                        <p><?php echo $t_and_c_apply; ?></p>
                    <?php } else{?>
                        <p>*T&C Apply</p>
                    <?php } ?>

                </div>
            </div>
         </div>
    </section>

<?php
    $broking_heading = get_field('broking_heading');
?>

    <section class="broking-section">
        <div class="container">
            
            <?php if($broking_heading){ ?>
                <h2><?php echo $broking_heading; ?></h2>
            <?php } else{?>
                <h2>Why Choose Jainam Broking Limited</h2> 
            <?php } ?>
            <div class="broking-sec-inner">
                <?php
                    // Check rows exists.
                    if( have_rows('why_choose') ):

                        // Loop through rows.
                        while( have_rows('why_choose') ) : the_row();

                            // Load sub field value.
                            $heading = get_sub_field('heading');
                            $description = get_sub_field('description');
                            ?>
                            <div class="broking-inner-box">
                                <h3 class="inter_semibold"><?php echo $heading; ?></h3>
                                <p><?php echo $description; ?></p>                        
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
    $refer_heading = get_field('refer_heading');
    $refer_button = get_field('refer_button');
    $refer_link = get_field('refer_link');
?>

    <section class="account-open-blog account-open-blog-refer">
        <div class="container">          
            <div class="account-open-blog-inner">

                <?php if($refer_heading){ ?>
                <h2><?php echo $refer_heading; ?></h2>
                <?php } else{?>
                <h2>Generate Personalized referral link & share with your friends</h2>
                <?php } ?>

                <?php if($refer_button){ ?>
                <a href="<?php echo $refer_link; ?>" target="_blank" class="btn"><?php echo $refer_button; ?></a>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php 
        include(locate_template('template-parts/parts/faq.php' ));
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?> 
    </main>

<?php  get_footer(); ?> 
