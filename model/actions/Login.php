<?php
session_start();
ob_start();
include_once('../../controller/UserController.php');
include_once('../../model/repository/UserRepository.php');
include_once('../../model/models/User.php');
include_once('../../controller/SessionController.php');


$errArray = array();

if (isset($_POST['login-user'])) {
    $eMail = $_POST['username'];
    $pass = $_POST['password'];
    if (empty($eMail) or empty($pass)) {
        array_push($errArray, "All fields must be filled in!");
    }
    $userRepository = new UserRepository();
    $user = $userRepository->findByEmail($eMail);

    //assume he doesn't have an account
    $hasAccount = false;
    //is email set in response? yes -> has account
    if (isset($user['EMAIL'])) {
        $hasAccount = true;
    }

    //if has account, check pass
    if ($hasAccount == true) {
        if(isset($user['PASSWORD'])){
            $passHash = $user['PASSWORD'];
            if (password_verify($pass, $passHash) == false) {
                array_push($errArray, "E-mail or password is not correct");
            }
        }
        else{
            echo "in not set pass";
            array_push($errArray, "E-mail or password is not correct");
        }
    }
    else{
        //doesn't have account, display err
        array_push($errArray, "E-mail or password is not correct");
    }

    if (count($errArray) == 0) {
        //login user
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['user_email'] = $user['EMAIL'];
        $_SESSION['user_fName'] = $user['FNAME'];
        $_SESSION['user_lName'] = $user['LNAME'];
        sleep(3);
        header('Location: ../pages/SignIn.php');
        $token = openssl_random_pseudo_bytes(128);
        $serial = openssl_random_pseudo_bytes(128);

        $controller = new SessionController('POST', $user['ID'], $token, $serial);
        $response = $controller -> processRequest();

        ob_clean();

        if($response == 'HTTP/1.1 201 Created'){
            setcookie('user_id', $user['ID'], time() + (60 * 60 * 24 * 10));
            setcookie('token', $token, time() + (60 * 60 * 24 * 10));
            setcookie('serial', $serial, time() + (60 * 60 * 24 * 10));
        }
        sleep(1);
        /*header('Location: ../../../view/pages/Home.php');*/
        echo "<script>window.location ='../../view/pages/Home.php';</script>";
    } else {
        //login invalid
        foreach ($errArray as $error) {
            echo "<p style='color: red; '>$error!</p>";
        }
    }
}

?>