
<?php
 include "mysqlConfig.php";

 # set variables #
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_REQUEST["email"];
    $from = "tmo.s3345@gmail.com";
    $role = $_REQUEST["role"];
    $first_name = $_REQUEST["first_name"];
    $last_name = $_REQUEST["last_name"];
    $email = $_REQUEST["email"];
    $address = $_REQUEST["address"];
    $country = $_REQUEST["country"];
    $phone_number = $_REQUEST["phone_number"];
    $password = $_REQUEST["password"];
    $description = $_REQUEST["description"];
    
    $counter = 0;
   
   
   if ($role == "student")
{   
    $sql_query="SELECT * FROM students WHERE email ='$email'";
    $res=mysqli_query($link, $sql_query);
    $sql_query1="SELECT * FROM teachers WHERE email ='$email'";
    $res1=mysqli_query($link, $sql_query1);
    if (mysqli_num_rows($res) > 0 || mysqli_num_rows($res1) > 0) {
        echo "email already exist ";
    } 
    else
    {
        $insert_query_students = "INSERT INTO students (first_name, last_name, email, country, address, phone, description, pass) VALUES ('$first_name', '$last_name', '$email', '$country', '$address', '$phone_number', '$description', '$password')";
        $res=mysqli_query($link, $insert_query_students);
        $counter = 1;
    }
}
else
{
    $sql_query="SELECT * FROM students WHERE email ='$email'";
    $res=mysqli_query($link, $sql_query);
    $sql_query1="SELECT * FROM teachers WHERE email ='$email'";
    $res1=mysqli_query($link, $sql_query1);
    if (mysqli_num_rows($res) > 0 || mysqli_num_rows($res1) > 0) {
        echo "email already exist ";
    } 
    else
    {
        $insert_query_teachers = "INSERT INTO teachers (first_name, last_name, email, country, address, phone, description, pass) VALUES ('$first_name', '$last_name', '$email', '$country', '$address', '$phone_number', '$description', '$password')";
        $res=mysqli_query($link, $insert_query_teachers);
        $counter = 1;
    }

}

}

#send email #
    $headers = "From: $from";
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $from . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $subject = "Thank you for registering us as a $role.";

    $logo = 'img/logo.png';
    $link = '#';

	$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
	$body .= "<table style='width: 100%;'>";
	$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
	$body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
	$body .= "</td></tr></thead><tbody><tr>";
	$body .= "<td style='border:none;'><strong>Name:</strong> {$first_name}</td>";
	$body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
	$body .= "</tr>";
	$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$subject}</td></tr>";
	$body .= "<tr><td></td></tr>";
	$body .= "<tr><td colspan='2' style='border:none;'>{$message}</td></tr>";
	$body .= "</tbody></table>";
	$body .= "</body></html>";

    $send = mail($to, $subject, $body, $headers);
?>



<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
     <title> Education | Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

   <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    
</head>
    <!--? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
<header id="header-wrapper"></header>
    <main>
        <!--? Hero Start -->
        <div class="slider-area ">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 text-center">
                                <h2>Register</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!-- ================ contact section start ================= -->
        <section class="contact-section">
            <div class="container">
                <div class="d-none d-sm-block mb-5 pb-4">
                    <div class="hero-cap hero-cap2 text-center">
                       <?php if ($counter == 0){ ?>
                       <h3 style="color:#8B0000">Sorry, the email you chose has already been taken. please re-register with another one.</h3>
                       <br></br>
                       <a href="register_form.php" class="button button-contactForm boxed-btn">Re-register</a>
                       <?php } else { ?>
                       <h3>Thank you for registering us! you choose the best way to successfull!</h3>
                       <br></br>
                       <a href="login.html" class="button button-contactForm boxed-btn">Click here to login</a>
                       <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ contact section end ================= -->
    </main>
    <footer>
    <ol id="down-page"; style="padding-left: 0px;"></ol>

    <script>
        $( "#down-page" ).load( "index.html #down-page" );
    </script>
    </footer>
    <!-- JS here -->

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    
    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- contact js      -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

     
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>


    </body>
</html>