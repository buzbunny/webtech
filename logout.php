<?php
    session_start();
    session_unset();
    unset($_SESSION['user_id']);
    unset($_SESSION['role_id']);

    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>WristLux. Co</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jQuery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- SweetAlert2 library -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <!-- Display SweetAlert notification -->
                                <script>
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Logged Out',
                                        text: 'You have been logged out.',
                                        showConfirmButton: false,
                                        timer: 2000 // Close after 2 seconds
                                    }).then(function() {
                                        // Redirect to login page after showing the notification
                                        window.location.href = 'landing/login_page.php';
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </body>
</html>
