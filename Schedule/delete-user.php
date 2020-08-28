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
    
    //Delete from database:
    $user = $_GET['user'];

    $sql = "DELETE FROM users WHERE username = '{$user}'";

    if ($user != 'Select a user')
    {
        if (mysqli_query($conn, $sql)) {
            echo "User ( $user ) deleted successfully!";
        } else {
            echo "Error: <br>" . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else
    {
        echo "Please enter a username.";
    }

    //Disconnect:
    mysqli_close($conn);
?>