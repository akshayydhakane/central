<?php if (have_rows('desclaimer_frequently_asked_questions')) : 
        while (have_rows('desclaimer_frequently_asked_questions')) : the_row(); ?>
        <?php if (get_row_layout() == 'declaimer_add_frequently_asked_questions') : ?>
        <section class="sec_faqs desclaimer_faq_ques">
            <div class="container">
                <?php
                    $add_faq_heading = get_sub_field('add_faq_heading');
                ?>
                <?php if($add_faq_heading) { ?><h2 class="title"><?php echo $add_faq_heading; ?></h2><?php } ?>
                <div class="contact-us-faq-inner">           
                    <?php if (have_rows('lists_of_faq')) : ?>
                        <?php while (have_rows('lists_of_faq')) : the_row(); ?>
                            <div class="faq_question_answer" style="display:block;">
                                <div class="question active"><?php the_sub_field('add_faq_heading'); ?></div>
                                <div class="answercont" style="max-height: 80px;">
                                    <div class="answer"><?php the_sub_field('add_faq_description'); ?></div>
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
