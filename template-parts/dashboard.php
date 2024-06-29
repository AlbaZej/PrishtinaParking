<?php
/*
Template Name: User Dashboard
*/
get_header();
global $wpdb;
// Get the current WordPress user's ID
$current_user_id = get_current_user_id();

// Function to fetch bookings for the current user
function fetchUserBookings($date, $user_id, $wpdb)
{
    $sql = "SELECT * FROM wp_bookings WHERE (DATE(start_date_daily) = '$date' OR DATE(exit_date_daily) = '$date') AND user_id = '$user_id'";
    $result = $wpdb->get_results($sql); // Use get_results instead of query
    return $result;
}

// Fetch yesterday, today, and tomorrow bookings for the current user
$yesterday_bookings = fetchUserBookings(date('Y-m-d', strtotime('-1 day')), $current_user_id, $wpdb);
$today_bookings = fetchUserBookings(date('Y-m-d'), $current_user_id, $wpdb);
$tomorrow_bookings = fetchUserBookings(date('Y-m-d', strtotime('+1 day')), $current_user_id, $wpdb);

// Count the number of bookings
$yesterday_count = count($yesterday_bookings);
$today_count = count($today_bookings);
$tomorrow_count = count($tomorrow_bookings);

// Fetch latest bookings limited to 2 - for start_date_monthly for the current user
$sql_latest_monthly = "SELECT start_date_monthly, spot_id, booking_type FROM wp_bookings WHERE DATE(start_date_monthly) >= CURDATE() AND user_id = '$current_user_id' ORDER BY ABS(DATEDIFF(start_date_monthly, CURDATE())) LIMIT 2";
$result_latest_monthly = $wpdb->get_results($sql_latest_monthly); // Use get_results instead of query

// Fetch latest bookings limited to 2 - for start_date_daily for the current user
$sql_latest_daily = "SELECT start_date_daily, spot_id, booking_type FROM wp_bookings WHERE DATE(start_date_daily) >= CURDATE() AND user_id = '$current_user_id' ORDER BY ABS(DATEDIFF(start_date_daily, CURDATE())) LIMIT 2";
$result_latest_daily = $wpdb->get_results($sql_latest_daily); // Use get_results instead of query

// Choose the result set based on your preference
$result_latest = (!empty($result_latest_monthly)) ? $result_latest_monthly : $result_latest_daily;

// Fetch bookings for the current month for the current user
$currentMonthIndex = date('n') - 1; // Month index (0-based)
$currentYear = date('Y');
$startOfMonth = date('Y-m-01');
$endOfMonth = date('Y-m-t');
$sql_bookings = "SELECT * FROM wp_bookings WHERE (DATE(start_date_monthly) BETWEEN '$startOfMonth' AND '$endOfMonth' OR DATE(start_date_daily) BETWEEN '$startOfMonth' AND '$endOfMonth' OR DATE(exit_date_daily) BETWEEN '$startOfMonth' AND '$endOfMonth') AND user_id = '$current_user_id'";
$result_bookings = $wpdb->get_results($sql_bookings); // Use get_results instead of query

// Store booked dates in an array
$bookedDates = array();
foreach ($result_bookings as $row_booking) {
    $bookedDates[] = date('Y-m-d', strtotime($row_booking->start_date_monthly));
    $bookedDates[] = date('Y-m-d', strtotime($row_booking->start_date_daily));
    $bookedDates[] = date('Y-m-d', strtotime($row_booking->exit_date_daily));
}

// Calculate total spendings from ticket prices for the current user
$sql_total_spent = "SELECT SUM(ticket_price) AS total_spent FROM wp_bookings WHERE user_id = '$current_user_id'";
$result_total_spent = $wpdb->get_results($sql_total_spent); // Use get_results instead of query
$total_spent = $result_total_spent[0]->total_spent;

?>

