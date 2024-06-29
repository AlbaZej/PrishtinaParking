<?php
if (have_rows('table')):
    while (have_rows('table')):
        the_row();
        if (get_row_layout() == 'table_section'):
            $image = get_sub_field('image');
            $content = get_sub_field('content');
            $title = get_sub_field('title');

            if ($image !== null && $content !== null && $title !== null): ?>

                <div class="flex-col md:flex-row flex items-center justify-between mb-5">
                    <div class="w-10/12 md:w-1/2 lg:w-1/3 mx-auto">
                        <h2 class="extralarge-heading font-bold">
                            <?php echo esc_html($title); ?>
                        </h2>
                        <div class="thin-underline"></div>
                        <p class="module-text font-semibold text-gray-600">
                            <?php echo esc_html($content); ?>
                        </p>
                    </div>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                        class="mt-2 w-[400px] lg:w-[580px] object-cover">
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>