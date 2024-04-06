<?php
    require 'connection.php';
    include "core.php";

    session_start();
    $item_id=$_GET['id'];
    $user_id=$_SESSION['user_id'];
    $delete_query="delete from users_items where user_id='$user_id' and item_id='$item_id'";
    $delete_query_result=mysqli_query($con,$delete_query) or die(mysqli_error($con));

    // Initialize variables to store SweetAlert configurations
    $sweetAlert = "";

    // Check if the deletion was successful
    if ($delete_query_result) {
        // SweetAlert for successful deletion
        $sweetAlert = "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Item has been removed from cart.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = 'cart.php'; // Redirect to cart page
                            });
                      </script>";
    } else {
        // SweetAlert for error in deletion
        $sweetAlert = "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = 'cart.php'; // Redirect to cart page
                            });
                      </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php echo $sweetAlert; ?>
</body>
</html>
