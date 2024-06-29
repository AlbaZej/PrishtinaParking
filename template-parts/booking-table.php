
<?php
/*
Template Name: Bookings
*/

get_header(); 
global $wpdb;

$bookings_per_page = 8;
$selected_button = isset($_GET['selected_button']) ? $_GET['selected_button'] : 'daily';

$query = "SELECT b.*, p.name AS parking_lot_name 
          FROM {$wpdb->prefix}bookings AS b
          LEFT JOIN {$wpdb->prefix}parking_lots AS p 
          ON b.parking_id = p.id";

if ($selected_button === 'daily') {
    $query .= " WHERE b.booking_type = 'daily'";
} elseif ($selected_button === 'monthly') {
    $query .= " WHERE b.booking_type = 'monthly'";
}


// Handle search by date
if (isset($_POST['search_date']) && !empty($_POST['search_date'])) {
    $search_date = $_POST['search_date'];

    if($selected_button === 'daily') {
        $query .= ' AND DAY(start_date_daily) = DAY("'.$search_date.'")';
    } else {
        $query .= ' AND MONTH(start_date_monthly) = MONTH("'.$search_date.'-01'.'")';
    }
}

$query .= " ORDER BY booking_date DESC";

$bookings_count = $wpdb->get_var("SELECT COUNT(*) FROM ($query) as count_query");

$total_pages = ceil($bookings_count / $bookings_per_page);

$current_page = isset($_POST['paged']) ? absint($_POST['paged']) : 1;
$offset = ($current_page - 1) * $bookings_per_page;

$query .= " LIMIT $offset, $bookings_per_page";

$bookings = $wpdb->get_results($query, ARRAY_A);

?>


