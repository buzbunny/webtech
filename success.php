<?php
    session_start();
    require 'connection.php';
    
    if (!isset($_SESSION['email'])) {
        header('location:index.php');
    } else {
        $user_id = $_SESSION['user_id'];
        
        // Query to fetch user's address
        $user_address_query = "SELECT address FROM users WHERE id = $user_id";
        $user_address_result = mysqli_query($con, $user_address_query);
        
        // Check if query executed successfully
        if ($user_address_result) {
            // Fetch the user's address
            $user_address_row = mysqli_fetch_assoc($user_address_result);
            $user_address = $user_address_row['address'];
        } else {
            // Handle error
            $user_address = "Error fetching address";
        }
        
        // Update status of items to 'Confirmed'
        $confirm_query = "UPDATE users_items SET status='Confirmed' WHERE user_id=$user_id";
        $confirm_query_result = mysqli_query($con, $confirm_query) or die(mysqli_error($con));
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>WristLux. Co</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php require 'header.php'; ?>
            <br>
            <div class="container" style=" margin-top: 5%;">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <?php if ($user_address): ?>
                                    <p>Your order is confirmed and will be delivered to your address:</p>
                                    <p><?php echo $user_address; ?></p>
                                    <p>between 8-15 business days. Thank you for shopping with us. <a href="products.php">Click here</a> to purchase any other item.</p>
                                <?php else: ?>
                                    <p>Error fetching address. Please contact support.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
