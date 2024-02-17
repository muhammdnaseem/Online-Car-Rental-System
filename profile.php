<?php
session_start();
error_reporting(0);
include('includes/config.php');

function uploadImage($image)
  {
      $imageName = $image['name'];
      $splitImage = explode('.',$imageName);
      $ext = strtolower(end($splitImage));
      if(in_array($ext,['jpg','jpeg','png']))
      {
          $newName = hexdec(uniqid()).'.'.$ext;
          $uploadPath = 'uploads/'.$newName;
          if(move_uploaded_file($image['tmp_name'],'../'.$uploadPath))
          {
              return $uploadPath;
          }
      }
      else
      {
          echo "<script>alert('Warning! We accept (jpg,jpeg or png) file only');</script>";
      }
  }


if(strlen($_SESSION['email'])==0)
{ 
  header('location:index.php');
}
else{
  if(isset($_POST['updateprofile']))
  {
    $name=$_POST['fullname'];
    $mobileno=$_POST['mobilenumber'];
    $dob=$_POST['dob'];
    $adress=$_POST['address'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $email=$_SESSION['email'];
    $image=$_FILES['uimage'];
    $updationDate = date('Y-m-d');

    

    if($image['size'] > 0)
    {
    
      $profileImage = uploadImage($image);

      $sql="UPDATE users SET fullName='$name',contactNo='$mobileno',dob='$dob',address='$adress',city='$city',country='$country',updationDate='$updationDate',userImage='$profileImage' where email='$email'";
    }
    else
    {
      $sql="UPDATE users SET fullName='$name',contactNo='$mobileno',dob='$dob',address='$adress',city='$city',country='$country',updationDate='$updationDate' where email='$email'";
    }
    // echo $sql;exit;
    $result = mysqli_query($db,$sql);
    
    if(mysqli_affected_rows($db) > 0)
    {
      echo "<script>alert('Profile Updated Successfully')</script>";
    }
    else
    {
      echo "<script>alert('Something Went Wrong! Profile Cann't Updated.')</script>";
    }
    
  }


  

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Medina Transport Company | My Profile</title>
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
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
      .succWrap{
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
    </style>
  </head>

  <body id="body">
    <?php include('includes/header.php');?>
    <section id="innerBanner"> 
      <div class="inner-content">
        <h2><span>My Profile</span><br>We create the opportunities!</h2>
        <div> 
        </div>
      </div> 
    </section><!-- #Page Banner -->

    <main id="main">
      <?php 
      $useremail=$_SESSION['email'];
      $sql = "SELECT * from users where email='$useremail'";
      
      $results=mysqli_query($db,$sql);

      $cnt=1;
      if(mysqli_num_rows($results) > 0)
      {
        foreach($results as $result)
        { 
          ?>
          <section class="user_profile inner_pages">
            <div class="container">
              <div class="user_profile_info gray-bg padding_4x4_40">
                <div class="upload_user_logo"> <img src="<?= $result['userImage'] ?>" alt="image">
                </div>

                <div class="dealer_info">
                  <h5><?php echo htmlentities($result['fullName']);?></h5>
                  <p><?php echo htmlentities($result['address']);?><br>
                    <?php echo htmlentities($result['city']);?>&nbsp;<?php echo htmlentities($result['country']);?></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <?php include('includes/sidebar.php');?>
                    <div class="col-md-6 col-sm-8">
                      <div class="profile_wrap">
                        <h5 class="uppercase underline">General Settings</h5>
                        <?php  
                        if($msg)
                        {
                          ?>
                          <div class="succWrap">
                            <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
                          </div>
                          <?php
                        }?>
                        <form  method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label class="control-label">Reg Date -</label>
                            <?php echo htmlentities($result['regDate']);?>
                          </div>
                          <?php if($result['updationDate'] != "")
                          {
                            ?>
                            <div class="form-group">
                              <label class="control-label">Last Update at  -</label>
                              <?php echo htmlentities($result['updationDate']);?>
                            </div>
                            <?php 
                          } ?>
                          <div class="form-group">
                            <label class="control-label">Full Name</label>
                            <input class="form-control white_bg" name="fullname" value="<?php echo htmlentities($result['fullName']);?>" id="fullname" type="text"  required>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Email Address</label>
                            <input class="form-control white_bg" value="<?php echo htmlentities($result['email']);?>" name="emailid" id="email" type="email" required readonly>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Phone Number</label>
                            <input class="form-control white_bg" name="mobilenumber" value="<?php echo htmlentities($result['contactNo']);?>" id="phone-number" type="text" required>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Date of Birth&nbsp;(dd/mm/yyyy)</label>
                            <input class="form-control white_bg" value="<?php echo htmlentities($result['dob']);?>" name="dob" placeholder="dd/mm/yyyy" id="birth-date" type="text" >
                          </div>
                          <div class="form-group">
                            <label class="control-label">Your Address</label>
                            <textarea class="form-control white_bg" name="address" rows="4" ><?php echo htmlentities($result['address']);?></textarea>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Country</label>
                            <input class="form-control white_bg"  id="country" name="country" value="<?php echo htmlentities($result['country']);?>" type="text">
                          </div>
                          <div class="form-group">
                            <label class="control-label">City</label>
                            <input class="form-control white_bg" id="city" name="city" value="<?php echo htmlentities($result['city']);?>" type="text">
                          </div>
                          <div class="form-group">
                            <label class="control-label">Profile Image</label>
                            <input class="form-control white_bg" id="uimage" name="uimage" type="file">
                          </div>


                          <div class="form-group">
                            <button type="submit" name="updateprofile" class="btn btn-primary"  style="background-color: #49a3ff;"  >Save Changes <span class="angle_arrow"><i class="fa fa-angle-right"  style="color: #49a3ff;"  aria-hidden="true"></i></span></button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <?php 
            }
          } ?>
          <!--/Profile-setting--> 
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
        <!--/Forgot-password-Form --> 

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
