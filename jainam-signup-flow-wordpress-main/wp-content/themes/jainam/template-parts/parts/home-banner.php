
<?php ?>
<section class="banner-section">
    <div class="container">
        <div class="banner-section-inner">
            <div class="home-banner-left">
                <?php $banner_title = get_field('banner_title'); 
                $banner_description = get_field('banner_description');
                $add_open_demat_account = get_field('add_open_demat_account');

                if($banner_title){ ?><h1><?php echo get_field('banner_title'); ?></h1><?php } ?>
               <?php if($banner_description){ echo '<p>'.$banner_description.'</p>'; } 
                if($add_open_demat_account){?><a href="<?php echo $add_open_demat_account['url'];?>" class="btn"><?php echo $add_open_demat_account['title']; ?></a><?php }?>
            </div>

            <div class="home-banner-right">
                <div class="home-banner-slider">
                    <?php                                                
                    if ( have_rows('Left_slider_section') ) {?>
                        <div class="home-banner-slider-one home-banner-slider-1 swiper left-slide">
                            <div class="swiper-wrapper"><?php
                            while ( have_rows('Left_slider_section') ) {
                                the_row();
                                    // Check the layout type 
                                    if (get_row_layout() == 'slide_left_add_count') { 
                                        $lf_num_add_bg_color = get_sub_field('lf_num_add_bg_color');
                                        $lf_slide_add_title = get_sub_field('lf_slide_add_title');
                                        $lf_add_icon_or_text = get_sub_field('lf_add_icon_or_text');
                                        $lf_icon_add_svg = get_sub_field('lf_icon_add_svg');
                                        $lf_count_add_text = get_sub_field('lf_count_add_text');
                                        $choose_number_or_text = get_sub_field('lf_choose_number_or_text');
                                        $lf_slide_add_number = get_sub_field('lf_slide_add_number');
                                        $lf_add_text_slide = get_sub_field('lf_add_text_slide'); ?>
                                        <div class="swiper-slide home-slide-banner-inner <?php echo $lf_num_add_bg_color; ?>">
                                            <div class="home-slide-inner-top"><?php if($choose_number_or_text == 'number'){ ?>
                                            <h2><?php echo $lf_slide_add_number; ?></h2> <?php }else{ ?>
                                            <h4><?php echo $lf_add_text_slide; ?></h4><?php } ?>
                                            </div>
                                            <div class="home-slide-inner-bottom">
                                                <h6><?php echo $lf_slide_add_title; ?></h6>
                                                <?php if($lf_add_icon_or_text == 'add_text'){ ?>
                                                    <h2><?php echo $lf_count_add_text; ?></h2>
                                                <?php } else{?>
                                                <img src="<?php echo $lf_icon_add_svg['url']; ?>" alt="<?php echo $lf_icon_add_svg['alt']; ?>">
                                                <?php } ?>
                                            </div>
                                        </div><?php
                                    }
                                    if (get_row_layout() == 'slide_left_customer_slide') { 
                                        $lf_add_bg_color = get_sub_field('lf_add_bg_color');
                                        $lf_add_up_image = get_sub_field('lf_add_up_image');
                                        $lf_add_customer_count = get_sub_field('lf_add_customer_count'); ?>
                                        <div class="swiper-slide home-slide-banner-inner <?php echo $lf_add_bg_color; ?>">
                                            <div class="home-slide-inner-top">
                                            <img src="<?php echo $lf_add_up_image['url']; ?>" alt="<?php echo $lf_add_up_image['alt']; ?>">
                                            </div>
                                            <div class="home-slide-inner-bottom">
                                                <h6 class="text-right"><?php echo $lf_add_customer_count; ?></h6>
                                                <?php if ( have_rows('lf_add_customer_image') ) { ?>
                                                    <div class="bottom-imges"><?php
                                                    while ( have_rows('lf_add_customer_image') ) {
                                                        the_row(); 
                                                        $lf_add_custom_image = get_sub_field('lf_add_custom_image'); ?>                                            
                                                        <img src="<?php echo $lf_add_custom_image['url']; ?>" alt="<?php echo $lf_add_custom_image['title']; ?>">
                                                    <?php } ?>
                                                        <a href="javascript:void(0)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                                                <path d="M2.91108 0.111328V1.27799H6.64442L0.111084 7.81133L0.888862 8.58911L7.49997 1.97799V5.71133H8.66664V0.111328H2.91108Z" fill="white"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php } ?>

                                            </div>
                                        </div><?php
                                    }
                                    if (get_row_layout() == 'slide_left_add_graph_sec') { 
                                        $lf_gh_add_bg_color = get_sub_field('lf_gh_add_bg_color');
                                        $lf_add_graph_count_ = get_sub_field('lf_add_graph_count_');
                                        $lf_add_graph_image = get_sub_field('lf_add_graph_image');
                                        $lf_add_info_text = get_sub_field('lf_add_info_text'); ?>
                                        <div class="swiper-slide home-slide-banner-inner <?php echo  $lf_gh_add_bg_color; ?>">
                                            <div class="home-slide-inner-top">
                                                <h4><?php echo $lf_add_graph_count_; ?></h4>
                                            <img src="<?php echo $lf_add_graph_image['url']; ?>" alt="<?php echo $lf_add_graph_image['alt']; ?>">
                                            </div>
                                            <div class="home-slide-inner-bottom">
                                                <p><?php echo $lf_add_info_text; ?></p>
                                            </div>
                                        </div><?php
                                    } 
                                }?>
                            </div>
                        </div><?php
                    }   
                    if ( have_rows('right_slider_sectio') ) {?>
                        <div class="home-banner-slider-one home-banner-slider-two swiper right-slide">
                            <div class="swiper-wrapper"><?php
                            while ( have_rows('right_slider_sectio') ) {
                                the_row();
                                    // Check the layout type 
                                    if (get_row_layout() == 'slide_right_add_count') { 
                                        $right_num_add_bg_color = get_sub_field('right_num_add_bg_color');
                                        $right_choose_text_or_number = get_sub_field('right_choose_text_or_number');
                                        $right_add_text_slide = get_sub_field('right_add_text_slide');
                                        $right_slide_add_number = get_sub_field('right_slide_add_number');
                                        $right_slide_add_title = get_sub_field('right_slide_add_title');
                                        $right_add_icon_or_text = get_sub_field('right_add_icon_or_text');
                                        $right_icon_add_svg = get_sub_field('right_icon_add_svg');
                                        $right_count_add_text = get_sub_field('right_count_add_text');
                                    ?>
                                        <div class="swiper-slide home-slide-banner-inner <?php echo $right_num_add_bg_color; ?>">
                                            <div class="home-slide-inner-top">
                                                <?php if($right_choose_text_or_number == 'right_number'){ ?>
                                                <h2><?php echo $right_slide_add_number; ?></h2> <?php }else{ ?>
                                                <h4><?php echo $right_add_text_slide; ?></h4><?php } ?>
                                            </div>
                                            <div class="home-slide-inner-bottom">
                                                <h6><?php echo $right_slide_add_title; ?></h6>
                                                <?php if($right_add_icon_or_text == 'add_text'){ ?>
                                                    <h2><?php echo $right_count_add_text; ?></h2>
                                                <?php } else{?>
                                                <img src="<?php echo $right_icon_add_svg['url']; ?>" alt="<?php echo $right_icon_add_svg['alt']; ?>">
                                                <?php } ?>
                                            </div>
                                        </div><?php
                                    }
                                    if (get_row_layout() == 'slide_right_customer_slide') { 
                                        $right_add_bg_color = get_sub_field('right_add_bg_color');
                                        $right_add_up_image = get_sub_field('right_add_up_image');
                                        $right_add_customer_count = get_sub_field('right_add_customer_count'); ?>
                                        <div class="swiper-slide home-slide-banner-inner <?php echo $right_add_bg_color; ?>">
                                            <div class="home-slide-inner-top">
                                            <img src="<?php echo $right_add_up_image['url']; ?>" alt="<?php echo $right_add_up_image['alt']; ?>">
                                            </div>
                                            <div class="home-slide-inner-bottom">
                                                <h6 class="text-right"><?php echo $right_add_customer_count; ?></h6>
                                                <?php if ( have_rows('right_add_customer_image') ) { ?>
                                                    <div class="bottom-imges"><?php
                                                    while ( have_rows('right_add_customer_image') ) {
                                                        the_row(); 
                                                        $right_add_customer_images = get_sub_field('right_add_customer_images'); ?>                                            
                                                        <img src="<?php echo $right_add_customer_images['url']; ?>" alt="<?php echo $right_add_customer_images['title']; ?>">
                                                    <?php } ?>
                                                        <a href="javascript:void(0)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                                                <path d="M2.91108 0.111328V1.27799H6.64442L0.111084 7.81133L0.888862 8.58911L7.49997 1.97799V5.71133H8.66664V0.111328H2.91108Z" fill="white"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php } ?>

                                            </div>
                                        </div><?php
                                    }
                                    if (get_row_layout() == 'slide_right_add_graph_sec') { 
                                        $right_add_bg_color = get_sub_field('right_add_bg_color');
                                        $right_add_graph_count = get_sub_field('right_add_graph_count');
                                        $right_add_graph_image = get_sub_field('right_add_graph_image');
                                        $right_add_info_text = get_sub_field('right_add_info_text'); ?>
                                        <div class="swiper-slide home-slide-banner-inner <?php echo  $right_add_bg_color; ?>">
                                            <div class="home-slide-inner-top">
                                                <h4><?php echo $right_add_graph_count; ?></h4>
                                            <img src="<?php echo $right_add_graph_image['url']; ?>" alt="<?php echo $right_add_graph_image['alt']; ?>">
                                            </div>
                                            <div class="home-slide-inner-bottom">
                                                <p><?php echo $right_add_info_text; ?></p>
                                            </div>
                                        </div><?php
                                    } 
                                }?>
                            </div>
                        </div><?php
                    }?>                 
                    <div class="home-banner-slider-one home-banner-slider-two home-banner-slider-mobile">
                    <?php if ( have_rows('right_slider_sectio') ) {
                            while ( have_rows('Left_slider_section') ) {
                                the_row();
                                    // Check the layout type 
                                    if (get_row_layout() == 'slide_left_add_count') { 
                                        $lf_num_add_bg_color = get_sub_field('lf_num_add_bg_color');
                                        $lf_slide_add_number = get_sub_field('lf_slide_add_number');
                                        $lf_slide_add_title = get_sub_field('lf_slide_add_title');
                                        $lf_add_icon_or_text = get_sub_field('lf_add_icon_or_text');
                                        $lf_icon_add_svg = get_sub_field('lf_icon_add_svg');
                                        $lf_count_add_text = get_sub_field('lf_count_add_text');
                                    ?>
                                        <div class="swiper-slide home-slide-banner-inner <?php echo $lf_num_add_bg_color; ?>">
                                            <div class="home-slide-inner-top">
                                                <h2><?php echo $lf_slide_add_number; ?></h2>
                                            </div>
                                            <div class="home-slide-inner-bottom">
                                                <h6><?php echo $lf_slide_add_title; ?></h6>
                                                <?php if($lf_add_icon_or_text == 'add_text'){ ?>
                                                    <h2><?php echo $lf_count_add_text; ?></h2>
                                                <?php } else{?>
                                                <img src="<?php echo $lf_icon_add_svg['url']; ?>" alt="<?php echo $lf_icon_add_svg['alt']; ?>">
                                                <?php } ?>
                                            </div>
                                        </div><?php
                                    }
                                    if (get_row_layout() == 'slide_left_customer_slide') { 
                                        $lf_add_bg_color = get_sub_field('lf_add_bg_color');
                                        $lf_add_up_image = get_sub_field('lf_add_up_image');
                                        $lf_add_customer_count = get_sub_field('lf_add_customer_count'); ?>
                                        <div class="swiper-slide home-slide-banner-inner <?php echo $lf_add_bg_color; ?>">
                                            <div class="home-slide-inner-top">
                                            <img src="<?php echo $lf_add_up_image['url']; ?>" alt="<?php echo $lf_add_up_image['alt']; ?>">
                                            </div>
                                            <div class="home-slide-inner-bottom">
                                                <h6 class="text-right"><?php echo $lf_add_customer_count; ?></h6>
                                                <?php if ( have_rows('lf_add_customer_image') ) { ?>
                                                    <div class="bottom-imges"><?php
                                                    while ( have_rows('lf_add_customer_image') ) {
                                                        the_row(); 
                                                        $lf_add_custom_image = get_sub_field('lf_add_custom_image'); ?>                                            
                                                        <img src="<?php echo $lf_add_custom_image['url']; ?>" alt="<?php echo $lf_add_custom_image['title']; ?>">
                                                    <?php } ?>
                                                        <a href="javascript:void(0)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                                                <path d="M2.91108 0.111328V1.27799H6.64442L0.111084 7.81133L0.888862 8.58911L7.49997 1.97799V5.71133H8.66664V0.111328H2.91108Z" fill="white"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php } ?>

                                            </div>
                                        </div><?php
                                    }
                                    if (get_row_layout() == 'slide_left_add_graph_sec') { 
                                        $lf_gh_add_bg_color = get_sub_field('lf_gh_add_bg_color');
                                        $lf_add_graph_count_ = get_sub_field('lf_add_graph_count_');
                                        $lf_add_graph_image = get_sub_field('lf_add_graph_image');
                                        $lf_add_info_text = get_sub_field('lf_add_info_text'); ?>
                                        <div class="swiper-slide home-slide-banner-inner <?php echo  $lf_gh_add_bg_color; ?>">
                                            <div class="home-slide-inner-top">
                                                <h4><?php echo $lf_add_graph_count_; ?></h4>
                                            <img src="<?php echo $lf_add_graph_image['url']; ?>" alt="<?php echo $lf_add_graph_image['alt']; ?>">
                                            </div>
                                            <div class="home-slide-inner-bottom">
                                                <p><?php echo $lf_add_info_text; ?></p>
                                            </div>
                                        </div><?php
                                    } 
                                }
                            }
                                
                        if ( have_rows('right_slider_sectio') ) {   
                            while ( have_rows('right_slider_sectio') ) {
                            the_row();
                                // Check the layout type 
                                if (get_row_layout() == 'slide_right_add_count') { 
                                    $right_num_add_bg_color = get_sub_field('right_num_add_bg_color');
                                    $right_slide_add_number = get_sub_field('right_slide_add_number');
                                    $right_slide_add_title = get_sub_field('right_slide_add_title');
                                    $right_add_icon_or_text = get_sub_field('right_add_icon_or_text');
                                    $right_icon_add_svg = get_sub_field('right_icon_add_svg');
                                    $right_count_add_text = get_sub_field('right_count_add_text');
                                ?>
                                    <div class="swiper-slide home-slide-banner-inner <?php echo $right_num_add_bg_color; ?>">
                                        <div class="home-slide-inner-top">
                                            <h2><?php echo $right_slide_add_number; ?></h2>
                                        </div>
                                        <div class="home-slide-inner-bottom">
                                            <h6><?php echo $right_slide_add_title; ?></h6>
                                            <?php if($right_add_icon_or_text == 'add_text'){ ?>
                                                <h2><?php echo $right_count_add_text; ?></h2>
                                            <?php } else{?>
                                            <img src="<?php echo $right_icon_add_svg['url']; ?>" alt="<?php echo $right_icon_add_svg['alt']; ?>">
                                            <?php } ?>
                                        </div>
                                    </div><?php
                                }
                                if (get_row_layout() == 'slide_right_customer_slide') { 
                                    $right_add_bg_color = get_sub_field('right_add_bg_color');
                                    $right_add_up_image = get_sub_field('right_add_up_image');
                                    $right_add_customer_count = get_sub_field('right_add_customer_count'); ?>
                                    <div class="swiper-slide home-slide-banner-inner <?php echo $right_add_bg_color; ?>">
                                        <div class="home-slide-inner-top">
                                        <img src="<?php echo $right_add_up_image['url']; ?>" alt="<?php echo $right_add_up_image['alt']; ?>">
                                        </div>
                                        <div class="home-slide-inner-bottom">
                                            <h6 class="text-right"><?php echo $right_add_customer_count; ?></h6>
                                            <?php if ( have_rows('right_add_customer_image') ) { ?>
                                                <div class="bottom-imges"><?php
                                                while ( have_rows('right_add_customer_image') ) {
                                                    the_row(); 
                                                    $right_add_customer_images = get_sub_field('right_add_customer_images'); ?>                                            
                                                    <img src="<?php echo $right_add_customer_images['url']; ?>" alt="<?php echo $right_add_customer_images['title']; ?>">
                                                <?php } ?>
                                                    <a href="javascript:void(0)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                                            <path d="M2.91108 0.111328V1.27799H6.64442L0.111084 7.81133L0.888862 8.58911L7.49997 1.97799V5.71133H8.66664V0.111328H2.91108Z" fill="white"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <?php } ?>

                                        </div>
                                    </div><?php
                                }
                                if (get_row_layout() == 'slide_right_add_graph_sec') { 
                                    $right_add_bg_color = get_sub_field('right_add_bg_color');
                                    $right_add_graph_count = get_sub_field('right_add_graph_count');
                                    $right_add_graph_image = get_sub_field('right_add_graph_image');
                                    $right_add_info_text = get_sub_field('right_add_info_text'); ?>
                                    <div class="swiper-slide home-slide-banner-inner <?php echo  $right_add_bg_color; ?>">
                                        <div class="home-slide-inner-top">
                                            <h4><?php echo $right_add_graph_count; ?></h4>
                                        <img src="<?php echo $right_add_graph_image['url']; ?>" alt="<?php echo $right_add_graph_image['alt']; ?>">
                                        </div>
                                        <div class="home-slide-inner-bottom">
                                            <p><?php echo $right_add_info_text; ?></p>
                                        </div>
                                    </div><?php
                                } 
                            }
                        } ?>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php ?>