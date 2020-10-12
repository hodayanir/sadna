/* --------------- VARIABLES --------------- */

var SelectedDaySquare;
var TodayDaySquare;
var GroupSelectionMode = 0;
var CurrentViewMode;
var SelectedTeacher;
var DateISO;
var element;
var DATE = new Date();
var SelectedDate = new Date();
var SelectedDateISO = new Date();
var month = DATE.getMonth();
var year = DATE.getFullYear();

months = new Array();
months[0] = "January";
months[1] = "February";
months[2] = "March";
months[3] = "April";
months[4] = "May";
months[5] = "June";
months[6] = "July";
months[7] = "August";
months[8] = "September";
months[9] = "October";
months[10] = "November";
months[11] = "December";


/* ORIENTATION LISTENER AND STARTUP FUNCTION */


var mql = window.matchMedia("(orientation: portrait)");
if(mql.matches)
 {  
  //startup on portrait mode
  FixDates();
  CorrectFirstDay(DATE);
  SelectedTeacher = 'Eyal';

  SwitchToDaily();

  DateCapFunc();
  TodaySquare();
} else
 {  
  //startup on landscape mode
  FixDates();
  CorrectFirstDay(DATE);
  SelectedTeacher = 'Eyal';

  SwitchToWeekly();

  DateCapFunc();
  TodaySquare();
}
mql.addListener(function(m) { // on changing view
	if(m.matches) {
    SwitchToDaily();
	}
	else {
    SwitchToWeekly();
	}
});


/* ----------- Major Functions: ------------ */


function ShowTheWhat(){
  DateISO = MakeDateISO(SelectedDate);
  if (CurrentViewMode == 'Daily')
  {
    ShowTheDay(DateISO,SelectedTeacher,0);
  }
  if (CurrentViewMode == 'Weekly')
  {
    var day = GetFirstDayOfWeek(SelectedDate); // week of selected date begins on this day(1-31)
    var NewSelectedDate = new Date(SelectedDate);
    NewSelectedDate.setDate(day); // Date obj on the first day of the week
    var FirstWeekDayISO = MakeDateISO(NewSelectedDate) // Date ISO of the first day of the week
    var e;
    for(i=0;i<7;i++){
      //Set caption:
      e = document.getElementById('daycap'+i);
      e.innerHTML = NewSelectedDate.getDate();
      day++;
      //Populate column:
      ShowTheDay(FirstWeekDayISO,SelectedTeacher,i);
      NewSelectedDate.setDate(NewSelectedDate.getDate() + 1);
      FirstWeekDayISO = MakeDateISO(NewSelectedDate);
    }
  }
}


