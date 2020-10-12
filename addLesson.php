<?php
include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $l_id = $_POST["LessonId"];
    $l_title = $_POST["LessonTitle"];
    $l_link = $_POST["LessonLink"];
    $l_length = $_POST["LessonLength"];
    $c_id = $_POST["CourseId"];
    $resObj = new stdClass();

    $insert_course = "INSERT INTO lessons (courseCode, lessonName, lessonNum, lessonLength, lessonLink) VALUES ($c_id, '$l_title', 19, '$l_length', '$l_link');";
    $res = mysqli_query($link, $insert_course);

    header("Location: updateCourseUI.php?course_id=$c_id");

}