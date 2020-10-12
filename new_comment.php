<?php
include "mysqlConfig.php";

$resObj = new stdClass();
# set variables #
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_COOKIE['first_name'];
    $last_name = $_REQUEST["last_name"];
    $email = $_COOKIE['email'];
    $comment = $_REQUEST["comment"];
    $date = date('Y-m-d H:i:s');
    $courseCode = $_GET["course_id"];

}
        if(empty($email)){
                echo"<script>
                if (window.confirm('You are not logged in to the system! Would you like to move to the login page?'))
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
        $sql_query2="SELECT photo FROM students WHERE email = '$email'";
        $res=mysqli_query($link, $sql_query2);
        $row = mysqli_fetch_assoc($res);       
        $photo = $row['photo'];
        
       $insert_query_review = "INSERT INTO Course_Reviews (photo,courseCode, comment, first_name,last_name, Date, email) VALUES ('$photo','$courseCode', '$comment', '$first_name', '$last_name', '$date', '$email');";
        $res = mysqli_query($link, $insert_query_review);
        if($res==TRUE){

            header("Location: course_details.php?course_id=$courseCode");
        }
         
        else{
            
        $sql_query3="SELECT photo FROM teachers WHERE email = '$email'";
        $res=mysqli_query($link, $sql_query3);
        $row = mysqli_fetch_assoc($res);       
        $photo = $row['photo'];
        if($res==TRUE){ 
             header("Location: course_details.php?course_id=$courseCode");
        }
        else {
            
            echo '<script>alert("Error: we couldn\'t add your comment")</script>';
        }
            
        }
        
}
        
        

?>