function ShowTheDay(date,teacher,dayofweek) {
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() 
  {
    Show('loading');
    //for (var i = 6; i <= 22.5; i+=0.5) MakeLoading(i,dayofweek);
    if (this.readyState == 4 && this.status == 200) 
    {
      Hide('loading');
      // Make response hold the response text from showtheday.php:
      var response = this.responseText;
      // Make this day an array of all lessons on the day. Each lesson is defined by student/s, time and duration:
      thisday = response.split("&");
      // Make all lessons visible and remove any previous grid properties:
      for (var i = 6; i <= 22.5; i+=0.5) ResetLesson(i,dayofweek);
      /*To determine if past or future:*/
      var dateobj = new Date(date);
      if (dateobj < DATE)
      {
        for (var i = 6; i <= 22.5; i+=0.5) MakePast(i,dayofweek);
      }
      else
      {
        for (var i = 6; i <= 22.5; i+=0.5) MakeAvailable(i,dayofweek);
      }
      for (i = 0; i < (thisday.length - 1); i++)
      {
        // Seperate between the student and the lesson's time:
        thisday[i] = thisday[i].split("~");
        // Seperate between the student and the duration of the lesson:
        thisday[i][0] = thisday[i][0].split("#");
        // Simplify with variables:
        var startingtime = thisday[i][1];
        var studentname = thisday[i][0][0];
        var duration = thisday[i][0][1];
        // Declare variable for lesson element:
        var LessonElement = document.getElementById("apt" + startingtime + "-" + dayofweek);
        // Display student's name as text:
        LessonElement.innerHTML = studentname;
        // Add an X button for deletion:
        LessonElement.classList.add('tooltip');
        var xbutton = document.createElement("div");
        xbutton.classList.add('tooltiptext');
        xbutton.innerHTML = "Delete";
        LessonElement.appendChild(xbutton);
        // Attach click event:
        xbutton.setAttribute("onclick",'DeleteLessonAsk(' + startingtime + ',' + dayofweek + ',' + duration + ',' + "'"+studentname+"'" + ')');
        // Make the element take up more space if it's duration is greater than 1 hour:
        if (duration > 0.5)
        {
          var j;
          for (j = 0.5; j < duration; j+=0.5)
          {
            var extrahour = ( (startingtime)*1 + j ); // <-- the *1 forces conversion from string to int for the addition
            Hide("apt" + extrahour + "-" + dayofweek);
            /*
            document.getElementById("apt" + extrahour + "-" + dayofweek).innerHTML = thisday[i][0][0];
            MakeUnavailable(extrahour,dayofweek);
            */
          }
          /*
          8 = 5 to 7
          11 = 11 to 13
          */
          //LessonElement.style.backgroundColor = "lightgreen";
          var gridstart, gridend;
          if (startingtime%1)
          {
            LessonElement.style.gridRowStart = (startingtime - 5)*2 -1;
            LessonElement.style.gridRowEnd = (startingtime - 5 + j)*2 -1;
          }
          else
          {
            LessonElement.style.gridRowStart = (startingtime - 5)*2 - 1;
            LessonElement.style.gridRowEnd = (startingtime - 5 + j)*2 - 1;
          }
        }
        // Make element unclickable and style it as unavailable:
        MakeUnavailable(startingtime,dayofweek);
      }
    }
  };
  xmlhttp.open("GET","showtheday.php?date="+date+"&teacher="+teacher,true);
  xmlhttp.send();
}


function SwitchToWeekly()
{
  /*VARS*/
  CurrentViewMode = "Weekly";
  ViewActiveButton('weekly');
  /*STYLE*/
  ShowForGridItems("daysbar");
  var s = document.getElementById("timetable");
  s.classList.remove("timetable-day"); // for correct num of columns
  s.classList.add("timetable-week");
  /*CLEAR 1 (DAILY) COLUMN */
  if (document.getElementById('appointments0')){
    var day = document.getElementById('appointments0');
    day.parentNode.removeChild(day);
  }
  /*CREATE 7 COLUMNS */
  var timetable = document.getElementById("timetable");
  for(let i=0;i<7;i++)
  {
    var day = document.createElement("div");
    day.classList.add('appointments');
    day.setAttribute("id","appointments" + i);
    timetable.appendChild(day);
    day.classList.add('left-border');
    for (let j=6;j<23;j = j + 0.5)
    {
      var para = document.createElement("p");
      //var node = document.createTextNode("apt");
      para.classList.add('appointment-line');
      //para.classList.add('greenhover');
      if (j%1) para.classList.add('bottom-gray-border');
      else para.classList.add('bottom-light-border');
      para.setAttribute('id','apt' + j + '-' + i);
      //para.appendChild(node);
      day.appendChild(para);
    }
  }
  /*POPULATE TABLE*/
  ShowTheWhat();
  SetDateCaption();
}


