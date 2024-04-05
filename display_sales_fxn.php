<?php
session_start();
include "core.php";
include "connection.php";

// Function to dynamically display products added by the user
function displayUserProducts($con, $user_id) {
    // Prepare the SQL query to select items added by the user
    $sql = "SELECT * FROM items WHERE user_id = $user_id";
    $result = mysqli_query($con, $sql);

    // Check if any products are found
    if (mysqli_num_rows($result) > 0) {
        // Output each product dynamically
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="product">';
            echo '<img src="' . $row['image'] . '" />';
            echo '<p>' . $row['name'] . '</p>';
            echo '<p>$' . $row['price'] . '</p>';
            // Add delete button
            echo '<button class="delete-button" data-product-id="' . $row['id'] . '">Delete Product</button>';
            echo '</div>';
        }
    } else {
        // If no products are found, display a message
        echo '<p>No products found.</p>';
    }
}

// Check if the delete button is clicked
if(isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    // Prepare the SQL query to delete the product
    $sql = "DELETE FROM items WHERE id = $product_id";
    // Execute the delete query
    if(mysqli_query($con, $sql)) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . mysqli_error($con);
    }
}
?>

<!-- Add CSS for the delete button -->
<style>
.delete-button {
    background-color: red;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    cursor: pointer;
}

.delete-button:hover {
    background-color: darkred;
}
</style>


<script>
// Add event listener to handle delete button click
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-button')) {
        // Confirm delete action
        if (confirm("Are you sure you want to delete this product?")) {
            // Get the product ID
            var productId = event.target.getAttribute('data-product-id');
            // Send AJAX request to delete the product
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page to reflect changes after deletion
                    window.location.reload();
                }
            };
            xhr.send("delete_product=1&product_id=" + productId);
        }
    }
});
</script>
