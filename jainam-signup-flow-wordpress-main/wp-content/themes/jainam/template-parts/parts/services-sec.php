<?php if (have_rows('page_sections')) : ?>
    <?php while (have_rows('page_sections')) : the_row(); ?>
        <?php if (get_row_layout() == 'add_services_sec') : 
        $ser_add_heading_sec = get_sub_field('ser_add_heading_sec');
        ?>
        <section class="service-section">
            <div class="container">
                <?php if($ser_add_heading_sec){ ?><h2><?php echo $ser_add_heading_sec; ?></h2><?php } ?>
                <div class="service-sec-inner">         
                <?php if (have_rows('jainnam_add_services')) : ?>
                    <?php while (have_rows('jainnam_add_services')) : the_row(); 
                    $add_service_add_image = get_sub_field('add_service_add_image');
                    $add_hover_image = get_sub_field('add_hover_image');
                    $add_service_add_heading = get_sub_field('add_service_add_heading');
                    $jainam_ser_add_description = get_sub_field('jainam_ser_add_description'); 
                    ?>
                        <div class="service-inner-box">
                        <?php if ($add_service_add_image) : ?>
                            <img src="<?php echo esc_url($add_service_add_image['url']); ?>" class="without_hover" alt="<?php echo esc_attr($add_service_add_image['alt']); ?>">
                        <?php endif; ?>
                        <?php if ($add_hover_image) : ?>
                            <img src="<?php echo esc_url($add_hover_image['url']); ?>" class="with_hover" alt="<?php echo esc_attr($add_hover_image['alt']); ?>">
                        <?php endif; ?>
                        <div class="service-inner-box-content">
                            <?php if($add_service_add_heading){ ?><h3 class="inter_semibold"><?php echo $add_service_add_heading; ?></h3><?php } ?>
                            <?php if($jainam_ser_add_description){ ?><p><?php echo $jainam_ser_add_description; ?></p><?php } ?>
                        </div>
                    </div> 
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>