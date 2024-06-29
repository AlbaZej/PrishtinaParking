<?php
/*
Template Name: Benefits
*/

get_header();
get_template_part('template-parts/cards/paymobile');
get_template_part('template-parts/cards/moduletwopaymobile');
get_template_part('template-parts/cards/modulethreepaymobile');
get_template_part('template-parts/parking-me');
?>

<h3 class="module-heading font-bold text-center mt-5">
    General features
</h3>
<div class="thick-underline"></div>
<div class="container mx-auto con-class shadow-xl mb-10">

    <div class="overflow-x-auto">
        <table class="comparison-table table-auto w-full">
            <thead>
                <tr>
                    <th class="w-1/4 px-4 py-2"></th>
                    <?php if (function_exists('have_rows') && have_rows('firstrow')): ?>
                        <?php while (have_rows('firstrow')):
                            the_row(); ?>
                            <td class="border px-4 py-2 first-colu"><img src="<?php the_sub_field('image1'); ?>" alt="FAQ Photo"
                                    class="logo"></td>
                            <td class="border px-4 py-2"><img src="<?php the_sub_field('image2'); ?>" alt="FAQ Photo"
                                    class="logo"></td>
                            <td class="border px-4 py-2"><img src="<?php the_sub_field('image3'); ?>" alt="FAQ Photo"
                                    class="logo"></td>
                            <td class="border px-4 py-2"><img src="<?php the_sub_field('image4'); ?>" alt="FAQ Photo"
                                    class="logo"></td>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $color_class = '';
                if (function_exists('have_rows') && have_rows('secondrow')):
                    $row_count = 0;
                    while (have_rows('secondrow')):
                        the_row();
                        $row_count++;

                        if ($row_count % 2 == 0) {
                            $color_class = '';
                        } else {
                            $color_class = 'color-border';
                        }
                        ?>
                        <tr class="<?php echo $color_class; ?>">
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <?php if ($i == 1): ?>
                                    <td class="border px-4 py-2 text-center module-text font-bold">
                                        <?php the_sub_field('text' . $i); ?>
                                    </td>
                                <?php elseif ($i == 2): ?>
                                    <td class="border px-4 py-2 font-medium text-center">
                                        <?php the_sub_field('text' . $i); ?>
                                    </td>
                                <?php else: ?>
                                    <td class="border px-4 py-2 font-medium text-center text-gray-600">
                                        <?php the_sub_field('text' . $i); ?>
                                    </td>
                                <?php endif ?>
                            <?php endfor; ?>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>


<?php get_footer() ?>