function SwitchToDaily()
{
  /*VARS*/
  CurrentViewMode = "Daily";
  ViewActiveButton('daily');
  /*STYLE*/
  Hide("daysbar");
  var s = document.getElementById("timetable");
  s.classList.remove("timetable-week"); // for correct num of columns
  s.classList.add("timetable-day");
  /*REMOVE 7 COLUMNS*/
  if (document.getElementById('appointments1')){ //only remove if existed
    for(i=0;i<7;i++)
    {
      var day = document.getElementById('appointments'+i);
      day.parentNode.removeChild(day);
    }
  }
  else if (document.getElementById('appointments0'))
  {
    var day = document.getElementById('appointments0');
    day.parentNode.removeChild(day);
  }
  /*CREATE 1 COLUMN*/
  var day = document.createElement("div");
  day.classList.add('appointments');
  day.classList.add('left-border'); ; // left border
  day.setAttribute("id","appointments0");
  timetable.appendChild(day);
  for (let j=6;j<23;j+=0.5)
  {
    var para = document.createElement("p");
    //var node = document.createTextNode("apt");
    para.classList.add('appointment-line');
    para.classList.add('greenhover');
    if (j%1) para.classList.add('bottom-gray-border');
    else para.classList.add('bottom-light-border');
    para.setAttribute('id','apt' + j + '-0');
    //para.appendChild(node);
    day.appendChild(para);
  }
  ShowTheWhat();
  SetDateCaption();
}


/* ----------------------------------------- */


function DateCapFunc(){
  // (Startup-only function)
  document.getElementById("datecaption").innerHTML = DATE.toDateString();
  document.getElementById("monthcaption").innerHTML = months[month];
  document.getElementById("yearcaption").innerHTML = year;
  document.getElementById("navdate").innerHTML = DATE.toDateString();
}

function DateUpdate(day) // for daysquares and for lesson buttons on weekly mode
{ 
  SelectedDate.setDate(day);
  SetDateCaption();
  SelectedSquare();
  ShowTheWhat();
}

function DateUpdateLight(day)
{
  SelectedDate.setDay(day);
  SetDateCaption();
  SelectedSquare();
}

function SetDateCaption()
{
  if(CurrentViewMode == 'Daily') {document.getElementById("datecaption").innerHTML = SelectedDate.toDateString();}
  else if(CurrentViewMode == 'Weekly')
  {
    var displaydate = new Date(SelectedDate);
    displaydate.setDate(GetFirstDayOfWeek(SelectedDate));
    var first = displaydate.toDateString();
    displaydate.setTime(SelectedDate.getTime()); // reset for correct month
    displaydate.setDate(GetLastDayOfWeek(SelectedDate));
    var last = displaydate.toDateString();
    document.getElementById("datecaption").innerHTML = first + " - " + last;
  }
}

function UpdateMonth(m){  // for month navigation (Also updates year)
  if (m==1) SelectedDate.setMonth(SelectedDate.getMonth() +1);
  else if (m==-1) SelectedDate.setMonth(SelectedDate.getMonth() -1);
  document.getElementById("monthcaption").innerHTML = months[SelectedDate.getMonth()];
  document.getElementById("yearcaption").innerHTML = SelectedDate.getFullYear();
  CorrectFirstDay(SelectedDate);
  TodaySquare();
}

function TimeUpdate(time){
  SelectedDate.setHours(time);
  DateISO = MakeDateISO(SelectedDate);
  EnableButton("confirmbutton");
  // Get hour to appear right:
  var cft = document.getElementById("confirmFieldTime");
  cft.innerHTML = HourToString(time);
  // Fill visible fields:
  document.getElementById("confirmFieldDate").innerHTML = SelectedDate.toDateString();
  document.getElementById("confirmFieldTeacher").innerHTML = SelectedTeacher;
  // Fill hidden form fields:
  document.getElementById("datepost").setAttribute("value", DateISO);
  document.getElementById("timepost").setAttribute("value", time);
  document.getElementById("teacherpost").setAttribute("value", SelectedTeacher);
  // User field should not be modified when admin is logged in:
  if (user != 'eyal' && user != 'michal'){
    document.getElementById("confirmFieldUser").innerHTML = user;
    document.getElementById("userpost").setAttribute("value", user);
  }
}

