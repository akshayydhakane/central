<?php
    $cta_heading = get_field('subscriber_heading', 'option');
    $cta_subtext = get_field('subscribe_sub_heading', 'option');
?>
<section class="account-open-blog">
    <div class="container">          
        <div class="account-open-blog-inner">
            <?php if ($cta_heading) : ?>
                <h2><?php echo esc_html($cta_heading); ?></h2>
            <?php else : ?>
                <h2>Subscribe to our Newsletter</h2>
            <?php endif; ?>
            <?php if ($cta_subtext) : ?>
                <?php echo ($cta_subtext); ?>
            <?php else : ?>
                <h6>Explore More invites you to dive deep into the wonders of the world and embrace the joy of exploration.</h6>
            <?php endif; ?>
            <div class="enter-number">
                <!-- <div class="input-group">
                    <input type="number" placeholder="Enter mobile number" maxlength="10">  
                    <a href="javascript:void(0)" class=""> Open Free Demat Account </a>
                </div> -->
                <?php echo do_shortcode('[contact-form-7 id="77903aa" title="Contact us"]'); ?>   
              
            </div>
        </div>
    </div>
</section>
