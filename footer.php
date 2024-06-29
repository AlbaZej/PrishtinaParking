<footer class="bg-footerblack w-full mt-auto">
    <div
        class="container mx-auto flex flex-col-reverse py-8 px-6 space-y-4 md:flex-row md:space-y-0 md:space-x-2 md:justify-around items-center md:items-start">
        <div class="flex flex-col space-y-4 justify-between items-center mt-6 md:mt-0">
            <img class="h-20" src="<?= get_template_directory_uri() . '/assets/images/prishtina-parking-logo.png' ?>"
                alt="Prishtina Parking Logo">
            <?php dynamic_sidebar('footer-widget-1'); ?>
            <p class="text-xs font-500 footer-copy"> Copyright
                <?= date('Y') ?> &copy; PrishtinaParking
            </p>
        </div>
        <?php
        if (has_nav_menu('footer-menu')) {
            wp_nav_menu(
                array(
                    'theme_location' => 'footer-menu',
                    'menu_class' => 'flex flex-col space-y-6 space-x-0 md:flex-row md:space-x-12 md:space-y-0 text-center md:text-start footer-menu',
                    'container' => false
                )
            );
        }
        ?>
    </div>
</footer>
<?php wp_footer() ?>
</body>

</html>