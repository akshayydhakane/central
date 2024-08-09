<?php

/**
 * Template Name: Contact Us
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/contact-us.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/contact-us.css.map" />
<?php

global $post; 

$banner_image = get_field('banner_image');
$banner_heading = get_field('banner_heading'); 
$banner_description = get_field('banner_description');
$banner_que_line_1 = get_field('banner_que_line_1');
$banner_que_line_2 = get_field('banner_que_line_2');
$banner_button = get_field('banner_button');
$button_link = get_field('button_link');

?>
<style>
    .contact-us-faq .hidden {
        display: none;
    }
</style>
<main class="holiday-page <?php echo $post->post_name; ?> disclaimer"> 
    <section class="contact-us-banner">
        <div class="container">
            <div class="contact-us-banner-inner">
                <div class="contact-us-banner-left">
                    
                    <?php if($banner_heading){ ?>
                        <h1><?php echo $banner_heading; ?></h1>
                    <?php } else{?>
                        <h1>Contact Us</h1>
                    <?php } ?>

                    
                    <?php if($banner_description){ ?>
                        <p><?php echo $banner_description; ?></p>
                    <?php } else{?>
                        <p>We are always available to provide information and guide you through your journey </p>
                    <?php } ?>

                    <?php if($banner_que_line_1){ ?>
                        <span><?php echo $banner_que_line_1; ?></span>
                    <?php } else{?>
                        <span>Do you still feel stuck?</span>
                    <?php } ?>
                    
                    <?php if($banner_que_line_2){ ?>
                        <span><?php echo $banner_que_line_2; ?></span>
                    <?php } else{?>
                        <span>Have you tried looking for an answer?</span>
                    <?php } ?>

                    <?php if($banner_button){ ?>
                        <a href="<?php echo $button_link; ?>" target="_blank" class="btn"><?php echo $banner_button; ?></a>
                    <?php } else{?>
                        <a href="javascript:void(0)" class="btn">Raise a Ticket</a>
                    <?php } ?>

                    
                </div>
                <div class="contact-us-banner-right">

                    <?php if($banner_image){ ?>
                        <img src="<?php echo $banner_image; ?>" alt="contact-us-banner">
                    <?php } else{?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/contact-us-banner.webp" alt="contact-us-banner">
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <?php 
        include(locate_template('template-parts/parts/contactus-faq.php' ));
    ?> 

    <section class="contact-us-tab-section">
        <div class="container">
            <div class="tabs contact-us-tabs">
                <div class="tab_div">
                <ul id="tabs">

                    <?php

                        // Check rows exists.
                        if( have_rows('tab_list') ):
                            $count = 1;
                            // Loop through rows.
                            while( have_rows('tab_list') ) : the_row();
                                // Load sub field value.
                                $tab_name = get_sub_field('tab_name');
                                if($count == 1){
                                    $add_class="active";
                                }else{
                                    $add_class="";
                                }
                                ?>
                                <li class="<?php echo $add_class; ?>">
                                    <a href="javascript:void(0)" id="tab<?php echo $count; ?>"><?php echo $tab_name; ?></a>
                                </li>
                                <?php
                                $count++;
                            // End loop.
                            endwhile;

                        // No value.
                        else :
                            // Do something...
                        endif;
                    ?>

                </ul>
            </div>
                <div id="content-tab">
                    <div id="tab1c" class="active">
                        <div class="connect-box-tab-main">

                        <?php

                            // Check rows exists.
                            if( have_rows('tab_1_details') ):
                               
                                // Loop through rows.
                                while( have_rows('tab_1_details') ) : the_row();
                                    // Load sub field value.
                                    $heading = get_sub_field('heading');
                                    $phone_number = get_sub_field('phone_number');
                                    $email_address = get_sub_field('email_address');
                                    ?>
                                    <div class="connect-box-tab">
                                        <h3 class="inter_semibold"><?php echo $heading; ?></h3>
                                        <p><?php echo $phone_number; ?></p>
                                        <p><a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a></p>
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
                    <div id="tab2c">
                        <div class="connect-box-tab-main connect-box-tab-main-2">

                            <?php

                            // Check rows exists.
                            if( have_rows('tab_2_details') ):
                               
                                // Loop through rows.
                                while( have_rows('tab_2_details') ) : the_row();
                                    // Load sub field value.
                                    $icon = get_sub_field('icon');
                                    $heading = get_sub_field('heading');
                                    $phone_number = get_sub_field('phone_number');
                                    $email_address = get_sub_field('email_address');
                                    ?>
                                    <div class="connect-box-tab">
                                        <img src="<?php echo $icon; ?>" width="40" height="40" alt="icon" />
                                        <h3 class="inter_semibold"><?php echo $heading; ?></h3>
                                        <p><?php echo $phone_number; ?></p>
                                        <p><a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a></p>
                                    </div>
                                    <?php
                                    
                                // End loop.
                                endwhile;

                            // No value.
                            else :
                                // Do something...
                            endif;
                        ?>
                            <div class="connect-box-tab">
                                <div class="connect-box-tab-inner">
                                    <?php

                                        // Check rows exists.
                                        if( have_rows('content_box_tab_inner') ):
                                           
                                            // Loop through rows.
                                            while( have_rows('content_box_tab_inner') ) : the_row(); 
                                                // Load sub field value.
                                                $icon = get_sub_field('icon');
                                                $title = get_sub_field('title');
                                                $link = get_sub_field('link');
                                                ?>
                                                <div>
                                                    <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
                                                        <img src="<?php echo $icon; ?>" width="40" height="40" alt="icon" />
                                                        <h4><?php echo $title; ?></h4> 
                                                    </a>
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
                    </div>
                    <div id="tab3c">
                        <div class="matrix-table">
                            <table>
                                <thead>
                                    <tr>
                                        <?php while( have_rows('table_headers') ): the_row(); ?>
                                            <th><?php echo esc_html(get_sub_field('header')); ?></th>
                                        <?php endwhile; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while( have_rows('table_rows') ): the_row(); ?>
                                        <tr>
                                            <?php if( have_rows('row_data') ): ?>
                                                <?php while( have_rows('row_data') ): the_row(); ?>
                                                    <td><?php echo get_sub_field('data'); ?></td>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </section>
<?php
    include(locate_template('template-parts/parts/open-free-account-number-sec-contactus.php' ));
?>
<?php
$head_office_title = get_field('head_office_title');
$head_office_branch = get_field('head_office_branch');
$background_image = get_field('background_image');
$background_image_link = get_field('background_image_link');
?>
    <section class="head-office-section" style="margin-bottom: 50px;">
        <div class="container">
            <div class="head-office-inner">
                <div class="head-office-inner-left">
                    <?php if($head_office_title){ ?><h2><?php echo $head_office_title; ?></h2><?php } ?>
                    <?php if($head_office_branch){ ?><h4><?php echo $head_office_branch; ?></h4><?php } ?>
                    <?php

                        // Check rows exists.
                        if( have_rows('branch_details') ):
                           
                            // Loop through rows.
                            while( have_rows('branch_details') ) : the_row();
                                // Load sub field value.
                                $title = get_sub_field('title');
                                $details = get_sub_field('details');
                                ?>
                                <p>
                                    <?php if($title) { ?> 
                                        <span><?php echo $title; ?>:</span>
                                    <?php } ?>
                                    <?php echo $details; ?>
                                </p>
                                <?php 
                                
                            // End loop.
                            endwhile;

                        // No value.
                        else :
                            // Do something...
                        endif;
                    ?>

                </div>
                <div class="head-office-inner-right">
                    <?php if($background_image){
                    ?>
                    <a href="<?php echo $background_image_link['url']; ?>" target="<?php echo $background_image_link['target']; ?>">
                        <img src="<?php echo $background_image; ?>" alt="office-address">
                    </a>
                    <?php
                    }else{
                    ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/office-address.webp" alt="office-address">
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="map-address-section" style="">
        <div class="container">
            <div class="map-address-title">
                <h2>Jainam Near You:</h2>
                <div class="map-address-select-opc">

                    <?php
                        $stateterms = get_terms(array(
                            'taxonomy' => 'state',
                            'hide_empty' => false,
                        )); 

                        $districtterms = get_terms(array(
                            'taxonomy' => 'district',
                            'hide_empty' => false,
                        )); 


                    ?>
                    <div class="map-address-select-opc-state">
                        <label>State</label>
                        <div class="select">
                            <?php if (!empty($stateterms) && !is_wp_error($stateterms)) { ?>
                            <select name="state" id="state">
                            <?php
                            foreach ($stateterms as $stateterm) {
                                echo '<option value="'.$stateterm->name.'" style="background-color:#fff;">' .$stateterm->name. '</option>';
                            }
                            ?>
                            </select>
                        <?php } else { ?>
                            <select name="state" id="state">
                                <option selected disabled>No State found</option>
                            </select>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="map-address-select-opc-state">
                        <label>District</label>
                        <div class="select">
                            <?php if (!empty($districtterms) && !is_wp_error($districtterms)) { ?>
                            <select name="district" id="district">
                            <?php
                            foreach ($districtterms as $districtterm) {
                                echo '<option value="'.$districtterm->name.'" style="background-color:#fff;">' .$districtterm->name. '</option>';
                            }
                            ?>
                            </select>
                            <?php } else { ?>
                            <select name="district" id="district">
                                <option selected disabled>No District found</option>
                            </select>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map-address-inner">
                <div class="map_all_address">
                    <ul>
                        <?php
                            // Query to fetch locations
                                $args = array(
                                    'post_type' => 'location',
                                    'posts_per_page' => -1,
                                    'order' => 'ASC',
                                    'tax_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'taxonomy' => 'state',
                                            'field'    => 'slug',
                                            'terms'    => 'gujarat',
                                        ),
                                        array(
                                            'taxonomy' => 'district',
                                            'field'    => 'slug',
                                            'terms'    => 'surat',
                                        ),
                                    ),
                                );


                            $query = new WP_Query($args);

                            if ($query->have_posts()) {

                                while ($query->have_posts()) {
                                    $query->the_post();

                                    $title = get_the_title();
                                    $shop_address = get_field('shop_address'); 
                                    $phone = get_field('phone');
                                    $email = get_field('email');
                                    $maplink = get_field('map_link');

                                    ?>
                                    <li>
                                        <div class="address_details">
                                            <h2 class="inter_semibold"><?php echo $title; ?></h2>
                                            <div class="add_info">
                                                <a href="<?php echo $maplink; ?>" target="_blank"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/location_icon.svg" alt="location_icon"></span><?php echo $shop_address; ?></a>
                                                <a href="javascript:void(0)"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/call_icon.svg" alt="call_icon"></span> <?php echo $phone; ?></a>
                                                <?php /** <a href="mailto:<?php echo $email; ?>"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/mail_icon.svg" alt="mail_icon"></span><?php echo $email; ?></a> */ ?>
                                                <a href="<?php echo $maplink; ?>" target="_blank"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/location_icon.svg" alt="location_icon"></span></a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                wp_reset_postdata();
                                
                            } else {
                                echo '<li><div class="address-map address_details"><p>No locations found.</p></div></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php
        $partner_image = get_field('partner_image');
        $partner_heading = get_field('partner_heading');
        $partner_description = get_field('partner_description');
        $partner_button = get_field('partner_button');
        $partner_button_link = get_field('partner_button_link');
    ?>

    <section class="partner-us-section">
        <div class="container">
            <div class="partner-us-inner">
                <div class="partner-us-inner-content">
                    <?php if($partner_heading){ ?><h2><?php echo $partner_heading; ?></h2><?php } ?>
                    <?php if($partner_description){ ?><h4><?php echo $partner_description; ?></h4><?php } ?>
                    <?php if($partner_button){ ?>
                        <a href="<?php echo $partner_button_link; ?>" class="btn">
                            <span><?php echo $partner_button; ?></span>
                        </a>
                    <?php } ?>  
                </div>
                <div class="partner-us-inner-img">
                    <?php if($background_image){
                    ?>
                        <img src="<?php echo $partner_image; ?>" alt="partner with us">
                    <?php
                    }else{
                    ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/partner-us-img.webp" alt="partner with us">
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php
    //include(locate_template('template-parts/parts/open-free-account-number-sec-black-contactus.php' ));
?>
    <?php
        $career_heading = get_field('career_heading');
        $career_right_button = get_field('career_right_button');
    ?>
    
    <section class="career-section">
        <div class="container">
            <div class="career-title">
                
                <?php if($career_heading){ ?><h2><?php echo $career_heading; ?></h2>
                <?php }else{ ?>
                <h2>Career</h2>
                <?php } ?>
                <?php
                if( $career_right_button ): 
                    $link_url = $career_right_button['url'];
                    $link_title = $career_right_button['title'];
                    $link_target = $career_right_button['target'] ? $link['target'] : '_self';
                    ?>
                    <a href="<?php echo $link_url; ?>"><?php echo $link_title; ?></a>
                    <?php
                endif;
                ?>
            </div>
            <div class="career-inner">
                <?php

                        // Check rows exists.
                        if( have_rows('career_details') ):
                           
                            // Loop through rows.
                            while( have_rows('career_details') ) : the_row();
                                // Load sub field value.
                                $contact_icon = get_sub_field('contact_icon');
                                $contact_title = get_sub_field('contact_title');
                                $contact_link = get_sub_field('contact_link');

                                if($contact_link == ""){
                                    $contact_link = "#";
                                }

                                ?>
                               <div class="career-inner-box">
                                    <a href="<?php echo $contact_link['url']; ?>" target="<?php echo $contact_link['target']; ?>" >
                                        <img src="<?php echo $contact_icon; ?>" width="40" height="40"/>
                                        <h3 class="inter_semibold"><?php echo $contact_title; ?></h3>
                                    </a>
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
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?> 

</main>

<?php  get_footer(); ?>
