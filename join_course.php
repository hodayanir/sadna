<?php
include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_email = $_COOKIE['email'];
    $t_email = $_POST["teacherEmail"];
    $courseCode = $_POST["courseCode"];
   
   
        if ($_COOKIE['user_type'] == "teachers" ) {
            
                echo"<script>
                if (window.confirm('You are logged in as a Teacher! Would you like to move to the login page?'))
                {
                  window.location.href = 'http://omerho-is.mtacloud.co.il/login.html';
                    
                }
                else
                {
                     window.history.back();


                }
                </script>";
          }  
        else {  
        if(empty($s_email)){
                echo"<script>
                if (window.confirm('You are not logged in! Would you like to move to the login page?'))
                {
                  window.location.href = 'http://omerho-is.mtacloud.co.il/login.html';
                    
                }
                else
                {
                     window.history.back();


                }
                </script>";
            }  
  
   
   else{

    $insert_course = "INSERT IGNORE INTO StudentInCourse (studentEmail, teacherEmail, courseCode) VALUES ('$s_email', '$t_email', '$courseCode');";
    $res = mysqli_query($link, $insert_course);

    header("Location: studentDashboard.php");
    
   }
}
}