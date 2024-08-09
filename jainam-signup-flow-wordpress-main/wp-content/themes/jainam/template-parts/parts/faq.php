<?php if (have_rows('frequently_asked_questions')) : 
        while (have_rows('frequently_asked_questions')) : the_row(); ?>
        <?php if (get_row_layout() == 'add_frequently_asked_questions') : ?>
        <section class="sec_faqs contact-us-faq sec_faqs_refer">
            <div class="container">
                <?php
                    $add_faq_heading = get_sub_field('add_faq_heading');
                ?>
                <?php if($add_faq_heading) { ?><h2 class="title"><?php echo $add_faq_heading; ?></h2><?php } ?>
                <div class="contact-us-faq-inner">           
                    <?php if (have_rows('lists_of_faq')) : ?>
                        <?php while (have_rows('lists_of_faq')) : the_row(); ?>
                            <div class="faq_question_answer">
                                <div class="question"><?php the_sub_field('add_faq_heading'); ?></div>
                                <div class="answercont" style="max-height: 0px;">
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
