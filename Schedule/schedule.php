<?php



session_start();

include "../mysqlConfig.php";
$username = $_COOKIE["first_name"];
?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="schedule.css?version=<?php echo time()?>">
    <script type="text/javascript">
        var user = "<?php echo $username ?>";
    </script>
</head>
<body>
<nav>
  <span>
  <a href="../studentDashboard.php" class="whitebutton">< Home</a>
  </span>
  <span id="navdate">DATE</span>
</nav>
<header id="header"><?php echo "$username"; ?></header> <!--ONLY FOR JS USER VAR-->
<main id="schedule">
  <div id="welcomewindow" class="bottom-gray-border">
    <div id="welcomecontainer">
      <span class="headline">Welcome <?php echo "{$username}!"; ?></span>
      <br>

    </div>
  </div>
  <div id="calendar" class="bottom-gray-border">
    <div id="calendarcontainer">
    <div id="monthnavbar" class="headline">
      <div class="monthbutton grayhover" onclick="UpdateMonth(-1); DateUpdate(1); ResetForm();"><</div>
      <div id="monthcaption">MONTH</div>
      <div id="yearcaption">YEAR</div>
      <div class="monthbutton grayhover" onclick="UpdateMonth(1); DateUpdate(1); ResetForm();">></div>
    </div>
  <div id="weekdaycaptions">
    <div>Sun</div>
    <div>Mon</div>
    <div>Tue</div>
    <div>Wed</div>
    <div>Thu</div>
    <div>Fri</div>
    <div>Sat</div>
  </div>
  <form class="monthsquare">
    <input type="hidden" name="hiddeninput" id="hiddeninput">
    <div id="dayfiller1"></div>
    <div id="dayfiller2"></div>
    <div id="dayfiller3"></div>
    <div id="dayfiller4"></div>
    <div id="dayfiller5"></div>
    <div id="dayfiller6"></div>
    <div class="daysquare grayhover" onclick="DateUpdate(1)" id="day1">1</div>
    <div class="daysquare grayhover" onclick="DateUpdate(2)" id="day2">2</div>
    <div class="daysquare grayhover" onclick="DateUpdate(3)" id="day3">3</div>
    <div class="daysquare grayhover" onclick="DateUpdate(4)" id="day4">4</div>
    <div class="daysquare grayhover" onclick="DateUpdate(5)" id="day5">5</div>
    <div class="daysquare grayhover" onclick="DateUpdate(6)" id="day6">6</div>
    <div class="daysquare grayhover" onclick="DateUpdate(7)" id="day7">7</div>
    <div class="daysquare grayhover" onclick="DateUpdate(8)" id="day8">8</div>
    <div class="daysquare grayhover" onclick="DateUpdate(9)" id="day9">9</div>
    <div class="daysquare grayhover" onclick="DateUpdate(10)" id="day10">10</div>
    <div class="daysquare grayhover" onclick="DateUpdate(11)" id="day11">11</div>
    <div class="daysquare grayhover" onclick="DateUpdate(12)" id="day12">12</div>
    <div class="daysquare grayhover" onclick="DateUpdate(13)" id="day13">13</div>
    <div class="daysquare grayhover" onclick="DateUpdate(14)" id="day14">14</div>
    <div class="daysquare grayhover" onclick="DateUpdate(15)" id="day15">15</div>
    <div class="daysquare grayhover" onclick="DateUpdate(16)" id="day16">16</div>
    <div class="daysquare grayhover" onclick="DateUpdate(17)" id="day17">17</div>
    <div class="daysquare grayhover" onclick="DateUpdate(18)" id="day18">18</div>
    <div class="daysquare grayhover" onclick="DateUpdate(19)" id="day19">19</div>
    <div class="daysquare grayhover" onclick="DateUpdate(20)" id="day20">20</div>
    <div class="daysquare grayhover" onclick="DateUpdate(21)" id="day21">21</div>
    <div class="daysquare grayhover" onclick="DateUpdate(22)" id="day22">22</div>
    <div class="daysquare grayhover" onclick="DateUpdate(23)" id="day23">23</div>
    <div class="daysquare grayhover" onclick="DateUpdate(24)" id="day24">24</div>
    <div class="daysquare grayhover" onclick="DateUpdate(25)" id="day25">25</div>
    <div class="daysquare grayhover" onclick="DateUpdate(26)" id="day26">26</div>
    <div class="daysquare grayhover" onclick="DateUpdate(27)" id="day27">27</div>
    <div class="daysquare grayhover" onclick="DateUpdate(28)" id="day28">28</div>
    <div class="daysquare grayhover" onclick="DateUpdate(29)" id="day29">29</div>
    <div class="daysquare grayhover" onclick="DateUpdate(30)" id="day30">30</div>
    <div class="daysquare grayhover" onclick="DateUpdate(31)" id="day31">31</div>
  </form>
    </div>
  </div>
  <form id="confirmbox">
    <p id="confirmtitle">You have selected:</p>
    <div id="confirmdetails">
      <div id="confirmcontainer">
        <div id="confirmcaptions">
          <p>Student:</p>
          <p>Teacher:</p>
          <p>Date:</p>
          <p>Time:</p>
          <p>Duration:</p>
          <?php
            if($admin){echo "<p>Lesson type:</p>";}
          ?>
        </div>
        <div id="confirmdata">
          <p id="confirmFieldUser">
          <?php
            
            if (isset($_COOKIE["first_name"])){
            echo $username;
            }
            else {
            echo  "Guest";
            }
                
                
          ?>
          <span id="confirmFieldUserGroup"></span>
          </p>
          <p id="confirmFieldTeacher">.</p>
          <p id="confirmFieldDate">.</p>
          <p id="confirmFieldTime">.</p>
          <p id="confirmFieldDuration">
            <select id="durationpost">
              <option value="1" selected>1 hour</option>
              <option value="2">2 hours</option>
              <option value="3">3 hours</option>
              <option value="4">4 hours</option>
              <option value="5">5 hours</option>
              <option value="6">6 hours</option>
            </select>
          </p>
          <?php
            if($admin){
              echo '<p id="confirmFieldLessonType"></p>
                    <select id="AdminLessonTypeSelectBox" onchange="AdminSetLessonType()">
                    <option value="Private" selected>Private</option>
                    <option value="Group">Group</option>
                    </select>';
            }
          ?>
        </div>
      </div>
    </div>
    <div id="confirmbuttonbox">
      <input type="hidden" value="" name="userpost" id="userpost">
      <input type="hidden" value="" name="datepost" id="datepost">
      <input type="hidden" value="" name="timepost" id="timepost">
      <input type="hidden" value="" name="teacherpost" id="teacherpost">
      <input type="hidden" value="Private" name="lessontypepost" id="lessontypepost">
      <div id="confirmbutton" class="confirmbutton redfont"  onclick="SetAppointmentAJAX()" disabled>Confirm</div>
    </div>
  </form>
    <div id="dayschedule" class="left-border">
  <div id="datecaption" class="headline bottom-gray-border">date</div>
  <div id="selectorsbar" class="bottom-gray-border">
    <div id="teacherselect" class="selectors">
      Teacher: <br class="teacherlinebreak"><br class="teacherlinebreak">
