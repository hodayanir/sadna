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
    
    //Insert to database:
    $user = $_GET['user'];
    $password = $_GET['password'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];

    $sql = "INSERT INTO users (username, password, email, phone) VALUES ('$user', '$password', '$email', '$phone')";

    if ($user && $password)
    {
        if (mysqli_query($conn, $sql)) {
            echo "User ( $user ) with password ( $password ) created successfully!
                  Email: $email . Phone: $phone .";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else
    {
        echo "Error: Please enter a username and a password.";
    }

    //Disconnect:
    mysqli_close($conn);
?>