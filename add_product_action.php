<?php
session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include "connection.php";

// Initialize error message and success message variables
$error_message = "";
$success_message = "";

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
            // Set error message
            $error_message = "Please upload an image with dimensions 1500x1500.";
        } else {
            // Upload file to the server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Check if user is logged in and 'user_id' session variable is set
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    // Insert item into the items table
                    $insertItemQuery = "INSERT INTO items (name, price, image, user_id) VALUES ('$name', '$price', '$targetFilePath', '$user_id')";
                    if (mysqli_query($con, $insertItemQuery)) {
                        // Set success message
                        $success_message = "Item added successfully.";
                    } else {
                        // Set error message
                        $error_message = "Error adding item to the database: " . mysqli_error($con);
                    }
                } else {
                    // Redirect to login page or handle session not set scenario
                    header("Location: landing/login_page.php");
                    exit();
                }
            } else {
                // Set error message
                $error_message = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Set error message
        $error_message = "Sorry, only JPG, JPEG, PNG, GIF files are allowed.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php if (!empty($error_message)) { ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?php echo $error_message; ?>',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = 'add_product.php'; // Redirect back to the add_product page
                });
            });
        </script>
    <?php } elseif (!empty($success_message)) { ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?php echo $success_message; ?>',
                    timer: 1000,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = 'add_product.php'; // Redirect back to the add_product page
                });
            });
        </script>
    <?php } ?>
    <!-- Your HTML content goes here -->
</body>
</html>