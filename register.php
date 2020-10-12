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
       $insert_query_users = "INSERT INTO $role (first_name, last_name, email, pass) VALUES ('$first_name', '$last_name', '$email', '$password');";
       $res = mysqli_query($link, $insert_query_users);
       if ($role == "teachers"){
           $insert_query_teachers ="CREATE TABLE IF NOT EXISTS `schedule$first_name` (
                                    `id` int(10) NOT NULL ,
                                    `username` varchar(20) NOT NULL,
                                    `date` varchar(10) NOT NULL,
                                    `time` float NOT NULL,
                                    `duration` int(1) DEFAULT NULL,
                                    `lessontype` varchar(10) DEFAULT NULL,
                                    `paid` int(1) DEFAULT NULL);";
           $res = mysqli_query($link, $insert_query_teachers);
       }

            setcookie('email',$email );
            setcookie('first_name', $first_name);
            setcookie('last_name', $last_name);
            setcookie('user_type', $role);

       $resObj->response = "Success";
       $resObj->msg = "Register Succeed";
       $resObj->user_type = $role;
    }

    $myJSON = json_encode($resObj);
    echo $myJSON;

}

?>


