<?php
/*
Template Name: Sign Up
*/

if (is_user_logged_in()) {
    wp_redirect(home_url("/"));
    exit;
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    if (strlen($username) < 3 || strlen($username) > 20) {
        $errors['username'] = 'Username should be between 3 and 20 characters long';
    }

    if (strlen($password) < 8) {
        $errors['password-length'] = 'Password should be at least 8 characters long';
    }

    if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)) {
        $errors['password-contain'] = 'Password should contain both letters and numbers';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    if (count($errors) === 0) {
        global $wpdb;

        $existing_user = username_exists($username);
        if ($existing_user) {
            $errors['username'] = 'Username exists';
        } else {
            $user_id = wp_create_user($username, $password, $email);
            if (!is_wp_error($user_id)) {
                set_transient('register_success', "Your account has been created successfully. You may log in!", 5 * 60);
                wp_redirect(home_url("/login"));
                exit;
            } else {
                $errors['registration'] = 'Error registering user';
            }
        }
    }
}

get_header();
?>

<div class="flex items-stretch min-h-[682.733px] rounded-2xl mx-auto shadow-2xl my-5">
    <div
        class="w-full md:w-max lg:w-[462px] flex flex-col bg-white  rounded-2xl md:rounded-tr-none md:rounded-br-none  p-8 md:p-14">

        <img class="prishtinaLogo" src="<?= get_template_directory_uri(); ?>/assets/images/PrishtinaP.png" alt="Logo">

        <span class="module-text text-gray-600 my-4 text-center">Create your PrishtinaParking account.</span>

        <?php if (!empty($errors)): ?>
            <div class="text-darkred bg-softred my-4 px-4 py-3 rounded-md">
                <?php foreach ($errors as $error): ?>
                    <p>
                        <?= $error ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


        <form method="post">

            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
                <input class="pl-2 w-full outline-none border-none" type="text" name="username"
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
            <p class="validation-error pl-4 password-error mb-4"></p>

            <!-- Email input -->
            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
                <input class="pl-2 w-full outline-none border-none" type="email" name="email"
                    placeholder="Email Address" />
            </div>
            <p class="validation-error pl-4 email-error mb-5"></p>


            <button type="submit"
                class="w-full bg-menublue mt-4 py-2 rounded-2xl text-light font-semibold mb-4 hover:bg-hovercolor">Register</button>
        </form>

        <div class="text-center text-gray-500 mt-4">
            Already have an account?
            <span class="font-bold text-footerblack">
                <a href="/login/">Log In</a>
            </span>
        </div>



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