function MakePast(n,dayofweek){
  var e = document.getElementById("apt" + n + "-" + dayofweek);
  e.classList.remove("Loading","Unavailable","Available","greenhover");
  e.classList.add("Past");
  e.innerHTML = "";
  // Remove all event listeners:
  var clone = e.cloneNode(true);
  e.parentNode.replaceChild(clone, e);
}
/*
function MakeLoading(n,dayofweek){
  var e = document.getElementById("apt" + n + "-" + dayofweek);
  e.classList.remove("Past","Available","Unavailable","greenhover");
  e.classList.add("Loading");
  e.innerHTML = "Please wait...";
  // Remove all event listeners:
  var clone = e.cloneNode(true);
  e.parentNode.replaceChild(clone, e);
}
*/
function MakeUnavailable(n,dayofweek){
  var e = document.getElementById("apt" + n + "-" + dayofweek);
  e.classList.remove("Past","Loading","Available","greenhover");
  e.classList.add("Unavailable");
  // Remove all event listeners:
  var clone = e.cloneNode(true);
  e.parentNode.replaceChild(clone, e);
}
function MakeAvailable(n,dayofweek){
  var e = document.getElementById("apt" + n + "-" + dayofweek);
  e.classList.remove("Past","Loading","Unavailable");
  e.classList.add("Available");
  
  var span = document.createElement('span');
  e.appendChild(span);
  span.innerHTML = HourToString(n);
  span.classList.add('greenhover');

  // Add Listeners:
  if (CurrentViewMode == "Weekly")  // only update day on weekly view
  {
    e.addEventListener("click",function ListenerDate() {DateUpdateLight(dayofweek);});
  }
  e.addEventListener("click",function ListenerTime() {TimeUpdate(n);});
}
function ResetLesson(n,dayofweek){
  var e = document.getElementById("apt" + n + "-" + dayofweek);
  e.style.display = "flex";
  e.style.removeProperty('grid-row');
  e.removeAttribute('onmouseover');
  e.classList.remove('tooltip');
  e.innerHTML = null;
}

/* ----------- Minor Functions: ------------ */

