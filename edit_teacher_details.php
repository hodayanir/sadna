<?php
include "mysqlConfig.php";

$resObj = new stdClass();
# set variables #
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $country = $_POST["country"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $description = $_POST["description"];
    
    
    echo $first_name;
    echo $country;
    echo $address;
    
    $mail =  $_COOKIE['email'];
    
    
    $sql = "UPDATE teachers SET first_name = '$firstname', last_name = '$last_name', country = '$country', address = '$address', phone = '$phone', description = '$description' WHERE email = '$mail'";
    $res = mysqli_query($link, $sql);
        header("Location: my_area.html");



}

?>

