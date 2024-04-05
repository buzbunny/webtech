<?php
session_start();
require_once 'connection.php'; // Include your database connection script

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    // Retrieve the user ID from the session
    $userId = $_SESSION['user_id'];

    // Prepare and execute the SQL query to update user information
    $sql = "UPDATE users SET name = ?, contact = ?, address = ?, city = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssi", $name, $contact, $address, $city, $userId);
    
    if ($stmt->execute()) {
        // Update successful
        echo "User information updated successfully.";
    } else {
        // Error occurred
        echo "Error updating user information: ";
    }

    // Close the database connection
    $stmt->close();
    $con->close();
} else {
    // If the form is not submitted, redirect back to the page
    header("Location: settings.php");
    exit();
}
?>



