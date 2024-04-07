<?php
    session_start();
    include "edit_user_data.php";

    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }
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

        <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <br>
            <div class="settings-page">
            <div class="settings-container">
                <h1 class="page-title">Account</h1>
                <?php
                displayUserDetails()
                ?>

                <div class="settings-section">
                    <h2 class="settings-title">Password</h2>
                    <form id="editForm" class="form my-form" method="post" action="setting_script.php">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="newPassword" placeholder="New Password" type="password" class="form-control" pattern="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/" REQUIRED>
                                <span class="focus-input"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input name="retype" placeholder="Retype Password" type="password" class="form-control" pattern="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/" REQUIRED>
                                <span class="focus-input"></span>
                            </div>
                        </div>
                        <div class="form-submit right">
                            <button class="btn button full" type="submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



        <style>
            @import url(https://fonts.googleapis.com/css?family=Fira+Sans:200,400,500,600,700);

body{
    color:black;
    margin:0;
    overflow-x: hidden;
    font-family:'Fira Sans', sans-serif;
    background-color:white;
    &::-webkit-scrollbar {
        width: 8px;
    }
    &::-webkit-scrollbar-track {
    background: white; 
    }
    &::-webkit-scrollbar-thumb {
    background:white; 
    border-radius:3px;
    }
    &::-webkit-scrollbar-thumb:hover {
    background: white;
    }
}
.page-title{
    margin-bottom: 20px;
    font-size: 30px;
    font-weight: normal;
}

.settings-page{
    background-color: white;
    width: 100%;
    min-height: 90vh;
    .settings-container{
        width: 100%;
        max-width: 850px;
        margin:auto;
        padding: 20px;
        padding-top:40px;
        .settings-title{
            color: balck;
            text-transform: uppercase;
            font-weight: normal;
            font-size: 20px;
        }
        .settings-section {
            width:100%;
            border-top: 2px solid black;
            padding-top: 10px;
            margin-bottom: 20px;

            .my-form{
                max-width:400px;
                width:100%;
                margin:30px auto;
                .form-submit.right{
                    justify-content: flex-end;
                }
                .form-submit{
                    display: flex;
                    .btn{
                        width:50%;
                    }
                }
                .form-group.editable .input-group{
                    display: flex;
                    align-items: center;
                    margin-bottom: 0.5rem;
                    .form-control{
                        margin-bottom: 0;
                    }
                    .btn{
                        height: 38px;
                        margin: 0 10px;
                        background-color: white;
                        transition: all .5s;
                        &:hover{
                            color:#E59500;
                            background-color: #E5DADA;
                        }
                    }
                    i{
                        cursor:pointer;
                        color: black;
                        transition: all .5s;
                        &:hover{
                            color:black;
                        }
                    }
                }
            }
            .non-active-form{
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 0.5rem;
                p{
                    padding: 7px 15px;
                    margin-bottom: 0;
                    font-size: 1rem;
                    cursor:default;
                }
                i {
                    cursor:pointer;
                    color: #454545;
                    transition: all .5s;
                    margin-right: 10px;
                    &:hover{
                        color:#E59500;
                        transform: scale(1.1);
                    }
                }
            }
        }
    }
}

.my-form {
    visibility:visible;
    .form-group{
        .input-group{
            border-radius: 0.25rem;
            overflow: hidden;
            input.form-control {
                border:none;
                padding: 10px 15px;
                background-color: white;
                color:black;
                font-family:'Fira Sans', sans-serif;
            }
        }
        .alert-input{
            color:white;
            font-weight: 100;
            font-size: 13px;
        }
    }

    .form-submit{
        width: 100%;
        .btn {
            width:100%;
            border-radius: 0.25rem;
            background-color: blue;
            color:white;
            cursor:default;
            box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.2);

            &:disabled{
                opacity: 0.75;
            }
            &:not(:disabled):not(.disabled) {
                background-color: #0A9CE9;
                
            }
        }
    }
}

.btn.button.full {
    width: 100%;
    border-radius: 0.25rem;
    background-color: blue;
    color: white;
    cursor: pointer;
    box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.2); /* Adding box shadow */
    transition: all 0.3s ease; /* Adding transition for smooth effect */

    &:hover {
        background-color: #0A9CE9; /* Changing background color on hover */
        box-shadow: 4px 4px 6px 4px rgba(0, 0, 0, 0.3); /* Adding box shadow on hover */
    }

    &:disabled {
        opacity: 0.75;
    }
}

        </style>




    </body>
</html>
