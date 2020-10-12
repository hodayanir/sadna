<?php

include "mysqlConfig.php";

$email = $_COOKIE['email'];/* userid of the user */

if(count($_POST)>0) {
$result = mysqli_query($link, "SELECT pass from teachers WHERE email='" . $email . "'");
$row=mysqli_fetch_array($result);
$newPass = $_POST["newPassword"];

if($_POST["currentPassword"] == $row["pass"] && $_POST["newPassword"] == $_POST["confirmPassword"] ) {
    
    $sql = "UPDATE teachers SET pass = '$newPass' WHERE email = '$email'";
    $res = mysqli_query($link, $sql);

 $message = "Password Changed Sucessfully";
}
} else{
    
 $message = "Password is not correct";
 
}

header("Location: my_area.php");

?>
