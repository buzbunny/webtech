<?php
session_start();
require_once 'connection.php'; // Include your database connection script

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $newPassword = $_POST['newPassword'];
    $retypePassword = $_POST['retype'];

    // Check if the new password and retype password match
    if ($newPassword !== $retypePassword) {
        echo "New password and retype password do not match.";
        exit(); // Stop script execution
    }

    // Perform regex validation for the new password
    $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if (!preg_match($password_regex, $newPassword)) {
        echo "New password does not meet the requirements.";
        exit(); // Stop script execution
    }

    // Retrieve the user ID from the session
    $userId = $_SESSION['user_id'];

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to update the user's password
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $hashedPassword, $userId);

    if ($stmt->execute()) {
        // Password update successful
        echo "Password updated successfully.";
    } else {
        // Error occurred
        echo "Error updating password: " . $con->error;
    }

    // Close the database connection
    $stmt->close();
    $con->close();
} else {
    // If the form is not submitted, redirect back to the page
    header("Location: setting_script.php");
    exit();
}
?>
