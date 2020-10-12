<?php
include "mysqlConfig.php";

$t_email = $_COOKIE['email'];
//$first_name = $_COOKIE['first_name'];
//$last_name = $_COOKIE['last_name'];

if ($_COOKIE['user_type'] == "students" )
    {
        
        $sql_query="SELECT country, address, phone, description, photo, students.first_name, students.last_name FROM students WHERE (email='$t_email');";
        
    }

else {
    $sql_query="SELECT country, address, phone, description, photo, teachers.first_name , teachers.last_name,linkedin,facebook,twitter,zoom FROM teachers WHERE (email='$t_email');";
    
}


$res = mysqli_query($link, $sql_query);
$res=mysqli_query($link, $sql_query);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_row($res);
    $country = $row[0];
    $address = $row[1];
    $phone = $row[2];
    $description = $row[3];
    $first_name = $row[5];
    $last_name = $row[6];
    
    if ($_COOKIE['user_type'] == "teachers" )
    {
        
    $linkedin = $row[7];
    $facebook = $row[8];
    $twitter = $row[9];
    $zoom = $row[10];
        
    }

}

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
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>


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
                            <h2>Edit Details</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!-- ================ Login section start ================= -->
    <section class="contact-section">
        <div class="container">
            <form class="form-contact contact_form" action="updateTeacher.php" method="post" id="addLesson">
                <div class="col-8">
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>First Name</h5>
                            <input class="single-input" name="first_name" id="first_name" value=<?php echo $first_name ?>>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Last Name</h5>
                            <input class="single-input" name="last_name" id="last_name" value="<?php echo $last_name ?>">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Country</h5>
                            <input class="single-input" name="country" id="country" value="<?php echo $country ?>">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Address</h5>
                            <input class="single-input" name="address" id="address" value="<?php echo $address ?>">
                        </div>
                    </div>
                  <div class="row mt-4">
                        <div class="col-12">
                            <h5>Phone</h5>
                            <input class="single-input" name="phone" id="phone" value="<?php echo $phone ?>">
                        </div>
                    </div>
                    <?php if ($_COOKIE['user_type'] == "teachers" ){?>
                  <div class="row mt-4">
                        <div class="col-12">
                            <h5>Facebook</h5>
                            <input class="single-input" name="facebook" id="facebook" value="<?php echo $facebook?>">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Linkedin</h5>
                            <input class="single-input" name="linkedin" id="linkedin" value="<?php echo $linkedin?>">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Twitter</h5>
                            <input class="single-input" name="twitter" id="twitter" value="<?php echo $twitter?>">
                        </div>
                    </div>
                   <div class="row mt-4">
                        <div class="col-12">
                            <h5 style=display:inline-block>Zoom</h5><a href="assets/pdf/how to copy zoom meeting link to TMO pdf.pdf" target="_blank" class="genric-btn primary-border small" style=float:right>Help?</a>
                            <input class="single-input" name="zoom" id="zoom" value="<?php echo $zoom?>">
                        </div>
                    </div>
                    
                    <?php    } ?>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Description</h5>
                            <textarea class="single-input" name="description"><?php echo $description ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-6">
                            <button type="submit" class="button button-contactForm boxed-btn">Update</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
    <!-- ================ contact section end ================= -->
</main>

<footer id="footer-wrapper"></footer>
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

<!-- contact js -->
<!--
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>
-->

<!-- Jquery Plugins, main Jquery -->
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
<!--<script src="./assets/js/login.js"></script>-->

</body>
</html>