<?php
    $cta_heading = get_field('subscriber_glossary_heading', 'option');
    $cta_subtext = get_field('subscribe_sub_glossary_heading', 'option');
    $cta_bottomtext = get_field('subscribe_bottom_glossary_line', 'option');
?>
    <div class="opne-free_account">
        <?php if ($cta_heading) : ?>
            <?php echo $cta_heading; ?>
        <?php else : ?>
            <h3>Open Free Demat Account <span>Enjoy Zero Brokerage on Equity Delivery</span></h3>
        <?php endif; ?>
        <?php if ($cta_subtext) : ?>
            <?php echo ($cta_subtext); ?>
        <?php else : ?>
            <h4>Join our 2 Cr+ happy customers</h4> 
        <?php endif; ?>
        <!-- <div class="form_group">
            <input type="number" placeholder="Enter mobile number" class="form_control" maxlength="10">
            <button class="btn btn_opne_account">Get a Free Demat Account</button>
        </div> -->
        <?php echo do_shortcode('[contact-form-7 id="77903aa" title="Contact us"]'); ?>
        
        <?php if ($cta_bottomtext) : ?>
            <?php echo $cta_bottomtext; ?>
        <?php else : ?>
            <h5>Want to open an NRI account ?</h5>
        <?php endif; ?>
        
    </div>