<?php
      $sql = "SELECT first_name FROM teachers";
              $result = mysqli_query($link, $sql);
              while($row = $result->fetch_assoc())
              {
                echo "<span id='teacher$row[first_name]' name='teacher' value='$row[first_name]' onclick=TeacherSelect('$row[first_name]') class='somebutton redfont redhover redselected'> $row[first_name]</span>";


              }
              
?>      
    </div>
    <div id="viewselect" class="selectors">
      View Mode:
      <span id="viewdaily" type="radio" name="viewmode" onclick="ViewMode('Daily')" class="somebutton redfont redhover">Daily</span>
      <span id="viewweekly" type="radio" name="viewmode" onclick="ViewMode('Weekly')" class="somebutton redfont redhover">Weekly</span>
    </div>
  </div>
  <div id="timetable" class="timetable-day">
    <div id="daysbar" class="bottom-gray-border">
      <span class="left-border">Sun</span>
      <span id="daycap0">0</span>
      <span class="left-border">Mon</span>
      <span id="daycap1">0</span>
      <span class="left-border">Tue</span>
      <span id="daycap2">0</span>
      <span class="left-border">Wed</span>
      <span id="daycap3">0</span>
      <span class="left-border">Thu</span>
      <span id="daycap4">0</span>
      <span class="left-border">Fri</span>
      <span id="daycap5">0</span>
      <span class="left-border">Sat</span>
      <span id="daycap6">0</span>
    </div>
    <div id="timebar" class="timebar">
      <p>06:00</p>
      <p>07:00</p>
      <p>08:00</p>
      <p>09:00</p>
      <p>10:00</p>
      <p>11:00</p>
      <p>12:00</p>
      <p>13:00</p>
      <p>14:00</p>
      <p>15:00</p>
      <p>16:00</p>
      <p>17:00</p>
      <p>18:00</p>
      <p>19:00</p>
      <p>20:00</p>
      <p>21:00</p>
      <p>22:00</p>
    </div>
  </div>
    </div>
</main>
  <footer></footer>

<div id="alertbox" class="boxshadow alertbox">
    <div id="alertcontainer" class="alertcontainer">
      <p id="alerttext"></p>
      <?php
            if($admin){
              echo '
                    <div id="AdminGroupCheckboxes">
                    ';
              //Fill the checkbox list with students:
              $sql = "SELECT username FROM users";
              $result = mysqli_query($link, $sql);
              while($row = mysqli_fetch_assoc($result))
              {
                echo '<input type="checkbox" onclick="EnableAlertButton()" value=' . $row['username'] . '>' . $row['username'] . '</input>';
              }
              echo '</div>';
            }
          ?>
      <div id="alertbutton" class="somebutton alertbutton">Ok</div>
    </div>
  </div>
<div id="alertboxdimmer"></div>
<div id="alertboxdelete" class="boxshadow alertbox">
  <div id="abd-container" class="alertcontainer">
    <p id="abd-text"></p>
    <div id="yesnobox">
      <span id="abd-button-yes" class="somebutton alertbutton redhover">Yes</span>
      <span id="abd-button-no" class="somebutton alertbutton redhover" onclick="CloseABD()">No</span>
    </div>
    <div id="abd-button-ok" class="somebutton alertbutton redhover" onclick="CloseABD()">Ok</div>
  </div>
</div>

<div id="loading" class="lds-default"><div></div><div></div><div>
</div><div></div><div></div><div></div><div></div><div>
</div><div></div><div></div><div></div><div></div></div>

<script src="schedule.js?version=<?php echo time()?>"></script>
</body>
</html>
