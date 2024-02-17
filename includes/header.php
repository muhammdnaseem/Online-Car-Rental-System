
<header id="header" style="background: transparent;">
  <div class="container">

    <div id="logo" class="col-2 pull-left">
    
      <img src="./img/logo.png" alt="logo" style="">
     
     <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
   </div>
   
<!-- <button type="button" class="btn btn-primary" >
  Open Test Modal
</button> -->



  <nav id="nav-menu-container" class="col-10">
    <ul class="nav-menu">
      <li class="menu-active"><a style="font-weight:bold;font-size:large;" href="index.php">Home</a></li>
      <li><a style="font-weight:bold;font-size:large;" data-toggle="modal" data-target="#driverModal" href="#">Become Driver</a></li>
      <li><a style="font-weight:bold;font-size:large;" href="about.php">About Us</a></li>
      <li><a style="font-weight:bold;font-size:large;" href="car_list.php">Car list</a></li>
      <li><a style="font-weight:bold;font-size:large;" href="contact.php">Contact</a></li>
      <li><a style="font-weight:bold;font-size:large;" href="portfolio.php">Gallery</a></li>
      <?php if(strlen($_SESSION['email']) == 0 ){ 
      
       echo '<li class="menu-has-children"><a style="font-weight:bold;font-size:large;" href="">Login</a>
              <ul>
                <li><a style="font-weight:bold;font-size:large;" href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
                <li><a style="font-weight:bold;font-size:large;" href="#" data-toggle="modal" data-target="#signupModal">Signup</a></li>
              </ul>
            </li>';
      } ?>
      
      <?php   if(strlen($_SESSION['email'])!=0)
      { 
        ?>
        <?php 
        $email=$_SESSION['email'];
        $sql ="SELECT fullName FROM users WHERE email='$email'";
        
        $results=mysqli_query($db,$sql);

        if(mysqli_num_rows($results) > 0)
        {
          foreach($results as $result)
          {
            ?>
            <li class="menu-has-children"><a href=""><?php echo htmlentities($result['fullName']);?></a>
              <ul>
                <li><a href="profile.php">Profile Settings</a></li>
                <li><a href="update_password.php">Update Password</a></li>
                <li><a href="my_booking.php">My Booking</a></li>
                <li><a href="logout.php" onclick="return confirm('Are you ready to Logout?')">Sign Out</a></li>
              </ul>
            </li>
            <?php 
          }
        }
      } ?>
    </ul>
  </nav><!-- #nav-menu-container -->
<br >
  <div class="search pull-left">
    <!-- SEARCH FORM -->
    <form class="form-inline"  action="search.php" method="post">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" style="max-height: 30px;" type="text"  name="searchdata" placeholder="Search Car" aria-label="Search" required="true">
        <div class="input-group-append">
          <button class="btn btn-navbar" style="background-color: #49a3ff;" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </div>

</div>
  </header><!-- #header -->