<div class="container mx-auto px-4 py-8">
    <h2 class="large-text font-bold">Welcome to the dashboard,
        <?php echo $current_user->display_name; ?>!
    </h2>

    <!-- Row One: Bookings Overview & Total Spending -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
        <div class="bg-gray-100 rounded-lg shadow-lg p-4">
            <h3 class="medium-text font-bold mb-4">Bookings Overview</h3>
            <div class="grid grid-cols-3 gap-4">
                <div class="flex flex-col justify-center items-center bg-blue-200 rounded-lg p-2">
                    <h4 class="text-lg font-semibold">Yesterday</h4>
                    <p class="text-2xl font-bold">
                        <?php echo $yesterday_count; ?>
                    </p>
                </div>
                <div class="flex flex-col justify-center items-center bg-green-200 rounded-lg p-2">
                    <h4 class="text-lg font-semibold">Today</h4>
                    <p class="text-2xl font-bold">
                        <?php echo $today_count; ?>
                    </p>
                </div>
                <div class="flex flex-col justify-center items-center bg-yellow-200 rounded-lg p-2">
                    <h4 class="text-lg font-semibold">Tomorrow</h4>
                    <p class="text-2xl font-bold">
                        <?php echo $tomorrow_count; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 rounded-lg shadow-lg p-4">
            <h3 class="medium-text font-bold mb-4">Total Spendings</h3>
            <div class="flex items-center justify-center">
                <span class="text-3xl font-bold text-gray-600">€
                    <?php echo number_format($total_spent, 2); ?>
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        <div class="bg-gray-100 rounded-lg shadow-lg p-4">
            <h3 class="medium-text font-bold mb-4">Spendings</h3>
            <!-- Add canvas for the chart -->
            <canvas id="totalSpendingChart" width="400" height="200"></canvas>
        </div>
        <div class="bg-gray-100 rounded-lg shadow-lg p-4">
            <h3 class="medium-text font-bold mb-4">Latest Bookings</h3>
            <div class="latest-bookings-list">
                <?php if(!$result_latest): ?>
                    <p> No bookings made in recent days. </p>
                <?php else: ?>
                <?php foreach ($result_latest as $row_latest): ?>
                    <div class="border-b border-green-300 mb-4 pb-4 bg-blue-100 rounded-lg p-2">
                        <span class="block text-sm text-gray-600 mb-1">
                            <?php echo isset($row_latest->start_date_monthly) ? 'Monthly Booking' : 'Daily Booking'; ?>
                        </span>
                        <p class="text-lg font-semibold">
                            <?php echo isset($row_latest->start_date_monthly) ? date('Y-m-d', strtotime($row_latest->start_date_monthly)) : date('Y-m-d', strtotime($row_latest->start_date_daily)); ?>
                        </p>
                        <p class="text-sm text-gray-600">Spot ID:
                            <?php echo $row_latest->spot_id; ?>
                        </p>
                        <p class="text-sm text-gray-600">Booking Type:
                            <?php echo $row_latest->booking_type; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="bg-gray-100 rounded-lg shadow-lg p-4">
            <h3 class="medium-text font-bold mb-4">Monthly Booking Calendar</h3>
            <div class="container mx-auto monthly-calendar-container">
                <div class="flex justify-between items-center mb-4">
                    <button class="prev-btn text-gray-600" onclick="prevMonth()">&lt;</button>
                    <h4 id="currentMonth" class="text-xl font-semibold text-gray-600"></h4>
                    <button class="next-btn text-gray-600" onclick="nextMonth()">&gt;</button>
                </div>
                <div class="calendar-grid" id="calendarGrid"></div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Prepare data for the spending chart
    var ctx = document.getElementById('totalSpendingChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Total Spending',
                data: [<?php
                $monthly_spending = array();
                for ($month = 1; $month <= 12; $month++) {
                    $month_spending = 0;
                    foreach ($result_bookings as $booking) {
                        $booking_month = date('n', strtotime($booking->start_date_monthly));
                        if ($booking_month == $month) {
                            $month_spending += $booking->ticket_price;
                        }
                    }
                    array_push($monthly_spending, $month_spending);
                }
                echo implode(',', $monthly_spending);
                ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php get_footer(); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sample data for testing
    var dates = ["2024-03-14", "2024-03-15", "2024-03-16", "2024-03-17", "2024-03-18", "2024-03-19", "2024-03-20"];
    var totalSpent = [100, 200, 150, 300, 250, 400, 350];
    var currency = "€";

    // Preprocess dates to extract days of the week
    var formattedDates = dates.map(function (dateString) {
        var date = new Date(dateString);
        var dayIndex = date.getDay(); // 0 for Sunday, 1 for Monday, etc.
        var daysOfWeek = ['S', 'M', 'T', 'W', 'TH', 'F', 'S'];
        return daysOfWeek[dayIndex];
    });

    // Initialize and populate the chart
    var ctx = document.getElementById('totalSpendingChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: formattedDates,
            datasets: [{
                label: 'Total Spending',
                data: totalSpent,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    // Include a currency symbol with the y-axis labels
                    callback: function (value, index, values) {
                        return currency + value.toFixed(2);
                    }
                }
            }
        }
    });
</script>
<style>
    .calendar-container {
        width: 100%;
        max-width: 300px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .calendar-header {
        background-color: #4A5568;
        color: #fff;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .calendar-header button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 20px;
        color: #fff;
    }

    .calendar-header button:hover {
        opacity: 0.8;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        font-size: 14px;
        width: 100%;
        margin: auto;
    }

    .day-square {
        width: 35px;
        height: 35px;
        background-color: #e6e6ff;
        border: 1px solid #ccc;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
        font-size: 14px;
        color: #4A5568;
    }
</style>

<script>
    let currentMonthIndex = <?php echo date('n') - 1; ?>; // Month index (0-based)
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    function showCalendar(monthIndex, year) {
        const calendarGrid = document.getElementById('calendarGrid');
        const daysInMonth = new Date(year, monthIndex + 1, 0).getDate();
        const firstDayIndex = new Date(year, monthIndex, 1).getDay();

        calendarGrid.innerHTML = '';

        // Add empty squares for previous month's days
        for (let i = 0; i < firstDayIndex; i++) {
            const daySquare = document.createElement('div');
            daySquare.classList.add('day-square');
            daySquare.textContent = '';
            calendarGrid.appendChild(daySquare);
        }

        // Add squares for current month's days
        for (let i = 1; i <= daysInMonth; i++) {
            const daySquare = document.createElement('div');
            daySquare.classList.add('day-square');
            daySquare.textContent = i;
            if (isBooked(year, monthIndex, i)) {
                daySquare.style.backgroundColor = '#90EE90';
            }
            calendarGrid.appendChild(daySquare);
        }
    }

    function prevMonth() {
        currentMonthIndex--;
        if (currentMonthIndex < 0) {
            currentMonthIndex = 11; // December
        }
        updateCalendar();
    }

    function nextMonth() {
        currentMonthIndex++;
        if (currentMonthIndex > 11) {
            currentMonthIndex = 0; // January
        }
        updateCalendar();
    }

    function updateCalendar() {
        const currentMonthYear = document.getElementById('currentMonth');
        currentMonthYear.textContent = months[currentMonthIndex] + " 2024";
        showCalendar(currentMonthIndex, 2024);
    }

    // Initial load
    updateCalendar();

    // Function to check if a date is booked
    function isBooked(year, monthIndex, day) {
        const bookedDates = <?php echo json_encode($bookedDates); ?>;
        const date = new Date(year, monthIndex, day);
        const formattedDate = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
        return bookedDates.includes(formattedDate);
    }
</script>