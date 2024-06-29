<div class="container mx-auto my-5">
    <h3 class="module-heading font-bold text-center">
        Pay by mobile
    </h3>
    <div class="thick-underline"></div>
    <?php
    if (have_rows('mobile')):
        while (have_rows('mobile')):
            the_row();
            if (get_row_layout() == 'text_with_image'):

                $image = get_sub_field('image');
                $image_side = get_sub_field('image_side');

                if ($image !== null && $image_side !== null): ?>
                    <section class="text-with-image-section">
                        <div class="container mx-auto flex flex-wrap items-center">
                            <div class="w-full md:w-1/2 px-4">
                                <div class="image-container">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                                        class="image" style="max-width: 100%;">
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-4">
                                <?php if (have_rows('content')): ?>
                                    <?php while (have_rows('content')):
                                        the_row(); ?>
                                        <?php
                                        $number_image = get_sub_field('number_image');
                                        $title_of_paragraph = get_sub_field('title_of_paragraph');
                                        $paragraph = get_sub_field('paragraph');
                                        ?>

                                        <div class="text-content mt-2 md:mt-0">
                                            <div class="mobile-step-image mb-0.5">
                                                <img src="<?php echo esc_url($number_image['url']); ?>"
                                                    alt="<?php echo esc_attr($number_image['alt']); ?>" class="number-image">
                                            </div>
                                            <h2 class="mobile-step-title">
                                                <?php echo esc_html($title_of_paragraph); ?>
                                            </h2>
                                            <p class="tagline mb-4">
                                                <?php echo esc_html($paragraph); ?>
                                            </p>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <div class="container mx-auto text-center mt-0 mb-40">No contents found.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>