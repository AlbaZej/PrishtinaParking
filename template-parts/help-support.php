<?php
/*
Template Name: Help and Support
*/
?>
<?php get_header() ?>

<main class="help-support container mx-auto flex-1">
    <div class="relative">
        <div class="help-img-cards w-full md:w-3/4 mx-auto">
            <div class="help-bg-img md:mt-0">
                <div class="relative top-14 flex flex-col text-center items-center font-semibold inset-x-0 search-container
                break-normal">
                    <h3 class="text-3xl mb-2 font-bold text-light">
                        Have questions?
                    </h3>
                    <h3 class="text-3xl mb-20 text-light">
                        How can we help you today?
                    </h3>
                    <div class="relative flex items-center">
                        <input type="text" class="search-input py-4 pl-12 pr-22 border"
                            placeholder="Search keywords...">
                        <ul id="autocomplete-suggestions2">
                        </ul>
                        <button type="submit"
                            class="absolute inset-y-1 right-1 bg-buttonblue text-light px-7">Search</button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 absolute inset-y-5 left-4"
                            viewBox="0 0 512 512">
                            <path fill="#3282B8"
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="help-cards-container z-20  flex flex-col md:flex-row space-y-3 space-x-0 mb-3 md:space-y-0 md:space-x-12 text-footerblack justify-center">

            <?php
            if (function_exists('get_field')):
                $cards = get_field('support_cards');
                if ($cards):
                    foreach ($cards as $card):
                        $headingLink = $card['card_heading']['heading_link'];
                        $headingText = $card['card_heading']['heading_link_text']; ?>

                        <div class="w-full md:w-1/3  bg-white help-cards flex flex-col flex-1 p-10">
                            <div class="pb-6 help-card-header">
                                <a class="medium-text font-bold" href="<?= esc_url($headingLink) ?>">
                                    <?= esc_html($headingText) ?>
                                </a>
                            </div>

                            <?php if ($card['card_links']): ?>
                                <ul class="pt-6 space-y-3 flex-1 text-gray-800">
                                    <?php foreach ($card['card_links'] as $linkItem): ?>
                                        <li class=""><a href="<?php esc_url($linkItem['link']) ?>">
                                                <?= esc_html($linkItem['link_text']) ?>
                                            </a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <div class="pt-4 flex items-center">
                                <a class="text-buttonblue font-semibold mr-2" href="#">View all </a>
                                <svg class="h-4 mt-1" xmlns="http://www.w3.org/2000/svg" fill="#3282B8" viewBox="0 0 448 512">
                                    <path
                                        d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                </svg>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</main>

<div
    class="relative bg-slate-400 z-20 help-bg w-full flex flex-col md:flex-row justify-center items-center px-6 py-20 space-y-8 md:space-y-0">

    <div class="w-1/3  flex flex-col items-center justify-center ">
        <div class="border-4 border-white p-3">
            <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path
                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
            </svg>
        </div>
        <p class="text-center text-lg lg:medium-text font-bold mt-3 md:mb-8 mb-3">Can't find what
            you're looking for? </p>
        <div class="flex items-center">
            <a href="#" class="underline text-light text-base lg:medium-text font-bold  mr-2">Send us a
                message </a>
            <svg class="h-4 mt-1" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 448 512">
                <path
                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
            </svg>
        </div>
    </div>
    <div class="w-1/3  flex flex-col items-center justify-center ">
        <div class="border-4 border-white py-3 px-4">
            <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path
                    d="M0 96C0 60.7 28.7 32 64 32h96c88.4 0 160 71.6 160 160s-71.6 160-160 160H64v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V320 96zM64 288h96c53 0 96-43 96-96s-43-96-96-96H64V288z" />
            </svg>
        </div>
        <p class=" text-center text-lg lg:medium-text font-bold mt-3 mb-3 md:mb-8">Need help listing your
            parking
            space?
        </p>
        <div class="flex items-center">
            <a href="#" class="underline text-light text-base lg:medium-text font-bold  mr-2">Read our
                guide </a>
            <svg class="h-4 mt-1" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 448 512">
                <path
                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
            </svg>
        </div>
    </div>

    <div class="w-1/3  flex flex-col items-center justify-center">
        <div class="border-4 border-white p-3">
            <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path
                    d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z" />
            </svg>
        </div>
        <p class=" text-center text-lg lg:medium-text font-bold mt-3 md:mb-8 mb-3">Hear what our users have
            to say
        </p>
        <div class="flex items-center">
            <a href="#" class="underline text-light text-base lg:medium-text font-bold  mr-2">See our
                reviews </a>
            <svg class="h-4 mt-1" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 448 512">
                <path
                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
            </svg>
        </div>
    </div>
</div>

<?php get_footer() ?>