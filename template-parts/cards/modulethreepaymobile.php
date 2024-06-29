<div class="container mx-auto my-5">
    <?php
    while (have_rows('modulethree')):
        the_row();
        if (get_row_layout() == 'modulethree_section'):

            $content_rows = get_sub_field('content');
            $background_image = get_sub_field('image');
            ?>
            <section class="products-paymobile two-col-cards full-width-container"
                style="background-image: url('<?php echo esc_url($background_image['url']); ?>');">
                <div class="container mx-auto text-center bg-white bg-opacity-90"
                    style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1), 0px 8px 16px rgba(0, 0, 0, 0.1));">
                    <h3 class="module-heading font-bold text-center mt-5">
                        Pay by mobile features
                    </h3>
                    <div class="thick-underline"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 justify-center mb-5 mt-8">
                        <?php foreach ($content_rows as $row): ?>
                            <div
                                class="relative shadow-md p-4 lg:p-6 transition duration-300 ease-in-out transform cursor-pointer flex items-center sm:w-full">
                                <div class="ml-4">
                                    <h3 class="medium-text font-bold font-bold">
                                        <?php echo $row['title']; ?>
                                    </h3>
                                    <p class="tagline mt-2 mx-auto">
                                        <?php echo $row['text']; ?>
                                    </p>
                                </div>
                                <div class="bg-transparent inline-block p-1 ml-auto">
                                    <?php if (!empty($row['pic'])): ?>
                                        <img src="<?php echo esc_url($row['pic']['url']); ?>"
                                            alt="<?php echo esc_attr($row['pic']['alt']); ?>"
                                            class="h-64 w-auto lg:w-64 object-contain ml-auto">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php
        endif;
    endwhile;
    ?>
</div>