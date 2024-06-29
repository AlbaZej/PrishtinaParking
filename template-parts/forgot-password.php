<?php
/*
Template Name: Custom Forgot Password
*/

$errors = [];
$msg = '';

if (is_user_logged_in()) {
    wp_redirect(home_url("/"));
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

    if (empty($user_email)) {
        $errors['email'] = "Email address is required";
    } else {
        $user = get_user_by('email', $user_email);

        if ($user) {
            $reset_key = get_password_reset_key($user);
            $reset_link = add_query_arg(['key' => $reset_key, 'login' => rawurlencode($user->user_login)], site_url('reset-password'));
            $message = "To reset your password, click on this link: <a href='$reset_link'>$reset_link</a>";

            $email_body = generate_html_email_body('Password Reset', $message);
            $headers[] = 'Content-Type: text/html; charset=UTF-8';

            $mailed = wp_mail($user_email, 'Password Reset', $email_body, $headers);
            if ($mailed) {
                $msg = "Password reset email has been sent. Please check your email.";
            } else {
                $errors['password-reset-email'] = "Failed to send password reset email. Please try again later.";
            }
        } else {
            $errors['email'] = "No user found with that email address.";
        }
    }
}

get_header();
?>

<div class="flex items-stretch min-h-[682.733px] rounded-2xl mx-auto shadow-2xl my-5">
    <div
        class="w-full md:w-max lg:w-[462px] flex flex-col bg-white  rounded-2xl md:rounded-tr-none md:rounded-br-none  p-8 md:p-14">

        <img class="prishtinaLogo" src="<?= get_template_directory_uri(); ?>/assets/images/PrishtinaP.png" alt="Logo">

        <span class="module-text text-gray-600 my-4 text-center">Forgot your password?</span>
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
        <form id="forgot-password-form" method="post">
            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
                <input class="pl-2 w-full outline-none border-none" type="email" name="email"
                    placeholder="Email Address" />
            </div>
            <p class="validation-error pl-4 email-error mb-5"></p>
            <button type="submit"
                class="block w-full bg-menublue mt-4 py-2 rounded-2xl text-light font-semibold mb-2">Reset
                Password</button>
            <div class="text-center text-gray-500 mt-4">
                Remembered your password?
                <span class="font-bold text-footerblack">
                    <a href="/login/">Log In</a>
                </span>
            </div>
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