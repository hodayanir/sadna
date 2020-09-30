<?php

// Connect to the database:
    session_start();
    $conn_server = $_SESSION['CONNECTION_SERVER'];
    $conn_user = $_SESSION['CONNECTION_USER'];
    $conn_password = $_SESSION['CONNECTION_PASSWORD'];
    $database = $_SESSION['CONNECTION_DATABASE'];

$conn = mysqli_connect($conn_server,$conn_user,$conn_password,$database);
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

// Declare variables:
$user = $_GET['user'];
$date = $_GET['date'];
$time = $_GET['time'];
$teacher = $_GET['teacher'];
$duration = $_GET['duration'];
$lessontype = $_GET['lessontype'];

// Only run with valid input:
if ($user && $date && $time && $teacher)
{
    // Check if it doesn't conflict with other lessons scheduled later:
    $until = $time + $duration;
    $earliest = 100; // could be any high number
    $sql = "SELECT time FROM schedule{$teacher} WHERE date = '$date' AND time > $time AND time < $until";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) 
    {
        if ($row['time'] < $earliest) $earliest = $row['time'];
    }
    if ($earliest != 100) echo "Lesson not available! There is another lesson at " . $earliest . ".";
    else if ($until > 23) echo "Lesson not available! Cannot set lessons for after 23:00";
    // Create lesson if it doesn't conflict:
    else
    {
        $sql = "INSERT INTO schedule{$teacher} (username, date, time, duration, lessontype, paid) VALUES ('$user', '$date', '$time', '$duration', '$lessontype', 0)";

        if (mysqli_query($conn, $sql)) {
            echo "A <b>{$lessontype}</b> lesson of <b>{$duration} hour";
            if ($duration > 1) echo "s";
            echo "</b><br> is now scheduled for <b>{$user} </b>with <b>{$teacher}</b><br>on <b>{$date}</b> at <b>{$time}:00</b> o'clock.";
        } else {
            echo "Error:<br>" . $sql . "<br>" . mysqli_error($conn);
        }  
    }
}
else
{
    echo "Please select all required fields.";
}


mysqli_close($conn);
?>