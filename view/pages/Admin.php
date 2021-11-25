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
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="../styles/home2-style.css">
    <link rel="stylesheet" href="../styles/mainstyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
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
                </div>
            </div>

            <form class="search-bar">
                <input type="search" name="search-website" placeholder="Search website" class="search-text">
                <input type="submit" value="Go" class="search-button">
            </form>
            <button class="my-account">Admin</button>
            <div class="cart">
                <img src="../images/shopping-cart.png" class="shopping-cart" alt="shopping cart icon" />
                <div class="cart-items">0</div>
            </div>

        </div>

    </header>
    <br>

    <main class="main-classs">
        <aside class="side-filters">
            <img class="adminImage" src="../images/admin.png" alt="admin">
            <ul>
                <li> <button class="adminButton catTypeButton" id="stats1"> Stats</button></li>
                <li><button class="adminButton catTypeButton" id="modProd"> Modify Product</button></li>
                <li><button class="adminButton catTypeButton" id="addProd"> Add product</button></li>
                <li><button class="adminButton catTypeButton" id="removeProd"> Remove product</button></li>
                <li><button class="adminButton catTypeButton" id="removeUser"> Remove user</button></li>
                <li> <button class="adminButton catTypeButton" id="modUser"> Modify user</button></li>

            </ul>
            <br>

        </aside>
        <div class="page">
            <div class="view">
                <div class="row">
                    <div class="card bg-gradient">

                        <div class="card-img-holder">
                            <div class="card-body">
                                <img src="../images/circle.svg" class="image-absolute" alt="circle-image">
                            </div>
                            <h4 class="text-white">Sales</h4>
                            <h4 class=text-white2>50.000$</h4>
                        </div>
                    </div>
                    <div class="card bg-gradient2">

                        <div class="card-img-holder">
                            <div class="card-body">
                                <img src="../images/circle.svg" class="image-absolute" alt="circle-image">
                            </div>
                            <h4 class="text-white">Orders</h4>
                            <h4 class=text-white2>45.000</h4>
                        </div>
                    </div>
                    <div class="card bg-gradient3">

                        <div class="card-img-holder">
                            <div class="card-body">
                                <img src="../images/circle.svg" class="image-absolute" alt="circle-image">
                            </div>
                            <h4 class="text-white">Money left</h4>
                            <h4 class=text-white2>26.000$</h4>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row-2">
                <img src="../images/statistics.jpg" alt="statistics">
                <img src="../images/trafic.jpg" alt="trafic">
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

    <script src="../scripts/admin.js"></script>

</body>

</html>