function AdminSetUser(){
  var selectBox = document.getElementById("AdminUserSelectBox");
  var student = selectBox.options[selectBox.selectedIndex].value;
  document.getElementById("userpost").setAttribute("value", student);
}
function ViewMode(viewtype){ // only for view select buttons
  if (viewtype == "Weekly" && CurrentViewMode == "Daily") {SwitchToWeekly();}
  if (viewtype == "Daily" && CurrentViewMode == "Weekly") {SwitchToDaily();}
}
function TeacherSelect(teacher){
  SelectedTeacher = teacher;
  TeacherActiveButton(teacher);
  ResetForm();
  ShowTheWhat();
}
function ResetForm(){
  DisableButton("confirmbutton");
  //erase visible fields:
  document.getElementById("confirmFieldTime").innerHTML = ".";
  document.getElementById("confirmFieldDate").innerHTML = ".";
  document.getElementById("confirmFieldTeacher").innerHTML = ".";
  document.getElementById("confirmbox").reset();
  // User field should not be modified when admin is logged in:
  if (user != 'eyal' && user != 'michal'){
    document.getElementById("confirmFieldUser").innerHTML = ".";
  }
  //erase invisible fields:
  document.getElementById("userpost").value = null;
  document.getElementById("timepost").value = null;
  document.getElementById("datepost").value = null;
  document.getElementById("teacherpost").value = null;
  document.getElementById("confirmbox").reset();
  //Show private lesson controls:
  if (document.getElementById('AdminUserSelectBox')) Show('AdminUserSelectBox');
  if (CFUG = document.getElementById('confirmFieldUserGroup')) CFUG.innerHTML = "";
}
function FixDates(){
  //DATE.setHours(6);
  SelectedDate.setHours(6);
  SelectedDateISO.setHours(6);
}
function MakeDateISO(date){
  // SelectedDateISO.setDate(SelectedDateISO.getDate() + 1);
  DateISO = date.toISOString();
  DateISO = DateISO.split("T");
  DateISO = DateISO[0];
  return DateISO;
}
function TeacherActiveButton(teacher){
  var container = document.getElementById("teacherselect");
  var elements = container.getElementsByTagName('span');
  for (k=0;k<elements.length;k++) {elements[k].classList.remove('redselected');}
  document.getElementById("teacher"+teacher).classList.add('redselected');
}
function ViewActiveButton(viewtype){
  var container = document.getElementById("viewselect");
  var elements = container.getElementsByTagName('span');
  for (k=0;k<elements.length;k++) {elements[k].classList.remove('redselected');}
  document.getElementById("view"+viewtype).classList.add('redselected');  
}
function EnableButton(buttonID){
  var b = document.getElementById(buttonID);
  b.removeAttribute("disabled");
  b.classList.add("redhover");
}
function DisableButton(buttonID){
  var b = document.getElementById(buttonID);
  b.setAttribute("disabled",true);
  b.classList.remove("redhover");
}
Date.prototype.setDay = function(dayOfWeek) {
  this.setDate(this.getDate() - this.getDay() + dayOfWeek);
};
function Hide(e){
  e = document.getElementById(e);
  e.style.display = "none";
}
function Show(e){
  e = document.getElementById(e);
  e.style.display = "initial";
}
function ShowForGridItems(e){
  e = document.getElementById(e);
  e.style.display = "grid";
}
function GetFirstDayOfWeek(date){
  var dayofmonth = date.getDate();
  var dayofweek = date.getDay();
  var firstdayofweek = dayofmonth - dayofweek;
  return firstdayofweek;
}
function GetLastDayOfWeek(date){
  var dayofmonth = date.getDate();
  var dayofweek = date.getDay();
  var lastdayofweek = dayofmonth + (6 - dayofweek);
  return lastdayofweek;
}
function SetAppointmentAJAX() 
{
  xmlhttp = new XMLHttpRequest();

  var user_ajax = document.getElementById('userpost').value;
  var teacher_ajax = document.getElementById('teacherpost').value;
  var date_ajax = document.getElementById('datepost').value;
  var time_ajax = document.getElementById('timepost').value;
  var duration_ajax = document.getElementById('durationpost').value;
  var lessontype_ajax = document.getElementById('lessontypepost').value;

  document.getElementById("alerttext").innerHTML = "Please wait...";

  xmlhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      var response = this.responseText;
      //Show confirmation / error in alert window:
      document.getElementById("alerttext").innerHTML = response;
      Show('alertbox');
      Show('alertboxdimmer');
      //Enable 'ok' button:
      EnableAlertButton();
      //Hide unrelated (group) controls from alert window:
      if (document.getElementById('AdminGroupCheckboxes')) Hide('AdminGroupCheckboxes');
      //Refresh the schedule to show new lesson:
      ShowTheWhat();
      ResetForm();
    }
  };
  xmlhttp.open("GET",'create-lesson.php?user='+user_ajax+'&teacher='+teacher_ajax+'&date='+date_ajax+'&time='+time_ajax+'&duration='+duration_ajax+'&lessontype='+lessontype_ajax,true);
  xmlhttp.send();
}

function AdminSetLessonType() //For switching between private and group lessons
{
  lessonselect = document.getElementById('AdminLessonTypeSelectBox');
  userselect = document.getElementById('AdminUserSelectBox');
  alerttext = document.getElementById('alerttext');
  checkboxes = document.getElementById('AdminGroupCheckboxes');
  groupnames = document.getElementById('confirmFieldUserGroup');
  alertbutton = document.getElementById('alertbutton');
  lessontypepost = document.getElementById('lessontypepost');
  if (lessonselect.value == "Group")
  {
    GroupSelectionMode = 1; //For the alert 'ok' button
    lessontypepost.value = "Group";
    //Show window and controls:
    Show('alertbox');
    Show('alertboxdimmer');
    Show('AdminGroupCheckboxes');
    alerttext.innerHTML = "Please select students for group lesson:";
    //Clear checked checkboxes:
    checkboxArray = checkboxes.getElementsByTagName('input');
    for (var i = 0; i < checkboxArray.length; i++)
    {
      checkboxArray[i].checked = false;
    }
    Hide('AdminUserSelectBox');
    groupnames.innerHTML = "";
  }
  else //For private lessons:
  {
    Show('AdminUserSelectBox');
    groupnames.innerHTML = "";
    lessontypepost.value = "Private";
  }
}

