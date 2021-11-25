<?php
include('../../model/repository/UserRepository.php');
include('../../model/models/User.php');

if(isset($_POST['add-address'])){
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $building = $_POST['building'];
    $entrance = $_POST['entrance'];
    $floor = $_POST['floor'];
    $apartment = $_POST['apartment'];
    $postal = $_POST['postal-code'];

    if(empty($country) || empty($state) || empty(city)
        || empty($street) || empty($building)
        || empty($postal)){

    }
}

?>