<?php
include "mysqlConfig.php";
$courseCode = $_GET["course_id"];
$u_email = $_COOKIE['email'];


$sql_query = "SELECT courses.courseCode, name, description, l.lessonCode, l.lessonName, l.lessonLink, l.lessonLength FROM courses LEFT JOIN lessons l on courses.courseCode = l.courseCode WHERE courses.courseCode='$courseCode'";

$res = mysqli_query($link, $sql_query);
$lessons = array();
while ($row = mysqli_fetch_assoc($res)) {
    $courseCode = $row['courseCode'];
    $courseName = $row['name'];
    $courseDescription = $row['description'];
    $lessons[] = $row;
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
    <!-- ================ Login section start ================= -->

        <div class="container">
            <div class="section-top-border">
                <h4 class="mb-30"><strong><span>Update Your Course:</strong></span></h4>    
            <form class="form-contact contact_form" action="updateCourse.php" method="post" id="createCourse">
                <input type="hidden" name="courseCode" id="courseCode" value= <?php echo $courseCode ?> >
                <div class="col-6">
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Course Name</h5>
                            <input class="single-input" name="courseName" id="name"
                                   placeholder="Enter course name" value="<?php echo $courseName ?>" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Enter Course Description</h5>
                            <textarea class="single-input" name="courseDes" id="courseDes"
                                      placeholder="Enter course description"
                                      required><?php echo $courseDescription ?> </textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <button type="submit" class="button button-contactForm boxed-btn">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <br>
             <div class="section-top-border">
            <div class="row mt-5">
                <div class="col-9">
                    <h4 class="mb-30"><strong><span>Course's Lessons:</strong></span></h4>
                </div>
                <div class="col-3">
                    <a href="createLessonUI.php?course_id=<?php echo $courseCode ?>"
                       class="float-right button button-contactForm boxed-btn">Add Lesson</a>
                </div>
            </div>
            
           


                                    
                                    <div class="col-10">
                                    <div class="progress-table-wrap">
                                        <div class="progress-table">
                                            <div class="table-head">
                                                <div class="serial">#</div>
                                                <div class="visit">Lesson Lenght</div>
                                                <div class="visit">Lesson Name</div>
                                            </div>


                                            
                                            <?php foreach ($lessons as $row) { 
                                            $lesson_code = $row['lessonCode'];
                                            $edit ="/updateLessonUI.php?lesson_id=$lesson_code";
                                            ?>
                                                <div class="table-row">
                                                    <div class="serial">#</div>
                                                    <div class="visit"> <span> <?php echo $row['lessonLength'] ?> </span></div>
                                                  
                                                    <div class="percentage">  <?php echo $row['lessonName'] ?></div>
                                                    <div class="visit"><a href="<?php echo $edit;?>"> Edit </a></div>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>

                                </div>
                                </div>

        </div>

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