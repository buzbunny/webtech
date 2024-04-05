<?php
    // require 'connection.php';
    // include "core.php";
    // session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Your Watch Now</title>
    <style>
        body {
            margin: 0;
            font-family: Agenda-Light, Agenda Light, Agenda, Arial Narrow, sans-serif;
            font-weight: 100;
            color: white;
        }

        #background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        #polina {
            background: rgba(0, 0, 0, 0.6);
            padding: 2rem;
            width: 33%;
            margin: 2rem;
            float: left; /* Change float from right to left */
            font-size: 1.2rem;
            color: white;
        }

        h1 {
            font-size: 3rem;
            text-transform: uppercase;
            margin-top: 0;
            letter-spacing: .3rem;
        }

        #polina button {
            display: block;
            width: 100%; /* Make the button width 100% */
            padding: .8rem; /* Adjust padding */
            border: none;
            font-size: 1.3rem;
            background: rgba(255, 255, 255, 0.23);
            color: #fff;
            cursor: pointer;
            transition: .3s background;
        }

        #polina button:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        a {
            text-decoration: none; /* Remove underline */
        }

        @media screen and (max-width: 500px) {
            #polina {
                width: 70%;
            }
        }

    </style>
</head>
<body>
<div id="background-image">
    <img src="landing/assets/sell_bg.jpeg" alt="PINK" style="width: 100%; height: 100%; object-fit: cover;">
</div>
<div id="polina">
    <h1>SELL YOUR WATCH NOW</h1>
    <img src="landing/assets/logo.png" alt="logo" width="40%"/>
    <p>WristLux.Co</p>
    <p>To effectively add your product to a watch trading site, follow these steps:</p>
    <p>Create an Account: Sign up and understand site policies. Research Similar Listings: Browse similar products. Prepare Your Product Information: Gather details. Capture High-Quality Images: Take clear photos. Write a Compelling Description: Include key features. Set a Competitive Price: Research market value. Select the Right Category and Tags: Choose appropriate tags. Review Site Policies: Understand fees and policies. Publish Your Listing: Double-check details. Monitor and Respond: Be responsive to inquiries.</p>

    <a href="add_product.php"><button>Proceed To Sell</button></a>
</div>
</body>
</html>
