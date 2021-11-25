<?php
include ('../../model/actions/PhpMailer/PHPMailer/PHPMailerAutoload.php');
$error = '';
$email ='' ;
$subject = 'Your bid was received';
$message = 'Your bid of value ';
if($_COOKIE['user_id']) {
    $iduser = $_COOKIE['user_id'];
//echo $iduser;

    $url = "http://localhost/GameChanger/controller/users?id=" . $iduser;
//$response = http_get($url);
    $contents = file_get_contents($url);
    $pattern = '/(\w+)(?:\.(\w+))?@gmail\.com/';
    preg_match($pattern, $contents, $matches);

    $email = $matches[0];
//print_r($matches);
//echo $contents;
    if (isset($_POST["submit3"])) {

        if ($error == '') {
            $mail = new PHPMailer();

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'game78changer@gmail.com';                 // SMTP username
            $mail->Password = 'GameChanger12345';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
            $mail->setFrom('game78changer@gmail.com', 'Mailer');
            $mail->addAddress($email);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('game78changer@gmail.com');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

            $mail->isHTML(true);                                  // Set email format to HTML
            $message .= $_POST["bidvalue"];
            $message .= '. Thank you for your bid.\n';
            $message .= 'Game Changer team';
            $mail->Subject = $subject;
            $mail->Body = '<div styles="background-color:blue; border-radius:10px;"><p>' . $message . '</p></div>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($mail->Send())                                //Send an Email. Return true on success or false on error
            {
                $error = 'ok';
            } else {
                $error = 'ok';
            }
            $error = '';
            $message = '';
        }
    }

}


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

    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
<!--    //<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>-->
    <link rel="stylesheet" href="../styles/grande.css">
    <link rel="stylesheet" href="../styles/style.css">
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
                    <a href="Games.html">Games</a>
                    <a href="Auction.html">Auction</a>
                    <a href="Contact.php">Contact</a>
                </div>
            </div>

            <form class="search-bar">
                <input type="search" name="search-website" placeholder="Search website" class="search-text">
                <input type="submit" value="Go" class="search-button">
            </form>
            <button class="my-account" onclick="location.href='SignIn.php'">My account</button>
            <div class="cart">
                <img src="../images/shopping-cart.png" class="shopping-cart" alt="shopping cart icon" />
                <div class="cart-items">0</div>
            </div>

        </div>

    </header>
    <br>

    <main class="main-classs">
        <div class="page">
            <div class="intro-presentation">
                <div class="product-image">
                    <img src="../product_images/elgrNDE.png" />
                </div>
                <div class="simple-description">
                    <h3>
                        El Grande (1995)</h3>
                    <p>Use your caballeros to control regions of medieval Spain, keeping clear of the King! </p>
                    <p> <span>Players: 2-5</span></p>
                    <p>Rating: 8.5</p>
                    <p>Age:12+</p>
                    <p>Current bid: 50$</p>
                    <form method="post" id="formbid">
                    <input type="number" name="bidvalue" placeholder="Your bid" class="number-input">
                    <input type="submit" name="submit3" value="Submit" class="make-a-bid">
                    </form>
                </div>
            
        </div>
        <div class="presentation-images">
            <img src="../product_images/grande/grande1.jpg">
            <img src="../product_images/grande/grande2.jpg">
            <img src="../product_images/grande/grande3.jpg">
            <img src="../product_images/grande/grande4.jpg">

        </div>
        </div>
        <div class="description">
            <h3>Description</h3>
            <p>	 In this award-winning game, players take on the roles of Grandes in medieval Spain. The king's power is flagging, and these powerful lords are vying for control of the various regions. To that end, you draft caballeros (knights in the form of colored cubes) into your court and subsequently move them onto the board to help seize control of regions. 
                After every third round, the regions are scored, and after the ninth round, the player with the most points is the winner
                In each of the nine rounds, you select one of your 13 power cards to determine turn order as well as the number of caballeros you get to move from the provinces 
                (general supply) into your court (personal supply). A turn then consists of selecting one of five action cards which allow variations to the rules and additional 
                scoring opportunities in addition to determining how many caballeros to move from your court to one or more of the regions on the board (or into the castillo - 
                a secretive tower). Normally, you may only place your caballeros into regions adjacent to the one containing the king pawn. The one hard and fast rule in
                 El Grande is that nothing may move into or out of the king's region. One of the five action cards that is always available each round allows you to move the 
                 king to a new region. The other four action cards varying from round to round. The goal is to have a caballero majority in as many regions (and the castillo) 
                 as possible during a scoring round. Following the scoring of the castillo, you place any cubes you had stashed there into the region you had secretly indicated
                  on your region dial. Each region is then scored individually according to a table printed in that region. Two-point bonuses are awarded for having sole majority
                   in the region containing your Grande (large cube) and in the region containing the king.</p>
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
<!--    <script src="script.js"></script>-->

</body>

</html>