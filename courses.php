<?php
    include "mysqlConfig.php";

    $myCourses = array();

    $sql_query="SELECT name,tag,courseCode FROM courses";
    $res=mysqli_query($link, $sql_query);
    


    


?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> TMO | Courses </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

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
                            <h2>All Courses</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!-- all-course Start -->
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
                                        while($row = mysqli_fetch_assoc($res)){ 
                                        $course_code = $row['courseCode'];?>
                                        
                                        <div class="col-xl-4 col-lg-4 col-md-6">
                                             
                                            <div class="single-course mb-70">
                                                <div class="course-img">
                                                     <?php if ($row['tag'] == "Art"){?>
                                                    <a href="/course_details.php?course_id=<?php echo $row['courseCode']?>"><img src="assets/img/course/Art.jpg" /></a>
                                                    
                                                   <?php  }?>
                                                   <?php if ($row['tag'] == "Biology"){?>
                                                   
                                                   <a href="/course_details.php?course_id=<?php echo $row['courseCode']?>"><img src="assets/img/course/biology.png" /></a>
                                                            
                                                    <?php } ?>
                                                   <?php if ($row['tag'] == "Chemistry"){?>
                                                        <a href="/course_details.php?course_id=<?php echo $row['courseCode']?>"><img src="assets/img/course/chemistry.jpg" /></a>

                                                        
                                                    <?php } ?>
                                                  <?php  if ($row['tag'] == "Economics"){?>
                                                  <a href="/course_details.php?course_id=<?php echo $row['courseCode']?>"><img src="assets/img/course/economics.jpg" /></a>
                                                    <?php } ?>
                                                  <?php  if ($row['tag'] == "Language"){?>
                                                  <a href="/course_details.php?course_id=<?php echo $row['courseCode']?>"><img src="assets/img/course/language.jpg" /></a>
                                                   <?php }?>
                                                  <?php  if ($row['tag'] == "Mathematics"){?>
                                                  <a href="/course_details.php?course_id=<?php echo $row['courseCode']?>"><img src="assets/img/course/mathematics.jpeg" /></a>
                                                    <?php }?>
                                                  <?php  if ($row['tag'] == "Photography"){?>
                                                  <a href="/course_details.php?course_id=<?php echo $row['courseCode']?>"><img src="assets/img/course/photography.jpg" /></a>

                                                    <?php } ?>
                                                     

                                                </div>
                                                <div class="course-caption">
                                                    <div class="course-cap-top">
                                                        <h4><a href="/course_details.php?course_id=<?php echo $row['courseCode']?>"><?php echo $row['name']?></a></h4>
                                                    </div>
                                                    <div class="course-cap-mid d-flex justify-content-between">

                                                        <ul>
                                                            <li> <?php echo $row['tag']?>  </li>
                                                        </ul>
                                                    </div>
                                                    <div class="course-cap-bottom d-flex justify-content-between">
                                                        <ul>
                                                            <li><i class="ti-user"></i> <?php $sql_query2="SELECT comment FROM Course_Reviews WHERE courseCode ='$course_code'";
                                                                $result =$link->query($sql_query2);
                                                                if ( $result->num_rows>0){
                                                                $row_cnt = $result->num_rows;
                                                                echo $row_cnt;
                                                                echo " reviews";}
                                                                else echo "0 reviews";
                                                             
                                                                  ?></li>
                                                        </ul>
                                                        <span>Free</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php    } ?>
                                        
                                   </div>   
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- all-course End -->
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
<script src="./assets/js/jquery.magnific-popup.js"></script>

<!-- Date Picker -->
<script src="./assets/js/gijgo.min.js"></script>
<!-- Nice-select, sticky -->
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>

<!-- counter , waypoint -->
<script src="./assets/js/jquery.counterup.min.js"></script>
<script src="./assets/js/waypoints.min.js"></script>

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