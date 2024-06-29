<?php
if (have_rows('moduletwo')):
    while (have_rows('moduletwo')):
        the_row();
        if (get_row_layout() == 'moduletwo_section'):
            $image = get_sub_field('image');
            $content_items = get_sub_field('content');
            $moduletwo_title = get_sub_field('moduletwo_title');
            ?>
            <?php if ($content_items): ?>
                <div class="flex flex-col md:flex-row my-5">
                    <div class="flex flex-col md:w-[51%] w-10/12 mx-auto">
                        <?php if ($moduletwo_title): ?>
                            <h2 class="module-heading font-bold mb-8 ">
                                <?php echo esc_html($moduletwo_title); ?>
                            </h2>
                        <?php endif; ?>
                        <div class="grid grid-cols-2 gap-12 w-full ">
                            <?php foreach ($content_items as $item): ?>
                                <div class="">
                                    <div class="blue-line"></div>
                                    <div class="h-full">
                                        <?php if ($item['title']): ?>
                                            <h2 class="medium-text font-bold mb-4">
                                                <?php echo esc_html($item['title']); ?>
                                            </h2>
                                        <?php endif; ?>
                                        <p class="tagline">
                                            <?php echo esc_html($item['content']); ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>"
                        class=" h-[600px] my-auto object-cover">
                </div>
            <?php endif;
        endif;
    endwhile;
endif;
?>