<?php

$final;

getEarliestLesson('Eyal');
getEarliestLesson('Jenny');
getEarliestLesson('Mendel');

function getEarliestLesson($teacher){

    global $final;
    $now = time() + (3600 * 3);
    
        session_start();

    $conn_server = $_SESSION['CONNECTION_SERVER'];
    $conn_user = $_SESSION['CONNECTION_USER'];
    $conn_password = $_SESSION['CONNECTION_PASSWORD'];
    $database = $_SESSION['CONNECTION_DATABASE'];

    $conn = mysqli_connect($conn_server,$conn_user,$conn_password,$database);
    if (!$conn) {
        die('Could not connect: ' . mysqli_error($conn));
    }

    $user = $_GET['user'];
    $sql = "SELECT * FROM schedule{$teacher} WHERE username = '$user'";
    $result = mysqli_query($conn,$sql);

    for ($i = 0; ($row = mysqli_fetch_assoc($result)); $i++) {
        $dates[$i][0] = $row['date'];    // NEED TO DO STRTOTIME HERE AND WORK WITH UNIX FROM HERE
        $dates[$i][1] = $row['time'];
    }
    if (isset($dates)){
        for ($i = 0; (strtotime($dates[i][0]) + (3600 * $dates[i][1])) > $now; $i++){ // if first date is in the future
            $earliestDate[0] = strtotime($dates[0][0]); // first date in the list becomes the earliest
            $earliestDate[1] = $dates[0][1];            // set hour as well
            break;
        }
    foreach ($dates as $date){
        if (strtotime($date[0]) < $earliestDate[0]){ // if a date is earlier than the earliest, replace
            $earliestDate[0] = strtotime($date[0]);
            $earliestDate[1] = $date[1];

        }
        else if(strtotime($date[0]) == $earliestDate[0]){ // if a date is the same as the earliest, compare hours
            if ($date[1] < $earliestDate[1]){
                $earliestDate[0] = strtotime($date[0]);
                $earliestDate[1] = $date[1];
            }
        }
    }
    echo "earliest date: " . date('Y-m-d', $earliestDate[0]) . " earliest hour: $earliestDate[1] with $teacher <br>";
    $final[$teacher] = $earliestDate[0] + ($earliestDate[1] * 3600);
    }
    else{
        echo "You have no scheduled lessons.<br>";
    }
    mysqli_close($conn);
}
$final['Earliest'] = min($final['Eyal'],$final['Jenny'],$final['Mendel']);

if ($final['Earliest'] == $final['Eyal']) {$final['EarliestTeacher'] = 'Eyal';}
if ($final['Earliest'] == $final['Jenny']) {$final['EarliestTeacher'] = 'Jenny';}
if ($final['Earliest'] == $final['Mendel']) {$final['EarliestTeacher'] = 'Mendel';}

echo "Your next lesson is on "  . date('Y-m-d', $final['Earliest']) . " at " . date('H', $final['Earliest']) . ":00 with " . $final['EarliestTeacher'] . ".";
?>