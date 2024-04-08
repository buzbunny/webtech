<?php
// Include the connection file
require_once 'connection.php';

// Function to retrieve and display ordered items by the current user
function displayOrderedItems($con, $user_id) {
    // Query to retrieve user's ordered items with relevant details including city and address
    $query = "SELECT users.name AS user_name, users.city, users.address, items.name AS item_name, items.price, users_items.status
              FROM users_items
              JOIN users ON users_items.user_id = users.id
              JOIN items ON users_items.item_id = items.id
              WHERE items.user_id = $user_id";

    $result = mysqli_query($con, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($con);
        exit();
    }

    echo '<h2>Client Orders</h2>';
    echo '<table style="border-collapse: collapse; width: 100%;">';
    echo '<tr><th style="border: 1px solid #ddd; padding: 8px;">User Name</th><th style="border: 1px solid #ddd; padding: 8px;">City</th><th style="border: 1px solid #ddd; padding: 8px;">Address</th><th style="border: 1px solid #ddd; padding: 8px;">Item Name</th><th style="border: 1px solid #ddd; padding: 8px;">Price</th><th style="border: 1px solid #ddd; padding: 8px;">Status</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $row['user_name'] . '</td>';
        echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $row['city'] . '</td>';
        echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $row['address'] . '</td>';
        echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $row['item_name'] . '</td>';
        echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $row['price'] . '</td>';
        echo '<td style="border: 1px solid #ddd; padding: 8px;" id="delivery-status-' . $row['item_name'] . '">' . $row['status'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';

    // Free result set
    mysqli_free_result($result);
}
?>


<?php
// Check if the user is logged in, and retrieve their user_id (replace this with your actual authentication mechanism)
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle authentication
    header("Location: landing/login_page.php");
    exit();
}
$user_id = $_SESSION['user_id'];

// Call the function to display ordered items
displayOrderedItems($con, $user_id);

// Close the database connection
mysqli_close($con);
?>
