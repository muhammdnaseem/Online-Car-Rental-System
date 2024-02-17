<?php
session_start();
error_reporting(0);
include('includes/config.php');

date_default_timezone_set('Asia/karachi');

if (isset($_POST['submit_form1'])) {
    // Handle Form 1 submission
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    if (isset($_POST['driver'])) {
        $driver = 'yes';
    } else {
        $driver = 'no';
    }

    $message = $_POST['message'];
    $status = 0;
    $vhid = $_GET['vhid'];
    $uid = $_SESSION['userId'];
    $currentDate = date('Y-m-d');

    $bookingno = mt_rand(100000000, 999999999);
    $ret = "SELECT * FROM bookings where ('$fromdate' BETWEEN date(fromDate) and date(toDate) || '$todate' BETWEEN date(fromDate) and date(toDate) || date(fromDate) BETWEEN '$fromdate' and '$todate') and vehicleId='$vhid'";

    $results1 = mysqli_query($db, $ret);

    if (mysqli_num_rows($results1) == 0) {
        $sql = "INSERT INTO `bookings`(`bookingNumber`, `userId`, `vehicleId`,`driver`, `fromDate`, `toDate`, `message`, `bookingDate`) VALUES ('$bookingno','$uid','$vhid','$driver','$fromdate','$todate','$message','$currentDate')";

        $results = mysqli_query($db, $sql);

        $lastInsertId = mysqli_insert_id($db);

        if ($lastInsertId) {
            echo "<script>alert('Booking request send successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'my_booking.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "<script type='text/javascript'> document.location = 'car_list.php'; </script>";
        }
    } else {
        echo "<script>alert('Car already booked for these days');</script>";
        echo "<script type='text/javascript'> document.location = 'car_list.php'; </script>";
    }
} else if (isset($_POST['submit_form2'])) {
    // Handle Form 2 submission
    $selectfromlocation = $_POST['selectfromlocation'];
    $fromlocation = $_POST['fromlocation'];
    $selecttolocation = $_POST['selecttolocation'];
    $tolocation = $_POST['tolocation'];
    $reserve_message = $_POST['reserve_message'];

    $status = 0;
    $vhid = $_GET['vhid'];
    $currentDate = date('Y-m-d');
    $uid = $_SESSION['userId'];
    $reserveno = mt_rand(100000000, 999999999);
    

   

    
        $sql = "INSERT INTO `reserve`(`reserveNumber`, `userId`, `vehicleId`, `fromLocation`, `selectfromlocation`, `toLocation`, `selecttolocation`, `message`, `reserveDate`) VALUES ('$reserveno','$uid','$vhid','$fromlocation', '$selectfromlocation','$tolocation', '$selecttolocation', '$reserve_message','$currentDate')";

        $results = mysqli_query($db, $sql);

        $lastInsertId = mysqli_insert_id($db);

        if ($lastInsertId) {
            echo "<script>alert('Reserve request send successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'my_booking.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "<script type='text/javascript'> document.location = 'car_list.php'; </script>";
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Car Rental|Car Details</title>
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
    <h2><span>ABOUT CAR</span><br>We provide high quality and well serviced cars </h2>
    <div> 
    </div>
  </div> 
</section><!-- #Page Banner -->

<main id="main">
    <!--==========================
      Clients Section
      ============================-->
      <section id="clients"  class="wow fadeInUp">
        <div class="container">
          <div class="section-header">
            <h2>Car details</h2>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt fugiat culpa esse aute nulla. duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p> -->
          </div>
          <?php 
          $vhid=intval($_GET['vhid']);
          $sql = "SELECT registeredcars.*,brands.Brand_name,brands.id as bid  from registeredcars join brands on brands.id=registeredcars.brandId where registeredcars.id='$vhid'";
          
          $results = mysqli_query($db,$sql);
          
          $cnt=1;
          if(mysqli_num_rows($results) > 0)
          {
            foreach($results as $result)
            {  
              $_SESSION['brndid']=$result['bid'];  
              ?>  
              <div class="owl-carousel clients-carousel">
                <img src="<?php echo htmlentities($result['imageOne']);?>" alt="" style="height: 150px; width:300px;">
                <img src="<?php echo htmlentities($result['imageTwo']);?>" alt="" style="height: 150px; width: 300px;">
                <img src="<?php echo htmlentities($result['imageThree']);?>" alt="" style="height: 150px; width: 300px;">
                <img src="<?php echo htmlentities($result['imageFour']);?>" alt="" style="height: 150px; width: 300px;">
                <img src="<?php echo htmlentities($result['imageFive']);?>" alt="" style="height: 150px; width: 300px;">
              </div>
            </div>
          </section><!-- #clients -->

          <!--Listing-detail-->
          <section class="listing-detail">
            <div class="container">
              <div class="listing_detail_head row">
                <div class="col-md-9">
                  <h2><?php echo htmlentities($result['brand_name']);?> , <?php echo htmlentities($result['carName']);?></h2>
                </div>
                <div class="col-md-3">
                  <div class="price_info">
                    <p>$<?php echo htmlentities($result['pricePerDay']);?> </p>Per Day

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <div class="main_features">
                    <ul>

                      <li> <i class="fa fa-calendar" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($result['makeYear']);?></h5>
                        <p>Reg.Year</p>
                      </li>
                      <li> <i class="fa fa-cogs" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($result['fuelType']);?></h5>
                        <p>Fuel Type</p>
                      </li>

                      <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($result['seatCapacity']);?></h5>
                        <p>Seats</p>
                      </li>
                    </ul>
                  </div>
                  <div class="listing_more_info">
                    <div class="listing_detail_wrap"> 
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs gray-bg" role="tablist">
                        <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" style="background-color: #49a3ff;" data-toggle="tab">Vehicle Overview </a></li>

                        <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content"> 
                        <!-- vehicle-overview -->
                        <div role="tabpanel" class="tab-pane active" id="vehicle-overview">

                          <p><?php echo htmlentities($result['carDesc']);?></p>
                        </div>


                        <!-- Accessories -->
                        <div role="tabpanel" class="tab-pane" id="accessories"> 
                          <!--Accessories-->
                          <table>
                            <thead>
                              <tr>
                                <th colspan="2">Accessories</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Air Conditioner</td>
                                <?php if($result['airConditioner']=='on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                  <?php 
                                } else { ?> 
                                 <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                 <?php 
                               } ?> </tr>

                               <tr>
                                <td>AntiLock Braking System</td>
                                <?php if($result['ABS']=='on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else {?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>Power Steering</td>
                                <?php if($result['powerSteering'] =='on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>


                              <tr>

                                <td>Power Windows</td>

                                <?php if($result['powerWindow'] == 'on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>CD Player</td>
                                <?php if($result['cdPlayer'] == 'on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>Leather Seats</td>
                                <?php if($result['leatherSeats'] == 'on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>Central Locking</td>
                                <?php if($result['centralLocking'] == 'on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>Power Door Locks</td>
                                <?php if($result['powerLockDoor'] =='on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>
                              <tr>
                                <td>Brake Assist</td>
                                <?php if($result['breakAssist'] == 'on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php  } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>Driver Airbag</td>
                                <?php if($result['driverAirbag'] == 'on')
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                               <td>Passenger Airbag</td>
                               <?php if($result['passengerAirbag'] =='on')
                               {
                                ?>
                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                              <?php } else {?>
                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                              <?php } ?>
                            </tr>

                            <tr>
                              <td>Crash Sensor</td>
                              <?php if($result['crashSensor']=='on')
                              {
                                ?>
                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php 
                              } else { ?>
                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php
                              } ?>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
                <?php 
              }
            } ?>

          </div>

          <!--Side-Bar-->
          <aside class="col-md-3">

            
            <div class="sidebar_widget">
              <div class="widget_heading">
                <h5><i class="fa fa-envelope" aria-hidden="true"></i>Reserve Now</h5>
              </div>
              <form method="post">
                <div class="form-group">
                  <label class="from-label">From Location:</label>
                  <select class="form-control from-selection" name="selectfromlocation">
                    <option selected disabled>
                      Select Pickup Location
                    </option>
                    <option value="Makkah">
                      Makkah
                    </option>
                    <option value="Madina">
                      Madina
                    </option>
                    <option value="ziarat">
                      ziarat
                    </option>
                  </select>

                  <label class="from-label-manually">Or Type Manually:</label>
                  <input type="text" class="form-control from-manually" name="fromlocation" placeholder="From Location" required id="fromLocation">
                  
                </div>
                <div class="form-group">

                  <label class="mt-2 to-label">To Location:</label>
                  <select class="form-control to-selection" name="selecttolocation">
                    <option selected disabled>
                      Select Destination
                    </option>
                    <option value="Makkah">
                      Makkah
                    </option>
                    <option value="Madina">
                      Madina
                    </option>
                    <option value="ziarat">
                      ziarat
                    </option>
                  </select>


                  <label class="to-label-manually">Or Type Manually:</label>
                  <input type="text" class="form-control to-manually" name="tolocation" placeholder="To Location" id="toLocation" required>
                  
                </div>
                
                <div class="form-group">
                  <textarea rows="4" class="form-control" name="reserve_message" placeholder="Message" required></textarea>
                </div>
               
                  <?php if($_SESSION['email'])
                {?>
                  <div class="form-group">
                    <input type="submit" class="btn" style="background-color: #49a3ff;"  name="submit_form2" value="Reserve Now">
                  </div>
                  <?php 
                } else { ?>
                  <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal" style="background-color: #49a3ff;">Login For Reserve</a>

                  <?php 
                } ?>
                
              </form>

              <br>
              <div class="widget_heading">
                <h5><i class="fa fa-envelope" aria-hidden="true"></i>Rent Now</h5>
              </div>
              <form method="post">
                <div class="form-group">
                  <label>From Date:</label>
                  <input type="date" class="form-control" name="fromdate" placeholder="From Date" required min="<?php echo date('Y-m-d') ?>" id="fromDate">
                </div>
                <div class="form-group">
                  <label>To Date:</label>
                  <input type="date" class="form-control" name="todate" placeholder="To Date" id="toDate" required>
                </div>
                <div class="form-group">
                  <label>Checked box bellow if you need driver:</label>
                  <label for="driver">
                  <input type="checkbox" class="form-box" value="yes" name="driver" id="driver"> Driver </label>
                </div>
                <div class="form-group">
                  <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
                </div>
                <?php if($_SESSION['email'])
                {?>
                  <div class="form-group">
                    <input type="submit" class="btn" style="background-color: #49a3ff;"  name="submit_form1" value="Book Now">
                  </div>
                  <?php 
                } else { ?>
                  <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal" style="background-color: #49a3ff;">Login For Rent</a>

                  <?php 
                } ?>
              </form>
            </div>
          </aside>
          <!--/Side-Bar--> 
        </div>

        <div class="space-20"></div>
        <div class="divider"></div>

        <!--Similar-Cars-->
        <div class="similar_cars">
          <h3>Similar Cars</h3>
          <div class="row">
            <?php 
            $bid=$_SESSION['brndid'];
            $sql="SELECT registeredcars.carName,brands.brand_name,registeredcars.pricePerDay,registeredcars.fuelType,registeredcars.makeYear,registeredcars.id,registeredcars.seatCapacity,registeredcars.carDesc,registeredcars.imageOne from registeredcars join brands on brands.id=registeredcars.brandId where registeredcars.brandId='$bid'";

            $results=mysqli_query($db,$sql);
            $cnt=1;
            if(mysqli_num_rows($results) > 0)
            {
              foreach($results as $result)
              { 
                ?>      
                <div class="col-md-3 grid_listing">
                  <div class="product-listing-m gray-bg">
                    <div class="product-listing-img"> <a href="car_details.php?vhid=<?php echo htmlentities($result['id']);?>"><img src="<?php echo htmlentities($result['imageOne']);?>" class="img-responsive" style="height: 200px; width: 360px;" alt="image" /> </a>
                    </div>
                    <div class="product-listing-content">
                      <h5><a href="car_details.php?vhid=<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['brand_name']);?> , <?php echo htmlentities($result['carName']);?></a></h5>
                      <p class="list-price">$<?php echo htmlentities($result['pricePerDay']);?></p>

                      <ul class="features_list">

                       <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result['seatCapacity']);?> seats</li>
                       <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result['makeYear']);?> model</li>
                       <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result['fuelType']);?></li>
                     </ul>
                   </div>
                 </div>
               </div>
               <?php 
             }
           } ?>       

         </div>
       </div>
       <!--/Similar-Cars--> 

     </div>
   </section>
   <!--/Listing-detail--> 

    <!--==========================
      Call To Action Section
      ============================-->
      <section id="call-to-action" class="wow fadeInUp">
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
    $(document).on('change','#fromDate',function(){
      var fromDate = $(this).val();
      $('#toDate').attr('min',fromDate);
    })


    $('.from-selection').change(function() {
    var selectedValue = $(this).val();
    var fromManually = $('.from-manually');

    if (selectedValue === 'Select Pickup Location') {
      fromManually.removeClass('d-none');
      fromManually.prop('required', true);
    } else {
      fromManually.addClass('d-none');
      fromManually.prop('required', false);
      $('.from-label-manually').addClass('d-none');
    }
  });

    $('.from-manually').change(function() {
    var selectedValue = $(this).val();
    var fromManually = $('.from-selection');

    if (selectedValue === "") {
      fromManually.removeClass('d-none');
      fromManually.prop('required', true);
    } else {
      fromManually.addClass('d-none');
      fromManually.prop('required', false);
      $('.from-label').addClass('d-none');
    }
  });



    $('.to-selection').change(function() {
    var selectedValue = $(this).val();
    var toManually = $('.to-manually');

    if (selectedValue === 'Select Destination') {
      toManually.removeClass('d-none');
      toManually.prop('required', true);
    } else {
      toManually.addClass('d-none');
      toManually.prop('required', false);
      $('.to-label-manually').addClass('d-none');
    }
  });

    $('.to-manually').change(function() {
    var selectedValue = $(this).val();
    var toManually = $('.to-selection');

    if (selectedValue === "") {
      toManually.removeClass('d-none');
      toManually.prop('required', true);
    } else {
      toManually.addClass('d-none');
      toManually.prop('required', false);
      $('.to-label').addClass('d-none');
    }
  });

  });
</script>
  </body>
  </html>
