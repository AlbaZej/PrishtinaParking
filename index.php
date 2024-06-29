<?php
ob_start();
get_header();


get_template_part('template-parts/banner');
get_template_part('template-parts/getting-started');
get_template_part('template-parts/cards/cards');
get_template_part('template-parts/cards/reviews');
get_template_part('template-parts/cards/mobile');
get_template_part('template-parts/galeri');
get_template_part('template-parts/offers-menu');
get_template_part('template-parts/offersdetails');
get_template_part('template-parts/faq');




get_footer();
?>

<div class="scroll-to-top " id="scrollToTopButton">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5">
        <path fill="#ffffff"
            d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z" />
    </svg>
</div>

<?php
ob_flush();