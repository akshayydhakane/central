<?php
if (have_rows('page_sections')) :
   while (have_rows('page_sections')) : the_row();
      // Check the layout type
      if (get_row_layout() === 'open_free_demet_5_min') :
         ?>
         <section class="account-open-blog">
            <div class="container">
               <div class="account-open-blog-inner our_demat_account">                 
                  <h2><?php the_sub_field('opn_five_add_heading'); ?></h2>
                  <?php the_sub_field('open_five_add_sub_heading'); ?> 
                  <div class="enter-number">
                        <!-- <div class="input-group">
                            <input type="number" placeholder="Enter mobile number" maxlength="10">
                            <a href="javascript:void(0)" class="btn_process"> Proceed </a> 
                        </div> -->
                        <?php echo do_shortcode('[contact-form-7 id="77903aa" title="Contact us"]'); ?> 
                    </div>      
               </div>
            </div>
         </section>
         <?php endif;
   endwhile;
endif;
?> 