function AlertButtonFunc()
{
  if (GroupSelectionMode)
  {
    //Pass on the selected data to the confirmation form:
    var checkboxes = document.getElementById('AdminGroupCheckboxes');
    var checkboxArray = checkboxes.getElementsByTagName('input');
    var checkednames = [];
    for (var i = 0, pos = 0; i < checkboxArray.length; i++)
    {
      if (checkboxArray[i].checked)
      {
        checkednames[pos] = checkboxArray[i].value;
        document.getElementById('confirmFieldUserGroup').innerHTML = checkednames;
        pos++;
      }
    }
    document.getElementById('userpost').value = checkednames;
    //Clear checked checkboxes:
    for (var i = 0; i < checkboxArray.length; i++)
    {
      checkboxArray[i].checked = false;
    }
    GroupSelectionMode = 0; //Reset selection mode
  }
  //Clear window:
  Hide('alertbox');
  Hide('alertboxdimmer');
  if (document.getElementById('AdminGroupCheckboxes')) Hide('AdminGroupCheckboxes');
  var e = document.getElementById('alertbutton');
  var clone = e.cloneNode(true);
  e.parentNode.replaceChild(clone, e);
  DisableButton('alertbutton');
}
function EnableAlertButton(){
  document.getElementById('alertbutton').addEventListener("click",function Btnlisten() {AlertButtonFunc();});
  EnableButton('alertbutton');
}
function TodaySquare(){
  // Verify if today appears in current calendar view:
  var verify = 0;
  if (SelectedDate.getFullYear() == DATE.getFullYear()) verify++;
  if (SelectedDate.getMonth() == DATE.getMonth()) verify++;
  
  // If it does, then apply the highlight:
  if (verify == 2)
  {
    TodayDaySquare = document.getElementById('day'+DATE.getDate());
    TodayDaySquare.classList.add('todaysquare');
  }
  else
  {
    TodayDaySquare.classList.remove('todaysquare');
  }
}
function SelectedSquare(){
  // Remove the gray highlight from previous selected day:
  if (SelectedDaySquare) SelectedDaySquare.classList.remove('grayselected');

  // Grab the appropriate day square and highlight it:
  SelectedDaySquare = document.getElementById('day'+SelectedDate.getDate());
  SelectedDaySquare.classList.add('grayselected');
}
function DeleteLessonAsk(n,dayofweek,duration,student)
{
  // Prepare ISO Date:
  var tempdate = new Date(SelectedDate);
  if (CurrentViewMode == 'Weekly') tempdate.setDay(dayofweek);
  var ISO = MakeDateISO(tempdate);

  // Enable 'Yes' button:
  var yesbtn = document.getElementById('abd-button-yes');
  yesbtn.addEventListener('click',function () {DeleteLesson(student,n,ISO)});

  // Display message:
  Show('alertboxdelete');
  Show('alertboxdimmer');
  var abdtext = document.getElementById('abd-text');
  abdtext.innerHTML = 'Are you sure you want to <b>DELETE</b> the lesson for:<br><b>'+student+'</b> at <b>';
  abdtext.innerHTML += HourToString(n) + '</b><br>On <b>'+tempdate.toDateString()+'</b> ?'; 
}
function DeleteLesson(student,time,date)
{ 
  var xmlhttp = new XMLHttpRequest();
  document.getElementById('abd-text').innerHTML = 'Please Wait...';
  xmlhttp.onreadystatechange = function()
  {
    document.getElementById('abd-text').innerHTML = this.responseText;
    // Refresh schedule:
    ShowTheWhat();
  };
  xmlhttp.open('GET','delete-lesson.php?student='+student+'&time='+time+'&date='+date+'&teacher='+SelectedTeacher);
  xmlhttp.send();

  // Switch buttons:
  Hide('yesnobox');
  Show('abd-button-ok');
}

