<?php

/**
 * Template Name: API-Details
 */ 
get_header(); ?> 

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/api.css" />
<link rel="stylesheet" type="text/css"
    href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css.map" />

<?php
    $jainam_banner_title = get_field('jainam_banner_title');
    $banner_image = get_field('banner_image');
?>

<main class="API-page">
    <section class="api_banner">
     <div class="banner_img">
     <div class="container">
            <div class="api_banner_inner">
                <div class="api_banner_left">
                    <?php if($jainam_banner_title){
                        echo '<h1>'.$jainam_banner_title.'</h1>';
                    }else{
                        echo '<h1>
                            Start building your own algorithm trading with our exclusive Free
                            Trading API
                        </h1>';
                    }
                    ?>
                    <a href="https://signup.jainam.in/" class="btn click-partner-modal">Get API</a>
                </div>
                <div class="api_banner_right">
                    <img src="<?php echo $banner_image['url']; ?>"
                        alt="<?php echo $banner_image['alt']; ?>" />
                </div>
            </div>
        </div>
     </div>
    </section>
    <?php
        $choose_jainam_api_title = get_field('choose_jainam_api_title');
        $choose_jainam_api_description = get_field('choose_jainam_api_description');
    ?>

    <section class="choose_api">
        <div class="container">
            <div class="choose_api_inner">
                <div class="api_box">
                    
                    <?php if($choose_jainam_api_title){
                        echo '<h2>'.$choose_jainam_api_title.'</h2>';
                    }else{
                        echo '<h2>Why Choose Jainam’s API</h2>';
                    }
                    ?>

                    <?php if($choose_jainam_api_description){
                        echo '<p>'.$choose_jainam_api_description.'</p>';
                    }else{
                        echo '<p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>';
                    }
                    ?>

                </div>
                <?php

                    // Check rows exists.
                    if( have_rows('choose_jainam_api') ):

                        // Loop through rows.
                        while( have_rows('choose_jainam_api') ) : the_row();

                            // Load sub field value.
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $description = get_sub_field('description');

                            ?>
                            <div class="api_box">
                                <div class="api_img">
                                    <img src="<?php echo $icon; ?>"
                                        alt="features-trader" />
                                </div>
                                <h3><?php echo $title; ?></h3> 
                                <p>
                                    <?php echo $description; ?>
                                </p>
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
            $multi_trading_api_title = get_field('multi_trading_api_title');
        ?>
        <section class="multiple_api">
        <div class="container">
            <div class="multiple_api_inner">
                
                <?php if($multi_trading_api_title){
                    echo '<h2>'.$multi_trading_api_title.'</h2>';
                }else{
                    echo '<h2>Multiple Trading APIs</h2>';
                }
                ?>

                <div class="main_api_box">
                    <?php

                        // Check rows exists.
                        if( have_rows('trading_api') ):
                            $count = 1;
                            // Loop through rows.
                            while( have_rows('trading_api') ) : the_row();

                                if($count == 1){
                                    $add_class = 'left_api_box';
                                    $activeclass = '';
                                }else{
                                    $add_class = 'right_api_box';
                                    $activeclass = 'active';
                                }

                                // Load sub field value.
                                $trading_api_title = get_sub_field('trading_api_title');
                                $trading_api_description = get_sub_field('trading_api_description');
                                $features_name = get_sub_field('features_name');
                                $features = get_sub_field('features');
                                $view_api = get_sub_field('view_api');
                                $get_api = get_sub_field('get_api');
                                $integrated_partner_title = get_sub_field('integrated_partner_title');

                                ?>
                                <div class="trading_api <?php echo $add_class; ?>">
                                    <h3><?php echo $trading_api_title; ?></h3>
                                    <p>
                                        <?php echo $trading_api_description; ?>
                                    </p>
                                        <h4><?php echo $features_name; ?></h4>
                                        <div class="Features">
                                            <?php echo $features; ?>
                                        </div>
                                    
                                    <div class="api_buttons">
                                        <a href="<?php echo $view_api['url']; ?>" target="<?php echo $view_api['target']; ?>" class="common_button click-partner-modal"><?php echo $view_api['title']; ?></a>
                                        <a href="<?php echo $get_api['url']; ?>" class="common_button click-partner-modal <?php echo $activeclass; ?>"><?php echo $get_api['title']; ?></a>
                                    </div>

                                    <div class="api_partners">
                                        <h4><?php echo $integrated_partner_title; ?></h4>
                                        <ul>
                                            <?php

                                                // Check rows exists.
                                                if( have_rows('partners') ):

                                                    // Loop through rows.
                                                    while( have_rows('partners') ) : the_row();

                                                        // Load sub field value.
                                                        $partner_image = get_sub_field('partner_image');
                                                        $partner_name = get_sub_field('partner_name');
                                                    ?>
                                                    <li>
                                                        <img src="<?php echo $partner_image; ?>"
                                                            alt="features-trader" />
                                                        <p><?php echo $partner_name; ?></p>
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
        include(locate_template('template-parts/parts/open-free-account-number-sec-black.php' ));
        include(locate_template('template-parts/parts/blog-sec-holiday.php' ));
        include(locate_template('template-parts/parts/faq.php' ));
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?>

    
    <div class="comman_modal partner-form-modal">
        <div class="custom-model-main">
            <div class="custom-model-inner">        
                <div class="custom-model-wrap">
                    <div class="close-btn">
                        <img src="https://dev.artoonsolutions.com/jainam-signup-flow-wordpress/wp-content/themes/jainam/assets/img/modal_colse_btn.svg" alt="modal_colse_btn">
                    </div>
                    <div class="popup_inner">
                        <!-- form>
                            <div class="form_inner">
                                    <div class="feild">
                                        <label for="name" >Enter Name</label>
                                        <input type="text" name="Enter name" id="name" placeholder="Enter name">
                                    </div>
                                    <div class="feild">
                                        <label for="Mobile Number" >Enter Mobile Number</label>
                                        <input type="text" name="Enter Mobile Number" id="Mobile" placeholder="Enter Mobile Number">
                                    </div>
                                    <div class="feild">
                                        <label for="Email Id" >Enter Email Id</label>
                                        <input type="email" name="Enter Email Id" id="email_id" placeholder="Enter Email Id">
                                    </div>
                                    <div class="feild">
                                        <label for="Client Id" >Jainam Client Id</label>
                                        <input type="email" name="Jainam Client Id" id="client_id" placeholder="Jainam Client Id">
                                    </div>  
                                    <div class=" feild checkbox">
                                        <input type="checkbox" name="Agree to Terms & Conditions" id="condition">
                                        <label for="condition">Agree to Terms & Conditions</label>
                                    </div>
                            </div>
                        </form>
                        <div class="api_button">
                            <button type="submit" class="get_api_btn">Get API</button>
                        </div> -->
                        <?php echo do_shortcode('[contact-form-7 id="e288b7c" title="Jainam API"]'); ?>
                    </div>    
                </div>  
            </div>  
            <div class="bg-overlay"></div>
        </div>             
    </div>

</main>

<?php  get_footer(); ?>