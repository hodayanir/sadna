<?php
session_start();
$conn_server = $_SESSION['CONNECTION_SERVER'];
$conn_user = $_SESSION['CONNECTION_USER'];
$conn_password = $_SESSION['CONNECTION_PASSWORD'];
$database = $_SESSION['CONNECTION_DATABASE'];

$conn = mysqli_connect($conn_server,$conn_user,$conn_password,$database);
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
// SELECT * FROM `schedule` WHERE `date` = '2018-09-27'

$teacher = $_GET['teacher'];

$sql = "SELECT * FROM schedule{$teacher} WHERE date = " . "'{$_GET['date']}'";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)) {
    echo "{$row['username']}#{$row['duration']}~{$row['time']}&";
}
mysqli_close($conn);
?>
