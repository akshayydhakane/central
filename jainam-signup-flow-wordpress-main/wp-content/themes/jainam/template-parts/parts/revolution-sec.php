
<?php  
$re_add_heading = get_field('re_add_heading');
$re_description = get_field('re_description');
$re_know_more = get_field('re_know_more');
$re_add_side_image = get_field('re_add_side_image');
$re_jainam_info = get_field('re_jainam_info'); 
if($re_add_heading || $re_description || $re_know_more || $re_add_side_imag || $re_jainam_info){ ?>
<section class="revolution-section">
    <div class="container">
        <div class="revolution-top">
            <div class="revolution-top-left">
                <?php
                if($re_add_heading){?>
                <h2><?php echo $re_add_heading; ?></h2><?php } ?>
                <?php if($re_description){?><p><?php echo $re_description; ?></p><?php } ?>
                <?php if($re_know_more){?><a href="<?php echo $re_know_more['url']; ?>" class="btn">
                <?php echo $re_know_more['title']; ?></a> <?php } ?>       
            </div>
            <?php if($re_add_side_image){  ?>
            <div class="revolution-top-right">
                <img src="<?php echo $re_add_side_image['url']; ?>" alt="<?php echo $re_add_side_image['alt']; ?>" style="width: auto; height: auto;">
            </div>
            <?php } ?>
        </div>
        <div class="revolution-bottom">
           <?php if( have_rows('re_jainam_info') ):
                // Loop through the rows
                while( have_rows('re_jainam_info') ): the_row(); 
                $re_info_add_image = get_sub_field('re_info_add_image');
                $re_info_add_title = get_sub_field('re_info_add_title');
                $re_infoadd_info = get_sub_field('re_infoadd_info');
                $add_link = get_sub_field('add_link');

                    ?>
                    <div class="revolution-box">
                        <a href="<?php echo $add_link['url']; ?>" target="<?php echo $add_link['target']; ?>">
                            <img src="<?php echo $re_info_add_image['url']; ?>" alt="<?php echo $re_info_add_image['alt']; ?>" style="width: auto; height: auto;">
                            <?php if($re_info_add_title){ ?><h3 class="inter_semibold"><?php echo $re_info_add_title; ?></h3><?php } ?>
                            <?php if($re_infoadd_info){ ?><p><?php echo $re_infoadd_info; ?></p><?php } ?>
                        </a>
                    </div>
                <?php
                endwhile;          
            endif;
            ?>

        </div>
    </div>
</section>
<?php } ?>