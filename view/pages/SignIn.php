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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500&display=swap" rel="stylesheet">
    <title>Game changer</title>
</head>
<body>

<div class="content-sign-in">
    <h1>GameChanger</h1>
    <h2>Sign in</h2>
    <form method="post" class="form-sign-in">
        <?php include('../../model/actions/Login.php');?>
        <div class="form-in">
            <label for="username">Email</label>
            <input type="email" name="username" id="username" class="fields-text" required>
        </div>
        <div class="form-in">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="fields-text" required>
        </div>

        <div class="remember-me">
            <input type="checkbox" name="remember-me" class="fields-text"> Remember me
        </div>

        <div class="sign-in">
                <!--<input type="submit" value="Login" class="fields-text">-->
            <button type="submit" name="login-user" value="Login" id="login"">Login</button>
        </div>

        <div class="create-account">
            Not a member?
            <a href="SignUp.php">Create account</a>
        </div>
    </form>
</div>

<script src="../scripts/log.js"></script>

</body>
</html>