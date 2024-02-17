<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Medina Transport Company | About Us</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta content="Author" name="WebThemez">
  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet"> 
</head>

<body id="body"> 
 <?php include('includes/header.php');?>
 <section id="innerBanner"> 
  <div class="inner-content">
    <h2><span>About Us</span><br>We provide high quality cars</h2>
    <div> 
    </div>
  </div> 
</section><!-- #Page Banner -->

<main id="main">
      <section id="about" class="wow fadeInUp">
        <div class="container"> 
          <div class="row">
            <div class="col-lg-6 about-img">
              <img src="img/about.jpg" alt="">
            </div>

            <div class="col-lg-6 content">
              <h2>Welcome to Medina Transport Company</h2>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.

On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
              <ul>
                <li><i class="icon ion-ios-checkmark-outline"></i>Matrimonial</li>
                <li><i class="icon ion-ios-checkmark-outline"></i>Events</li>
                <li><i class="icon ion-ios-checkmark-outline"></i>Tourism</li>
              </ul> 
            </div>
          </div>

        </div>
      </section><!-- #about -->
    </main>
    <?php include('includes/driverModel.php'); ?>
    <?php include('includes/footer.php');?>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!--Login-Form -->
    <?php include('includes/login.php');?>
    <!--/Login-Form --> 
    
    
    <!--Register-Form -->
    <?php include('includes/registration.php');?>
    <!--/Register-Form --> 
    <!--Conditions Modal -->
    <?php include('includes/conditions.php');?>
    <!--/Conditions Modal --> 
    
    <!--Forgot-password-Form -->
    <?php include('includes/forgotpassword.php');?>

    <!-- JavaScript  -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/magnific-popup/magnific-popup.min.js"></script>
    <script src="lib/sticky/sticky.js"></script> 
    <script src="contact/jqBootstrapValidation.js"></script>
    <script src="contact/contact_me.js"></script>
    <script src="js/main.js"></script>
    <script src="js/driver.js"></script>
    <script>
  $(document).ready(function(){
    $('#loginBtn').click(function(){
      $('#loginform').modal('show');
    })
    $('#regBtn').click(function(){
      $('#signupform').modal('show');
    })
  });
</script>
  </body>
  </html>
