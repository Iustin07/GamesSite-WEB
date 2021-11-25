<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="co-authored by Balint Paula, Bodnariu Daniel">
    <meta name="description" content="Game Changer aims to provide a way for game addicts to purchase their desired games,
 and to be able to bargain for antique, valuable collectible games.">
    <meta property="og:image" content="Game Changer logo">
    <meta property="og:description" content="Game Changer provides a way to buy and collect games easily.">

    <meta property="og:title" content="Game Changer">

    <link rel="shortcut icon" href="../images/logo.ico" type="image/x-icon">


    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/mainstyle.css">
    <link rel="stylesheet" href="../styles/my-account.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500&display=swap" rel="stylesheet">
    <title>Game changer</title>
</head>
<body>

<header>
    <div class="brand-name">
        <a class="header-brand-mob" href="Home.php">GameChanger</a>
    </div>

    <div class="header-content">

        <div class="drop">
            <div class="dropbtn">
                <img src="../images/menu_icon.jpg" class="menuIcon" alt="menu icon">
            </div>
            <div class="drop-content">
                <a href="Home.php">Home</a>
                <a href="SignIn.php">Login</a>
                <a href="Games.php">Games</a>
                <a href="Auction.php">Auction</a>
                <a href="Contact.php">Contact</a>
                <a href="Admin.php">Admin page</a>
            </div>
        </div>


        <form class="search-bar">
            <input type="search" name="search-website" placeholder="Search website" class="search-text">
            <input type="submit" value="Go" class="search-button">
        </form>
        <button class="my-account" onclick="location.href='SignIn.php'">My account</button>
        <div class="cart">
            <img src="../images/shopping-cart.png" class="shopping-cart" alt="shopping cart icon">
            <div class="cart-items">0</div>
        </div>
    </div>

</header>

<main class="account-page-content">
    <aside class="account-view-options">
        <img src="../images/user-icon.png" class="generic-user-icon">
        <h3 class="account-user-name"><?=$_SESSION['user_lName'] . " " . $_SESSION['user_fName'] ?></h3>
        <ul>
            <!--<li><button class="my-address">Add Address</button></li>-->
            <!--<li><button class="my-orders">Orders</button></li>
            <li><button class="my-account-info">Account details</button></li>-->
            <li><button class="my-account-logout" onclick="logout()">Logout</button></li>
        </ul>
    </aside>

    <div class="my-address">
        <form class="form-add-address" method="post">
            <?php include('../../model/actions/Register.php');?>
            <div class="form-in" id ="first-inp">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="state">State</label>
                <input type="text" name="state" id="state" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="street-name">Street Name</label>
                <input type="tel" name="street-name" id="street-name" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="building">Building</label>
                <input type="number" name="building" id="building" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="entrance">Entrance</label>
                <input type="text" name="entrance" id="entrance" class="fields-text" >
            </div>

            <div class="form-in">
                <label for="floor">Floor</label>
                <input type="number" name="floor" id="floor" class="fields-text" >
            </div>

            <div class="form-in">
                <label for="apartment">Apartment</label>
                <input type="number" name="apartment" id="apartment" class="fields-text" >
            </div>

            <div class="form-in">
                <label for="postal-code">Postal code</label>
                <input type="text" name="postal-code" id="postal-code" class="fields-text" required>
            </div>

            <div class="add-address-class">
                <button type="submit" class="post-address" name="add-address" value="Add address" id="add-address-id"> <!--onclick="location.href='Home.php'"-->Add address</button>
            </div>
        </form>
    </div>

</main>

<footer>
    <div class="footer-links">

        <nav>
            <ul class="info-links">
                <li><a href="Contact.php" class="contact">Contact</a></li>
                <li><a href="Buy.php" class="home">How to buy</a></li>
                <li><a href="terms.php" class="home">Terms and conditions</a></li>
                <li><a href="Stats.php" class="home">Statistics</a></li>
                <li><a href="Documentation.html" class="home">Documentation</a></li>
            </ul>
        </nav>
    </div>
    <div class="footer-social-media">
        <div class="copyright">

            &copy; Copyright 2021 Game Changer


        </div>
        <div class="centerIcon">
            <img src="../images/facebook_logo.png" alt="facebook page logo">
            <img src="../images/instagram_logo.png" alt="instagram page logo">
            <img src="../images/twitter_logo.png" alt="twitter page logo">
        </div>
    </div>

</footer>

<script src="../scripts/log.js"></script>

</body>
</html>