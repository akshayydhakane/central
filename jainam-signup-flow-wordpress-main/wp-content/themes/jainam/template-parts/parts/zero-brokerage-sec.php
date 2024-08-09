

<?php
if (function_exists('get_field')) {
   $enjoy_zero_heading = get_field('enjoy_zero_heading','option');
   $enjoy_zero_sub_heading = get_field('enjoy_zero_sub_heading','option');
   $qr_code_image = get_field('add_qr_code_image','option');
   $gplay_image = get_field('google_play_image','option');
   $google_play_link = get_field('google_play_url','option');
   $apple_pay_image = get_field('apple_pay_image','option');
   $apple_play_link = get_field('apple_pay_url','option');
   $side_image = get_field('blog_zero_side_image','option');
   ?>

   <section class="zero-brokerage-section">
   <div class="container">
      <div class="brokerage-sec-inner">
         <div class="brokerage-inner-left">
               <?php if ($enjoy_zero_heading) : ?>
                  <h2><?php echo ($enjoy_zero_heading); ?></h2>
               <?php else : ?>
                  <h2>Enjoy <span>ZERO</span> Brokerage on Equity Delivery</h2>
               <?php endif; ?>
               <?php if ($enjoy_zero_sub_heading) : ?>
                  <p><?php echo ($enjoy_zero_sub_heading); ?></p>
               <?php else : ?>
                  <p>Get the link to download the App</p>
               <?php endif; ?>
               <!-- <div class="input-group">
                  <input type="number" placeholder="Enter your mobile number">
                  <a href="javascript:void(0)">Send App Link</a>
               </div> -->
               <?php echo do_shortcode('[contact-form-7 id="e682a92" title="Zero brokerage form"]');?>
               <div class="brokerage-download-opc">
                  <?php if ($qr_code_image) : ?>
                     <img src="<?php echo ($qr_code_image['url']); ?>" alt="<?php echo esc_attr($qr_code_image['alt']); ?>">
                  <?php else : ?>
                     <img src="<?php echo site_url(); ?>/wp-content/themes/jainam/assets/img/qr-code.webp" alt="Default QR Code">
                  <?php endif; ?>
                  <div class="play-store-icon">
                     <?php if ($gplay_image && $google_play_link) : ?>
                           <a href="<?php echo ($google_play_link['url']); ?>">
                              <img src="<?php echo ($gplay_image['url']); ?>" alt="<?php echo esc_attr($gplay_image['alt']); ?>">
                           </a>
                     <?php else : ?>
                           <a href="#">
                              <img src="<?php echo site_url(); ?>/wp-content/themes/jainam/assets/img/play-store.webp" alt="Default Google Play Image">
                           </a>
                     <?php endif; ?>
                     <?php if ($apple_pay_image && $apple_play_link) : ?>
                           <a href="<?php echo ($apple_play_link['url']); ?>">
                              <img src="<?php echo ($apple_pay_image['url']); ?>" alt="<?php echo esc_attr($apple_pay_image['alt']); ?>">
                           </a>
                     <?php else : ?>
                           <a href="#">
                              <img src="<?php echo site_url(); ?>/wp-content/themes/jainam/assets/img/apple-store.webp" alt="Default Apple Pay Image">
                           </a>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
            <div class="brokerage-inner-right">
                  <?php if ($side_image) : ?>
                     <img src="<?php echo ($side_image['url']); ?>" alt="<?php echo esc_attr($side_image['alt']); ?>">
                  <?php else : ?>
                     <img src="<?php echo site_url(); ?>/wp-content/themes/jainam/assets/img/blog-card-7.webp" alt="Default Side Image">
                  <?php endif; ?>
            </div>
         </div>
      </div>
   </section>
<?php } ?>