<?php

include "mysqlConfig.php";

$email = $_COOKIE['email'];/* userid of the user */
$userType = $_COOKIE['user_type'];/* userid of the user */

if (count($_POST) > 0) {
    $result = mysqli_query($link, "SELECT pass from $userType WHERE email= '$email'");
    $row = mysqli_fetch_array($result);
    $newPass = $_POST["newPassword"];
    $resObj = new stdClass();

    if ($_POST["currentPassword"] != $row["pass"]) {
        $resObj->response = "Fail";
        $resObj->msg = "Current password is incorrect";
    }

    else if($_POST["newPassword"] != $_POST["confirmPassword"]) {
        $resObj->response = "Fail";
        $resObj->msg = "Confirm password is different";
    }
    else {
        $sql = "UPDATE $userType SET pass = '$newPass' WHERE email = '$email'";
        $res = mysqli_query($link, $sql);

        $resObj->response = "Success";
        $resObj->msg = "Success";
    }

    $myJSON = json_encode($resObj);
    echo $myJSON;
}

