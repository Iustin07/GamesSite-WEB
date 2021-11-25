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
    <link rel="stylesheet" href="../styles/products.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <title>Game changer</title>
</head>

<body onload="onLoadGames()">
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
                <a href="#">Games</a>
                <a href="Auction.php">Auction</a>
                <a href="Contact.php">Contact</a>
            </div>
        </div>

        <form class="search-bar">
            <input type="search" name="search-website" placeholder="Search website" class="search-text">
            <button type="submit" class="search-button">Go</button>
        </form>
        <button class="my-account" onclick="redirectBasedOnCheck()">My account</button>
        <div class="cart" onclick="showCart()">
            <img src="../images/shopping-cart.png" class="shopping-cart" alt="shopping cart icon">
            <div class="cart-items">0</div>
        </div>

    </div>

</header>

<div class="page-content">
    <aside class="filter-options">


        <button class="filter-all-types" id="all-filters" onclick={resetFilters()}>All types</button>

        <div class="single-filter">
            <label for="age-category">Age category</label>
            <select class="filters" id="typeSelector" onchange={myTypeFilter()}>
                <option value="type">Type</option>
                <option value="strategy">Strategy</option>
                <option value="cards">Cards</option>
            </select>
        </div>

        <div class="single-filter">
            <label for="players-number">Number of players</label>
            <select class="filters" id="ageSelector" onchange={myAgeFilter()}>
                <option value="age">Age</option>
                <option value="age8">8+</option>
                <option value="age12">12+</option>
                <option value="age14">14+</option>
            </select>
        </div>

        <div class="single-filter">
            <label for="game-type">Game type</label>
            <select class="filters" id="ratingSelector" onchange={myRatingFilter()}>
                <option value="rating">Rating</option>
                <option value="rat7">under 6.5</option>
                <option value="rat8">under 8</option>
                <option value="rat9">over 8</option>
            </select>
        </div>

    </aside>


    <main class="products">

        <div class="cart-info" id="hide-cart">
            <div class="my-cart">
                        <span class="close-cart">
                            <img src="../images/close_icon.png" alt="Close cart icon" onclick="hideCart()">
                        </span>
                <h2>Your cart</h2>
                <div class="cart-content">

                </div>


                <div class="cart-footer">
                    <h3>Your total : $
                        <span class="cart-total">
                                    0
                                </span>
                    </h3>
                    <button class="clear-cart">
                        Clear cart
                    </button>

                    <button class="purchase-products">Purchase</button>

                </div>

            </div>
        </div>
        <div class="productsSecond" id="gamesProd">
        </div>


    </main>
</div>
<br>
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
<script src="../scripts/games-products.js"></script>
<script src="../scripts/cartShowHide.js"></script>
<script src="../scripts/cart_sc.js"></script>
<script src="../scripts/log.js"></script>

</body>

</html>
