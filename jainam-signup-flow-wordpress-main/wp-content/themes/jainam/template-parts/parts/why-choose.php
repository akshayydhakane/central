<?php  
$why_choose_add_heading = get_field('why_choose_add_heading');
$why_choose_info_sec = get_field('why_choose_info_sec');
if($why_choose_add_heading || $why_choose_info_sec ){ ?> 
    <section class="broking-section">
        <div class="container"><?php if($why_choose_add_heading){ ?>
            <h2><?php echo $why_choose_add_heading; ?></h2> <?php } ?>
            <div class="broking-sec-inner">
            <?php if( have_rows('why_choose_info_sec') ):
                // Loop through the rows
                while( have_rows('why_choose_info_sec') ): the_row(); 
                $why_chooseadd_heading = get_sub_field('why_chooseadd_heading');
                $why_choose_add_info = get_sub_field('why_choose_add_info'); ?>
                    <div class="broking-inner-box">
                        <?php if($why_chooseadd_heading){echo '<h3 class="inter_semibold">'.$why_chooseadd_heading.'</h3>';} ?>
                        <?php if($why_choose_add_info){echo '<p>'.$why_choose_add_info.'</p>';} ?>                        
                    </div>
                <?php
                endwhile;
              
                endif;
                ?>
            </div>
        </div>
    </section>
<?php } ?>