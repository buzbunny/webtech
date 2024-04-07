<?php
    session_start();
    include "core.php";

    require 'check_if_added.php';

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
            <div class="container">
                <div class="jumbotron">
                    <h1>Welcome to WristLux. Co watch collections!</h1>
                    <p>We have the best watches for you. No need to hunt around, we have all in one place.</p>
                </div>
            </div>
            <div class="container">
            <?php
                include "display_products_fxn.php"; 
                displayItems();
                ?>
            </div>   
            <br><br><br><br><br><br><br><br>
           
    </body>
</html>
