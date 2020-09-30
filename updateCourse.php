<?php
include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_name = $_POST["courseName"];
    $c_desc = $_POST["courseDes"];
    $c_code = $_POST["courseCode"];
//    $c_tag = $_POST["courseTags"];
    $t_email = $_COOKIE['email'];
    $resObj = new stdClass();

    $update_course = "UPDATE courses SET name = '$c_name', description = '$c_desc' where courseCode = '$c_code'";
    $res = mysqli_query($link, $update_course);

    header("Location: /updateCourseUI.php?course_id=$c_code");

}