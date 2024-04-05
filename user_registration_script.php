<?php
    require 'connection.php';
    include "core.php";
    session_start();
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if (!preg_match($regex_email, $email)) {
        echo "Incorrect email. Redirecting you back to registration page...";
        ?>
        <meta http-equiv="refresh" content="2;url=landing/login_page.php" />
        <?php
        exit; // Stop execution if email is incorrect
    }
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirmpassword']);

    // Check if password and confirm password match and have at least 6 characters
    if ($password !== $confirm_password || strlen($password) < 6) {
        echo "Passwords do not match or have less than 6 characters. Redirecting you back to registration page...";
        ?>
        <meta http-equiv="refresh" content="2;url=landing/login_page.php" />
        <?php
        exit; // Stop execution if passwords do not match or have less than 6 characters
    }

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
        ?>
        <script>
            window.alert("Email already exists in our database!");
        </script>
        <meta http-equiv="refresh" content="1;url=landing/login_page.php" />
        <?php
    } else {
        $user_registration_query = "INSERT INTO users(name, email, password, contact, city, address, role_id) VALUES ('$name', '$email', '$password', '$contact', '$city', '$address', $role_id)";
        $user_registration_result = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
        echo "User successfully registered";
        $_SESSION['email'] = $email;
        $_SESSION['id'] = mysqli_insert_id($con);
        ?>
        <meta http-equiv="refresh" content="3;url=landing/login_page.php" />
        <?php
    }
?>
