<?php
session_start();
if (isset($_SESSION['admin']))
{
  //session_destroy();
}
if (isset($_SESSION['username']))
{
  $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="index.css?version=<?php echo time()?>">
</head>
<body>
<nav></nav>
<main id="indexmain">
  <div id="loginwindow">
  <form class="confirmbuttonbox" action='schedule.php'>
  <?php
  if(isset($username) && $username != 'guest')
  {
    echo "<button class='confirmbutton'>Continue</button>
          <p>to re-enter as $username </p>
          <p>or log in as another user:</p>
          <hr>";
  }
  else
  {
    echo "<div class='confirmbutton' onclick='GuestLogin()'>Continue</div>
          <p>to enter as a guest </p>
          <p>or log in as another user:</p>
          <hr>";
  }
  ?>
  </form>
    <form id="logincontainer" name="logincontainer" action="\schedule.php" method="post">
      <label for="username" class="inp">
      <input id="username" name="username" type="text" placeholder="&nbsp;" autofocus>
      <span class="label">Username</span>
      <span class="border"></span>
      </label>
      <br>
      <label for="password" class="inp">
      <input id="password" name="password" type="password" placeholder="&nbsp;">
      <span class="label">Password</span>
      <span class="border"></span>
      </label>

      <div class="confirmbuttonbox">
        <button class="confirmbutton">Log in</button>
      </div>
    </form>
<p id="loginerror">
  <?php
  if(isset($_GET["user"])){
    if (!($_GET["user"])){
      echo "User does not exist!";
    }
    if ($_GET["user"] && (!($_GET["pw"]))){
      echo "Wrong password!";
    }
  }
  else{
        if (isset($_GET["userSet"])){
          echo "Appointment set for {$_GET['userSet']} on {$_GET['dateSet']} at {$_GET['timeSet']}:00 with {$_GET['teacherSet']}.";
        }
      }
    ?>
</p>
</div>

</main>
<footer></footer>
<script>
  function GuestLogin()
  {
    document.getElementById('username').value = 'guest';
    document.getElementById('password').value = '123';
    document.getElementById('logincontainer').submit();
  }

</script>
</body>
</html>
