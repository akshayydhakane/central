<?php if (have_rows('frequently_asked_questions')) : 
        while (have_rows('frequently_asked_questions')) : the_row(); ?>
        <?php if (get_row_layout() == 'add_frequently_asked_questions') : ?>
        <section class="sec_faqs contact-us-faq">
            <div class="container">
                <h2 class="title"><?php echo get_sub_field('add_faq_heading'); ?></h2> 
                <div class="contact-us-faq-inner">           
                    <?php if (have_rows('lists_of_faq')) : ?>
                        <?php //$faq_count = 0; ?>
                        <?php while (have_rows('lists_of_faq')) : the_row(); ?>
                            <div class="faq_question_answer">
                                <div class="question"><?php the_sub_field('add_faq_heading'); ?></div>
                                <div class="answercont" style="max-height: 0px;">
                                    <div class="answer"><?php the_sub_field('add_faq_description'); ?></div>
                                </div>
                            </div>
                            <?php //$faq_count++; ?>
                        <?php endwhile; ?>
                    <?php endif; ?> 
                </div> 
                <div class="view_more_btn">
                    <a href="https://support.jainam.in/" target="_blank" class="btn" id="">View more</a> 
                </div>                
            </div>
        </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
