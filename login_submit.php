<?php
require 'connection.php';
include "core.php";

session_start();
$email = mysqli_real_escape_string($con, $_POST['email']);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
if (!preg_match($regex_email, $email)) {
    echo "Incorrect email. Redirecting you back to login page...";
    ?>
    <meta http-equiv="refresh" content="2;url=landing/login_page.php" />
    <?php
}
$password = md5(md5(mysqli_real_escape_string($con, $_POST['password'])));
if (strlen($password) < 6) {
    echo "Password should have at least 6 characters. Redirecting you back to login page...";
    ?>
    <meta http-equiv="refresh" content="2;url=landing/login_page.php" />
    <?php
}
$user_authentication_query = "SELECT id, email FROM users WHERE email='$email' AND password='$password'";
$user_authentication_result = mysqli_query($con, $user_authentication_query) or die(mysqli_error($con));
$rows_fetched = mysqli_num_rows($user_authentication_result);
if ($rows_fetched == 0) {
    // No user found with provided credentials
    ?>
    <script>
        window.alert("Wrong username or password");
    </script>
    <meta http-equiv="refresh" content="1;url=landing/login_page.php" />
    <?php
} else {
    $row = mysqli_fetch_array($user_authentication_result);
    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $row['id'];  //user id
    header('location: index.php'); // Redirect to index.php
}
?>
