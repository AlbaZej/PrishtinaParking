<div class="flex mt-5 flex-col items-center justify-center md:flex-row faq-form w-full">
    <img src="<?= get_template_directory_uri() . '/assets/images/faq.png' ?>" alt="FAQ Photo" class="h-[450px] w-auto">
    <div class="w-full my-2 lg:ml-40 lg:w-1/3 flex items-center justify-center flex-col second-place">
        <h3 class="text-center mb-4 text-light module-heading font-bold">Something you need to know...
        </h3>

        <div class="accordion w-full">
            <?php if (function_exists('have_rows') && have_rows('faqs')): ?>
                <?php while (have_rows('faqs')):
                    the_row(); ?>
                    <?php

                    $question = get_sub_field('questions');
                    $answer = get_sub_field('answer');

                    if ($question && $answer):
                        ?>
                        <div class="accordion-item mb-3">
                            <div
                                class="accordion-header bg-menublue cursor-pointer flex items-center justify-between p-3 hover:bg-gray-200 duration-200 ease-out w-full question-field">
                                <?php echo $question; ?>
                                <span class="accordion-icon inline-block duration-200 ease-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                        class="h-6 w-6 fill-current transform transition-transform"
                                        style="fill: currentColor; width: 1em; height: 1em; display: inline-block; font-size: inherit; transition: fill 200ms ease-in-out 0s; transform-origin: 50% 50%;">
                                        <path
                                            d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                                    </svg>
                                </span>
                            </div>

                            <div
                                class="accordion-content bg-gray-100 overflow-hidden duration-200 ease-out w-full p-3 transition-all answer-field">
                                <?php echo $answer; ?>
                            </div>

                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>


</div>