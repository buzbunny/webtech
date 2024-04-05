<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'];

    // Handle file upload
    $targetDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if the file is an image
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Get image dimensions
        $image_info = getimagesize($_FILES["image"]["tmp_name"]);
        $image_width = $image_info[0];
        $image_height = $image_info[1];

        // Check if the image dimensions are not 1500x1500
        if ($image_width != 1500 || $image_height != 1500) {
            // Redirect back to settings page with error message
            header("Location: add_product.php?msg=Please upload an image with dimensions 1500x1500.");
            exit();
        }

        // Upload file to the server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Check if user is logged in and 'user_id' session variable is set
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                // Insert item into the items table
                $insertItemQuery = "INSERT INTO items (name, price, image, user_id) VALUES ('$name', '$price', '$targetFilePath', '$user_id')";
                if (mysqli_query($con, $insertItemQuery)) {
                    // Redirect back to settings page with success message
                    header("Location: add_product.php?msg=Item added successfully.");
                    exit();
                } else {
                    // Display error message
                    echo "Error: " . mysqli_error($con);
                    // Redirect back to settings page with error message
                    // header("Location: add_product.php?msg=Error adding item to the database.");
                    exit();
                }
            } else {
                // Redirect to login page or handle session not set scenario
                header("Location: landing/login_page.php");
                exit();
            }
        } else {
            // Redirect back to settings page with error message
            header("Location: add_product.php?msg=Sorry, there was an error uploading your file.");
            exit();
        }
    } else {
        // Redirect back to settings page with error message
        header("Location: add_product.php?msg=Sorry, only JPG, JPEG, PNG, GIF files are allowed.");
        exit();
    }
}
?>
