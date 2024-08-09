<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jainam</title>
        <?php echo wp_head(); ?>
    </head>

    <body <?php body_class();?>>
        <header class="fixed">
            <div class="old_website">
                <a href="https://jainam.in/" target="_blank"><span>Click Here for old Website</span><span><img src="<?php echo  get_stylesheet_directory_uri(); ?>/assets/img/next_arrow.svg" alt="next_arrow"></span></a>
                <div class="close_old_website">
                    <div class="container">
                    <span><img src="<?php echo  get_stylesheet_directory_uri(); ?>/assets/img/close_icon.svg" alt="close_icon"></span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="main-header d-flex justify-content-between">
                    <div class="header-left">
                        <?php $add_logo = get_field('add_logo', 'option');
                        $logo_url = isset($add_logo['url']) ? $add_logo['url'] : '';
                        $logo_alt = isset($add_logo['alt']) ? $add_logo['alt'] : '';
                        if ($logo_url) {?>
                            <div class="logo">
                                <div class="header-logo">
                                    <a href="<?php echo site_url(); ?>">
                                        <?php
                                        echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr($logo_alt) . '">'; ?>
                                    </a>
                                </div>
                            </div>
                        <?php }?>

                        <div class="header-menu ms-auto">
                            <?php
                            // Check if the repeater field 'header_mega_menu' exists and has rows of data
                            if (have_rows('header_mega_menu','option')) {
                                // Loop through the rows of data in 'header_mega_menu'
                                while (have_rows('header_mega_menu','option')) {
                                    the_row();
                                    echo "<ul>";
                                    // Check if the flexible content field 'add_hd_mega_menu' exists
                                    if (have_rows('add_hd_mega_menu','option')) {              

                                        // Loop through the flexible content layouts in 'add_hd_mega_menu'
                                        while (have_rows('add_hd_mega_menu','option')) {
                                            the_row();

                                            // Check the layout type
                                            if (get_row_layout() == 'add_herder_main_url') { 

                                                // Get sub field values from the flexible content field
                                                $add_main_menu_link = get_sub_field('add_main_menu_link');
                                                $has_submenu_or_not = get_sub_field('has_submenu_or_not');

                                                if($has_submenu_or_not == 1){
                                                echo '<li class="mega-menu-link">';?>
                                                <a href="javascript:void(0)">
                                                    <?php echo $add_main_menu_link['title']; ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                                        <path d="M1 5L5 1L9 5" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </a>
                                                <div class="mega-menu">
                                                    <div class="mega-menu-inner">
                                                        <div class="mega-menu-left">
                                                            
                                                            <?php                                                
                                                            if (have_rows('hd_add_header_menus','option')) {              

                                                                // Loop through the flexible content layouts in 'add_hd_mega_menu'
                                                                while (have_rows('hd_add_header_menus','option')) {
                                                                    the_row();
                        
                                                                    // Check the layout type
                                                                    if (get_row_layout() == 'header_menu_with_link') { 
                                                                        $hd_add_menu_heading = get_sub_field('hd_add_menu_heading'); ?>
                                                                        <div class="link_menu">
                                                                            <p><?php if($hd_add_menu_heading != ''){ echo $hd_add_menu_heading; } else{ echo "Product";} ?></p>
                                                                            <ul class="mega-menu-ul"><?php
                                                                                if (have_rows('add_submenu_links')) {              

                                                                                    // Loop through the flexible content layouts in 'add_hd_mega_menu'
                                                                                    while (have_rows('add_submenu_links')) {
                                                                                        the_row();
                                                                                        $sb_add_submenu_url_lists = get_sub_field('sb_add_submenu_url_lists');                                                                                    
                                                                                        // Output the list item with a link
                                                                                        if ($sb_add_submenu_url_lists) {
                                                                                            echo '<li><a href="' . esc_url($sb_add_submenu_url_lists['url']) . '">' . esc_html($sb_add_submenu_url_lists['title']) . '</a></li>';
                                                                                        } else {
                                                                                            echo '<li>Missing URL or title in submenu link.</li>';
                                                                                        }
                                                                                    }
                                                                                }?>
                                                                            </ul>
                                                                        </div><?php

                                                                    }
                                                                    if (get_row_layout() == 'header_menu_with_link_submenu') { 
                                                                        $hd_add_menu_heading_sub = get_sub_field('hd_add_menu_heading_sub'); ?>
                                                                        <div class="link_menu">
                                                                            <p><?php if($hd_add_menu_heading_sub != ''){ echo $hd_add_menu_heading_sub; } else{ echo "Product";} ?></p>
                                                                            <ul class="mega-menu-ul"><?php
                                                                                if (have_rows('add_submenu_links_sub')) {              

                                                                                    // Loop through the flexible content layouts in 'add_hd_mega_menu'
                                                                                    while (have_rows('add_submenu_links_sub')) {
                                                                                        the_row();
                                                                                        $menu_choose_text_or_link = get_sub_field('menu_choose_text_or_link'); 
                                                                                        $add_submenu_label = get_sub_field('add_submenu_label'); 
                                                                                        $add_submenu_label_link = get_sub_field('add_submenu_label_link');
                                                                                        if($menu_choose_text_or_link == 'text' ){ 
                                                                                            echo "<li class='hed-sub-menu-bold'>" . ($add_submenu_label) ;  }
                                                                                        else{
                                                                                            echo '<li class="hed-sub-menu-bold"><a href="' . esc_url($add_submenu_label_link['url']) . '">' . esc_html($add_submenu_label_link['title']) . '</a>'; 
                                                                                        }

                                                                                        //Output the list item with a link
                                                                                       if (have_rows('menu_hed_add_sub_links')) { 
                                                                                            echo '<ul class="sub_menu_list">';      
                                                                                           while (have_rows('menu_hed_add_sub_links')) {
                                                                                            the_row();
                                                                                                $sb_add_submenu_url_lists_sub = get_sub_field('sb_add_submenu_url_lists_sub'); 
                                                                                                if ($sb_add_submenu_url_lists_sub) {
                                                                                                    echo '<li><a href="' . esc_url($sb_add_submenu_url_lists_sub['url']) . '">' . esc_html($sb_add_submenu_url_lists_sub['title']) . '</a></li>';
                                                                                                } 
                                                                                           }
                                                                                            echo '</ul></li>';   
                                                                                       }
                                                                                    }
                                                                                }?>
                                                                            </ul>
                                                                        </div><?php

                                                                    }
                                                                    if (get_row_layout() == 'add_header_text_and_info') { 
                                                                        if (have_rows('add_heading_and_info')) {              
                                                                            echo '<div class="mega-menu-info-menu">';
                                                                            // Loop through the flexible content layouts in 'add_hd_mega_menu'
                                                                            while (have_rows('add_heading_and_info')) {
                                                                                the_row();
                                                                                
                                                                                $sb_add_link = get_sub_field('sb_add_link');
                                                                                $sb_add_heading_list = get_sub_field('sb_add_heading_list');
                                                                                $sb_add_info_sec = get_sub_field('sb_add_info_sec'); ?>
                                                                                <?php if($sb_add_heading_list || $sb_add_info_sec !=''){ ?>
                                                                                    <div>
                                                                                        <p class="mega_menu_info_menu_menu_heading"><a href="<?php echo $sb_add_link; ?>"><?php echo $sb_add_heading_list; ?></a></p>
                                                                                        <p><?php echo $sb_add_info_sec; ?></p>
                                                                                    </div><?php } ?>
                                                                                
                                                                                <?php
                                                                            } 
                                                                            echo '</div>';
                                                                        }

                                                                    }
                                                                    if (get_row_layout() == 'add_header_cta') { 
                                                                        $add_header_cta_bg_image = get_sub_field('add_header_cta_bg_image');
                                                                        $add_header_cta_side_image = get_sub_field('add_header_cta_side_image');
                                                                        $add_header_cta_text = get_sub_field('add_header_cta_text');?>
                                                                        <div class="mega-menu-content" style="background-image: url(<?php echo $add_header_cta_bg_image['url']; ?>);">
                                                                            <?php if( $add_header_cta_side_image){?>
                                                                                <img src="<?php echo $add_header_cta_side_image['url']; ?>" alt="<?php echo $add_header_cta_side_image['alt']; ?>">
                                                                            <?php } 
                                                                            if($add_header_cta_text){?><p><?php echo $add_header_cta_text; ?> </p>
                                                                            <?php } ?>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    if (get_row_layout() == 'header_cta_with_info_box') { 
                                                                        $add_cta_image_info_box = get_sub_field('add_cta_image_info_box');
                                                                        $add_label_info_box = get_sub_field('add_label_info_box');
                                                                        $add_description_info_box = get_sub_field('add_description_info_box');
                                                                        $add_link_info_box = get_sub_field('add_link_info_box');?>
                                                                        <div class="mega-menu-image-info">
                                                                            <?php if($add_cta_image_info_box){ ?>
                                                                                <div class="img-menu">
                                                                                    <img src="<?php echo $add_cta_image_info_box['url'];?>" alt="<?php echo $add_cta_image_info_box['alt'];?>">
                                                                                </div>
                                                                            <?php } ?>
                                                                            <div>
                                                                                <p class="info_head"><?php echo $add_label_info_box; ?></p>
                                                                                <p class="info_text"><?php echo $add_description_info_box; ?></p>
                                                                                <a href="<?php echo $add_link_info_box['url'];?>" class="info_link"><?php echo $add_link_info_box['title'];?>
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 17 15" fill="none">
                                                                                <path d="M15.75 7.46484L0.75 7.46484" stroke="#2A948F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                                <path d="M9.7002 1.44044L15.7502 7.46444L9.7002 13.4894" stroke="#2A948F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                                </svg></a>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                }
                                                            } ?> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                 echo '</li>';
                                                }
                                               
                                                else{
                                                    echo '<li><a href="'.$add_main_menu_link['url'].'">'.$add_main_menu_link['title'].'</a></li>';
                                                }
                                                
                                                } 
                                            }

                                        
                                        }
                                        echo "</ul>"; 
                                    }

                                } 
                            ?>                      

                            <div class="header-btns header-btns-mobile">
                                <div class="serch-btn mb-1 mb-lg-0 me-lg-1">
                                    <div class="input-group">
                                        <input type="text"  class="search-input" placeholder="Search any stocks, MF, IPOs">
                                        <a href="javascript:void(0)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                viewBox="0 0 23 23" fill="none">
                                                <g opacity="0.8">
                                                    <path
                                                        d="M16.6843 16.6844L22 22M19.3756 10.1874C19.3756 15.2616 15.2622 19.3749 10.1881 19.3749C5.11399 19.3749 1.00061 15.2616 1.00061 10.1874C1.00061 5.11332 5.11399 0.999939 10.1881 0.999939C15.2622 0.999939 19.3756 5.11332 19.3756 10.1874Z"
                                                        stroke="#141414" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </g>
                                            </svg>
                                        </a>
                                        <div class="serch-bar-header" id="serch-bar-header-1">

                                            <div class="serch-bar-inner">
                                                <div class="serch-bar-inner-tab">
                                                    <ul>
                                                        <li>
                                                            <a href="javascript:void(0)" class="tab-link" data-tab="blogs1">Blogs
                                                                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1 9L5 5L1 1" stroke="#16181D" stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" class="tab-link" data-tab="circulars1">Circulars
                                                                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1 9L5 5L1 1" stroke="#16181D" stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" class="tab-link" data-tab="articles1">News
                                                                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1 9L5 5L1 1" stroke="#16181D" stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" class="tab-link" data-tab="news1">Articles
                                                                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1 9L5 5L1 1" stroke="#16181D" stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $open_demat_account = get_field('open_demat_account', 'option');if ($open_demat_account) {?>
                                <div class="open-ac-btn">
                                    <a href="<?php echo $open_demat_account['url']; ?>" class="btn">
                                        <span><?php echo $open_demat_account['title']; ?></span>
                                    </a>
                                </div>
                                <?php }
                                $login_button = get_field('login_button', 'option');
                                if ($login_button) {?>
                                    <div class="header-login-btn">
                                        <a href="<?php echo $login_button['url']; ?>" class="btn">
                                            <span><?php echo $login_button['title']; ?></span>
                                        </a>
                                    </div>
                                <?php
                                }?>
                            </div>
                        </div>
                    </div>
                    <div class="header-btns">
                        <div class="serch-btn mb-1 mb-lg-0 me-lg-1">
                            <div class="input-group">
                                <form class="headersearch_form">
                                    <input type="search" class="search-input search-field header_custom_search" id="header_custom_search" placeholder="">
                                    <div class="headersearch_marquee" id="headersearch_marquee">
                                        <div class="track">
                                            <div class="content">&nbsp;Search any Posts, Circulars, News, Articles</div>
                                            <div class="content">&nbsp;Search any Posts, Circulars, News, Articles</div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" id="searchin_header">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                            fill="none">
                                            <g opacity="0.8">
                                                <path
                                                    d="M16.6843 16.6844L22 22M19.3756 10.1874C19.3756 15.2616 15.2622 19.3749 10.1881 19.3749C5.11399 19.3749 1.00061 15.2616 1.00061 10.1874C1.00061 5.11332 5.11399 0.999939 10.1881 0.999939C15.2622 0.999939 19.3756 5.11332 19.3756 10.1874Z"
                                                    stroke="#141414" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </g>
                                        </svg>
                                    </a>
                                    <div class="validation-message" style="display:none;" >
                                    <p id="validation_message">Type at least 4 character.</p>
                                    </div>

                                </form>
                               
                                <div class="no_result_found" style="display: none;"><p>No Result found.</p></div> 

                                <div class="serch-bar-header" id="serch-bar-header-2">   
                                    <div class="serch-bar-inner">
                                        <div class="serch-bar-inner-tab">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)" class="tab-link" data-tab="blogs2">Blogs
                                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 9L5 5L1 1" stroke="#16181D" stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="tab-link" data-tab="circulars2">Circulars
                                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 9L5 5L1 1" stroke="#16181D" stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="tab-link" data-tab="news2">News
                                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 9L5 5L1 1" stroke="#16181D" stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="tab-link" data-tab="articles2">Articles
                                                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 9L5 5L1 1" stroke="#16181D" stroke-width="1.11111" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content-serchbar">
                                                <div id="loader-search" style="display: none;"><img src="<?php echo  get_stylesheet_directory_uri(); ?>/assets/img/loader.gif" style="width: 20px;" alt="Loading..." /></div>
                                                <div id="content-blogs2" class="serch-bar-tab-content">
                                                    <?php
                                                    // Query arguments to fetch latest posts
                                                    $args = array(
                                                        'post_type'      => 'post',
                                                        'posts_per_page' => 10, // Number of posts to fetch
                                                    ); 
                                                    // Execute the query
                                                    $query = new WP_Query($args);

                                                    // Check if there are posts
                                                    if ($query->have_posts()) : 
                                                       
                                                        // Loop through the posts
                                                        while ($query->have_posts()) : $query->the_post();
                                                            // Generate the HTML structure
                                                            ?>
                                                            <div class="serch-bar-tab-content-box">
                                                                <p><a href="<?php the_permalink(); ?>" target="_blank" class="header_search_link"><?php the_title(); ?></a></p>
                                                                <span>post</span>
                                                            </div>
                                                            <?php
                                                        endwhile; 
                                                    else :
                                                        // echo '<div class="no_result_founds">No results found.</div>';
                                                    endif;

                                                    // Restore original post data
                                                    wp_reset_postdata();
                                                    ?>
                                                </div>
                                                <div id="content-circulars2" class="serch-bar-tab-content">
                                                    <div class="serch-bar-tab-content-box">
                                                        Start searching for circulars
                                                    </div>
                                                </div>
                                                <div id="content-news2" class="serch-bar-tab-content">
                                                    <div class="serch-bar-tab-content-box">
                                                       Start searching for news
                                                    </div>
                                                </div>
                                                <div id="content-articles2" class="serch-bar-tab-content">
                                                    <div class="serch-bar-tab-content-box">
                                                        Start searching for articles
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="headersearch_close_responsive">
                                <span></span>
                            </div>
                        </div>
                        <?php $open_demat_account = get_field('open_demat_account', 'option');if ($open_demat_account) {?>
                        <div class="open-ac-btn">
                            <a href="<?php echo $open_demat_account['url']; ?>" class="btn">
                                <span><?php echo $open_demat_account['title']; ?></span>
                            </a>
                        </div>
                        <?php }
                                $login_button = get_field('login_button', 'option');
                                if ($login_button) {?>
                        <div class="header-login-btn">
                            <a href="<?php echo $login_button['url']; ?>" class="btn">
                                <span><?php echo $login_button['title']; ?></span>
                            </a>
                        </div>
                        <?php }?>
                        <div class="mobile-menu">
                            <div class="burger" id="burger">
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        
           

    <script>
         document.addEventListener('DOMContentLoaded', function() {
            function setupTabs(containerId) {
                const container = document.getElementById(containerId);
                const tabs = container.querySelectorAll('.tab-link');
                const tabContents = container.querySelectorAll('.serch-bar-tab-content');

                /*tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        const target = this.dataset.tab;

                        tabs.forEach(t => t.classList.remove('active'));
                        tabContents.forEach(tc => tc.classList.remove('active'));

                        this.classList.add('active');
                        container.querySelector(`#content-${target}`).classList.add('active');
                    });
                });*/
            }

            setupTabs('serch-bar-header-1');
            setupTabs('serch-bar-header-2');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchInputs = document.querySelectorAll('.search-input');

            /*searchInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const serchBarHeader = input.closest('.input-group').querySelector('.serch-bar-header');
                    if (input.value.trim() !== "") {
                        serchBarHeader.style.display = 'block';
                    } else {
                        serchBarHeader.style.display = 'none';
                    }
                });
            });*/
        });

    </script>
    <script>

        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("header_custom_search");
            const marquee = document.getElementById("headersearch_marquee");
            const searchBarHeader = document.getElementById("serch-bar-header-2");
            marquee.addEventListener("click", function(event) {
                marquee.classList.add("hidden");
                searchBarHeader.classList.add("serch-bar-menu");
                searchInput.focus();  
                event.stopPropagation();  
            });

            searchInput.addEventListener("click", function(event) {
                marquee.classList.add("hidden");
                searchBarHeader.classList.add("serch-bar-menu");
                //searchBarHeader.classList.add("show");
                //event.stopPropagation(); 
            });

            document.addEventListener("click", function(event) {
                if (!searchInput.contains(event.target) && !marquee.contains(event.target) && !searchBarHeader.contains(event.target)) {
                    marquee.classList.remove("hidden");
                    searchBarHeader.classList.remove("serch-bar-menu");
                    //searchBarHeader.classList.remove("show");
                }
            });
        });
        
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#searchin_header').click(function(event) {
                event.stopPropagation(); 
                $('.serch-btn').addClass('active');
            });
            $(document).click(function(event) {
                if (!$(event.target).closest('.serch-btn, #searchin_header, #header_custom_search, #headersearch_marquee').length) {
                    $('.serch-btn').removeClass('active');
                }
            });
        });

        jQuery(document).ready(function() {
            jQuery('.header-menu ul li').hover(
                function() {
                    $('#serch-bar-header-2').hide();
                }
            );
        });

        $(document).ready(function(){
            $(".headersearch_close_responsive").click(function(){
                $(".serch-btn").removeClass("active");
                $("#serch-bar-header-2").css("display", "none");
            });
        });


        $(document).ready(function() {
            function adjustPaddingTop() {
                var firstElement = $('header').nextAll('main, section, div').first();
                var isOldWebsiteDisplayed = $('.old_website').css('display') === 'block';
                var windowWidth = $(window).width();

                if (windowWidth <= 576) {
                    if (isOldWebsiteDisplayed) {
                        firstElement.css('padding-top', '105px');
                    } else {
                        firstElement.css('padding-top', '75px');
                    }
                } else {
                    if (isOldWebsiteDisplayed) {
                        firstElement.css('padding-top', '115px');
                    } else {
                        firstElement.css('padding-top', '88px');
                    }
                }
            }

            adjustPaddingTop();

            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'style') {
                        adjustPaddingTop();
                    }
                });
            });

            observer.observe(document.querySelector('.old_website'), {
                attributes: true,
                attributeFilter: ['style']
            });

            $(window).resize(function() {
                adjustPaddingTop();
            });
        });


    $(document).ready(function() {
        function applyMegaMenuBehavior() {
            $('.header-menu .mega-menu-link').off('click');
            $('.overlay').off('click');

            if (window.matchMedia("(max-width: 991px)").matches) {
                $('.header-menu .mega-menu-link').on('click', function() {
                    var $this = $(this);

                    if ($this.hasClass('active')) {
                        $this.removeClass('active');
                    } else {
                        $('.header-menu .mega-menu-link').removeClass('active');
                        $this.addClass('active');
                    }

                    $('.header-menu').animate({
                        scrollTop: 0
                    }, 500);
                });

                $('.header-menu .mega-menu-link').hover(
                    function() {},
                    function() {}
                );

                $('.overlay').on('click', function() {
                    $('.header-menu .mega-menu-link').removeClass('active');
                });
            } else {
                $('.header-menu .mega-menu-link').off('click');
                $('.header-menu .mega-menu-link').off('hover');
                $('.overlay').off('click');
            }
        }

        applyMegaMenuBehavior();

        $(window).resize(function() {
            applyMegaMenuBehavior();
        });
    });



    </script>