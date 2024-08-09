<?php

/**
 * Template Name: Disclaimer
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css.map" />
<?php

global $post; 

$banner_heading = get_field('banner_heading');
$banner_description = get_field('banner_description'); 

?>
<main class="holiday-page <?php echo $post->post_name; ?> disclaimer"> 
        <section class="comman_banner-section">
            <div class="container">
                <?php if($banner_heading){ ?><h1 class="banner_title"><?php echo $banner_heading; ?></h1><?php } else{?><h1 class="banner_title">Desclaimer</h1><?php } ?>
                <?php if($banner_description){ ?><p class="banner_title_content"><?php echo $banner_description; ?></p><?php } else{?><p class="banner_title_content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p><?php } ?>
            </div>
        </section>

        <section class="comman_tabs-sec">
            <div class="container">
                <div class="tab_div">
                    <ul class="comm_tabing"> 
                        <?php

                            
                            // Check rows exists.
                            if( have_rows('button_links') ):

                                // Loop through rows.
                                while( have_rows('button_links') ) : the_row();

                                    // Load sub field value.$obj_id = get_queried_object_id();
                            $current_url = get_permalink( $obj_id );
                                    $tabs = get_sub_field('button_name');
                                    $tab_link = get_sub_field('button_link');
                                    if($tab_link == ""){
                                        $tab_link = "#";
                                    }

                                    if($current_url == $tab_link){
                                        $class="active";
                                    }else{
                                        $class="";
                                    }
                                    ?>
                                    <li><a href="<?php echo $tab_link; ?>" class="btn_tab <?php echo $class; ?>"><?php echo $tabs; ?></a></li>
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
        </section>

        <section class="details_of_disclaimer"> 
            <div class="container">

                <?php
                    $main_title = get_field('main_title');
                    $main_content = get_field('main_content'); 
                ?>

                <?php if($main_title){?><h2><?php echo $main_title; ?></h2><?php }?>
                <?php if($main_content){ echo $main_content; }?>

                <?php include(locate_template('template-parts/parts/desclaimer-faq.php' )); ?> 
                <?php
                        // Check rows exists.
                        if( have_rows('details') ):

                            // Loop through rows.
                            while( have_rows('details') ) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $description = get_sub_field('content');
                                // Do something, but make sure you escape the value if outputting directly...
                                ?>
                                    <?php if($title){?><h3><?php echo $title; ?></h3><?php }?>
                                    <?php if($description){ echo $description; }?>
                                <?php
                            // End loop.
                            endwhile;
                            

                        // No value.
                        else :
                            // Do something...
                        endif; 
                ?>
                    <?php
                        $contact_label = get_field('contact_label');
                        $mail_icon = get_field('mail_icon'); 
                        $email_address = get_field('email_address');
                        $phone_icon = get_field('phone_icon'); 
                        $phone_number = get_field('phone_number');
                    ?>
            </div>
            <div class="container">
            <?php if($contact_label){ ?>
                <div class="disclaimer-contact">
                    
                    <div class="disclaimer-contact-inner">
                        <div class="disclaimer-contact-left">
                            <?php if($contact_label){ ?><h3><?php echo $contact_label; ?></h3><?php } ?>
                        </div>
                        <div class="disclaimer-contact-right">
                            <div class="disclaimer-contact-right-box">
                                <?php if($mail_icon){ ?>
                                <img src="<?php echo $mail_icon; ?>" alt="mail_icon"/>
                                <?php  } ?>

                                <?php if($email_address){ ?><h5>
                                    <a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a>
                                </h5><?php } ?>
                                
                            </div>
                            <div class="disclaimer-contact-right-box">  
                                <?php if($phone_icon){
                                ?>
                                <img src="<?php echo $phone_icon; ?>" alt="phone_icon"/>
                                <?php
                                }
                                ?>
                                
                                <?php if($phone_number){ ?><h5>
                                    <a href="tel:<?php echo $phone_number; ?>"><?php echo $phone_number; ?></a>
                                </h5><?php }?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
            </div>
        </section>

        <?php include(locate_template('template-parts/parts/open-free-account-number-sec-black.php' ));?> 
        
</main>

<?php  get_footer(); ?>
