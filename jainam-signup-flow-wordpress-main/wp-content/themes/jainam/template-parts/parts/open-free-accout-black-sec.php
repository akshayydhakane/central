<?php
    $cta_heading = get_field('add_blog_cta_heading', 'option');
    $cta_subtext = get_field('cta_add_sub_text', 'option');
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
            <div class="enter-email enter-number">
                <!-- <div class="input-group">
                    <input type="text" placeholder="Enter your email address">
                    <a href="javascript:void(0)"> Proceed </a>
                </div> -->
                <?php echo do_shortcode('[contact-form-7 id="0949e6f" title="Email Form"]'); ?>

            </div>
        </div>
    </div>
</section>
