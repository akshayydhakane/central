<?php
    $account_open_title = get_field('account_open_title', 'option');
    $account_open_description = get_field('account_open_description', 'option');
?>
<section class="account-open-blog contact-us-page-account-open-blog blue_open_cart"> 
    <div class="container">
        <div class="account-open-blog-inner">
            
            <?php if($account_open_title){ ?>
                <h2><?php echo $account_open_title; ?></h2>
            <?php } else{?>
                <h2>Start Investing Now!</h2>
            <?php } ?>

            
            <?php if($account_open_description){ ?>
                <h3><?php echo $account_open_description; ?></h3>
            <?php } else{?>
                <h3>Open free demat account in 5 minutes</h3>
            <?php } ?>
                    
            <div class="enter-number">
                <!-- <div class="input-group">
                    <input type="number" placeholder="Enter mobile number" maxlength="10">
                    <a href="javascript:void(0)"> Open Demat Account </a>
                </div> -->
                <?php echo do_shortcode('[contact-form-7 id="77903aa" title="Contact us"]'); ?>
            </div>
        </div>
    </div>
</section>
