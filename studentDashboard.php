<?php
include "mysqlConfig.php";

$myCourses = array();
$u_email = $_COOKIE['email'];
$u_firstName = $_COOKIE['first_name'];
$u_lastName = $_COOKIE['last_name'];


$sql_query = "select c.courseCode, c.tag, c.description, c.name from StudentInCourse s join courses c on s.courseCode= c.courseCode where studentEmail = '$u_email';";
$res = mysqli_query($link, $sql_query);

$sql_query_private_l = "select p.pLessonDate, p.pLessonTime, p.teacherEmail, p.studentEmail, t.zoom, t.first_name as tFirstName, t.last_name as tLastName 
                        from students s, teachers t, privateLessons p
                        where (p.studentEmail=s.email and t.first_name = p.teacherEmail) and (p.studentEmail='$u_email' OR p.teacherEmail = '$u_email')";
$res_private = mysqli_query($link, $sql_query_private_l);

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
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
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
<header id="header-wrapper"></header>
<main>
    <!-- Preloader Start -->
    <!--? Hero Start -->
    <div class="slider-area ">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center">
                            <h2>Student Dashboard</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Button -->
    <!-- Start Align Area -->
    <div class="whole-wrap">
        <div class="container box_1170">
            <div class="section-top-border">
                <h5 class="mb-30">
                    <span>Welcome, <?php echo $_COOKIE['first_name'], " ", $_COOKIE['last_name'] ?>!</span></h5>
                <div class="row">
                    <div class="col-9">
                        <h2><strong>Watch Your Courses</strong></h2>
                    </div>
                    <div class="col-3">
                        <div class="col-12">
                            <a href="/courses.php"
                               class="float-right genric-btn primary-border e-large"><strong><strong>Find New Course</strong></strong></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <section class="all-course section-padding30">
                            <div class="container">
                                <div class="row">
                                    <div class="all-course-wrapper">
                                        <!-- Tab content -->
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Nav Card -->
                                                <div class="tab-content" id="nav-tabContent">
                                                    <!--  one -->
                                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                                         aria-labelledby="nav-home-tab">
                                                        <div class="row">
                                                            <?php
                                                            while ($row = mysqli_fetch_assoc($res)) {
                                                                ?>

                                                                <div class="col-4">
                                                                    <!-- Single course -->
                                                                    <div class="single-course mb-70">
                                                                        <div class="course-img">
                                                                            <?php if ($row['tag'] == "Art"){?>
                                                                                <a href="/watchCourseUI.php?<?php echo "courseCode={$row['courseCode']}" ?>"><img src="assets/img/course/Art.jpg" /></a>
                                                                                
                                                                               <?php  }?>
                                                                               <?php if ($row['tag'] == "Biology"){?>
                                                                               
                                                                               <a href="/watchCourseUI.php?<?php echo "courseCode={$row['courseCode']}" ?>"><img src="assets/img/course/biology.png" /></a>
                                                                                        
                                                                                <?php } ?>
                                                                               <?php if ($row['tag'] == "Chemistry"){?>
                                                                                    <a href="/watchCourseUI.php?<?php echo "courseCode={$row['courseCode']}" ?>"><img src="assets/img/course/chemistry.jpg" /></a>
                            
                                                                                    
                                                                                <?php } ?>
                                                                              <?php  if ($row['tag'] == "Economics"){?>
                                                                              <a href="/watchCourseUI.php?<?php echo "courseCode={$row['courseCode']}" ?>"><img src="assets/img/course/economics.jpg" /></a>
                                                                                <?php } ?>
                                                                              <?php  if ($row['tag'] == "Language"){?>
                                                                              <a href="/watchCourseUI.php?<?php echo "courseCode={$row['courseCode']}" ?>"><img src="assets/img/course/language.jpg" /></a>
                                                                               <?php }?>
                                                                              <?php  if ($row['tag'] == "Mathematics"){?>
                                                                              <a href="/watchCourseUI.php?<?php echo "courseCode={$row['courseCode']}" ?>"><img src="assets/img/course/mathematics.jpeg" /></a>
                                                                                <?php }?>
                                                                              <?php  if ($row['tag'] == "Photography"){?>
                                                                              <a href="/watchCourseUI.php?<?php echo "courseCode={$row['courseCode']}" ?>"><img src="assets/img/course/photography.jpg" /></a>
                            
                                                                                <?php } ?>
                                                                        </div>
                                                                        <div class="course-caption">
                                                                            <div class="course-cap-top">
                                                                                <h4>
                                                                                    <a href="/watchCourseUI.php?<?php echo "courseCode={$row['courseCode']}" ?>"><?php echo $row['name'] ?></a>
                                                                                </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Nav Card -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                  
                  <div class="section-top-border">
                      <br>
                      <br>
                  <div class="row">
                    
                                    <div class="col-9">
                                    <h3 class="mb-30"><strong>Private Lessons:</strong></h3>
                                    </div>
                         <div class="col-3">
                        <div class="col-12">
                            <a href="schedule/schedule.php"
                               class="float-right genric-btn primary-border e-large"><strong><strong>+ Private
                                        Lesson</strong></strong></a>
                             </div>
                            </div>
                                    </div>
                                    <br>
                                    <div class="progress-table-wrap">
                                        <div class="progress-table">
                                            <div class="table-head">
                                                <div class="serial">#</div>
                                                <div class="visit">First Name</div>
                                                <div class="visit">Last Name</div>
                                                <div class="visit">Hour</div>
                                                <div class="visit">Date</div>
                                                <div class="visit">Zoom link</div>
                                            </div>


                                            <?php
                                            
                                            while ($row_private = mysqli_fetch_assoc($res_private)) {
                                            $zoom =$row_private['zoom'];?>
                                            
                                                <div class="table-row">
                                                    <div class="serial">#</div>
                                                    <div class="visit"> <?php echo $row_private['tFirstName'] ?></div>
                                                    <div class="visit"> <?php echo $row_private['tLastName'] ?></div>
                                                    <div class="visit"><?php echo $row_private['pLessonTime'] ?></div>
                                                     <div class="visit"><?php echo $row_private['pLessonDate'] ?></div>
                                                    <div class="visit"><a href="<?php echo $zoom;?>"> Enter Meeting </a></div>
                                                    
                                                    
                                
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>

                                </div>


                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Align Area -->
</main>
<header id="footer-wrapper"></header>
<!-- Scroll Up -->
<div id="back-top">
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

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
<script src="./assets/js/jquery.magnific-popup.js"></script>

<!-- Nice-select, sticky -->
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>

<!-- contact js -->
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