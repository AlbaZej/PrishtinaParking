<?php
/*
Template Name: Contact Us
*/

$successMsg = "";
$errorMsg = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["full-name"])) {
        $errors["full-name"] = "Full name is required.";
    }
    if (empty($_POST["email-address"]) || !filter_var($_POST["email-address"], FILTER_VALIDATE_EMAIL)) {
        $errors["email-address"] = "Please enter a valid email address.";
    }
    if (!empty($_POST["phone-number"]) && !preg_match('/^(\+383)?\d{9}$/', $_POST["phone-number"])) {
        $errors["phone-number"] = "Please enter a valid phone number.";
    }
    if (empty($errors)) {
        $full_name = sanitize_text_field($_POST["full-name"]);
        $email_address = sanitize_email($_POST["email-address"]);
        $phone_number = sanitize_text_field($_POST["phone-number"]);
        $message = sanitize_textarea_field($_POST["message"]);
        $terms_accepted = isset($_POST["terms"]) ? 1 : 0;

        $admin_email = get_option('admin_email');
        $subject = "New Contact Form Submission";
        $part = generate_contact_form_submission_body($full_name, $email_address, $phone_number, $message);
        $email_body = generate_html_email_body($subject, $part);
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $result = wp_mail($admin_email, $subject, $email_body, $headers);
        if (!$result) {
            $errorMsg = "Failed to submit contact form. Try again later!";
        } else {
            $successMsg = "Contact form has been submitted successfully!";
        }
    }
}
get_header();
?>
<div class="container mx-auto">
    <?php if (!empty($errorMsg)): ?>
        <p class="error-message text-darkred my-2 text-center bg-softred px-4 py-3 rounded-md">
            <?= $errorMsg ?>
        </p>
    <?php elseif (!empty($successMsg)): ?>
        <p class="success-message text-darkgreen my-2 text-center bg-softgreen  px-4 py-3 rounded-md">
            <?= $successMsg ?>
        </p>
    <?php endif; ?>
</div>
<div class="flex min-h-screen bg-white">
    <div class="md:w-1/2 max-w-lg mx-auto my-20 px-4 py-5 shadow-none">
        <div class="text-left">
            <h1 class="module-heading font-bold py-5">
                <span class="text-buttonblue"> Feel free</span> to get in touch
                anytime.
            </h1>
            <h3 class="tagline">
                Please feel free to get in touch anytime via the contact form below,
                whether you have a query, suggestion or feedback.
            </h3>
        </div>
        <?php if (!empty($errors)): ?>
            <div class="text-darkred my-2 bg-softred px-4 py-3 rounded-md">
                <?php foreach ($errors as $error): ?>
                    <p>
                        <?= $error ?>
                    </p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <form method="POST">
            <div class="mt-5">
                <label for="full-name" class="block mb-1 px-1">Full name</label>
                <input id="full-name" name="full-name" type="text"
                    class=" w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent" />
                <p class="validation-error  full-name-error mb-5"></p>
            </div>

            <div class="mt-5">
                <label for="email-address" class="block mb-1 px-1">Email address</label>
                <input type="email" name="email-address"
                    class=" w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent" />
                <p class="validation-error  email-error mb-5"></p>
            </div>
            <div class="mt-5">
                <label for="phone-number" class="block mb-1 px-1">Phone number</label>
                <input type="text" name="phone-number"
                    class=" w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent" />
                <p class="validation-error  phone-error mb-5"></p>
            </div>
            <div class="mt-5">
                <label for="message" class="block mb-1 px-1">Message</label>
                <textarea name="message"
                    class="w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent"></textarea>
                <p class="validation-error message-error mb-5"></p>
            </div>

            <div class="mt-6 px-1 text-sm text-gray-800">
                <input type="checkbox" name="terms" />
                <span display="inline" class="">By clicking this you are agreeing to our
                    <a class="" href="#" target="_blank" data-test="Link">
                        <span class="underline">Terms and Conditions</span>
                    </a>
                    and
                    <a class="" href="#" target="_blank" data-test="Link">
                        <span class="underline">Privacy Policy</span>
                    </a>
                </span>
                <p class="validation-error terms-error mb-5"></p>
            </div>

            <div class="mt-10">
                <input type="submit" value="Get in touch"
                    class="cursor-pointer py-3 bg-menublue text-light w-full rounded hover:bg-hovercolor" />
            </div>
        </form>
    </div>
    <div class="w-1/2 bg-cover self-start mt-20 items-center md:flex hidden">
        <img class="" src="<?= get_template_directory_uri(); ?>/assets/images/contact-us.png" alt="" />
    </div>
</div>


<?php
get_footer();
?>