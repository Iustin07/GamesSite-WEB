<?php
include ('../../model/actions/PhpMailer/PHPMailer/PHPMailerAutoload.php');
$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

if(isset($_POST["submit2"]))
{
    if(empty($_POST["nameContact"]))
    {
        $error .= '<p><label class="class-danger">Please Enter your Name</label></p>';
    }
    else
    {
        $name = clean_text($_POST["nameContact"]);
        if(!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $error .= '<p><label class="class-danger">Only letters and white space allowed</label></p>';
        }
    }
    if(empty($_POST["emailContact"]))
    {
        $error .= '<p><label class="class-danger">Please Enter your Email</label></p>';
    }
    else
    {
        $email = clean_text($_POST["emailContact"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error .= '<p><label class="class-danger">Invalid email format</label></p>';
        }
    }
    if(empty($_POST["subjectContact"]))
    {
        $error .= '<p><label class="class-danger">Subject is required</label></p>';
    }
    else
    {
        $subject = clean_text($_POST["subjectContact"]);
    }
    if(empty($_POST["messageContact"]))

    {
        $error .= '<p><label class="class-danger">Message is required</label></p>';
    }
    else
    {
        $message = clean_text($_POST["messageContact"]);
    }
    if($error == '')
    {
        $mail = new PHPMailer();

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'game78changer@gmail.com';                 // SMTP username
        $mail->Password = 'GameChanger12345';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->setFrom($email,'Mailer');
        $mail->addAddress('game78changer@gmail.com');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($email);
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = '<div styles="background-color:blue; border-radius:10px;"><p>'.$message.'</p></div>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if($mail->Send())								//Send an Email. Return true on success or false on error
        {
            $error = '<label class="text-success">Thank you for contacting us</label>';
        }
        else
        {
            $error = '<label class="class-danger">There is an Error</label>';
        }
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/contact.css">
    <link rel="stylesheet" href="../styles/mainstyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500&display=swap" rel="stylesheet">
    <title>Game changer</title>
</head>

<body>
    <div class="dilatare">
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
                        <a href="#">Contact</a>
                    </div>
                </div>

                <form class="search-bar">
                    <input type="search" name="search-website" placeholder="Search website" class="search-text">
                    <button type="submit" class="search-button">Go</button>
                </form>
                <button class="my-account" onclick="location.href='SignIn.php'">My account</button>
                <div class="cart">
                <img src="../images/shopping-cart.png" class="shopping-cart" alt="shopping cart icon">
                <div class="cart-items">0</div>
                </div>
            </div>
        </header>
        <div class="content-contact">
            <h1>Be free to contact us for more information or just for feedback</h1>
             <br>

            <div class="section">
                <form method="post" class="contact-form">

                    <?php echo $error;?>
                    <?php echo "<br>";?>
                    <label>Name</label>
                    <input class="form-input" name="nameContact" placeholder="Your Name" type="text" value="<?php echo $name; ?>" required />
                    <label>Email</label>
                    <input class="form-input" name="emailContact" placeholder="Email" type="text" value="<?php echo $email; ?>" required />
                    <label>Subject</label>
                    <input class="form-input" name="subjectContact" placeholder="Subject" type="text"  value="<?php echo $subject; ?>" required />
                    <label>Message</label>
                    <textarea name="messageContact" placeholder="message" required><?php echo $message; ?></textarea>

                    <input class="form-input" type="submit" name="submit2" value="Submit" class="btn btn-info" />
                </form>

            </div>
        </div>

        <br>

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
    </div>
</body>

</html>