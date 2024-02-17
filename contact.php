<?php 
session_start();
include('includes/config.php');
error_reporting(0);
$company_detail = mysqli_query($db,"SELECT * FROM companyprofile");
$info = mysqli_fetch_assoc($company_detail);

if(isset($_POST['submit']))
{
  $fullName = $_POST['fullName'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $sendOn = date('Y-m-d H:i:s a');

  $sql = "INSERT INTO `contacts`(`fullName`, `email`, `message`, `dateTime`) VALUES ('$fullName','$email','$message','$sendOn')";
  if(mysqli_query($db,$sql))
  {
    echo "<script>alert('Your message has been sent successfully');</script>";
  }
  else
  {
    echo "<script>alert('Message sending failed try again');</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Car rental portal</title>
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
    <h2><span>Contact</span><br>We simplify your journey!</h2>
    <div> 
    </div>
  </div> 
</section><!-- #Page Banner -->

<main id="main">

    <!--==========================
      Contact Section
      ============================-->
      <section id="contact" class="wow fadeInUp">
        <div class="container">
          <div class="section-header"> 
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt fugiat culpa esse aute nulla. malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p> -->
          </div>

          <div class="row contact-info">
           <div class="col-lg-5"> 
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address><?= $info['companyAddress'] ?></address>
            </div> 
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:<?= $info['companyphone'] ?>"><?= $info['companyphone'] ?></a></p>
            </div> 
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p>
                <a href="mailto:<?= $info['companyEmail'] ?>"><?= $info['companyEmail'] ?></a>
              </p>
            </div> 
          </div>
          <div class="col-lg-7">
            <div class="container">
              <div class="form"> 

               <!-- Form itself -->
               <form method="post" class="well" validate> 
                 <div class="control-group">
                   <div class="form-group">
                     <input type="text" class="form-control" 
                     placeholder="Full Name" name="fullName" id="fullName" required
                     data-validation-required-message="Please enter your name" />
                     <p class="help-block"></p>

                   </div>
                 </div> 	
                 <div class="form-group">
                  <div class="controls">
                   <input type="email" class="form-control" placeholder="Email" 
                   id="email" name="email" required
                   data-validation-required-message="Please enter your email" />
                 </div>
               </div> 	

               <div class="form-group">
                 <div class="controls">
                   <textarea rows="10" cols="100" class="form-control" 
                   placeholder="Message" id="message" name="message" required
                   data-validation-required-message="Please enter your message" minlength="5" 
                   data-validation-minlength-message="Min 5 characters" 
                   maxlength="999" style="resize:none"></textarea>
                 </div>
               </div> 		 
               <div id="success"> </div> <!-- For success/fail messages -->
               <button type="submit" name="submit" class="btn btn-primary pull-right">Send</button><br />
             </form>
           </div>

         </div>
       </div>
     </div>
   </div>

 </section><!-- #contact -->

</main>
<?php include('includes/driverModel.php'); ?>
<?php include('includes/footer.php');?><!-- #footer -->

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
