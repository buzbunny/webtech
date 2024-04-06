<?php
    require 'connection.php';
    include "core.php";

    //require 'header.php';
    session_start();
    $item_id=$_GET['id'];
    $user_id=$_SESSION['user_id'];
    $add_to_cart_query="insert into users_items(user_id,item_id,status) values ('$user_id','$item_id','Added to cart')";
    $add_to_cart_result=mysqli_query($con,$add_to_cart_query) or die(mysqli_error($con));

    // Initialize variables to store SweetAlert configurations
    $sweetAlert = "";

    // Check if the item was successfully added to the cart
    if ($add_to_cart_result) {
        // SweetAlert for successful addition to cart
        $sweetAlert = "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Added to Cart!',
                                text: 'Item has been added to your cart.',
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function() {
                                window.location.href = 'products.php'; // Redirect to products page
                            });
                      </script>";
    } else {
        // SweetAlert for error in adding to cart
        $sweetAlert = "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = 'products.php'; // Redirect to products page
                            });
                      </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php echo $sweetAlert; ?>
</body>
</html>
