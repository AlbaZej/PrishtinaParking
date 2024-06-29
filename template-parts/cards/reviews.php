<?php
global $wpdb;
$reviews = $wpdb->get_results("SELECT * FROM reviews ORDER BY id DESC LIMIT 5");
?>
<div class="text-center reviews-container">
    <div class="mb-[82px]">
        <h3 class="module-heading font-bold text-center">
            Reviews
        </h3>
        <div class="thick-underline "></div>
    </div>

    <div class="carousel-wrapper relative mx-auto">
        <div class="arrow-container">
            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                    d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
        </div>
        <div class="review-carousel ">
            <?php foreach ($reviews as $review): ?>
                <div class="card text-left">
                    <img class="h-20 mx-4 mb-2 object-contain self-start"
                        src="<?= get_template_directory_uri() . '/assets/images/trustpilot-review.jpg' ?>"
                        alt="Trustpilot review">
                    <blockquote class="tagline mx-8">"<?= stripslashes($review->message) ?>" </blockquote>
                    <div class="mt-4">
                        <div class="cite ml-8 "></div>
                        <p class="inline ml-2 font-bold module-text mx-8"><?= $review->name . ' ' . $review->surname ?> </p>
                    </div>

                </div>
            <?php endforeach ?>
        </div>

        <div class="arrow-container">
            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
            </svg>
        </div>
    </div>
</div>