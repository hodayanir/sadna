<?php

// Connect to the database:
    session_start();
include "../mysqlConfig.php";
  


// Declare variables:
$user = $_COOKIE["first_name"];
$student_email = $_COOKIE["email"];
$date = $_GET['date'];
$time = $_GET['time'];
$teacher = $_GET['teacher'];
$duration = $_GET['duration'];
$lessontype = $_GET['lessontype'];


// Only run with valid input:
if ($user && $date && $time && $teacher){
    // Check if it doesn't conflict with other lessons scheduled later:
    $until = $time + $duration;
    $earliest = 100; // could be any high number
    $sql = "SELECT time FROM schedule{$teacher} WHERE date = '$date' AND time > $time AND time < $until";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($result)) 
    {
        if ($row['time'] < $earliest) $earliest = $row['time'];
    }
    if ($earliest != 100) echo "Lesson not available! There is another lesson at " . $earliest . ".";
    else if ($until > 23) echo "Lesson not available! Cannot set lessons for after 23:00";
    // Create lesson if it doesn't conflict:
    else
    {
        $sql3 = "insert into privateLessons (pLessonDate, pLessonTime, studentEmail, teacherEmail) values('$date', '$time', '$student_email', '$teacher');";
        $result3 = mysqli_query($link, $sql3);

        $sql1 = "INSERT INTO schedule{$teacher} (username, date, time, duration, lessontype, paid) VALUES ('$user', '$date', '$time', '$duration', '$lessontype', 0)";

        if (mysqli_query($link, $sql1)) {
            echo "A <b>{$lessontype}</b> lesson of <b>{$duration} hour";
            if ($duration > 1) echo "s";
            echo "</b><br> is now scheduled for <b>{$user} </b>with <b>{$teacher}</b><br>on <b>{$date}</b> at <b>{$time}:00</b> o'clock.";

            $sql2 = "SELECT email FROM teachers WHERE first_name = '$teacher'";
            $result = mysqli_query($link, $sql2);

            $email= mysqli_fetch_row($result);
            $to = $email[0];
            $subject = 'TMO | Lesson Request';
            $txt = 'Please access http://omerho-is.mtacloud.co.il/ to approve your new private lesson reqest!';
            $headers = 'From: tmo.s3345@gmail.com';

            $retval = mail($to,$subject,$txt,$headers);
            
            if( $retval == true ) {
            echo "<br><br>A confirmation email will be sent once the lesson will be approved by the teacher.";
            }else {
            echo "<br><br>Message could not be sent to {$teacher}.";
            }
        } 
        
        else {
            echo 'Error:<br>' . $sql . '<br>' . mysqli_error($link);
        }  
    }
}
else
{
    if (isset($_COOKIE["first_name"])){
    echo "Please select all required fields.";
    }
    else {
        echo  "Please login to the system.";
    }
    
}


mysqli_close($link);
?>