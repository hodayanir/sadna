<?php

include "mysqlConfig.php";
$resObj = new stdClass();

//$first_name = $_COOKIE['first_name'];
//$last_name = $_COOKIE['last_name'];
$email = $_COOKIE['email'];

$sql_query="SELECT country, address, phone, description, photo, first_name ,last_name,linkedin,facebook,twitter,zoom FROM teachers WHERE (email='$email')";
$res=mysqli_query($link, $sql_query);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_row($res);
    $country = $row[0];
    $address = $row[1];
    $phone = $row[2];
    $description = $row[3];
    $photo = $row[4];
    $first_name = $row[5];
    $last_name = $row[6];
    $linkedin = $row[7];
    $facebook = $row[8];
    $twitter = $row[9];
    $zoom = $row[10];
}
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title> TMO | My area </title>
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
                                <h2>My Area</h2>
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
					
					<div class="row">
						<div class="col-md-3">
						 <?php
						    if ($photo == NULL)
                            {
                            echo "<img src='assets/img/profile_picture.png' class='img-fluid' height=300 width=200>";
                            }
                            else {
                            
							echo "<img src='$photo'class='img-fluid' height=300 width=200>";
							}
						?>
							<div class="section-top-border">
							    </div>
							<form action="upload.php" method="post" enctype="multipart/form-data" style=font-size:12px;>
                            
                            Select image to upload:
                            
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                            </form>
						</div>
						<div class="col-md-9 mt-sm-20">
							<div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <u>Basic Information:</u><br>
                                        <span>Full Name: </span></span><span><?php echo ucfirst($first_name) , " ", ucfirst($last_name) ?></span></h3>
                                    </div>
                                    <div class="form-group">
                                        <span>Country: </span></span><span><?php echo ucfirst($country) ?></span></h3>
                                    </div>
                                    <div class="form-group">
                                        <span>Address: </span></span><span><?php echo ucfirst($address) ?></span></h3>
                                    </div>
                                    <div class="form-group">
                                        <span>Phone Number: </span></span><span><?php echo ucfirst($phone) ?></span></h3>
                                    </div>
                                    <div class="form-group">
                                        <span>Description: </span></span><span><?php echo ucfirst($description) ?></span></h3>
                                    </div>
                                    <br>
                                    <u>Links:</u><br>
                                    <div class="form-group">
                                        <span>Facbook: </span></span><span><?php echo ucfirst($facebook) ?></span></h3>
                                    </div>
                                    <div class="form-group">
                                        <span>Linkedin: </span></span><span><?php echo ucfirst($linkedin) ?></span></h3>
                                    </div>
                                    <div class="form-group">
                                        <span>Twitter: </span></span><span><?php echo ucfirst($twitter) ?></span></h3>
                                    </div>
                                    <div class="form-group">
                                        <span>Zoom: </span></span><span><?php echo ucfirst($zoom) ?></span></h3>
                                    </div>
						        </div>
					        </div>
					
					   <div class="form-group mt-4">
					       </div>
					       
					   <div class="form-group mt-4">
					      <div class="col-lg-8 col-md-8">
						  <div class="button-group-area mt-10">
						  <a href="updateTeacherUI.php" class="genric-btn primary-border e-large">Edit Details</a>
						  <a href="changePass.html" class="genric-btn primary-border e-large">Change Password</a>
                         </div>
				         </div>
			           </div>
			  </div>
		</div>
 </div>
 </div>
 </div>

		<!-- End Align Area -->
	</main>
    <header id="footer-wrapper"></header>
    <!-- Scroll Up -->
    <div id="back-top" >
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