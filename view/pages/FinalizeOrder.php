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
    <link rel="stylesheet" href="../styles/finalize-order.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <title>Game changer</title>
</head>

<body>
<header>
    <div class="brand-name">
        <a class="header-brand-mob" href="Home.php">GameChanger</a>
    </div>

    <div class="brand-logo">
        <img src="../images/logo.ico" alt="brand logo">
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
            </div>
        </div>

        <form class="search-bar">
            <input type="search" name="search-website" placeholder="Search website" class="search-text">
            <button type="submit" class="search-button">Go</button>
        </form>
        <button class="my-account" onclick="location.href='SignIn.php'">My account</button>
        <div class="cart" onclick="showCart()">
            <img src="../images/shopping-cart.png" class="shopping-cart" alt="shopping cart icon">
            <div class="cart-items">0</div>
        </div>

    </div>

</header>

<div class="content-finalize">
    <h1>Order content:</h1>
    <main class="order-products-final-content">
        <article class="single-product-in-final-order">
            <h4 class="product-final-name">Name</h4>
            <h4 class="product-final-price">Price</h4>
            <h4 class="product-final-quantity">Quantity</h4>
            <h4 class="products-final-subtotal">Subtotal item</h4>
        </article>

        <h3>Subtotal : </h3>

        <div class="shipping-service">
            <h4 class="shipping-service-name">Shipping service : Fan Courier</h4>
            <h4 class="shipping-service-tax">Tax : $4</h4>
        </div>

        <h2>Total:</h2>

        <h2>Payment method: cash on delivery</h2>

        <button class="place-order">Place order</button>

    </main>
</div>
<footer>
    <div class="footer-links">
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
    </div>

</footer>

<script src="../scripts/cart_sc.js"></script>
</body>

</html>
