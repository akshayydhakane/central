<?php

/**
 * Template Name: Investor Charter
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/comman-modal.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css.map" />

<?php
global $post; 
// Get the content with the_content filters applied
$content = apply_filters('the_content', get_the_content());

// Remove <p> tags
$content = strip_tags($content, '<a><b><i><strong><em><ul><ol><li>');
?>
<main class="holiday-page <?php echo $post->post_name; ?>"> 
        <section class="comman_banner-section">
            <div class="container">
                <h1 class="banner_title"><?php echo get_the_title(); ?></h1>
                <p class="banner_title_content"><?php echo $content; ?></p>
            </div>
        </section>

        <section class="comman_tabs-sec">
            <div class="container">
                <div class="tab_div">
                        <ul class="comm_tabing">
                            <?php

                                $obj_id = get_queried_object_id();
                                $current_url = get_permalink( $obj_id );
                                // Check rows exists.
                                if( have_rows('tab_list') ):

                                    // Loop through rows.
                                    while( have_rows('tab_list') ) : the_row();

                                        // Load sub field value.
                                        $tabs = get_sub_field('tabs');
                                        $tab_link = get_sub_field('tab_link');
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

                    <?php
                        $button_name_for_open_popup = get_field('button_name_for_open_popup');

                        // Check if rows exist.
                        if (have_rows('button_area')) :

                            // Loop through rows.
                            while (have_rows('button_area')) : the_row(); ?>
                                <div class="charter_list">
                                    <?php
                                    // Load sub field value.
                                    $buttons_heading = get_sub_field('buttons_heading'); ?>

                                    <?php if($post->post_name == 'disclosures'){ ?>
                                    <div class="title date_drop_down">
                                        <?php if ($buttons_heading) { ?>
                                            <h2><?php echo $buttons_heading; ?></h2>
                                        <?php } ?>

                                        <?php if (is_page(3016)) { ?>
                                            <div class="form_date">
                                                <select name="year_filter" id="year_filter" class="year_filter form_control">
                                                    <?php

                                                    // Check if rows exist.
                                                    if (have_rows('year_filter')) :

                                                        // Loop through rows.
                                                        while (have_rows('year_filter')) : the_row();

                                                            // Load sub field value.
                                                            $add_year = get_sub_field('add_year'); ?>
                                                            <option value="<?php echo $add_year; ?>"><?php echo $add_year; ?></option>
                                                    <?php
                                                        // End loop.
                                                        endwhile;

                                                    // No value.
                                                    else :
                                                        // Do something...
                                                    endif;

                                                    ?>
                                                </select>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                    <ul>
                                        <?php
                                        // Check if rows exist.
                                        if (have_rows('buttons')) :

                                            // Loop through rows.
                                            while (have_rows('buttons')) : the_row();

                                                // Load sub field value.
                                                $button_name = get_sub_field('button_name');
                                                $button_url = get_sub_field('button_url');
                                                $upload_file = get_sub_field('upload_file');
                                                $data_year = get_sub_field('data_year');

                                                if ($button_url == "") {
                                                    $button_link = get_sub_field('upload_file');
                                                    $target = "_blank";
                                                }
                                                if ($button_url != "") {
                                                    $button_link = get_sub_field('button_url');
                                                    $target = "_blank";
                                                }
                                                if ($button_url == "" && $upload_file == "") {
                                                    $button_link = "javascript:void(0)";
                                                    $target = "_self";
                                                }
                                                // Add the class only to the specific button name.
                                                $add_popup_class = ($button_name == $button_name_for_open_popup) ? 'click-social-modal' : ''; ?>

                                                <li data-year="<?php echo $data_year; ?>"><a href="<?php echo $button_link; ?>" class="charter_cart <?php echo $add_popup_class; ?>" target="<?php echo $target; ?>"><?php echo $button_name; ?></a></li>
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
                        <?php
                            // End loop.
                            endwhile;

                        // No value.
                        else :
                            // Do something...
                        endif;
                        ?>

            </div>
        </section>
        <div class="comman_modal">
            <div class="custom-model-main">
                <div class="custom-model-inner">        
                    <div class="custom-model-wrap">
                        <div class="close-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/modal_colse_btn.svg" alt="modal_colse_btn"></div>
                        <div class="social_media_platform">
                            <ul>
                                <?php
                                        // Check rows exists.
                                        if( have_rows('popup_section') ):

                                            // Loop through rows.
                                            while( have_rows('popup_section') ) : the_row();

                                                // Load sub field value.
                                                $social_icon = get_sub_field('social_icon');
                                                $link = get_sub_field('link');
                                                $social_icon_name = get_sub_field('social_icon_name');
                                                ?>
                                                
                                                <li>
                                                    <a href="<?php echo $link; ?>" class="socal_cart" target="_blank">
                                                        <img src="<?php echo esc_url($social_icon['url']); ?>" alt="<?php echo esc_url($social_icon['alt']); ?>"> <?php echo $social_icon_name; ?>
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
                <div class="bg-overlay"></div>
            </div>             
        </div>
        <?php
            include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
        ?>    
</main>

<script type="text/javascript">

  $(document).ready(function() {
    $(".click-social-modal").on('click', function() {
        $(".custom-model-main").addClass('model-open');
        $("body").addClass('overflow');  // Add 'overflow' class to body
    });

    $(".close-btn, .bg-overlay").on('click', function() {
        $(".custom-model-main").removeClass('model-open');
        $("body").removeClass('overflow');  // Remove 'overflow' class from body
    });
});

</script>   
<?php  get_footer(); ?>
