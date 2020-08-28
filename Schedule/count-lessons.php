<?php

//Check if admin:
session_start();
if(!(isset($_SESSION['admin']))){
    header('Location: index.php');
}

//Connect to the database:
$conn_server = $_SESSION['CONNECTION_SERVER'];
$conn_user = $_SESSION['CONNECTION_USER'];
$conn_password = $_SESSION['CONNECTION_PASSWORD'];
$database = $_SESSION['CONNECTION_DATABASE'];
$conn = mysqli_connect($conn_server,$conn_user,$conn_password,$database);
if (!$conn) {die('Could not connect: ' . mysqli_error($conn));}

//Get data from database:
$user = $_GET['user'];
$year = $_GET['year'];
$month = $_GET['month'];
//Count lessons:
function CountLessons($teacher)
{
    //Set counters:
    $PrivateCounter = 0;
    $GroupCounter = 0;
    global $conn, $user, $year, $month;
    $sql = "SELECT * FROM `schedule{$teacher}` WHERE username LIKE '%{$user}%' AND date LIKE '%{$year}-{$month}-%'";
    if ($user != 'Select a user')
    {
        if ($result = mysqli_query($conn, $sql)) //If query was successful
        {
            
            while($row = mysqli_fetch_assoc($result))
            {
            if ($row['lessontype'] == 'Private') $PrivateCounter++;
            if ($row['lessontype'] == 'Group') $GroupCounter++;
            }
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else
    {
        echo "Error: Please select a user.";
    }
    //Send results:
    echo $PrivateCounter . "," . $GroupCounter . "&";
}
CountLessons('eyal');
CountLessons('jenny');
CountLessons('mendel');

//Disconnect:
mysqli_close($conn);
?>