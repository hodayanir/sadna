<?php
include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_name = $_POST["courseName"];
    $c_desc = $_POST["courseDes"];
    $c_tag = $_POST["courseTags"];
    $t_email = $_COOKIE['email'];
    $resObj = new stdClass();

    $insert_course = "INSERT INTO courses (name, description, tag, teacherEmail) VALUES ('$c_name', '$c_desc', '$c_tag','$t_email');";
    $res = mysqli_query($link, $insert_course);

    header("Location: index.html");

}