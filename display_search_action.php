<?php
include "core.php";

function displayElectronicProducts()
{
    include "connection.php";

    $sql = "SELECT * FROM items WHERE id >= 29";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productName = $row["name"];
            $productPrice = $row["price"];
            $productId = $row["id"];

            // Assuming the image data is stored in the database as BLOB
            $imageData = $row["image"];

            echo '<div class="col-md-3 col-sm-6">';
            echo '<div class="thumbnail">';
            echo '<a href="cart.php">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="' . $productName . '" width="83%">';
            echo '</a>';
            echo '<center>';
            echo '<div class="caption">';
            echo '<h3>' . $productName . '</h3>';
            echo '<p>Price: $' . $productPrice . '</p>';
            if (!isset($_SESSION['email'])) {
                echo '<p><a href="landing/login_page.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>';
            } else {
                if (check_if_added_to_cart($productId)) {
                    echo '<a href="#" class="btn btn-block btn-success disabled">Added to cart</a>';
                } else {
                    echo '<a href="cart_add.php?id=' . $productId . '" class="btn btn-block btn-primary" name="add" value="add">Add to cart</a>';
                }
            }
            echo '</div>';
            echo '</center>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "No products found in the database.";
    }
    
    $con->close();
}
?>
