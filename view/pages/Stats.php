<?php
$web_url="http://".$_SERVER['SERVER_NAME']. $_SERVER["REQUEST_URI"];
$str="<?xml vsersion='1.0' ?>";
$str .="<rss version='2.0'>";
$str .= "<channel>";
$str .="<titlte>Game changer</titlte>";
$str .="<description>Online toys shop</description>";
$str .="<language>en-US</language>";
$str .="<link>$web_url</link>";
$conn = mysqli_connect("localhost", "root", "", "game_changer");
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY NUMBERSELLES DESC LIMIT 15");

while ($row = mysqli_fetch_object($result))
{
    $str .= "<item>";
    $str .= "<title>" . htmlspecialchars($row->name) . "</title>";
    $str .= "<description>" . htmlspecialchars($row->category) . " " .htmlspecialchars($row->numberSelles) ."</description>";
    $str .= "<link>" . $web_url . "/product.php?id=" . $row->id . "</link>";
    $str .= "</item>";
}

$str .="</channel>";
$str .="</rss>";
file_put_contents("rss.xml",$str);
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
    <link rel="stylesheet" href="../styles/statistic.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500&display=swap" rel="stylesheet">
    <title>Game changer</title>
</head>

<body onload="onLoadStats()">
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
            <button class="my-account" onclick="location.href='SignIn.php'">My account</button>
            <div class="cart">
                <img src="../images/shopping-cart.png" class="shopping-cart" alt="shopping cart icon">
                <div class="cart-items">0</div>
            </div>
        </div>

    </header>

    <main class="content">
        <div class="format">

            <div class="export-by">
                <div class="stats">
                    <label for="export-based-on">Export</label>
                    <select name="export-based-on" class="filters" id="export-based-on" onchange="changFunc()">
                        <option value="stat1">Most bought</option>
                        <option value="stat2">Least bought</option>
                    </select>
                </div>

                <div class="formats">
                    <label for="export-in-format">Format</label>
                    <select name="export-in-format" class="filters" id="export-in-format">
                        <option value="pdfFormat">PDF</option>
                        <option value="csvFormat">CSV</option>

                    </select>
                </div>

            </div>

            <div class="table-container" id="tbContainer">
                <table id="tableId">


                </table>
            </div>
            <button class="export-stat" onclick="Export()">Export</button>

            <div class="most-popular">
                Most popular:
                <a class="link" href="rss.xml" target="_blank">
                <img src="../images/rss.png" alt="rss icon" class="rss-flux">
                </a>
            </div>

        </div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src='../scripts/stats.js'> </script>
    <script src='../scripts/stats2.js'> </script>
    <script type="text/javascript" src='../scripts/auction-products.json'></script>
</body>

</html>