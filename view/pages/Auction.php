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
    <!--animations-->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <!--my imports-->
    <link rel="stylesheet" href="../styles/auction.css">
    <link rel="stylesheet" href="../styles/home2-style.css">
    <link rel="stylesheet" href="../styles/mainstyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <script src='../scripts/auction-products.js'></script>
    <title>Game changer</title>
</head>

<body onload="onLoadAuction()">
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
            </div>
        </div>

        <form class="search-bar">
            <input type="search" name="search-website" placeholder="Search website" class="search-text">
            <input type="submit" value="Go" class="search-button">
        </form>
        <button class="my-account" onclick="redirectBasedOnCheck()">My account</button>
        <div class="cart">
            <img src="../images/shopping-cart.png" class="shopping-cart" alt="shopping cart icon"/>
            <div class="cart-items">0</div>
        </div>

    </div>

</header>
<br>

<main class="main-class">
    <aside class="side-filters">
        <button class="filterButton filterAllButton" id="all" onclick={resetFilters()}>All types</button>

        <select class="selectClass" id="typeSelector" onchange={myTypeFilter()}>
            <option value="type">Type</option>
            <option value="strategy">Strategy</option>
            <option value="cards">Cards</option>
        </select>
        <br>
        <select class="selectClass" id="ageSelector" onchange={myAgeFilter()}>
            <option value="age">Age</option>
            <option value="age8">8+</option>
            <option value="age12">12+</option>
            <option value="age14">14+</option>
        </select>
        <br>
        <select class="selectClass" id="ratingSelector" onchange={myRatingFilter()}>
            <option value="rating">Rating</option>
            <option value="rat7">under 6.5</option>
            <option value="rat8">under 8</option>
            <option value="rat9">over 8</option>
        </select>
        <br>
    </aside>
    <div class="page">
        <div class="filter">
            <button class="filterButton filterAllButton" id="all" onclick={resetFiltersMobile()}> All types</button>
            <select class="selectClass" id="typeSelectorMobile" onchange={myTypeFilterMobile()}>
                <option value="type">Type</option>
                <option value="strategy">Strategy</option>
                <option value="cards">Cards</option>
            </select>
            <br>
            <select class="selectClass" id="ageSelectorMobile" onchange={myAgeFilterMobile()}>
                <option value="age">Age</option>
                <option value="age8">8+</option>
                <option value="age12">12+</option>
                <option value="age14">14+</option>
            </select>
            <br>
            <select class="selectClass" id="ratingSelectorMobile" onchange="myRatingFilterMobile()">
                <option value="rating">Rating</option>
                <option value="rat7">under 6.5</option>
                <option value="rat8">under 8</option>
                <option value="rat9">over 8</option>
            </select>
            <br>


        </div>
        <div class="products" id="auctionProd">
        </div>
    </div>
</main>

<br>

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
<script src='../scripts/auction-products.js'></script>
<script src='../scripts/filter.js'></script>
<script type="text/javascript" src='../scripts/auction-products.json'></script>
<script type="text/javascript" src='../scripts/log.json'></script>

</body>

</html>