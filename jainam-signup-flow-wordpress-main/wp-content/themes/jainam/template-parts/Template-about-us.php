<?php

/**
 * Template Name: About Us
 */
get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/about-us.css.map" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/slick.css" />
<?php
global $post; 

$banner_title = get_field('banner_title');
$banner_description = get_field('banner_description');

$image = get_field('image');
$mission_title = get_field('mission_title');
$mission_description = get_field('mission_description');

$co_founder_image = get_field('co_founder_image');
$social_icon_image = get_field('social_icon_image');
$success_title = get_field('success_title');
$success_description = get_field('success_description');

$our_journey_heading = get_field('our_journey_heading');
$view_full_journey_button = get_field('view_full_journey_button');

$culture_title = get_field('culture_title');
$culture_description = get_field('culture_description');
$join_us_button = get_field('join_us_button');
$join_button_link = get_field('join_button_link');
$culture_image = get_field('culture_image');


?>


    <main class="abous-page <?php echo $post->post_name; ?>"> 
        <section class="about-banner-section">
            <div class="container">
                <?php if ($banner_description) : ?>
                <p class="banner_title_content"><?php echo $banner_description; ?></p>
                <?php else : ?>
                <p class="banner_title_content">We are building Jainam - to empower your investments and secure your financial future. </p>
                <?php endif; ?>

                
                <?php if ($banner_title) : ?>
                <h1 class="banner_title"><?php echo $banner_title; ?></h1>
                <?php else : ?>
                <h1 class="banner_title">It’s Our <span class="main__word" id="typed"></span></h1>
                <?php endif; ?>
                
            </div>
        </section>
        <section class="our-mission-about">
            <div class="container">
                <div class="our-mission-about-inner">
                    <div class="our-mission-about-inner-left">
                        <?php if ($mission_title) : ?>
                        <h2><?php echo $mission_title; ?></h2>
                        <?php else : ?>
                        <h2>Our mission is to give prosperity with security</h2>
                        <?php endif; ?>
                        

                        <?php if ($mission_description) : ?>
                        <p><?php echo $mission_description; ?></p>
                        <?php else : ?>
                        <p>We are focusing on upgrade our all technologies and keep learning , keep growing also we ensure that all your information remains fully encrypted and secure.</p>
                        <?php endif; ?>  
                    </div>
                    <div class="our-mission-about-inner-right">
                        <?php if ($image) : ?>
                        <img src="<?php echo $image; ?>" alt="our-mission-about-us">
                        <?php else : ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/our-mission-about-us.webp" alt="our-mission-about-us">
                        <?php endif; ?> 
                    </div>
                </div>
            </div>
        </section>
        <section class="our-success-about">
            <div class="container">
                <div class="our-success-about-inner">
                    <div class="our-success-about-inner-left">
                        <?php if ($co_founder_image) : ?>
                        <img src="<?php echo $co_founder_image; ?>" alt="founder">
                        <?php else : ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/our-success-about-us.webp" alt="our-success-about-us">
                        <?php endif; ?>   
                    </div> 
                    <div class="our-success-about-inner-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <g clip-path="url(#clip0_5724_17473)">
                            <path d="M24 47.9995C37.2548 47.9995 48 37.2543 48 23.9995C48 10.7447 37.2548 -0.000488281 24 -0.000488281C10.7452 -0.000488281 0 10.7447 0 23.9995C0 37.2543 10.7452 47.9995 24 47.9995Z" fill="#007AB9"/>
                            <path d="M38.3395 25.9308V35.8255H32.6029V26.5939C32.6029 24.276 31.7746 22.693 29.6975 22.693C28.1124 22.693 27.1708 23.7587 26.755 24.7906C26.6039 25.1594 26.565 25.6715 26.565 26.1888V35.8251H20.8279C20.8279 35.8251 20.9049 20.1898 20.8279 18.5714H26.5654V21.0164C26.5539 21.0357 26.5376 21.0545 26.5273 21.0729H26.5654V21.0164C27.3278 19.8433 28.6874 18.1662 31.7357 18.1662C35.5099 18.1662 38.3395 20.6322 38.3395 25.9308ZM14.8264 10.2545C12.864 10.2545 11.5801 11.5427 11.5801 13.2352C11.5801 14.8917 12.8268 16.2171 14.7511 16.2171H14.7883C16.7892 16.2171 18.0334 14.8917 18.0334 13.2352C17.9953 11.5427 16.7892 10.2545 14.8264 10.2545ZM11.9211 35.8255H17.656V18.5714H11.9211V35.8255Z" fill="#F1F2F2"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_5724_17473">
                            <rect width="48" height="48" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <?php if ($success_title) : ?>
                        <h2><?php echo $success_title; ?></h2>
                        <?php else : ?>
                        <h2>A Journey of Success: Our <span>Co-Founder</span> Milan Parikh’s Story</h2>
                        <?php endif; ?>

                        <?php if ($success_description) : ?>
                        <p><?php echo $success_description; ?></p>
                        <?php else : ?>
                        <p>Milan Parikh is a strong headed personality with an extensive knowledge of business. He has an experience of more than three decades in the Stock Market. Milan Parikh, the founder director of the company is known for his positive attitude and exemplary nature on which the success of the company rests. In his current role, Milan is the chief strategist with overall management and control of obligations with the exchanges relating to funds and securities. He started his career as an investor and trader and continued his business as a Sub-broker for more than 10 years under the name of ‘Jinalaya Investments’ and has till date been appointed as panelist on various benches.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </section>

    <?php 
        include(locate_template('template-parts/parts/revolution-about-sec.php' )); 
    ?>   

    <section class="our-journey-section">
        <div class="container">
            
            <?php if ($our_journey_heading) : ?>
            <h2><?php echo $our_journey_heading; ?></h2>
            <?php else : ?>
            <h2>Our Journey</h2>
            <?php endif; ?> 

            <div class="our-journey-inner">

                <?php
                // Check rows exists.
                if( have_rows('timeline_details') ):

                    // Loop through rows.
                    while( have_rows('timeline_details') ) : the_row();

                        // Load sub field value.
                        $image = get_sub_field('image');
                        $year = get_sub_field('year');
                        $description = get_sub_field('description');
                        ?>
                        <div class="our-journey-inner-box">
                            <div class="our-journey-inner-img">
                                <?php if ($image) : ?>
                                <img src="<?php echo $image; ?>" alt="our-journey">
                                <?php else : ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/our-journey-1.webp" alt="our-journey">
                                <?php endif; ?> 
                            </div>
                            <div class="our-journey-inner-content">
                                <?php if ($year) : ?>
                                <h4><?php echo $year; ?></h4>
                                <?php else : ?>
                                <h4>2024</h4>
                                <?php endif; ?> 

                                <?php if ($description) : ?>
                                <p><?php echo $description; ?></p>
                                <?php else : ?>
                                <p>Achieved Highest SIP in Surat and received an award from UTI MF for this achievement</p>
                                <?php endif; ?>   
                            </div>
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
            <div class="view-journey-btn">

                <?php if ($view_full_journey_button) : ?>
                <a href="javascript:void(0);" class="btn"><?php echo $view_full_journey_button; ?></a>
                <?php else : ?>
                <a href="javascript:void(0);" class="btn">View Full Journey</a>
                <?php endif; ?> 
                
            </div>
        </div>
    </section>
    <?php
        include(locate_template('template-parts/parts/award-about-sec.php' )); 
    ?>  

    <section class="be-different-section">
        <div class="container">
            <div class="be-different-inner">
                <div class="be-different-inner-bg">
                    
                    <?php if ($culture_image) : ?>
                    <img src="<?php echo $culture_image; ?>" alt="our-journey">
                    <?php else : ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/be-different-bg.webp" alt="be different">
                    <?php endif; ?> 
                </div>
                
                <?php if ($culture_title) : ?>
                <h2><?php echo $culture_title; ?></h2>
                <?php else : ?>
                <h2>Be Different Join the Culture</h2>
                <?php endif; ?> 

                <?php if ($culture_description) : ?>
                <p><?php echo $culture_description; ?></p>
                <?php else : ?>
                <p>Jainam Broking Limited is a team united by a common DNA of hardworking, talented and passionate enthusiasts. Be the groundbreaker, together with people who inspire you to be exceptional. Come onboard to embrace the challenges and help us build a digital ecosystem with transparency.</p>
                <?php endif; ?>

                <?php if ($join_us_button) : ?>
                <a href="<?php echo $join_button_link['url']; ?>" target="<?php echo $join_button_link['target']; ?>" class="btn"><?php echo $join_us_button; ?></a>
                <?php else : ?>
                <a href="javascript:void(0);" class="btn">Join Us</a>
                <?php endif; ?>
                
            </div>
           
        </div>
    </section>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.1.0/typed.umd.js"></script>

    <script>
        // about us page journey opction view
        // document.addEventListener('DOMContentLoaded', (event) => {
        //     const journeyButton = document.querySelector('.view-journey-btn a.btn');
        //     const journeyInner = document.querySelector('.our-journey-inner');

        //     journeyButton.addEventListener('click', (e) => {
        //         e.preventDefault();  
        //         journeyInner.classList.toggle('active');
        //         if (journeyInner.classList.contains('active')) {
        //             journeyButton.textContent = 'View Less';
        //         } else {
        //             journeyButton.textContent = 'View Full Journey';
        //         }
        //     });
        // });

        document.addEventListener('DOMContentLoaded', (event) => {
            const journeyButton = document.querySelector('.view-journey-btn a.btn');
            const journeyInner = document.querySelector('.our-journey-inner');
            const journeyBtnContainer = document.querySelector('.view-journey-btn');
            const journeySection = document.querySelector('.our-journey-section');

            journeyButton.addEventListener('click', (e) => {
                e.preventDefault();  
                journeyInner.classList.toggle('active');
                journeyBtnContainer.classList.toggle('active');
                
                if (journeyInner.classList.contains('active')) {
                    journeyButton.textContent = 'View Less';
                } else {
                    journeyButton.textContent = 'View Full Journey';
                }

                journeySection.scrollIntoView({ behavior: 'smooth' });
            });
        });





        document.addEventListener("DOMContentLoaded", function() {
        const typed = new Typed("#typed", {
        strings: ["Passion.", "Mission.", "Community."],
        typeSpeed: 150, 
        backSpeed: 150, 
        backDelay: 2000,
        loop: true,
        showCursor: true, 
        cursorChar: '|', 
        smartBackspace: true, 
    });
});

        

    </script>
    


<?php  get_footer(); ?>
