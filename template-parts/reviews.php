<?php
/*
Template Name: Reviews
*/

global $wpdb;

$sql = "SELECT * FROM reviews ORDER BY id DESC LIMIT 3";
$rows = $wpdb->get_results($sql, ARRAY_A);
get_header();
?>

<section>
    <div class="mx-auto max-w-screen-2xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <div class="flex items-center md:flex md:items-end md:justify-between">
            <div class="w-full mx-auto text-center flex items-center flex-col">
                <h2 class="module-heading font-bold">
                    Read trusted reviews from our customers
                </h2>
                <p class="mt-6 w-full tagline text-center">
                    Explore our wide selection of products and find the perfect fit for your needs. Whether you're
                    looking for cutting-edge technology or timeless classics, we've got you covered. Our expert team is
                    here to help you every step of the way, ensuring you make the right choice.
                </p>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-3 ">
            <?php
            if ($rows) {
                foreach ($rows as $row) {
                    ?>
                    <blockquote class="flex h-full flex-col justify-between bg-gray-100 p-6 shadow-sm sm:p-8 ">
                        <div>
                            <div class="flex gap-0.5 text-green-500 ">
                                <?php
                                $rating = $row["rating"];
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating) {
                                        echo '<svg class="h-10 w-10" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path fill="yellow" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
</svg>';
                                    } else {
                                        echo '<svg class="h-10 w-10" style="color:black" fill="black" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path fill="black" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
</svg>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="mt-4">
                                <p class="mt-4 leading-relaxed text-gray-600">
                                    <?php echo $row['message'] ?>
                                </p>
                            </div>
                        </div>
                        <footer class="mt-4 text-sm font-medium text-gray-600 sm:mt-6">
                            &mdash;
                            <?php echo $row['name'] . " " . $row['surname'] ?>
                        </footer>
                    </blockquote>
                    <?php
                }
            } else {
                echo "<p>No reviews available.</p>";
            }
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>