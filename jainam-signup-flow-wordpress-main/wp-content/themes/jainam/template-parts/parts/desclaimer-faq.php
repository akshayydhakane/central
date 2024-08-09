<?php if (have_rows('frequently_asked_questions')) : 
        while (have_rows('frequently_asked_questions')) : the_row(); ?>
        <?php if (get_row_layout() == 'add_frequently_asked_questions') : ?>
            <?php if(get_sub_field('add_faq_heading')){?><h2 class="title"><?php echo get_sub_field('add_faq_heading'); ?></h2><?php } ?>        
                    <?php if (have_rows('lists_of_faq')) : ?>
                        <?php while (have_rows('lists_of_faq')) : the_row(); ?>
                            <div class="faq_question_answer">
                                <div class="question"><?php the_sub_field('add_faq_heading'); ?></div>
                                <div class="answercont" style="max-height:0px;">
                                    <div class="answer">
                                        <?php the_sub_field('add_faq_description'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>                  
 
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
