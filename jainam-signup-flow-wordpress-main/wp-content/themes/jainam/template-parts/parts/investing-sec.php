<?php if (have_rows('page_sections')) : ?>
    <?php while (have_rows('page_sections')) : the_row(); ?>
        <?php if (get_row_layout() == 'start_your_investing_journey_with_jainam') : 
            $start_invest_add_heading = get_sub_field('start_invest_add_heading'); ?>

            <section class="start-invest-section">
                <div class="container">
                <?php if($start_invest_add_heading){ ?><h2><?php echo $start_invest_add_heading; ?></h2><?php } ?>

                    <div class="start-invest-inner">            
                        <div class="start-invest-inner-left"><?php 
                        $featured_post = get_sub_field('start_your_investing_select_post');

                        if ($featured_post): ?>
                            <div class="start-invest-left-box">
                                <div class="start-invest-box-img">
                                    <?php 
                                    // Get the featured image URL
                                    $featured_image_url = get_the_post_thumbnail_url($featured_post->ID, 'large');
                                    if ($featured_image_url): ?>
                                        <img src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_attr($featured_post->post_title); ?>"  style="width: 100%; height: auto;">
                                    <?php else: ?>
                                        <img src="./assets/img-home-page/default-image.webp" alt="Default Image">
                                    <?php endif; ?>
                                </div>
                                <div class="start-invest-box-content">
                                    <h3 class="inter_semibold"><a href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>"><?php echo esc_html($featured_post->post_title); ?></a></h3>

                                    <p><?php echo esc_html($featured_post->post_excerpt); ?></p>
                                    <div class="start-invest-box-content-client">
                                        <?php 
                                        // Get author details
                                        $author_id = $featured_post->post_author;
                                        $author_avatar_url = get_avatar_url($author_id, array('size' => 32));
                                        ?>
                                        <img src="<?php echo esc_url($author_avatar_url); ?>" alt="Author Avatar">
                                        <span>Written by <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?></span>
                                    </div>
                                    <div class="start-invest-box-content-client-detail">
                                    
                                            <?php 
                                            // Get the categories for the post
                                            $categories = get_the_category($featured_post->ID);
                                            if ($categories) {
                                                foreach ($categories as $category) {
                                                    $category_url = get_category_link($category->term_id);
                                                    echo '<div><a href="javascript:void(0)">' . esc_html($category->name) . '</a></div>';
                                                }
                                            }
                                            ?>
                                        <p><?php echo esc_html(get_the_date('M d, Y', $featured_post->ID)); ?></p>
                                        <?php
                                        // Calculate reading time
                                        $content = $featured_post->post_content;
                                        $word_count = str_word_count( strip_tags( $content ) );
                                        $reading_time = ceil( $word_count / 200 ); // Assuming average reading speed is 200 words per minute
                                        echo '<p>' . esc_html( $reading_time ) . ' min read</p>'; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                        </div>                         

                        <div class="start-invest-inner-right">
                            <?php if (have_rows('select_add_info')) : ?>
                                <?php $count = 1; ?>
                                <?php while (have_rows('select_add_info')) : the_row(); 
                                $start_inv_add_side_image = get_sub_field('start_inv_add_side_image');
                                $start_inv_add_heading = get_sub_field('start_inv_add_heading');
                                $start_inv_sub_info = get_sub_field('start_inv_sub_info');
                                $video_link = get_sub_field('video_link');
                                ?>

                                <?php
                                    if($count == 2){
                                        $anchor_start = '<a href="'.$video_link['url'].'" target="'.$video_link['target'].'">';
                                        $anchor_end = '</a>';
                                    }
                                ?>

                                <div class="start-invest-right-box">  
                                                                
                                        <?php if ($start_inv_add_side_image) : ?>
                                        <div class="start-invest-box-img">
                                            <?php echo $anchor_start; ?> 
                                                <img src="<?php echo esc_url($start_inv_add_side_image['url']); ?>" alt="<?php echo esc_attr($start_inv_add_side_image['alt']); ?>"  style="width: 100%; height: auto;">
                                            <?php echo $anchor_end; ?>
                                        </div><?php endif; ?>
                                        <div class="start-invest-box-content">
                                        <?php if($start_inv_add_heading){ ?><h3 class="inter_semibold"><?php echo $start_inv_add_heading; ?></h3><?php } ?>
                                        <?php if($start_inv_sub_info){ ?><p><?php echo $start_inv_sub_info; ?></p><?php } ?>
                                        </div>
                                    
                                </div>             
                                <?php $count++; ?>    

                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>