<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jainam
 */ ?>

 <!-- <div class="toc blog-detail-sec-content-table"> -->
<?php echo do_shortcode('[toc]'); ?>
<!-- </div> -->
<?php
// Fetch all categories
$categories = get_categories();
if ( ! empty( $categories ) ) {
    echo '<div class="blog-list-top blog-detail-list-top">';
    echo '<h3>Categories</h3>';
    echo '<div class="blog-list-top-inner">';

    foreach ( $categories as $category ) {
        //$category_link = get_category_link( $category->term_id );
        $category_link = esc_url( home_url( '/blog/?category=' . $category->slug ) );

        echo '<a href="'.$category_link.'">' . esc_html( $category->name ) . '</a>';
    }
    echo '</div> 
    </div>';    
}

$add_heading_for_mfr = get_field('add_heading_for_mfr','option');
$add_link_for_mfr = get_field('add_link_for_mfr','option');
$add_image_for_mfr = get_field('add_image_for_mfr','option');
if (function_exists('get_field')) {  ?>
    <div class="blog-list-fund-ratio" style="background-image: url(<?php echo $add_image_for_mfr['url'];?>);">
        <?php if ($enjoy_zero_heading) : ?>
            <h3> <?php echo ($enjoy_zero_heading); ?> </h3>
            <?php else : ?>
                <h3>Best <span>Mutual Funds</span> with Low expense Ratio</h3>
            <?php endif;
        if($add_link_for_mfr !=''){ ?>
        <a href="<?php echo $add_link_for_mfr['url']; ?>" class="read-more-btn" target="<?php echo $add_link_for_mfr['target']; ?>"><?php echo $add_link_for_mfr['title']; ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="15" viewBox="0 0 17 15" fill="none">
                    <path d="M15.75 7.72607L0.75 7.72607" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9.7002 1.70149L15.7502 7.72549L9.7002 13.7505" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
        </a>
        <?php } ?>
    </div>
<?php }?>