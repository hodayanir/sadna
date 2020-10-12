<?php

include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $t_first_name = $_POST["first_name"];
    $t_last_name = $_POST["last_name"];
    $t_country = $_POST["country"];
    $t_address = $_POST["address"];
    $t_phone = $_POST["phone"];
    $t_description = $_POST["description"];
    $t_email = $_COOKIE['email'];
    $twitter =  $_POST['twitter'];
    $facebook =  $_POST['facebook'];
    $zoom =  $_POST['zoom'];
    $linkedin =  $_POST['linkedin'];
    
    $resObj = new stdClass();

    $update_teacher = "UPDATE teachers SET first_name = '$t_first_name', linkedin = '$linkedin' ,zoom = '$zoom' ,facebook = '$facebook' ,twitter = '$twitter' ,last_name = '$t_last_name', country = '$t_country', address = '$t_address', phone = '$t_phone', description = '$t_description' where email = '$t_email'";
    $update_student = "UPDATE students SET first_name = '$t_first_name', last_name = '$t_last_name', country = '$t_country', address = '$t_address', phone = '$t_phone', description = '$t_description' where email = '$t_email'";
    $res = mysqli_query($link, $update_teacher);
    $res_student = mysqli_query($link, $update_student);

    
    if ($_COOKIE['user_type'] == "teachers" ) {
    
    header("Location: my_areaTeacher.php");
    }
    
    else {
        header("Location: my_areaStudent.php");
    }
}