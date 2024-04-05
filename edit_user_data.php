<?php
function displayUserDetails() {
    session_start();
    include "core.php";
    require 'connection.php';

    if (!isset($_SESSION['email'])) {
        header('location:index.php');
        exit; // Stop further execution if user is not logged in
    }

    // Fetch user details from the database
    $email = $_SESSION['email'];
    $user_query = "SELECT * FROM users WHERE email='$email'";
    $user_result = mysqli_query($con, $user_query);

    if(mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);

        // Display user details dynamically in HTML
        echo '<div class="settings-section">';
        echo '<h2 class="settings-title">General Information</h2>';
        echo '<div class="non-active-form">';
        echo '<p>Name</p><span>' . $user_row['name'] . '</span><button class="edit-button"><i class="ri-edit-2-line"></i></button>';
        echo '</div>';
        echo '<div class="non-active-form">';
        echo '<p class="capitalize">Contact</p><span>' . $user_row['contact'] . '</span><button class="edit-button"></button>';
        echo '</div>';
        echo '<div class="non-active-form">';
        echo '<p class="capitalize">Address</p><span>' . $user_row['address'] . '</span><button class="edit-button"></button>';
        echo '</div>';
        echo '<div class="non-active-form">';
        echo '<p>City</p><span>' . $user_row['city'] . '</span><button class="edit-button"></button>';
        echo '</div>';
        echo '</div>';
    } else {
        echo "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <!-- Your HTML body content goes here -->

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" class="form" action="edit_user_data_fxn.php">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact:</label>
                        <input type="tel" class="form-control" id="contact" name="contact">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <input type="hidden" id="userId">
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" id="saveChanges">Save changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



    <script>
       $(document).ready(function() {
    // Function to handle opening the modal form
    $('.edit-button').click(function() {
        var fieldName = $(this).closest('.non-active-form').find('p').text();
        var fieldValue = $(this).closest('.non-active-form').find('span').text();
        var userId = <?php echo $_SESSION['user_id']; ?>; // Retrieve user ID from session
        $('#editModal').find('.modal-title').text(fieldName);
        $('#editModal').find('#newValue').val(fieldValue.trim());
        $('#editModal').find('#field').val(fieldName); // Set the field name in the hidden input
        $('#editModal').find('#userId').val(userId); // Set the user ID in the hidden input
        $('#editModal').modal('show');
    });

    // Function to handle form submission
    $('#saveChanges').click(function() {
        var nameValue = $('#name').val(); // Get the value of the name field
        var contactValue = $('#contact').val(); // Get the value of the contact field
        var addressValue = $('#address').val(); // Get the value of the address field
        var cityValue = $('#city').val(); // Get the value of the city field
        var userId = $('#userId').val();
        
        // Check if name field is not empty
        if (nameValue.trim() == "") {
            alert("Name field cannot be empty.");
            return; // Stop form submission
        }

        $.ajax({
            type: 'POST',
            url: 'edit_user_data_fxn.php', // PHP script to handle the update operation
            data: { 
                name: nameValue,
                contact: contactValue,
                address: addressValue,
                city: cityValue,
                userId: userId 
            },
            success: function(data) {
                $('#editModal').modal('hide');
                alert(data);
                // Optionally, reload the page or perform any other action
            }
        });
    });
});

    </script>
</body>
</html>
