<div class="container mx-auto my-5">
    <?php
    while (have_rows('content')):
        the_row();
        if (get_row_layout() == 'column_section'):
            $columns = get_sub_field('columns');
            ?>
            <h3 class="module-heading font-bold text-center">
                Services
            </h3>
            <div class="thick-underline"></div>
            <p class="tagline text-center mb-4 mx-auto">
                Our company specializes in providing comprehensive solutions for parking management and access control. With
                our expertise, we ensure efficient and secure parking facilities tailored to your specific needs.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 justify-center mt-8">
                <?php foreach ($columns as $column): ?>
                    <div
                        class="relative shadow-lg p-4 lg:p-6 transition duration-300 ease-in-out transform hover:bg-gray-100 hover:scale-105 cursor-pointer flex flex-col">
                        <?php if (!empty($column['image'])): ?>
                            <div class="bg-transparent inline-block p-1">
                                <img src="<?php echo esc_url($column['image']['url']); ?>"
                                    alt="<?php echo esc_attr($column['image']['alt']); ?>" class="h-48 w-48 object-contain mx-auto">
                            </div>
                        <?php endif; ?>
                        <div class="flex-1 mt-4">
                            <h3 class="module-text font-semibold text-center">
                                <?php echo $column['title']; ?>
                            </h3>
                            <p class="text-gray-600 text-center mt-2">
                                <?php echo $column['description']; ?>
                            </p>
                        </div>
                        <a href="<?php echo esc_url($column['link']['url']); ?>"
                            class="px-4 py-2 rounded-3xl mt-4 transition-colors bg-gray-300 text-footerblack text-center hover:bg-menublue hover:text-light font-medium">Find
                            out more</a>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        endif;
    endwhile;
    ?>
</div>