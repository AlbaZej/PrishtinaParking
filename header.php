
<!DOCTYPE html>
<html lang="en">

<head>
    <?php wp_head(); ?>
    <meta charset="UTF-8">
    <title>PrishtinaParking</title>
    <link rel="shortcut icon" href="<?= get_template_directory_uri(); ?>/assets/images/favicon.ico" />

</head>

<body class="min-h-screen flex flex-col">

    <div class="bg-footerblack text-white relative z-60">
        <header class="container mx-auto flex flex-col lg:flex-row justify-between items-center">
            <a href="/"><img class="h-16 object-contain"
                    src="<?= get_template_directory_uri() . '/assets/images/prishtina-parking-logo.png' ?>"></a>
            <div class="burger-menu lg:hidden cursor-pointer">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div class="all-menu-items flex flex-col lg:flex-row ">
                <?php
                if (has_nav_menu('primary-menu')) {
                    wp_nav_menu([
                        'theme_location' => 'primary-menu',
                        'container' => false,
                        'menu_class' => 'flex flex-col space-y-2 lg:space-x-2 lg:space-y-0 lg:flex-row justify-center items-center
            mb-2 lg:mb-0',
                        'walker' => new Tailwind_WP_Nav_Menu_Walker(),
                    ]);
                }
                ?>
                <div
                    class="flex items-center justify-center flex-col space-y-2 mb-2 lg:flex-row lg:space-x-2 lg:space-y-0 lg:mb-0">
                    <?php if (!is_user_logged_in()): ?>
                        <a href="/login/"
                            class="lg:ml-4 rounded px-6 py-2 border border-light hover:bg-light hover:text-footerblack">Login</a>
                        <a href="/sign-up/"
                            class="rounded bg-buttonblue hover:bg-[#3273B8] border border-buttonblue px-4 hover:border-[#3273B8] py-2 whitespace-nowrap">Sign
                            Up</a>
                    <?php else:

                        $user_id = get_current_user_id();
                        $user_display_name = wp_get_current_user()->display_name;
                        $avatar_url = get_user_meta($user_id, 'avatar_image', true) ? get_user_meta($user_id, 'avatar_image', true) : get_avatar_url($user_id);

                        if (!empty($avatar_url)): ?>
                            <div class="relative ml-4 mr-4">
                                <div class="flex w-full  items-center justify-between cursor-pointer" id="user-profile">
                                    <img src="<?= esc_url($avatar_url) ?>" alt="User Avatar"
                                        class="w-8 h-8 rounded-full object-cover header-avatar">
                                    <span class="user-display-name ml-2">
                                        <?= esc_html($user_display_name) ?>
                                    </span>
                                    <svg class=" group-hover:fill-sky-700 inline w-4 ml-1 h-4  transition-transform duration-200 transform"
                                        clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m16.843 10.211c.108-.141.157-.300.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.750.367-.750.755 0 .157.050.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.360.290.592.290.230 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z"
                                            fill="#fff"></path>
                                    </svg>
                                </div>
                                <?php if (has_nav_menu('user-profile-menu')): ?>
                                    <?php wp_nav_menu([
                                        'theme_location' => 'user-profile-menu',
                                        'container' => false,
                                        'menu_class' => 'user-profile-menu w-full lg:w-[7.9rem] static lg:absolute bg-footerblack text-light hidden',
                                    ]); ?>

                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </header>
    </div>