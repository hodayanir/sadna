<?php
//logout.php

setcookie('first_name', "" , time()-3600);
setcookie('last_name', "" , time()-3600);
setcookie('email',"" , time()-3600);
setcookie('user_type',"" , time()-3600);

header("location: index.html");

?>