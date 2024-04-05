<?php
// Start session
session_start();

// Include database connection
include "connection.php";

// Function to display sales performance pie chart
function displaySalesPieChart() {
    global $con;

    // Check if user is logged in
    if (isset($_SESSION['email'])) {
        $user_id = $_SESSION['user_id'];

        // Query items added by the logged-in user with their sales data
        $sql = "SELECT items.name AS product, 
                COUNT(users_items.id) * items.price AS total_sales 
                FROM items 
                LEFT JOIN users_items ON items.id = users_items.item_id 
                WHERE items.user_id = $user_id AND users_items.status = 'Confirmed'
                GROUP BY items.id";
        $result = mysqli_query($con, $sql);

        // Output sales performance pie chart data
        if ($result && mysqli_num_rows($result) > 0) {
            $chartData = [['Product', 'Total Sales']];
            while ($row = mysqli_fetch_assoc($result)) {
                $chartData[] = [$row['product'], (int)$row['total_sales']];
            }
            return $chartData;
        }
    }
    return []; // Return empty array if no data found
}
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode(displaySalesPieChart()); ?>);

        var options = {
            title: 'Total Sales by Product'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

<div id="piechart" style="width: 600px; height: 400px;"></div>
