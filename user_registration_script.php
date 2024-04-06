<?php
require 'connection.php';
include "core.php";

session_start();
$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
if (!preg_match($regex_email, $email)) {
    $error_message = "Incorrect email format";
} else {
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirmpassword']);

    // Check if password and confirm password match and have at least 6 characters
    if ($password !== $confirm_password || strlen($password) < 6) {
        $error_message = "Passwords do not match or have less than 6 characters";
    } else {
        $password = md5(md5($password));

        $contact = $_POST['contact'];
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $role_id = 1; // Default role_id

        $duplicate_user_query = "SELECT id FROM users WHERE email='$email'";
        $duplicate_user_result = mysqli_query($con, $duplicate_user_query) or die(mysqli_error($con));
        $rows_fetched = mysqli_num_rows($duplicate_user_result);
        if ($rows_fetched > 0) {
            // Duplicate registration
            $error_message = "Email already exists in our database";
        } else {
            $user_registration_query = "INSERT INTO users(name, email, password, contact, city, address, role_id) VALUES ('$name', '$email', '$password', '$contact', '$city', '$address', $role_id)";
            $user_registration_result = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
            $success_message = "User successfully registered";
            $_SESSION['email'] = $email;
            $_SESSION['id'] = mysqli_insert_id($con);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<?php if(isset($error_message)) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?php echo $error_message; ?>',
            timer: 3000,
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
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        }).then(function() {
            window.location.href = 'landing/login_page.php';
        });
    </script>
<?php } ?>

</body>
</html>
