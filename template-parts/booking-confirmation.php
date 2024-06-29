<?php
/* Template Name: Booking Confirmation */

if (!is_user_logged_in() || !isset($_GET['id'])) {
    wp_redirect('/');
    exit;
}
delete_transient("payment_data");
global $wpdb;
$transactionId = $_GET['id'];
$query = $wpdb->prepare(
    "SELECT b.*, p.name 
     FROM {$wpdb->prefix}bookings AS b 
     JOIN {$wpdb->prefix}parking_lots AS p 
     ON b.parking_id = p.id 
     WHERE b.transaction_id = %s",
    $transactionId
);

$result = $wpdb->get_row($query);

if (!$result || $result->user_id != get_current_user_id()) {
    wp_redirect('/');
    exit;
}

get_header();
?>
<div class="bg-gray-100 min-h-screen flex flex-col justify-center items-center py-5">
    <h1 class="large-text font-bold text-center text-footerblack ">Booking Confirmed!</h1>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-12  my-4" fill="none" viewBox="0 0 24 24" stroke="#22c55e">
        <circle cx="12" cy="12" r="10" fill="#ffffff" stroke="#22c55e" stroke-width="2" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l3 3 6-6" />
    </svg>
    <p class="text-lg mb-4">Thank you for booking with us. Your booking details will be sent to your
        email
        shortly.
    </p>
    <div class="flex mb-6">
        <a href="/" class="bg-menublue hover:bg-hovercolor text-light font-bold py-2 px-4 mr-4 rounded">Go to
            Home
        </a>
        <a href="/user-profile" class="bg-menublue hover:bg-hovercolor text-light font-bold py-2 mr-4 px-4 rounded">View
            Profile</a>
        <a href="/leave-review" class="bg-menublue hover:bg-hovercolor text-light font-bold py-2 px-4 rounded">Leave
            Review</a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden md:w-1/2 w-full mb-1">
        <div class="p-6">
            <h2 class="medium-text font-bold  text-gray-800 mb-4">Booking Details</h2>
            <dl class="grid grid-cols-2 gap-6">
                <div class="py-2">
                    <dt class=" font-semibold text-gray-600">Booking Date</dt>
                    <dd class="medium-text font-bold ">
                        <?= $result->booking_date ?>
                    </dd>
                </div>
                <div class="py-2">
                    <dt class="font-semibold text-gray-600">Parking Lot</dt>
                    <dd class="medium-text font-bold ">
                        <?= $result->name ?>
                    </dd>
                </div>
                <?php if ($result->booking_type === 'monthly'): ?>
                    <div class="py-2">
                        <dt class=" font-semibold text-gray-600">Start Date</dt>
                        <dd class="medium-text font-bold ">
                            <?= $result->start_date_monthly ?>
                        </dd>
                    </div>
                    <div class="py-2">
                        <dt class=" font-semibold text-gray-600">Plan</dt>
                        <dd class="medium-text font-bold ">
                            <?= $result->plan === 'monFri' ? 'Mon-Fri' : 'Mon-Sun' ?>
                        </dd>
                    </div>
                <?php else: ?>
                    <div class="py-2">
                        <dt class="font-semibold text-gray-600">Start Date</dt>
                        <dd class="medium-text font-bold ">
                            <?= $result->start_date_daily ?>
                        </dd>
                    </div>
                    <div class="py-2">
                        <dt class="font-semibold text-gray-600">Exit Date</dt>
                        <dd class="medium-text font-bold ">
                            <?= $result->exit_date_daily ?>
                        </dd>
                    </div>
                <?php endif; ?>
                <div class="py-2">
                    <dt class="font-semibold text-gray-600">Ticket Price</dt>
                    <dd class="medium-text font-bold ">
                        <?= $result->ticket_price ?> €
                    </dd>
                </div>
                <div class="py-2">
                    <dt class="font-semibold text-gray-600">Payment Status</dt>
                    <dd class="medium-text font-bold ">
                        <?= $result->payment_status ?>
                    </dd>
                </div>
                <div class="py-2">
                    <dt class="font-semibold text-gray-600">Vehicle Registration Plate</dt>
                    <dd class="medium-text font-bold ">
                        <?= $result->vehicle_plate ?>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
<?php
get_footer();
