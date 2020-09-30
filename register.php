<?php
include "mysqlConfig.php";

$resObj = new stdClass();
# set variables #
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_REQUEST["role"];
    $first_name = $_REQUEST["first_name"];
    $last_name = $_REQUEST["last_name"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    if($role == "student")
    {
        $role = "students";
    }
    else{
        $role = "teachers";
    }

    $sql_query = "SELECT email FROM students WHERE email ='$email' UNION SELECT email FROM teachers WHERE email ='$email'";
    $res = mysqli_query($link, $sql_query);
    if (mysqli_num_rows($res) > 0) {
        $resObj->response = "Fail";
        $resObj->msg = "Email already exists";
    } else {
       $insert_query_students = "INSERT INTO $role (first_name, last_name, email, pass) VALUES ('$first_name', '$last_name', '$email', '$password');";
        //$insert_query_students = "INSERT INTO students (first_name, last_name, email, country, address, phone, description, pass ) VALUES ('aaa', 'aaa' , 'aabcd@aa', 'f' , 'f' , 'f', 'ff', 'g');";
        $res = mysqli_query($link, $insert_query_students);
        $resObj->response = "Success";
        $resObj->msg = "Register Succeed";
    }

    $myJSON = json_encode($resObj);
    echo $myJSON;

}

//$from = "tmo.s3345@gmail.com";
//#send email #
//$headers = "From: $from";
//$headers = "From: " . $from . "\r\n";
//$headers .= "Reply-To: " . $from . "\r\n";
//$headers .= "MIME-Version: 1.0\r\n";
//$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//
//$subject = "Thank you for registering us as a $role.";
//
//$logo = 'img/logo.png';
//$link = '#';
//
//$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
//$body .= "<table style='width: 100%;'>";
//$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
//$body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
//$body .= "</td></tr></thead><tbody><tr>";
//$body .= "<td style='border:none;'><strong>Name:</strong> {$first_name}</td>";
//$body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
//$body .= "</tr>";
//$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$subject}</td></tr>";
//$body .= "<tr><td></td></tr>";
//$body .= "<tr><td colspan='2' style='border:none;'>{$message}</td></tr>";
//$body .= "</tbody></table>";
//$body .= "</body></html>";
//
//$send = mail($email, $subject, $body, $headers);
?>


