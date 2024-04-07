<?php
session_start();
require_once 'connection.php'; // Include your database connection script

// Initialize variables to store SweetAlert configurations
$sweetAlert = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $newPassword = $_POST['newPassword'];
    $retypePassword = $_POST['retype'];

    // Check if the new password and retype password match
    if ($newPassword !== $retypePassword) {
        $sweetAlert = "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'New password and retype password do not match.',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                window.location.href = 'settings.php'; // Redirect back to the settings.php page
                            });
                      </script>";
    } else {
        // Perform regex validation for the new password
        $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$/';
        if (!preg_match($password_regex, $newPassword)) {
            $sweetAlert = "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'New password does not meet the requirements.',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function() {
                                    window.location.href = 'settings.php'; // Redirect back to the settings.php page
                                });
                          </script>";
        } else {
            // Retrieve the user ID from the session
            $userId = $_SESSION['user_id'];

            // Hash the new password
            // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $hashedPassword = md5(md5($newPassword));


            // Prepare and execute the SQL query to update the user's password
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("si", $hashedPassword, $userId);

            if ($stmt->execute()) {
                // Password update successful
                $sweetAlert = "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Password updated successfully.',
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
                                        text: 'Error updating password: " . $con->error . "',
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(function() {
                                        window.location.href = 'settings.php'; // Redirect back to the settings.php page
                                    });
                              </script>";
            }

            // Close the database connection
            $stmt->close();
        }
    }
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
    <title>Password Update Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php echo $sweetAlert; ?>
</body>
</html>
