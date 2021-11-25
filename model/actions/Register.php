<?php
include('../../model/repository/UserRepository.php');
include('../../model/models/User.php');


$errArray = array();

if (isset($_POST['register-user'])) {
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $eMail = $_POST['username'];
    $phoneNr = $_POST['phoneNumber'];
    $passwd = $_POST['password'];
    $repeatPass = $_POST['repeat-password'];
    if (empty($fName) or empty($lName) or empty($eMail) or empty($phoneNr) or empty($passwd)) {
        array_push($errArray, "All fields must be filled in!");
    }
    if ($passwd != $repeatPass) {
        array_push($errArray, "Passwords don't match");
    }
    $emailCopy = $eMail;
    $emailParts = explode("@", $emailCopy);
    $emailDomain = explode(".", $emailParts[1]);
    if ($emailDomain[0] != 'gmail') {
        array_push($errArray, "Email must be from gmail domain!");
    }
    if (strlen($passwd) < 8) {
        array_push($errArray, "Password must contain at least 8 letters");
    }
    $userRepository = new UserRepository();
    if ($userRepository->findByEmail($eMail) != null) {
        array_push($errArray, "E-mail is taken");
    }

    if (count($errArray) == 0) {
        //register user
        $userRepository->addUser(new User($fName, $lName, $eMail, $phoneNr, password_hash($passwd, PASSWORD_DEFAULT), 0));
        echo "Redirecting to login page...";
        sleep(3);
        header('Location: ../pages/SignIn.php');
    } else {
        //register invalid
        foreach ($errArray as $error) {
            echo "<p style='color: red; '>$error!</p>";
        }
    }
}


?>