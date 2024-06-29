<?php
/*
Template Name: Leave Review Form
*/
?>

<?php

global $wpdb;

$successMsg = "";
$errorMsg = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {



    if (empty($_POST['first_name'])) {
        $errors['name'] = 'Name is required';
    }

    if (empty($_POST['surname'])) {
        $errors['surname'] = 'Surname is required';
    }

    if (empty($_POST['user_email'])) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    if (empty($_POST['message'])) {
        $errors['message'] = 'Your message is required';
    } elseif (strlen($_POST['message']) < 3 || strlen($_POST['message']) > 230) {
        $errors['message'] = 'Message must be between 3 and 230 characters long';
    }

    if (empty($_POST['rating']) || $_POST['rating'] < 1 || $_POST['rating'] > 5) {
        $errors['rating'] = 'You have to select a star rating between 1 and 5';
    }

    if (empty($errors)) {
        $name = $_POST['first_name'];
        $surname = $_POST['surname'];
        $email = $_POST['user_email'];
        $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
        $message = $_POST['message'];
        $rating = $_POST['rating'];

        $rating = max(1, min($rating, 5));

        $query = $wpdb->prepare("INSERT INTO reviews (name, surname, email, phone_number, message, rating) VALUES (%s, %s, %s, %s, %s, %d)", $name, $surname, $email, $phone_number, $message, $rating);
        $result = $wpdb->query($query);

        if ($result) {
            $successMsg = "Review submitted successfully";
        } else {
            $errorMsg = "Failed submitting review. Please try again later!";
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

<div class="flex justify-center items-center w-full h-screen bg-white">
    <!-- Left div with image -->
    <div class="hidden lg:block w-1/2 md:hidden">
        <!-- Add your image here -->
        <img src="https://freedesignfile.com/upload/2019/11/Cartoon-illustration-customer-review-vector.jpg"
            alt="Your Image" class="mx-auto my-5" style="width: 80%; height: 500px" />
    </div>
    <!-- Right div with form -->
    <div class="container my-5 px-16 w-full mx-5 lg:w-1/2 rounded-lg shadow-lg">
        <h1 class="module-heading font-bold text-center" style="color:#0f4c75">
            Rate us
        </h1>
        <?php if (!empty($errors)): ?>
            <div class="text-darkred my-2 bg-softred px-4 py-3 rounded-md">
                <?php foreach ($errors as $error): ?>
                    <p>
                        <?= $error ?>
                    </p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <form id="leave-review-form" method="POST" class="px-5">
            <div class="mb-2 flex flex-col justify-center items-center">
                <div class="flex justify-center items-center">
                    <label for="star1" class="star">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1" class="hidden" />
                    <label for="star2" class="star">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2" class="hidden" />
                    <label for="star3" class="star">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3" class="hidden" />
                    <label for="star4" class="star">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4" class="hidden" />
                    <label for="star5" class="star">&#9733;</label>
                    <input type="radio" id="star5" name="rating" value="5" class="hidden" />
                </div>
                <p class='validation-error rating-error text-center mb-3'></p>
            </div>
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2 ">

                <div class="">
                    <input class="w-full bg-gray-200  p-2 rounded focus:outline-none focus:shadow-outline" type="text"
                        placeholder="Name" name="first_name" />
                    <p class='validation-error first-name-error'></p>
                </div>
                <div class="">
                    <input class="w-full bg-gray-200  p-2 rounded focus:outline-none focus:shadow-outline" type="text"
                        placeholder="Surname" name="surname" />
                    <p class='validation-error surname-error'></p>
                </div>
                <div class="">
                    <input class="w-full bg-gray-200  p-2 rounded focus:outline-none focus:shadow-outline" type="email"
                        placeholder="Email Address" name="user_email" />
                    <p class='validation-error email-error'></p>
                </div>
                <div class="">
                    <input class="w-full bg-gray-200 p-2 rounded focus:outline-none focus:shadow-outline" type="text"
                        placeholder="Phone number" name="phone_number" />
                    <p class='validation-error phone-number-error'></p>
                </div>


            </div>
            <div class="my-2">
                <textarea placeholder="Your comment"
                    class="w-full bg-gray-200 h-24 p-2 rounded focus:outline-none focus:shadow-outline" name="message"
                    style='max-height: 120px;min-height:120px'></textarea>
                <p class='validation-error message-error'></p>
            </div>


            <input
                class="my-3 module-text font-bold  bg-menublue hover:bg-hovercolor text-light p-2 rounded w-full focus:outline-none focus:shadow-outline cursor-pointer"
                type='submit' value="Submit">
        </form>
    </div>
</div>

<?php
get_footer();
?>