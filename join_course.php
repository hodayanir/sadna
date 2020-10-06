<?php
include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_email = $_COOKIE['email'];
    $t_email = $_POST["teacherEmail"];
    $courseCode = $_POST["courseCode"];
   

    $insert_course = "INSERT IGNORE INTO StudentInCourse (studentEmail, teacherEmail, courseCode) VALUES ('$s_email', '$t_email', '$courseCode');";
    $res = mysqli_query($link, $insert_course);

    header("Location: studentDashboard.php");

}