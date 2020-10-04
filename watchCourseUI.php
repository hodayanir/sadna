<?php
include "mysqlConfig.php";
$courseCode = $_GET["courseCode"];

$u_email = $_COOKIE['email'];

$lessonCode = '';
if(isset($_GET['lessonCode'])) {
    $lessonCode = $_GET['lessonCode'];
}

$sql_query = "SELECT courses.courseCode, name, l.lessonCode, l.lessonName, l.lessonLink, l.lessonLength 
              FROM courses 
              LEFT JOIN lessons l 
              ON courses.courseCode = l.courseCode 
              WHERE courses.courseCode='$courseCode'";

$res = mysqli_query($link, $sql_query);
$lessons = array();

$courseName = '';
$currentLessonName = '';
$currentLessonLink = '';
$currentLessonLength = '';
while ($row = mysqli_fetch_assoc($res)) {
    $courseName = $row['name'];
    $lessons[] = $row;
    if($lessonCode == '' & $currentLessonName == ''){
        $currentLessonName = $row['lessonName'];
        $currentLessonLink = $row['lessonLink'];
        $currentLessonLength = $row['lessonLength'];
    }
    else if ($row['lessonCode'] == $lessonCode) {
        $currentLessonName = $row['lessonName'];
        $currentLessonLink = $row['lessonLink'];
        $currentLessonLength = $row['lessonLength'];
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
                            <h2><?php echo $courseName ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <section class="contact-section">
        <div class="col-12">
            <div class="row">

                <div class="col-8">
                    <div class="row">
                        <div class="col-12">
                            <h1>
                                <?php echo $currentLessonName ?> <span><i
                                            class="ti-time"></i> <?php echo $currentLessonLength ?> </span>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="<?php echo $currentLessonLink ?>"
                                        allowfullscreen></iframe>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <h1>
                            Lessons
                        </h1>
                    </div>
                    <div class="row">
                        <ul>
                            <?php foreach ($lessons as $row) { ?>
                                <li>
                                    <h4>
                                        <span><i class="ti-time"></i> <?php echo $row['lessonLength'] ?> </span>
                                        <a class="color-blue"
                                           href="/watchCourseUI.php?<?php echo "lessonCode={$row['lessonCode']}&courseCode={$row['courseCode']}" ?>"><?php echo $row['lessonName'] ?></a>
                                    </h4>

                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
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