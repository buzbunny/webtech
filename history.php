<?php
    session_start();
    include "core.php";
    require 'connection.php';

    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }

    $user_id = $_SESSION['user_id'];

    // Query to fetch items added by the current user from the users_items table
    $user_items_query = "SELECT ui.item_id, ui.status, i.name AS item_name, i.price
                         FROM users_items ui
                         INNER JOIN items i ON ui.item_id = i.id
                         WHERE ui.user_id = '$user_id'";

    // Execute query
    $user_items_result = mysqli_query($con, $user_items_query);

    // Check for errors
    if (!$user_items_result) {
        die('Error: ' . mysqli_error($con));
    }

    // Process the result set
    $user_items = [];
    while ($row = mysqli_fetch_assoc($user_items_result)) {
        $user_items[] = $row;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
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
            <div class="container">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($user_items)) {
                            foreach ($user_items as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['item_name']?></td>
                            <td>$<?php echo $item['price']?></td>
                            <td><?php echo $item['status']?></td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="3">No items found for the user</td>
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
