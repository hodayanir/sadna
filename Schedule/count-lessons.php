<?php

    //Check if admin:
    session_start();

  
    include "mysqlConfig.php";
    
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

        global $link, $user, $year, $month;

        $sql = "SELECT * FROM `schedule{$teacher}` WHERE username LIKE '%{$user}%' AND date LIKE '%{$year}-{$month}-%'";

        if ($user != 'Select a user')
        {
            if ($result = mysqli_query($link, $sql)) //If query was successful
            {
                
                while($row = mysqli_fetch_assoc($result))
                {
                if ($row['lessontype'] == 'Private') $PrivateCounter++;
                if ($row['lessontype'] == 'Group') $GroupCounter++;
                }
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
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
    mysqli_close($link);
?>