<?php if (have_rows('page_sections')) : ?>
    <section class="bannerview">
        <div class="container">
            <?php while (have_rows('page_sections')) : the_row(); ?>
                <?php if (get_row_layout() == 'pg_open_free_ac_info') : ?>
                    <div class="open_free_demat_account">
                        <div class="demat_account_details">
                            <h1 class="title">
                                <?php the_sub_field('open_free_demat_account_heading'); ?> 
                            </h1>
                            <span><?php the_sub_field('open_free_demat_account_sub_heading'); ?></span>
                            <div class="demat_account_charge">
                                <?php if (have_rows('brokerage_list')) : ?>
                                    <?php while (have_rows('brokerage_list')) : the_row(); ?>
                                        <div class="charg_cart">
                                            <h3><?php the_sub_field('brokerage_on_equity_number'); ?></h3>
                                            <h4><?php the_sub_field('brokerage_on_equity_text'); ?></h4>
                                            <h5><?php the_sub_field('brokerage_on_equity_subheading'); ?></h5>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                            <!-- <div class="form_group">
                                <input type="number" placeholder="Enter mobile number" class="form_control">
                                <button class="btn btn_opne_account">Open Demat Account</button>
                            </div> -->
                            <?php echo do_shortcode('[contact-form-7 id="77903aa" title="Contact us"]'); ?>
                            <!-- <p class="nri_account">Want to open an NRI account ?</p> -->
                        </div>
                        <div class="banner_mobil_view">
                            <?php $image = get_sub_field('add_brokerage_on_equity_image'); ?>
                            <?php if ($image) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>
