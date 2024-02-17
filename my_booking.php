<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['email'])==0)
{ 
  header('location:index.php');
}
else{
  if(isset($_GET['action']) && $_GET['action'] == 'cancelBooking')
  {
    $bookingNo = $_GET['bookingNo'];
    $sql = "UPDATE bookings SET bookingStatus='cancel' WHERE bookingNumber='$bookingNo'";
    if(mysqli_query($db,$sql))
    {
      ?>
      <script>
        alert('Your Booking Request Has Been Cancelled successfully');
      </script>
      <?php
    }
  }
  else if(isset($_GET['action']) && $_GET['action'] == 'cancelReserve'){

    $reserveNo = $_GET['reserveNo'];
    $sql = "UPDATE reserve SET reserveStatus='cancel' WHERE reserveNumber='$reserveNo'";
    if(mysqli_query($db,$sql))
    {
      ?>
      <script>
        alert('Your Reserve Request Has Been Cancelled successfully');
      </script>
      <?php
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Car Rental Portal | My Booking</title>
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
      <h2><span>My Bookings</span><br>We create the opportunities!</h2>
      <div> 
      </div>
    </div> 
  </section><!-- #Page Banner -->

  <main id="main">
   <?php 
   $email=$_SESSION['email'];
   $sql = "SELECT * from users where email='$email'";

   $results=mysqli_query($db,$sql);
   $cnt=1;
   if(mysqli_num_rows($results) > 0)
   {
    foreach($results as $result)
      { ?>
        <section class="user_profile inner_pages">
          <div class="container">
            <div class="user_profile_info gray-bg padding_4x4_40">
              <div class="upload_user_logo"> <img src="<?= $result['userImage'] ?>" alt="image">
              </div>

              <div class="dealer_info">
                <h5><?php echo htmlentities($result['fullName']);?></h5>
                <p><?php echo htmlentities($result['address']);?><br>
                  <?php echo htmlentities($result['city']);?>&nbsp;<?php echo htmlentities($result['country']);
                }
              }?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-3">
             <?php include('includes/sidebar.php');?>

             <div class="col-md-8 col-sm-8">
              <div class="profile_wrap">
                <h5 class="uppercase underline">My Bookings </h5>
                <div class="my_vehicles_list">
                  <ul class="vehicle_listing">
                    <?php 
                    $uid=$_SESSION['userId'];
                    $sql = "SELECT registeredcars.imageOne as Vimage1,registeredcars.carName,registeredcars.id as vid,brands.brand_name,bookings.id,bookings.fromDate,bookings.toDate,bookings.message,bookings.bookingStatus,registeredcars.pricePerDay,DATEDIFF(bookings.toDate,bookings.fromDate) as totaldays,bookings.bookingNumber from bookings join registeredcars on bookings.vehicleId=registeredcars.id join brands on brands.id=registeredcars.brandId where bookings.userId='$uid' ORDER BY bookings.id DESC";
                    
                    $results=mysqli_query($db,$sql);

                    $sql2 = "SELECT registeredcars.imageOne as Vimage1,registeredcars.carName,registeredcars.id as vid,brands.brand_name,reserve.id,reserve.fromLocation,reserve.toLocation,reserve.message,reserve.reserveStatus,registeredcars.pricePerDay,DATEDIFF(reserve.toLocation,reserve.fromLocation) as totaldays,reserve.reserveNumber from reserve join registeredcars on reserve.vehicleId=registeredcars.id join brands on brands.id=registeredcars.brandId where reserve.userId='$uid' ORDER BY reserve.id DESC";
                    

                    $results2=mysqli_query($db,$sql2);

         

                    $cnt=1;

                    if(mysqli_num_rows($results) > 0)
                    {
                      foreach($results as $result)
                      {  
                        ?>

                        <li>
                          <h4 style="color:red">Booking No. &nbsp;<?php echo htmlentities($result['bookingNumber']);?></h4>
                          <div class="vehicle_img"> <a href="car_details.php?vhid=<?php echo htmlentities($result['vid']);?>"><img src="<?php echo htmlentities($result['Vimage1']);?>" alt="image"></a> </div>
                          <div class="vehicle_title">

                            <h6><a href="car_details.php?vhid=<?php echo htmlentities($result['vid']);?>"> <?php echo htmlentities($result['brand_name']);?> , <?php echo htmlentities($result['carName']);?></a></h6>
                            <p><b>From </b> <?php echo htmlentities(date('d-m-Y',strtotime($result['fromDate'])));?> <b>To </b> <?php echo htmlentities(date('d-m-Y',strtotime($result['toDate'])));?></p>
                            <div style="float: left"><p><b>Message:</b> <?php echo htmlentities($result['message']);?> </p></div>
                          </div>
                          <?php if($result['bookingStatus']=='confirm')
                          { ?>
                            <div class="vehicle_status"> <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
                             <div class="clearfix"></div>
                           </div>

                           <?php 
                         } else if($result['bookingStatus']=='cancel') { ?>
                           <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Cancelled</a>
                            <div class="clearfix"></div>
                          </div>
                          <?php 
                        } else { ?>
                         <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Not Confirm yet</a><br><br>
                         <a href="?action=cancelBooking&bookingNo=<?= $result['bookingNumber']; ?>" onclick="return confirm('Do you want to cancel your booking request?')" class="btn btn-danger btn-xs">Cancel Booking</a>
                          <div class="clearfix"></div>
                        </div>
                        <?php 
                      } ?>

                    </li>

                    <h5 style="color:blue">Invoice</h5>
                    <table>
                      <tr>
                        <th>Car Name</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Total Days</th>
                        <th>Rent / Day</th>
                      </tr>
                      <tr>
                        <td><?php echo htmlentities($result['carName']);?>, <?php echo htmlentities($result['brand_name']);?></td>
                        <td><?php echo htmlentities($result['fromDate']);?></td>
                        <td> <?php echo htmlentities($result['toDate']);?></td>
                        <td><?php echo htmlentities($tds=$result['totaldays']);?></td>
                        <td> <?php echo htmlentities($ppd=$result['pricePerDay']);?></td>
                      </tr>
                      <tr>
                        <th colspan="4" style="text-align:center;"> Grand Total</th>
                        <th><?php echo htmlentities($tds*$ppd);?></th>
                      </tr>
                    </table>
                    <hr />
                    <?php 
                  }
                }  else if(mysqli_num_rows($results2) > 0) {

                  foreach($results2 as $result)
                      {  
                        ?>

                        <li>
                          <h4 style="color:red">Booking No. &nbsp;<?php echo htmlentities($result['reserveNumber']);?></h4>
                          <div class="vehicle_img"> <a href="car_details.php?vhid=<?php echo htmlentities($result['vid']);?>"><img src="<?php echo htmlentities($result['Vimage1']);?>" alt="image"></a> </div>
                          <div class="vehicle_title">

                            <h6><a href="car_details.php?vhid=<?php echo htmlentities($result['vid']);?>"> <?php echo htmlentities($result['brand_name']);?> , <?php echo htmlentities($result['carName']);?></a></h6>
                            <p><b>From </b> <?php echo htmlentities(date('d-m-Y',strtotime($result['fromDate'])));?> <b>To </b> <?php echo htmlentities(date('d-m-Y',strtotime($result['toDate'])));?></p>
                            <div style="float: left"><p><b>Message:</b> <?php echo htmlentities($result['message']);?> </p></div>
                          </div>
                          <?php if($result['reserveStatus']=='confirm')
                          { ?>
                            <div class="vehicle_status"> <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
                             <div class="clearfix"></div>
                           </div>

                           <?php 
                         } else if($result['reserveStatus']=='cancel') { ?>
                           <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Cancelled</a>
                            <div class="clearfix"></div>
                          </div>
                          <?php 
                        } else { ?>
                         <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Not Confirm yet</a><br><br>
                         <a href="?action=cancelReserve&reserveNo=<?= $result['reserveNumber']; ?>" onclick="return confirm('Do you want to cancel your reserve request?')" class="btn btn-danger btn-xs">Cancel reserve</a>
                          <div class="clearfix"></div>
                        </div>
                        <?php 
                      } ?>

                    </li>

                    <h5 style="color:blue">Invoice</h5>
                    <table>
                      <tr>
                        <th>Car Name</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Total Days</th>
                        <th>Rent / Day</th>
                      </tr>
                      <tr>
                        <td><?php echo htmlentities($result['carName']);?>, <?php echo htmlentities($result['brand_name']);?></td>
                        <td><?php echo htmlentities($result['fromLocation']);?></td>
                        <td> <?php echo htmlentities($result['toLocation']);?></td>
                        <td><?php echo htmlentities($tds=$result['totaldays']);?></td>
                        <td> <?php echo htmlentities($ppd=$result['pricePerDay']);?></td>
                      </tr>
                      <tr>
                        <th colspan="4" style="text-align:center;"> Grand Total</th>
                        <th><?php echo htmlentities($tds*$ppd);?></th>
                      </tr>
                    </table>
                    <hr />
                    <?php 
                  }
                  
                  
                } 
                else { ?>
                  <h5 align="center" style="color:red">No booking yet</h5>
                  <?php 
                } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="call-to-action" class="wow fadeInUp">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 text-center text-lg-left">
          <h3 class="cta-title">Get Our Service</h3>
          <!-- <p class="cta-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt fugiat culpa esse aute nulla cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
        </div>
        <div class="col-lg-3 cta-btn-container text-center">
          <a class="cta-btn align-middle" href="#contact">Contact Us</a>
        </div>
      </div>

    </div>
  </section><!-- #call-to-action -->
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
<?php 
} ?>
