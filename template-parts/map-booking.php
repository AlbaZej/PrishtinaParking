<?php
/*
Template Name: Map and Booking
*/
?>
<?php
date_default_timezone_set('Europe/Tirane');

$bookingData = get_transient('booking_data');
delete_transient('booking_data');


get_header() ?>

<div class="flex flex-col first-background-map md:flex-row w-full flex-1">
    <div class="map-sidebar flex flex-col shrink-0">
        <div id="mapSearchForm" class="py-6 bg-neutral-100">
            <div class="relative flex items-center w-11/12 mx-auto mb-2">
                <input type="text" id="mapSearch" class="w-full h-10 pl-8 pr-20 rounded"
                    placeholder="Where do you want to park?"
                    value="<?= isset($bookingData['location']) ? trim($bookingData['location']) : '' ?>"
                    list="autocomplete-suggestions" autocomplete="off">

                <select name="bookingType" class="absolute inset-y-1 right-1 text-light pl-2 pr-1  bg-menublue rounded"
                    id="bookingType">
                    <option <?= $bookingData && $bookingData['bookingType'] === 'daily' ? 'selected' : ''; ?>
                        value="daily">Daily/Hourly</option>
                    <option <?= $bookingData && $bookingData['bookingType'] === 'monthly' ? 'selected' : ''; ?>
                        value="monthly">Monthly</option>
                </select>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="absolute inset-y-[0.65rem] left-2 h-[1.1rem]">
                    <path fill="#3282B8"
                        d="M12 2c-4.418 0-8 3.582-8 8 0 5.25 7.115 12.434 7.115 12.434a1 1 0 0 0 1.77 0C12.885 22.434 20 15.25 20 10c0-4.418-3.582-8-8-8zm0 11.5c-1.933 0-3.5-1.566-3.5-3.5s1.567-3.5 3.5-3.5 3.5 1.566 3.5 3.5-1.567 3.5-3.5 3.5z" />
                </svg>

                <datalist id="autocomplete-suggestions">
                </datalist>
            </div>

            <div id="monthlySection2"
                class="flex flex-col md:flex-row space-y-1 w-11/12 mx-auto md:space-y-0 md:space-x-2 hidden">
                <div class="flex-1 flex flex-col">
                    <label class=" text-footerblack">Start Date</label>
                    <input class="h-10 px-2 py-1 rounded" id="startDateMonthly" type="date"
                        value="<?= $bookingData && isset($bookingData['startDateMonthly']) ? $bookingData['startDateMonthly'] : date('Y-m-d'); ?>"
                        name="startDateMonthly" min="<?= date('Y-m-d'); ?>">
                </div>
                <div class="flex-1 flex flex-col">
                    <label class=" text-footerblack">Choose Plan</label>
                    <select class="h-10 px-2 py-1 rounded" id="planMonthly" name="planMonthly">
                        <option value="monSun" <?= isset($bookingData['plan']) && $bookingData['plan'] === 'monSun' ? 'selected' : ''; ?>>Monday - Sunday</option>
                        <option value="monFri" <?= !isset($bookingData['plan']) || $bookingData['plan'] === 'monFri' ? 'selected' : ''; ?>>Monday - Friday only</option>
                    </select>

                </div>
            </div>

            <div id="dailySection2"
                class="flex flex-col w-11/12 mx-auto md:flex-row space-y-1 md:space-y-0 md:space-x-1">
                <div class="flex-1 flex flex-col">
                    <label class=" text-footerblack">Start Time</label>
                    <input class="h-10 px-2 py-1 rounded" type="datetime-local" name="startDateDaily"
                        value="<?= $bookingData && isset($bookingData['startDateDaily']) ? $bookingData['startDateDaily'] : date('Y-m-d\TH:i'); ?>"
                        min="<?= date('Y-m-d\TH:i'); ?>" id="startDateDaily">
                </div>
                <div class="flex-1 flex flex-col">
                    <label class=" text-footerblack">Exit Time</label>
                    <input class="h-10 px-2 py-1 rounded" type="datetime-local"
                        value="<?= $bookingData && isset($bookingData['exitDateDaily']) ? $bookingData['exitDateDaily'] : date('Y-m-d\TH:i', strtotime('+1 hour')); ?>"
                        id="exitDateDaily" name="exitDateDaily" min="<?= date('Y-m-d\TH:i', strtotime('+1 hour')); ?>">
                </div>
            </div>
        </div>
        <ul id="parkingList" class="bg-white w-full md:block border border-neutral-100 space-y-3">
        </ul>
    </div>
    <div id="map"></div>
</div>

<script>
    let loggedIn = "<?= is_user_logged_in() ?>"
    let userEmail = "<?= wp_get_current_user()->user_email; ?>"
    let userName = "<?= wp_get_current_user()->display_name; ?>"
    let parkingImg = "<?= get_template_directory_uri() . '/assets/images/parking-lot-21.jpg' ?>"
</script>
<?php get_footer() ?>