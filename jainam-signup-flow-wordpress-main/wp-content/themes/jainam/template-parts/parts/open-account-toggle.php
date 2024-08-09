<?php if (have_rows('page_sections')) : ?>
    <?php while (have_rows('page_sections')) : the_row(); ?>
        <?php if (get_row_layout() == 'open_an_account_with_toggle') : 
        $toggle_add_heading = get_sub_field('toggle_add_heading'); ?>

            <section class="account-open-blog account-open-blog-home">
                <div class="container">             
                    <div class="account-open-blog-inner">
                        <?php if($toggle_add_heading){ ?><h2><?php echo $toggle_add_heading; ?></h2><?php } ?>
                        <!-- <div class="account-opc">
                            <p>Discount Brk</p>
                            <span class="switch">
                                <input id="switch-rounded" type="checkbox" />
                                <label for="switch-rounded"></label>
                            </span>
                            <p>Luxury Brk</p>
                        </div> -->
                        <div class="enter-number enter-number-home">
                            <!-- <div class="input-group">
                                <label>Mobile Number</label>
                                <input type="number" placeholder="Enter mobile number">
                                <a href="javascript:void(0)"> Open Account Now </a>
                            </div> -->
                            <?php echo do_shortcode('[contact-form-7 id="6a077fc" title="Open account toggle"]'); ?> 
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
