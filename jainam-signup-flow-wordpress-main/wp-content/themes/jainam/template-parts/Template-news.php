<?php

/**
 * Template Name: News
 */
get_header(); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/circulars-page.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/comman-modal.css">
<?php
global $post;

// Get the content with the_content filters applied
$content = apply_filters('the_content', get_the_content());

// Remove <p> tags
$content = strip_tags($content, '<a><b><i><strong><em><ul><ol><li>');

?>

<main class="news-page">
        <section class="comman_banner-section">
            <div class="container">
                <div class='banner_content'>
                    <h1 class="banner_title"><?php echo get_the_title(); ?></h1>
                    <p class="banner_title_content"><?php echo $content; ?></p>
                </div>
            </div>
        </section>

    <!-- News Information Content-->
    <section class="news-info-sec comman_tabs-sec">
        <div class="container">
            <div class="news-info-title">
                
                    <ul class="news_categories">
                        <li>
                            <a href="javascript:void(0)" class="active" id="insta_news" >Insta News</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" id="articles">Articles</a>
                        </li>
                    </ul>
                

                <div class="news-search">
                    <form class="search-form search_instaform">
                        <div class="input-group">
                            <input type="search" class="search-field" placeholder="Search in News" id="search_instanews" required>
                            <button class="btn_serch" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                    <g opacity="0.8">
                                        <path d="M16.6843 16.6844L22 22M19.3756 10.1874C19.3756 15.2616 15.2622 19.3749 10.1881 19.3749C5.11399 19.3749 1.00061 15.2616 1.00061 10.1874C1.00061 5.11332 5.11399 0.999939 10.1881 0.999939C15.2622 0.999939 19.3756 5.11332 19.3756 10.1874Z" stroke="#141414" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <form class="search-form search_articlesform" style="display: none;">
                        <div class="input-group">
                            <input type="search" class="search-field" placeholder="Search in Articles" id="search_articles" required>
                            <button class="btn_serch" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                    <g opacity="0.8">
                                        <path d="M16.6843 16.6844L22 22M19.3756 10.1874C19.3756 15.2616 15.2622 19.3749 10.1881 19.3749C5.11399 19.3749 1.00061 15.2616 1.00061 10.1874C1.00061 5.11332 5.11399 0.999939 10.1881 0.999939C15.2622 0.999939 19.3756 5.11332 19.3756 10.1874Z" stroke="#141414" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="insta_news_api_categories">
                <?php echo do_shortcode('[redbox_news_categories]'); ?>
            </div>
            <div class="articles_api_categories" style="display:none">
                <?php echo do_shortcode('[article_categories]'); ?>
            </div>
            
            <div class='glossary_info'>

                <div class="glossary-left redbox_news_section custompaginationscroll">
                
                <?php echo do_shortcode('[redbox_news]'); ?>
                </div>
                <div class="glossary-right">
                    <?php 
                    include(locate_template('template-parts/parts/open-free-account-number-glossary.php' )); ?>
                </div>
            </div>  
        </div>
    </section>

    <div class="comman_modal">
            <div class="custom-model-main">
                <div class="custom-model-inner">        
                    <div class="popup-inner custom-model-wrap">
                        <div class="close-btn"><img src="https://dev.artoonsolutions.com/jainam-signup-flow-wordpress/wp-content/themes/jainam/assets/img/modal_colse_btn.svg" alt="modal_colse_btn"></div>
                        <?php

                        $popup_title = get_field('popup_title');
                        $popup_description = get_field('popup_description');

                        ?>
                        <?php if($popup_title){
                            echo'<h4>'.$popup_title.'</h4>';
                        }else{
                            echo'<h4>Disclaimer</h4>';
                        }
                        ?>
                        <?php if($popup_description){
                            echo'<p>'.$popup_description.'</p>';
                        }else{
                            echo'<p>Jainam Broking Limited is using the services of a professional vendor for providing news. Any person using this news is required to do his own analysis before making any investment decision. Jainam is not responsible for the accuracy of news provided by the professional vendor.</p>';
                        }
                        ?>

                        <ul>
                            <li>
                                <a href="javascript:void(0)" id="shareTelegram" target="_blank">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/telegram.svg" alt="telegram-icon">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="shareTwitter" target="_blank">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/twitter.svg" alt="twitter-icon">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="shareWhatsapp" target="_blank">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/whatsapp.svg" alt="whatsapp-icon">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="shareFacebook" target="_blank">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fb.svg" alt="fb-icon">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="shareEmail" target="_blank">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/mail-2.svg" alt="mail-icon">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" id="shareInstagram" target="_blank">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/insta.svg" alt="insta-icon">
                                </a>
                            </li>
                        </ul>    
                    </div>  
                </div>  
                <div class="bg-overlay"></div>
            </div>             
        </div>

    <?php
        include(locate_template('template-parts/parts/zero-brokerage-sec.php' ));
    ?>  
    </main>

<?php  get_footer(); ?>
