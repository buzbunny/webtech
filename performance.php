<?php
// Start session
session_start();

// Include database connection
include "connection.php";

// Function to display sales performance chart
function displaySalesChart() {
    global $con;

    // Check if user is logged in
    if (isset($_SESSION['email'])) {
        $user_id = $_SESSION['user_id'];

        // Query items added by the logged-in user with their sales data
        $sql = "SELECT items.name AS product, items.price, 
                COUNT(users_items.id) * items.price AS sales 
                FROM items 
                LEFT JOIN users_items ON items.id = users_items.item_id 
                WHERE items.user_id = $user_id AND users_items.status = 'Confirmed'
                GROUP BY items.id";
        $result = mysqli_query($con, $sql);

        // Output sales performance chart data
        if ($result && mysqli_num_rows($result) > 0) {
            $chartData = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $chartData[] = [
                    $row['product'],
                    $row['price'],
                    $row['sales']
                ];
            }
            return $chartData;
        }
    }
    return []; // Return empty array if no data found
}
?>

<div class="performance">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Product', 'Price', 'Sales'],
                <?php
                // Call the function to get sales data
                $chartData = displaySalesChart();
                foreach ($chartData as $dataRow) {
                    echo "['" . $dataRow[0] . "', " . $dataRow[1] . ", " . $dataRow[2] . "],";
                }
                ?>
            ]);

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales by Product',
                },
                bars: 'horizontal' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
</div>