function CloseABD()
{
  //Reset 'Yes' Button
  var btn = document.getElementById('abd-button-yes');
  var clone = btn.cloneNode(true);
  btn.parentNode.replaceChild(clone, btn);
  
  // Switch buttons:
  Show('yesnobox');
  Hide('abd-button-ok');

  // Close window:
  Hide('alertboxdelete');
  Hide('alertboxdimmer');
}
function HourToString(n)
{
  var str;
  var rounded;
  // Display rounded num:
  if (n%1) rounded = n-0.5;
  else rounded = n;
  // Display 0 for 2 digits if needed:
  if (n<10) str = "0" + rounded;
  else str = rounded;
  // Display correct number of minutes: 
  if (n%1) str += ":30";
  else str += ":00";
  return str;
}
/* ----------------------------------------- */

/*
function NextLesson() {
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      var response = this.responseText;
      document.getElementById("nextlessoncaption").innerHTML = response;
    }
  };
  xmlhttp.open("GET","nextlesson.php?user="+user,true);
  xmlhttp.send();
}
*/

function CorrectFirstDay(CorrectDate){
  var month = CorrectDate.getMonth();
  var year = CorrectDate.getFullYear();
  //SET NUM OF DAYS IN MONTH
  switch(month){
    case 0:
        Show("day29");
        Show("day30");
        Show("day31");
      break;
    case 1: //FEBRUARY:
      if(year%4) // NOT A LEAP YEAR
      {
        Hide("day29");
        Hide("day30");
        Hide("day31");
      }
      else  // LEAP YEAR
      {
        Show("day29");
        Hide("day30");
        Hide("day31");
      }
      break;
    case 2:
        Show("day29");
        Show("day30");
        Show("day31");
      break;
    case 3:
      Hide("day31");
      break;
    case 4:
      Show("day31");
      break;
    case 5:
      Hide("day31");
      break;
    case 6:
      Show("day31");
      break;
    case 7:
      Show("day31");
      break;
    case 8:
      Hide("day31");
      break;
    case 9:
      Show("day31");
      break;
    case 10:
      Hide("day31");
      break;
    case 11:
      Show("day31");
      break;
  }
  var day = new Date(year + "-" + ++month + "-01").getDay();
  switch(day){
    case 0:
      Hide("dayfiller1");
      Hide("dayfiller2");
      Hide("dayfiller3");
      Hide("dayfiller4");
      Hide("dayfiller5");
      Hide("dayfiller6");
      break;
    case 1:
      Hide("dayfiller1");
      Hide("dayfiller2");
      Hide("dayfiller3");
      Hide("dayfiller4");
      Hide("dayfiller5");
      Show("dayfiller6");
      break;
    case 2:
      Hide("dayfiller1");
      Hide("dayfiller2");
      Hide("dayfiller3");
      Hide("dayfiller4");
      Show("dayfiller5");
      Show("dayfiller6");
      break;
    case 3:
      Hide("dayfiller1");
      Hide("dayfiller2");
      Hide("dayfiller3");
      Show("dayfiller4");
      Show("dayfiller5");
      Show("dayfiller6");
      break;
    case 4:
      Hide("dayfiller1");
      Hide("dayfiller2");
      Show("dayfiller3");
      Show("dayfiller4");
      Show("dayfiller5");
      Show("dayfiller6");
      break;
    case 5:
      Hide("dayfiller1");
      Show("dayfiller2");
      Show("dayfiller3");
      Show("dayfiller4");
      Show("dayfiller5");
      Show("dayfiller6");
      break;
    case 6:
      Show("dayfiller1");
      Show("dayfiller2");
      Show("dayfiller3");
      Show("dayfiller4");
      Show("dayfiller5");
      Show("dayfiller6");
      break;
  }
}