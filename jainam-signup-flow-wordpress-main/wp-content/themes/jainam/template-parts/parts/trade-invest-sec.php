<?php if (have_rows('page_sections')) : ?>
    <?php while (have_rows('page_sections')) : the_row(); ?>
        <?php if (get_row_layout() == 'where_you_investments_stocks') :
            $investment_add_bg_image = get_sub_field('investment_add_bg_image');
            $investment_add_add_title = get_sub_field('investment_add_add_title');
            $investment_add_add_button = get_sub_field('investment_add_add_button');
            $investment_add_sub_heading = get_sub_field('investment_add_sub_heading');
            ?>
            <section class="comfort-section">
                <div class="container">
                <div class="comfort-inner" style="background-image: url(<?php echo $investment_add_bg_image['url']; ?>);">
                        <div class="comfort-inner-left">
                        <?php if($investment_add_add_title){ ?><h2><?php echo $investment_add_add_title; ?></h2><?php } ?>
                        <?php if($investment_add_sub_heading){ ?><h3><?php echo $investment_add_sub_heading; ?></h3><?php } ?>
                    
                        </div>
                        <div class="comfort-inner-right">
                            <?php if($investment_add_add_button){ ?><a href="<?php echo $investment_add_add_button['url']; ?>" class="open-account-btn"><?php echo $investment_add_add_button['title']; ?><svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                            <path d="M17.0003 0.275879C9.32854 0.275879 2.48422 5.79006 0.879399 13.2988C0.077619 17.0507 0.617739 21.0403 2.40652 24.4351C4.1281 27.7023 6.9505 30.3428 10.3273 31.8393C13.8398 33.3962 17.8722 33.6676 21.564 32.6058C25.1256 31.5818 28.2836 29.3344 30.4335 26.3176C34.9288 20.0104 34.3278 11.1509 29.0391 5.49942C25.9395 2.1873 21.5371 0.275879 17.0003 0.275879ZM24.9084 17.6416L20.4144 22.244C19.2767 23.4095 17.4782 21.6438 18.6114 20.4838L20.879 18.1616H10.1328C9.3697 18.1616 8.73298 17.5244 8.73298 16.7617C8.73298 15.999 9.37012 15.3619 10.1328 15.3619H20.8252L18.5127 13.0498C17.3636 11.9006 19.1452 10.1186 20.2943 11.2677L24.8979 15.8709C25.386 16.3585 25.3906 17.1481 24.9084 17.6416Z" fill="#16181D"/>
                        </svg></a><?php } ?> 
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>