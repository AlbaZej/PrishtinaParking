<?php
date_default_timezone_set('Europe/Tirane');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingType = $_POST['bookingType'];
    $location = $_POST['location'];
    $bookingData;

    if ($bookingType === 'monthly') {
        $startDate = $_POST['startDateMonthly'];
        $plan = $_POST['planMonthly'];
        $bookingData = ['bookingType' => $bookingType, 'location' => $location, 'startDateMonthly' => $startDate, 'plan' => $plan];
    } elseif ($bookingType === 'daily') {
        $startDate = $_POST['startDateDaily'];
        $exitDate = $_POST['exitDateDaily'];
        $bookingData = ['bookingType' => $bookingType, 'location' => $location, 'startDateDaily' => $startDate, 'exitDateDaily' => $exitDate];
    }

    set_transient('booking_data', $bookingData, DAY_IN_SECONDS);

    wp_redirect('/locations/');
    exit;
}

?>

<div class="banner container mx-auto mt-20 mb-5 pb-2 text-footerblack">

    <div class="flex flex-col md:space-x-0 md:flex-row w-11/12 mx-auto">
        <div class="flex flex-col w-full">
            <h1 class="extralarge-heading mb-8 whitespace-nowrap md:whitespace-normal font-semibold">
                <strong class="block font-bold">Find and book parking </strong>
                in seconds<span class="text-buttonblue ">.</span>
            </h1>

            <img src="<?= get_template_directory_uri(); ?>/assets/images/banner.jpg" class="banner-image" alt="img">

            <form method="POST" id="bannerForm"
                class="banner-form-container w-full sm:w-11/12 md:w-2/3 lg:w-1/2 xl:w-2/5 p-7 rounded">

                <div class="mb-5 w-inherit">
                    <div id="swipes" class="flex border border-neutral-200 p-0.5  bg-neutral-100 rounded">
                        <div class="w-full">
                            <input type="radio" id="monthly" name="bookingType" value="monthly">
                            <label class="w-full rounded" for="monthly">Monthly</label>
                        </div>
                        <div class="w-full">
                            <input type="radio" id="daily" name="bookingType" value="daily" checked>
                            <label class="w-full rounded" for="daily">Daily/Hourly</label>
                        </div>
                    </div>
                </div>


                <div>
                    <label for="location">Where would you like to park?</label>
                    <div class="relative">
                        <input placeholder="Enter your location here.." type="text" id="location" autocomplete="off"
                            class="locationSearch" name="location" list="autocomplete-suggestions">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="absolute inset-y-4 left-2 h-5">
                            <path fill="#9CA3B7"
                                d="M12 2c-4.418 0-8 3.582-8 8 0 5.25 7.115 12.434 7.115 12.434a1 1 0 0 0 1.77 0C12.885 22.434 20 15.25 20 10c0-4.418-3.582-8-8-8zm0 11.5c-1.933 0-3.5-1.566-3.5-3.5s1.567-3.5 3.5-3.5 3.5 1.566 3.5 3.5-1.567 3.5-3.5 3.5z" />
                        </svg>

                    </div>

                    <datalist id="autocomplete-suggestions">
                    </datalist>
                    <p id="bannerMessage" class="validation-error mb-2">
                    </p>
                </div>

                <div id="dailySection" class="form-section daily-section">
                    <label for="startDateDaily">Enter
                        after:</label>
                    <input type="datetime-local" id="startDateDaily" name="startDateDaily"
                        value="<?= date('Y-m-d\TH:i'); ?>" min="<?= date('Y-m-d\TH:i'); ?>">
                    <label for="exitDateDaily">Exit
                        before:</label>
                    <input type="datetime-local" id="exitDateDaily" name="exitDateDaily"
                        value="<?= date('Y-m-d\TH:i', strtotime('+1 hour')) ?>"
                        min="<?= date('Y-m-d\TH:i', strtotime('+1 hour')); ?>">
                </div>
                <div id="monthlySection" class="form-section hidden">

                    <label for="startDateMonthly">Start parking from:</label>
                    <input class="date" type="date" id="startDateMonthly" name="startDateMonthly"
                        value="<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>">
                    <label for="planMonthly">Choose Plan:</label>
                    <select id="planMonthly" class="banner-plan" name="planMonthly">
                        <option selected value="monSun">Monday - Sunday</option>
                        <option value="monFri">Monday - Friday only</option>
                    </select>
                </div>
                <br>
                <input class="submit-btn bg-menublue text-light hover:bg-hovercolor py-3 cursor-pointer rounded"
                    type="submit" value="Show parking places" id="searchBtn">
            </form>
        </div>
    </div>
</div>