<?php


include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $l_title = $_POST["LessonTitle"];
    $l_code = $_POST["lessonCode"];
    $l_link = $_POST["LessonLink"];
    $l_length = $_POST["LessonLength"];
    $c_id = $_POST["courseCode"];
    $resObj = new stdClass();

    $update_lesson = "UPDATE lessons SET lessonName = '$l_title', lessonLink = '$l_link', lessonLength = '$l_length' where lessonCode = '$l_code'";
    $res = mysqli_query($link, $update_lesson);

    header("Location: updateCourseUI.php?course_id=$c_id");
}