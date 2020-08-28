<?php
include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_email = $_POST["email"];
    $u_pass = $_POST["password"];

    $sql_query="SELECT s1.email, s1.pass, s2.email, s2.pass FROM students AS s1 JOIN teachers AS s2 WHERE (s1.email='$u_email' AND s1.pass='$u_pass') OR (s2.email='$u_email' AND s2.pass='$u_pass')";
    $res=mysqli_query($link, $sql_query);
    if (mysqli_num_rows($res) > 0) {
        setcookie('first_name', $row[3]);
        header("Location: index.html");
    }
    else {
        header("Location: register_form.php");
    }

}
?>
