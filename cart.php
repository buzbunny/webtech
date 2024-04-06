<?php
    session_start();
    include "core.php";
    require 'connection.php';

    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }

    $user_id = $_SESSION['user_id'];

    // Query to fetch items in the cart that have not been confirmed
    $user_products_query = "SELECT it.id, it.name, it.price 
                            FROM users_items ut 
                            INNER JOIN items it ON it.id = ut.item_id 
                            WHERE ut.user_id = '$user_id' AND ut.status != 'Confirmed'";

    // Execute query
    $user_products_result = mysqli_query($con, $user_products_query);

    // Check for errors
    if (!$user_products_result) {
        die('Error: ' . mysqli_error($con));
    }

    // Check if any items are in the cart
    $no_of_user_products = mysqli_num_rows($user_products_result);
    $sum = 0;

    // Process the result set
    $user_products = [];
    if ($no_of_user_products > 0) {
        while ($row = mysqli_fetch_assoc($user_products_result)) {
            $user_products[] = $row;
            $sum += $row['price'];
        }
    }

    $_SESSION['sum'] = $sum;
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
            <?php 
               require 'header.php';
            ?>
            <br>
            <div class="container" style=" margin-top: 5%;">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Item Number</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($user_products)) {
                            $counter = 1;
                            foreach ($user_products as $product) {
                        ?>
                        <tr>
                            <td><?php echo $counter ?></td>
                            <td><?php echo $product['name']?></td>
                            <td><?php echo $product['price']?></td>
                            <td><a href='cart_remove.php?id=<?php echo $product['id'] ?>'>Remove</a></td>
                        </tr>
                        <?php 
                                $counter++;
                            }
                        ?>
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td>$ <?php echo $sum;?>/-</td>
                            <td><a href="paystack/payment.php?id=<?php echo $user_id?>" class="btn btn-primary">Confirm Order</a></td>
                        </tr>
                        <?php 
                        } else {
                        ?>
                        <tr>
                            <td colspan="4">No items in the cart</td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <br><br><br><br><br><br><br><br><br><br>
        </div>
    </body>
</html>
