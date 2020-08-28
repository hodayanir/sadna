<?php
/*
    //Check if admin:
    session_start();
    if(!(isset($_SESSION['admin']))){
        header('Location: index.php');
    }
*/  
    //Connect to the database:
    session_start();
    $conn_server = $_SESSION['CONNECTION_SERVER'];
    $conn_user = $_SESSION['CONNECTION_USER'];
    $conn_password = $_SESSION['CONNECTION_PASSWORD'];
    $database = $_SESSION['CONNECTION_DATABASE'];

    $conn = mysqli_connect($conn_server,$conn_user,$conn_password,$database);
    if (!$conn) {die('Could not connect: ' . mysqli_error($conn));}
    
    //Delete from database:
    $student = $_GET['student'];
    $time = $_GET['time'];
    $date = $_GET['date'];
    $teacher = $_GET['teacher'];

    $sql = "DELETE FROM schedule{$teacher} WHERE username = '{$student}' AND time = $time AND date = '{$date}'";
    
    if (mysqli_query($conn, $sql)) echo "Lesson deleted successfully!";
    
    else echo "Error:<br>" . $sql . "<br>" . mysqli_error($conn);
   
    //Disconnect:
    mysqli_close($conn);
?>