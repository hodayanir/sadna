<?php
    include "mysqlConfig.php";

    $myCourses = array();
    $courseCode = $_GET["course_id"];
    $sql_query = "SELECT courses.courseCode, name, description,tag,teacherEmail, l.lessonCode, l.lessonName, l.lessonLink, l.lessonLength FROM courses LEFT JOIN lessons l on courses.courseCode = l.courseCode WHERE courses.courseCode='$courseCode'";

    $res = mysqli_query($link, $sql_query);
    $lessons = array();
    while ($row = mysqli_fetch_assoc($res)) {
    $courseName = $row['name'];
    $tag = $row['tag'];
    $description = $row['description'];
    $teacherEmail = $row['teacherEmail'];
    $courseDescription = $row['description'];
    $lessons[] = $row;
    $email = $_COOKIE['email'];
}



?>



<!doctype html>
<html class="no-js" lang="zxx">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title> TMO | <?php echo $courseName ?> </title>
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
   <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    
    <script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>

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
                              <h2>Course Details</h2>
                           </div>
                     </div>
                  </div>
               </div>
         </div>
      </div>

      <section class="blog_area single-post-area section-padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 posts-list">
                  <div class="single-post">
                     <div class="feature-img">
                         <div class="img-fluid">
                        <?php if ($tag == "Art"){
                        echo '<img src="assets/img/course/Art.jpg". width="770" height="450"/>';
                         }
                        if ($tag == "Biology"){
                             echo '<img src="assets/img/course/biology.png". width="770" height="430"/>';}
                        if ($tag == "Chemistry"){
                             echo '<img class="img-fluid" src="assets/img/course/chemistry.jpg". width="780" height="300"/>';}
                        if ($tag == "Economics"){
                             echo '<img class="img-fluid" src="assets/img/course/economics.jpg". width="800" height="450"/>';}
                        if ($tag == "Language"){
                             echo '<img src="assets/img/course/language.jpg". width="770" height="420"/>';}
                        if ($tag == "Mathematics"){
                             echo '<img src="assets/img/course/mathematics.jpeg". width="770" height="430"/>';}
                        if ($tag == "Photography"){
                             echo '<img src="assets/img/course/photography.jpg". width="770" height="430"/>';}
                         
                         ?>
                        
                        </div>
                     </div>
                     <div class="blog_details"> <!-- details of the course -->
                     <div class="row">
                         <div class="col-9">
                        <h2 style="color: #2d2d2d;"><?php echo $courseName ?> </h2> <!--title-->
                        </div>
                        <div class="col-3">
                         <form action="join_course.php" method="post" id="Join">
                           <aside class="single_sidebar_widget post_category_widget">    
                               
                            <input type="hidden" name="courseCode" id="courseCode" value= <?php echo $courseCode ?> >
                            <input type="hidden" name="teacherEmail" id="teacherEmail" value= <?php echo $teacherEmail ?> >
                            <button class="genric-btn primary-border e-large"type="submit">Join</button>
                             </aside> 
                              </form>    
                        </div>
                    </div>    
                        <ul class="blog-info-link mt-3 mb-4">
                           <li><a href="#"><i class="fa fa-user"></i> <?php echo $tag ?></a></li> <!-- need to add the tags-->
                           <li><a href="#"><i class="fa fa-comments"></i>
                           <?php $sql_query2="SELECT comment FROM Course_Reviews WHERE courseCode ='$courseCode'";
                            $result =$link->query($sql_query2);
                            if ( $result->num_rows>0){
                            $row_cnt = $result->num_rows;
                            echo $row_cnt;
                            echo " reviews";}
                            else echo "0 reviews";
                                                             
                            ?>
                           
                           </a></li> 
                        </ul>
                        <p class="excert">
                        <?php echo $description?>
                        </p>
                        <div class="quote-wrapper">
                           <div class="quotes"> <!-- comment form a client -->
                                <ul>
                                 <strong class="color-blue">  Course content: </strong> 
                            <?php foreach ($lessons as $row) { ?>
                                <li>
                                         
                                        <span class="color-blue"><i class="ti-time"></i> <?php echo $row['lessonLength'] ?> </span>
                                        <i class="color-blue"><?php echo $row['lessonName'] ?></i>
                                    
    
                                </li>
                            <?php } ?>
                                </ul> 
                             
                           </div>
                        </div>

                     </div>
                  </div>
                  <div class="navigation-top">
                     <div class="d-sm-flex justify-content-between text-center">
                        <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span> Lily and 4
                           people like this</p>
                        <div class="col-sm-4 text-center my-2 my-sm-0">
                           <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                        </div>
                        <ul class="social-icons">
                           <li><a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                           <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        </ul>
                     </div>

                  </div>
                 
                  <div class="blog-author">
                     <?php $sql_query="SELECT description,first_name,last_name, photo FROM teachers WHERE (email='$teacherEmail')";
                     $res=mysqli_query($link, $sql_query);
                        if (mysqli_num_rows($res) > 0) {
                            $row = mysqli_fetch_row($res);
                            $description = $row[0];
                            $first_name = $row[1];
                            $last_name = $row[2];
                            $photo = $row[3];
                        }
                     ?>
            
            <div class="media align-items-center"> 
                     <img src="<?php echo $photo ?>" alt="">
                        <div class="media-body">
                           <a href="#">
                              <h4><?php echo ucfirst($first_name) , " ", ucfirst($last_name) ?></h4> 
                           </a>
                           <p><?php echo ucfirst($description) ?></p>
                        </div>
                     </div>
                  </div>
                
                  <div class="comments-area">
                     <h4>Comments</h4>
                     <?php
                         $sql_query="SELECT first_name,last_name,comment,Date,email,photo FROM Course_Reviews WHERE courseCode = '$courseCode'";
                         $res=mysqli_query($link, $sql_query);
                    if ( $res->num_rows==0){
                        echo " Be the ";echo "<span style='color: red;' /><strong>first</strong></span>"; echo " to comment on this course!";
                    }
                      while($row = mysqli_fetch_assoc($res)){?>
                      
                     <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                           <div class="user justify-content-between d-flex">
                              <div class="thumb">
                                 
                                 <img src="<?php echo $row['photo'] ?>" alt="">
                                 
                              </div>
                              <div class="desc">
                                 <div class="comment">
                                    <?php echo $row['comment']?>
                                 </div>
                                 <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                       <h5>
                                          <?php echo $row['first_name']?> <?php echo $row['last_name']?>
                                       </h5>
                                       <p class="date"><?php echo $row['Date']?> </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                    <div>  
                    </div>
                   <?php    } ?>

                  
                  
                  
                  <div class="comment-form">
                     <h4>Add Your Feedback</h4>
                     <form class="form-contact comment_form" method="post" action="new_comment.php?course_id=<?php echo $courseCode ?>" id="commentForm">
                        <div class="row">
                           <div class="col-12">
                              <div class="form-group">
                                 <textarea class="form-control w-100" name="comment" id="TypeHere" cols="30" rows="9"
                                    placeholder="Write Comment"></textarea>

                                    <script type="application/x-javascript">

                                        tinymce.init({selector:'#TypeHere'});

                                    </script>
                              </div>
                           </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <button type="submit" class="button button-contactForm btn_1 boxed-btn">Post Comment</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="blog_right_sidebar">
            
               <form action="join_course.php" method="post" id="Join">
               <aside class="single_sidebar_widget post_category_widget">    
                   
                <input type="hidden" name="courseCode" id="courseCode" value= <?php echo $courseCode ?> >
                <input type="hidden" name="teacherEmail" id="teacherEmail" value= <?php echo $teacherEmail ?> >
                <button class="button rounded-0 primary-bg w-100 btn_1 boxed-btn"type="submit">Join</button>
                 </aside> 
                  </form>
                 
                     <aside class="single_sidebar_widget post_category_widget">
                        <center><h4 class="widget_title" style="color: #2d2d2d;">More in this category</h4></center>
                        <ul class="list cat-list">
                         <?php
                         $sql_query="SELECT name,tag,courseCode FROM courses WHERE tag = '$tag'";
                         $res=mysqli_query($link, $sql_query);
                    if ( $res->num_rows==1){
                        echo "No additional courses in this catagory";
                    }
                    else {
                      while( $row = mysqli_fetch_assoc($res)){;?>
                           <li>
                               
                              <a href="http://omerho-is.mtacloud.co.il/course_details.php?course_id=<?php echo $row['courseCode']?></p>" class="d-flex">
                                 <p><?php echo $row['name']?></p>
                                 
                              </a>
                           </li>
                           
                           <?php    }} ?>
                           
                        </ul>
                     </aside>
                     
                     <aside class="single_sidebar_widget newsletter_widget">
                        <center><h4 class="widget_title" style="color: #2d2d2d;">Stay Updated</h4></center>
                        <form action="stay_updated.php" method="post" id="stayupdated">
                           <div class="form-group">
                              <input type="email" class="form-control" onfocus="this.placeholder = ''" name="email" id="email"
                                 onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                                 <input type="hidden" name="courseCode" id="courseCode" value= <?php echo $courseCode ?> >
                           </div>
                           <center><button class="genric-btn primary-border"
                              type="submit">Subscribe</button></center>
                        </form>
                     </aside>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--================ Blog Area end =================-->
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
