<?php
session_start();
require_once 'connection.php'; // Include your database connection script

// Initialize variables to store SweetAlert configurations
$sweetAlert = "";

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
        $sweetAlert = "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'User information updated successfully.',
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function() {
                                window.location.href = 'settings.php'; // Redirect back to the settings.php page
                            });
                      </script>";
    } else {
        // Error occurred
        $sweetAlert = "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Error updating user information: " . $con->error . "',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                window.location.href = 'settings.php'; // Redirect back to the settings.php page
                            });
                      </script>";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information Update Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php echo $sweetAlert; ?>
</body>
</html>
