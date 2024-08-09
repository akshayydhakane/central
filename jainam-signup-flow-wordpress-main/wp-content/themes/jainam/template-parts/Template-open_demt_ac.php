<?php
/**
 * Template Name: Open Demat Account
 */
get_header(); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>
<main class="landing_page"> 

   <?php
   include(locate_template('template-parts/parts/open-free-demet-sec.php' ));?>
   <section class="demat_online_account how_opne_online_account">
         <div class="container">
            <h6><?php echo get_field('hw_open_da_subhead'); ?></h6>
            <h2 class="title"><?php echo get_field('open_da_online_heading'); ?></h2>
            <div class="online_account_details">
               <div class="online_title">
                     <?php  $i=1; 
                     if (have_rows('add_account_title')) : ?>
                        <?php while (have_rows('add_account_title')) : the_row(); ?>
                           <div class="account_online_number">
                              <p><?php echo $i; ?><h3><?php the_sub_field('online_account_title'); ?></h3></p>
                           </div>
                        <?php $i++;  endwhile; ?> 
                     <?php endif; ?>
               </div>
               <div class="all_online_account video_player">
                     <!-- <div class="add_video"> -->
                        <?php //if ($video_url = get_field(('add_video'))) : 
                           //echo $video_url;?>
                        <?php //endif; ?>
                        <div id="lottie-animation1" class="lottiejson"></div>
                        <div id="lottie-animation2" class="lottiejson"></div>
                        <div id="lottie-animation3" class="lottiejson"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var animation = lottie.loadAnimation({
                                    container: document.getElementById('lottie-animation1'), // the dom element that will contain the animation
                                    renderer: 'svg',
                                    loop: true,
                                    autoplay: true,
                                    path: '<?php echo get_stylesheet_directory_uri(); ?>/assets/js/Verified.json'
                                });
                            });
                        
                            document.addEventListener("DOMContentLoaded", function() {
                                var animation = lottie.loadAnimation({
                                    container: document.getElementById('lottie-animation2'), // the dom element that will contain the animation
                                    renderer: 'svg',
                                    loop: true,
                                    autoplay: true,
                                    path: '<?php echo get_stylesheet_directory_uri(); ?>/assets/js/UploadFile.json'
                                });
                            });
                        
                            document.addEventListener("DOMContentLoaded", function() {
                                var animation = lottie.loadAnimation({
                                    container: document.getElementById('lottie-animation3'), // the dom element that will contain the animation
                                    renderer: 'svg',
                                    loop: true,
                                    autoplay: true,
                                    path: '<?php echo get_stylesheet_directory_uri(); ?>/assets/js/Signature.json'
                                });
                            });

                        </script> 

                     <!-- </div> -->
               </div>
            </div>
         </div>
   </section>

   <section class="demat_online_account">
         <div class="container">
            <div class="online_account_details">
               <div class="online_title">
                     <h2 class="title"><?php echo get_field('opa_add_main_heading'); ?></h2>
               </div>
               <div class="all_online_account">
                     <?php if (have_rows('add_informations_why_open_demat_account')) : ?>
                        <?php while (have_rows('add_informations_why_open_demat_account')) : the_row(); ?>
                           <div class="online_cart">
                                 <div class="account_icon">
                                    <?php 
                                    $logo = get_sub_field('oda_add_logo');
                                    if ($logo) :
                                    ?>
                                       <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                                    <?php endif; ?>
                                 </div>
                                 <h3 class="inter_semibold"><?php echo get_sub_field('opa_add_heading'); ?></h3> 
                                 <p><?php echo get_sub_field('opd_add_sub_heading'); ?></p>
                           </div>
                        <?php endwhile; ?>
                     <?php endif; ?>
               </div>
            </div>
         </div>
   </section>
      

   <section class="mobile_opne_brn">
         <div class="container">
            <div class="btn_open">
               <a href="https://signup.jainam.in/" target="_blank" class="btn mobil_view">Open Demat Account</a>
            </div>
         </div>
   </section>

   <?php
      include(locate_template('template-parts/parts/investment-option.php' ));
      include(locate_template('template-parts/parts/ofd-account-fivemin-green.php' ));
      include(locate_template('template-parts/parts/blog-sec.php' ));
      include(locate_template('template-parts/parts/our-user-say.php' ));
      include(locate_template('template-parts/parts/award-sec.php' ));
      include(locate_template('template-parts/parts/news-sec.php' ));
      include(locate_template('template-parts/parts/faq.php' ));

?> </main>

<script>
        $(document).ready(function() {
        function showAnimations() {
            $('#lottie-animation1').fadeIn(500).delay(3000).fadeOut(500, function() {
                $('#lottie-animation2').fadeIn(500).delay(3000).fadeOut(500, function() {
                    $('#lottie-animation3').fadeIn(500).delay(3000).fadeOut(500, function() {
                        showAnimations(); // Restart the animation sequence
                    });
                });
            });
        }

        // Ensure only the first animation is initially visible
        $('#lottie-animation1').show();
        $('#lottie-animation2, #lottie-animation3').hide();

        showAnimations(); // Start the animation sequence
    });

</script>

 <?php  get_footer(); ?>
