<?php
include "mysqlConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $c_id = $_POST["courseCode"];
    $resObj = new stdClass();
    
    $sql1="SELECT email FROM StayUpdated WHERE email=$email;";
     
     $res = mysqli_query($link, $sql1);
      
    if ($res->num_rows == 0){
    $insert_email = "INSERT INTO StayUpdated (email) VALUES ('$email');";
    $res = mysqli_query($link, $insert_email);
    
    
    
            $to =  $_POST["email"];
            $subject = 'Welcome to TMO';
            $txt = 'Your subscription has been confirmed! You\'ve been added to our list and will hear from us soon.';
            $headers = 'From: tmo.s3345@gmail.com';

            $retval = mail($to,$subject,$txt,$headers);
            
            if( $retval == true ) {
                
                echo"<script>
                if (window.confirm('Conformation email was sent sucessfuly!'))
                {
                  window.location.href = 'Location: course_details.php?course_id=$c_id';
                    
                }
                else
                {
                     window.location.href = 'Location: course_details.php?course_id=$c_id';

                }
                </script>";
                
            }
        else {
            echo "<br><br>Message could not be sent.";
            }
        
        
    }
    else {
        
        echo"<script>
                if (window.confirm('YAY! You are already in the list!'))
                {
                  window.location.href = 'Location: course_details.php?course_id=$c_id';
                    
                }
                else
                {
                     window.location.href = 'Location: course_details.php?course_id=$c_id';

                }
                </script>";
        
        
    }
    

} 
        
        

    
    


?>