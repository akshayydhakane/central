<?php

/**
 * Template Name: Share Market Holiday
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/market-holiday.css.map" />
<style>
.commn_table table tr.highlight {
    background: #d7f4f2;
}
</style> 
<?php
global $post; 

if($post->post_name == 'mcx-holidays'){
    $main_class="mcx-holiday";
}
if($post->post_name == 'nse-holidays'){
    $main_class="nse-holiday";
}
if($post->post_name == 'bse-holidays'){
    $main_class="bse-holiday";
}
if($post->post_name == 'settlement-or-clearing-holidays'){
    $main_class="settlement-or-clearing-holiday";
}
if($post->post_name == 'us-market-holidays'){
    $main_class="us-market-holiday";
}
if($post->post_name == 'muhurat-trading'){
    $main_class="muhurat-trading";
}
?>
<main class="holiday-page <?php echo $main_class; ?>"> 

        <?php 
            if( have_rows('share_market_holiday_section') ):
                while( have_rows('share_market_holiday_section') ): the_row();
                   
                  
                   if( get_row_layout() == 'holiday_timing' ){
                        $holiday_timing_title = get_sub_field('holiday_timing_title');
                        $holiday_timing_description = get_sub_field('holiday_timing_description');
                   }
        ?>

        <?php

            if( get_row_layout() == 'banner_section' ){ 
                $banner_title = get_sub_field('banner_title');
                $banner_description = get_sub_field('banner_description'); 
                ?>
                <section class="comman_banner-section">

                    <div class="container">
                        <?php if($banner_title){ ?><h1 class="banner_title"><?php echo $banner_title; ?></h1><?php } ?>
                        <?php if($banner_description){ ?><p class="banner_title_content"><?php echo $banner_description; ?></p><?php } ?>
                    </div>

                </section>
                <?php
            }
        ?>

        <?php
            if( get_row_layout() == 'holiday_2024' ){
                $holiday_title = get_sub_field('holiday_title');
                $list_of_holidays_title = get_sub_field('list_of_holidays_title');
                $list_of_holidays_decription = get_sub_field('list_of_holidays_decription');
                $below_table_description = get_sub_field('below_table_description');  
        ?>
        <section class="comman_tabs-sec">
            <div class="container">
                <?php if($holiday_title){ ?><h3 class="title"><?php echo $holiday_title; ?></h3><?php } ?>
                <div class="tab_div">
                <ul class="comm_tabing">
                    <?php

                        $obj_id = get_queried_object_id();
                        $current_url = get_permalink( $obj_id );
                        // Check rows exists.
                        if( have_rows('holiday_tabs') ):

                            // Loop through rows.
                            while( have_rows('holiday_tabs') ) : the_row();

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

                <?php if($list_of_holidays_title){ ?><h2 class="title"><?php echo $list_of_holidays_title; ?></h2><?php } ?>
                <?php if($list_of_holidays_decription){ ?><div class="list_of_holidays_decription"><?php echo $list_of_holidays_decription; ?></div><?php } ?>
                
                <div class="commn_table">
                    <table>
                        <thead>
                            <tr>
                                <?php while( have_rows('table_headers') ): the_row(); ?>
                                    <th><?php echo esc_html(get_sub_field('header')); ?></th>
                                <?php endwhile; ?>
                            </tr>
                        </thead>
                        <tbody id="holiday-table">
                            <?php while( have_rows('table_rows') ): the_row(); ?>
                                <tr>
                                    <?php if( have_rows('row_data') ): ?>
                                        <?php while( have_rows('row_data') ): the_row(); ?>
                                            <td><?php echo esc_html(get_sub_field('data')); ?></td>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                 <?php if($below_table_description){ ?><div class="below_table_description"><?php echo $below_table_description; ?></div><?php } ?> 

            </div>
        </section>
        <?php
        }
        ?>
        <?php
            if( get_row_layout() == 'add_notes' ){
                $notes = get_sub_field('notes');
            }
            if($notes){
                echo '<div class="extra_notes">'.$notes.'</div>'; 
            }
        ?>

        <?php
        if( get_row_layout() == 'holiday_timing' ){
            $market_title = get_sub_field('market_title'); 
            $circulars_name = get_sub_field('circulars_name');
            $market_description = get_sub_field('market_description');
            $holiday_timing_title = get_sub_field('holiday_timing_title'); 
            $holiday_timing_description = get_sub_field('holiday_timing_description');
       ?>
            <section class="details_of_market-relete">
                <div class="container">

                    <?php if($market_title){ ?><h4 class="market_title"><?php echo $market_title;?><span> (<?php echo $circulars_name; ?>)</span></h4><?php } ?>
                    <?php if($market_description){ ?><p class="market_content"><?php echo $market_description; ?></p><?php } ?> 

                    <?php if($holiday_timing_title){ ?>   
                    <div class="market-info">

                        <?php if($holiday_timing_title){ ?><h2 class="title"><?php echo $holiday_timing_title; ?></h2><?php } ?>
                        <?php if($holiday_timing_description){ ?><p class="market_content"><?php echo $holiday_timing_description; ?></p><?php } ?>
                        <?php
                        // Check rows exists.
                        if( have_rows('content') ):

                            // Loop through rows.
                            while( have_rows('content') ) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $description = get_sub_field('description');
                                $notes = get_sub_field('notes');
                                // Do something, but make sure you escape the value if outputting directly...
                                ?>

                                <div class="market_session">
                                    <?php if($title){?><h3><?php echo $title; ?></h3><?php }?>
                                    <?php if($description){ echo $description; }?>
                                </div>
                                <?php if($notes){?><p class="market_content">*<?php echo $notes; ?></p><?php }?>
                                <?php
                            // End loop.
                            endwhile;

                        // No value.
                        else :
                            // Do something...
                        endif; 
                            ?>
                    </div>
                <?php } ?>
                </div>
            </section>
        <?php
        }
        ?>
        <?php
        if( get_row_layout() == 'mcx_holiday' ){
       ?>
        <section class="mcx_holidaypage">
            <div class="container">
                    <?php
                        // Check rows exists.
                        if( have_rows('title_of_mcx_holiday') ):

                            // Loop through rows.
                            while( have_rows('title_of_mcx_holiday') ) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $content = get_sub_field('content');
                                ?>

                                <div class="market_session"> 
                                    <?php if($title){?><h3 class="market_title"><?php echo $title; ?></h3><?php }?>
                                    <?php if($content){ ?><p class="market_content"><?php echo $content;?></p><?php }?>
                                </div>
                                
                                <?php
                            // End loop.
                            endwhile;

                        // No value.
                        else :
                            // Do something...
                        endif; 
                    ?>
                    <div class="commn_table">
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
                                                <td><?php echo esc_html(get_sub_field('data')); ?></td>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>  

                    <?php
                        // Check rows exists.
                        if( have_rows('table_below_content') ):

                            // Loop through rows.
                            while( have_rows('table_below_content') ) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $content = get_sub_field('content');
                                ?>

                                <div class="market_session"> 
                                    <?php if($title){?><h3 class="market_title"><?php echo $title; ?></h3><?php }?>
                                    <?php if($content){ ?><p class="market_content"><?php echo $content;?></p><?php }?>
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
        <?php 
        } 
        ?>
    <?php 
            endwhile;
            endif; 
    ?>   

    <?php
        include(locate_template('template-parts/parts/blog-sec-holiday.php' ));
        include(locate_template('template-parts/parts/faq.php' )); 
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?>     
    </main>

    


<?php  get_footer(); ?>
