<?php
// Start the PHP session
function checkLogin() {
    session_start();
    if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
        header("location: ../landing/login_page.php");
        die();
    }
}

// Function to check and return the user's role id
function getUserRoleId() {
    session_start();
    if(isset($_SESSION["role_id"])) {
        return $_SESSION["role_id"];
    } else {
        return null;
    }
}

?>
