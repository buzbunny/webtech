<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
                // session_start();
                require 'connection.php';

            // Check if the user is logged in and their role_id
            if (isset($_SESSION['email'])) {
                // Fetch user details from the database
                $email = $_SESSION['email'];
                $user_query = "SELECT * FROM users WHERE email='$email'";
                $user_result = mysqli_query($con, $user_query);

                if (mysqli_num_rows($user_result) > 0) {
                    $user_row = mysqli_fetch_assoc($user_result);
                    $role_id = $user_row['role_id'];

                    // Check if the user is a seller (role_id 2 or 3)
                    if ($role_id == 2 || $role_id == 3) {
                        echo '<a href="seller_index.php" class="navbar-brand">WristLux. Co</a>';
                    } else {
                        echo '<a href="index.php" class="navbar-brand">WristLux. Co</a>';
                    }
                }
            } else {
                echo '<a href="index.php" class="navbar-brand">WristLux. Co</a>';
            }
            ?>
        </div>
        
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['email'])) {
                    ?>
                    <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                    <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                    <li><a href="history.php"><span class="glyphicon glyphicon-time"></span> Purchase History</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="landing/login_page.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="landing/login_page.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
