<?php
session_start();
// include "core.php";
include "connection.php";
include "display_sales_fxn.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="store_style.css">
</head>

<body>
    
<a href="seller_index.php"><img src="landing/assets/logo.png" alt="logo" width="5%"/></a>
<span class="welcome">
    <?php
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Query the name of the logged-in user
        $userId = $_SESSION['user_id'];
        $query = "SELECT name FROM users WHERE id = $userId";
        $result = mysqli_query($con, $query);
        
        // Check if the query was successful
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $userName = $row['name'];
            echo "Welcome, $userName!";
        } else {
            echo "Welcome!";
        }
    } else {
        echo "Welcome!";
    }
    ?>
</span>

<style>
  .welcome {
    font-weight: bold;
    font-size: 25px;
    color: grey;
    margin-left: 5%;
}

</style>


    <div class="container">
    <div class="add-product">
    <form id="product-form" action="add_product_action.php" method="POST" enctype="multipart/form-data">
      <div>
      <label for="name">Product Name:</label>
        <input type="text" name="name" placeholder="name/model of watch"  required/>
      </div>
      
      <div>
      <label for="price">Price:</label>
        <input type="number" name="price" min="0" placeholder="0.00" />
      </div>

      <div>
      <label for="image">Product Image of dimensions 1500 x 1500:</label>
        <input type="file" name="image"  accept="image/*" required onchange="editProfilePhoto(event)"><br>
      </div>
      
      <input type="submit" name="submit" value="Add Product">
    </form>


    <?php
    include "performance2.php";
    displaySalesPieChart()
    ?> 

<?php
// Calculate total sales
$totalSales = 0;

// Query to fetch items' prices inserted by the current logged-in user
$query = "SELECT SUM(items.price) AS total_price
          FROM users_items
          JOIN items ON users_items.item_id = items.id
          WHERE users_items.user_id = $userId";

$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalSales = $row['total_price'];
} else {
    echo "Error fetching sales data: " . mysqli_error($con);
}
?>

<div class="total-sales" style="font-weight: bold; color: grey; margin-top: 10%; margin-left: 18%; font-size: 48px;">
    Total Sales:<br> $<?php echo $totalSales; ?>
</div>

    


</div>
      
  <div class="list-products">
    <h2>Posted products</h2>
    <!-- <div class="product">
      <img src="https://sc02.alicdn.com/kf/HTB1gHRfg6uhSKJjSspmq6AQDpXaI/Accept-Sample-Design-Your-Own-Blank-Wrist.jpg_350x350.jpg" />
      <p>Sample Watch</p>
      <p>$199</p>
      <button class="details-button">Details</button>
      <button class="buy-button">Buy</button>
    </div> -->
    


    <div class="user-products">
        <?php displayUserProducts($con, $_SESSION['user_id']); ?>
    </div>
    
  </div>
  
  <div class="shopping-cart">
    <?php
    include "performance.php";
    displaySalesChart()
    ?>

<?php
    include "manage_orders.php";
    displayOrderedItems($con, $user_id)
    ?>




  </div>

  


    <script>
        function editProfilePhoto(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            // Read the selected file as a data URL
            reader.onload = function () {
                var imageDataUrl = reader.result;

                // Update the preview of the uploaded image
                var imagePreview = document.getElementById('image-preview');
                imagePreview.src = imageDataUrl;
            };

            // Read the selected file
            reader.readAsDataURL(file);
        }
        
    </script>
</body>

</html>