<div class="container mx-auto mt-8 container-bookx">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 overflow-hidden">
        <div class="flex justify-center">
            <form method="GET" action="<?php echo esc_url(get_permalink()); ?>">
                <button type="submit" name="selected_button" value="daily" class="bg-menublue <?php echo ($selected_button === 'daily') ? 'active-button' : ''; ?> hover:bg-hoverhoverbtn text-white font-bold py-2 px-4 rounded mr-4 focus:outline-none focus:shadow-outline">Daily Bookings</button>
                <button type="submit" name="selected_button" value="monthly" class="bg-menublue <?php echo ($selected_button === 'monthly') ? 'active-button' : ''; ?> hover:bg-hoverhoverbtn text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Monthly Bookings</button>
            </form>
        </div>
        <?php
        $redirect_uri = add_query_arg ('selected_button', $selected_button, get_permalink ()) ;
        ?>
        <form method="POST" action="<?php echo esc_url($redirect_uri); ?>" class="px-4 py-3 sm:px-6 flex items-center justify-center ">
            <div class="flex items-center justify-center w-full sm:w-auto">
                <label for="search_date" class="block text-sm font-medium text-black mr-4">Search by Date:</label>
                <?php
                $inputType = 'date';
                if ($selected_button === 'monthly') {
                    $inputType = 'month';
                }
                ?>
                <input type="<?php echo $inputType; ?>" id="search_date" name="search_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:w-auto shadow-sm sm:text-sm border-gray-300 rounded-md mr-5 pl-2 py-1" value="<?php echo isset($_GET['search_date']) ? esc_attr($_GET['search_date']) : ''; ?>">
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-hoverhoverbtn hover:bg-menublue focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:text-white ml-4 sm:ml-0 mt-1">Search</button>
        </form>

        <?php if (!empty($bookings)) : ?>
            <div class="table-responsive sm:overflow-x-auto">
                <table class="min-w-full mt-16 divide-y divide-gray-200 divide-x border-remove sm:w-full overflow-x-scroll">
                    <thead class="bg-menublue">
                        <tr>
                            <?php if ($selected_button === 'daily' || $selected_button === 'monthly' || isset($_GET['search_date'])) : ?>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Booking Date</th>
                            <?php endif; ?>
                            <?php if ($selected_button === 'daily') : ?>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Start Date</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Exit Date</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Price</th>
                            <?php elseif ($selected_button === 'monthly') : ?>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Start Date</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Plan</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Price</th>
                            <?php endif; ?>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Parking Lot Name</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-center border-remove-tbody">
                        <?php foreach ($bookings as $booking) : ?>
                            <tr>
                                <?php if ($selected_button === 'daily' || $selected_button === 'monthly' || isset($_GET['search_date'])) : ?>
                                    <td class="px-6 py-4 sm:px-3 sm:py-2 whitespace-nowrap"><?php echo esc_html(date('Y-m-d', strtotime($booking['booking_date']))); ?></td>
                                <?php endif; ?>
                                <?php if ($selected_button === 'daily') : ?>
                                    <td class="px-6 py-4 sm:px-3 sm:py-2 whitespace-nowrap"><?php echo esc_html(date('j F Y \a\t g:ia', strtotime($booking['start_date_daily']))); ?></td>
                                    <td class="px-6 py-4 sm:px-3 sm:py-2 whitespace-nowrap"><?php echo esc_html(date('j F Y \a\t g:ia', strtotime($booking['exit_date_daily']))); ?></td>
                                    <td class="px-6 py-4 sm:px-3 sm:py-2 whitespace-nowrap"><?php echo esc_html(intval($booking['ticket_price'])) . '€'; ?></td>
                                <?php elseif ($selected_button === 'monthly') : ?>
                                    <td class="px-6 py-4 sm:px-3 sm:py-2 whitespace-nowrap"><?php echo esc_html(date('j F Y \a\t g:ia', strtotime($booking['start_date_monthly']))); ?></td>
                                    <td class="px-6 py-4 sm:px-3 sm:py-2 whitespace-nowrap"><?php echo esc_html(replace_plan_description($booking['plan'])); ?></td>
                                    <td class="px-6 py-4 sm:px-3 sm:py-2 whitespace-nowrap"><?php echo esc_html(intval($booking['ticket_price'])) . '€'; ?></td>
                                <?php endif; ?>
                                <td class="px-6 py-4 sm:px-3 sm:py-2 whitespace-nowrap"><?php echo isset($booking['parking_lot_name']) ? esc_html($booking['parking_lot_name']) : ''; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php
            // Display pagination links
            if ($total_pages > 1) {
                echo '<div class="flex justify-center mt-4">';
                echo '<nav class="bg-white border border-gray-300 rounded-md shadow-sm" aria-label="Pagination">';
                echo '<ul class="flex flex-row p-2">';

                if ($current_page > 1) {
                    echo '<li class="mr-2">';
                    echo '<form method="POST" action="' . esc_url(get_permalink()) . '">';
                    echo '<input type="hidden" name="paged" value="' . ($current_page - 1) . '">';
                    echo '<button type="submit" class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300">Previous</button>';
                    echo '</form>';
                    echo '</li>';
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<li class="mr-2">';
                    echo '<form method="POST" action="' . esc_url(get_permalink()) . '">';
                    echo '<input type="hidden" name="paged" value="' . $i . '">';
                    echo '<button type="submit" class="px-3 py-1 ' . (($current_page == $i) ? 'bg-blue-500 text-white' : 'bg-gray-200 hover:bg-gray-300') . ' rounded-md">' . $i . '</button>';
                    echo '</form>';
                    echo '</li>';
                }

                if ($current_page < $total_pages) {
                    echo '<li>';
                    echo '<form method="POST" action="' . esc_url(get_permalink()) . '">';
                    echo '<input type="hidden" name="paged" value="' . ($current_page + 1) . '">';
                    echo '<button type="submit" class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300">Next</button>';
                    echo '</form>';
                    echo '</li>';   
                }

                echo '</ul>';
                echo '</nav>';
                echo '</div>';
            }
            ?>

        <?php else : ?>
            <div class="px-4 py-5 sm:px-6">
                <p class="text-sm font-medium text-gray-500">No bookings found for the selected date.</p>
            </div>
        <?php endif; ?>

    </div>
</div>


<?php get_footer(); ?>