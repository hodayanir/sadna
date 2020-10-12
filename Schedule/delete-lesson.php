<?php

include "../mysqlConfig.php";

$date = $_GET['date'];
$time = $_GET['time'];
$teacher = $_GET['teacher'];
$student_email = $_COOKIE["email"];
$sfirstname = $_COOKIE["first_name"];


    $sql1 = "DELETE FROM schedule{$teacher} WHERE time = '$time' AND date = '$date' AND username = '$sfirstname'";
    $sql2 = "DELETE FROM privateLessons WHERE studentEmail = '{$student_email}'AND teacherEmail = '$teacher'  AND pLessonTime = '$time' AND pLessonDate = '{$date}'";

    
    
    mysqli_close($link);
?>