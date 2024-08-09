<?php

/**
 * Template Name: pricing
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/comman-modal.css" />

<?php
global $post; 
$banner_heading = get_field('banner_heading');
$banner_description = get_field('banner_description');
?>
<main class="holiday-page <?php echo $post->post_name; ?>"> 

    <section class="comman_banner-section">
        <div class="container">
            <?php if($banner_heading){ ?><h1 class="banner_title text_center"><?php echo $banner_heading; ?> </h1><?php } ?>
            <?php if($banner_description){ ?><p class="banner_title_content text_center"><?php echo $banner_description; ?></p><?php } ?>
        </div>
    </section> 

     <section class="best_plan_cart">
        <div class="container">
            <div class="all_plan_cart">

                <?php

                // Check rows exists.
                if( have_rows('types_of_plan') ):
                    $count = 1;
                    // Loop through rows.
                    while( have_rows('types_of_plan') ) : the_row();

                        // Load sub field value.
                        $plan_icon = get_sub_field('plan_icon');
                        $plan_name = get_sub_field('plan_name');
                        $plan_sub_name = get_sub_field('plan_sub_name');
                        $plan_description = get_sub_field('plan_description');

                        $button_name = get_sub_field('button_name');
                        $button_link = get_sub_field('button_link');

                        if($count == 2){
                            $add_class = 'active';
                        }else{
                            $add_class = '';
                        }

                        if($count == 3){
                            $add_mclass = 'click-partner-modal';
                            $add_unique = 'customize_plan';
                        }else{
                            $add_mclass = '';
                            $add_unique = '';
                        }
                        
                        ?>

                        <div class="plan_cart <?php echo $add_class; ?> <?php echo $add_unique; ?>">
                            <div class="title_icon">
                                <?php if($plan_name){ ?><h2><?php echo $plan_name; ?></h2><?php } ?>
                                <div class="cart-icon">
                                    <?php if($plan_icon) { ?>

                                        <img src="<?php echo $plan_icon; ?>" alt="pricing-icon">

                                    <?php }else { ?>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/pricing-plan-icon1.svg" alt="pricing-icon">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="brokerage_info">

                                <?php if($plan_sub_name){ ?><h3><?php echo $plan_sub_name; ?><span><?php if($plan_description){ ?><?php echo $plan_description; ?><?php } ?></span></h3><?php } ?>
                                
                               <?php if($count != 3){ ?> <ul> <?php } ?>
                                    <?php

                                        // Check rows exists.
                                        if( have_rows('equity_delivery_points') ):

                                            // Loop through rows.
                                            while( have_rows('equity_delivery_points') ) : the_row();

                                                // Load sub field value.
                                                $point_title = get_sub_field('point_title');
                                                ?>
                                                    <?php if($point_title){ ?>
                                                        <?php if($count == 3){ ?>
                                                            <p><?php echo $point_title; ?></p>
                                                        <?php
                                                        }else{ ?>
                                                            <li><?php echo $point_title; ?></li>
                                                        <?php
                                                        }
                                                        ?>
                                                        
                                                    <?php } ?>
                                                <?php

                                            // End loop.
                                            endwhile;

                                        // No value.
                                        else :
                                            // Do something...
                                        endif;
                                    ?>
                                <?php if($count != 3){ ?> </ul> <?php } ?>
                            </div>
                            <div class="brokerage_info amount_info">
                                <ul>
                                    <?php

                                        // Check rows exists.
                                        if( have_rows('zero_api_points') ):

                                            // Loop through rows.
                                            while( have_rows('zero_api_points') ) : the_row();

                                                // Load sub field value.
                                                $point_name = get_sub_field('point_name');
                                                ?>
                                                    <?php if($point_name){ ?><li><?php echo $point_name; ?></li><?php } ?>
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
                            <div class="open-ac-btn">
                                <?php if($button_name){ ?><a href="<?php echo $button_link['url']; ?>" class="btn <?php echo $add_mclass; ?>"><span><?php echo $button_name; ?></span></a><?php } ?>
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
     </section>

     <?php
        $comparison_points_heading = get_field('comparison_points_heading');
     ?>

    <section class="comman_tabs-sec">
        <div class="container">
            <?php if($comparison_points_heading) { ?><h2 class="title"><?php echo $comparison_points_heading; ?></h2><?php } ?>
            <div class="commn_table pricing_comparison_table">
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
    </section>
<?php
    $details_of_transaction_heading = get_field('details_of_transaction_heading');
?>
    <section class="comman_tabs-sec details_of_transaction">
        <div class="container">
            <?php if($details_of_transaction_heading) { ?><h2 class="title"><?php echo $details_of_transaction_heading; ?></h2><?php } ?>
            <div class="tab_div">
                <ul class="comm_tabing" id="tabs"> 
                    <?php
                            // Check rows exists.
                            if( have_rows('tab_list') ):
                                $count = 1;
                                // Loop through rows.
                                while( have_rows('tab_list') ) : the_row();
                                    // Load sub field value.
                                    $tab_name = get_sub_field('name_of_tab');
                                    if($count == 1){
                                        $add_class="active";
                                    }else{
                                        $add_class="";
                                    }
                                    ?>
                                    <li class="<?php echo $add_class; ?>">
                                        <a href="javascript:void(0)" id="tab<?php echo $count; ?>" class="btn_tab"><?php echo $tab_name; ?></a> 
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
                    <div class="commn_table"> 
                        <table>
                            <thead>
                                <tr>
                                    <?php while( have_rows('equity_table_headers') ): the_row(); ?>
                                        <th><?php echo esc_html(get_sub_field('header')); ?></th>
                                    <?php endwhile; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while( have_rows('equity_table_rows') ): the_row(); ?>
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

                <div id="tab2c">
                    <div class="commn_table">
                        <table>
                            <thead>
                                <tr>
                                    <?php while( have_rows('currency_table_headers') ): the_row(); ?>
                                        <th><?php echo esc_html(get_sub_field('header')); ?></th>
                                    <?php endwhile; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while( have_rows('currency_table_rows') ): the_row(); ?>
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
                <div id="tab3c">
                    <div class="commn_table">
                        <table>
                            <thead>
                                <tr>
                                    <?php while( have_rows('commodity_table_headers') ): the_row(); ?>
                                        <th><?php echo esc_html(get_sub_field('header')); ?></th>
                                    <?php endwhile; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while( have_rows('commodity_table_rows') ): the_row(); ?>
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
    </section>
    <div class="comman_modal partner-form-modal">
        <div class="custom-model-main">
            <div class="custom-model-inner">        
                <div class="custom-model-wrap">
                    <div class="close-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/modal_colse_btn.svg" alt="modal_colse_btn"></div>
                    <div class="partner-form">
                        <h3>Request a Call</h3>
                        <?php echo do_shortcode('[contact-form-7 id="679dcc3" title="Pricing"]'); ?>
                    </div>
                </div>  
            </div>  
            <div class="bg-overlay"></div>
        </div>             
    </div>
    <?php
        include(locate_template('template-parts/parts/faq.php' ));
        include(locate_template('template-parts/parts/faq-desclaimer-ques.php' )); 
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));  
    ?> 
</main>

<?php  get_footer(); ?> 
