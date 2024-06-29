<?php
/*
Template Name: Login
*/


if (is_user_logged_in()) {
    wp_redirect(home_url("/"));
    exit;
}

$msg;
if (get_transient("reset_success")) {
    $msg = get_transient("reset_success");
    delete_transient("reset_success");
}
if (get_transient("register_success")) {
    $msg = get_transient("register_success");
    delete_transient("register_success");
}


$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']) && $_POST['remember'] == 'on' ? true : false;

    if (empty($username)) {
        $errors['username'] = 'Username is required';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }

    if (count($errors) === 0) {
        $existing_user = get_user_by('login', $username);

        if (!$existing_user || strtolower($existing_user->user_login) !== strtolower($username)) {
            $errors[] = 'Username does not exist';
        } else {
            if (wp_check_password($password, $existing_user->user_pass, $existing_user->ID)) {
                if ($remember) {
                    setcookie('custom_login_user', $existing_user->user_login, time() + 30 * 24 * 60 * 60, COOKIEPATH, COOKIE_DOMAIN);
                }
                wp_set_current_user($existing_user->ID, $existing_user->user_login);
                wp_set_auth_cookie($existing_user->ID);

                $redirect_url = isset($_GET['redirect']) && !empty($_GET['redirect']) && $_GET['redirect'] == 'locations' ? '/locations/' : home_url('/');

                do_action('wp_login', $existing_user->user_login);

                wp_redirect($redirect_url);
                exit;
            } else {
                $errors['password'] = 'Invalid password';
            }
        }
    }
}

get_header();
?>

<div class="flex items-stretch rounded-2xl mx-auto shadow-2xl my-5">
    <div class="w-full lg:w-max flex flex-col bg-white  rounded-2xl md:rounded-tr-none md:rounded-br-none  p-8 md:p-14">

        <img class="prishtinaLogo" src="<?= get_template_directory_uri(); ?>/assets/images/PrishtinaP.png" alt="Logo">

        <span class="module-text text-gray-600 my-4 text-center">
            Log into your PrishtinaParking account.
        </span>
        <?php if (!empty($errors)): ?>
            <div class="text-darkred bg-softred my-4 px-4 py-3 rounded-md">
                <?php foreach ($errors as $error): ?>

                    <p>
                        <?= $error ?>
                    </p>

                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($msg)): ?>
            <p class="text-darkgreen bg-softgreen my-4 px-4 py-3 rounded-md">
                <?= $msg ?>
            </p>
        <?php endif; ?>
        <form method="post" id="loginForm"
            action="?redirect=<?= isset($_GET['redirect']) && $_GET['redirect'] === 'locations' ? 'locations' : ''; ?>">

            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
                <input class="pl-2 w-full outline-none border-none"
                    value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" type="text" name="username"
                    placeholder="Username" />
            </div>
            <p class="validation-error pl-4 username-error mb-4"></p>
            <div class="flex items-center border-2 py-2 px-3 rounded-2xl relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>
                <input class="pl-2 w-full outline-none border-none" type="password" name="password"
                    placeholder="Password" />
            </div>
            <p class="validation-error pl-4 password-error mb-4">
            </p>
        </form>

        <div class="flex justify-between w-full py-2">
            <div>
                <input type="checkbox" class="ml-2 whitespace-nowrap font-semibold" name="remember" id="remember">
                <label for="remember">Remember for 30 days?</label>
            </div>
            <a class="font-bold whitespace-nowrap mr-2" href="/forgot-password">
                Forgot password?
            </a>
        </div>


        <button type="submit" form="loginForm"
            class="w-full bg-menublue mt-4 py-2 rounded-2xl text-light font-semibold mb-6 hover:bg-hovercolor">
            Log in
        </button>

        <button class="text-center w-full bg-lightblue text-footerblack text-md py-2 rounded-2xl mb-4 hover:bg-light
            hover:text-footerblack hover:border hover:border-gray-300">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/google.svg" alt="img"
                class="inline align-bottom w-6 h-6 " />
            Sign in With Google
        </button>

        <button class="text-center  w-full bg-lightblue text-footerblack text-md py-2 rounded-2xl mb-4 hover:bg-light
            hover:text-footerblack hover:border hover:border-gray-300">
            <img src="<?= get_template_directory_uri(); ?>/assets/images/facebook.svg" alt="img"
                class="w-6 h-6 align-bottom inline " />
            Sign in With Facebook
        </button>


        <div class="text-center text-gray-500 mt-4">
            Don't have an account?
            <span class="font-bold text-black"><a href="/sign-up/">
                    Sign Up
                </a>
            </span>
        </div>



    </div>
    <div class="relative">
        <img src="<?= get_template_directory_uri() . '/assets/images/Prishtina.jpg' ?>" alt="img"
            class="w-96 hidden h-full rounded-2xl md:rounded-tl-none md:rounded-bl-none lg:block object-cover" />
        <div
            class="absolute hidden bottom-10 inset-x-1 p-6 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg lg:block ">
            <span class="text-light medium-text font-medium">
                Welcome to PrishtinaParking! <br />
                Need a free spot? <br />You're in the right place to secure your parking.
            </span>
        </div>
    </div>
</div>
<?php wp_footer() ?>
</body>

</html>