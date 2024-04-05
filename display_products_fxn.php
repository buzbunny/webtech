<?php
include "connection.php";

function displayItems() {
    global $con; // Assuming $con is your database connection variable
    
    // Query all items from the items table
    $sql = "SELECT * FROM items";
    $result = mysqli_query($con, $sql);

    // Check if any items are found
    if (mysqli_num_rows($result) > 0) {
        // Output each item in a div structure
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="container">';
            echo '    <div class="row">';
            echo '        <div class="col-md-3 col-sm-6">';
            echo '            <div class="thumbnail">';
            echo '                <a href="cart.php">';
            echo '                    <img src="' . $row['image'] . '" alt="' . $row['name'] . '" style="width:100%; height: auto;">';
            echo '                </a>';
            echo '                <center>';
            echo '                    <div class="caption">';
            echo '                        <h3>' . $row['name'] . '</h3>';
            echo '                        <p>Price: $' . $row['price'] . '</p>';
            
            echo '                        <p>';
            // Check if user is logged in
            if (!isset($_SESSION['email'])) {
                // If not logged in, provide a login link
                echo '                            <a href="landing/login_page.php" role="button" class="btn btn-primary btn-block">Buy Now</a>';
            } else {
                // If logged in, display appropriate button based on cart status
                if (check_if_added_to_cart($row['id'])) {
                    echo '                            <a href="#" class="btn btn-block btn-success disabled">Added to cart</a>';
                } else {
                    echo '                            <a href="cart_add.php?id=' . $row['id'] . '" class="btn btn-block btn-primary" name="add" value="add">Add to cart</a>';
                }
            }
            echo '                        </p>';
            
            // Fetch seller's email and contact information from the database
            $sellerId = $row['user_id'];
            $sellerQuery = "SELECT email, contact FROM users WHERE id = $sellerId";
            $sellerResult = mysqli_query($con, $sellerQuery);
            if ($sellerResult && mysqli_num_rows($sellerResult) > 0) {
                $sellerInfo = mysqli_fetch_assoc($sellerResult);
                $sellerEmail = $sellerInfo['email'];
                $sellerContact = $sellerInfo['contact'];
                
                // Display seller's email and contact details or logo image based on user_id
                if ($sellerId == 7) {
                    echo '                        <p>';
                    echo '                            <img src="landing/assets/JC_logo.webp" alt="logo" width="102%"/>';
                    echo '                        </p>';
                } elseif ($sellerId == 8) {
                    echo '                        <p>';
                    echo '                            <img src="landing/assets/rolex_logo.png" alt="logo" width="47%"/>';
                    echo '                        </p>';
                } elseif ($sellerId == 9) {
                    echo '                        <p>';
                    echo '                            <img src="landing/assets/patek_logo.png" alt="logo" width="47%"/>';
                    echo '                        </p>';
                } elseif ($sellerId == 10) {
                    echo '                        <p>';
                    echo '                            <img src="landing/assets/RM_logo.png" alt="logo" width="90%"  style="margin-top: 18%;"/>';
                    echo '                        </p>';
                } elseif ($sellerId == 2) {
                    echo '                        <p>';
                    echo '                            <img src="landing/assets/logo.png" alt="logo" width="47%"/>';
                    echo '                        </p>';
                }else {
                    echo '                        <p>Seller details:</p>';
                    echo '                        <p>Email: ' . $sellerEmail . '<br>Contact: ' . $sellerContact . '</p>';
                }
            }
            
            echo '                    </div>';
            echo '                </center>';
            echo '            </div>';
            echo '        </div>';
        }
    } else {
        // If no items found, display a message
        echo '<p>No items found.</p>';
    }
}

?>
