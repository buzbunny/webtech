<?php
require 'connection.php';
include "core.php";

session_start();
$email = mysqli_real_escape_string($con, $_POST['email']);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";

// Check if the email format is correct
if (!preg_match($regex_email, $email)) {
    // Incorrect email format, display error message and redirect to login page
    $error_message = "Incorrect email format";
} else {
    $password = md5(md5(mysqli_real_escape_string($con, $_POST['password'])));
    if (strlen($password) < 6) {
        // Password should have at least 6 characters, display error message and redirect to login page
        $error_message = "Password should have at least 6 characters";
    } else {
        $user_authentication_query = "SELECT id, email, role_id FROM users WHERE email='$email' AND password='$password'";
        $user_authentication_result = mysqli_query($con, $user_authentication_query) or die(mysqli_error($con));
        $rows_fetched = mysqli_num_rows($user_authentication_result);

        if ($rows_fetched == 0) {
            // No user found with provided credentials, display error message and redirect to login page
            $error_message = "Wrong username or password!";
        } else {
            // User authentication successful, set session variables and redirect to appropriate page based on role
            $row = mysqli_fetch_array($user_authentication_result);
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $row['id'];

            if ($row['role_id'] == 2 || $row['role_id'] == 3) {
                // Redirect to seller_index.php for role_id 2 or 3
                $redirect_url = 'seller_index.php';
            } else {
                // Redirect to index.php for other role IDs
                $redirect_url = 'index.php';
            }

            // Set success message
            $success_message = "Login successful!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php if(isset($error_message)) { ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $error_message; ?>',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            }).then(function() {
                window.location.href = 'landing/login_page.php';
            });
        </script>
    <?php } elseif(isset($success_message)) { ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo $success_message; ?>',
                timer: 1000,
                timerProgressBar: true,
                showConfirmButton: false
            }).then(function() {
                window.location.href = '<?php echo $redirect_url; ?>';
            });
        </script>
    <?php } ?>
</body>
</html>
