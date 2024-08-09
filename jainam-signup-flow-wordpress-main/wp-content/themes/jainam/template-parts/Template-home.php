<?php

/**
 * Template Name: Home
 */
get_header(); 

include(locate_template('template-parts/parts/home-banner.php' ));
include(locate_template('template-parts/parts/revolution-sec.php' ));
include(locate_template('template-parts/parts/why-choose.php' )); 

$auto_fian_add_icon = get_field('auto_fian_add_icon');
$auto_fian_add_heading = get_field('auto_fian_add_heading');
$auto_fian_add_info = get_field('auto_fian_add_info');
$auto_fian_add_button = get_field('auto_fian_add_button');
$auto_fian_add_image = get_field('auto_fian_add_image'); 

$analyz_fina_add_image = get_field('analyz_fina_add_image'); 
$analyz_fina_add_icon = get_field('analyz_fina_add_icon'); 
$analyz_fina_add_title = get_field('analyz_fina_add_title'); 
$analyz_fina_add_info = get_field('analyz_fina_add_info');
$analyz_fina_add_button = get_field('analyz_fina_add_button');   ?>

<section class="finance-section">
    <div class="container">
        <?php if($auto_fian_add_icon || $auto_fian_add_heading || $auto_fian_add_info || $auto_fian_add_button || $auto_fian_add_image){ ?>
        <div class="finance-sec-inner">
            <div class="finance-inner-left">
                <div class="finance-inner-left-icon">
                   <?php if($auto_fian_add_icon){?><img src="<?php echo $auto_fian_add_icon['url']; ?>" alt="<?php echo $auto_fian_add_icon['url']; ?>"  style="width: auto; height: auto;"><?php } ?>
                </div>
                <?php if($auto_fian_add_heading){ ?><h2><?php echo $auto_fian_add_heading; ?></h2><?php } ?>
                <?php if($auto_fian_add_info){ ?><p><?php echo $auto_fian_add_info; ?></p><?php } ?>                  
                <?php if($auto_fian_add_button){ ?><a href="<?php echo $auto_fian_add_button['url']; ?>" class="btn"><?php echo $auto_fian_add_button['title']; ?></a><?php } ?> 
            </div>
            <?php if($auto_fian_add_image){ ?>
                <div class="finance-inner-right">
                    <img src="<?php echo $auto_fian_add_image['url']; ?>" alt="<?php echo $auto_fian_add_image['alt']; ?>" style="width: auto; height: auto;">
                </div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php if($analyz_fina_add_image || $analyz_fina_add_icon || $analyz_fina_add_title || $analyz_fina_add_info || $analyz_fina_add_button){ ?>
            <div class="finance-sec-inner finance-sec-inner-reverse">
                <div class="finance-inner-left">
                    <div class="finance-inner-left-icon">
                    <?php if($analyz_fina_add_icon){?><img src="<?php echo $analyz_fina_add_icon['url']; ?>" alt="<?php echo $analyz_fina_add_icon['url']; ?>"  style="width: auto; height: auto;"><?php } ?>

                    </div>
                    <?php if($analyz_fina_add_title){ ?><h2><?php echo $analyz_fina_add_title; ?></h2><?php } ?>
                    <?php if($analyz_fina_add_info){ ?><p><?php echo $analyz_fina_add_info; ?></p><?php } ?>                  
                    <?php if($analyz_fina_add_button){ ?><a href="<?php echo $analyz_fina_add_button['url']; ?>" class="btn"><?php echo $analyz_fina_add_button['title']; ?></a><?php } ?> 
                </div>
                <?php if($analyz_fina_add_image){ ?>
                <div class="finance-inner-right">
                    <img src="<?php echo $analyz_fina_add_image['url']; ?>" alt="<?php echo $analyz_fina_add_image['alt']; ?>" style="width: auto; height: auto;">
                </div>
            <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
<?php $diversify_add_title = get_field('diversify_add_title');
$diversify_add_info = get_field('diversify_add_info');
$diversify_add_button = get_field('diversify_add_button');
if($diversify_add_title || $diversify_add_info || $diversify_add_button){?>
<section class="portfolio-section" id="section5">
    <div class="container">
        <div class="portfolio-inner">
            <div class="portfolio-inner-left">
                <?php if($diversify_add_title){?><h2><?php echo $diversify_add_title; ?></h2><?php } ?>
                <?php if($diversify_add_info){?><p><?php echo $diversify_add_info; ?></p><?php } ?>
                <?php if($diversify_add_button){ ?><a href="<?php echo $diversify_add_button['url']; ?>" class="btn"><?php echo $diversify_add_button['title']; ?></a><?php } ?> 
            </div>
            <div class="portfolio-inner-right">

                <?php

                    // Check rows exists.
                    if( have_rows('portfolio_images') ):
                       
                        // Loop through rows.
                        while( have_rows('portfolio_images') ) : the_row(); 
                            // Load sub field value.
                            $diversify_image = get_sub_field('diversify_image');
                            ?>
                            <img src="<?php echo $diversify_image; ?>" alt="portfolio" class="animated-image">
                            <?php 
                            
                        // End loop.
                        endwhile;

                    // No value.
                    else :
                        ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/portfolio-1.webp" alt="portfolio" class="animated-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/portfolio-2.webp" alt="portfolio" class="animated-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/portfolio-3.webp" alt="portfolio" class="animated-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/portfolio-4.webp" alt="portfolio" class="animated-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/portfolio-5.webp" alt="portfolio" class="animated-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/portfolio-6.webp" alt="portfolio" class="animated-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/portfolio-7.webp" alt="portfolio" class="animated-image">
                <?php
                    endif;
                ?>
            </div>
        </div>
    </div>
</section>
    <script>
        document.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section');
            const section5Index = Array.from(sections).findIndex(section => section.contains(document.querySelector('.portfolio-inner-right')));
            if (section5Index === -1) return; // Section 5 not found
            let totalHeight = 0;
            for (let i = 0; i < section5Index; i++) {
                totalHeight += sections[i].offsetHeight;
            }
            const scrollPosition = window.scrollY + window.innerHeight;
            const section5Imgs = document.querySelectorAll('section:nth-of-type(' + (section5Index + 1) + ') .portfolio-inner .portfolio-inner-right img');
            section5Imgs.forEach(img => {
                if (scrollPosition >= totalHeight) {
                    img.classList.add('fade-out');
                } else {
                    img.classList.remove('fade-out');
                }
            });
        });
    </script> 
<?php } ?>
<?php
include(locate_template('template-parts/parts/trade-invest-sec.php' ));
include(locate_template('template-parts/parts/services-sec.php' ));
include(locate_template('template-parts/parts/investing-sec.php' ));
include(locate_template('template-parts/parts/award-sec.php' ));
include(locate_template('template-parts/parts/news-sec.php' ));
include(locate_template('template-parts/parts/our-user-say.php' ));
include(locate_template('template-parts/parts/open-account-toggle.php' )); ?>

<?php  get_footer(); ?>
