/* -------- ADMIN.PHP FUNCTIONS -------- */

// Variables

thisDate = new Date();


// Startup function

window.onload = function()
{
    document.getElementById('StatsYear').value = thisDate.getFullYear();
    document.getElementById('StatsMonth').value = thisDate.getMonth() + 1;
}

// Functions:

function AdminCreateUser() // (acu)
{
    //Get new user data:
    var acuUser = document.getElementById('acuUser').value;
    var acuPassword = document.getElementById('acuPassword').value;
    var acuEmail = document.getElementById('acuEmail').value;
    var acuPhone = document.getElementById('acuPhone').value;
    
    //Display "Please Wait..." text:
    var result = document.getElementById('CreateUserResult');
    result.innerHTML = "Please wait...";
    
    //Check if a user exists with such a name to avoid duplicates (on js lvl):
    var selectBox = document.getElementById("DeleteUserSelectBox");
    var UserExistsFlag = 0;
    for (var i = 1; i < selectBox.length; i++)
    {
        if (selectBox.options[i].value == acuUser) UserExistsFlag = 1;
    }
    if (!(acuUser)) UserExistsFlag = 1;

    //Add user to admin page:
    if (UserExistsFlag == 0)
    {
        var newUser = document.createElement("option");
        newUser.id = "DeleteUser"+acuUser;
        var text = document.createTextNode(acuUser);
        newUser.appendChild(text);
        selectBox.appendChild(newUser);

        selectBox = document.getElementById('StatsUserSelectBox');
        newUser = document.createElement('option');
        newUser.id = "StatsUser"+acuUser;
        text = document.createTextNode(acuUser);
        newUser.appendChild(text);
        selectBox.appendChild(newUser);
        
        //Add user to database:
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
        if (this.readyState == 4 && this.status == 200) 
        {
            var response = this.responseText;
            result.innerHTML = response;
        }
        };
        xmlhttp.open("GET","create-user.php?user="+acuUser+"&password="+acuPassword+"&email="+acuEmail+"&phone="+acuPhone,true);
        xmlhttp.send();
    }
    else
    {
        result.innerHTML = "User "+acuUser+" already exists!";
    }
}

  function AdminDeleteUser()
  {
    //Get username:
    var selectBox = document.getElementById("DeleteUserSelectBox");
    var aduUser = selectBox.options[selectBox.selectedIndex].value;

    //Display "Please Wait..." text:
    var result = document.getElementById('DeleteUserResult');
    result.innerHTML = "Please wait...";

    if (aduUser != 'Select a user')
    {
        //Remove user from admin webpage:
        var Deleteoption = document.getElementById('DeleteUser'+aduUser);
        var Statsoption = document.getElementById('StatsUser'+aduUser);
        Deleteoption.parentElement.removeChild(Deleteoption);
        Statsoption.parentElement.removeChild(Statsoption);

        //Remove user from database:
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
        if (this.readyState == 4 && this.status == 200) 
        {
            var response = this.responseText;
            result.innerHTML = response;
        }
        };
        xmlhttp.open("GET","delete-user.php?user="+aduUser,true);
        xmlhttp.send();
    }
    else
    {
        result.innerHTML = "Please select a user.";
    }
  }

  function BackButton()
  {
    window.location.href = "schedule.php";
  }

  function DisplayUserStats()
  {
    //Get username:
    var selectBox = document.getElementById("StatsUserSelectBox");
    var dusUser = selectBox.options[selectBox.selectedIndex].value;
    var dusYear = document.getElementById('StatsYear').value;
    var dusMonth = document.getElementById('StatsMonth').value;

    //Define counters:
    var PLC, GLC, TLC;
    var EyalPLC, EyalGLC, EyalTLC;
    var JennyPLC, JennyGLC, JennyTLC;
    var MendelPLC, MendelGLC, MendelTLC;

    //Display "Please Wait..." text:
    var ElementPLC = document.getElementById('PrivateLessonCount');
    var ElementGLC = document.getElementById('GroupLessonCount');
    var ElementTLC = document.getElementById('TotalLessonCount');
    var TooltipPLC = document.getElementById('PLCTooltip');
    ElementPLC.innerHTML = "Please wait..";
    ElementGLC.innerHTML = "Please wait..";
    ElementTLC.innerHTML = "Please wait..";
    
    //Send AJAX Request to count lessons for user in database:
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            var response = this.responseText;
            response = response.split("&");

            response[0] = response[0].split(",");
            EyalPLC = response[0][0];
            EyalGLC = response[0][1];
            EyalTLC = EyalPLC*1 + EyalGLC*1; // *1 <-- Force conversion from string to num

            response[1] = response[1].split(",");
            JennyPLC = response[1][0];
            JennyGLC = response[1][1];
            JennyTLC = JennyPLC*1 + JennyGLC*1;

            response[2] = response[2].split(",");
            MendelPLC = response[2][0];
            MendelGLC = response[2][1];
            MendelTLC = MendelPLC*1 + MendelGLC*1;
            
            PLC = EyalPLC*1 + JennyPLC*1 + MendelPLC*1;
            GLC = EyalGLC*1 + JennyGLC*1 + MendelGLC*1;
            TLC = EyalTLC*1 + JennyTLC*1 + MendelTLC*1;

            //Display results:
            ElementPLC.innerHTML = PLC + '<span class="tooltiptext">Eyal: '+EyalPLC+'<br>Jenny: '+JennyPLC+'<br>Mendel: '+MendelPLC+'</span>';
            ElementGLC.innerHTML = GLC + '<span class="tooltiptext">Eyal: '+EyalGLC+'<br>Jenny: '+JennyGLC+'<br>Mendel: '+MendelGLC+'</span>';;
            ElementTLC.innerHTML = TLC + '<span class="tooltiptext">Eyal: '+EyalTLC+'<br>Jenny: '+JennyTLC+'<br>Mendel: '+MendelTLC+'</span>';;
        }
    };
    xmlhttp.open("GET","count-lessons.php?user="+dusUser+"&year="+dusYear+"&month="+dusMonth,true);
    xmlhttp.send();
  }