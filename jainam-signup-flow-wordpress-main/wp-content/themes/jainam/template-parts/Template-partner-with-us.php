<?php

/**
 * Template Name: Partner with us
 */
get_header(); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/partner-with-us.css" />

<style type="text/css">
    .technology-inner-right img.active{display: block !important;}
    .technology-inner-right img{display: none;}
</style>
<?php

global $post;

$banner_image = get_field('banner_image');
$main_heading = get_field('main_heading');
$banner_discription = get_field('banner_discription');
$become_a_partner_button = get_field('become_a_partner_button');
$refer_friend_link = get_field('refer_friend_link');

?>

    <main class="partner-page">
        <section class="partner-banner-sec">
            <div class="container-fluid">
                <div class="partner-banner-inner">
                    <div class="partner-inner-left">
                        
                        <?php if($main_heading){?>
                            <h1><?php echo $main_heading; ?></h1>
                        <?php }else{ ?>
                            <h1>Partner with Jainam and start earning</h1>
                        <?php }
                        ?>

                        <?php
                        if($banner_discription){ ?>

                            <?php echo $banner_discription; ?>

                       <?php }else{ ?>
                            <p>Join our growing league of 11K+ registered Authorised Persons (AP) </p>
                            <h4>Earn over ₹ 1 lakh/month</h4>
                            <p>Become a sub broker with Jainam and earn incentives and brokerage when you onboard a customer</p>
                       <?php }
                        ?>

                        <?php
                        if($become_a_partner_button){ ?>
                            <a href="javascript:void(0)" target="<?php echo $become_a_partner_button['target']; ?>" class="btn click-partner-modal"><?php echo $become_a_partner_button['title']; ?></a>
                       <?php }else{ ?>
                           <a href="javascript:void(0)" class="btn click-partner-modal">Become a Partner</a>
                       <?php }
                        ?>

                        <?php
                        if($refer_friend_link){ ?>
                            <a href="<?php echo $refer_friend_link['url']; ?>" target="<?php echo $refer_friend_link['target']; ?>" class="refer_friend"><?php echo $refer_friend_link['title']; ?></a>
                       <?php }else{ ?>
                            <a href="javascript:void(0)" class="refer_friend">Want to refer a friend?</a>
                       <?php }
                        ?>

                    </div>
                    <div class="partner-inner-right">
                        <?php
                        if($banner_image){ ?>
                            <img src="<?php echo $banner_image['url']; ?>" alt="<?php echo $banner_image['alt']; ?>">
                       <?php }else{ ?>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/partner-banner.webp" alt="partner-banner">
                       <?php }
                        ?>
                        
                    </div>
                </div>
            </div>
        </section>

    <?php
        $authorise_partner_heading = get_field('authorise_partner_heading');
    ?>

        <section class="authorised-section">
            <div class="container">
                <div class="authorised-inner">
                    
                    <?php if($authorise_partner_heading){?>
                    <h2><?php echo $authorise_partner_heading; ?></h2>
                    <?php }else{ ?>
                            <h2>Join us and become an Authorised Partner</h2>
                    <?php }
                    ?>
                    <div class="authorised-info">
                        <?php

                            // Check rows exists.
                            if( have_rows('authorise_parter') ):

                                // Loop through rows.
                                while( have_rows('authorise_parter') ) : the_row();

                                    // Load sub field value.
                                    $icon = get_sub_field('icon');
                                    $count = get_sub_field('count');
                                    $authorise_discription = get_sub_field('authorise_discription');
                                    ?>
                                    <div class="authorised-box">
                                        <img src="<?php echo $icon; ?>" alt="authorised">
                                        <h4><?php echo $count; ?></h4>
                                        <p><?php echo $authorise_discription; ?></p>
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
    $jainam_broking_heading = get_field('jainam_broking_heading');
