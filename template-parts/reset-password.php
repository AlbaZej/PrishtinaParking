<?php
/*
Template Name: Reset Password
*/

$errors = [];
$msg = '';

if (is_user_logged_in()) {
    wp_redirect(home_url("/"));
    exit;
}

function validatePassword($password, &$errors)
{
    if (strlen($password) < 8) {
        $errors['password'] = 'Password should be at least 8 characters long.';
    }

    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        $errors['password'] = 'Password should contain both letters and numbers.';
    }
}


if (!isset($_GET['key']) || !isset($_GET['login'])) {
    $errors['link'] = 'Invalid reset link.';
} else {
    $reset_key = $_GET['key'];
    $login = $_GET['login'];


    $user = check_password_reset_key($reset_key, $login);

    if (!$user || is_wp_error($user)) {
        $errors['link'] = 'Invalid or expired reset link.';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $confirm_password = $_POST['password_confirm'];

        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        } else {
            validatePassword($password, $errors);
        }
        if ($password !== $confirm_password) {
            $errors['password'] = 'Passwords do not match';
        }
        if (empty($errors)) {
            wp_set_password($password, $user->ID);
            set_transient('reset_success', "Your password has been reset successfully.", 5 * 60);

            wp_redirect(home_url('/login/'));
            exit;

        }
    }
}

get_header();
?>

<div class="flex items-stretch min-h-[682.733px] rounded-2xl mx-auto shadow-2xl my-5">
    <div
        class="w-full md:w-max lg:w-[462px] flex flex-col bg-white  rounded-2xl md:rounded-tr-none md:rounded-br-none  p-8 md:p-14">

        <img class="prishtinaLogo" src="<?= get_template_directory_uri(); ?>/assets/images/PrishtinaP.png" alt="Logo">

        <span class="module-text text-gray-600 my-4 text-center">Reset your password</span>

        <?php if (!empty($errors)): ?>
            <div class="text-darkred bg-softred my-4 px-4 py-3 rounded-md">
                <?php foreach ($errors as $error): ?>

                    <p>
                        <?= $error ?>
                    </p>

                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($msg)): ?>
            <p class="text-darkgreen bg-softgreen my-2 px-4 py-3 rounded-md">
                <?= $msg ?>
            </p>
        <?php endif; ?>

        <form id="reset-password-form" method="post">
            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>
                <input class="pl-2 w-full outline-none border-none" type="password" name="password"
                    placeholder="New Password">
            </div>
            <p class="validation-error pl-4 password-error mb-4"></p>

            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                        clip-rule="evenodd" />
                </svg>
                <input class="pl-2 w-full outline-none border-none" type="password" name="password_confirm"
                    placeholder="Confirm Password">
            </div>
            <p class="validation-error pl-4 password-confirm-error mb-5"></p>

            <button type="submit"
                class="w-full bg-menublue p-2 text-light rounded-lg hover:bg-light hover:text-footerblack hover:border hover:border-gray-300">Reset
                Password</button>
        </form>


    </div>
    <div class="relative">
        <img src="<?= get_template_directory_uri() . '/assets/images/Prishtina.jpg' ?>" alt="img" class="w-96 h-full hidden  rounded-2xl md:rounded-tl-none md:rounded-bl-none
            lg:block object-cover" />
        <div
            class="absolute hidden bottom-10 inset-x-1 p-6 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg lg:block ">
            <span class="text-light medium-text font-medium">
                Welcome to PrishtinaParking! <br />
                Need a free spot? <br />You're in the right place to secure your parking.
            </span>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>

</html>