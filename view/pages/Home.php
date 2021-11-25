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
   
    <link rel="stylesheet" href="../styles/home2-style.css">
    <link rel="stylesheet" href="../styles/mainstyle.css">
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
            <button class="my-account" onclick="redirectBasedOnCheck()">My account</button>
            <div class="cart">
                <img src="../images/shopping-cart.png" class="shopping-cart" alt="shopping cart icon">
                <div class="cart-items">0</div>
            </div>
        </div>

    </header>
    <br>
    <main class="content">
        <div class="intro">
            <div class="intro-image">
                <img id="intro-img" src="../images/image3.png" alt="intro-image">
            </div>
            <div class="text-intro">
                <h2>Perfect place for finding a way to spend time with your family</h2>
                <!--<p>What is Lorem Ipsum?
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make a type specimen book.
                        </p>-->

            </div>
        </div>

        <div class="presentation">
            <div class="storys">
                <div class="combine">
                    <p class="combine-p">Are you spending too little time socializing with your family? this is the perfect place where you can find the solution 
                        to this problem. Buy a game now and prepare unforgettable evenings with your family. </p>
                    <img class="combine-image"
                        src="../images/family-playing-board-game-at-home-with-grandparents-watching.jpg"
                        alt="family-image">
                </div>
                <div class="combine combine-list">
                    <p class="combine-p-right"> 
                        Our site offers a wide range of board games so you can choose according to your budget and desires. Start the fun now! </p>
                    <img class="combine-image-left" src="../images/bunch.jpg" alt="chess">
                </div>
                <div class="combine-final">
                    <p class="combine-p-third"> 
                        For collectors and board game enthusiasts we offer a bidding support for classic childhood games. In the auction section you can bid for vintage games 
                        that have made history or that simply remind you of periods when they were in trend. </p>
                    <img class="combine-image-right-third" src="../images/photo-1595110045856-a6addbdbcd8b.png"
                        alt="puzzle">
                </div>
            </div>

        </div>
        <br>
    </main>

    <footer class="under">
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

</body>
<script src="../scripts/log.js"></script>
</html>