?>

    <section class="broking-section">
        <div class="container">  
            <?php if($jainam_broking_heading){?>
                    <h2><?php echo $jainam_broking_heading; ?></h2>
            <?php }else{ ?>
                    <h2>Why Choose Jainam Broking Limited</h2>
            <?php }
            ?>
            <div class="broking-sec-inner">
                    <?php

                        // Check rows exists.
                        if( have_rows('choose_jainam_broking') ):

                            // Loop through rows.
                            while( have_rows('choose_jainam_broking') ) : the_row();

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
        $benefits_heading = get_field('benefits_heading');
        $benefits_description = get_field('benefits_description');
    ?>

    <section class="benefit-section">
        <div class="container">
            <?php if($benefits_heading){?>
                    <h2><?php echo $benefits_heading; ?></h2>
            <?php }else{ ?>
                    <h2>Benefits of becoming a AP</h2>
            <?php }
            ?>

            <?php if($benefits_description){?>
                    <p><?php echo $benefits_description; ?></p>
            <?php }else{ ?>
                    <p>Quasi natus quia illum omnis est ut fugiat. Est occaecati qui quod aut. Voluptates laboriosam nihil. Voluptatem magni quis voluptate dolor at. Et minus illum natus accusamus dolores ut.</p>
            <?php }
            ?>  
            <div class="benefit-inner">
                <?php

                    // Check rows exists.
                    if( have_rows('becoming_a_ap') ):

                        // Loop through rows.
                        while( have_rows('becoming_a_ap') ) : the_row();

                            // Load sub field value.
                            $icon = get_sub_field('icon');
                            $heading = get_sub_field('heading');
                           ?>
                           <div class="benefit-inner-box">
                                <img src="<?php echo $icon; ?>" alt="authorised">
                                <h3 class="inter_semibold"><?php echo $heading; ?></h3>
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
        $partner_program_heading = get_field('partner_program_heading');
    ?>
    <section class="partner-program-sec">
        <div class="container">
            <?php if($partner_program_heading){
                echo '<h2>'.$partner_program_heading.'</h2>';
            }else{
                echo '<h2>Partner programs at Jainam</h2>';
            }
            ?>
            
            <div class="partner-program-inner">
                <?php

                    // Check rows exists.
                    if( have_rows('programs_at_jainam') ):
                        $count = 1;
                        // Loop through rows.
                        while( have_rows('programs_at_jainam') ) : the_row();

                            // Load sub field value.
                            $icon = get_sub_field('icon');
                            $heading = get_sub_field('heading');
                            $description = get_sub_field('description');
                            $know_more = get_sub_field('know_more');
                            if($count == 1 || $count == 2){
                                $add_class="click-partner-modal";
                            }else{
                                $add_class="";
                            }
                           ?>
                           <div class="partner-program-box">
                                <div class="partner-program-box-top">
                                    <img src="<?php echo $icon; ?>" alt="partner">
                                    <h3 class="inter_semibold"><?php echo $heading; ?></h3>
                                </div>
                                <p><?php echo $description; ?></p>
                                <a href="<?php echo $know_more['url']; ?>" target="<?php echo $know_more['target']; ?>" class="read_more_btn <?php echo $add_class; ?>">
                                    <span><?php echo $know_more['title']; ?></span>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/slider_arrow.svg" alt="arrow">
                                </a>
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
        </div>
    </section>

    <?php
        $become_partner_heading = get_field('become_partner_heading');
    ?>
    <section class="become-partner-sec">
        <div class="container">
            <?php if($become_partner_heading){
                echo '<h2>'.$become_partner_heading.'</h2>';
            }else{
                echo '<h2>Who can become a partner?</h2>';
            }
            ?>
            
            <div class="become-partner-inner">
                <?php

                    // Check rows exists.
                    if( have_rows('who_can_become_partner') ):

                        // Loop through rows.
                        while( have_rows('who_can_become_partner') ) : the_row();

                            // Load sub field value.
                            $icon = get_sub_field('icon');
                            $heading = get_sub_field('heading');
                            ?>
                            <div class="become-partner-box">
                                <img src="<?php echo $icon; ?>" alt="partner">
                                <h3 class="inter_semibold"><?php echo $heading; ?></h3>
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
        $technology_features_heading = get_field('technology_features_heading');
    ?>

    <section class="technology-sec">
        <div class="container">
            <?php if($technology_features_heading){
                echo '<h2>'.$technology_features_heading.'</h2>';
            }else{
                echo '<h2>Technology features</h2>';
            }
            ?>
            
            <div class="technology-inner">
                <div class="technology-inner-left">
                   
                        <?php

                            // Check rows exists.
                            if( have_rows('technology_features') ):
                                $count = 1;
                                // Loop through rows.
                                while( have_rows('technology_features') ) : the_row();

                                    // Load sub field value.
                                    $icon = get_sub_field('icon');
                                    $active_icon = get_sub_field('active_icon');
                                    $features_name = get_sub_field('features_name');
                                    if($count == 1){
                                        $addclass = "active";
                                    }else{
                                        $addclass = "";
                                    }
                                 ?>
                                <div class="technology-left-box <?php echo $addclass; ?>" id="tab_<?php echo $count; ?>">
                                    <img src="<?php echo $icon; ?>" class="tech_icon" alt="icon" / >
                                    <img src="<?php echo $active_icon; ?>" class="active_tech_icon" alt="icon" style="display:none;"/ >
                                    <h5><?php echo $features_name; ?></h5>
                                </div>
                                 <?php
                                 $count++;
                                endwhile;

                            // No value.
                            else :
                                // Do something...
                            endif;

                        ?>
                </div>
                <div class="technology-inner-right">
                    <?php

                        // Check rows exists.
                        if( have_rows('features_images') ):
                            $count = 1;
                            // Loop through rows.
                            while( have_rows('features_images') ) : the_row();

                                // Load sub field value.
                                $feature_image = get_sub_field('feature_image');
                                if($count == 1){
                                    $addclass = "active";
                                }else{
                                    $addclass = "";
                                }
                                ?>
                                <img src="<?php echo $feature_image['url']; ?>" alt="<?php echo $feature_image['alt']; ?>" id="tab_<?php echo $count; ?>" class="<?php echo $addclass; ?>">
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
        </div>
    </section>

    <?php
        $financial_product_heading = get_field('financial_product_heading');
        $financial_product_description = get_field('financial_product_description');
    ?>

    <section class="financial-sec">
        <div class="container">
            <div class="financial-inner">
                <div class="financial-inner-left">
                    <?php if($financial_product_heading){?>
                            <h2><?php echo $financial_product_heading; ?></h2>
                    <?php }else{ ?>
                            <h2>Financial products</h2>
                    <?php }
                    ?>

                    <?php if($financial_product_description){?>
                            <p><?php echo $financial_product_description; ?></p>
                    <?php }else{ ?>
                            <p>Jainam Broking Limited is a part of the top distributors of AIF, PMS, and Mutual Funds, which makes it a profitable place for building a franchise of business partners</p>
                    <?php }
                    ?>     
                </div>
                <div class="financial-inner-right">
                    
                        <?php
                            // Check rows exists.
                            if( have_rows('financial_products') ):

                                // Loop through rows.
                                while( have_rows('financial_products') ) : the_row();

                                    // Load sub field value.
                                    $name = get_sub_field('name');
                                    ?>
                                    <div class="financial-inner-right-box">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/complete-icon.svg" alt="technology">
                                        <h5><?php echo $name; ?></h5>
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
        include(locate_template('template-parts/parts/award-sec.php' ));
        include(locate_template('template-parts/parts/our-user-say.php' )); 
    ?>

    <?php
        $ready_to_partner_content = get_field('ready_to_partner_content');
        $become_partner_button = get_field('become_partner_button');
    ?>
    
    <section class="account-open-blog account-open-blog-home">
        <div class="container">             
            <div class="account-open-blog-inner">
                <?php if($ready_to_partner_content) { 
                    echo $ready_to_partner_content;
                } else { ?>
                    <h2>Ready to Partner?</h2>                        
                    <h4>Register to jump-start your journey as an Jainam</h4>
                    <p>We provide value with a safe & secured platform</p>
                <?php } ?>

                <?php if($become_partner_button){ ?>
                        <a href="<?php echo $become_partner_button['url']; ?>" target="<?php echo $become_partner_button['target']; ?>" class="btn click-partner-modal"><?php echo $become_partner_button['title']; ?></a>
                <?php } else { ?>
                        <a href="javascript:void(0)" class="btn click-partner-modal">Become a Partner</a>
                <?php } ?>
                
            </div>
        </div>
    </section>

    <?php 
        include(locate_template('template-parts/parts/faq.php' ));
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?> 

   <div class="comman_modal partner-form-modal">
        <div class="custom-model-main">
            <div class="custom-model-inner">        
                <div class="custom-model-wrap">
                    <div class="close-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/modal_colse_btn.svg" alt="modal_colse_btn"></div>
                    <div class="partner-form">
                        <h3>Become a Partner</h3>
                        <?php echo do_shortcode('[contact-form-7 id="b0a9061" title="Becama a partner"]'); ?>
                    </div>
                </div>  
            </div>  
            <div class="bg-overlay"></div>
        </div>             
    </div>
</main> 

<?php  get_footer(); ?>
