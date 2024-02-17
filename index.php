<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (isset($_SESSION['success'])) {
  unset($_SESSION['success']);
  echo "<script>alert('Request sent successfull. We will contact you through your Email address.')</script>";
} else if (isset($_SESSION['error']) && $_SESSION['error'] == 'Something went wrong. Please try again.') {
  unset($_SESSION['error']);
  echo "<script>alert('Something went wrong. Please try again.')</script>";
} else if (isset($_SESSION['error']) && $_SESSION['error'] == 'Sorry! You have already apply with this Email.') {
  unset($_SESSION['error']);
  echo "<script>alert('Sorry! You have already apply with this Email.')</script>";
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

  <link rel="stylesheet" href="driver/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="driver/css/animate.css">

  <link rel="stylesheet" href="driver/css/owl.carousel.min.css">
  <link rel="stylesheet" href="driver/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="driver/css/magnific-popup.css">

  <link rel="stylesheet" href="driver/css/aos.css">

  <link rel="stylesheet" href="driver/css/ionicons.min.css">

  <link rel="stylesheet" href="driver/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="driver/css/jquery.timepicker.css">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="driver/css/flaticon.css">
  <link rel="stylesheet" href="driver/css/icomoon.css">
  <link rel="stylesheet" href="driver/css/style.css">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/font/font-awesome.css" rel="stylesheet" />
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/slick.css" rel="stylesheet">
  <style type="text/css">
    
.home-image{
  width: 30%;
  height: 450px;
  padding-left: 20px;
  border-radius: 50%;
}
.home-image:hover{
  border-radius: 0;
}

.home{
  width: 100%;
}
.home p {
  text-align: justify;
  font-size: 25px;
  color: black;
  margin: 0 auto; /* Centers the paragraph within the specified width */
}

.why-title{
  text-align: center;
  font-size: 35px;
  font-weight: 900;
  color: black;
  margin: 0 auto;
  border: 5px solid skyblue;
}
.why-title:hover{
  color: white;
  background-color: skyblue;
}
.home ul{
  text-align: center;
}
.home ul li{
  font-size: 25px;
  color: black;
  text-align: justify;
  font-family: PT sans;
  font-weight: 700;
  line-height: 150%;
}


iframe{
  min-width: 350%;
  margin-left: -120%;
  height: 620px;
}
 @media (max-width: 500px) {
  .home-image{
  width: 100%;
  
}
  iframe{
  min-width: 100%;
  margin-left: 0%;
  height: 320px;
}
.home{
  width: 100%;
}
.why-title{
  font-size: 25px;
  font-weight: 600;
  border: 4px solid skyblue;
}
.video-content{
  padding-left: 0px;
  width: 100%;
 }
 }  
 .off{
  font-weight: 1000;
 }
 .video-content{
  padding-left: 20px;
  width: 95%;
  border-left: 5px solid black;
  font-family: PT sans;
  font-weight: 700;
  line-height: 150%;
 }
  </style>
</head>

<body id="body">
  <?php include('includes/header.php'); ?>

  <section id="hero" class="clearfix">
    <div class="container">

     <!--  <div class="hero-banner">
      </div> -->
<!-- Trigger the modal with a button -->






<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title ml-auto mr-5">Good News!!!</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p class="text-center">Every customer will get <span class="off">10%</span> Off...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
     
       <!--  <div>
          <?php if (strlen($_SESSION['email']) == 0) {
          ?>
            
          <?php
          } ?>
        </div> -->
      

    </div>
  </section><!-- #Hero -->

  <main id="main">
    <!--==========================
      Services Section
      ============================-->
    <section id="services">
      <div class="container">
        <div class="section-header">
          <h2>Find the Best Car for you</h2>
          <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt fugiat culpa esse aute nulla. malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p> -->
        </div>

        <div class="row">
          
          <?php $sql = "SELECT registeredcars.carName,brands.Brand_name,registeredcars.pricePerDay,registeredcars.fuelType,registeredcars.makeYear,registeredcars.id,registeredcars.seatCapacity,registeredcars.carDesc,registeredcars.imageOne from registeredcars join brands on brands.id=registeredcars.brandId order by rand() limit 9 ";

          $results = mysqli_query($db, $sql);
          $cnt = 1;
          if (mysqli_num_rows($results) > 0) {
            foreach ($results as $result) {
          ?>
              <div class="col-lg-4 ">
                <div class="box wow fadeInLeft">
                  <div class="car-info-box">
                    <a href="car_details.php?vhid=<?php echo htmlentities($result['id']); ?>"><img src="<?php echo htmlentities($result['imageOne']); ?>" style="height: 180px; width: 280px;" class="img-responsive" alt="image">
                    </a>
                    <ul style=" width: 280px;">
                      <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result['fuelType']); ?></li>
                      <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result['makeYear']); ?> Model</li>
                      <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->seatCapacity); ?> seats</li>
                    </ul>
                    <div class="car-title-m">
                      <h6><a href="car_details.php?vhid=<?php echo htmlentities($result['id']); ?>"> <?php echo substr($result['carName'], 0, 21); ?></a>
                      </h6>
                      <span class="price">Book Now</span>
                      <br>
                      <h6>
                        On Rent 
                      </h6>
                      <span class="price">SR<?php echo htmlentities($result['pricePerDay']); ?> /Day</span>
                    </div>
                    <div class="inventory_info_m ">
                      <p><?php echo substr($result['carDesc'], 0, 70); ?></p>
                    </div>
                  </div>
                </div>
              </div>
          <?php
            }
          } ?>
        </div>
      </div>
    </section><!-- #services -->




