<?php
include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_email = $_POST["email"];
    $u_pass = $_POST["password"];
    $resObj = new stdClass();

    $sql_query="SELECT email, first_name FROM students WHERE (email='$u_email' AND pass='$u_pass')  
                UNION
                SELECT email, first_name  FROM teachers WHERE (email='$u_email' AND pass='$u_pass')";
    $res=mysqli_query($link, $sql_query);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_row($res);
        setcookie('first_name', $row[1]);
        setcookie('email', $u_email);
        $resObj->response = "Success";
    }
    else {
        $resObj->response = "Fail";
    }
    $myJSON = json_encode($resObj);
    echo $myJSON;

}

