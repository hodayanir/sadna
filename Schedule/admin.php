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
?>

<html>

<head>
<link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="admin.css?version=<?php echo time()?>">
</head>

<body>

<div id="backbutton" class="somebutton blackhover" onclick="BackButton()"> < Back</div>

<!------- CREATE USER ------->

<div id="createuserdiv" class="boxshadow">
    <div id="createusercontainer" class="container">
<h3>Create a new user:</h3>

Username: <input type="text" name="user" id="acuUser"> <br>
Password: <input type="text" name="password" id="acuPassword"> <br>
Email address: <input type="email" name="email" id="acuEmail"> <br>
Phone number: <input type="text" name="phone" id="acuPhone"> <br>

<div class="somebutton blackhover" onclick="AdminCreateUser()">Create</div>

<p id="CreateUserResult"></p>
</div>
</div>

<!------- DELETE USER ------->

<div id="deleteuserdiv" class="boxshadow">
    <div id="deleteusercontainer" class="container">
<h4>Delete a user:</h4>
<?php
              echo '<select id="DeleteUserSelectBox">
                      <option disabled selected>Select a user</option>';
              //Fill the option list with students:
              $sql = "SELECT username FROM users";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)) {
                  echo '<option id="DeleteUser' . $row['username'] . '">' . $row['username'] . '</option>'; 
                }
              echo '</select>';
          ?>
<div class="somebutton blackhover" onclick="AdminDeleteUser()">Delete</div>
<p id="DeleteUserResult"></p>
</div>
</div>

<!------- DISPLAY USER STATS ------->

<div id="statsdiv" class="boxshadow">
  <div id="statscontainer" class="container">
    <h3>Display user statistics:</h3>
    Username: 
    <?php
              echo '<select id="StatsUserSelectBox" onchange="DisplayUserStats()">
                      <option disabled selected>Select a user</option>';
              //Fill the option list with students:
              $sql = "SELECT username FROM users";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)) {
                  echo '<option id="StatsUser' . $row['username'] . '">' . $row['username'] . '</option>'; 
                }
              echo '</select>';
          ?>
    Select Year:
    <input type="number" id="StatsYear" min="2018" onchange="DisplayUserStats()">
    Select Month:
    <input type="number" id="StatsMonth" min="1" max="12" onchange="DisplayUserStats()">
    <hr>
    No. of Private lessons:
    <span id="PrivateLessonCount" class="tooltip">.</span>
    No. of Group lessons:
    <span id="GroupLessonCount" class="tooltip">.</span>
    Total No. of lessons:
    <span id="TotalLessonCount" class="tooltip">.</span>

  </div>
</div>
<script src="admin.js?version=<?php echo time()?>"></script>
</body>