<div id="app" class="container saudi-images">
  <img src="img/King_AbdulAziz_of_Saudia.png" class="home-image wow fadeInLeft">
  <img src="img/hrh-mohammed-bin-salman.webp" class="home-image wow fadeInDown">
  <img src="img/Crown_Prince_Salman_June_2012_SPA.jpg" class="home-image wow fadeInRight">
</div>
    <!--==========================
      Clients Section
      ============================-->
    <!-- <section id="clients" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Clients</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt fugiat culpa esse aute nulla. duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="owl-carousel clients-carousel">
          <img src="img/clients/client-1.png" alt="">
          <img src="img/clients/client-2.png" alt="">
          <img src="img/clients/client-3.png" alt="">
          <img src="img/clients/client-4.png" alt="">
          <img src="img/clients/client-5.png" alt="">
          <img src="img/clients/client-6.png" alt="">
        </div>

      </div>
    </section>#clients -->
<section id="video" class="wow fadeInLeft mt-4">
  <div class="container d-flex justify-content-center">
    <div class="row">
      <div class="col-sm-12 order-first text-center">
        <div class="card">
          <iframe src="https://www.youtube.com/embed/kQbHOza9k3A" title="Player One" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="container home mt-3 wow fadeInRight">
  <p class="video-content">
    Medina Transport Company is a leading provider of taxi services in Saudi Arabia, distinguished by its commitment to delivering a trifecta of premium quality, affordability, and reliability. With a focus on ensuring passenger comfort and safety, the company boasts a fleet of well-maintained vehicles equipped with modern amenities, offering a superior travel experience. Beyond standard taxi services, Medina Transport Company takes pride in its specialization in Hajj and Umrah transport services, recognizing the spiritual importance of these journeys. The company facilitates a seamless and secure pilgrimage experience, providing dedicated transportation services tailored to the unique needs of pilgrims.
Furthermore, Medina Transport Company goes the extra mile by offering comprehensive packages that cover the entire transportation journey, from convenient pick-ups to timely drop-offs. This holistic approach reflects the company’s commitment to meeting the diverse needs of its customers, ensuring a hassle-free and enjoyable travel experience for both locals and visitors in Saudi Arabia.
  </p>
</div>

<div class="container home mt-3 wow fadeInUp">
  <h2 class="why-title">Why Medina Transport Company</h2>
  <ul class="mt-3">
    <li>
      Premium Service
    </li><li>
Affordability
</li><li>
Reliability
</li><li>
Hajj and Umrah Specialization
</li><li>
Comprehensive Packages
</li><li>
Customer-Centric Approach
</li><li>
Technological Integration
    </li>
  </ul>
</div>



    <section id="call-to-action" class="wow fadeInUp mt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Get Our Service</h3>
            <!-- <p class="cta-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt fugiat culpa esse aute nulla cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="contact.php">Contact Us</a>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action -->


  </main>

  <!--==========================
    Footer
    ============================-->

  <?php include('includes/driverModel.php'); ?>

  <?php include('includes/footer.php'); ?>
  <!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


  <!--Login-Form -->
  <?php include('includes/login.php'); ?>
  <!--/Login-Form -->



  <!--Register-Form -->
  <?php include('includes/registration.php'); ?>
  <!--/Register-Form -->
  <!--Conditions Modal -->
  <?php include('includes/conditions.php'); ?>

  <!--/Conditions Modal -->

  <!--Forgot-password-Form -->
  <?php include('includes/forgotpassword.php'); ?>
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
  <script src="js/slick.js"></script>



<script type="text/javascript">
 
</script>



  <script>
    $(document).ready(function() {
      $('#loginBtn').click(function() {
        $('#loginform').modal('show');
      })
      $('#regBtn').click(function() {
        $('#signupform').modal('show');
      })

      $('.slick').slick();

      setTimeout(function () {
        $('#myModal').modal('show');
      }, 3000);
      
    });


  </script>
</body>

</html>