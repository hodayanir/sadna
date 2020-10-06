<?php
include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_email = $_POST["email"];
    $u_pass = $_POST["password"];
    $resObj = new stdClass();

    $sql_query="SELECT email, first_name, last_name, 'students' as user_type  FROM students WHERE (email='$u_email' AND pass='$u_pass')  
                UNION
                SELECT email, first_name, last_name, 'teachers' as user_type FROM teachers WHERE (email='$u_email' AND pass='$u_pass')";
    $res=mysqli_query($link, $sql_query);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_row($res);
        setcookie('email', $row[0]);
        setcookie('first_name', $row[1]);
        setcookie('last_name', $row[2]);
        setcookie('user_type', $row[3]);
        $resObj->response = "Success";
        $resObj->user_type = $row[3];
    }
    else {
        $resObj->response = "Fail";
    }
    $myJSON = json_encode($resObj);
    echo $myJSON;

}

