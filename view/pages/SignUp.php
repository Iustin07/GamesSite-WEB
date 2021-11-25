
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
    <link rel="stylesheet" href="../styles/errors.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;500&display=swap" rel="stylesheet">
    <title>Game changer</title>
</head>
<body>

    <div class="content-sign-up">
        <h1>GameChanger</h1>
        <h2>Sign up</h2>
        <form class="form-sign-up" method="post" action="SignUp.php">

            <?php include('../../model/actions/Register.php');?>
            <div class="form-in">
                <label for="firstName">First name</label>
                <input type="text" name="firstName" id="firstName" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="lastName">Last name</label>
                <input type="text" name="lastName" id="lastName" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="username">Email</label>
                <input type="email" name="username" id="username" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="phoneNumber">Phone number</label>
                <input type="tel" name="phoneNumber" id="phoneNumber" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="fields-text" required>
            </div>

            <div class="form-in">
                <label for="repeat-password">Confirm password</label>
                <input type="password" name="repeat-password" id="repeat-password" class="fields-text" required>
            </div>

            <div class="sign-up">
                <!--<input type="submit" value="Create account">-->
                <button type="submit" name="register-user" value="Create account" id="create-account"> <!--onclick="location.href='Home.php'"-->Create account</button>
            </div>
        </form>
    </div>

</body>
</html>